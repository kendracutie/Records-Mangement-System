<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/admin_management';</script>";
    exit;
}

// Initialize variables (not strictly necessary here, but good practice)
$username = $admin_first_name = $admin_last_name = $password = $email = "";
?>

<style>
    .card {
    border-radius: 10px; /* Add border-radius to cards */
    padding: 3px; /* Add padding to cards */
}
    .btn-burlywood {
        background-color: burlywood;
        color: black;
    }
    .btn-burlywood:hover {
        background-color: #eecfa1; /* Lighter burlywood */
    }
</style>

<form action="process_admin.php" method="post" id="addAdminForm">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="admin_first_name">First Name:</label>
        <input type="text" id="admin_first_name" name="admin_first_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="admin_last_name">Last Name:</label>
        <input type="text" id="admin_last_name" name="admin_last_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <input type="hidden" name="encoder" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
    <div class="pull-right">
        <input type="submit" name="btnsubmit" class="btn btn-burlywood mt-3" value="Add Record">
    </div>
</form>
