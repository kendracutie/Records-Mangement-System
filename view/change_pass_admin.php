<?php
session_start();
require_once "../includes/connect.php"; // Include your DB connection

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

// Include the SweetAlert2 library
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Oops...',
            'text' => 'New password and confirmation do not match!'
        ];
        header("Location: ../index.php"); // Redirect back to the page with the modal
        exit(); // Stop further execution
    }

    // Get the logged-in user's information
    $username = $_SESSION['username']; // Assuming you stored the username in session
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Fetch the user's current password from the database
    $sql = "SELECT password FROM admins WHERE username = ?";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_password_hash);
    $stmt->fetch();

    // Verify if the entered current password matches the stored password
    if (!password_verify($current_password, $db_password_hash)) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Oops...',
            'text' => 'Current password is incorrect!'
        ];
        header("Location: ../index.php"); // Redirect back to the page with the modal
        exit(); // Stop further execution
    }

    // Hash the new password
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql_update = "UPDATE admins SET password = ? WHERE username = ?";
    $stmt_update = $cn->prepare($sql_update);
    $stmt_update->bind_param('ss', $new_password_hash, $username);

    if ($stmt_update->execute()) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'text' => 'Password changed successfully.',
            'confirmButtonClass' => 'btn-white' // Add a custom class
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Error!',
            'text' => 'Error changing password.',
            'confirmButtonClass' => 'btn-white' // Add a custom class
        ];
    }

 
    // Close the statements
    $stmt->close();
    $stmt_update->close();
    $cn->close();

    // Redirect back to the page with the modal
    header("Location: ../index.php");
    exit();
}

// Flush the output buffer and send output
ob_end_flush();
?>
