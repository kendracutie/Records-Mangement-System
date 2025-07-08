<?php
// Start the session
session_start();

// Include database connection
require_once '../../includes/connect.php';

// Create a new connection instance
$conn = new Conn();
$cn = $conn->connect(1); // Assuming you have a method 'connect()' in your Conn class

// Initialize status variable
$status = null;

// Encryption setup
$cipher_algo = 'AES-256-CBC';
$key = getenv('ENCRYPTION_KEY'); // Use an environment variable
$iv_length = openssl_cipher_iv_length($cipher_algo);

// Check if 'mid' parameter is set
if (isset($_GET['mid'])) {
    $request_id = $_GET['mid'];
    $source = isset($_GET['source']) ? $_GET['source'] : 'index'; // Default to 'index' if not set

    // Step 1: Retrieve the certificate request details before deletion
    $sql_select = "SELECT requester_first_name, requester_middle_name, requester_last_name FROM certificate_requests WHERE request_id = ?";
    if ($stmt_select = $cn->prepare($sql_select)) {
        $stmt_select->bind_param('i', $request_id);
        $stmt_select->execute();
        $stmt_select->bind_result($encrypted_first_name, $encrypted_middle_name, $encrypted_last_name);
        $stmt_select->fetch();
        $stmt_select->close();

        // Decrypt the requester's details
        $first_name = decryptData($encrypted_first_name, $cipher_algo, $key, $iv_length);
        $middle_name = decryptData($encrypted_middle_name, $cipher_algo, $key, $iv_length);
        $last_name = decryptData($encrypted_last_name, $cipher_algo, $key, $iv_length);
    }

    // Step 2: Prepare SQL to delete the record from the database
    $sql_delete = "DELETE FROM certificate_requests WHERE request_id = ?";
    if ($stmt_delete = $cn->prepare($sql_delete)) {
        // Bind the request_id as an integer parameter
        $stmt_delete->bind_param('i', $request_id);

        // Execute the query
        if ($stmt_delete->execute()) {
            // Log the activity if username is set
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
            logActivity($username, 'Deleted certificate request from: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);

            // Set status to success
            $status = 'success';
        } else {
            $status = 'failed'; // Set status to failed on execution error
        }

        // Close the prepared statement
        $stmt_delete->close();
    } else {
        $status = 'failed'; // Set status to failed if preparation fails
    }
} else {
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
            window.location.href = 'decline.php'; // Redirect after success
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
            window.location.href = 'decline.php'; // Redirect after failure
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
