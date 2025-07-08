<?php
session_start();

// Redirect if not logged in
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/marriage';</script>";
    exit; // Ensure script stops execution after redirect
}

require_once '../class/Marriage.php';
include 'alert.php'; // Include SweetAlert functions if needed

$Marriage = new Marriage();

if (isset($_POST['btnUpdate'])) {
    if (!empty($_POST['marriage_date'])) {
        // Retrieve form data
        $groom_first_name = $_POST['groom_first_name'] ?? '';
        $groom_middle_name = $_POST['groom_middle_name'] ?? '';
        $groom_last_name = $_POST['groom_last_name'] ?? '';
        $groom_age = $_POST['groom_age'] ?? '';
        $groom_address = $_POST['groom_address'] ?? '';

        // Additional data retrieval
        $marriage_id = $_POST['marriage_id'];
        $father_groom_first_name = $_POST['father_groom_first_name'] ?? '';
        $father_groom_middle_name = $_POST['father_groom_middle_name'] ?? '';
        $father_groom_last_name = $_POST['father_groom_last_name'] ?? '';
        $mother_groom_first_name = $_POST['mother_groom_first_name'] ?? '';
        $mother_groom_middle_name = $_POST['mother_groom_middle_name'] ?? '';
        $mother_groom_last_name = $_POST['mother_groom_last_name'] ?? '';

        $bride_first_name = $_POST['bride_first_name'] ?? '';
        $bride_middle_name = $_POST['bride_middle_name'] ?? '';
        $bride_last_name = $_POST['bride_last_name'] ?? '';
        $bride_age = $_POST['bride_age'] ?? '';
        $bride_address = $_POST['bride_address'] ?? '';

        $father_bride_first_name = $_POST['father_bride_first_name'] ?? '';
        $father_bride_middle_name = $_POST['father_bride_middle_name'] ?? '';
        $father_bride_last_name = $_POST['father_bride_last_name'] ?? '';
        $mother_bride_first_name = $_POST['mother_bride_first_name'] ?? '';
        $mother_bride_middle_name = $_POST['mother_bride_middle_name'] ?? '';
        $mother_bride_last_name = $_POST['mother_bride_last_name'] ?? '';

        $marriage_date = $_POST['marriage_date'] ?? '';
        $registration_date = $_POST['registration_date'] ?? '';
        $encoder = $_SESSION['username']; // Use session username for encoder

        // Priest details
        $priest_title = $_POST['priest_title'] ?? '';
        $priest_fname = $_POST['priest_fname'] ?? '';
        $priest_mname = $_POST['priest_mname'] ?? '';
        $priest_lname = $_POST['priest_lname'] ?? '';

        $sponsors = array();

        // Collect sponsors data
        if (!empty($_POST['sponsor_first_name']) && is_array($_POST['sponsor_first_name'])) {
            foreach ($_POST['sponsor_first_name'] as $key => $value) {
                $sponsors[] = array(
                    'sponsor_id' => $_POST['sponsor_id'][$key] ?? null,  // Ensure sponsor_id is optional
                    'sponsor_first_name' => $value,
                    'sponsor_middle_name' => $_POST['sponsor_middle_name'][$key] ?? '',  // Ensure default value
                    'sponsor_last_name' => $_POST['sponsor_last_name'][$key] ?? '',  // Ensure default value
                    'relation' => $_POST['relation'][$key] ?? ''  // Ensure default value
                );
            }
        }

         // Retrieve existing photos from the database
        $existingRecord = $Marriage->getcoupleone($marriage_id); // Assume this function fetches the marriage record with photos
        $groom_photo_name = $existingRecord['groom_photo'];
        $bride_photo_name = $existingRecord['bride_photo'];

        // Define the uploads directory
        $uploadDir = './uploads/';

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Function to handle photo upload
        function handlePhotoUpload($photoKey, &$photoName, $uploadDir) {
            if (isset($_FILES[$photoKey]) && $_FILES[$photoKey]['error'] === UPLOAD_ERR_OK) {
                $photoTmp = $_FILES[$photoKey]['tmp_name'];
                $photoName = uniqid() . '-' . basename($_FILES[$photoKey]['name']);
                $photoPath = $uploadDir . $photoName;

                if (move_uploaded_file($photoTmp, $photoPath)) {
                    return $photoName;
                } else {
                    echo "Error uploading $photoKey photo.";
                    exit;
                }
            }
            return null;
        }

        // Only update photo name if a new photo was uploaded
        $newGroomPhoto = handlePhotoUpload('groom_photo', $groom_photo_name, $uploadDir);
        $newBridePhoto = handlePhotoUpload('bride_photo', $bride_photo_name, $uploadDir);

        // Retain existing photo names if no new photos were uploaded
        $groom_photo_name = $newGroomPhoto ?: $groom_photo_name;
        $bride_photo_name = $newBridePhoto ?: $bride_photo_name;

        // Update marriage record in the database
        $updateMarriage = $Marriage->updateMarriage(
            $groom_first_name, $groom_middle_name, $groom_last_name, $groom_age, $groom_address,
            $father_groom_first_name, $father_groom_middle_name, $father_groom_last_name,
            $mother_groom_first_name, $mother_groom_middle_name, $mother_groom_last_name,
            $bride_first_name, $bride_middle_name, $bride_last_name, $bride_age, $bride_address,
            $father_bride_first_name, $father_bride_middle_name, $father_bride_last_name,
            $mother_bride_first_name, $mother_bride_middle_name, $mother_bride_last_name,
            $marriage_date, $registration_date, $encoder, $marriage_id, $priest_title, $priest_fname, $priest_mname, $priest_lname,
            $sponsors, $groom_photo_name, $bride_photo_name
        );

        if ($updateMarriage) {
            echo "<script>showAlert('Record Successfully Updated', '', 'success');</script>";
            echo "<script>setTimeout(function() {window.location.href='index.php'; }, 2000);</script>";

        } else {
            echo "<script>showAlert('A person with the same name already exists!', '', 'error');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php?mid=" . $marriage_id . "'; }, 2000);</script>";
        }
    }
}
?>