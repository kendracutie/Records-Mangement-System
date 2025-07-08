<?php
// Handle the restoring process
if (isset($_GET['mid'])) {
    $mid = $_GET['mid'];

    require_once '../class/Marriage.php';
    $Marriage = new Marriage();

    $restoreMarriage = $Marriage->restore($mid);

    // Set a status based on the result of the restore operation
    if ($restoreMarriage) {
        $status = 'success'; // Successful restore
    } else {
        $status = 'failed'; // Failed to restore
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Restore</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
// If the status is set (meaning restoring has occurred), display SweetAlert2
if (isset($status)) {
    if ($status == 'success') {
        echo "
        <script>
          Swal.fire({
            icon: 'success',
            title: '<span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;\">Record successfully restored</span>',
            background: '#fffef0', 
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 1500,
            iconColor: '#006400' // Dark green for the success icon
          }).then(() => {
            window.location.href = 'index.php'; // Redirect after success
          });
        </script>
        ";
    } elseif ($status == 'failed') {
        echo "
        <script>
          Swal.fire({
            icon: 'error',
            title: <span style=\"color:#2F4F4F;\">'Failed to restore record!</span>',
            background: '#fffef0', 
            color: '#000000', // Black text color for contrast
            showConfirmButton: false,
            timer: 1500,
            iconColor: '#630707' // Maroon color for the error icon
          }).then(() => {
            window.location.href = 'index.php'; // Redirect after failure
          });
        </script>
        ";
    }
}
?>  
<!-- Your page content goes here -->
<a href="?mid=1" class="btn btn-sm btn-secondary btn-block"></a>

</body>
</html>
