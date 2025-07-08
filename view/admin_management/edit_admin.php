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

$adminData = $Admin->getOne($id);

// Check if data was retrieved successfully
if (!empty($adminData)) {
    $username = htmlspecialchars($adminData['username']);
    $email = htmlspecialchars($adminData['email']);
    $admin_first_name = htmlspecialchars($adminData['admin_first_name']);
    $admin_last_name = htmlspecialchars($adminData['admin_last_name']);
    $role = htmlspecialchars($adminData['role']);
    // Note: Password should not be pre-filled for security reasons
}
?>

<style>
    .card {
    border-radius: 10px; /* Add border-radius to cards */
    padding: 3px; /* Add padding to cards */
}
    .btn-burlywood {
        background-color: burlywood;
        color: white;
    }
    .btn-burlywood:hover {
        background-color: #e6c59c; /* Lighter burlywood */
        color: white;
    }
</style>

                <form action="edit_process.php?mid=<?php echo $id; ?>" method="post" id="editAdminForm">
                <input type="hidden" name="id" value="<?php echo $_GET['mid']?>">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="admin_fname">First Name:</label>
                        <input type="text" id="admin_fname" name="admin_first_name" value="<?php echo $admin_first_name; ?>"class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_lname">Last Name:</label>
                        <input type="text" id="admin_lname" name="admin_last_name" value="<?php echo $admin_last_name; ?>"class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <small>Leave blank to keep current password.</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
                    </div>

                    <input type="hidden" name="encoder" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" class="form-control">
                    <div class="pull-right">
                        <input type="submit" name="btnUpdate" class="btn btn-burlywood mt-3" value="Update Record">
                    </div>
                </form>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<?php require_once "../table.php"; ?>
