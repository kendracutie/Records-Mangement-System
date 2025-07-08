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

// Check if 'mid' parameter is set
if (isset($_GET['mid'])) {
    $prayer_id = $_GET['mid'];

    // Step 1: Retrieve the prayer request details before deletion
    $sql_select = "SELECT prayer_rq FROM prayer_req WHERE prayer_id = ?";
    if ($stmt_select = $cn->prepare($sql_select)) {
        $stmt_select->bind_param('i', $prayer_id);
        $stmt_select->execute();
        $stmt_select->bind_result($request_details);
        $stmt_select->fetch();
        $stmt_select->close();
    }

    // Step 2: Prepare SQL to delete the record from the database
    $sql_delete = "DELETE FROM prayer_req WHERE prayer_id = ?";
    if ($stmt_delete = $cn->prepare($sql_delete)) {
        // Bind the prayer_id as an integer parameter
        $stmt_delete->bind_param('i', $prayer_id);

        // Execute the query
        if ($stmt_delete->execute()) {
            // Log the activity if username is set
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
            logActivity($username, 'Deleted prayer request: ' .  $request_details);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Request Deletion</title>
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
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Prayer request deleted successfully</span>',
            background: '#fffef0', 
            color: '#000000',
            showConfirmButton: false,
            timer: 1500,
            iconColor: '#006400'
          }).then(() => {
            window.location.href = './approve.php'; // Redirect to the source page
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            title: '<span style=\"color:#2F4F4F;\">Failed to delete prayer request!</span>',
            background: '#fffef0',
            color: '#000000',
            showConfirmButton: false,
            timer: 1500,
            iconColor: '#630707'
          }).then(() => {
            window.location.href = './approve.php'; // Redirect after failure
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
