<?php

require_once 'connection.php';
session_start(); // Start the session

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    echo "<p>User not logged in.</p>";
    exit;
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Encrypt Data Function
function encryptData($plaintext, $cipher_algo, $key, $iv_length) {
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($plaintext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID from the session

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $middleName = $conn->real_escape_string(trim($_POST['middle_name']));
    $lastName = $conn->real_escape_string(trim($_POST['last_name']));
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));

    // List of allowed domains
    $allowed_domains = [
        'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'icloud.com',
        'aol.com', 'live.com', 'msn.com', 'mail.com', 'protonmail.com',
        'zoho.com', 'yandex.com', 'gmx.com', 'comcast.net', 'me.com',
        'inbox.com', 'fastmail.com', 'tutanota.com', 'mail.ru'
    ];

    // Extract domain from email
    $domain = substr(strrchr($email, "@"), 1);

    // Email validation using preg_match and checking allowed domain
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) || !in_array($domain, $allowed_domains)) {
        header("Location: edit_personal_info.php?message=Invalid email address.");
        exit();
    }

    // Define encryption parameters
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable or predefined key
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    // Encrypt the personal information
    $encryptedFirstName = encryptData($firstName, $cipher_algo, $key, $iv_length);
    $encryptedMiddleName = encryptData($middleName, $cipher_algo, $key, $iv_length);
    $encryptedLastName = encryptData($lastName, $cipher_algo, $key, $iv_length);
    $encryptedEmail = encryptData($email, $cipher_algo, $key, $iv_length);

    // Prepare and execute the SQL query to update the user’s information
    $sql = "UPDATE user_acc SET first_name = ?, middle_name = ?, last_name = ?, username = ?, email = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the statement
    $stmt->bind_param("sssssi", $encryptedFirstName, $encryptedMiddleName, $encryptedLastName, $username, $encryptedEmail, $userId);

    if ($stmt->execute()) {
        // Success message
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Personal information updated successfully.',
                icon: 'success',
                iconColor: 'darkgreen', /* Sets success icon color */
                confirmButtonText: 'OK',
                background: '#fffef0', /* Light green background for the modal */
                customClass: {
                    confirmButton: 'swal-button-custom',
                    popup: 'swal-popup-custom' /* Custom class for the modal */
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'certificate_req.php'; // Redirect after alert is dismissed
                }
            });
        });
    </script>
    
    <style>
        /* Custom styling for the confirm button */
        .swal-button-custom {
            background-color: burlywood !important; /* Set button color */
            border: none !important; /* Remove border */
            outline: none !important; /* Remove outline */
            box-shadow: none !important; /* Removes the shadow */
            color: #000 !important; /* Optional: improves text visibility */
        }
    
        /* Custom modal background */
        .swal-popup-custom {
            background-color: #fffef0 !important; /* Light green background */
        }
    </style>
    
        ";
    } else {
        // Error message
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update personal information. Please try again.',
                icon: 'error',
                iconColor: 'red', /* Red icon for error */
                confirmButtonText: 'OK',
                background: '#fffef0', /* Light green background for the modal */
                customClass: {
                    confirmButton: 'swal-button-custom',
                    popup: 'swal-popup-custom' /* Reuse the same modal background class */
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'certificate_req.php'; // Redirect back to the edit page
                }
            });
        });
    </script>
    
    <style>
        /* Custom styling for the confirm button */
        .swal-button-custom {
            background-color: burlywood !important; /* Set button color */
            border: none !important; /* Remove border */
            outline: none !important; /* Remove outline */
            box-shadow: none !important; /* Removes the shadow */
            color: #000 !important; /* Optional: improves text visibility */
        }
    
        /* Custom modal background */
        .swal-popup-custom {
            background-color: #fffef0 !important; /* Light green background */
        }
    </style>
    
        ";
    }

    // Clean up
    $stmt->close();
}
?>
    