<?php
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/marriage';</script>";
}


if (isset($_POST['btnsubmit'])) {
    require_once '../class/Marriage.php';
    include 'alert.php';
    $Marriage = new Marriage();

    $uploadDir = './uploads/'; // Define the uploads directory
    $groom_photo_name = '';
    $bride_photo_name = '';

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    // Groom photo upload
    if (isset($_FILES['groom_photo']) && $_FILES['groom_photo']['error'] == UPLOAD_ERR_OK) {
        // Generate a unique file name using a timestamp and original file name
        $groom_photo_name = basename($_FILES['groom_photo']['name']); 
        $groom_photo_tmp = $_FILES['groom_photo']['tmp_name'];
        $groom_photo_path = $uploadDir . $groom_photo_name; // Full path to save the file

        // Move the uploaded file to the specified folder
        if (!move_uploaded_file($groom_photo_tmp, $groom_photo_path)) {
            echo "Error uploading groom photo.";
            exit;
        }

    // Bride photo upload
    if (isset($_FILES['bride_photo']) && $_FILES['bride_photo']['error'] == UPLOAD_ERR_OK) {
        $bride_photo_name = basename($_FILES['bride_photo']['name']); // Get the file name
        $bride_photo_tmp = $_FILES['bride_photo']['tmp_name'];
        $bride_photo_path = $uploadDir . $bride_photo_name; // Full path to save the file

        // Move the uploaded file to the specified folder
        if (!move_uploaded_file($bride_photo_tmp, $bride_photo_path)) {
            echo "Error uploading bride photo.";
            exit;
        }
    
    
        $data = [
            0 => $_POST['registration_date'], 
            1 => $_POST['marriage_date'],      
            2 => $_POST['groom_first_name'],   
            3 => $_POST['groom_middle_name'], 
            4 => $_POST['groom_last_name'],  
            5 => $_POST['groom_age'],         
            6 => $_POST['groom_address'],   
            7 => $groom_photo_name,          
            8 => $_POST['mother_groom_first_name'],
            9 => $_POST['mother_groom_middle_name'],
            10 => $_POST['mother_groom_last_name'], 
            11 => $_POST['father_groom_first_name'],
            12 => $_POST['father_groom_middle_name'],
            13 => $_POST['father_groom_last_name'], 
            14 => $_POST['bride_first_name'],        
            15 => $_POST['bride_middle_name'],        
            16 => $_POST['bride_last_name'],          
            17 => $_POST['bride_age'],                
            18 => $_POST['bride_address'],           
            19 => $bride_photo_name,               
            20 => $_POST['mother_bride_first_name'], 
            21 => $_POST['mother_bride_middle_name'], 
            22 => $_POST['mother_bride_last_name'],  
            23 => $_POST['father_bride_first_name'],  
            24 => $_POST['father_bride_middle_name'], 
            25 => $_POST['father_bride_last_name'],  
            26 => $_POST['priest_title'],              
            27 => $_POST['priest_fname'],              
            28 => $_POST['priest_mname'],              
            29 => $_POST['priest_lname'],          
            30 => $_POST['encoder'],                           
        ];

        // Collect sponsor data
        $sponsors = [];
        if (isset($_POST['sponsor_first_name'], $_POST['sponsor_middle_name'], $_POST['sponsor_last_name'], $_POST['sponsor_relation'])) {
            $sponsor_count = count($_POST['sponsor_first_name']);
            for ($i = 0; $i < $sponsor_count; $i++) {
                $sponsors[] = [
                    'first_name' => $_POST['sponsor_first_name'][$i],
                    'middle_name' => $_POST['sponsor_middle_name'][$i],
                    'last_name' => $_POST['sponsor_last_name'][$i],
                    'relation' => $_POST['sponsor_relation'][$i]
                ];
            }
        }

        $result = $Marriage->insert($data);

        if ($result === 'Groom with the same name already exists.') {
            echo "<script>showAlert('A person with the same name already exists!', '', 'warning');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } elseif ($result === 'Bride with the same name already exists.') {
            echo "<script>showAlert('A person with the same name already exists!', '', 'warning');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } elseif (strpos($result, 'Failed to add marriage record:') === 0) {
            echo "<script>showAlert('Failed to add marriage record!', '" . $result . "', 'error');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        } else {
            echo "<script>showAlert('Record Successfully Added', '', 'success');</script>";
            echo "<script>setTimeout(function() { window.location.href = './'; }, 2000);</script>";
        }
    }
}
}        


?>