<?php
// Start the session
session_start();

// Include database connection
require_once '../../includes/connect.php';

// Create a new connection instance
$conn = new Conn();
$cn = $conn->connect(1); // Assuming you have a method 'connect()' in your Conn class

// Check if 'mid' parameter is set
if (isset($_GET['mid'])) {
    $request_id = $_GET['mid'];

    // Fetch the record details from the database
    $fetchSql = "SELECT requester_first_name, requester_middle_name, requester_last_name 
                 FROM certificate_requests 
                 WHERE request_id = ?";
    $fetchQry = $cn->prepare($fetchSql);
    $fetchQry->bind_param("i", $request_id);
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

    // Prepare SQL to delete the record
    $sql = "DELETE FROM certificate_requests WHERE request_id = ?";
    if ($stmt = $cn->prepare($sql)) {
        // Bind the request_id as an integer parameter
        $stmt->bind_param('i', $request_id);

        // Execute the query
        if ($stmt->execute()) {
            // Log the activity using the session's username
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
            logActivity($username, 'Deleted certificate request from: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);

            // Set a status to indicate success
            $status = 'success';
        } else {
            // Handle execution error
            $status = 'failed'; // Set status to failed on execution error
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle SQL preparation error
        $status = 'failed'; // Set status to failed if preparation fails
    }
} else {
    // Handle the case where 'mid' is not set
    $status = 'failed'; // No record ID specified
}

// Function to log activity
function logActivity($username, $action) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Insert into activity_log
    $query = "INSERT INTO activity_log (username, action, date) VALUES (?, ?, NOW())";
    if ($log_qry = $cn->prepare($query)) {
        $log_qry->bind_param("ss", $username, $action);
        $log_qry->execute();
        $log_qry->close();
    }
}

// Function to decrypt data
function decryptData($encryptedData, $cipher_algo, $key, $iv_length) {
    $decoded = base64_decode($encryptedData);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);

    // Suppress warnings by using the @ operator
    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);

    // Check if decryption failed
    if ($decrypted === false) {
        // Handle the decryption failure
        return null;
    }

    return $decrypted;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Request Deletion</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
// If the status is set (indicating the deletion process has occurred), display SweetAlert2
if (isset($status)) {
    if ($status == 'success') {
        echo "
        <script>
          Swal.fire({
            icon: 'success',
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Certificate request deleted successfully</span>',
            background: '#fffef0', 
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 2000,
            iconColor: '#006400' // Dark green for the success icon
          }).then(() => {
            window.location.href = 'approve_req.php'; // Redirect after success
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            title: '<span style=\"color:#2F4F4F;\">Failed to delete certificate request!</span>',
            background: '#fffef0', // Cream background color
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 2000,
            iconColor: '#630707' // Maroon color for the error icon
          }).then(() => {
            window.location.href = 'approve_req.php'; // Redirect after failure
          });
        </script>
        ";
    }
}
?>

<!-- Button or link to trigger deletion -->
<a href="?mid=1" class="btn btn-sm btn-secondary btn-block"></a>

</body>
</html>
