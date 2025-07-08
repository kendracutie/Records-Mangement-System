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
class Marriage {
       
    function insert($data) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        // Encryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
        $iv_length = openssl_cipher_iv_length($cipher_algo);
    
        // Begin transaction
        $cn->begin_transaction();
    
        try {
           // Step 1: Check if the groom with the same full name already exists
$check_person_sql = "SELECT first_name, middle_name, last_name FROM person WHERE sacrament = 'marriage'";
$check_person_qry = $cn->prepare($check_person_sql);
$check_person_qry->execute();
$check_person_qry->store_result();

// Bind results
$check_person_qry->bind_result($encrypted_first_name, $encrypted_middle_name, $encrypted_last_name);

// Check for groom
while ($check_person_qry->fetch()) {
    // Decrypt the names
    $decrypted_first_name = decryptData($encrypted_first_name, $cipher_algo, $key);
    $decrypted_middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key);
    $decrypted_last_name = decryptData($encrypted_last_name, $cipher_algo, $key);
    
    // Check if names match the groom
    if ($decrypted_first_name == $data[2] && $decrypted_middle_name == $data[3] && $decrypted_last_name == $data[4]) {
        $check_person_qry->close();
        $cn->close();
        return 'Groom with the same name already exists.';
    }
}

// Reset the query to check for the bride
$check_person_qry->execute(); // Execute again to reset results

// Check for bride
while ($check_person_qry->fetch()) {
    // Decrypt the names
    $decrypted_first_name = decryptData($encrypted_first_name, $cipher_algo, $key);
    $decrypted_middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key);
    $decrypted_last_name = decryptData($encrypted_last_name, $cipher_algo, $key);
    
    // Check if names match the bride
    if ($decrypted_first_name == $data[14] && $decrypted_middle_name == $data[15] && $decrypted_last_name == $data[16]) {
        $check_person_qry->close();
        $cn->close();
        return 'Bride with the same name already exists.';
    }
}

$check_person_qry->close();

    
           // Encrypt data for groom
$encrypted_groom_first_name = encryptData($data[2], $cipher_algo, $key, $iv_length);
$encrypted_groom_middle_name = encryptData($data[3], $cipher_algo, $key, $iv_length);
$encrypted_groom_last_name = encryptData($data[4], $cipher_algo, $key, $iv_length);

// Encrypt address for groom
$encrypted_groom_address = encryptData($data[6], $cipher_algo, $key, $iv_length); // Assuming address is in $data[6]

// Step 3: Insert the groom record with the sacrament_id
$groom_sql = "INSERT INTO person (first_name, middle_name, last_name, age, address, sacrament) VALUES (?, ?, ?, ?, ?, 'marriage')";
$groom_qry = $cn->prepare($groom_sql);
$groom_qry->bind_param("sssis", $encrypted_groom_first_name, $encrypted_groom_middle_name, $encrypted_groom_last_name, $data[5], $encrypted_groom_address);
if (!$groom_qry->execute()) {
    throw new Exception("Groom insertion failed: " . $groom_qry->error);
}
$groom_id = $cn->insert_id;

// Encrypt data for bride
$encrypted_bride_first_name = encryptData($data[14], $cipher_algo, $key, $iv_length);
$encrypted_bride_middle_name = encryptData($data[15], $cipher_algo, $key, $iv_length);
$encrypted_bride_last_name = encryptData($data[16], $cipher_algo, $key, $iv_length);

// Encrypt address for bride
$encrypted_bride_address = encryptData($data[18], $cipher_algo, $key, $iv_length); // Assuming address is in $data[18]

// Step 4: Insert the bride record with the sacrament_id
$bride_sql = "INSERT INTO person (first_name, middle_name, last_name, age, address, sacrament) VALUES (?, ?, ?, ?, ?, 'marriage')";
$bride_qry = $cn->prepare($bride_sql);
$bride_qry->bind_param("sssis", $encrypted_bride_first_name, $encrypted_bride_middle_name, $encrypted_bride_last_name, $data[17], $encrypted_bride_address);
if (!$bride_qry->execute()) {
    throw new Exception("Bride insertion failed: " . $bride_qry->error);
}
$bride_id = $cn->insert_id;

    
            // Step 5: Insert parent records for groom
$father_groom_first_name = encryptData($data[11], $cipher_algo, $key, $iv_length);
$father_groom_middle_name = encryptData($data[12], $cipher_algo, $key, $iv_length);
$father_groom_last_name = encryptData($data[13], $cipher_algo, $key, $iv_length);

$father_groom_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'father')";
$father_groom_qry = $cn->prepare($father_groom_sql);
$father_groom_qry->bind_param("isss", $groom_id, $father_groom_first_name, $father_groom_middle_name, $father_groom_last_name);
if (!$father_groom_qry->execute()) {
    throw new Exception("Groom's father insertion failed: " . $father_groom_qry->error);
}

$mother_groom_first_name = encryptData($data[8], $cipher_algo, $key, $iv_length);
$mother_groom_middle_name = encryptData($data[9], $cipher_algo, $key, $iv_length);
$mother_groom_last_name = encryptData($data[10], $cipher_algo, $key, $iv_length);

$mother_groom_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'mother')";
$mother_groom_qry = $cn->prepare($mother_groom_sql);
$mother_groom_qry->bind_param("isss", $groom_id, $mother_groom_first_name, $mother_groom_middle_name, $mother_groom_last_name);
if (!$mother_groom_qry->execute()) {
    throw new Exception("Groom's mother insertion failed: " . $mother_groom_qry->error);
}

// Step 6: Insert parent records for bride
$father_bride_first_name = encryptData($data[23], $cipher_algo, $key, $iv_length);
$father_bride_middle_name = encryptData($data[24], $cipher_algo, $key, $iv_length);
$father_bride_last_name = encryptData($data[25], $cipher_algo, $key, $iv_length);

$father_bride_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'father')";
$father_bride_qry = $cn->prepare($father_bride_sql);
$father_bride_qry->bind_param("isss", $bride_id, $father_bride_first_name, $father_bride_middle_name, $father_bride_last_name);
if (!$father_bride_qry->execute()) {
    throw new Exception("Bride's father insertion failed: " . $father_bride_qry->error);
}

$mother_bride_first_name = encryptData($data[20], $cipher_algo, $key, $iv_length);
$mother_bride_middle_name = encryptData($data[21], $cipher_algo, $key, $iv_length);
$mother_bride_last_name = encryptData($data[22], $cipher_algo, $key, $iv_length);

$mother_bride_sql = "INSERT INTO parent (person_id, parent_first_name, parent_middle_name, parent_last_name, relation) VALUES (?, ?, ?, ?, 'mother')";
$mother_bride_qry = $cn->prepare($mother_bride_sql);
$mother_bride_qry->bind_param("isss", $bride_id, $mother_bride_first_name, $mother_bride_middle_name, $mother_bride_last_name);
if (!$mother_bride_qry->execute()) {
    throw new Exception("Bride's mother insertion failed: " . $mother_bride_qry->error);
}
    
            // Step 7: Insert priest and associate with the groom and bride (using their person_id)
$priest_title = encryptData($data[26], $cipher_algo, $key, $iv_length);
$priest_first_name = encryptData($data[27], $cipher_algo, $key, $iv_length);
$priest_middle_name = encryptData($data[28], $cipher_algo, $key, $iv_length);
$priest_last_name = encryptData($data[29], $cipher_algo, $key, $iv_length);

$priest_sql = "INSERT INTO priest (person_id, priest_title, priest_fname, priest_mname, priest_lname) VALUES (?, ?, ?, ?, ?)";
$priest_qry = $cn->prepare($priest_sql);

// For groom
$priest_qry->bind_param("issss", $groom_id, $priest_title, $priest_first_name, $priest_middle_name, $priest_last_name);
if (!$priest_qry->execute()) {
    throw new Exception("Priest (for groom) insertion failed: " . $priest_qry->error);
}

// For bride
$priest_qry->bind_param("issss", $bride_id, $priest_title, $priest_first_name, $priest_middle_name, $priest_last_name);
if (!$priest_qry->execute()) {
    throw new Exception("Priest (for bride) insertion failed: " . $priest_qry->error);
}
    
            // Optionally get the last inserted priest_id if needed for further operations
            $priest_id = $cn->insert_id;
    
            // Step 8: Insert into marriage table
            $marriage_sql = "INSERT INTO marriage (groom_id, bride_id, registration_date, marriage_date, priest_id, encoder, status, person_id, groom_photo, bride_photo) VALUES (?, ?, ?, ?, ?, ?, 'active', ?, ?, ?)";
            $marriage_qry = $cn->prepare($marriage_sql);
            $marriage_qry->bind_param("iissisiss", $groom_id, $bride_id, $data[0], $data[1], $priest_id, $data[30], $groom_id, $data[7], $data[19]);
            if (!$marriage_qry->execute()) {
                throw new Exception("Marriage insertion failed: " . $marriage_qry->error);
            }
    
            // Insert sponsor details if provided
            if (isset($_POST['sponsor_first_name'], $_POST['sponsor_middle_name'], $_POST['sponsor_last_name'], $_POST['relation'])) {
                $sponsors = [
                    'sponsor_first_name' => $_POST['sponsor_first_name'],
                    'sponsor_middle_name' => $_POST['sponsor_middle_name'],
                    'sponsor_last_name' => $_POST['sponsor_last_name'],
                    'relation' => $_POST['relation']
                ];
    
                $sponsor_sql = "INSERT INTO sponsor (person_id, sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation, sacrament) VALUES (?, ?, ?, ?, ?, 'marriage')";
                $sponsor_qry = $cn->prepare($sponsor_sql);
                if (!$sponsor_qry) {
                    throw new Exception("Sponsor preparation failed: " . $cn->error);
                }
    
                foreach ($sponsors['sponsor_first_name'] as $i => $sponsor_first_name) {
                    $sponsor_middle_name = $sponsors['sponsor_middle_name'][$i] ?? '';
                    $sponsor_last_name = $sponsors['sponsor_last_name'][$i] ?? '';
                    $sponsor_relation = $sponsors['relation'][$i] ?? '';
                
                    // Encrypt sponsor names
                    $encrypted_sponsor_first_name = encryptData($sponsor_first_name, $cipher_algo, $key, $iv_length);
                    $encrypted_sponsor_middle_name = encryptData($sponsor_middle_name, $cipher_algo, $key, $iv_length);
                    $encrypted_sponsor_last_name = encryptData($sponsor_last_name, $cipher_algo, $key, $iv_length);
                    $encrypted_sponsor_relation = encryptData($sponsor_relation, $cipher_algo, $key, $iv_length);
                
                    $sponsor_qry->bind_param("issss", $groom_id, $encrypted_sponsor_first_name, $encrypted_sponsor_middle_name, $encrypted_sponsor_last_name, $encrypted_sponsor_relation);
                    if (!$sponsor_qry->execute()) {
                        throw new Exception("Sponsor insertion failed: " . $sponsor_qry->error);
                    }
                }
            }                
    
            $this->logActivity($_SESSION['username'], 'Added new marriage record: ' . $data[2] . ' ' . $data[3] . ' ' . $data[4] . ' & ' . $data[14] . ' ' . $data[15] . ' ' . $data[16]);
    
            // Commit transaction
            $cn->commit();
            $cn->close();
            return 'Marriage record successfully added.';
        } catch (Exception $e) {
            // Rollback transaction
            $cn->rollback();
            $cn->close();
            return 'Failed to add marriage record: ' . $e->getMessage();
        }
    }
    
    // Define the encryptData function
    function encryptData($data, $cipher_algo, $key) {
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted_data = openssl_encrypt($data, $cipher_algo, $key, 0, $iv);
        return base64_encode($iv . $encrypted_data); // Prepend IV to the encrypted data
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

function getCouple() {
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
    // SQL query to retrieve marriage records with groom, bride, parents, and priest details
    $sql = "SELECT 
                groom.person_id AS groom_id, groom.first_name AS groom_first_name, groom.middle_name AS groom_middle_name, groom.last_name AS groom_last_name, groom.age AS groom_age, groom.address AS groom_address,
                bride.person_id AS bride_id, bride.first_name AS bride_first_name, bride.middle_name AS bride_middle_name, bride.last_name AS bride_last_name, bride.age AS bride_age, bride.address AS bride_address,
                m.marriage_id, m.registration_date, m.marriage_date, m.encoder, m.status, m.groom_photo, m.bride_photo,
                CONCAT(fg.parent_first_name, ' ', fg.parent_middle_name, ' ', fg.parent_last_name) AS groom_father_name,
                CONCAT(mg.parent_first_name, ' ', mg.parent_middle_name, ' ', mg.parent_last_name) AS groom_mother_name,
                CONCAT(fb.parent_first_name, ' ', fb.parent_middle_name, ' ', fb.parent_last_name) AS bride_father_name,
                CONCAT(mb.parent_first_name, ' ', mb.parent_middle_name, ' ', mb.parent_last_name) AS bride_mother_name,
                pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
            FROM 
                marriage m
            LEFT JOIN 
                person groom ON m.groom_id = groom.person_id
            LEFT JOIN 
                person bride ON m.bride_id = bride.person_id
            LEFT JOIN 
                parent fg ON groom.person_id = fg.person_id AND fg.relation = 'father'
            LEFT JOIN 
                parent mg ON groom.person_id = mg.person_id AND mg.relation = 'mother'
            LEFT JOIN 
                parent fb ON bride.person_id = fb.person_id AND fb.relation = 'father'
            LEFT JOIN 
                parent mb ON bride.person_id = mb.person_id AND mb.relation = 'mother'
            LEFT JOIN 
                priest pr ON m.priest_id = pr.priest_id
            ORDER BY 
                m.created_at DESC";

    $qry = $cn->prepare($sql);
    if ($qry === false) {
        die("Error in preparing statement: " . $cn->error);
    }
    $qry->execute();
    $qry->bind_result(
        $groom_id, $groom_first_name, $groom_middle_name, $groom_last_name, $groom_age, $groom_address,
        $bride_id, $bride_first_name, $bride_middle_name, $bride_last_name, $bride_age, $bride_address,
        $marriage_id, $registration_date, $marriage_date, $encoder, $status, $groom_photo, $bride_photo,
        $groom_father_name, $groom_mother_name, $bride_father_name, $bride_mother_name, $priest_title, $priest_first_name, $priest_middle_name, $priest_last_name
    );
while ($qry->fetch()) {
    // Decrypt groom data
    $data[$ctr]['groom_id'] = $groom_id;
    $data[$ctr]['groom_first_name'] = decryptData($groom_first_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['groom_middle_name'] = decryptData($groom_middle_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['groom_last_name'] = decryptData($groom_last_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['groom_age'] = $groom_age;
    $data[$ctr]['groom_address'] = decryptData($groom_address, $cipher_algo, $key, $iv_length);

    // Decrypt bride data
    $data[$ctr]['bride_id'] = $bride_id;
    $data[$ctr]['bride_first_name'] = decryptData($bride_first_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['bride_middle_name'] = decryptData($bride_middle_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['bride_last_name'] = decryptData($bride_last_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['bride_age'] = $bride_age;
    $data[$ctr]['bride_address'] = decryptData($bride_address, $cipher_algo, $key, $iv_length);

    // Marriage and other data
    $data[$ctr]['marriage_id'] = $marriage_id;
    $data[$ctr]['registration_date'] = $registration_date;
    $data[$ctr]['marriage_date'] = $marriage_date;
    $data[$ctr]['encoder'] = $encoder;
    $data[$ctr]['status'] = $status;
    $data[$ctr]['groom_photo'] = $groom_photo; // Assuming photo is not encrypted
    $data[$ctr]['bride_photo'] = $bride_photo; // Assuming photo is not encrypted

    // Decrypt parents' names
    $data[$ctr]['groom_father_name'] = decryptData($groom_father_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['groom_mother_name'] = decryptData($groom_mother_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['bride_father_name'] = decryptData($bride_father_name, $cipher_algo, $key, $iv_length);
    $data[$ctr]['bride_mother_name'] = decryptData($bride_mother_name, $cipher_algo, $key, $iv_length);

    // Decrypt each component of the priest's name and concatenate
    $priest_title = decryptData($priest_title, $cipher_algo, $key, $iv_length);
    $priest_first_name = decryptData($priest_first_name, $cipher_algo, $key, $iv_length);
    $priest_middle_name = decryptData($priest_middle_name, $cipher_algo, $key, $iv_length);
    $priest_last_name = decryptData($priest_last_name, $cipher_algo, $key, $iv_length);
    
    // Concatenate the decrypted priest's full name
    $data[$ctr]['priests'] = trim("$priest_title $priest_first_name $priest_middle_name $priest_last_name");

    $ctr++;
}


    // Close the prepared statement and database connection
    $qry->close();
    $cn->close();

    return $data;
}


    function getcoupleone($id) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
        
        // Initialize data array
        $data = array();

        
        // Decryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the key
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $options = OPENSSL_RAW_DATA; // Use RAW_DATA for decryption as well
        
        // Updated SQL query
        $sql = "SELECT 
            m.marriage_id, m.registration_date, m.marriage_date, m.encoder, m.status, m.groom_photo, m.bride_photo,
            p1.person_id AS groom_person_id, p1.first_name AS groom_first_name, p1.middle_name AS groom_middle_name, p1.last_name AS groom_last_name, p1.age AS groom_age, p1.address AS groom_address,
            pf1.parent_first_name AS father_groom_first_name, pf1.parent_middle_name AS father_groom_middle_name, pf1.parent_last_name AS father_groom_last_name,
            pm1.parent_first_name AS mother_groom_first_name, pm1.parent_middle_name AS mother_groom_middle_name, pm1.parent_last_name AS mother_groom_last_name,
            p2.person_id AS bride_person_id, p2.first_name AS bride_first_name, p2.middle_name AS bride_middle_name, p2.last_name AS bride_last_name,
            p2.age AS bride_age, p2.address AS bride_address,
            pf2.parent_first_name AS father_bride_first_name, pf2.parent_middle_name AS father_bride_middle_name, pf2.parent_last_name AS father_bride_last_name,
            pm2.parent_first_name AS mother_bride_first_name, pm2.parent_middle_name AS mother_bride_middle_name, pm2.parent_last_name AS mother_bride_last_name,
            pr.priest_title, pr.priest_fname, pr.priest_mname, pr.priest_lname
        FROM marriage m
        JOIN person p1 ON m.groom_id = p1.person_id
        LEFT JOIN parent pf1 ON p1.person_id = pf1.person_id AND pf1.relation = 'father'
        LEFT JOIN parent pm1 ON p1.person_id = pm1.person_id AND pm1.relation = 'mother'
        JOIN person p2 ON m.bride_id = p2.person_id
        LEFT JOIN parent pf2 ON p2.person_id = pf2.person_id AND pf2.relation = 'father'
        LEFT JOIN parent pm2 ON p2.person_id = pm2.person_id AND pm2.relation = 'mother'
        LEFT JOIN priest pr ON m.priest_id = pr.priest_id
        WHERE m.marriage_id = ?";
        
        // Prepare statement
        $qry = $cn->prepare($sql);
        $qry->bind_param('i', $id);
        
        // Execute and bind result
        if ($qry->execute()) {
            // Match these variables with the columns in your SQL query
            $qry->bind_result(
                $marriage_id, $registration_date, $marriage_date, $encoder, $status, $groom_photo, $bride_photo,
                $groom_person_id, $groom_first_name, $groom_middle_name, $groom_last_name, $groom_age, $groom_address,
                $father_groom_first_name, $father_groom_middle_name, $father_groom_last_name,
                $mother_groom_first_name, $mother_groom_middle_name, $mother_groom_last_name,
                $bride_person_id, $bride_first_name, $bride_middle_name, $bride_last_name, 
                $bride_age, $bride_address,
                $father_bride_first_name, $father_bride_middle_name, $father_bride_last_name,
                $mother_bride_first_name, $mother_bride_middle_name, $mother_bride_last_name,
                $priest_title, $priest_fname, $priest_mname, $priest_lname
            );
            
            if ($qry->fetch()) {
                // Decrypt each field using decryptData function
                $data = array(
                    'marriage_id' => $marriage_id,
                    'registration_date' => $registration_date,
                    'marriage_date' => $marriage_date,
                    'groom_person_id' => $groom_person_id,
                    'groom_first_name' => decryptData($groom_first_name, $cipher_algo, $key),
                    'groom_middle_name' => decryptData($groom_middle_name, $cipher_algo, $key),
                    'groom_last_name' => decryptData($groom_last_name, $cipher_algo, $key),
                    'groom_age' => $groom_age,
                    'groom_address' => decryptData($groom_address, $cipher_algo, $key),
                    'groom_father_first_name' => decryptData($father_groom_first_name, $cipher_algo, $key),
                    'groom_father_middle_name' => decryptData($father_groom_middle_name, $cipher_algo, $key),
                    'groom_father_last_name' => decryptData($father_groom_last_name, $cipher_algo, $key),
                    'groom_mother_first_name' => decryptData($mother_groom_first_name, $cipher_algo, $key),
                    'groom_mother_middle_name' => decryptData($mother_groom_middle_name, $cipher_algo, $key),
                    'groom_mother_last_name' => decryptData($mother_groom_last_name, $cipher_algo, $key),
                    'bride_person_id' => $bride_person_id,
                    'bride_first_name' => decryptData($bride_first_name, $cipher_algo, $key),
                    'bride_middle_name' => decryptData($bride_middle_name, $cipher_algo, $key),
                    'bride_last_name' => decryptData($bride_last_name, $cipher_algo, $key),
                    'bride_age' => $bride_age,
                    'bride_address' => decryptData($bride_address, $cipher_algo, $key),
                    'bride_father_first_name' => decryptData($father_bride_first_name, $cipher_algo, $key),
                    'bride_father_middle_name' => decryptData($father_bride_middle_name, $cipher_algo, $key),
                    'bride_father_last_name' => decryptData($father_bride_last_name, $cipher_algo, $key),
                    'bride_mother_first_name' => decryptData($mother_bride_first_name, $cipher_algo, $key),
                    'bride_mother_middle_name' => decryptData($mother_bride_middle_name, $cipher_algo, $key),
                    'bride_mother_last_name' => decryptData($mother_bride_last_name, $cipher_algo, $key),
                    'priest_title' => decryptData($priest_title, $cipher_algo, $key),
                    'priest_fname' => decryptData($priest_fname, $cipher_algo, $key),
                    'priest_mname' => decryptData($priest_mname, $cipher_algo, $key),
                    'priest_lname' => decryptData($priest_lname, $cipher_algo, $key),
                    'encoder' => decryptData($encoder, $cipher_algo, $key),
                    'groom_photo' => $groom_photo,
                    'bride_photo' => $bride_photo,
                    'status' => $status
                );
            } else {
                error_log("No records fetched for marriage_id: $id");
            }
        } else {
            error_log("Error executing SQL query: " . $qry->error);
        }
            
        $qry->close();
            
        // Retrieve sponsors
        $sql_sponsors = "SELECT sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation 
                         FROM sponsor 
                         WHERE person_id IN (
                             SELECT groom_id FROM marriage WHERE marriage_id = ? 
                             UNION 
                             SELECT bride_id FROM marriage WHERE marriage_id = ?
                         ) AND sacrament = 'marriage'";
    
        $qry_sponsors = $cn->prepare($sql_sponsors);
        $qry_sponsors->bind_param("ii", $id, $id);
    
        if ($qry_sponsors->execute()) {
            $qry_sponsors->bind_result($sponsor_first_name, $sponsor_middle_name, $sponsor_last_name, $relation);
    
            $sponsors = array();
            while ($qry_sponsors->fetch()) {
                $sponsors[] = array(
                    'sponsor_first_name' => decryptData($sponsor_first_name, $cipher_algo, $key),
                    'sponsor_middle_name' => decryptData($sponsor_middle_name, $cipher_algo, $key),
                    'sponsor_last_name' => decryptData($sponsor_last_name, $cipher_algo, $key),
                    'relation' => decryptData($relation, $cipher_algo, $key),
                );
            }
        } else {
            error_log("Error executing SQL query for sponsors: " . $qry_sponsors->error);
        }
    
        $data['sponsors'] = !empty($sponsors) ? $sponsors : [];
        $qry_sponsors->close();
        $cn->close();
    
        return $data;
    }

    
    function updateMarriage(
        $groom_first_name, $groom_middle_name, $groom_last_name, $groom_age, $groom_address,
        $father_groom_first_name, $father_groom_middle_name, $father_groom_last_name,
        $mother_groom_first_name, $mother_groom_middle_name, $mother_groom_last_name,
        $bride_first_name, $bride_middle_name, $bride_last_name, $bride_age, $bride_address,
        $father_bride_first_name, $father_bride_middle_name, $father_bride_last_name,
        $mother_bride_first_name, $mother_bride_middle_name, $mother_bride_last_name,
        $marriage_date, $registration_date, $encoder, $marriage_id, $priest_title, $priest_fname, $priest_mname, $priest_lname,
        $sponsors, $groom_photo_name, $bride_photo_name
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
            // Check if the marriage record already exists (excluding the current marriage_id)
            $check_marriage_sql = "
            SELECT groom.first_name, groom.middle_name, groom.last_name, 
                   bride.first_name, bride.middle_name, bride.last_name 
            FROM marriage m
            JOIN person groom ON m.groom_id = groom.person_id
            JOIN person bride ON m.bride_id = bride.person_id
            WHERE m.marriage_id != ?";
            
            $check_marriage_qry = $cn->prepare($check_marriage_sql);
            if (!$check_marriage_qry) {
                error_log("Preparation failed: " . $cn->error);
                echo "<script>
                    showAlert('We encountered an issue while checking for duplicates. Please try again later.', '', 'error');
                </script>";
                return false; // Exit if the query preparation fails
            }

            // Bind the current marriage_id to exclude it from the check
            $check_marriage_qry->bind_param("i", $marriage_id);
            $check_marriage_qry->execute();
            $check_marriage_qry->store_result();

            // Fetch existing names to check for duplicates
            $check_marriage_qry->bind_result(
                $existing_encrypted_groom_first_name, 
                $existing_encrypted_groom_middle_name, 
                $existing_encrypted_groom_last_name,
                $existing_encrypted_bride_first_name, 
                $existing_encrypted_bride_middle_name, 
                $existing_encrypted_bride_last_name
            );

            // Loop through the results to decrypt and check for duplicates
            while ($check_marriage_qry->fetch()) {
                // Decrypt groom's names
                $decrypted_groom_first_name = decryptData($existing_encrypted_groom_first_name, $cipher_algo, $key);
                $decrypted_groom_middle_name = decryptData($existing_encrypted_groom_middle_name, $cipher_algo, $key);
                $decrypted_groom_last_name = decryptData($existing_encrypted_groom_last_name, $cipher_algo, $key);

                // Decrypt bride's names
                $decrypted_bride_first_name = decryptData($existing_encrypted_bride_first_name, $cipher_algo, $key);
                $decrypted_bride_middle_name = decryptData($existing_encrypted_bride_middle_name, $cipher_algo, $key);
                $decrypted_bride_last_name = decryptData($existing_encrypted_bride_last_name, $cipher_algo, $key);

                // Log decrypted names for debugging
                error_log("Checking against decrypted groom: $decrypted_groom_first_name $decrypted_groom_middle_name $decrypted_groom_last_name");
                error_log("Checking against decrypted bride: $decrypted_bride_first_name $decrypted_bride_middle_name $decrypted_bride_last_name");

                // Check if names match
                if (
                    ($decrypted_groom_first_name == $groom_first_name &&
                     $decrypted_groom_middle_name == $groom_middle_name &&
                     $decrypted_groom_last_name == $groom_last_name) ||
                    ($decrypted_bride_first_name == $bride_first_name &&
                     $decrypted_bride_middle_name == $bride_middle_name &&
                     $decrypted_bride_last_name == $bride_last_name)
                ) {
                 
                    // Alert the user if a match is found
                    echo "<script>
                        showAlert('A marriage with the same groom or bride already exists.', '', 'warning');
                        setTimeout(function() { window.location.href='../marriage'; }, 2000);
                    </script>";

                    // Close the query and rollback the transaction
                    $check_marriage_qry->close();
                    $cn->rollback();
                    $cn->close();
                    return false;
                }
            }

            // Close the check marriage query
            $check_marriage_qry->close();
                    // Encrypting groom's and bride's information
         // Step 2: Encrypting groom's and bride's information
         $encrypted_groom_first_name = encryptData($groom_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_middle_name = encryptData($groom_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_last_name = encryptData($groom_last_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_address = encryptData($groom_address, $cipher_algo, $key, $iv_length);
 
         $encrypted_groom_father_first_name = encryptData($father_groom_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_father_middle_name = encryptData($father_groom_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_father_last_name = encryptData($father_groom_last_name, $cipher_algo, $key, $iv_length);
 
         $encrypted_groom_mother_first_name = encryptData($mother_groom_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_mother_middle_name = encryptData($mother_groom_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_groom_mother_last_name = encryptData($mother_groom_last_name, $cipher_algo, $key, $iv_length);
 
         $encrypted_bride_first_name = encryptData($bride_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_middle_name = encryptData($bride_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_last_name = encryptData($bride_last_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_address = encryptData($bride_address, $cipher_algo, $key, $iv_length);
 
         $encrypted_bride_father_first_name = encryptData($father_bride_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_father_middle_name = encryptData($father_bride_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_father_last_name = encryptData($father_bride_last_name, $cipher_algo, $key, $iv_length);
 
         $encrypted_bride_mother_first_name = encryptData($mother_bride_first_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_mother_middle_name = encryptData($mother_bride_middle_name, $cipher_algo, $key, $iv_length);
         $encrypted_bride_mother_last_name = encryptData($mother_bride_last_name, $cipher_algo, $key, $iv_length);
 
         $encrypted_priest_title = encryptData($priest_title, $cipher_algo, $key, $iv_length);
         $encrypted_priest_fname = encryptData($priest_fname, $cipher_algo, $key, $iv_length);
         $encrypted_priest_mname = encryptData($priest_mname, $cipher_algo, $key, $iv_length);
         $encrypted_priest_lname = encryptData($priest_lname, $cipher_algo, $key, $iv_length);
 

            
           // SQL query to update marriage, groom, bride, and their parents details
$update_sql = "UPDATE marriage m
JOIN person groom ON m.groom_id = groom.person_id
JOIN person bride ON m.bride_id = bride.person_id
JOIN parent groom_father ON groom.person_id = groom_father.person_id AND groom_father.relation = 'father'
JOIN parent groom_mother ON groom.person_id = groom_mother.person_id AND groom_mother.relation = 'mother'
JOIN parent bride_father ON bride.person_id = bride_father.person_id AND bride_father.relation = 'father'
JOIN parent bride_mother ON bride.person_id = bride_mother.person_id AND bride_mother.relation = 'mother'
JOIN priest pr ON m.priest_id = pr.priest_id
SET groom.first_name = ?, groom.middle_name = ?, groom.last_name = ?, groom.age = ?, groom.address = ?, 
    groom_father.parent_first_name = ?, groom_father.parent_middle_name = ?, groom_father.parent_last_name = ?,
    groom_mother.parent_first_name = ?, groom_mother.parent_middle_name = ?, groom_mother.parent_last_name = ?,
    bride.first_name = ?, bride.middle_name = ?, bride.last_name = ?, bride.age = ?, bride.address = ?,   
    bride_father.parent_first_name = ?, bride_father.parent_middle_name = ?, bride_father.parent_last_name = ?,
    bride_mother.parent_first_name = ?, bride_mother.parent_middle_name = ?, bride_mother.parent_last_name = ?,
    m.marriage_date = ?, m.registration_date = ?, m.encoder = ?, m.groom_photo = ?, m.bride_photo = ?, 
    pr.priest_title = ?, pr.priest_fname = ?, pr.priest_mname = ?, pr.priest_lname = ?
WHERE m.marriage_id = ?";

$qry = $cn->prepare($update_sql);
if (!$qry) {
    throw new Exception("Preparation failed: " . $cn->error);
}

// Binding the encrypted parameters
$qry->bind_param("sssssssssssssssssssssssssssssssi",
    $encrypted_groom_first_name, $encrypted_groom_middle_name, $encrypted_groom_last_name, $groom_age, $encrypted_groom_address,
    $encrypted_groom_father_first_name, $encrypted_groom_father_middle_name, $encrypted_groom_father_last_name,
    $encrypted_groom_mother_first_name, $encrypted_groom_mother_middle_name, $encrypted_groom_mother_last_name,
    $encrypted_bride_first_name, $encrypted_bride_middle_name, $encrypted_bride_last_name, $bride_age, $encrypted_bride_address,
    $encrypted_bride_father_first_name, $encrypted_bride_father_middle_name, $encrypted_bride_father_last_name,
    $encrypted_bride_mother_first_name, $encrypted_bride_mother_middle_name, $encrypted_bride_mother_last_name,
    $marriage_date, $registration_date, $encoder, $groom_photo_name, $bride_photo_name,
    $encrypted_priest_title, $encrypted_priest_fname, $encrypted_priest_mname, $encrypted_priest_lname,
    $marriage_id
);

$qry->execute();
$qry->close();

            
            // Get the groom_id and bride_id for further operations
            $person_id_result = $cn->query("SELECT groom_id, bride_id FROM marriage WHERE marriage_id = $marriage_id");
            if (!$person_id_result) {
                throw new Exception("Failed to fetch groom and bride IDs: " . $cn->error);
            }
            
            if ($person_id_result->num_rows == 0) {
                throw new Exception("No groom and bride IDs found for marriage_id: $marriage_id");
            }
            
            $ids = $person_id_result->fetch_assoc();
            $groom_id = $ids['groom_id'];
            $bride_id = $ids['bride_id'];
            
            // 1. Delete old sponsors that are not in the updated list
            $existing_sponsor_ids_result = $cn->query("SELECT sponsor_id FROM sponsor WHERE person_id = $groom_id OR person_id = $bride_id");
            if (!$existing_sponsor_ids_result) {
                throw new Exception("Failed to get existing sponsor IDs: " . $cn->error);
            }
            
            $existing_sponsor_ids = [];
            while ($row = $existing_sponsor_ids_result->fetch_assoc()) {
                $existing_sponsor_ids[] = $row['sponsor_id'];
            }
            
            // Get the sponsor IDs to be deleted
            $existing_sponsor_ids_to_delete = array_diff($existing_sponsor_ids, array_column($sponsors, 'sponsor_id'));
            if (!empty($existing_sponsor_ids_to_delete)) {
                $delete_sql = "DELETE FROM sponsor WHERE person_id IN (?, ?) AND sponsor_id IN (" . implode(',', array_fill(0, count($existing_sponsor_ids_to_delete), '?')) . ")";
                $delete_qry = $cn->prepare($delete_sql);
                if (!$delete_qry) {
                    throw new Exception("Sponsor delete preparation failed: " . $cn->error);
                }
                
                // Create dynamic parameter binding for deletion
                $delete_params = array_merge([$groom_id, $bride_id], $existing_sponsor_ids_to_delete);
                $delete_qry->bind_param(str_repeat('i', count($delete_params)), ...$delete_params);
                
                if (!$delete_qry->execute()) {
                    throw new Exception("Sponsor delete execution failed: " . $delete_qry->error);
                }
            }
            
            // 2. Insert or update sponsors
            $insert_update_sql = "INSERT INTO sponsor (sponsor_id, sponsor_first_name, sponsor_middle_name, sponsor_last_name, relation, sacrament, person_id)
                                  VALUES (?, ?, ?, ?, ?, 'marriage' ,?)
                                  ON DUPLICATE KEY UPDATE
                                      sponsor_first_name = VALUES(sponsor_first_name),
                                      sponsor_middle_name = VALUES(sponsor_middle_name),
                                      sponsor_last_name = VALUES(sponsor_last_name),
                                      relation = VALUES(relation)";
            
            $insert_update_qry = $cn->prepare($insert_update_sql);
            if (!$insert_update_qry) {
                throw new Exception("Sponsor insert/update preparation failed: " . $cn->error);
            }
            
            foreach ($sponsors as $sponsor) {
                $sponsor_id = $sponsor['sponsor_id'] ?? null;
                 // Determine the person_id value for this sponsor
                 $person_id = (isset($sponsor['person_id']) && $sponsor['person_id'] == $groom_id) ? $groom_id : $bride_id;
                
                      // Encrypt sponsor data
                $encrypted_sponsor_first_name = encryptData($sponsor['sponsor_first_name'], $cipher_algo, $key, $iv_length);
                $encrypted_sponsor_middle_name = encryptData($sponsor['sponsor_middle_name'] ?? '', $cipher_algo, $key, $iv_length);
                $encrypted_sponsor_last_name = encryptData($sponsor['sponsor_last_name'] ?? '', $cipher_algo, $key, $iv_length);
                $encrypted_relation = encryptData($sponsor['relation'] ?? '', $cipher_algo, $key, $iv_length);

                $insert_update_qry->bind_param(
                    "isssss", 
                    $sponsor_id,
                    $encrypted_sponsor_first_name, 
                    $encrypted_sponsor_middle_name, 
                    $encrypted_sponsor_last_name, 
                    $encrypted_relation, 
                    $person_id
                );
    
                if (!$insert_update_qry->execute()) {
                    throw new Exception("Sponsor insert/update execution failed: " . $insert_update_qry->error);
                }
            }
            $this->logActivity($_SESSION['username'], 'Updated marriage record: ' . $groom_first_name." ".$groom_middle_name." ".$groom_last_name. " & ". $bride_first_name." ".$bride_middle_name. " ".$bride_last_name);
           
            
            $cn->commit();
            
            return true;
            
        } catch (Exception $e) {
            $cn->rollback();
            echo "Error: " . $e->getMessage(); // Consider logging this instead of echoing
            return false;
        }
    }
    

    
    //  $this->logActivity($_SESSION['username'], 'Edited marriage record: ' . $groom_first_name." ".$groom_middle_name." ".$groom_last_name. " & ". $bride_first_name." ".$bride_middle_name. " ".$bride_last_name);

    public function getMarriagePhotos($marriage_id) {
        require_once '../../includes/connect.php'; // Include your database connection
        $conn = new Conn();
        $cn = $conn->connect(1); // Establish a database connection
        
        try {
            // Prepare SQL query to fetch groom and bride photos based on marriage ID
            $sql = "SELECT groom.groom_photo AS groom_photo, bride.bride_photo AS bride_photo
                    FROM marriage m
                    JOIN person groom ON m.groom_id = groom.person_id
                    JOIN person bride ON m.bride_id = bride.person_id
                    WHERE m.marriage_id = ?";
                    
            $qry = $cn->prepare($sql);
            if (!$qry) throw new Exception("Preparation failed: " . $cn->error);

            // Bind parameters and execute the query
            $qry->bind_param("i", $marriage_id);
            if (!$qry->execute()) throw new Exception("Execution failed: " . $qry->error);

            // Get the result
            $result = $qry->get_result();
            if ($result->num_rows === 0) {
                return ['groom_photo' => null, 'bride_photo' => null]; // Return nulls if no record found
            }

            // Fetch the photos
            return $result->fetch_assoc(); // Return the photos as an associative array
        } catch (Exception $e) {
            error_log($e->getMessage()); // Log any exceptions
            return ['groom_photo' => null, 'bride_photo' => null]; // Return nulls on error
        } finally {
            $cn->close(); // Close the database connection
        }
    }

    function generate() {
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
    
        // SQL query to retrieve marriage records with groom, bride, parents, and priest details
        $sql = "SELECT 
                    groom.person_id AS groom_id, groom.first_name AS groom_first_name, groom.middle_name AS groom_middle_name, groom.last_name AS groom_last_name, groom.age AS groom_age, groom.address AS groom_address,
                    bride.person_id AS bride_id, bride.first_name AS bride_first_name, bride.middle_name AS bride_middle_name, bride.last_name AS bride_last_name, bride.age AS bride_age, bride.address AS bride_address,
                    m.marriage_id, m.registration_date, m.marriage_date, m.encoder, m.status, m.groom_photo, m.bride_photo,
                    fg.parent_first_name AS groom_father_first_name, fg.parent_middle_name AS groom_father_middle_name, fg.parent_last_name AS groom_father_last_name,
                    mg.parent_first_name AS groom_mother_first_name, mg.parent_middle_name AS groom_mother_middle_name, mg.parent_last_name AS groom_mother_last_name,
                    fb.parent_first_name AS bride_father_first_name, fb.parent_middle_name AS bride_father_middle_name, fb.parent_last_name AS bride_father_last_name,
                    mb.parent_first_name AS bride_mother_first_name, mb.parent_middle_name AS bride_mother_middle_name, mb.parent_last_name AS bride_mother_last_name,
                    CONCAT(pr.priest_title, ' ', pr.priest_fname, ' ', pr.priest_mname, ' ', pr.priest_lname) AS priests
                FROM 
                    marriage m
                LEFT JOIN 
                    person groom ON m.groom_id = groom.person_id
                LEFT JOIN 
                    person bride ON m.bride_id = bride.person_id
                LEFT JOIN 
                    parent fg ON groom.person_id = fg.person_id AND fg.relation = 'father'
                LEFT JOIN 
                    parent mg ON groom.person_id = mg.person_id AND mg.relation = 'mother'
                LEFT JOIN 
                    parent fb ON bride.person_id = fb.person_id AND fb.relation = 'father'
                LEFT JOIN 
                    parent mb ON bride.person_id = mb.person_id AND mb.relation = 'mother'
                LEFT JOIN 
                    priest pr ON m.priest_id = pr.priest_id
                ORDER BY 
                    m.created_at DESC";
    
        $qry = $cn->prepare($sql);
        if ($qry === false) {
            die("Error in preparing statement: " . $cn->error);
        }
        $qry->execute();
        $qry->bind_result(
            $groom_id, $groom_first_name, $groom_middle_name, $groom_last_name, $groom_age, $groom_address,
            $bride_id, $bride_first_name, $bride_middle_name, $bride_last_name, $bride_age, $bride_address,
            $marriage_id, $registration_date, $marriage_date, $encoder, $status, $groom_photo, $bride_photo,
            $groom_father_first_name, $groom_father_middle_name, $groom_father_last_name,
            $groom_mother_first_name, $groom_mother_middle_name, $groom_mother_last_name,
            $bride_father_first_name, $bride_father_middle_name, $bride_father_last_name,
            $bride_mother_first_name, $bride_mother_middle_name, $bride_mother_last_name,
            $priests
        );
    
        while ($qry->fetch()) {
            // Decrypt the data before storing it
            $data[$ctr]['groom_id'] = $groom_id;
            $data[$ctr]['groom_first_name'] = decryptData($groom_first_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['groom_middle_name'] = decryptData($groom_middle_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['groom_last_name'] = decryptData($groom_last_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['groom_age'] = $groom_age;
            $data[$ctr]['groom_address'] = decryptData($groom_address, $cipher_algo, $key, $iv_length);
    
            $data[$ctr]['bride_id'] = $bride_id;
            $data[$ctr]['bride_first_name'] = decryptData($bride_first_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['bride_middle_name'] = decryptData($bride_middle_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['bride_last_name'] = decryptData($bride_last_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['bride_age'] = $bride_age;
            $data[$ctr]['bride_address'] = decryptData($bride_address, $cipher_algo, $key, $iv_length);
    
            $data[$ctr]['marriage_id'] = $marriage_id;
            $data[$ctr]['registration_date'] = $registration_date;
            $data[$ctr]['marriage_date'] = $marriage_date;
            $data[$ctr]['encoder'] = $encoder;
            $data[$ctr]['status'] = $status;
            $data[$ctr]['groom_photo'] = $groom_photo; // Assuming photo is not encrypted
            $data[$ctr]['bride_photo'] = $bride_photo; // Assuming photo is not encrypted
    
            // Decrypt each part of the groom's and bride's parents' names
            $data[$ctr]['groom_father_name'] = decryptData($groom_father_first_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($groom_father_middle_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($groom_father_last_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['groom_mother_name'] = decryptData($groom_mother_first_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($groom_mother_middle_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($groom_mother_last_name, $cipher_algo, $key, $iv_length);
            
            $data[$ctr]['bride_father_name'] = decryptData($bride_father_first_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($bride_father_middle_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($bride_father_last_name, $cipher_algo, $key, $iv_length);
            $data[$ctr]['bride_mother_name'] = decryptData($bride_mother_first_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($bride_mother_middle_name, $cipher_algo, $key, $iv_length) . ' ' . decryptData($bride_mother_last_name, $cipher_algo, $key, $iv_length);
    
            $data[$ctr]['priests'] = $priests; // Assuming priest name is not encrypted
    
            $ctr++;
        }
    
        // Close the prepared statement and database connection
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
            return false; // Handle case where the session is expired or not set
        }
    
        // Connect to the database
        $cn = $conn->connect(1);
    
        // Fetch the encrypted record details from the marriage table
        $fetchSql = "SELECT groom.first_name AS groom_first, groom.middle_name AS groom_middle, groom.last_name AS groom_last,
                            bride.first_name AS bride_first, bride.middle_name AS bride_middle, bride.last_name AS bride_last
                     FROM marriage m
                     JOIN person groom ON m.groom_id = groom.person_id
                     JOIN person bride ON m.bride_id = bride.person_id
                     WHERE m.marriage_id = ?";
        $fetchQry = $cn->prepare($fetchSql);
        $fetchQry->bind_param("i", $id);
        $fetchQry->execute();
        $fetchQry->bind_result($encrypted_groom_first, $encrypted_groom_middle, $encrypted_groom_last,
                                $encrypted_bride_first, $encrypted_bride_middle, $encrypted_bride_last);
        $fetchQry->fetch();
        $fetchQry->close();
    
        // Decryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    
        // Decrypt the names
        $groom_first = decryptData($encrypted_groom_first, $cipher_algo, $key);
        $groom_middle = decryptData($encrypted_groom_middle, $cipher_algo, $key);
        $groom_last = decryptData($encrypted_groom_last, $cipher_algo, $key);
        
        $bride_first = decryptData($encrypted_bride_first, $cipher_algo, $key);
        $bride_middle = decryptData($encrypted_bride_middle, $cipher_algo, $key);
        $bride_last = decryptData($encrypted_bride_last, $cipher_algo, $key);
    
        // Update the record to set it as 'archived'
        $sql = "UPDATE marriage SET status = 'archived' WHERE marriage_id = ?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);
    
        if ($qry->execute()) {
            // Log the activity for archiving the record
            $this->logActivity(
                $_SESSION['username'],
                'Archived marriage record: ' . $groom_first . ' ' . $groom_middle . ' ' . $groom_last .
                ' & ' . $bride_first . ' ' . $bride_middle . ' ' . $bride_last
            );
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
            return false; // Handle case where the session is expired or not set
        }
    
        // Connect to the database
        $cn = $conn->connect(1);
    
        // Fetch the encrypted record details from the marriage table
        $fetchSql = "SELECT groom.first_name AS groom_first, groom.middle_name AS groom_middle, groom.last_name AS groom_last,
                            bride.first_name AS bride_first, bride.middle_name AS bride_middle, bride.last_name AS bride_last
                     FROM marriage m
                     JOIN person groom ON m.groom_id = groom.person_id
                     JOIN person bride ON m.bride_id = bride.person_id
                     WHERE m.marriage_id = ?";
        $fetchQry = $cn->prepare($fetchSql);
        $fetchQry->bind_param("i", $id);
        $fetchQry->execute();
        $fetchQry->bind_result($encrypted_groom_first, $encrypted_groom_middle, $encrypted_groom_last,
                                $encrypted_bride_first, $encrypted_bride_middle, $encrypted_bride_last);
        $fetchQry->fetch();
        $fetchQry->close();
    
        // Decryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    
        // Decrypt the names
        $groom_first = decryptData($encrypted_groom_first, $cipher_algo, $key);
        $groom_middle = decryptData($encrypted_groom_middle, $cipher_algo, $key);
        $groom_last = decryptData($encrypted_groom_last, $cipher_algo, $key);
        
        $bride_first = decryptData($encrypted_bride_first, $cipher_algo, $key);
        $bride_middle = decryptData($encrypted_bride_middle, $cipher_algo, $key);
        $bride_last = decryptData($encrypted_bride_last, $cipher_algo, $key);
    
        // Update the record to set it as 'active'
        $sql = "UPDATE marriage SET status = 'active' WHERE marriage_id = ?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);
    
        if ($qry->execute()) {
            // Log the activity for restoring the record
            $this->logActivity(
                $_SESSION['username'],
                'Restored marriage record: ' . $groom_first . ' ' . $groom_middle . ' ' . $groom_last .
                ' & ' . $bride_first . ' ' . $bride_middle . ' ' . $bride_last
            );
            return true; // Successfully restored
        } else {
            return false; // Failed to restore
        }
    }
    
}