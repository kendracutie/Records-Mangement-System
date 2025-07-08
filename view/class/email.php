<?php
// Load Composer's autoloader
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
    // Function to send the email
    public function sendEmail($toEmail, $toName, $subject, $body, $altBody) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'st.johnmarievianneyparish@gmail.com';
            $mail->Password = 'cjtj jjcs ogjt qxbr';  // Use your App Password here
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('st.johnmarievianneyparish@gmail.com', 'St. John Mary Vianney Parish');
            $mail->addAddress($toEmail, $toName);

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altBody;

              // Send the email
              $mail->send();
              echo '<div style="display:none;">Success</div>';

              return true; // Indicate success
          } catch (Exception $e) {
              // Log error for debugging (optional)
              error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
              return false; // Indicate failure
          }
    }
}
?>
