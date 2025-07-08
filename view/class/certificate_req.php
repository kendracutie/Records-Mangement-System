<?php

class certificate_req {
    function getAll() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        // Encryption setup
        $cipher_algo = 'AES-256-CBC';
        $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $data = array();
        
        // SQL query with LEFT JOIN
        $sql = "SELECT cr.request_id, 
                       cr.requester_first_name, 
                       cr.requester_middle_name, 
                       cr.requester_last_name, 
                       cr.requester_email, 
                       cr.requester_contact, 
                       cr.relation_to_person, 
                       cr.person_id, 
                       cr.certificate_type, 
                       cr.request_purpose, 
                       cr.status, 
                       cr.request_date, 
                       cr.supporting_document, 
                       p.first_name AS person_first_name, 
                       p.middle_name AS person_middle_name, 
                       p.last_name AS person_last_name, 
                       p.dob AS person_dob, 
                       p.place_of_birth AS person_place_of_birth, 
                       p.address AS person_address 
                FROM certificate_requests cr
                LEFT JOIN person p ON cr.person_id = p.person_id
                ORDER BY cr.request_id DESC";
        
        $qry = $cn->prepare($sql);
    
        if (!$qry) {
            die("Error preparing SQL: " . $cn->error);
        }
    
        $qry->execute();
    
        // Check for errors after execution
        if ($qry->error) {
            die("Error executing SQL: " . $qry->error);
        }
    
        // Bind results for each field (make sure the number matches the selected fields)
        $qry->bind_result($requestId, $requesterFirstName, $requesterMiddleName, $requesterLastName, 
                          $requesterEmail, $requesterContact, $relationToPerson, $person_id, 
                          $certificateType, $requestPurpose, $status, $requestDate, 
                          $supportingDocuments, $personFirstName, $personMiddleName, 
                          $personLastName, $personDob, $personPlaceOfBirth, $personAddress);
        
        // Fetch each record
        while ($qry->fetch()) {

                    // Decrypt relevant fields
        $decryptedRequesterFirstName = $this->decryptData($requesterFirstName, $cipher_algo, $key);
        $decryptedRequesterMiddleName = $this->decryptData($requesterMiddleName, $cipher_algo, $key);
        $decryptedRequesterLastName = $this->decryptData($requesterLastName, $cipher_algo, $key);
        $decryptedRequesterEmail = $this->decryptData($requesterEmail, $cipher_algo, $key);
        $decryptedRequesterContact = $this->decryptData($requesterContact, $cipher_algo, $key);
        $decryptedRelationToPerson = $this->decryptData($relationToPerson, $cipher_algo, $key);
        $decryptedCertificateType = $this->decryptData($certificateType, $cipher_algo, $key);

                // Decrypt relevant fields for the person
        $decryptedPersonFirstName = $this->decryptData($personFirstName, $cipher_algo, $key);
        $decryptedPersonMiddleName = $this->decryptData($personMiddleName, $cipher_algo, $key);
        $decryptedPersonLastName = $this->decryptData($personLastName, $cipher_algo, $key);
        $decryptedPersonPlaceOfBirth = $this->decryptData($personPlaceOfBirth, $cipher_algo, $key);
        $decryptedPersonAddress = $this->decryptData($personAddress, $cipher_algo, $key);
            // Parse the supporting documents into an array if not empty
            $documentsArray = !empty($supportingDocuments) ? explode(',', $supportingDocuments) : [];
    
            $data[] = array(
                'request_id' => $requestId,
                'requester_first_name' => $decryptedRequesterFirstName,
                'requester_middle_name' => $decryptedRequesterMiddleName,
                'requester_last_name' => $decryptedRequesterLastName,
                'requester_email' => $decryptedRequesterEmail,
                'requester_contact' => $decryptedRequesterContact,
                'relation_to_person' => $decryptedRelationToPerson,
                'person_id' => $person_id,
                'person_first_name' => $decryptedPersonFirstName,
                'person_middle_name' => $decryptedPersonMiddleName,
                'person_last_name' => $decryptedPersonLastName,
                'person_dob' => $personDob,
                'person_place_of_birth' => $decryptedPersonPlaceOfBirth,
                'person_address' => $decryptedPersonAddress,
                'certificate_type' => $decryptedCertificateType,
                'request_purpose' => $requestPurpose,
                'status' => $status,
                'request_date' => $requestDate,
                'supporting_documents' => $documentsArray  // Store as array
            );
        }
    
        // Close the prepared statement and connection
        $qry->close();
        $cn->close();
    
        return $data;
    }

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
            return null; // or handle it as appropriate
        }
        
        return $decrypted;
    }

    function getApprovedRequests() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define encryption settings
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    $data = array();

    // SQL query to fetch approved requests with person dob and approver username
    $sql = "SELECT cr.request_id, 
                   cr.requester_first_name, 
                   cr.requester_middle_name, 
                   cr.requester_last_name, 
                   cr.requester_email, 
                   cr.certificate_type, 
                   cr.request_purpose, 
                   cr.status, 
                   cr.approved_by,  
                   cr.approved_date,  
                   p.first_name AS person_first_name, 
                   p.middle_name AS person_middle_name, 
                   p.last_name AS person_last_name, 
                   p.dob AS person_dob  
            FROM certificate_requests cr
            LEFT JOIN person p ON cr.person_id = p.person_id
            WHERE cr.status = 'approved'
            ORDER BY cr.approved_date DESC";

    $qry = $cn->prepare($sql);

    if (!$qry) {
        die("Error preparing SQL: " . $cn->error);
    }

    $qry->execute();

    // Bind results
    $qry->bind_result(
        $requestId, $encryptedRequesterFirstName, $encryptedRequesterMiddleName, $encryptedRequesterLastName, 
        $encryptedRequesterEmail, $encryptedCertificateType, $requestPurpose, $status, 
        $approvedBy, $approvedDate, $encryptedPersonFirstName, $encryptedPersonMiddleName, 
        $encryptedPersonLastName, $personDob
    );

    while ($qry->fetch()) {
        // Decrypt only encrypted fields
        $requesterFirstName = $this->decryptData($encryptedRequesterFirstName, $cipher_algo, $key);
        $requesterMiddleName = $this->decryptData($encryptedRequesterMiddleName, $cipher_algo, $key);
        $requesterLastName = $this->decryptData($encryptedRequesterLastName, $cipher_algo, $key);
        $requesterEmail = $this->decryptData($encryptedRequesterEmail, $cipher_algo, $key);
        $certificateType = $this->decryptData($encryptedCertificateType, $cipher_algo, $key);
        $personFirstName = $this->decryptData($encryptedPersonFirstName, $cipher_algo, $key);
        $personMiddleName = $this->decryptData($encryptedPersonMiddleName, $cipher_algo, $key);
        $personLastName = $this->decryptData($encryptedPersonLastName, $cipher_algo, $key);

        // Construct the data array with decrypted and plaintext values
        $data[] = array(
            'request_id' => $requestId,
            'requester_first_name' => $requesterFirstName,
            'requester_middle_name' => $requesterMiddleName,
            'requester_last_name' => $requesterLastName,
            'requester_email' => $requesterEmail,
            'certificate_type' => $certificateType,
            'request_purpose' => $requestPurpose, // Directly assign plaintext
            'status' => $status, // Directly assign plaintext
            'approved_by' => $approvedBy, // Directly assign plaintext
            'approved_date' => $approvedDate,
            'person_first_name' => $personFirstName,
            'person_middle_name' => $personMiddleName,
            'person_last_name' => $personLastName,
            'person_dob' => $personDob // Date of birth remains as is
        );
    }

    $qry->close();
    $cn->close();

    return $data;
}

    
  
    
    
function getDeclinedRequests() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define encryption settings
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    $data = array();

    // SQL query to fetch declined requests with person dob and approver username
    $sql = "SELECT cr.request_id, 
                   cr.requester_first_name, 
                   cr.requester_middle_name, 
                   cr.requester_last_name, 
                   cr.requester_email, 
                   cr.certificate_type, 
                   cr.request_purpose, 
                   cr.status, 
                   cr.approved_by,  
                   cr.approved_date,  
                   p.first_name AS person_first_name, 
                   p.middle_name AS person_middle_name, 
                   p.last_name AS person_last_name, 
                   p.dob AS person_dob  
            FROM certificate_requests cr
            LEFT JOIN person p ON cr.person_id = p.person_id
            WHERE cr.status = 'declined'
            ORDER BY cr.approved_date DESC";

    $qry = $cn->prepare($sql);

    if (!$qry) {
        die("Error preparing SQL: " . $cn->error);
    }

    $qry->execute();

    // Bind results
    $qry->bind_result(
        $requestId, $encryptedRequesterFirstName, $encryptedRequesterMiddleName, $encryptedRequesterLastName, 
        $encryptedRequesterEmail, $encryptedCertificateType, $requestPurpose, $status, 
        $approvedBy, $approvedDate, $encryptedPersonFirstName, $encryptedPersonMiddleName, 
        $encryptedPersonLastName, $personDob
    );

    while ($qry->fetch()) {
        // Decrypt only encrypted fields
        $requesterFirstName = $this->decryptData($encryptedRequesterFirstName, $cipher_algo, $key);
        $requesterMiddleName = $this->decryptData($encryptedRequesterMiddleName, $cipher_algo, $key);
        $requesterLastName = $this->decryptData($encryptedRequesterLastName, $cipher_algo, $key);
        $requesterEmail = $this->decryptData($encryptedRequesterEmail, $cipher_algo, $key);
        
        // Decrypt the certificate_type field
        $certificateType = $this->decryptData($encryptedCertificateType, $cipher_algo, $key);
    
        // Decrypt remaining fields
        $personFirstName = $this->decryptData($encryptedPersonFirstName, $cipher_algo, $key);
        $personMiddleName = $this->decryptData($encryptedPersonMiddleName, $cipher_algo, $key);
        $personLastName = $this->decryptData($encryptedPersonLastName, $cipher_algo, $key);
    
        // Construct the data array with decrypted values
        $data[] = array(
            'request_id' => $requestId,
            'requester_first_name' => $requesterFirstName,
            'requester_middle_name' => $requesterMiddleName,
            'requester_last_name' => $requesterLastName,
            'requester_email' => $requesterEmail,
            'certificate_type' => $certificateType, // Ensure certificate_type is included
            'request_purpose' => $requestPurpose,
            'status' => $status,
            'approved_by' => $approvedBy,
            'approved_date' => $approvedDate,
            'person_first_name' => $personFirstName,
            'person_middle_name' => $personMiddleName,
            'person_last_name' => $personLastName,
            'person_dob' => $personDob
        );
    }
    

    $qry->close();
    $cn->close();

    return $data;
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

function getone($id) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define encryption settings
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    $data = array();

    // Use a parameterized query to select the specific request by ID with a LEFT JOIN
    $sql = "SELECT cr.request_id, 
                   cr.requester_first_name, 
                   cr.requester_middle_name, 
                   cr.requester_last_name, 
                   cr.requester_email, 
                   cr.requester_contact, 
                   cr.relation_to_person, 
                   cr.person_id, 
                   cr.certificate_type, 
                   cr.request_purpose, 
                   cr.status, 
                   cr.request_date, 
                   cr.supporting_document, 
                   p.first_name AS person_first_name, 
                   p.middle_name AS person_middle_name, 
                   p.last_name AS person_last_name, 
                   p.dob AS person_dob, 
                   p.place_of_birth AS person_place_of_birth, 
                   p.address AS person_address
            FROM certificate_requests cr
            LEFT JOIN person p ON cr.person_id = p.person_id
            WHERE cr.request_id = ?"; // Use the ID to filter the specific request

    $qry = $cn->prepare($sql);
    $qry->bind_param('i', $id); // Bind the provided ID
    $qry->execute();

    // Bind the results
    $qry->bind_result(
        $requestId, $encryptedRequesterFirstName, $encryptedRequesterMiddleName, $encryptedRequesterLastName, 
        $encryptedRequesterEmail, $encryptedRequesterContact, $relationToPerson, $personId, 
        $certificateType, $requestPurpose, $status, $requestDate, $supportingDocuments, 
        $encryptedPersonFirstName, $encryptedPersonMiddleName, $encryptedPersonLastName, 
        $encryptedPersonDob, $encryptedPersonPlaceOfBirth, $encryptedPersonAddress
    );

    // Fetch the result
    if ($qry->fetch()) {
        // Decrypt the retrieved encrypted fields
        $requesterFirstName = $this->decryptData($encryptedRequesterFirstName, $cipher_algo, $key);
        $requesterMiddleName = $this->decryptData($encryptedRequesterMiddleName, $cipher_algo, $key);
        $requesterLastName = $this->decryptData($encryptedRequesterLastName, $cipher_algo, $key);
        $requesterEmail = $this->decryptData($encryptedRequesterEmail, $cipher_algo, $key);
        $requesterContact = $this->decryptData($encryptedRequesterContact, $cipher_algo, $key);
        $personFirstName = $this->decryptData($encryptedPersonFirstName, $cipher_algo, $key);
        $personMiddleName = $this->decryptData($encryptedPersonMiddleName, $cipher_algo, $key);
        $personLastName = $this->decryptData($encryptedPersonLastName, $cipher_algo, $key);
        $personDob = $this->decryptData($encryptedPersonDob, $cipher_algo, $key);
        $personPlaceOfBirth = $this->decryptData($encryptedPersonPlaceOfBirth, $cipher_algo, $key);
        $personAddress = $this->decryptData($encryptedPersonAddress, $cipher_algo, $key);

        // Parse the supporting documents into an array
        $documentsArray = !empty($supportingDocuments) ? explode(',', $supportingDocuments) : [];

        // Construct the data array with decrypted values
        $data = array(
            'request_id' => $requestId,
            'requester_first_name' => $requesterFirstName,
            'requester_middle_name' => $requesterMiddleName,
            'requester_last_name' => $requesterLastName,
            'requester_email' => $requesterEmail,
            'requester_contact' => $requesterContact,
            'relation_to_person' => $relationToPerson,
            'person_id' => $personId,
            'person_first_name' => $personFirstName,
            'person_middle_name' => $personMiddleName,
            'person_last_name' => $personLastName,
            'person_dob' => $personDob,
            'person_place_of_birth' => $personPlaceOfBirth,
            'person_address' => $personAddress,
            'certificate_type' => $certificateType,
            'request_purpose' => $requestPurpose,
            'status' => $status,
            'request_date' => $requestDate,
            'supporting_document' => $documentsArray  // Handle as array
        );
    } else {
        // If no records found, return null or an empty array
        return null; 
    }

    $qry->close(); // Close the statement
    return $data; // Return the fetched data
}
    


    function approved($id){
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);


        $sql = "UPDATE certificate_requests SET status = 'approved' WHERE request_id=?";
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);

        if($qry->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function approveRequest($request_id, $approved_by) {
        require_once '../../includes/connect.php';

        // Get database connection
        $conn = new Conn();
        $cn = $conn->connect(1);
        
        // Update the request status to 'approved', set approved_by, and update the approved_date
        $sql = "UPDATE certificate_requests 
                SET status = 'approved', approved_by = ?, approved_date = NOW()
                WHERE request_id = ?";
    
        $stmt = $cn->prepare($sql);
        
        if (!$stmt) {
            die("Error preparing SQL: " . $cn->error);
        }
    
        // Bind the parameters (approved_by and request_id)
        $stmt->bind_param("si", $approved_by, $request_id);
    
        // Execute the query and check if successful
        if ($stmt->execute()) {
            $stmt->close();
            $cn->close();
            return true;  // Request was successfully approved
        } else {
            $stmt->close();
            $cn->close();
            return false; // Failed to approve the request
        }
    }
    
    public function declineRequest($request_id, $declined_by) {
        // Get database connection
        $conn = new Conn();
        $cn = $conn->connect(1);
        
        // Update the request status to 'declined', set declined_by, and update the declined_date
        $sql = "UPDATE certificate_requests 
                SET status = 'declined', approved_by = ?, approved_date = NOW()
                WHERE request_id = ?";
    
        $stmt = $cn->prepare($sql);
        
        if (!$stmt) {
            die("Error preparing SQL: " . $cn->error);
        }
    
        // Bind the parameters (declined_by and request_id)
        $stmt->bind_param("si", $declined_by, $request_id);
    
        // Execute the query and check if successful
        if ($stmt->execute()) {
            $stmt->close();
            $cn->close();
            return true;  // Request was successfully declined
        } else {
            $stmt->close();
            $cn->close();
            return false; // Failed to decline the request
        }
    }
    
    function declined($id){
        require_once '../../includes/connect.php';
        $conn = new Conn();

        $sql = "UPDATE certificate_requests SET status = 'declined' WHERE request_id=?";
        $cn = $conn->connect(1);
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);

        if($qry->execute()){
            return true;
        } else {
            return false;
        }
    }
}

?>
