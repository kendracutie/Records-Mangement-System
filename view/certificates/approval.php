<?php

session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/certificates';</script>";
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

if (isset($_POST['approve'])) {
    // Collect custom message from the textbox
    $custom_message = $_POST['custom_message'] ?? '';

    // Get the admin username from session
    $approved_by = $_SESSION['username'];

    // Update the request status in the database and set the approved_by
    if ($CertificateRequest->approveRequest($request_id, $approved_by)) {
        // Prepare email parameters
        $toEmail = $requester_email; 
        $toName = $requester_first_name . ' ' . $requester_last_name; 
        $subject = "Certificate Request Approved";
        // Prepare the email body with a standard message and custom message from admin
        $body = "<h3>Your certificate request has been approved</h3>
        <p>Good Day, in the name of the Lord!</p>
        <p>Dear {$toName},</p>
        <p>We are pleased to inform you that your certificate request has been approved. We pray that God's blessings continue to guide you in all that you do.</p>
        <p><strong>Additional Message from Admin:</strong></p>
        <p>{$custom_message}</p>
        <p>If you have any further questions or need assistance, please feel free to contact us.</p>

        <p><br><strong>Tagalog Translation:</strong></p>
        <p>Magandang Araw, sa ngalan ng Panginoon!</p>
        <p>Minamahal na {$toName},</p>
        <p>Ipinapaabot po namin ang magandang balita na ang inyong kahilingan para sa sertipiko ay naaprubahan na. Nawa'y patuloy kayong pagpalain at gabayan ng Diyos sa lahat ng inyong ginagawa.</p>
        <p><strong>Karagdagang Mensahe mula sa Admin:</strong></p>
        <p>{$custom_message}</p>
        <p>Kung mayroon po kayong karagdagang katanungan o pangangailangan ng tulong, huwag po kayong mag-atubiling makipag-ugnayan sa amin.</p>

        <p><br>Best regards,<br>The Admin Team</p>";

        $altBody = "Your certificate request has been approved.

        Good Day, in the name of the Lord!

        Dear {$toName},

        We are pleased to inform you that your certificate request has been approved. We pray that God's blessings continue to guide you in all that you do.

        Additional Message from Admin:
        {$custom_message}

        If you have any further questions or need assistance, please feel free to contact us.

        --- Tagalog Translation ---

        Magandang Araw, sa ngalan ng Panginoon!

        Minamahal na {$toName},

        Ipinapaabot po namin ang magandang balita na ang inyong kahilingan para sa sertipiko ay naaprubahan na. Nawa'y patuloy kayong pagpalain at gabayan ng Diyos sa lahat ng inyong ginagawa.

        Karagdagang Mensahe mula sa Admin:
        {$custom_message}

        Kung mayroon po kayong karagdagang katanungan o pangangailangan ng tulong, huwag po kayong mag-atubiling makipag-ugnayan sa amin.

        Best regards,
        The Admin Team";


        // Instantiate your email class
        $email = new Email(); 

        // Send email using your email class method
        $emailSent = $email->sendEmail($toEmail, $toName, $subject, $body, $altBody);

        // After the email is sent successfully, log the activity for approval
        $activity_log_message = "Approved certificate request for: " . htmlspecialchars($person_first_name . ' ' . $person_last_name);
        $CertificateRequest->logActivity($approved_by, $activity_log_message); 

        // Check if the email was sent successfully
        if ($emailSent) {
            // Use SweetAlert2 for success message
            echo "<script>
                    showAlert('Success!', 'Request successfully approved and email sent.', 'success');
                    setTimeout(function() { window.location.href = 'index.php'; }, 2000);
                  </script>";
        } else {
            // Use SweetAlert2 for partial success message
            echo "<script>
                    showAlert('Partial Success', 'Request approved, but email sending failed.', 'warning');
                    setTimeout(function() { window.location.href = 'index.php'; }, 2000);
                  </script>";
        }
    } else {
        // Use SweetAlert2 for failure message
        echo "<script>
                showAlert('Error!', 'Approval failed! Please try again.', 'error');
                setTimeout(function() { window.location.href = 'index.php?mid=" . $request_id . "'; }, 2000);
              </script>";
    }
}
?>
