<?php
session_start(); // Ensure session is started to access session variables

if (empty($_SESSION['username'])) {
    // Redirect if admin is not logged in
    echo "<script>window.location.href='../../view';</script>";
    exit;
}

require_once '../../includes/connect.php'; // Ensure the database connection file is included

// Check if 'mid' (prayer ID) is set in the URL
if (isset($_GET['mid'])) {
    $mid = $_GET['mid']; // Get the prayer request ID from URL

    $conn = new Conn(); // Initialize the database connection
    $cn = $conn->connect(1); // Connect to the database

    // Fetch the prayer type before updating the status
    $sql = "SELECT prayerType FROM prayer_req WHERE prayer_id = ?";
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $mid); // Bind the prayer ID to the query
    $qry->execute();
    $qry->bind_result($prayerType); // Get the prayer type result
    $qry->fetch();
    $qry->close(); // Close the query after fetching the result

    // Get the admin username from session
    $approved_by = $_SESSION['username'];

    // Include the prayer request class
    require_once '../class/prayer_req.php';
    $prayerRequest = new prayer_req();

    // Approve the prayer request and store 'approved_by' admin username
    $approve = $prayerRequest->approved($mid, $approved_by); // Pass the ID and admin username to the method

    // Set a status based on the result of the approval operation
    if ($approve) {
        $status = 'success'; // Successful approval

        // Log activity after successful approval
        logActivity($approved_by, "Approved prayer request of type: " . $prayerType); // Log the approval action with the prayer type
    } else {
        $status = 'failed'; // Failed to approve
    }

    // Close the connection
    $cn->close();
}

/* Function to log activity */
function logActivity($username, $action) {
    require_once '../../includes/connect.php'; // Ensure the database connection file is included
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Insert into activity_log table
    $query = "INSERT INTO activity_log (username, action, date) VALUES (?, ?, NOW())";
    $log_qry = $cn->prepare($query);
    $log_qry->bind_param("ss", $username, $action);
    $log_qry->execute();
    $log_qry->close();

    // Close the connection
    $cn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Prayer Request</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
// If the status is set (meaning approval has occurred), display SweetAlert2
if (isset($status)) {
    if ($status == 'success') {
        echo "
        <script>
          Swal.fire({
            icon: 'success',
            iconColor: 'darkgreen', // Set icon color to dark green for success
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px;\">Prayer Request successfully approved!</span>',
            background: '#fffef0', // Set the background color to light cream
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = './'; // Redirect after success
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            iconColor: 'maroon', // Set icon color to maroon for failure
            title: 'Failed to approve the prayer request!',
            background: '#fffef0', // Set the background color to light cream
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = './'; // Redirect after failure
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
