<?php
session_start();
require_once "../includes/config.php"; // Make sure this file contains your database connection
include 'alert.php';

// Encryption setup
$cipher_algo = 'AES-256-CBC';
$key = getenv('ENCRYPTION_KEY'); // Use an environment variable
$iv_length = openssl_cipher_iv_length($cipher_algo);

// Encryption function
function encryptData($plaintext, $cipher_algo, $key, $iv_length) {
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($plaintext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

// Decryption function
function decryptData($encryptedData, $cipher_algo, $key) {
    $decoded = base64_decode($encryptedData);
    $iv_length = openssl_cipher_iv_length($cipher_algo);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);

    // Suppress warnings by using the @ operator
    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);

    // Optionally check if decryption failed
    if ($decrypted === false) {
        return null; // or handle as appropriate
    }

    return $decrypted;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $first_name = htmlspecialchars(trim($_POST["first_name"]));
    $middle_name = htmlspecialchars(trim($_POST["middle_name"]));
    $last_name = htmlspecialchars(trim($_POST["last_name"]));
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    // Basic input validation
    if (empty($first_name) || empty($middle_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
        header("Location: reg_form.php?message=All fields are required.");
        exit();
    }

    // Ensure password is not the same as the username
    if ($username === $password) {
        header("Location: reg_form.php?message=Password should not be the same as the username.");
        exit();
    }

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
        header("Location: reg_form.php?message=Invalid email format.");
        exit();
    }

    // Check if email already exists (decrypt the stored email)
    $sql_check = "SELECT user_id, email FROM user_acc";
    $stmt_check = $connection->prepare($sql_check);
    $stmt_check->execute();
    $stmt_check->store_result();
    $stmt_check->bind_result($user_id, $encrypted_email_from_db);

    while ($stmt_check->fetch()) {
        $decrypted_email = decryptData($encrypted_email_from_db, $cipher_algo, $key);

        if ($decrypted_email === $email) {
            // Email already exists
            header("Location: reg_form.php?message=Email already in use.");
            exit();
        }
    }

    // Encrypt the names and email
    $encrypted_first_name = encryptData($first_name, $cipher_algo, $key, $iv_length);
    $encrypted_middle_name = encryptData($middle_name, $cipher_algo, $key, $iv_length);
    $encrypted_last_name = encryptData($last_name, $cipher_algo, $key, $iv_length);
    $encrypted_email = encryptData($email, $cipher_algo, $key, $iv_length);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encrypt password

    // Prepare an SQL statement to insert the new user
    $sql = "INSERT INTO user_acc (first_name, middle_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $encrypted_first_name, $encrypted_middle_name, $encrypted_last_name, $username, $encrypted_email, $hashed_password);

    if ($stmt->execute()) {
        echo '<script>
            showAlert("Success", "Registration successful!", "success");
            setTimeout(function(){ window.location = "index.php"; }, 1500);
        </script>';
    } else {
        echo '<script>
            showAlert("Error", "Registration failed. Please try again later.", "error");
            setTimeout(function(){ window.location = "register.php"; }, 1500);
        </script>';
    }
}
?>
