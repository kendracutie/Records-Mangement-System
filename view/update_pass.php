<?php
session_start();
require_once "../includes/config.php"; // Database connection
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Encryption setup
$cipher_algo = 'AES-256-CBC';
$key = getenv('ENCRYPTION_KEY'); // Use an environment variable for encryption key
$iv_length = openssl_cipher_iv_length($cipher_algo);

// Helper function: Decrypt data
function decryptData($encryptedData, $cipher_algo, $key) {
    $decoded = base64_decode($encryptedData);
    $iv = substr($decoded, 0, openssl_cipher_iv_length($cipher_algo));
    $ciphertext = substr($decoded, openssl_cipher_iv_length($cipher_algo));

    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted === false ? null : $decrypted;
}

// Helper function: Send Email
function sendEmail($toEmail, $toName, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'st.johnmarievianneyparish@gmail.com'; // Your email
        $mail->Password = 'cjtj jjcs ogjt qxbr'; // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('st.johnmarievianneyparish@gmail.com', 'St. John Mary Vianney Parish - OTP');
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

// Helper function: Generate OTP
function generateOTP($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $otp;
}

// Helper function: Validate Session Key
function validateSessionKey($key) {
    return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
}

// Main Request Handling
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = trim($_POST["identifier"] ?? '');
    $new_password = trim($_POST["password"] ?? '');
    $otp = trim($_POST["otp"] ?? '');

    // Handle Send OTP
    if (isset($_POST["send_otp"])) {
        if (empty($identifier)) {
            echo json_encode(["status" => "error", "message" => "Please provide an email or username."]);
            exit();
        }
    
        try {
            // Query the database to check for the user
            $sql_check = "SELECT user_id, username, email FROM user_acc";
            $stmt_check = $connection->prepare($sql_check);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
    
            $found_email = null;
            $found_user_id = null;
    
            // Decrypt email and check if identifier matches email or username
            while ($row = $result->fetch_assoc()) {
                $decrypted_email = decryptData($row['email'], $cipher_algo, $key);
                if (($decrypted_email && $decrypted_email === $identifier) || $row['username'] === $identifier) {
                    $found_email = $decrypted_email;
                    $found_user_id = $row['user_id'];
                    break;
                }
            }
    
            // If no match is found
            if (!$found_email) {
                echo json_encode(["status" => "invalid", "message" => "Invalid email or username."]);
                exit();
            }
    
            // Generate OTP
            $otp = generateOTP();
    
            // Store OTP and user details in the session
            $_SESSION["otp"] = $otp;
            $_SESSION["otp_expiry"] = time() + 600; // OTP valid for 10 minutes
            $_SESSION["user_id"] = $found_user_id;
            $_SESSION["email"] = $found_email;
    
            // Email subject and body
            $subject = "Your Verification Code";
            $message = "Dear Parishioner,<br><br>Your verification code is <strong>$otp</strong>. Please note that this code will expire in 10 minutes.<br><br>Thank you,<br>The Admin Team<br>St. John Mary Vianney Parish";
    
            // Send OTP email
            if (sendEmail($found_email, 'User', $subject, $message)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Verification code sent to your email.",
                    "otp_sent" => true // Indicating OTP was sent successfully
                ]);
                exit;
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to send verification code. Please try again later."]);
            }
        } catch (Exception $e) {
            error_log("Error in OTP generation: " . $e->getMessage());
            echo json_encode(["status" => "error", "message" => "An unexpected error occurred. Please try again later."]);
        }
        exit();
    }

    // Handle Resend OTP
    if (isset($_POST["resend_otp"])) {
        if (!validateSessionKey("email")) {
            echo json_encode(["status" => "error", "message" => "Session expired. Please request a new Verification code."]);
            exit();
        }

        // Generate new OTP
        $otp = generateOTP();
        $_SESSION["otp"] = $otp;
        $_SESSION["otp_expiry"] = time() + 600; // OTP valid for 10 minutes

        // Send the new OTP email
        if (sendEmail($_SESSION["email"], 'User', 'Your Verification Code', "Your new code is <strong>$otp</strong>. It will expire in 10 minutes.")) {
            echo json_encode([
                "status" => "success",
                "message" => "New verification code sent to your email.",
                "otp_sent" => true // Indicating OTP was resent successfully
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to resend verification code."]);
        }
        exit();
    }

    // Handle Reset Password
    if (isset($_POST["reset_password"])) {
        if (empty($otp) || empty($new_password)) {
            echo json_encode(["status" => "error", "message" => "All fields are required."]);
            exit();
        }

        if (!validateSessionKey("otp") || time() > $_SESSION["otp_expiry"]) {
            unset($_SESSION["otp"], $_SESSION["otp_expiry"]);
            echo json_encode(["status" => "error", "message" => "Verification code has expired. Please request a new one."]);
            exit();
        }

        if ($otp !== $_SESSION["otp"]) {
            echo json_encode(["status" => "error", "message" => "Invalid Verification code."]);
            exit();
        }

        $user_id = $_SESSION["user_id"];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql_update = "UPDATE user_acc SET password = ? WHERE user_id = ?";
        $stmt_update = $connection->prepare($sql_update);
        $stmt_update->bind_param("si", $hashed_password, $user_id);

        if ($stmt_update->execute()) {
            session_destroy(); // Clear all session variables
            echo json_encode(["status" => "success", "message" => "Password changed successfully."]);
        } else {
            error_log("Error updating password: " . $stmt_update->error);
            echo json_encode(["status" => "error", "message" => "Failed to update password. Please try again."]);
        }
    }
}
?>
