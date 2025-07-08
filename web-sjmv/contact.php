<?php
session_start();
$isLoggedIn = isset($_SESSION['username']) ? 'true' : 'false';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>

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
    <link rel="stylesheet" href="css/prayer.css">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

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
                                    <li><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li class="active"><a href="./contact.php">Contact</a></li>

                                </ul>
                                <div class="top-social">
                                    <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                    <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                                 </div>
                                 <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
                                    <div class="dropdownn">
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
.dropdownn {
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

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Contact Info</h2>
                        <p>This parish is a strong center of religious beliefs among her residents and oversees the conduct of sacramental ceremonies such as baptism, confirmation, and matrimony..</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Address:</td>
                                    <td>Tambo Adorable, San Leonardo, Nueva Ecija</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Phone:</td>
                                    <td>0915 554 2330</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td> stjohnmarievianneyparish@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form id="contactForm" class="contact-form" enctype="multipart/form-data" action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="name" placeholder="Your Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="email" id="email" placeholder="Your Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea id="message" placeholder="Your Message"></textarea>
                                <!-- <input type="file" id="photo" accept="image/*" title="Upload Valid ID"> -->
                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           <br><br><br><br><br>
        </div>
    </section>
    <!-- Contact Section End -->
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
   <!-- Modal for Certificate Request History -->
<div class="modal fade" id="certificateHistoryModal" tabindex="-1" role="dialog" aria-labelledby="certificateHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateHistoryModalLabel">Certificate Request History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display the history of certificate requests for the logged-in user -->
                <div id="certificateHistoryContent"></div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<!-- Edit Personal Information Modal -->
<div class="modal fade" id="editPersonalInfoModal" tabindex="-1" role="dialog" aria-labelledby="editPersonalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPersonalInfoModalLabel">Edit Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_personal_info.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($decryptedFirstName); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($decryptedMiddleName); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($decryptedLastName); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($decryptedUsername); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($decryptedEmail); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-maroon" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-burlywood">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_password.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-maroon" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-burlywood">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>



<style>
/* Center the modal */
.modal-dialog {
    margin: auto;
}

/* Widen the modal */
.modal-lg {
    max-width: 40%; /* Adjust as needed */
    margin-top: 10%;
}

.modal-xl {
    max-width: 70%;
    margin-top: 5%;
}
/* Modal body design */
.modal-body {
    background-color: #f8f9fa; /* Light gray background for better readability */
    padding: 20px; /* Adds padding for spacing */
    border: 1px solid #ced4da; /* Light border around the modal body */
    border-radius: 5px; /* Rounded corners */
}

/* Style for headings */
.modal-body h6 {
    font-weight: bold; /* Bold for emphasis */
    color: #343a40; /* Dark color for headings */
}

/* Style for paragraphs */
.modal-body p {
    color: #495057; /* Slightly muted text color */
}

/* Style for list items */
.modal-body ol li {
    margin-bottom: 10px; /* Space between list items */
    line-height: 1.5; /* Better line spacing */
}

/* Underline the Terms and Conditions link */
a[data-toggle="modal"] {
    text-decoration: underline;
    color: inherit; /* Keeps the link color the same as surrounding text */
}

a[data-toggle="modal"]:hover {
    text-decoration: none; /* Optional: Remove underline on hover for better UX */
}


</style>
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

     <!-- SweetAlert2 JS -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- Js Plugins -->
     <script src="js/jquery-3.3.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/jquery.nice-select.min.js"></script>
     <script src="js/jquery-ui.min.js"></script>
     <script src="js/jquery.slicknav.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/main.js"></script>
    
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
                // Redirect to the certificate request page if logged in
                window.location.href = "certificate_req.php";
            } else {
                // Show SweetAlert if not logged in
                Swal.fire({
                    title: '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;">Login Required</span>', // Custom title color
                    text: 'To request a certificate, you must log in or sign up first.',
                    icon: 'warning',
                    iconColor: '#ffcc00', // Custom icon color (yellow for warning)
                    showCancelButton: true,
                    confirmButtonText: 'Login / Sign Up',
                    cancelButtonText: 'Cancel',
                    backdrop: 'rgba(0, 0, 0, 0.6)',
                    confirmButtonColor: 'burlywood', // Custom confirm button color (dark green)
                    cancelButtonColor: '#630707',
                    background: '#fffef0' // Custom background color (light cream)
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../view/index.php"; // Redirect to login/signup page
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
    function openEditPersonalInfoModal() {
    $('#editPersonalInfoModal').modal('show');
}

function openChangePasswordModal() {
    $('#changePasswordModal').modal('show');
}

</script>
</body>

</html>