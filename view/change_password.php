<?php 
session_start();

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Check if the user is already logged in
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    header("Location: ./dashboard/");
    exit(); 
}

$is_otp_sent = isset($_SESSION['otp']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/sjmv-logo.jpg">
  <title>St. John Mary Vianney Parish</title>
  <link rel="stylesheet" type="text/css" href="assets/index.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/animate.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

  
</head>

<header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="../web-sjmv/index.php">
                
                <img src="./assets/sjmv-logo.jpg" class="mr-3" alt="Logo" style="height: 50px; width: 50px;">
                <span class="text" style="color: white;">St. John Mary Vianney Parish</span>
            </a>
        </nav>
    </header>
<style>

body {
    margin: 0;
    padding: 0;
}

header {
    height: 78px;
    line-height: 60px;
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 0 20px;
}

.card {
    background-color: rgba(255, 255, 255, 0.2); /* Very transparent background */
    backdrop-filter: blur(5px); /* Strong blur effect */
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    padding: 20px; /* Reduced padding from 40px to 20px */
    width: 300px; /* Set the width of the card to 300 pixels */
    margin: 0 auto; /* Center the card horizontally */
    margin-top: 120px;
}
.form-control {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    box-shadow: none;
    border-radius: 10px;
    padding: 8px; /* Reduced padding from 12px to 8px */
    font-size: 14px; /* Reduced font size from 16px to 14px */
    color: #333;
}

label {
    font-weight: bold;
    color: #555;
    font-size: 14px; /* Reduced font size from default to 14px */
}

.btn-primary {
    background-color: #4A90E2;
    border: none;
    border-radius: 10px;
    font-size: 16px; /* Reduced font size from 18px to 16px */
    margin-bottom: 12px; /* Reduced padding from 12px to 8px */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Added transition for scale effect */
}

.create-account-btn {
    background-color: transparent;
    color: #357ABD;
    border: 2px solid #357ABD;
    border-radius: 10px;
    font-size: 14px; /* Reduced font size from 16px to 14px */
    padding: 8px; /* Reduced padding from 10px to 8px */
}

    .create-account-btn:hover {
        background-color: #357ABD;
        color: #fff;
    }

    /* Form layout */
    .card-body {
        text-align: center;
    }

    /* CSS for the navbar */
.navbar {
    background: #793232;
    position: fixed;
    top: 0; /* Position navbar at the top of the page */
    left: 0;
    height: 78px; /* Set the height of the navbar to 50 pixels */
}
.navbar-text {
    font-family: "Lora", serif !important;
}
header {
    height: 78px;
    line-height: 60px;
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 0 20px;
    transition: height 0.3s ease, line-height 0.3s ease; 
}

@media (max-width: 768px) {
    header {
        height: 50px; /* Smaller height for mobile */
        line-height: 40px; /* Smaller line height */
    }

    .navbar-brand img {
        height: 40px; /* Adjust logo size */
        width: 40px; /* Adjust logo size */
    }

    .navbar-brand .text {
        font-size: 14px; /* Smaller font size for text */

    }
}
#alert-container {
    margin-bottom: 15px; /* Space between the alert and the form */
}

.alert {
    padding: 15px;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    border: 1px solid transparent;
    width: 100%;
    text-align: center;
}

.alert-info {
    background-color: #d9edf7;
    color: #31708f;
    border-color: #bce8f1;
}

.alert-success {
    background-color: #dff0d8;
    color: #3c763d;
    border-color: #d6e9c6;
}

.alert-warning {
    background-color: #fcf8e3;
    color: #8a6d3b;
    border-color: #faebcc;
}

.alert-danger {
    background-color: #f2dede;
    color: #a94442;
    border-color: #ebccd1;
}

</style>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card animated fadeInDown">
            <div id="alert-container"></div> <!-- Placeholder for the alert -->

                <div class="card-body">
                    
                    <form action="update_pass.php" id="otp-form" method="POST">
                        <div class="form-group mb-4">
                            <label for="identifier">Username or Email</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="identifier" 
                                name="identifier" 
                                placeholder="Enter Username or Email" 
                                value="<?php echo isset($_POST['identifier']) ? htmlspecialchars($_POST['identifier']) : ''; ?>" 
                                required>
                        </div>

                        <div id="otp-section" style="display: <?php echo isset($_GET['otp_sent']) && $_GET['otp_sent'] === 'true' ? 'block' : 'none'; ?>;">
                            <div class="form-group mb-4">
                                <label for="password">New Password</label>
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    id="password" 
                                    placeholder="Enter New Password" 
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="otp">Verification Code</label>
                                <div class="otp-container">
                                    <input 
                                        type="text" 
                                        id="otp" 
                                        class="otp-box" 
                                        name="otp" 
                                        placeholder="Enter code" 
                                        maxlength="6" 
                                        oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '').slice(0, 6);" 
                                        required>
                                    <span id="otp-timer" class="otp-timer"></span>
                                    <button 
                                        type="button" 
                                        id="resend-btn" 
                                        name="otp" 
                                        onclick="resendOTP(document.getElementById('identifier').value)"
                                        style=" margin-top: 10px; margin-left: 10px"
                                        class="hidden btn btn-primary">Resend</button>
                                </div>
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            id="verification-btn"
                            name="<?php echo isset($_GET['otp_sent']) && $_GET['otp_sent'] === 'true' ? 'reset_password' : 'send_otp'; ?>" 
                            class="btn btn-primary btn-block button">
                            <?php echo isset($_GET['otp_sent']) && $_GET['otp_sent'] === 'true' ? 'Reset Password' : 'Verification'; ?>
                        </button>
                        <a href="./index.php" class="btn create-account-btn btn-block">Log in here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .otp-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .otp-box {
        width: 60%;
        padding: 10px;
        font-size: 14px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 11px;
    }

    .otp-timer {
        font-size: 14px;
        color: black;
        margin-left: 10px;
    }

    .hidden {
        display: none;
    }

    .btn-secondary {
        margin-left: 10px;
    }
</style>

<script>
function showMessageAlert(message, type = 'info') {
    const alertContainer = document.getElementById("alert-container");
    if (!alertContainer) return; // Ensure the alert container exists

    // Create the alert div
    const alertDiv = document.createElement("div");
    alertDiv.classList.add("alert", `alert-${type}`); // Add type like 'alert-info', 'alert-success', etc.
    alertDiv.id = "alert-message";
    alertDiv.innerText = message;

    // Insert the alert into the alert container
    alertContainer.innerHTML = ""; // Clear any previous alerts
    alertContainer.appendChild(alertDiv);

    // Set the alert to disappear after 5 seconds
    setTimeout(function () {
        alertDiv.style.display = "none";
    }, 5000);
}

</script>
<script>
let countdownInterval; // Declare countdownInterval globally

function startCountdown(duration, display, resendButton) {
    let timer = duration;

    const startTime = sessionStorage.getItem('otp_start_time');
    if (startTime) {
        const elapsedTime = Math.floor((Date.now() - parseInt(startTime, 0)) / 1000);
        timer = Math.max(0, duration - elapsedTime);
    }

    display.style.display = 'block';
    resendButton.classList.add('hidden');
    clearInterval(countdownInterval);

    countdownInterval = setInterval(() => {
        const minutes = Math.floor(timer / 60);
        const seconds = timer % 60;
        display.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (timer <= 0) {
            clearInterval(countdownInterval);
            display.style.display = 'none';
            resendButton.classList.remove('hidden');
            sessionStorage.removeItem('otp_start_time'); // Clear the saved timer
        }
        timer--;
    }, 1000);
}

document.getElementById('verification-btn').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the form from submitting immediately
    const identifier = document.getElementById('identifier').value;

    // Check if identifier is provided
    if (!identifier) {
        alert("Please enter your username or email.");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const isValidEmail = emailRegex.test(identifier);
    const isValidUsername = identifier.length > 0;

// Validate the identifier
if (!isValidEmail && !isValidUsername) {
    showMessageAlert("Invalid email or username.", "danger");
    return;
}

sessionStorage.setItem('identifier', identifier); // Save the identifier

if (this.name === 'reset_password') {
    const password = document.getElementById('password').value;
    const otp = document.getElementById('otp').value;

    if (!password || !otp) {
        showMessageAlert("Please enter both the new password and the verification code.", "warning");
        return;
    }

    // Prepare data for submission
    const formData = new URLSearchParams();
    formData.append('reset_password', true);
    formData.append('password', password);
    formData.append('otp', otp);

    // Submit the form to reset the password using fetch
    fetch('update_pass.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            showMessageAlert(data.message, data.status === "success" ? "success" : "danger");
            if (data.status === "success") {
                sessionStorage.clear(); // Clear all session storage data on successful reset
                window.location.href = 'login.php'; // Redirect to the login page
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessageAlert("An error occurred. Please try again.", "danger");
        });
} else {
    // Send the OTP to the user's email
    sendOtpToServer(identifier);
}
});

// Function to send OTP to the server
function sendOtpToServer(identifier) {
    const formData = new FormData();
    formData.append('send_otp', true);
    formData.append('identifier', identifier);

    fetch('update_pass.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'invalid') {
                showMessageAlert(data.message, "danger");
                document.getElementById('identifier').value = ''; // Clear the input for retry
                sessionStorage.removeItem('otp_section'); // Remove OTP section visibility
                return; // Exit the function
            } else if (data.status === 'success') {
                showMessageAlert(data.message, "success");
                // Save OTP section visibility and button state
                sessionStorage.setItem('otp_section', 'true');
                sessionStorage.setItem('button_state', 'reset_password');
                document.getElementById('otp-section').style.display = 'block'; // Show OTP section
                document.getElementById('verification-btn').innerText = 'Reset Password';
                document.getElementById('verification-btn').name = 'reset_password'; // Update the button name

                // Start the countdown
                const otpTimerDisplay = document.getElementById('otp-timer');
                const resendButton = document.getElementById('resend-btn');
                const startTime = Date.now();
                sessionStorage.setItem('otp_start_time', startTime);
                startCountdown(600, otpTimerDisplay, resendButton); // Start countdown from 10 minutes
            }
        })
        .catch(error => {
            console.error("Error sending OTP:", error);
            showMessageAlert("An error occurred while sending OTP.", "danger");
        });
}


function resendOTP(identifier) {
    const formData = new FormData();
    formData.append('resend_otp', true);
    formData.append('identifier', identifier);

    fetch('update_pass.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showMessageAlert(data.message, "success");
                const otpTimerDisplay = document.getElementById('otp-timer');
                const resendButton = document.getElementById('resend-btn');
                const startTime = Date.now();
                sessionStorage.setItem('otp_start_time', startTime); // Save start time to sessionStorage
                startCountdown(600, otpTimerDisplay, resendButton); // Countdown from 10 minutes
            } else {
                showMessageAlert(data.message, "danger"); // Error alert if resending failed
            }
        })
        .catch(error => {
            console.error("Error resending OTP:", error);
            showMessageAlert("An error occurred while resending OTP.", "danger");
        });
}


window.addEventListener('DOMContentLoaded', () => {
    const identifierInput = document.getElementById('identifier');
    const otpInput = document.getElementById('otp');
    const passwordInput = document.getElementById('password');
    const verificationButton = document.getElementById('verification-btn');
    const otpSection = document.getElementById('otp-section');
    const otpTimerDisplay = document.getElementById('otp-timer');
    const resendButton = document.getElementById('resend-btn');

    // Initialize values from session storage
    const identifier = sessionStorage.getItem('identifier');
    const otpSectionVisible = sessionStorage.getItem('otp_section') === 'true';
    const buttonName = sessionStorage.getItem('button_name');
    const otpStartTime = sessionStorage.getItem('otp_start_time');

    // Set the identifier input value if it exists
    if (identifier) {
        identifierInput.value = identifier;
    }

    const buttonState = sessionStorage.getItem('button_state');
    if (buttonState) {
        verificationButton.name = buttonState; // Set the button name
        verificationButton.innerHTML = buttonState === 'reset_password' ? 'Reset Password' : 'Verification'; // Set the button text
    }
    // Show OTP section if it was previously visible
    if (otpSectionVisible) {
        otpSection.style.display = 'block';
    }

    // Update verification button text and name if applicable

    // Handle OTP timer if it exists
    if (otpStartTime) {
        const remainingTime = calculateRemainingTime(parseInt(otpStartTime, 0), 600); // 600 seconds for 10 minutes
        if (remainingTime > 0) {
            startCountdown(remainingTime, otpTimerDisplay, resendButton);
        } else {
            sessionStorage.removeItem('otp_start_time'); // Remove expired timer
        }
    }

    // Function to validate identifier (email or username)
    function isValidIdentifier(identifier) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(identifier) || identifier.length > 0; // Non-empty username is valid
    }

    // Function to reset button state
    function resetButtonState() {
        const verificationButton = document.getElementById('verification-btn');
        verificationButton.innerHTML = verificationButton.name === 'reset_password' ? 'Reset Password' : 'Verification'; // Reset button tex
}

// Event listener for identifier input
identifierInput.addEventListener('input', () => {
    const identifier = identifierInput.value;
    if (isValidIdentifier(identifier)) {
        verificationButton.innerHTML = verificationButton.name === 'reset_password' ? 'Reset Password' : 'Verification'; // Update button text dynamically
    } else {
        resetButtonState(); // Reset button state if input is invalid
    }
});

// Event listener for verification button click
verificationButton.addEventListener('click', (event) => {
   const identifier = identifierInput.value; // Get the current identifier value

    // Check if the identifier is valid
    if (!isValidIdentifier(identifier)) {
        resetButtonState(); // Reset button state if input is invalid
        return; // Exit the function early
    }

    // If valid, change button text to indicate action

    const isResetPassword = verificationButton.name === 'reset_password';
    verificationButton.innerHTML = isResetPassword ? 'Resetting Password...' : 'Sending...';

    sessionStorage.setItem('button_state', isResetPassword ? 'reset_password' : 'send_otp');

    // Simulate a delay for the action (you can replace this with your actual function call)
    setTimeout(() => {
        if (isResetPassword) {
            // Call reset password function here
            // sendOtpToServer(identifier); // Uncomment this if needed
        } else {
            // Call send OTP function here
            // sendOtpToServer(identifier); // Uncomment this if needed
        }
        resetButtonState(); // Reset button to its default state after the action is done
    }, 2000); // Adjust the timeout duration as needed
});
    // Reset button state initially
});

// Function to calculate remaining time
function calculateRemainingTime(startTime, duration) {
    const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
    return Math.max(0, duration - elapsedTime);
}

</script>


</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>