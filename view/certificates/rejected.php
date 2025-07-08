<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/baptism';</script>";
    exit; // Ensure script stops execution after redirect
}

$request_id = isset($_GET['mid']) ? $_GET['mid'] : "";

// Require the necessary classes
require_once '../class/certificate_req.php';
require_once '../class/email.php'; // Require your email class
include 'alert.php';
$CertificateRequest = new certificate_req();

$request_arr = $CertificateRequest->getone($request_id);

// Ensure $request_arr is an associative array
if (!empty($request_arr)) {
    $requester_first_name = $request_arr['requester_first_name'];
    $requester_last_name = $request_arr['requester_last_name'];
    $requester_email = $request_arr['requester_email'];

    $person_first_name = $request_arr['person_first_name'];
    $person_last_name = $request_arr['person_last_name'];
}

// Check if the form has been submitted for declining the request
if (isset($_POST['decline'])) {
    // Collect the custom message provided by the admin
    $custom_message = $_POST['custom_message'] ?? '';

    // Get the admin username from the session
    $declined_by = $_SESSION['username'];

    // Update the request status in the database and record who declined it
    if ($CertificateRequest->declineRequest($request_id, $declined_by)) {
        // Prepare email parameters
        $toEmail = $requester_email; // Correctly use the requester email
        $toName = $requester_first_name . ' ' . $requester_last_name; // Full name of the recipient
        $subject = "Certificate Request Declined";
        
       // Prepare the email body with a standard message and custom message from admin
        $body = "<h3>Your certificate request has been declined</h3>
        <p>Good Day, in the name of the Lord!</p>
        <p>Dear {$toName},</p>
        <p>We regret to inform you that your certificate request has been declined. We pray that God's wisdom and guidance be with you during this time.</p>
        <p><strong>Reason for Decline:</strong></p>
        <p>{$custom_message}</p>
        <p>May the Lord continue to bless and guide you. If you have any further questions, please feel free to reach out to us.</p>

        <p><br><strong>Tagalog Translation:</strong></p>
        <p>Magandang Araw, sa ngalan ng Panginoon!</p>
        <p>Minamahal na {$toName},</p>
        <p>Ipinapaabot po namin ang aming paumanhin, ang inyong kahilingan para sa sertipiko ay hindi naaprubahan. Nawa'y ang karunungan at gabay ng Diyos ay sumaiyo sa panahong ito.</p>
        <p><strong>Dahilan ng Pagkaka-decline:</strong></p>
        <p>{$custom_message}</p>
        <p>Nawa'y patuloy kayong pagpalain at gabayan ng Panginoon. Kung mayroon po kayong karagdagang katanungan, huwag po kayong mag-atubiling makipag-ugnayan sa amin.</p>

        <p><br>Best regards,<br>The Admin Team</p>";

      // Define the alternative plain-text version of the email body
        $altBody = "Your certificate request has been declined

        Good Day, in the name of the Lord!

        Dear {$toName},

        We regret to inform you that your certificate request has been declined. We pray that God's wisdom and guidance be with you during this time.

        Reason for Decline:
        {$custom_message}

        May the Lord continue to bless and guide you. If you have any further questions, please feel free to reach out to us.

        Tagalog Translation:

        Magandang Araw, sa ngalan ng Panginoon!

        Minamahal na {$toName},

        Ipinapaabot po namin ang aming paumanhin, ang inyong kahilingan para sa sertipiko ay hindi naaprubahan. Nawa'y ang karunungan at gabay ng Diyos ay sumaiyo sa panahong ito.

        Dahilan ng Pagkaka-decline:
        {$custom_message}

        Nawa'y patuloy kayong pagpalain at gabayan ng Panginoon. Kung mayroon po kayong karagdagang katanungan, huwag po kayong mag-atubiling makipag-ugnayan sa amin.

        Best regards,
        The Admin Team";


        // Instantiate your email class
        $email = new Email(); // Ensure you instantiate your Email class

        // Send the email using your email class's method
        $emailSent = $email->sendEmail($toEmail, $toName, $subject, $body, $altBody);

        // After the email is sent successfully, log the activity for approval
        $activity_log_message = "Declined certificate request for: " . htmlspecialchars($person_first_name . ' ' . $person_last_name);
        $CertificateRequest->logActivity($declined_by, $activity_log_message);

        // Check if the email was sent successfully
        if ($emailSent) {
            // Use SweetAlert2 for success message
            echo "<script>
                    showAlert('Success!', 'Request successfully declined and email sent.', 'success');
                    setTimeout(function() { window.location.href = 'index.php'; }, 2000);
                  </script>";
        } else {
            // Use SweetAlert2 for partial success message
            echo "<script>
                    showAlert('Partial Success', 'Request declined, but email sending failed.', 'warning');
                    setTimeout(function() { window.location.href = 'index.php'; }, 2000);
                  </script>";
        }
    } else {
        // Use SweetAlert2 for failure message
        echo "<script>
                showAlert('Error!', 'Decline failed! Please try again.', 'error');
                setTimeout(function() { window.location.href = 'index.php?mid=" . $request_id . "'; }, 2000);
              </script>";
    }
}
?>
