<?php
session_start();
$isLoggedIn = isset($_SESSION['username']) ? 'true' : 'false';
?>

<?php

require_once 'connection.php';

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    echo "<p>User not logged in.</p>";
    exit;
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function decryptData($encryptedData, $cipher_algo, $key) {
    $decoded = base64_decode($encryptedData);
    $iv_length = openssl_cipher_iv_length($cipher_algo);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);
    
    // Suppress warnings by using the @ operator
    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    
    // Optionally check if decryption failed
    if ($decrypted === false) {
        // Handle the decryption failure (e.g., log an error, return null, etc.)
        return null; // or return an empty string, or handle it as appropriate
    }
    
    return $decrypted;
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID from the session

// Encryption parameters
$cipher_algo = 'AES-256-CBC';
$key = getenv('ENCRYPTION_KEY'); // Retrieve encryption key from environment variable
$iv_length = openssl_cipher_iv_length($cipher_algo);

// Prepare and execute the SQL query to fetch the user's encrypted information
$sql = "SELECT first_name, middle_name, last_name, username, email FROM user_acc WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Decrypt the user's personal information
    $decryptedFirstName = decryptData($row['first_name'], $cipher_algo, $key);
    $decryptedMiddleName = decryptData($row['middle_name'], $cipher_algo, $key);
    $decryptedLastName = decryptData($row['last_name'], $cipher_algo, $key);
    
    // These values will be used in the modal form
    $decryptedUsername = $row['username'];
    
    // Decrypt the email (if it was encrypted)
    $decryptedEmail = decryptData($row['email'], $cipher_algo, $key);
} else {
    // Handle case where no user was found
    echo "No user found with the provided user ID.";
    exit;
}

$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/cert_req.css">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

  
    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
    
        <nav class="mainmenu mobile-menu">
            <ul>
                <li ><a href="./index.php">Home</a></li>
                <li><a href="#">About</a>
                    <ul class="dropdown">
                        <li><a href="mv.php">Mission/Vision</a></li>
                        <li><a href="history.php">Parish History</a></li>
                        <li><a href="image.php">St. John Mary Vianney Image</a></li>
                        <li><a href="priest.php">Parish Priest</a></li>
                        <li><a href="FAQ.php">FAQ</a></li>
                
            </ul>
            <li class="active"><a href="#">Parish</a>
                <ul class="dropdown">
                    <li><a href="sacraments.php">Sacraments</a></li>
                    <li><a href="pb.php">Pastoral Board</a></li>
                    <li><a href="pt.php">Pastoral Team</a></li>
                    <li><a href="os.php">Office & Staff</a></li>
                </ul>
            </li>
            <li><a href="#">Devotion</a>
                <ul class="dropdown">
                    <li><a href="sjmv.php">St. John Mary Vianney</a></li>
                    <li><a href="nov.php">The Novena</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="hw.php">Holy Week in SJMV</a></li>
                </ul>
            </li>
            <li><a href="prayer.php">Prayer Request</a></li>
            <li><a href="#">Certificate Request</a></li>
            <li><a href="./contact.php">Contact</a></li><br><br>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <ul class="top-widget">
            <li><a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a></li>
            <li><a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a></li>
        </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">    
    <div class="top-nav">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="logo.jpg" alt="Logo">
                </a>
            </div>
        </div>
  
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li><a href="./index.php">Home</a></li>
                                    <li><a href="#">About</a>
                                        <ul class="dropdown">
                                            <li><a href="mv.php">Mission/Vision</a></li>
                                            <li><a href="history.php">Parish History</a></li>
                                            <li><a href="image.php">St. John Mary Vianney Image</a></li>
                                            <li><a href="priest.php">Parish Priest</a></li>
                                            <li><a href="FAQ.php">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Parish</a>
                                        <ul class="dropdown">
                                            <li><a href="sacraments.php">Sacraments</a></li>
                                            <li><a href="pb.php">Pastoral Board</a></li>
                                            <li><a href="pt.php">Pastoral Team</a></li>
                                            <li><a href="os.php">Office & Staff</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Devotion</a>
                                        <ul class="dropdown">
                                            <li><a href="sjmv.php">St. John Mary Vianney</a></li>
                                            <li><a href="nov.php">The Novena</a></li>
                                            <li><a href="gallery.php">Gallery</a></li>
                                            <li><a href="hw.php">Holy Week in SJMV</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./prayer.php">Prayer Request</a></li>
                                    <li class="active"><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li><a href="./contact.php">Contact</a></li>
                                </ul>
                                
                                <!-- Social Media and User Dropdown -->
                                <div class="top-social">
                                    <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                    <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                                </div>
                                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle navbar-text" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                                            <i class="fas fa-user-circle icon-spacing"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                            
                                            <!-- Link to edit personal information -->
                                            <a class="dropdown-item item" href="edit_personal_info.php">
                                                <i class="fas fa-user-edit"></i> Edit Personal Information
                                            </a>

                                            <!-- Link to change password -->
                                            <a class="dropdown-item item" href="change_password.php">
                                                <i class="fas fa-key"></i> Change Password
                                            </a>

                                            <!-- Link to certificate request history -->
                                            <a class="dropdown-item item" href="request_history.php">
                                                <i class="fas fa-history"></i> Certificate Request History
                                            </a>

                                            <!-- Logout button with confirmation -->
                                            <a href='../web-sjmv/logout.php' onclick='confirm_logout(event, this.href)' title='Logout' class='dropdown-item item'>
                                                <i class='fas fa-sign-out-alt'></i> Logout
                                            </a>
                                        </div>

                                        </div>
                                    <?php } ?>

                            </div>
                            </nav>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<style>
.dropdown {
    position: absolute;
    top: 23px;
    right: -120px;
}

.icon-spacing {
    margin-right: 5px; /* Adjust the value as needed */
}

.dropdown-menu {
    margin-top: 16px;
    min-width: 240px; /* Set a minimum width for the dropdown */
    height: 240px; /* Fixed height for the dropdown */
    border-radius: 0.5rem; /* Rounded corners */
    margin-right: -20px;
}

.navbar-text {
    display: flex; /* Use flex for better alignment */
    align-items: center; /* Center align items */
}

.dropdown-item.item {
    color: maroon; /* Set the logout link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
    padding: 15px; /* Add padding for better spacing */
}

/* Normal state */
.item {
    color: maroon; /* Set the link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
}

/* Hover state */
.item:hover {
    color: #800000; /* Darker shade of maroon on hover (optional) */
}

/* Active and focus state */
.item:active, .item:focus {
    color: maroon; /* Keep maroon color when clicked or focused */
    outline: none; /* Remove the default outline (focus state) */
    text-decoration: none;
    background-color: transparent; /* Ensure no background color change */
}
</style>

    
<body>
<div class="container mt-5">
    <h2>Request a Certificate</h2>
    <p>Please fill out the form below to request your certificate. Ensure all fields are completed for smooth processing.</p>
    <div class="container mt-5">
    <h2 class="text-center">Certificate Request Form</h2>
    <form action="process_cert_req.php" method="POST" enctype="multipart/form-data">

        <!-- Requester Information -->
        <h4>Requester's Information</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="requesterFirstName">First Name:</label>
                <input type="text" id="requesterFirstName" name="requesterFirstName"  value="<?php echo htmlspecialchars($decryptedFirstName); ?>" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="requesterMiddleName">Middle Name:</label>
                <input type="text" id="requesterMiddleName" name="requesterMiddleName"  value="<?php echo htmlspecialchars($decryptedMiddleName); ?>" class="form-control" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="requesterLastName">Last Name:</label>
                <input type="text" id="requesterLastName" name="requesterLastName"  value="<?php echo htmlspecialchars($decryptedLastName); ?>" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="requesterEmail">Email Address: </label>
            <input type="email" id="requesterEmail" name="requesterEmail"  value="<?php echo htmlspecialchars($decryptedEmail); ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="requesterContact">Contact Number: <span style="color: red;">*</span></label>
            <input type="text" id="requesterContact" name="requesterContact" class="form-control" required>
        </div>

        <!-- Relation to Person Section -->
        <div class="form-group">
            <label for="relationToPerson">Your Relationship to the Person: <span style="color: red;">*</span></label>
            <select id="relationToPerson" name="relationToPerson" class="form-control" required onchange="autoFillPersonInfo()">
                <option value="">Select your relation</option>
                <option value="self">Self</option>
                <option value="parent">Parent</option>
                <option value="sibling">Sibling</option>
                <option value="spouse">Spouse</option>
                <option value="relative">Relative</option>
                <option value="guardian">Guardian</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="supportingDocuments">Valid ID or Government ID: <span style="color: red;">*</span></label>
            <input type="file" id="supportingDocuments" name="supportingDocuments[]" class="form-control" required>
            <small class="form-text text-muted">Upload a photo of your valid ID or government ID.</small>
        </div>

        <!-- Person's Information -->
        <h4>Person's Information (For Whom the Certificate is Requested)</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="personFirstName">First Name: <span style="color: red;">*</span></label>
                <input type="text" id="personFirstName" name="personFirstName" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label for="personMiddleName">Middle Name: <span style="color: red;">*</span></label>
                <input type="text" id="personMiddleName" name="personMiddleName" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="personLastName">Last Name: <span style="color: red;">*</span></label>
                <input type="text" id="personLastName" name="personLastName" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="personDob">Date of Birth: <span style="color: red;">*</span></label>
            <input type="date" id="personDob" name="personDob" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="personPlaceOfBirth">Place of Birth: <span style="color: red;">*</span></label>
            <input type="text" id="personPlaceOfBirth" name="personPlaceOfBirth" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="personAddress">Address: <span style="color: red;">*</span></label>
            <input type="text" id="personAddress" name="personAddress" class="form-control" required>
        </div>

        <!-- Certificate Type Field -->
        <div class="form-group">
            <label for="certificateType">Type of Certificate: <span style="color: red;">*</span></label>
            <select id="certificateType" name="certificateType" class="form-control" required>
                <option value="">Select Certificate Type</option>
                <option value="baptism">Baptism</option>
                <option value="confirmation">Confirmation</option>
            </select>
        </div>

       <!-- Request Purpose Field -->
        <div class="form-group">
            <label for="requestPurpose">Purpose of Request: <span style="color: red;">*</span></label>
            <textarea id="requestPurpose" name="requestPurpose" class="form-control" rows="3" required></textarea>
        </div>
        <!-- Terms and Conditions -->
        <div class="form-group">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I have read and accept the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>.</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="button btn-red">Submit Request</button> 
        <style>
        .button.btn-red{
	right: 0;
	top: 0;
	font-size: 16px;
	background: #630707;
	color: #ffffff;
	padding: 0 16px;
	height: 50px;
	border: none;
	border-radius: 0 2px 2px 0;
}
</style>
<style>
    .btn-burlywood {
        background-color: burlywood;
        color: black;
    }
    .btn-burlywood:hover {
        background-color: #eecfa1; /* Lighter burlywood */
    }

    .btn-maroon {
        background-color: #630707;
        color: white;
    }
    .btn-maroon:hover {
        background-color: #8B2B2B; /* Lighter maroon */
        color: white;
    }
</style>
    </form> <br>

 <!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Make the modal large -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>By submitting this request for a certificate, you agree to the following terms:</p>
                <ol>
                    <li>The information provided must be accurate and true to the best of your knowledge.</li>
                    <li>Requests may take a certain processing time. Please be patient as we review your application.</li>
                    <li>Supporting documents must be provided as specified.</li>
                    <li>The certificates will only be issued upon successful verification of the provided information.</li>
                    <li>Any misuse or fraudulent request may lead to legal action.</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logoo">
                                <a href="#">
                                    <img src="logo.jpg" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach thousands of Parishioner<br /> in San Leonardo</p>
                            <div class="fa-social">
                                <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
                                <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6 style="color: white;">Contact Us</h6>
                            <ul>
                                <li>0915 554 2330</li>
                                <li>stjohnmarievianneyparish@gmail.com</li>
                                <li>Tambo Adorable, San Leonardo Nueva Ecija</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6 style="color: white;">New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

 
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM fully loaded and parsed");

        // Get the login status passed from PHP
        const isLoggedIn = <?php echo $isLoggedIn; ?>; // Pass the boolean directly

        const requestCertLink = document.getElementById("reqCertificate");

        if (requestCertLink) {
            requestCertLink.addEventListener("click", function(e) {
                e.preventDefault();
                console.log("Request Certificate clicked");

                // Check if the user is logged in
                if (isLoggedIn) {
                    // If logged in, redirect to the certificate request page
                    window.location.href = "certificate_req.php";
                } else {
                    Swal.fire({
                    title: 'Login Required',
                    text: 'To request a certificate, you must log in or sign up first.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Login / Sign Up',
                    cancelButtonText: 'Cancel',
                    backdrop: 'rgba(0, 0, 0, 0.7)',  // Darker background overlay
                    confirmButtonColor: 'burlywood',   
                    cancelButtonColor: '#630707',    // Dark red for Cancel button
                    background: '#fffef0',           // Light gray background for the alert box
                    color: '#333',                   // Darker text color for readability
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../view/index.php"; // Change this to your login/signup URL
                        }
                    });
                }
            });
        } else {
            console.error("Element with ID 'reqCertificate' not found");
        }
    });
</script>


<script>
$(document).ready(function() {
    // Ensure the dropdown works properly
    $('#userDropdown').on('click', function() {
        $(this).next('.dropdown-menu').toggle();
    });

    // Close the dropdown if clicking outside of it
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').hide();
        }
    });
});
</script>

<script>

    $(document).ready(function() {
    // Function to load certificate request history
    $('#certificateHistoryModal').on('show.bs.modal', function() {
        // Fetch and display the user's certificate request history from the server
        $.ajax({
            url: 'cert_req.php', // Adjust to your PHP script
            method: 'GET',
            success: function(data) {
                $('#certificateHistoryContent').html(data);
            }
        });
    });
});

</script>

<script>
function loadCertificateHistory() {
    // Set the URL for fetching certificate request history
    var historyUrl = 'cert_req.php';

    // Load the content into the certificateHistoryContent element
    fetch(historyUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('certificateHistoryContent').innerHTML = data;
        })
        .catch(error => console.error('Error loading certificate request history:', error));
}
</script>

<!-- Logout confirmation logic using SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirm_logout(event, url) {
    event.preventDefault(); // Prevent the default link action

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        background: '#fffef0', // Light cream background
        confirmButtonColor: 'burlywood', // Burlywood color for the confirm button
        cancelButtonColor: '#630707', // Maroon color for the cancel button
        confirmButtonText: 'Yes, log out!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Redirect to the logout page if confirmed
        }
    });
}
</script>

<script>
function autoFillPersonInfo() {
    const relation = document.getElementById("relationToPerson").value;
    
    // Get requester's name fields
    const requesterFirstName = document.getElementById("requesterFirstName").value;
    const requesterMiddleName = document.getElementById("requesterMiddleName").value;
    const requesterLastName = document.getElementById("requesterLastName").value;

    // Get person's name fields
    const personFirstName = document.getElementById("personFirstName");
    const personMiddleName = document.getElementById("personMiddleName");
    const personLastName = document.getElementById("personLastName");

    // If "self" is selected, copy the requester's information
    if (relation === "self") {
        personFirstName.value = requesterFirstName;
        personMiddleName.value = requesterMiddleName;
        personLastName.value = requesterLastName;
    } else {
        // Clear the person's information fields if "self" is not selected
        personFirstName.value = "";
        personMiddleName.value = "";
        personLastName.value = "";
    }
}
</script>
</body>

</html>