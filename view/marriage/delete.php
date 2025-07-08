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
    $marriage_id = $_GET['mid'];

    // Fetch the groom and bride names for logging purposes
    $fetchSql = "SELECT groom.first_name AS groom_first, groom.middle_name AS groom_middle, groom.last_name AS groom_last,
                        bride.first_name AS bride_first, bride.middle_name AS bride_middle, bride.last_name AS bride_last
                 FROM marriage m
                 JOIN person groom ON m.groom_id = groom.person_id
                 JOIN person bride ON m.bride_id = bride.person_id
                 WHERE m.marriage_id = ?";
    $fetchQry = $cn->prepare($fetchSql);
    $fetchQry->bind_param("i", $marriage_id);
    $fetchQry->execute();
    $fetchQry->bind_result($groom_first, $groom_middle, $groom_last, $bride_first, $bride_middle, $bride_last);
    $fetchQry->fetch();
    $fetchQry->close();

    // Prepare SQL to update the record's status to 'deleted'
    $sql = "UPDATE marriage SET status = 'deleted' WHERE marriage_id = ?";
    if ($stmt = $cn->prepare($sql)) {
        // Bind the marriage_id as an integer parameter
        $stmt->bind_param('i', $marriage_id);

        // Execute the query
        if ($stmt->execute()) {
            // Log the activity using the session's username
            logActivity(
                $_SESSION['username'],
                'Deleted marriage record: ' . $groom_first . ' ' . $groom_middle . ' ' . $groom_last .
                ' & ' . $bride_first . ' ' . $bride_middle . ' ' . $bride_last
            );

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Deletion</title>
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
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Marriage record deleted successfully</span>',
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
            title: '<span style=\"color:#2F4F4F;\">Failed to delete marriage record!</span>',
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
