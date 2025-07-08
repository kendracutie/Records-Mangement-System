<?php
session_start();


if (isset($_POST['btnLogin'])) {
    // Get username and password from form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    require_once "../includes/connect.php";
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Check if username and password are not empty
    if (!empty($username) && !empty($password)) {
        // Prepare SQL statement to check if user is a regular user
        $sqlUser = "SELECT user_id, username, password FROM user_acc WHERE username = ?";
        $mysqlUser = $cn->prepare($sqlUser);
        $mysqlUser->bind_param('s', $username);
        $mysqlUser->execute();
        $mysqlUser->store_result();
        $mysqlUser->bind_result($idUser, $dbusernameUser, $dbpasswordUser);

        // Check if username belongs to regular user
        if ($mysqlUser->num_rows > 0 && $mysqlUser->fetch()) {
            // Check if password matches
            if (password_verify($password, $dbpasswordUser)) {
                $_SESSION["username"] = $username;
                echo '<script>alert("User successfully logged in!")</script>';
                echo '<script type="text/javascript">setTimeout(function() {
                    window.location = "../web-sjmv/certificate_req.php";
                }, 100);</script>';
            } else {
                echo '<script>alert("Wrong Username or Password")</script>';
                echo '<script>window.location.href="user_login.php";</script>';
            }
        } else {
            echo '<script>alert("Wrong Username or Password")</script>';
            echo '<script>window.location.href="user_login.php";</script>';
        }

        // Close the prepared statement
        $mysqlUser->close();
    } else {
        echo '<script>alert("Username and password cannot be empty")</script>';
    }
}
?>
