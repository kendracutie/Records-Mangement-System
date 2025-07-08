<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. John Marie Vianney Parish</title>
    
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    // Function to show alert using SweetAlert with custom icon and title colors
    function showAlert(title, text, icon) {
        let iconColor, buttonColor, backgroundColor;

        // Set colors based on the alert type
        switch (icon) {
            case 'success':
                iconColor = '#006400'; // dark green 
                buttonColor = 'burlywood'; // OK button color
                backgroundColor = '#fffef0'; // light cream 
                break;
            case 'warning':
                iconColor = '#ffcc00'; // yellow 
                buttonColor = 'burlywood'; // OK button color
                backgroundColor = '#fffef0'; // light cream 
                break;
            case 'error':
                iconColor = '#ff0000'; // red 
                buttonColor = 'burlywood'; // OK button color
                backgroundColor = '#fffef0'; // light cream 
                break;
            default:
                iconColor = '#006400'; // dark green
                buttonColor = 'burlywood'; // OK button color
                backgroundColor = '#fffef0'; // light cream
                break;
        }

        Swal.fire({
    title: '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;">' + title + '</span>',
    text: text,
    icon: icon,
    iconColor: iconColor,
    confirmButtonText: 'OK',
    confirmButtonColor: buttonColor,
    background: backgroundColor,
    customClass: {
        confirmButton: 'no-outline-button'
    }
        });
    }
</script>

<style>
    .no-outline-button {
    color: white !important;
    outline: none !important;
    box-shadow: none !important; /* Ensures no shadow appears as an outline */
}

</style>

</head>
<body>
    <!-- You can leave this empty, as all logic is handled through JavaScript -->
</body>
</html>
