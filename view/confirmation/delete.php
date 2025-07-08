<?php
// Start session to access session variables
session_start();

// Include database connection
require_once '../../includes/connect.php';

// Create a new connection instance
$conn = new Conn();
$cn = $conn->connect(1); // Assuming you have a method 'connect()' in your Conn class

// Initialize status variable
$status = null;

// Check if 'mid' parameter is set
if (isset($_GET['mid'])) {
    $confirmation_id = $_GET['mid'];

    // Fetch the record details from the person table using a join
    $fetchSql = "SELECT p.first_name, p.middle_name, p.last_name 
                 FROM confirmation c
                 JOIN person p ON c.person_id = p.person_id
                 WHERE c.confirmation_id = ?";
    $fetchQry = $cn->prepare($fetchSql);
    $fetchQry->bind_param("i", $confirmation_id);
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

    // Prepare SQL to update the record's status to 'deleted'
    $sql = "UPDATE confirmation SET status = 'deleted' WHERE confirmation_id = ?";

    // Prepare the statement
    if ($stmt = $cn->prepare($sql)) {
        // Bind the confirmation_id as an integer parameter
        $stmt->bind_param('i', $confirmation_id);

        // Execute the query
        if ($stmt->execute()) {
            // Log the activity using the session's username
            logActivity($_SESSION['username'], 'Deleted confirmation record: ' . $first_name . ' ' . $middle_name . ' ' . $last_name);

            // Set status to success
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Deletion</title>
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
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Confirmation record deleted successfully</span>',
            background: '#fffef0', 
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 2000,
            iconColor: '#006400' // Dark green for the success icon
          }).then(() => {
            window.location.href = './index.php'; // Redirect after success
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            title: '<span style=\"color:#2F4F4F;\">Failed to delete confirmation record!</span>',
            background: '#fffef0', // Cream background color
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 2000,
            iconColor: '#630707' // Maroon color for the error icon
          }).then(() => {
            window.location.href = './index.php'; // Redirect after failure
          });
        </script>
        ";
    }
}
?>

<!-- Your page content goes here -->
<a href="?mid=1" class="btn btn-sm btn-secondary btn-block"></a>

</body>
</html>
