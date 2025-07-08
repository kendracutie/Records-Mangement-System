<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/admin_management';</script>";
    exit;
}

// Check if the form was submitted
if (isset($_POST['btnsubmit'])) {
    // Validate form inputs
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        require_once '../class/Admin.php';
        include 'alert.php';
        $Admin = new Admin();

        // Assign form data to an associative array
        $data = [
            $_POST['username'],                // Username
            $_POST['admin_first_name'],       // First Name
            $_POST['admin_last_name'],        // Last Name
            $_POST['password'],                // Password
            $_POST['email'],                   // Email
        ];

        $result = $Admin->insert($data);

if ($result === 'An admin with this username already exists.') {
    echo "<script>showAlert('An admin with this username already exists!', '', 'warning');</script>";
    echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
} elseif (strpos($result, 'Failed to add admin:') === 0) {
    echo "<script>showAlert('Failed to add admin!', '" . $result . "', 'error');</script>";
    echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
} elseif ($result === 'Admin successfully added.') {
    echo "<script>showAlert('Admin Successfully Added', '', 'success');</script>";
    echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
} else {
    echo "<script>showAlert('All fields are required, including username, password, and email!', '', 'warning');</script>";
    echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
}
    }
}
?>
