<?php

date_default_timezone_set('Asia/Manila');

session_start();

// Redirect if already authorized
if (isset($_SESSION["authorized"])) {
    header("Location: prayer.php");
    exit();
}

require "connection.php";

// Get data from form
$name = isset($_POST["name"]) ? $_POST["name"] : 'Anonymous';
$prayer_req = $_POST["prayer"];
$intention = $_POST["intention"];
$kind = isset($_POST["kind"]) ? $_POST["kind"] : 'private'; // Get the value for kind (private or public)
$current_time = date('Y-m-d H:i:s'); // Get the current time

// Prepare and bind the statement for inserting into the database
$stmt = $conn->prepare("INSERT INTO prayer_req (Name, prayer_rq, prayerType, status, kind, time) VALUES (?, ?, ?, 'pending', ?, ?)");
$stmt->bind_param("sssss", $name, $prayer_req, $intention, $kind, $current_time);

// Initialize status variable
$status = null;

// Execute and check if the insert was successful
if ($stmt->execute()) {
    $status = 'success'; // Set status to success on successful execution
} else {
    $status = 'failed'; // Set status to failed on execution error
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Request Submission</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
// If the status is set, display SweetAlert2
if (isset($status)) {
    if ($status == 'success') {
        echo "
        <script>
          Swal.fire({
            icon: 'success',
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Your prayer request has been submitted for approval.</span>',
            background: '#fffef0', 
            color: '#000000',
            showConfirmButton: false,
            timer: 2500,
            iconColor: '#006400' // Dark green for success
          }).then(() => {
            window.location.href = 'prayer.php'; // Redirect after success
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            title: '<span style=\"color:#2F4F4F;\">Failed to submit prayer request! Please try again.</span>',
            background: '#fffef0',
            color: '#000000',
            showConfirmButton: false,
            timer: 2500,
            iconColor: '#630707' // Maroon for error
          }).then(() => {
            window.location.href = 'prayer.php'; // Redirect after failure
          });
        </script>
        ";
    }
}
?>

</body>
</html>
