<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/admin';</script>";
    exit; // Ensure script stops execution after redirect
}

$id = isset($_GET['mid']) ? $_GET['mid'] : "";

$username = $admin_first_name = $admin_last_name = $email = $password = "";
require_once '../class/Admin.php';
include 'alert.php';
$Admin = new Admin();


if (isset($_POST['btnUpdate'])) {
    // Assign form data to variables
    $username = $_POST['username'];
    $admin_first_name = $_POST['admin_first_name'];
    $admin_last_name = $_POST['admin_last_name'];
    $password = $_POST['password']; // Handle password appropriately
    $email = $_POST['email'];
    
    // Call the update method
    $updateAdmin = $Admin->updateAdmin($id, $username, $admin_first_name, $admin_last_name, $email, $password);

    if ($updateAdmin) {
        echo "<script>showAlert('Record Successfully Updated', '', 'success');</script>";
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
    } else {
        echo "<script>showAlert('Update failed. Username or email might already exist.', '', 'error');</script>";
        echo "<script>setTimeout(function() { window.location.href = 'edit.php?mid=" . $id . "'; }, 2000);</script>";
    }
} 
?>