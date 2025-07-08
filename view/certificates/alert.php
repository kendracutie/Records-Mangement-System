<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<script>
    // Function to show alert using SweetAlert with custom icon and title colors
    function showAlert(title, text, icon) {
        let iconColor, buttonColor, backgroundColor;

        // Set colors based on the alert type
        switch (icon) {
            case 'success':
                iconColor = '#006400'; // dark green 
                buttonColor = 'burlywood'; // ok 
                backgroundColor = '#fffef0'; // light cream 
                break;
            case 'warning':
                iconColor = '#ffcc00'; // yellow 
                buttonColor = 'burlywood'; // ok 
                backgroundColor = '#fffef0'; // light cream 
                break;
            case 'error':
                iconColor = '#ff0000'; // red 
                buttonColor = 'burlywood'; // ok
                backgroundColor = '#fffef0'; // light cream 
                break;
            default:
                iconColor = '#006400'; //dark green
                buttonColor = 'burlywood'; // ok
                backgroundColor = '#fffef0'; // light cream
                break;
        }

        Swal.fire({
            title: '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;">' + title + '</span>', // Custom dark slate gray title color
            text: text,
            icon: icon,
            iconColor: iconColor,
            confirmButtonText: 'OK',
            confirmButtonColor: buttonColor,
            background: backgroundColor // Set the background color based on alert type
        });
    }
</script>
