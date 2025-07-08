<?php

require_once 'connection.php';
session_start(); // Start the session
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    echo "<p>User not logged in.</p>";
    exit;
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

$userId = $_SESSION['user_id']; // Get the logged-in user ID from the session

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve requester data
    $requesterFirstName = $conn->real_escape_string(trim($_POST['requesterFirstName']));
    $requesterMiddleName = $conn->real_escape_string(trim($_POST['requesterMiddleName']));
    $requesterLastName = $conn->real_escape_string(trim($_POST['requesterLastName']));
    

    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    // Define the user ID (make sure to replace this with the actual method of retrieving it)
    $userId = $_SESSION['user_id']; // Example for getting user ID from session

    // Prepare the statement to fetch user data
    $sql = "SELECT first_name, middle_name, last_name FROM user_acc WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    // Debugging output to check for errors
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $userId); // Assuming user_id is an integer
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set from the prepared statement

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the data as an associative array
// Decrypt the fetched names
$decryptedFirstName = decryptData($row['first_name'], $cipher_algo, $key);
$decryptedMiddleName = decryptData($row['middle_name'], $cipher_algo, $key);
$decryptedLastName = decryptData($row['last_name'], $cipher_algo, $key);


        // Now compare the decrypted names with the input values
        if ($decryptedFirstName === $requesterFirstName && 
            $decryptedMiddleName === $requesterMiddleName && 
            $decryptedLastName === $requesterLastName) {
        } else {
            // Show alert and redirect
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Requester details do not match the logged-in user.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'certificate_req.php'; // Redirect after alert is dismissed
                    });
                });
            </script>
            ";
            exit;
        }
    } else {
        // Handle case where no user was found
        echo "No user found with the provided user ID.";
    }

    // Clean up
    $stmt->close();
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve requester data
$requesterFirstName = $conn->real_escape_string(trim($_POST['requesterFirstName']));
$requesterMiddleName = $conn->real_escape_string(trim($_POST['requesterMiddleName']));
$requesterLastName = $conn->real_escape_string(trim($_POST['requesterLastName']));
$requesterEmail = $conn->real_escape_string(trim($_POST['requesterEmail']));
$requesterContact = $conn->real_escape_string(trim($_POST['requesterContact']));
$relationToPerson = $conn->real_escape_string(trim($_POST['relationToPerson']));
$certificateType = $conn->real_escape_string(trim($_POST['certificateType']));

// Retrieve person's information from the form (sanitize inputs)
$personFirstName = $conn->real_escape_string(trim($_POST['personFirstName']));
$personMiddleName = $conn->real_escape_string(trim($_POST['personMiddleName']));
$personLastName = $conn->real_escape_string(trim($_POST['personLastName']));

// Decryption variables (ensure these are properly set)
$cipher_algo = 'AES-256-CBC';
$key = getenv('ENCRYPTION_KEY'); // Use the correct encryption key from your environment
$iv_length = openssl_cipher_iv_length($cipher_algo);

// Prepare the SQL statement to fetch encrypted data from the person table
$check_person_sql = "
    SELECT person_id, first_name, middle_name, last_name
    FROM person";

// Prepare the query and execute it
$check_person_qry = $conn->prepare($check_person_sql);
$check_person_qry->execute();
$check_person_qry->store_result();

// Initialize flag to indicate whether the person exists
$personExists = false;

// Check if any records are returned
if ($check_person_qry->num_rows > 0) {
    // Bind result variables for decryption
    $check_person_qry->bind_result(
        $personId, 
        $encrypted_first_name, 
        $encrypted_middle_name, 
        $encrypted_last_name
    );
    
    // Loop through each result
    while ($check_person_qry->fetch()) {
        // Decrypt the name fields
        $decrypted_first_name = decryptData($encrypted_first_name, $cipher_algo, $key);
        $decrypted_middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key);
        $decrypted_last_name = decryptData($encrypted_last_name, $cipher_algo, $key);

    
        // Compare the decrypted name fields with the submitted form values
        if ($decrypted_first_name === $personFirstName && 
            $decrypted_middle_name === $personMiddleName && 
            $decrypted_last_name === $personLastName) {
            
            // Person exists, set the flag
            $personExists = true;
            break; // Exit the loop as we found a match
        }
    }
}
// If no match is found, show an error message and redirect
if (!$personExists) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Error!',
            text: 'Person details do not match any records in the database.',
            icon: 'error',
            confirmButtonText: 'OK',
            background: '#fffef0',  /* Set background color here */
            customClass: {
                confirmButton: 'swal-button-custom',
                popup: 'swal-popup-custom'  /* Custom class for the modal */
            }
        }).then(() => {
            window.location.href = 'certificate_req.php'; // Redirect after alert is dismissed
        });
    });
</script>

<style>
    /* Custom styling for the confirm button */
    .swal-button-custom {
        background-color: burlywood !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;  /* Removes the shadow */
    }

    /* Remove focus outline */
    .swal2-confirm:focus {
        outline: none !important;
    }

    /* Custom styling for the modal background */
    .swal-popup-custom {
        background-color: #fffef0 !important; /* Set the background color here */
    }
</style>


    ";
    exit; // Exit the script as no matching person is found
}

    // Retrieve additional fields
    $certificateType = $conn->real_escape_string($_POST['certificateType']);
    $requestPurpose = $conn->real_escape_string($_POST['requestPurpose']);
    
    // Handle file uploads
    $fileNames = [];
    if (isset($_FILES['supportingDocuments']) && !empty($_FILES['supportingDocuments']['name'][0])) {
        $totalFiles = count($_FILES['supportingDocuments']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            if ($_FILES['supportingDocuments']['error'][$i] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['supportingDocuments']['tmp_name'][$i];
                $fileName = basename($_FILES['supportingDocuments']['name'][$i]);
                $filePath = '../view/certificates/uploads/' . $fileName; // Save file directly without path in DB
                
                // Move the file to the uploads directory
                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $fileNames[] = $fileName; // Store only the file name
                } else {
                    echo "Error uploading file: $fileName<br>";
                }
            } else {
                echo "Error uploading file: {$fileNames[$i]}. Error Code: " . $_FILES['supportingDocuments']['error'][$i] . "<br>";
            }
        }
    } else {
        echo "No files were uploaded.<br>";
    }

  // Prepare and execute the insert statement
if (!empty($fileNames)) { // Check if there are files to insert
    $supportingDocument = implode(',', $fileNames); // Store file names as a comma-separated string

     // Encryption setup
     $cipher_algo = 'AES-256-CBC';
     $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
     $iv_length = openssl_cipher_iv_length($cipher_algo);

     
      // Encrypt main person data
$requesterFirstName = encryptData($requesterFirstName, $cipher_algo, $key, $iv_length);
$requesterMiddleName = encryptData($requesterMiddleName, $cipher_algo, $key, $iv_length);
$requesterLastName = encryptData($requesterLastName, $cipher_algo, $key, $iv_length);
$requesterEmail = encryptData($requesterEmail, $cipher_algo, $key, $iv_length);
$requesterContact = encryptData($requesterContact, $cipher_algo, $key, $iv_length);
$relationToPerson = encryptData($relationToPerson, $cipher_algo, $key, $iv_length);
$certificateType = encryptData($certificateType, $cipher_algo, $key, $iv_length);



$stmt = $conn->prepare("INSERT INTO certificate_requests 
(requester_first_name, requester_middle_name, requester_last_name, 
requester_email, requester_contact, relation_to_person, 
person_id, certificate_type, request_purpose, supporting_document, status, user_id) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");

// Check if prepare was successful
if ($stmt) {
    // Correct bind_param types
    $stmt->bind_param("ssssssissss", 
        $requesterFirstName, 
        $requesterMiddleName, 
        $requesterLastName, 
        $requesterEmail, 
        $requesterContact, 
        $relationToPerson, 
        $personId, // Ensure this is defined and valid
        $certificateType, 
        $requestPurpose, 
        $supportingDocument,
        $userId
    );

        
        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Success!',
            text: 'Certificate request submitted successfully.',
            icon: 'success',
            iconColor: 'darkgreen',
            confirmButtonText: 'OK',
            background: '#fffef0',  /* Light green background for the modal */
            customClass: {
                confirmButton: 'swal-button-custom',
                popup: 'swal-popup-custom'  /* Custom class for the modal */
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'certificate_req.php'; // Redirect after alert is dismissed
            }
        });
    });
</script>
<style>
    /* Custom styling for the confirm button */
    .swal-button-custom {
        background-color: burlywood !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;  /* Removes the shadow */
    }

    /* Remove focus outline */
    .swal2-confirm:focus {
        outline: none !important;
    }

    /* Custom styling for the modal background */
    .swal-popup-custom {
        background-color: #fffef0 !important; /* Light green background for success */
    }
</style>
            ";
        } else {
            // Output the error message through SweetAlert
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error: " . $stmt->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
            ";
        }
        $stmt->close(); // Close the statement
    } else {
        // Handle prepare statement failure
        echo "Failed to prepare the SQL statement: " . $conn->error;
    }
} else {
    echo "No files to insert.<br>";
}

// Close the connection
$conn->close();
}

?>