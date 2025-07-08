<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/baptism';</script>";
    exit();
}

if (isset($_POST['btnsubmit'])) {
    if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
        require_once '../class/Baptism.php';
        include 'alert.php'; // Include SweetAlert functions if needed

        $Baptism = new Baptism();

        // Assign form data to variables using an associative array
        $data = [
            0 => $_POST['baptism_date'],
            1 => $_POST['first_name'],
            2 => $_POST['middle_name'],
            3 => $_POST['last_name'],
            4 => $_POST['gender'],
            5 => $_POST['dob'],
            6 => $_POST['age'],
            7 => $_POST['place_of_birth'],
            8 => $_POST['address'],
            12 => $_POST['encoder'],
            13 => $_POST['father_first_name'],
            14 => $_POST['father_middle_name'],
            15 => $_POST['father_last_name'],
            16 => $_POST['father_address'],
            17 => $_POST['marriage'],
            18 => $_POST['mother_first_name'],
            19 => $_POST['mother_middle_name'],
            20 => $_POST['mother_last_name'],
            21 => $_POST['mother_address'],
            23 => $_POST['priest_title'],
            24 => $_POST['priest_fname'],
            25 => $_POST['priest_mname'],
            26 => $_POST['priest_lname'],
        ];

        // Define an array to hold sponsor details
        $sponsors = [];

        // Check if all required sponsor fields are set in $_POST
        if (isset($_POST['sponsor_first_name'], $_POST['sponsor_middle_name'], $_POST['sponsor_last_name'], $_POST['sponsor_address'], $_POST['relation'])) {
            // Assign sponsor details to the $sponsors array
            $sponsors = [
                'sponsor_first_name' => $_POST['sponsor_first_name'],
                'sponsor_middle_name' => $_POST['sponsor_middle_name'],
                'sponsor_last_name' => $_POST['sponsor_last_name'],
                'sponsor_address' => $_POST['sponsor_address'],
                'relation' => $_POST['relation']
            ];
        }

   
        $result = $Baptism->insert($data);

        if ($result === 'Record already exists.') {
            echo "<script>showAlert('Record already exists!', '', 'warning');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } elseif ($result === 'A person with the same name already exists.') {
            echo "<script>showAlert('A person with the same name already exists!', '', 'warning');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } elseif (strpos($result, 'Failed to add record:') === 0) {
            echo "<script>showAlert('Failed to add record!', '" . $result . "', 'error');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } else {
            echo "<script>showAlert('Record Successfully Added', '', 'success');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        }
    }
}        
?>        
