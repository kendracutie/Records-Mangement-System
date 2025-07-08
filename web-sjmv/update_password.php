<?php
require_once 'connection.php';
session_start();

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    echo "<p>User not logged in.</p>";
    exit;
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID from the session

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve old and new passwords
    $oldPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate new passwords match
    if ($newPassword !== $confirmPassword) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'New password and confirm password do not match.',
                    icon: 'error',
                    iconColor: 'red',
                    confirmButtonText: 'OK',
                    background: '#fffef0',
                    customClass: {
                        confirmButton: 'custom-confirm-button'
                    }
                }).then(() => {
                    window.location.href = 'change_password.php'; // Redirect back to change password page
                });
            });
        </script>
        <style>
            .custom-confirm-button {
                background-color: burlywood !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                color: #000 !important;
            }

            .custom-confirm-button:hover {
                filter: brightness(0.9);
            }
        </style>
        ";
        exit;
    }

    // Prepare the statement to fetch the stored password hash from the database
    $sql = "SELECT password FROM user_acc WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();  // Ensure we process the result of this query
    $stmt->bind_result($storedHash);
    $stmt->fetch();
    
    // Verify old password
    if (!password_verify($oldPassword, $storedHash)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Old password is incorrect.',
                    icon: 'error',
                    iconColor: 'red',
                    confirmButtonText: 'OK',
                    background: '#fffef0',
                    customClass: {
                        confirmButton: 'custom-confirm-button'
                    }
                }).then(() => {
                    window.location.href = 'change_password.php'; // Redirect back to change password page
                });
            });
        </script>
        <style>
            .custom-confirm-button {
                background-color: burlywood !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                color: #000 !important;
            }

            .custom-confirm-button:hover {
                filter: brightness(0.9);
            }
        </style>
        ";
        exit;
    }

    // Hash the new password
    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

    // Prepare the update statement to change the password in the database
    $updateSql = "UPDATE user_acc SET password = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    
    if ($updateStmt === false) {
        // Handle the error if preparation fails
        die("Error preparing the update statement: " . $conn->error);
    }
    
    $updateStmt->bind_param("si", $newPasswordHash, $userId);
    
    // Execute the query
    if ($updateStmt->execute()) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: 'Password updated successfully.',
                    icon: 'success',
                    iconColor: 'darkgreen',
                    confirmButtonText: 'OK',
                    background: '#fffef0',
                    customClass: {
                        confirmButton: 'custom-confirm-button'
                    }
                }).then(() => {
                    window.location.href = 'certificate_req.php'; // Redirect to profile page after success
                });
            });
        </script>
        <style>
            .custom-confirm-button {
                background-color: burlywood !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                color: #000 !important;
            }

            .custom-confirm-button:hover {
                filter: brightness(0.9);
            }
        </style>
        ";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update password. Please try again.',
                    icon: 'error',
                    iconColor: 'red',
                    confirmButtonText: 'OK',
                    background: '#fffef0',
                    customClass: {
                        confirmButton: 'custom-confirm-button'
                    }
                }).then(() => {
                    window.location.href = 'certificate_req.php'; // Redirect back to change password page on failure
                });
            });
        </script>
        <style>
            .custom-confirm-button {
                background-color: burlywood !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                color: #000 !important;
            }

            .custom-confirm-button:hover {
                filter: brightness(0.9);
            }
        </style>

        ";   
    }
    // Close statements
    $updateStmt->close();
    $stmt->close();
}
?>
