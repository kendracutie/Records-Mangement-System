<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/baptism';</script>";
    exit; // Ensure script stops execution after redirect
}

$id = isset($_GET['mid']) ? $_GET['mid'] : "";


require_once '../class/Baptism.php';
include 'alert.php'; // Include SweetAlert functions if needed

$Baptism = new Baptism();



if (isset($_POST['btnUpdate'])) {
    // Check if baptism_date is set and not empty
    if (!empty($_POST['baptism_date'])) {
        // Assign form data to variables
        $baptism_date = $_POST['baptism_date'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'] ?? '';  // Ensure default value for gender
        $dob = $_POST['dob'] ?? '';        // Ensure default value for date of birth
        $age = $_POST['age'] ?? '';        // Ensure default value for age
        $place_of_birth = $_POST['place_of_birth'] ?? '';  // Ensure default value
        $address = $_POST['address'] ?? '';  // Ensure default value for address
        $father_first_name = $_POST['father_first_name'];
        $father_middle_name = $_POST['father_middle_name'] ?? '';  // Ensure default value
        $father_last_name = $_POST['father_last_name'];
        $father_address = $_POST['father_address'] ?? '';  // Ensure default value

        $mother_first_name = $_POST['mother_first_name'];
        $mother_middle_name = $_POST['mother_middle_name'] ?? '';  // Ensure default value
        $mother_last_name = $_POST['mother_last_name'];
        $mother_address = $_POST['mother_address'] ?? '';  // Ensure default value
        $marriage = $_POST['marriage'] ?? '';  // Ensure default value

        $priest_title = $_POST['priest_title'] ?? '';  // Ensure default value
        $priest_fname = $_POST['priest_fname'] ?? '';  // Ensure default value
        $priest_mname = $_POST['priest_mname'] ?? '';  // Ensure default value
        $priest_lname = $_POST['priest_lname'] ?? '';  // Ensure default value
        $book_no = $_POST['book_no']?? '';
        $page_no = $_POST['page_no']?? '';
        $line_no = $_POST['line_no']?? '';
        $purpose = $_POST['purpose']?? '';
        $encoder = $_POST['encoder']?? '';
        $baptism_id = $_POST['baptism_id'];

        $sponsors = array();

        // Collect sponsors data
        if (!empty($_POST['sponsor_first_name']) && is_array($_POST['sponsor_first_name'])) {
            foreach ($_POST['sponsor_first_name'] as $key => $value) {
                $sponsors[] = array(
                    'sponsor_id' => $_POST['sponsor_id'][$key] ?? null,  // Ensure sponsor_id is optional
                    'sponsor_first_name' => $value,
                    'sponsor_middle_name' => $_POST['sponsor_middle_name'][$key] ?? '',  // Ensure default value
                    'sponsor_last_name' => $_POST['sponsor_last_name'][$key] ?? '',  // Ensure default value
                    'sponsor_address' => $_POST['sponsor_address'][$key] ?? '',  // Ensure default value
                    'relation' => $_POST['relation'][$key] ?? ''  // Ensure default value
                );
            }
        }
    
        // Call the update method
        $updateBaptism = $Baptism->update(
            $baptism_date, $first_name, $middle_name, $last_name, $gender, $dob, $age, $place_of_birth, $address,
            $father_first_name, $father_middle_name, $father_last_name, $father_address, $marriage,
            $mother_first_name, $mother_middle_name, $mother_last_name, $mother_address, 
            $priest_title, $priest_fname, $priest_mname, $priest_lname, $book_no, $page_no, $line_no, $purpose,
            $encoder, $baptism_id, $sponsors
        );

        if ($updateBaptism) {
            echo "<script>showAlert('Record Successfully Updated', '', 'success');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
        } else {
            echo "<script>showAlert('Update failed!', '', 'error');</script>";
            echo "<script>setTimeout(function() { window.location.href = 'index.php?mid=" . $baptism_id . "'; }, 2000);</script>";
        }
    }
}
?>
