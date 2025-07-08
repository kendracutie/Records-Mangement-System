<?php
 function encryptData($plaintext, $cipher_algo, $key, $iv_length) {
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($plaintext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}
function decryptData($encryptedData, $cipher_algo, $key) {
    $decoded = base64_decode($encryptedData);
    $iv_length = openssl_cipher_iv_length($cipher_algo);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);
    
    // Suppress warnings by using the @ operator
    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    
    // Optionally check if decryption failed
    if ($decrypted === false) {
        // Handle the decryption failure (e.g., log an error, return null, etc.)
        return null; // or return an empty string, or handle it as appropriate
    }
    
    return $decrypted;
}class Confirmation {
    function insert($data) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        // Begin transaction
        $cn->begin_transaction();
    
        try {
            // Encryption setup
            $cipher_algo = 'AES-256-CBC';
            $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
            $iv_length = openssl_cipher_iv_length($cipher_algo);

            // Check if person already exists
            $check_person_sql = "
                SELECT first_name, middle_name, last_name 
                FROM person 
                WHERE sacrament = 'confirmation'";
            $check_person_qry = $cn->prepare($check_person_sql);
            $check_person_qry->execute();
            $check_person_qry->store_result();
    
            // Fetch all existing names
            $check_person_qry->bind_result($encrypted_first_name, $encrypted_middle_name, $encrypted_last_name);
            while ($check_person_qry->fetch()) {
                $decrypted_first_name = decryptData($encrypted_first_name, $cipher_algo, $key);
                $decrypted_middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key);
                $decrypted_last_name = decryptData($encrypted_last_name, $cipher_algo, $key);
    
                // Check if names match
                if ($decrypted_first_name == $data[1] && $decrypted_middle_name == $data[2] && $decrypted_last_name == $data[3]) {
                    $check_person_qry->close();
                    $cn->rollback();
                    $cn->close();
                    return 'A person with the same name already exists.';
                }
            }
            $check_person_qry->close();
    
            // Encrypt person data
            $encrypted_first_name = encryptData($data[1], $cipher_algo, $key, $iv_length);
            $encrypted_middle_name = encryptData($data[2], $cipher_algo, $key, $iv_length);
            $encrypted_last_name = encryptData($data[3], $cipher_algo, $key, $iv_length);
    
            // Insert the person record
            $person_sql = "INSERT INTO person (first_name, middle_name, last_name, age, sacrament) VALUES (?, ?, ?, ?, 'confirmation')";
            $person_qry = $cn->prepare($person_sql);
            $person_qry->bind_param("ssss", $encrypted_first_name, $encrypted_middle_name, $encrypted_last_name, $data[4]);
            if (!$person_qry->execute()) {
                throw new Exception("Person insertion failed: " . $person_qry->error);
            }
            $person_id = $cn->insert_id;
    
            // Encrypt and insert parent records
            $father_first_name = encryptData($data[5], $cipher_algo, $key, $iv_length);
            $father_middle_name = encryptData($data[6], $cipher_algo, $key, $iv_length);
            $father_last_name = encryptData($data[7], $cipher_algo, $key, $iv_length);

            $father_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'father')";
            $father_qry = $cn->prepare($father_sql);
            $father_qry->bind_param("isss", $person_id, $father_first_name, $father_middle_name, $father_last_name);
            if (!$father_qry->execute()) {
                throw new Exception("Father insertion failed: " . $father_qry->error);
            }
    
            $mother_first_name = encryptData($data[8], $cipher_algo, $key, $iv_length);
            $mother_middle_name = encryptData($data[9], $cipher_algo, $key, $iv_length);
            $mother_last_name = encryptData($data[10], $cipher_algo, $key, $iv_length);
    
            $mother_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'mother')";
            $mother_qry = $cn->prepare($mother_sql);
            $mother_qry->bind_param("isss", $person_id, $mother_first_name, $mother_middle_name, $mother_last_name);
            if (!$mother_qry->execute()) {
                throw new Exception("Mother insertion failed: " . $mother_qry->error);
            }
    
            // Encrypt and insert priest data
            $priest_title = encryptData($data[13], $cipher_algo, $key, $iv_length);
            $priest_fname = encryptData($data[14], $cipher_algo, $key, $iv_length);
            $priest_mname = encryptData($data[15], $cipher_algo, $key, $iv_length);
            $priest_lname = encryptData($data[16], $cipher_algo, $key, $iv_length);
    
            $priest_sql = "INSERT INTO priest (person_id, priest_title, priest_fname, priest_mname, priest_lname) VALUES (?, ?, ?, ?, ?)";
            $priest_qry = $cn->prepare($priest_sql);
            $priest_qry->bind_param("issss", $person_id, $priest_title, $priest_fname, $priest_mname, $priest_lname);
            if (!$priest_qry->execute()) {
                throw new Exception("Priest insertion failed: " . $priest_qry->error);
            }
            $priest_id = $cn->insert_id;
    
            $place_of_baptism = encryptData($data[11], $cipher_algo, $key, $iv_length);

            // Auto-generate page_no, line_no, and book_no for Confirmation
            $last_confirmation_sql = "SELECT page_no, line_no, book_no FROM confirmation ORDER BY book_no DESC, page_no DESC, line_no DESC LIMIT 1";
            $last_confirmation_qry = $cn->query($last_confirmation_sql);
            $last_confirmation = $last_confirmation_qry->fetch_assoc();

            // Initialize values if no records exist
            if ($last_confirmation) {
                $page_no = $last_confirmation['page_no'];
                $line_no = $last_confirmation['line_no'];
                $book_no = $last_confirmation['book_no'];
            } else {
                // Start fresh
                $page_no = 1;
                $line_no = 0;
                $book_no = 1;
            }

            // Increment line_no for each new confirmation record
            $line_no++;

            // If line_no exceeds 30, reset it and increment page_no
            if ($line_no > 30) {
                $line_no = 1;
                $page_no++;
            }

            // If page_no exceeds 100, reset it and increment book_no
            if ($page_no > 100) {
                $page_no = 1;
                $book_no++;
            }

            // Insert data into the 'confirmation' table with page_no, line_no, and book_no
            $confirmation_sql = "INSERT INTO confirmation (person_id, confirmation_date, place_of_baptism, priest_id, encoder, status, page_no, line_no, book_no) 
                                 VALUES (?, ?, ?, ?, ?, 'active', ?, ?, ?)";
            $confirmation_qry = $cn->prepare($confirmation_sql);
            $confirmation_qry->bind_param("issisiii", $person_id, $data[0], $place_of_baptism, $priest_id, $data[12], $page_no, $line_no, $book_no);
            if (!$confirmation_qry->execute()) {
                throw new Exception("Confirmation insertion failed: " . $confirmation_qry->error);
            }
    
            // Encrypt and insert sponsors
            if (isset($_POST['sponsor_first_name'], $_POST['sponsor_middle_name'], $_POST['sponsor_last_name'], $_POST['relation'])) {
                $sponsors = [
                    'sponsor_first_name' => $_POST['sponsor_first_name'],
                    'sponsor_middle_name' => $_POST['sponsor_middle_name'],
                    'sponsor_last_name' => $_POST['sponsor_last_name'],
                    'relation' => $_POST['relation']
                ];
    
                $sponsor_sql = "INSERT INTO sponsor (person_id, sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation, sacrament) VALUES (?, ?, ?, ?, ?,'confirmation')";
                $sponsor_qry = $cn->prepare($sponsor_sql);
                if (!$sponsor_qry) {
                    throw new Exception("Sponsor preparation failed: " . $cn->error);
                }
    
                foreach ($sponsors['sponsor_first_name'] as $i => $sponsor_first_name) {
                    $encrypted_sponsor_first_name = encryptData($sponsor_first_name, $cipher_algo, $key, $iv_length);
                    $encrypted_sponsor_middle_name = encryptData($sponsors['sponsor_middle_name'][$i] ?? '', $cipher_algo, $key, $iv_length);
                    $encrypted_sponsor_last_name = encryptData($sponsors['sponsor_last_name'][$i] ?? '', $cipher_algo, $key, $iv_length);
                    $encrypted_relation = encryptData($sponsors['relation'][$i] ?? '', $cipher_algo, $key, $iv_length);
    
                    $sponsor_qry->bind_param("issss", $person_id, $encrypted_sponsor_first_name, $encrypted_sponsor_middle_name, $encrypted_sponsor_last_name, $encrypted_relation);
                    if (!$sponsor_qry->execute()) {
                        throw new Exception("Sponsor insertion failed: " . $sponsor_qry->error);
                    }
                }
            }
    
            // Log activity
            $this->logActivity($_SESSION['username'], 'Added new confirmation record: ' . $data[1] . " " . $data[2] . " " . $data[3]);
    
            // Commit transaction
            $cn->commit();
            $cn->close();
            return 'Record successfully added.';
        } catch (Exception $e) {
            // Rollback transaction
            $cn->rollback();
            $cn->close();
            return 'Failed to add record: ' . $e->getMessage();     
        } 
    }


     // Function to log activity
  public function logActivity($username, $action) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Insert into activity_log
    $query = "INSERT INTO activity_log (username, action, date) VALUES (?, ?, NOW())";
    $log_qry = $cn->prepare($query);
    $log_qry->bind_param("ss", $username, $action);
    $log_qry->execute();
    $log_qry->close();
  }

    
  // Function to get activity logs
public function getActivityLogs() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);
    
    $data = []; // Initialize an array to store the logs

    // Prepare and execute the SQL query
    $sql = "SELECT username, action, date FROM activity_log ORDER BY date DESC";
    $qry = $cn->prepare($sql);
    
    if ($qry->execute()) {
        $result = $qry->get_result(); // Get the result set from the prepared statement
        $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
    } else {
        echo "Error executing SQL query: " . $qry->error; // Handle query execution errors
    }

    // Close the prepared statement and database connection
    $qry->close();
    $cn->close();

    return $data; // Return the fetched logs
}

function getall() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    $data = array();
    $ctr = 0;

     // Decryption setup
     $cipher_algo = 'AES-256-CBC';
     $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the key

    // SQL query to retrieve confirmation records with priest details
    $sql = "SELECT 
                p.person_id, p.first_name, p.middle_name, p.last_name, p.gender, p.dob, p.age, p.place_of_birth, p.address,
                c.confirmation_id, c.confirmation_date, c.encoder, c.status, c.place_of_baptism,
                pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name,
                pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name,
                pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname,
                c.place_of_baptism
            FROM 
                person p
            LEFT JOIN 
                confirmation c ON p.person_id = c.person_id
            LEFT JOIN 
                parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
            LEFT JOIN 
                parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
            LEFT JOIN 
                priest pr ON c.priest_id = pr.priest_id
            ORDER BY 
                c.confirmation_id DESC";

    $qry = $cn->prepare($sql);
    if ($qry === false) {
        die("Error in preparing statement: " . $cn->error);
    }
    $qry->execute();
    $qry->bind_result(
        $person_id, $first_name, $middle_name, $last_name, $gender, $dob, $age, $place_of_birth, $address,
        $confirmation_id, $confirmation_date, $encoder, $status, $place_of_baptism,
        $father_first_name, $father_middle_name, $father_last_name,
        $mother_first_name, $mother_middle_name, $mother_last_name,
        $priest_title, $priest_fname, $priest_mname, $priest_lname,
        $place_of_baptism
    );

    while ($qry->fetch()) {
        // Decrypt general data fields
        $decrypted_first_name = decryptData($first_name, $cipher_algo, $key);
        $decrypted_middle_name = decryptData($middle_name, $cipher_algo, $key);
        $decrypted_last_name = decryptData($last_name, $cipher_algo, $key);
        $decrypted_address = decryptData($address, $cipher_algo, $key);
        
        $place_of_baptism = decryptData($place_of_baptism, $cipher_algo, $key); 
        // Decrypt parent data
        $father_name = decryptData($father_first_name, $cipher_algo, $key) . ' ' .
                       decryptData($father_middle_name, $cipher_algo, $key) . ' ' .
                       decryptData($father_last_name, $cipher_algo, $key);

        $mother_name = decryptData($mother_first_name, $cipher_algo, $key) . ' ' .
                       decryptData($mother_middle_name, $cipher_algo, $key) . ' ' .
                       decryptData($mother_last_name, $cipher_algo, $key);

        // Decrypt priest data
        $priest_name = decryptData($priest_title, $cipher_algo, $key) . ' ' .
                       decryptData($priest_fname, $cipher_algo, $key) . ' ' .
                       decryptData($priest_mname, $cipher_algo, $key) . ' ' .
                       decryptData($priest_lname, $cipher_algo, $key);

        // Assign decrypted data to the array
        $data[$ctr] = [
            'person_id' => $person_id,
            'first_name' => $decrypted_first_name,
            'middle_name' => $decrypted_middle_name,
            'last_name' => $decrypted_last_name,
            'gender' => $gender,
            'dob' => $dob,
            'age' => $age,
            'place_of_birth' => $place_of_birth,
            'address' => $decrypted_address,
            'confirmation_id' => $confirmation_id,
            'confirmation_date' => $confirmation_date,
            'encoder' => $encoder,
            'status' => $status,
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'priests' => $priest_name,
            'place_of_baptism' => $place_of_baptism
        ];

        $ctr++;
    }

    // Close the prepared statement and database connection
    $qry->close();
    $cn->close();

    return $data;
}

    
    

function getone($id) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

           // Decryption setup
           $cipher_algo = 'AES-256-CBC';
           $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the key
           $iv_length = openssl_cipher_iv_length($cipher_algo);
           $options = OPENSSL_RAW_DATA; // Use RAW_DATA for decryption as well
    $data = array();

    // Main query to get confirmation and person details
    $sql = "SELECT p.person_id, p.first_name, p.middle_name, p.last_name, p.age,
            c.confirmation_id, c.confirmation_date, c.book_no, c.page_no, c.line_no, c.purpose, c.place_of_baptism, c.encoder, c.status,
            pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name,
            pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name,
            pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
            FROM person p
            LEFT JOIN confirmation c ON p.person_id = c.person_id
            LEFT JOIN parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
            LEFT JOIN parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
            LEFT JOIN priest pr ON p.person_id = pr.person_id
            WHERE c.confirmation_id = ?";

    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);

    if ($qry->execute()) {
        // Bind result variables
        $qry->bind_result(
            $person_id, $first_name, $middle_name, $last_name, $age,
            $confirmation_id, $confirmation_date, $book_no, $page_no, $line_no, $purpose, $place_of_baptism, $encoder, $status,
            $father_first_name, $father_middle_name, $father_last_name,
            $mother_first_name, $mother_middle_name, $mother_last_name,
            $priest_title, $priest_fname, $priest_mname, $priest_lname
        );

        // Fetch the data
        if ($qry->fetch()) {
            $data = array(
                'person_id' => $person_id,
                'first_name' => decryptData($first_name, $cipher_algo, $key),
                'middle_name' => decryptData($middle_name, $cipher_algo, $key),
                'last_name' => decryptData($last_name, $cipher_algo, $key),
                'age' => $age,
                'confirmation_id' => $confirmation_id,
                'confirmation_date' => $confirmation_date,
                'book_no' => $book_no,
                'page_no' => $page_no,
                'line_no' => $line_no,
                'purpose' => $purpose,
                'place_of_baptism' => decryptData($place_of_baptism, $cipher_algo, $key),
                'encoder' => decryptData($encoder, $cipher_algo, $key),
                'status' => $status,
                'father_first_name' => decryptData($father_first_name, $cipher_algo, $key),
                'father_middle_name' => decryptData($father_middle_name, $cipher_algo, $key),
                'father_last_name' => decryptData($father_last_name, $cipher_algo, $key),
                'mother_first_name' => decryptData($mother_first_name, $cipher_algo, $key),
                'mother_middle_name' => decryptData($mother_middle_name, $cipher_algo, $key),
                'mother_last_name' => decryptData($mother_last_name, $cipher_algo, $key),
                'priest_title' => decryptData($priest_title, $cipher_algo, $key),
                'priest_fname' => decryptData($priest_fname, $cipher_algo, $key),
                'priest_mname' => decryptData($priest_mname, $cipher_algo, $key),
                'priest_lname' => decryptData($priest_lname, $cipher_algo, $key)
            );
        }
        $qry->free_result(); // Free the result set
    } else {
        echo "Error executing SQL query: " . $qry->error;
    }

    // Retrieve sponsors separately
    $sql_sponsors = "SELECT sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation 
                     FROM sponsor 
                     WHERE person_id = (SELECT person_id FROM confirmation WHERE confirmation_id = ?) 
                     AND sacrament = 'confirmation'"; 

    $qry_sponsors = $cn->prepare($sql_sponsors);
    $qry_sponsors->bind_param("i", $id);

    $sponsors = array();
    if ($qry_sponsors->execute()) {
        $qry_sponsors->bind_result($sponsor_first_name, $sponsor_middle_name, $sponsor_last_name, $relation);

        while ($qry_sponsors->fetch()) {
            $sponsors[] = array(
                'sponsor_first_name' => decryptData($sponsor_first_name, $cipher_algo, $key),
                'sponsor_middle_name' => decryptData($sponsor_middle_name, $cipher_algo, $key),
                'sponsor_last_name' => decryptData($sponsor_last_name, $cipher_algo, $key),
                'relation' => decryptData($relation, $cipher_algo, $key)
            );
        }
    } else {
        echo "Error executing SQL query for sponsors: " . $qry_sponsors->error;
    }

    if (!empty($data)) {
        $data['sponsors'] = $sponsors;
    }

    // Close the prepared statements and database connection
    $qry->close();
    $qry_sponsors->close();
    $cn->close();

    return $data;
}

    
    
function update(
    $confirmation_date, $first_name, $middle_name, $last_name, $age,
    $father_first_name, $father_middle_name, $father_last_name,
    $mother_first_name, $mother_middle_name, $mother_last_name,
    $priest_title, $priest_fname, $priest_mname, $priest_lname,
    $place_of_baptism, $book_no, $page_no, $line_no, $purpose,
    $encoder, $confirmation_id, $sponsors
) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Encryption setup
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    $cn->begin_transaction();

    try {
        // Check if the person already exists (excluding the current confirmation_id)
        $check_person_sql = "
        SELECT p.first_name, p.middle_name, p.last_name 
        FROM person p
        JOIN confirmation c ON p.person_id = c.person_id
        WHERE c.confirmation_id != ?";
        
        $check_person_qry = $cn->prepare($check_person_sql);
        $check_person_qry->bind_param("i", $confirmation_id);
        $check_person_qry->execute();
        $check_person_qry->store_result();
        
        // Fetch and decrypt names to check for duplicates
        $check_person_qry->bind_result($existing_encrypted_first_name, $existing_encrypted_middle_name, $existing_encrypted_last_name);
        while ($check_person_qry->fetch()) {
            // Decrypt existing names
            $decrypted_first_name = decryptData($existing_encrypted_first_name, $cipher_algo, $key);
            $decrypted_middle_name = decryptData($existing_encrypted_middle_name, $cipher_algo, $key);
            $decrypted_last_name = decryptData($existing_encrypted_last_name, $cipher_algo, $key);
            
            // Check if names match
            if ($decrypted_first_name == $first_name && $decrypted_middle_name == $middle_name && $decrypted_last_name == $last_name) {
                echo "<script>
                    showAlert('A person with the same name already exists.', '', 'warning');
                    setTimeout(function() { window.location.href='../baptism'; }, 2000);
                </script>";
                $check_person_qry->close();
                $cn->rollback();
                $cn->close();
                return false;
            }
        }
        $check_person_qry->close();

        // Encrypt the data before updating
        $encrypted_first_name = encryptData($first_name, $cipher_algo, $key,  $iv_length);
        $encrypted_middle_name = encryptData($middle_name, $cipher_algo, $key,  $iv_length);
        $encrypted_last_name = encryptData($last_name, $cipher_algo, $key,  $iv_length);
        $encrypted_place_of_baptism = encryptData($place_of_baptism, $cipher_algo, $key,  $iv_length);
        $encrypted_father_first_name = encryptData($father_first_name, $cipher_algo, $key,  $iv_length);
        $encrypted_father_middle_name = encryptData($father_middle_name, $cipher_algo, $key,  $iv_length);
        $encrypted_father_last_name = encryptData($father_last_name, $cipher_algo, $key,  $iv_length);
        $encrypted_mother_first_name = encryptData($mother_first_name, $cipher_algo, $key,  $iv_length);
        $encrypted_mother_middle_name = encryptData($mother_middle_name, $cipher_algo, $key,  $iv_length);
        $encrypted_mother_last_name = encryptData($mother_last_name, $cipher_algo, $key,  $iv_length);
        $encrypted_priest_title = encryptData($priest_title, $cipher_algo, $key,  $iv_length);
        $encrypted_priest_fname = encryptData($priest_fname, $cipher_algo, $key,  $iv_length);
        $encrypted_priest_mname = encryptData($priest_mname, $cipher_algo, $key,  $iv_length);
        $encrypted_priest_lname = encryptData($priest_lname, $cipher_algo, $key,  $iv_length);

        // Update confirmation and person details
        $update_sql = "UPDATE person p
                       JOIN confirmation c ON p.person_id = c.person_id
                       JOIN parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
                       JOIN parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
                       JOIN priest pr ON p.person_id = pr.person_id
                       SET p.first_name = ?, p.middle_name = ?, p.last_name = ?, p.age = ?,
                           c.confirmation_date = ?, c.book_no = ?, c.page_no = ?, c.line_no = ?, c.purpose = ?, c.place_of_baptism = ?, c.encoder = ?,
                           pf.parent_first_name = ?, pf.parent_middle_name = ?, pf.parent_last_name = ?,
                           pm.parent_first_name = ?, pm.parent_middle_name = ?, pm.parent_last_name = ?,
                           pr.priest_title = ?, pr.priest_fname = ?, pr.priest_mname = ?, pr.priest_lname = ?
                       WHERE c.confirmation_id = ?";

        $qry = $cn->prepare($update_sql);
        if (!$qry) throw new Exception("Preparation failed: " . $cn->error);

        $qry->bind_param(
            "sssssssssssssssssssssi",
            $encrypted_first_name, $encrypted_middle_name, $encrypted_last_name, $age,
            $confirmation_date, $book_no, $page_no, $line_no, $purpose, $encrypted_place_of_baptism, $encoder,
            $encrypted_father_first_name, $encrypted_father_middle_name, $encrypted_father_last_name,
            $encrypted_mother_first_name, $encrypted_mother_middle_name, $encrypted_mother_last_name,
            $encrypted_priest_title, $encrypted_priest_fname, $encrypted_priest_mname, $encrypted_priest_lname,
            $confirmation_id
        );

        if (!$qry->execute()) throw new Exception("Execution failed: " . $qry->error);

        // Get the person_id for further operations
        $person_id_result = $cn->query("SELECT person_id FROM confirmation WHERE confirmation_id = $confirmation_id");
        if ($person_id_result->num_rows == 0) throw new Exception("No person_id found for confirmation_id: $confirmation_id");

        $person_id = $person_id_result->fetch_assoc()['person_id'];

        // 1. Delete old sponsors that are not in the updated list
        $existing_sponsor_ids_result = $cn->query("SELECT sponsor_id FROM sponsor WHERE person_id = $person_id");
        $existing_sponsor_ids = [];
        while ($row = $existing_sponsor_ids_result->fetch_assoc()) {
            $existing_sponsor_ids[] = $row['sponsor_id'];
        }

        $existing_sponsor_ids_to_delete = array_diff($existing_sponsor_ids, array_column($sponsors, 'sponsor_id'));
        if (!empty($existing_sponsor_ids_to_delete)) {
            $delete_sql = "DELETE FROM sponsor WHERE person_id = ? AND sponsor_id IN (" . implode(',', array_fill(0, count($existing_sponsor_ids_to_delete), '?')) . ")";
            $delete_qry = $cn->prepare($delete_sql);
            if (!$delete_qry) throw new Exception("Sponsor delete preparation failed: " . $cn->error);

            $delete_params = array_merge([$person_id], $existing_sponsor_ids_to_delete);
            $delete_qry->bind_param(str_repeat('i', count($delete_params)), ...$delete_params);

            if (!$delete_qry->execute()) throw new Exception("Sponsor delete execution failed: " . $delete_qry->error);
        }

        // 2. Insert or update sponsors
        $insert_update_sql = "INSERT INTO sponsor (sponsor_id, sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation, sacrament, person_id)
                              VALUES (?, ?, ?, ?, ?, 'confirmation', ?)
                              ON DUPLICATE KEY UPDATE
                                  sponsor_first_name = VALUES(sponsor_first_name),
                                  sponsor_middle_name = VALUES(sponsor_middle_name),
                                  sponsor_last_name = VALUES(sponsor_last_name),
                                  relation = VALUES(relation)";
        $insert_update_qry = $cn->prepare($insert_update_sql);
        if (!$insert_update_qry) throw new Exception("Sponsor insert/update preparation failed: " . $cn->error);

        foreach ($sponsors as $sponsor) {
            $sponsor_id = $sponsor['sponsor_id'] ?? null;

            // Encrypt sponsor names
            $encrypted_sponsor_first_name = encryptData($sponsor['sponsor_first_name'], $cipher_algo, $key,  $iv_length);
            $encrypted_sponsor_middle_name = encryptData($sponsor['sponsor_middle_name'], $cipher_algo, $key,  $iv_length);
            $encrypted_sponsor_last_name = encryptData($sponsor['sponsor_last_name'], $cipher_algo, $key,  $iv_length);
            $encrypted_relation = encryptData($sponsor['relation'], $cipher_algo, $key,  $iv_length);

            $insert_update_qry->bind_param(
                "issssi",
                $sponsor_id,
                $encrypted_sponsor_first_name, 
                $encrypted_sponsor_middle_name, 
                $encrypted_sponsor_last_name,
                $encrypted_relation,
                $person_id
            );
            if (!$insert_update_qry->execute()) throw new Exception("Sponsor insert/update execution failed: " . $insert_update_qry->error);
        }

        $this->logActivity($_SESSION['username'], 'Updated confirmation record: ' . $first_name . " " . $middle_name . " " . $last_name);

        $cn->commit();
        $cn->close();
        return true;
    } catch (Exception $e) {
        $cn->rollback();
        $cn->close();
        error_log($e->getMessage());
        return false;
    }
}
    

    function generate() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        $data = array();
    
        // SQL query to retrieve confirmation records with details
        $sql = "SELECT 
                p.person_id, p.first_name, p.middle_name, p.last_name, p.gender, p.dob, p.age, p.address,
                c.confirmation_id, c.confirmation_date, c.book_no, c.page_no, c.line_no, c.purpose, c.place_of_baptism, c.encoder, c.status,
                pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name,
                pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name,
                pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname,
                s.sponsor_first_name, s.sponsor_middle_name, s.sponsor_last_name, s.sponsor_address
            FROM 
                person p
            LEFT JOIN 
                confirmation c ON p.person_id = c.person_id
            LEFT JOIN 
                parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
            LEFT JOIN 
                parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
            LEFT JOIN 
                priest pr ON c.priest_id = pr.priest_id
            LEFT JOIN 
                sponsor s ON p.person_id = s.person_id
            ORDER BY 
                c.created_at DESC";
    
        $qry = $cn->prepare($sql);
        if (!$qry) {
            throw new Exception("Prepare failed: " . $cn->error);
        }
    
        $qry->execute();
        $rs = $qry->get_result();
    
        // Encryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    
        while ($row = $rs->fetch_assoc()) {
            $person_id = $row['person_id'];
    
            // Check if this person already exists in $data, if not add them
            if (!isset($data[$person_id])) {
                // Decrypt the person details
                $decrypted_first_name = decryptData($row['first_name'], $cipher_algo, $key);
                $decrypted_middle_name = decryptData($row['middle_name'], $cipher_algo, $key);
                $decrypted_last_name = decryptData($row['last_name'], $cipher_algo, $key);
                $decrypted_address = decryptData($row['address'], $cipher_algo, $key);
                $decrypted_place_of_baptism = decryptData($row['place_of_baptism'], $cipher_algo, $key);

                 // Decrypt parent fields
            $father_name = decryptData($row['father_first_name'], $cipher_algo, $key) . ' ' .
            decryptData($row['father_middle_name'], $cipher_algo, $key) . ' ' .
            decryptData($row['father_last_name'], $cipher_algo, $key);

        $mother_name = decryptData($row['mother_first_name'], $cipher_algo, $key) . ' ' .
            decryptData($row['mother_middle_name'], $cipher_algo, $key) . ' ' .
            decryptData($row['mother_last_name'], $cipher_algo, $key);

        // Decrypt priest fields
        $priest_name = decryptData($row['priest_title'], $cipher_algo, $key) . ' ' .
            decryptData($row['priest_fname'], $cipher_algo, $key) . ' ' .
            decryptData($row['priest_mname'], $cipher_algo, $key) . ' ' .
            decryptData($row['priest_lname'], $cipher_algo, $key);
    
                // Add all decrypted data to the array
            $data[$person_id] = [
                'person_id' => $row['person_id'],
                'first_name' => $decrypted_first_name,
                'middle_name' => $decrypted_middle_name,
                'last_name' => $decrypted_last_name,
                'gender' => $row['gender'],
                'dob' => $row['dob'],
                'age' => $row['age'],
                'place_of_baptism' => $decrypted_place_of_baptism,
                'address' => $decrypted_address,
                'confirmation_id' => $row['confirmation_id'],
                'confirmation_date' => $row['confirmation_date'],
                'book_no' => $row['book_no'],
                'page_no' => $row['page_no'],
                'line_no' => $row['line_no'],
                'purpose' => $row['purpose'],
                'encoder' => $row['encoder'],
                'status' => $row['status'],
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'priests' => $priest_name,
                'sponsors' => [] // Initialize empty sponsors array
            ];
            }
    
            // Add sponsor details for this person
if ($row['sponsor_first_name'] || $row['sponsor_middle_name'] || $row['sponsor_last_name']) {
    $decrypted_first_name = decryptData($row['sponsor_first_name'], $cipher_algo, $key);
    $decrypted_middle_name = decryptData($row['sponsor_middle_name'], $cipher_algo, $key);
    $decrypted_last_name = decryptData($row['sponsor_last_name'], $cipher_algo, $key);

    $data[$person_id]['sponsors'][] = [
        'sponsor_name' => trim($decrypted_first_name . ' ' . $decrypted_middle_name . ' ' . $decrypted_last_name), // Concatenate and trim any extra spaces
        'sponsor_address' => $row['sponsor_address'] ? decryptData($row['sponsor_address'], $cipher_algo, $key) : null // Decrypt sponsor address if exists
    ];
}

    
        // Close connection
        $qry->close();
        $cn->close();
    
        return $data;
    }
}



    
function archive($id) {
    require_once '../../includes/connect.php';
    $conn = new Conn();

    // Start the session only if it's not already active
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the username is set in the session
    if (!isset($_SESSION['username'])) {
        return false; // Handle the case where the session is expired or not set
    }

    // Connect to the database
    $cn = $conn->connect(1);

    // Fetch the record details from the person table using a join
    $fetchSql = "SELECT p.first_name, p.middle_name, p.last_name 
                 FROM confirmation c
                 JOIN person p ON c.person_id = p.person_id
                 WHERE c.confirmation_id = ?";
    $fetchQry = $cn->prepare($fetchSql);
    $fetchQry->bind_param("i", $id); // Use $id to bind the confirmation ID
    $fetchQry->execute();
    $fetchQry->bind_result($encrypted_first_name, $encrypted_middle_name, $encrypted_last_name);
    $fetchQry->fetch();
    $fetchQry->close();

    // Encryption setup
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    // Decrypt the names
    $first_name = decryptData($encrypted_first_name, $cipher_algo, $key, $iv_length);
    $middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key, $iv_length);
    $last_name = decryptData($encrypted_last_name, $cipher_algo, $key, $iv_length);

    // Update the query to set a field (e.g., `status`) to indicate that the record is archived
    $sql = "UPDATE confirmation SET status = 'archived' WHERE confirmation_id = ?";
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);

    if ($qry->execute()) {
        // Log the activity for archiving the record
        $this->logActivity($_SESSION['username'], 'Archived confirmation record: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);
        return true;
    } else {
        return false;
    }
}

function restore($id) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    
    // Start the session only if it's not already active
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if the username is set in the session
    if (!isset($_SESSION['username'])) {
        return false; // Handle the case where the session is expired or not set
    }

    // Connect to the database
    $cn = $conn->connect(1);

    // Fetch the record details from the person table using a join
    $fetchSql = "SELECT p.first_name, p.middle_name, p.last_name 
                 FROM confirmation c
                 JOIN person p ON c.person_id = p.person_id
                 WHERE c.confirmation_id = ?";
    $fetchQry = $cn->prepare($fetchSql);
    $fetchQry->bind_param("i", $id); // Use $id to bind the confirmation ID
    $fetchQry->execute();
    $fetchQry->bind_result($encrypted_first_name, $encrypted_middle_name, $encrypted_last_name);
    $fetchQry->fetch();
    $fetchQry->close();

    // Encryption setup
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    // Decrypt the names
    $first_name = decryptData($encrypted_first_name, $cipher_algo, $key, $iv_length);
    $middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key, $iv_length);
    $last_name = decryptData($encrypted_last_name, $cipher_algo, $key, $iv_length);

    // Update the query to set the status field to 'active'
    $sql = "UPDATE confirmation SET status = 'active' WHERE confirmation_id = ?";
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);
    
    if ($qry->execute()) {
        // Log the activity for restoring the record
        $this->logActivity($_SESSION['username'], 'Restored confirmation record: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);
        return true; // Successfully restored
    } else {
        return false; // Failed to restore
    }
}
}

?>