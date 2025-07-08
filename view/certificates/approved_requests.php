<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/baptism';</script>";
    exit; // Ensure script stops execution after redirect
}

$request_id = isset($_GET['mid']) ? $_GET['mid'] : "";

// Initialize variables
$requester_first_name = $requester_middle_name = $requester_last_name = 
$requester_email = $requester_contact = $relation_to_person = 
$person_first_name = $person_middle_name = $person_last_name = 
$person_dob = $person_place_of_birth = $person_address = 
$certificate_type = $request_purpose = $status = $request_date = $supporting_document = "";

// Require the necessary classes
require_once '../class/certificate_req.php';
require_once '../class/email.php'; // Require your email class
include 'alert.php';
$CertificateRequest = new certificate_req();

$request_arr = $CertificateRequest->getone($request_id);

// Ensure $request_arr is an associative array
if (!empty($request_arr)) {
    $requester_first_name = $request_arr['requester_first_name'];
    $requester_middle_name = $request_arr['requester_middle_name'];
    $requester_last_name = $request_arr['requester_last_name'];
    $requester_email = $request_arr['requester_email'];
    $requester_contact = $request_arr['requester_contact'];
    $relation_to_person = $request_arr['relation_to_person'];
    $person_first_name = $request_arr['person_first_name'];
    $person_middle_name = $request_arr['person_middle_name'];
    $person_last_name = $request_arr['person_last_name'];
    $person_dob = $request_arr['person_dob'];
    $person_place_of_birth = $request_arr['person_place_of_birth'];
    $person_address = $request_arr['person_address'];
    $certificate_type = $request_arr['certificate_type'];
    $request_purpose = $request_arr['request_purpose'];
    $status = $request_arr['status'];
    $request_date = $request_arr['request_date'];
    $supporting_document = $request_arr['supporting_document'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Certificate Request</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .btn-burlywood {
        background-color: burlywood;
        color: white;
    }
    .btn-burlywood:hover {
        background-color: #eecfa1; /* Lighter burlywood */
        }
    </style>
</head>
<body>
    <div class="container">
        <p><strong>Requester:</strong> <?php echo htmlspecialchars($requester_first_name . ' ' . $requester_middle_name . ' ' . $requester_last_name); ?></p>
        <p><strong>Requester Email:</strong> <?php echo htmlspecialchars($requester_email); ?></p>

        <form method="post" action="approval.php?mid=<?php echo $request_id; ?>">
            <div class="form-group">
                <label for="custom_message">Custom Message:</label>
                <textarea id="custom_message" name="custom_message" class="form-control" rows="5" placeholder="Type your custom message here..." oninput="toggleSelect()"></textarea>
            </div>

            <h5>Select a Predefined Message:</h5>
            <select class="form-control mb-3" id="predefined_messages" name="predefined_messages" onchange="toggleTextarea()">
                <option value="">-- Select a Message --</option>
                <option value="Your request has been approved.">Your request has been approved.</option>
                <option value="Thank you for your patience. Your certificate is ready for collection.">Thank you for your patience. Your certificate is ready for collection.</option>
                <option value="We are pleased to inform you that your request is successful.">We are pleased to inform you that your request is successful.</option>
            </select>

            <button type="submit" name="approve" class="btn btn-burlywood">Approve and Send Email</button>
        </form>
    </div>
</body>
</html>
