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
}
class Baptism {
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
                WHERE sacrament = 'baptism'";
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

            // Encrypt main person data
            $encrypted_first_name = encryptData($data[1], $cipher_algo, $key, $iv_length);
            $encrypted_middle_name = encryptData($data[2], $cipher_algo, $key, $iv_length);
            $encrypted_last_name = encryptData($data[3], $cipher_algo, $key, $iv_length);
            $encrypted_place_of_birth = encryptData($data[7], $cipher_algo, $key, $iv_length);
            $encrypted_address = encryptData($data[8], $cipher_algo, $key, $iv_length);

            // Insert into person table with encrypted fields
            $person_sql = "INSERT INTO person (first_name, middle_name, last_name, gender, dob, age, place_of_birth, address, role, sacrament) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'baptism')";
            $person_qry = $cn->prepare($person_sql);
            $person_qry->bind_param("sssssssss", $encrypted_first_name, $encrypted_middle_name, $encrypted_last_name, $data[4], $data[5], $data[6], $encrypted_place_of_birth, $encrypted_address, $data[9]);
            if (!$person_qry->execute()) throw new Exception("Person insertion failed: " . $person_qry->error);
            $person_id = $cn->insert_id;

            // Encrypt and insert parent data
            $father_first_name = encryptData($data[13], $cipher_algo, $key, $iv_length);
            $father_middle_name = encryptData($data[14], $cipher_algo, $key, $iv_length);
            $father_last_name = encryptData($data[15], $cipher_algo, $key, $iv_length);
            $father_address = encryptData($data[16], $cipher_algo, $key, $iv_length);
            $father_marriage = encryptData($data[17], $cipher_algo, $key, $iv_length);

            $father_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, parent_address, relation, marriage) 
                           VALUES (?, ?, ?, ?, ?, 'father', ?)";
            $father_qry = $cn->prepare($father_sql);
            $father_qry->bind_param("isssss", $person_id, $father_first_name, $father_middle_name, $father_last_name, $father_address, $father_marriage);
            if (!$father_qry->execute()) throw new Exception("Father insertion failed: " . $father_qry->error);

            $mother_first_name = encryptData($data[18], $cipher_algo, $key, $iv_length);
            $mother_middle_name = encryptData($data[19], $cipher_algo, $key, $iv_length);
            $mother_last_name = encryptData($data[20], $cipher_algo, $key, $iv_length);
            $mother_address = encryptData($data[21], $cipher_algo, $key, $iv_length);

            $mother_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, parent_address, relation, marriage) 
                           VALUES (?, ?, ?, ?, ?, 'mother', '$father_marriage')";
            $mother_qry = $cn->prepare($mother_sql);
            $mother_qry->bind_param("issss", $person_id, $mother_first_name, $mother_middle_name, $mother_last_name, $mother_address);
            if (!$mother_qry->execute()) throw new Exception("Mother insertion failed: " . $mother_qry->error);

            // Encrypt and insert priest data
            $priest_title = encryptData($data[23], $cipher_algo, $key, $iv_length);
            $priest_fname = encryptData($data[24], $cipher_algo, $key, $iv_length);
            $priest_mname = encryptData($data[25], $cipher_algo, $key, $iv_length);
            $priest_lname = encryptData($data[26], $cipher_algo, $key, $iv_length);

            $priest_sql = "INSERT INTO priest (person_id, priest_title, priest_fname, priest_mname, priest_lname) 
                           VALUES (?, ?, ?, ?, ?)";
            $priest_qry = $cn->prepare($priest_sql);
            $priest_qry->bind_param("issss", $person_id, $priest_title, $priest_fname, $priest_mname, $priest_lname);
            if (!$priest_qry->execute()) throw new Exception("Priest insertion failed: " . $priest_qry->error);
            $priest_id = $cn->insert_id;

            // Auto-generate page_no, line_no, and book_no
            $last_baptism_sql = "SELECT page_no, line_no, book_no FROM baptism ORDER BY book_no DESC, page_no DESC, line_no DESC LIMIT 1";
            $last_baptism_qry = $cn->query($last_baptism_sql);
            $last_baptism = $last_baptism_qry->fetch_assoc();

            // Initialize values if no records exist
            if ($last_baptism) {
                $page_no = $last_baptism['page_no'];
                $line_no = $last_baptism['line_no'];
                $book_no = $last_baptism['book_no'];
            } else {
                // Start fresh
                $page_no = 1;
                $line_no = 0;
                $book_no = 1;
            }

            // Increment line_no for each new baptism record
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

            // Insert baptism record with page_no, line_no, and book_no
            $baptism_sql = "INSERT INTO baptism (person_id, baptism_date, priest_id, encoder, status, page_no, line_no, book_no) 
                            VALUES (?, ?, ?, ?, 'active', ?, ?, ?)";
            $baptism_qry = $cn->prepare($baptism_sql);
            $baptism_qry->bind_param("isisiii", $person_id, $data[0], $priest_id, $data[12], $page_no, $line_no, $book_no);
            if (!$baptism_qry->execute()) throw new Exception("Baptism insertion failed: " . $baptism_qry->error);

            // Commit transaction and close
            $cn->commit();
            $cn->close();
            return "Baptism record added successfully!";
        } catch (Exception $e) {
            // Rollback transaction in case of error
            $cn->rollback();
            $cn->close();
            return 'Error: ' . $e->getMessage();
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
        $qry = $cn->query($sql);
    
        while ($row = $qry->fetch_assoc()) {
            $data[] = $row; // Add each log entry to the array
        }
    
        $qry->close();
        $cn->close();
    
        return $data; // Return the logs
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
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $options = OPENSSL_RAW_DATA; // Use RAW_DATA for decryption as well
    
        // SQL query
        $sql = "SELECT 
                    p.person_id, p.first_name, p.middle_name, p.last_name, p.gender, p.dob, p.age, p.place_of_birth, p.address,
                    b.baptism_id, b.baptism_date, b.encoder, b.status,
                    pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name, pf.parent_address AS father_address,
                    pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name, pm.parent_address AS mother_address,
                    pf.marriage AS father_marriage,
                    pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
                FROM 
                    person p
                LEFT JOIN 
                    baptism b ON p.person_id = b.person_id
                LEFT JOIN 
                    parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
                LEFT JOIN 
                    parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
                LEFT JOIN 
                    priest pr ON b.person_id = pr.person_id
                ORDER BY 
                    b.created_at DESC";
    
        $qry = $cn->prepare($sql);
        if (!$qry) {
            throw new Exception("Prepare failed: " . $cn->error);
        }
    
        $qry->execute();
        $rs = $qry->get_result();
    
        while ($row = $rs->fetch_assoc()) {
            // Decrypt general data fields
            $decryptedData = [
                'first_name' => '',
                'middle_name' => '',
                'last_name' => '',
            ];
            foreach (['first_name', 'middle_name', 'last_name'] as $field) {
                $decryptedData[$field] = decryptData($row[$field], $cipher_algo, $key, $iv_length, $options);
            }

    
            // Decrypt parent fields
            $father_name = decryptData($row['father_first_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['father_middle_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['father_last_name'], $cipher_algo, $key, $iv_length, $options);
            $father_address = decryptData($row['father_address'], $cipher_algo, $key, $iv_length, $options);
            
            $mother_name = decryptData($row['mother_first_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['mother_middle_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['mother_last_name'], $cipher_algo, $key, $iv_length, $options);
            $mother_address = decryptData($row['mother_address'], $cipher_algo, $key, $iv_length, $options);
    
            // decrypt priest fields
            $priest_name = decryptData($row['priest_title'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['priest_fname'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['priest_mname'], $cipher_algo, $key, $iv_length, $options) . ' ' .
                           decryptData($row['priest_lname'], $cipher_algo, $key, $iv_length, $options);
    
            
            // Add the decrypted data to the array
            $data[$ctr] = [
                'person_id' => $row['person_id'],
                'first_name' => $decryptedData['first_name'],
                'middle_name' => $decryptedData['middle_name'],
                'last_name' => $decryptedData['last_name'],
                'gender' => $row['gender'], // Use the decrypted gender
                'dob' => $row['dob'],
                'age' => $row['age'],
                'place_of_birth' => $row['place_of_birth'],
                'baptism_id' => $row['baptism_id'],
                'baptism_date' => $row['baptism_date'],
                'priests' => $priest_name,
                'encoder' => $row['encoder'],
                'status' => $row['status'],
                'father_name' => $father_name,
                'father_address' => $father_address,
                'mother_name' => $mother_name,
                'mother_address' => $mother_address,
                'father_marriage' => $row['father_marriage']
            ];

            $ctr++;
        }
    
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
    
        // Main query to get baptism and person details
        $sql = "SELECT p.person_id, p.first_name, p.middle_name, p.last_name, p.gender, p.dob, p.age, p.place_of_birth, p.address,
                b.baptism_id, b.baptism_date, b.book_no, b.page_no, b.line_no, b.purpose, b.encoder, b.status,
                pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name, pf.parent_address AS father_address, pf.marriage AS marriage,
                pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name, pm.parent_address AS mother_address, 
                pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
                FROM person p
                LEFT JOIN baptism b ON p.person_id = b.person_id
                LEFT JOIN parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
                LEFT JOIN parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
                LEFT JOIN priest pr ON p.person_id = pr.person_id 
                WHERE b.baptism_id = ?";
    
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);
    
        if ($qry->execute()) {
            // Bind result variables
            $qry->bind_result(
                $person_id, $first_name, $middle_name, $last_name, $gender, $dob, $age, $place_of_birth, $address,
                $baptism_id, $baptism_date, $book_no, $page_no, $line_no, $purpose, $encoder, $status,
                $father_first_name, $father_middle_name, $father_last_name, $father_address, $marriage,
                $mother_first_name, $mother_middle_name, $mother_last_name, $mother_address, 
                $priest_title, $priest_fname, $priest_mname, $priest_lname
            );
    
            // Fetch the data
            if ($qry->fetch()) {
                // Decrypt fields as needed
                $data = array(
                    'person_id' => $person_id,
                    'first_name' => decryptData($first_name, $cipher_algo, $key, $iv_length, $options),
                    'middle_name' => decryptData($middle_name, $cipher_algo, $key, $iv_length, $options),
                    'last_name' => decryptData($last_name, $cipher_algo, $key, $iv_length, $options),
                    'gender' => $gender,
                    'dob' => $dob,
                    'age' => $age, // Assuming age does not need decryption
                    'place_of_birth' => decryptData($place_of_birth, $cipher_algo, $key, $iv_length, $options),
                    'address' => decryptData($address, $cipher_algo, $key, $iv_length, $options),
                    'baptism_id' => $baptism_id,
                    'baptism_date' => $baptism_date,
                    'book_no' => $book_no,
                    'page_no' => $page_no,
                    'line_no' => $line_no,
                    'purpose' => $purpose,
                    'encoder' => $encoder,
                    'status' => $status,
                    'father_first_name' => decryptData($father_first_name, $cipher_algo, $key, $iv_length, $options),
                    'father_middle_name' => decryptData($father_middle_name, $cipher_algo, $key, $iv_length, $options),
                    'father_last_name' => decryptData($father_last_name, $cipher_algo, $key, $iv_length, $options),
                    'father_address' => decryptData($father_address, $cipher_algo, $key, $iv_length, $options),
                    'marriage' => decryptData($marriage, $cipher_algo, $key, $iv_length, $options),
                    'mother_first_name' => decryptData($mother_first_name, $cipher_algo, $key, $iv_length, $options),
                    'mother_middle_name' => decryptData($mother_middle_name, $cipher_algo, $key, $iv_length, $options),
                    'mother_last_name' => decryptData($mother_last_name, $cipher_algo, $key, $iv_length, $options),
                    'mother_address' => decryptData($mother_address, $cipher_algo, $key, $iv_length, $options),
                    'priest_title' => decryptData($priest_title, $cipher_algo, $key, $iv_length, $options),
                    'priest_fname' => decryptData($priest_fname, $cipher_algo, $key, $iv_length, $options),
                    'priest_mname' => decryptData($priest_mname, $cipher_algo, $key, $iv_length, $options),
                    'priest_lname' => decryptData($priest_lname, $cipher_algo, $key, $iv_length, $options),
                );
            }
            $qry->free_result(); // Free the result set
        } else {
            echo "Error executing SQL query: " . $qry->error;
        }
    
        // Retrieve sponsors separately
        $sql_sponsors = "SELECT sponsor_first_name, sponsor_middle_name, sponsor_last_name, sponsor_address, relation 
                         FROM sponsor 
                         WHERE person_id = (SELECT person_id FROM baptism WHERE baptism_id = ?) 
                         AND sacrament = 'baptism'"; 
    
        $qry_sponsors = $cn->prepare($sql_sponsors);
        $qry_sponsors->bind_param("i", $id);
    
        $sponsors = array();
        if ($qry_sponsors->execute()) {
            $qry_sponsors->bind_result($sponsor_first_name, $sponsor_middle_name, $sponsor_last_name, $sponsor_address, $relation);
    
            while ($qry_sponsors->fetch()) {
                // Add sponsors to the array
                $sponsors[] = array(
                    'sponsor_first_name' => decryptData($sponsor_first_name, $cipher_algo, $key, $iv_length, $options),
                    'sponsor_middle_name' => decryptData($sponsor_middle_name, $cipher_algo, $key, $iv_length, $options),
                    'sponsor_last_name' => decryptData($sponsor_last_name, $cipher_algo, $key, $iv_length, $options),
                    'sponsor_address' => decryptData($sponsor_address, $cipher_algo, $key, $iv_length, $options),
                    'relation' => decryptData($relation, $cipher_algo, $key, $iv_length, $options)
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
        $baptism_date, $first_name, $middle_name, $last_name, $gender, $dob, $age,
        $place_of_birth, $address, $father_first_name, $father_middle_name, $father_last_name,
        $father_address, $marriage, $mother_first_name, $mother_middle_name, $mother_last_name,
        $mother_address, $priest_title, $priest_fname, $priest_mname, $priest_lname,
        $book_no, $page_no, $line_no, $purpose, $encoder, $baptism_id, $sponsors
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
            $encrypted_first_name = encryptData($first_name, $cipher_algo, $key, $iv_length);
            $encrypted_middle_name = encryptData($middle_name, $cipher_algo, $key, $iv_length);
            $encrypted_last_name = encryptData($last_name, $cipher_algo, $key, $iv_length);
            $encrypted_place_of_birth = encryptData($place_of_birth, $cipher_algo, $key, $iv_length);
            $encrypted_address = encryptData($address, $cipher_algo, $key, $iv_length);
    
            // Encrypt parents' names and addresses
            $encrypted_father_first_name = encryptData($father_first_name, $cipher_algo, $key, $iv_length);
            $encrypted_father_middle_name = encryptData($father_middle_name, $cipher_algo, $key, $iv_length);
            $encrypted_father_last_name = encryptData($father_last_name, $cipher_algo, $key, $iv_length);
            $encrypted_father_address = encryptData($father_address, $cipher_algo, $key, $iv_length);
            $encrypted_marriage = encryptData($marriage, $cipher_algo, $key, $iv_length);
            
            $encrypted_mother_first_name = encryptData($mother_first_name, $cipher_algo, $key, $iv_length);
            $encrypted_mother_middle_name = encryptData($mother_middle_name, $cipher_algo, $key, $iv_length);
            $encrypted_mother_last_name = encryptData($mother_last_name, $cipher_algo, $key, $iv_length);
            $encrypted_mother_address = encryptData($mother_address, $cipher_algo, $key, $iv_length);
    
            // Encrypt priest data
            $encrypted_priest_title = encryptData($priest_title, $cipher_algo, $key, $iv_length);
            $encrypted_priest_fname = encryptData($priest_fname, $cipher_algo, $key, $iv_length);
            $encrypted_priest_mname = encryptData($priest_mname, $cipher_algo, $key, $iv_length);
            $encrypted_priest_lname = encryptData($priest_lname, $cipher_algo, $key, $iv_length);
    
              // Check if the person already exists (excluding the current baptism_id)
        $check_person_sql = "
        SELECT p.first_name, p.middle_name, p.last_name 
        FROM person p
        JOIN baptism b ON p.person_id = b.person_id
        WHERE b.baptism_id != ?";
    $check_person_qry = $cn->prepare($check_person_sql);
    $check_person_qry->bind_param("i", $baptism_id);
    $check_person_qry->execute();
    $check_person_qry->store_result();
    
    // Fetch and decrypt names to check for duplicates
    $check_person_qry->bind_result($existing_encrypted_first_name, $existing_encrypted_middle_name, $existing_encrypted_last_name);
    while ($check_person_qry->fetch()) {
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
    
            // Update baptism and person details
            $update_sql = "UPDATE person p
                           JOIN baptism b ON p.person_id = b.person_id
                           JOIN parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
                           JOIN parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
                           JOIN priest pr ON p.person_id = pr.person_id
                           SET p.first_name = ?, p.middle_name = ?, p.last_name = ?, p.gender = ?, p.dob = ?, p.age = ?, p.place_of_birth = ?, p.address = ?,
                               b.baptism_date = ?, b.book_no = ?, b.page_no = ?, b.line_no = ?, b.purpose = ?, b.encoder = ?,
                               pf.parent_first_name = ?, pf.parent_middle_name = ?, pf.parent_last_name = ?, pf.parent_address = ?, pf.marriage = ?,
                               pm.parent_first_name = ?, pm.parent_middle_name = ?, pm.parent_last_name = ?, pm.parent_address = ?, pm.marriage = pf.marriage,
                               pr.priest_title = ?, pr.priest_fname = ?, pr.priest_mname = ?, pr.priest_lname = ?
                           WHERE b.baptism_id = ?";
    
            $qry = $cn->prepare($update_sql);
            if (!$qry) throw new Exception("Preparation failed: " . $cn->error);
    
            $qry->bind_param(
                "sssssssssssssssssssssssssssi",
                $encrypted_first_name, $encrypted_middle_name, $encrypted_last_name, $gender, $dob, $age, $encrypted_place_of_birth, $encrypted_address,
                $baptism_date, $book_no, $page_no, $line_no, $purpose, $encoder,
                $encrypted_father_first_name, $encrypted_father_middle_name, $encrypted_father_last_name, $encrypted_father_address, $encrypted_marriage,
                $encrypted_mother_first_name, $encrypted_mother_middle_name, $encrypted_mother_last_name, $encrypted_mother_address, 
                $encrypted_priest_title, $encrypted_priest_fname, $encrypted_priest_mname, $encrypted_priest_lname,
                $baptism_id
            );
    
            if (!$qry->execute()) throw new Exception("Execution failed: " . $qry->error);
    
            // Now, update the pm.marriage to the newly updated pf.marriage
            $update_pm_sql = "UPDATE parent pm
            JOIN parent pf ON pm.person_id = pf.person_id AND pf.relation = 'father'
            SET pm.marriage = pf.marriage
            WHERE pm.relation = 'mother' AND pf.relation = 'father'";
    
            $update_pm_qry = $cn->prepare($update_pm_sql);
            if (!$update_pm_qry) throw new Exception("Preparation failed: " . $cn->error);
    
            if (!$update_pm_qry->execute()) throw new Exception("Execution failed: " . $update_pm_qry->error);
    
           // Get the person_id for further operations
$person_id_result = $cn->query("SELECT person_id FROM baptism WHERE baptism_id = $baptism_id");
if ($person_id_result->num_rows == 0) throw new Exception("No person_id found for baptism_id: $baptism_id");

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
$insert_update_sql = "INSERT INTO sponsor (sponsor_id, sponsor_first_name, sponsor_middle_name, sponsor_last_name, sponsor_address, relation, sacrament, person_id)
                      VALUES (?, ?, ?, ?, ?, ?, 'baptism', ?)
                      ON DUPLICATE KEY UPDATE
                          sponsor_first_name = VALUES(sponsor_first_name),
                          sponsor_middle_name = VALUES(sponsor_middle_name),
                          sponsor_last_name = VALUES(sponsor_last_name),
                          sponsor_address = VALUES(sponsor_address),
                          relation = VALUES(relation)";
$insert_update_qry = $cn->prepare($insert_update_sql);
if (!$insert_update_qry) throw new Exception("Sponsor insert/update preparation failed: " . $cn->error);

foreach ($sponsors as $sponsor) {
    $sponsor_id = $sponsor['sponsor_id'] ?? null;

    // Encrypt sponsor data
    $encrypted_sponsor_first_name = encryptData($sponsor['sponsor_first_name'], $cipher_algo, $key, $iv_length);
    $encrypted_sponsor_middle_name = encryptData($sponsor['sponsor_middle_name'] ?? '', $cipher_algo, $key, $iv_length);
    $encrypted_sponsor_last_name = encryptData($sponsor['sponsor_last_name'] ?? '', $cipher_algo, $key, $iv_length);
    $encrypted_sponsor_address = encryptData($sponsor['sponsor_address'] ?? '', $cipher_algo, $key, $iv_length);
    $encrypted_relation = encryptData($sponsor['relation'] ?? '', $cipher_algo, $key, $iv_length);

    $insert_update_qry->bind_param(
        "isssssi", 
        $sponsor_id,
        $encrypted_sponsor_first_name, 
        $encrypted_sponsor_middle_name, 
        $encrypted_sponsor_last_name, 
        $encrypted_sponsor_address, 
        $encrypted_relation, 
        $person_id
    );

    if (!$insert_update_qry->execute()) throw new Exception("Sponsor insert/update execution failed: " . $insert_update_qry->error);
}

    
            // Log activity
            $this->logActivity($encoder, 'Updated baptism record: ' . $first_name . " " . $middle_name . " " . $last_name);
            $cn->commit();
            $cn->close();
            return 'Record successfully updated.';
    
        } catch (Exception $e) {
            $cn->rollback();
            $cn->close();
            return 'Failed to update record: ' . $e->getMessage();
        }
    }
    
    
    function generate() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        $data = array();
    
        // Encryption parameters
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY');
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $options = OPENSSL_RAW_DATA;
    
        // SQL query to retrieve baptism and person details
        $sql = "SELECT 
                p.person_id, p.first_name, p.middle_name, p.last_name, p.gender, p.dob, p.age, p.place_of_birth, p.address,
                b.baptism_id, b.baptism_date, b.book_no, b.page_no, b.line_no, b.purpose, b.encoder, b.status,
                pf.parent_first_name AS father_first_name, pf.parent_middle_name AS father_middle_name, pf.parent_last_name AS father_last_name, pf.parent_address AS father_address, pf.marriage AS marriage,
                pm.parent_first_name AS mother_first_name, pm.parent_middle_name AS mother_middle_name, pm.parent_last_name AS mother_last_name, pm.parent_address AS mother_address, 
                pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
            FROM 
                person p
            LEFT JOIN 
                baptism b ON p.person_id = b.person_id
            LEFT JOIN 
                parent pf ON p.person_id = pf.person_id AND pf.relation = 'father'
            LEFT JOIN 
                parent pm ON p.person_id = pm.person_id AND pm.relation = 'mother'
            LEFT JOIN 
                priest pr ON b.person_id = pr.person_id
            ORDER BY 
                b.created_at DESC";
    
        $qry = $cn->prepare($sql);
        if (!$qry) {
            throw new Exception("Prepare failed: " . $cn->error);
        }
    
        $qry->execute();
        $rs = $qry->get_result();
    
        while ($row = $rs->fetch_assoc()) {
            $person_id = $row['person_id'];
    
            // Decrypt fields
            $first_name = decryptData($row['first_name'], $cipher_algo, $key, $iv_length, $options);
            $middle_name = decryptData($row['middle_name'], $cipher_algo, $key, $iv_length, $options);
            $last_name = decryptData($row['last_name'], $cipher_algo, $key, $iv_length, $options);
            $place_of_birth = decryptData($row['place_of_birth'], $cipher_algo, $key, $iv_length, $options);
            $address = decryptData($row['address'], $cipher_algo, $key,  $iv_length, $options);
       

    // Decrypt parent fields
    $father_name = decryptData($row['father_first_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
    decryptData($row['father_middle_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
    decryptData($row['father_last_name'], $cipher_algo, $key, $iv_length, $options);
$father_address = decryptData($row['father_address'], $cipher_algo, $key, $iv_length, $options);

$mother_name = decryptData($row['mother_first_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
    decryptData($row['mother_middle_name'], $cipher_algo, $key, $iv_length, $options) . ' ' .
    decryptData($row['mother_last_name'], $cipher_algo, $key, $iv_length, $options);
$mother_address = decryptData($row['mother_address'], $cipher_algo, $key, $iv_length, $options);

 // decrypt priest fields
 $priest_name = decryptData($row['priest_title'], $cipher_algo, $key, $iv_length, $options) . ' ' .
 decryptData($row['priest_fname'], $cipher_algo, $key, $iv_length, $options) . ' ' .
 decryptData($row['priest_mname'], $cipher_algo, $key, $iv_length, $options) . ' ' .
 decryptData($row['priest_lname'], $cipher_algo, $key, $iv_length, $options);


            
            if (!isset($data[$person_id])) {
                $data[$person_id] = [
                    'person_id' => $row['person_id'],
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'gender' => $row['gender'],
                    'dob' => $row['dob'],
                    'age' => $row['age'],
                    'place_of_birth' => $place_of_birth,
                    'address' => $address,
                    'baptism_id' => $row['baptism_id'],
                    'baptism_date' => $row['baptism_date'],
                    'book_no' => $row['book_no'],
                    'page_no' => $row['page_no'],
                    'line_no' => $row['line_no'],
                    'purpose' => $row['purpose'],
                    'priests' => $priest_name,
                    'encoder' => $row['encoder'],
                    'status' => $row['status'],
                    'father_name' => $father_name,
                    'father_address' => $father_address,
                    'mother_name' => $mother_name,
                    'mother_address' => $mother_address,
                    'sponsors' => [] // Initialize empty sponsors array
                ];
            }
    
            // Decrypt sponsor data
            $sql_sponsors = "SELECT sponsor_first_name, sponsor_middle_name, sponsor_last_name, sponsor_address, relation 
                             FROM sponsor 
                             WHERE person_id = ? 
                             AND sacrament = 'baptism'"; 
    
            $qry_sponsors = $cn->prepare($sql_sponsors);
            if ($qry_sponsors) {
                $qry_sponsors->bind_param("i", $person_id);
                $qry_sponsors->execute();
                $qry_sponsors->bind_result($sponsor_first_name, $sponsor_middle_name, $sponsor_last_name, $sponsor_address, $relation);
    
                while ($qry_sponsors->fetch()) {
                    // Decrypt sponsor details
                    $sponsor_name = decryptData($sponsor_first_name, $cipher_algo, $key, $iv_length, $options) . ' ' .
                                    decryptData($sponsor_middle_name, $cipher_algo, $key, $iv_length, $options) . ' ' .
                                    decryptData($sponsor_last_name, $cipher_algo, $key, $iv_length, $options);
                    $sponsor_address = decryptData($sponsor_address, $cipher_algo, $key, $iv_length, $options);
    
                    // Add decrypted sponsor details to the person's sponsor array
                    $data[$person_id]['sponsors'][] = [
                        'sponsor_name' => $sponsor_name,
                        'sponsor_address' => $sponsor_address,
                        'relation' => $relation
                    ];
                }
    
                $qry_sponsors->close();
            } else {
                echo "Error preparing sponsor query: " . $cn->error;
            }
        }
    
        $qry->close();
        $cn->close();
    
        return $data;
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
            return false; // Or handle the case where the session is expired or not set
        }
    
        // Connect to the database
        $cn = $conn->connect(1);
        
        // Fetch the record details from the baptism table
        $fetchSql = "SELECT p.first_name, p.middle_name, p.last_name 
                     FROM baptism b
                     JOIN person p ON b.person_id = p.person_id
                     WHERE b.baptism_id = ?";
        $fetchQry = $cn->prepare($fetchSql);
        $fetchQry->bind_param("i", $id);
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
    
        // Update the record to set it as 'archived'
        $sql = "UPDATE baptism SET status = 'archived' WHERE baptism_id = ?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);
        
        if ($qry->execute()) {
            // Log the activity for archiving the record
            $this->logActivity($_SESSION['username'], 'Archived baptism record: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);
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
            return false; // Or handle the case where the session is expired or not set
        }
        
        // Connect to the database
        $cn = $conn->connect(1);
        
        // Fetch the record details from the baptism table
        $fetchSql = "SELECT p.first_name, p.middle_name, p.last_name 
                     FROM baptism b
                     JOIN person p ON b.person_id = p.person_id
                     WHERE b.baptism_id = ?";
        $fetchQry = $cn->prepare($fetchSql);
        $fetchQry->bind_param("i", $id);
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
        
        // Update the record to set it as 'active'
        $sql = "UPDATE baptism SET status = 'active' WHERE baptism_id = ?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);
        
        if ($qry->execute()) {
            // Log the activity for restoring the record
            $this->logActivity($_SESSION['username'], 'Restored baptism record: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);
            return true; // Successfully restored
        } else {
            return false; // Failed to restore
        }
    }
    
    
}        

?>