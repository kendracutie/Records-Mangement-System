<?php
// Assuming you have a database connection established
require_once '../../includes/connect.php';
$conn = new Conn();
$cn = $conn->connect(1);

// Get the request ID from the URL
$request_id = isset($_GET['mid']) ? $_GET['mid'] : null;

// Initialize the request variable
$request = null;

if ($request_id !== null) {
    // Validate the request ID to ensure it's a number
    if (!filter_var($request_id, FILTER_VALIDATE_INT)) {
        echo "<p>Invalid request ID.</p>";
        exit;
    }

    // Function to decrypt data
    function decryptData($encryptedData, $cipher_algo, $key) {
        $decoded = base64_decode($encryptedData);
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $iv = substr($decoded, 0, $iv_length);
        $ciphertext = substr($decoded, $iv_length);
        
        // Suppress warnings by using the @ operator
        $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
        
        // Handle the decryption failure
        if ($decrypted === false) {
            return null; // Or handle it as appropriate
        }
        
        return $decrypted;
    }

    // Prepare the SQL query to get the certificate request details using LEFT JOIN
    $query = "SELECT 
                cr.request_id, 
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
              FROM 
                certificate_requests cr
              LEFT JOIN 
                person p ON cr.person_id = p.person_id
              WHERE 
                cr.request_id = ?";

    // Prepare and execute the statement
    if ($stmt = $cn->prepare($query)) {
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the request exists
        if ($result->num_rows > 0) {
            $request = $result->fetch_assoc(); // Fetch the details including person details

            // Decrypt relevant fields
            $cipher_algo = 'AES-256-CBC';
            $key = getenv('ENCRYPTION_KEY'); // Load the encryption key from environment variable

            // Decrypt each field
            $decryptedRequesterFirstName = decryptData($request['requester_first_name'], $cipher_algo, $key);
            $decryptedRequesterMiddleName = decryptData($request['requester_middle_name'], $cipher_algo, $key);
            $decryptedRequesterLastName = decryptData($request['requester_last_name'], $cipher_algo, $key);
            $decryptedRequesterEmail = decryptData($request['requester_email'], $cipher_algo, $key);
            $decryptedRequesterContact = decryptData($request['requester_contact'], $cipher_algo, $key);
            $decryptedRelationToPerson = decryptData($request['relation_to_person'], $cipher_algo, $key);
            $decryptedCertificateType = decryptData($request['certificate_type'], $cipher_algo, $key);
            $decryptedRequestPurpose = decryptData($request['request_purpose'], $cipher_algo, $key);
            $decryptedSupportingDocument = decryptData($request['supporting_document'], $cipher_algo, $key);

            // Decrypt person details
            $decryptedPersonFirstName = decryptData($request['person_first_name'], $cipher_algo, $key);
            $decryptedPersonMiddleName = decryptData($request['person_middle_name'], $cipher_algo, $key);
            $decryptedPersonLastName = decryptData($request['person_last_name'], $cipher_algo, $key);
            $decryptedPersonDob = decryptData($request['person_dob'], $cipher_algo, $key);
            $decryptedPersonPlaceOfBirth = decryptData($request['person_place_of_birth'], $cipher_algo, $key);
            $decryptedPersonAddress = decryptData($request['person_address'], $cipher_algo, $key);

            // Prepare the final data array with decrypted values
            $decryptedRequestDetails = array(
                'request_id' => $request['request_id'],
                'requester_first_name' => $decryptedRequesterFirstName,
                'requester_middle_name' => $decryptedRequesterMiddleName,
                'requester_last_name' => $decryptedRequesterLastName,
                'requester_email' => $decryptedRequesterEmail,
                'requester_contact' => $decryptedRequesterContact,
                'relation_to_person' => $decryptedRelationToPerson,
                'person_id' => $request['person_id'], // This does not need decryption
                'certificate_type' => $decryptedCertificateType,
                'request_purpose' => $decryptedRequestPurpose,
                'status' => $request['status'], // Status might not need decryption
                'request_date' => $request['request_date'], // Same as above
                'supporting_document' => $decryptedSupportingDocument,
                'person_first_name' => $decryptedPersonFirstName,
                'person_middle_name' => $decryptedPersonMiddleName,
                'person_last_name' => $decryptedPersonLastName,
                'person_dob' => $decryptedPersonDob,
                'person_place_of_birth' => $decryptedPersonPlaceOfBirth,
                'person_address' => $decryptedPersonAddress
            );
        } else {
            echo "<p>No certificate request found.</p>";
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Error preparing the statement: " . $cn->error . "</p>";
        exit;
    }

    // Close the database connection
    $cn->close();
} else {
    echo "<p>Request ID not set.</p>";
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Request Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 15px;
            margin-top: 20px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            margin-bottom: 20px;
            color: #343a40;
        }
        .supporting-docs img {
            width: 280px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        h5 {
            margin-top: 20px;
            color: #495057;
        }
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-body">
                <h2 class="text-center card-title">Certificate Request Details</h2>
                <p><strong>Requester Name:</strong> <?php echo !empty($decryptedRequestDetails['requester_first_name']) || !empty($decryptedRequestDetails['requester_middle_name']) || !empty($decryptedRequestDetails['requester_last_name']) ? htmlspecialchars($decryptedRequestDetails['requester_first_name'] . ' ' . $decryptedRequestDetails['requester_middle_name'] . ' ' . $decryptedRequestDetails['requester_last_name']) : 'N/A'; ?></p>
<p><strong>Email Address:</strong> <?php echo !empty($decryptedRequestDetails['requester_email']) ? htmlspecialchars($decryptedRequestDetails['requester_email']) : 'N/A'; ?></p>
<p><strong>Contact:</strong> <?php echo !empty($decryptedRequestDetails['requester_contact']) ? htmlspecialchars($decryptedRequestDetails['requester_contact']) : 'N/A'; ?></p>
<p><strong>Relation to Person:</strong> <?php echo !empty($decryptedRequestDetails['relation_to_person']) ? htmlspecialchars($decryptedRequestDetails['relation_to_person']) : 'N/A'; ?></p>
<p><strong>Person Name:</strong> <?php echo !empty($decryptedRequestDetails['person_first_name']) || !empty($decryptedRequestDetails['person_middle_name']) || !empty($decryptedRequestDetails['person_last_name']) ? htmlspecialchars($decryptedRequestDetails['person_first_name'] . ' ' . $decryptedRequestDetails['person_middle_name'] . ' ' . $decryptedRequestDetails['person_last_name']) : 'N/A'; ?></p>
<p><strong>Date of Birth:</strong> <?php echo !empty($request['person_dob']) && $request['person_dob'] != '0000-00-00' ? htmlspecialchars($request['person_dob']) : 'N/A'; ?></p>
<p><strong>Place of Birth:</strong> <?php echo !empty($decryptedRequestDetails['person_place_of_birth']) ? htmlspecialchars($decryptedRequestDetails['person_place_of_birth']) : 'N/A'; ?></p>
<p><strong>Address:</strong> <?php echo !empty($decryptedRequestDetails['person_address']) ? htmlspecialchars($decryptedRequestDetails['person_address']) : 'N/A'; ?></p>
<p><strong>Type of Certificate:</strong> <?php echo !empty($decryptedRequestDetails['certificate_type']) ? htmlspecialchars($decryptedRequestDetails['certificate_type']) : 'N/A'; ?></p>
<p><strong>Purpose of Request:</strong> <?php echo !empty($request['request_purpose']) ? nl2br(htmlspecialchars($request['request_purpose'])) : 'N/A'; ?></p>

                <!-- Supporting Documents Section -->
                <h5>Supporting Documents:</h5>
                <ul class="supporting-docs">
                    <?php
                    $documents = explode(',', $request['supporting_document']);
                    foreach ($documents as $doc) {
                        $doc = trim($doc); // Remove any extra whitespace
                        $extension = pathinfo($doc, PATHINFO_EXTENSION);
                        
                        // Check if the file is an image
                        if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo '<li class="d-inline-block mr-2">
                                      <a href="#" onclick="openModal(\'uploads/' . htmlspecialchars($doc) . '\'); return false;">
                                          <img src="uploads/' . htmlspecialchars($doc) . '" alt="Supporting Document" class="supporting-doc-img">
                                      </a>
                                  </li>';
                        } else {
                            echo '<li>' . htmlspecialchars($doc) . '</li>';
                        }
                    }
                    ?>
                </ul>

                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Supporting Document</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="modalImage" src="" alt="Supporting Document" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Include jQuery and Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

                <script>
                    function openModal(imageSrc) {
                        document.getElementById('modalImage').src = imageSrc;
                        $('#imageModal').modal('show'); // Use Bootstrap's modal function to show the modal
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
