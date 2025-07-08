<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/confirmation';</script>";
    exit; // Ensure script stops execution after redirect
}


$id = isset($_GET['mid']) ? $_GET['mid'] : "";


require_once '../class/Confirmation.php';
include 'alert.php';
$Confirmation = new Confirmation();

if (isset($_POST['btnUpdate'])) {

    // Check if confirmation_date is set and not empty
    if (!empty($_POST['confirmation_date'])) {
        // Assign form data to variables
        $confirmation_date = $_POST['confirmation_date'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $father_first_name = $_POST['father_first_name'];
        $father_middle_name = $_POST['father_middle_name'];
        $father_last_name = $_POST['father_last_name'];
        $mother_first_name = $_POST['mother_first_name'];
        $mother_middle_name = $_POST['mother_middle_name'];
        $mother_last_name = $_POST['mother_last_name'];
        $priest_title = $_POST['priest_title'] ?? '';
        $priest_fname = $_POST['priest_fname'] ?? '';
        $priest_mname = $_POST['priest_mname'] ?? '';
        $priest_lname = $_POST['priest_lname'] ?? '';
        $place_of_baptism = $_POST['place_of_baptism'];
        $book_no = $_POST['book_no']?? '';
        $page_no = $_POST['page_no']?? '';
        $line_no = $_POST['line_no']?? '';
        $purpose = $_POST['purpose']?? '';
        $encoder = $_POST['encoder'];
        $confirmation_id = $_POST['confirmation_id'];
        $sponsors = array();

        // Collect sponsors data
        $sponsors = [];
        if (!empty($_POST['sponsor_first_name']) && is_array($_POST['sponsor_first_name'])) {
            foreach ($_POST['sponsor_first_name'] as $key => $value) {
                $sponsors[] = array(
                    'sponsor_id' => $_POST['sponsor_id'][$key] ?? null, // Ensure sponsor_id is optional
                    'sponsor_first_name' => $value,
                    'sponsor_middle_name' => $_POST['sponsor_middle_name'][$key],
                    'sponsor_last_name' => $_POST['sponsor_last_name'][$key],
                    'relation' => $_POST['relation'][$key]
                );
            }
        }

        // Call the update method
        $updateConfirmation = $Confirmation->update(
            $confirmation_date, $first_name, $middle_name, $last_name, $age,
        $father_first_name, $father_middle_name, $father_last_name,
        $mother_first_name, $mother_middle_name, $mother_last_name,
        $priest_title, $priest_fname, $priest_mname, $priest_lname,
        $place_of_baptism, $book_no, $page_no, $line_no, $purpose,
        $encoder, $confirmation_id, $sponsors
        );

        if ($updateConfirmation) {
            echo "<script>showAlert('Record Successfully Updated', '', 'success');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
        } else {
            echo "<script>showAlert('A person with the same name already exists!', '', 'error');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php?mid=" . $confirmation_id . "'; }, 2000);</script>";
        }
    }
}
?>