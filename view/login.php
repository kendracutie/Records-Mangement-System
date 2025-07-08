<?php
session_start();

if (!isset($_POST['btnLogin'])) {
    header('Location: index.php'); // Redirect if accessed without submitting the form
    exit;
}

if (isset($_POST['btnLogin'])) {
    // Get username and password from form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    require_once "../includes/connect.php";
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Check if username and password are not empty
    if (!empty($username) && !empty($password)) {
        // Prevent using the username as the password
        if ($username === $password) {
            include 'alert.php'; // Include SweetAlert
            echo '<script>
                showAlert("Error", "Username and Password cannot be the same.", "error");
                setTimeout(function() {
                    window.location.href = "index.php"; // Replace with the desired URL
                }, 2000); // Wait for 2 seconds before redirecting
            </script>';
            exit;
        }

        // Prepare SQL statements to check if user is admin, super admin, or regular user
        $sql_user = "SELECT username, password , user_id FROM user_acc WHERE username = ?";
        $sql_admin = "SELECT role, admin_id, username, password, status FROM admins WHERE username = ?";

        // Prepare and execute for regular user
        $mysql_user = $cn->prepare($sql_user);
        $mysql_user->bind_param('s', $username);
        $mysql_user->execute();
        $mysql_user->store_result();
        $mysql_user->bind_result($dbusername, $dbpassword_user, $user_id);

        // Prepare and execute for admin
        $mysql_admin = $cn->prepare($sql_admin);
        $mysql_admin->bind_param('s', $username);
        $mysql_admin->execute();
        $mysql_admin->store_result();
        $mysql_admin->bind_result($role, $id, $dbusername, $dbpassword_admin, $status);

       // Track if password matched
$password_matched = false;

// Check if user exists in user_acc
if ($mysql_user->num_rows > 0) {
    while ($mysql_user->fetch()) {
        // Check if password matches
        if (password_verify($password, $dbpassword_user)) {
            // Set session variables for regular user
            $_SESSION["username"] = $dbusername;
            $_SESSION["role"] = 'user';
            $_SESSION["user_id"] = $user_id;
            include 'alert.php'; // Include SweetAlert

            // Show alert and redirect
            echo '<script>
             showAlert("Success", "' . $username . ' successfully logged in!", "success");

                setTimeout(function() {
                    window.location.href = "../web-sjmv/certificate_req.php"; // Replace with the desired URL
                }, 2000); // Wait for 2 seconds before redirecting
            </script>';
            exit;
        }
    }
}

// Check if user exists in admins table
if ($mysql_admin->num_rows > 0) {
    while ($mysql_admin->fetch()) {
        // Check if the admin is archived
        if ($status === 'archived') {
            include 'alert.php'; // Include SweetAlert
            echo '<script>
                showAlert("Error", "This admin account is archived and cannot log in.", "error");
                setTimeout(function() {
                    window.location.href = "index.php"; // Replace with the desired URL
                }, 2000); // Wait for 2 seconds before redirecting
            </script>';
            exit;
        }

        // Check if password matches
        if (password_verify($password, $dbpassword_admin)) {
            // Set session variables for admin
            $_SESSION["username"] = $dbusername;
            $_SESSION["role"] = $role;
            $_SESSION["user_id"] = $id;
            include 'alert.php'; // Include SweetAlert

            // Show alert and redirect based on admin role
            echo '<script>
                showAlert("Success", "' . $username . ' successfully logged in!", "success");
                setTimeout(function() {
                    window.location.href = "dashboard/index.php"; // Replace with the desired URL
                }, 2000); // Wait for 2 seconds before redirecting
            </script>';
            exit;
        }
    }
}

// If username was correct but password didn't match
if (!$password_matched) {
    include 'alert.php'; // Include SweetAlert
    echo '<script>
        showAlert("Error", "Wrong Username or Password", "error");
        setTimeout(function() {
            window.location.href = "index.php"; // Replace with the desired URL
        }, 2000); // Wait for 2 seconds before redirecting
    </script>';
}
        // Close the prepared statements
        $mysql_user->close();
        $mysql_admin->close();
    } else {
        // Redirect back to login with error for empty username or password
        include 'alert.php'; // Include SweetAlert
        echo '<script>
            showAlert("Error", "Username and password cannot be empty", "error");
            setTimeout(function() {
                window.location.href = "index.php"; // Replace with the desired URL
            }, 2000); // Wait for 2 seconds before redirecting
        </script>';
        exit;
    }
}
?>
