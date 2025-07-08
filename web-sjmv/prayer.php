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
    <title>Prayer Request</title>

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
<body>
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
                        <li><a href="event.php">Event Calendar</a></li>
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
            <li class="active"><a href="./prayer.php">Prayer Request</a></li>
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
                                            <li><a href="event.php">Event Calendar</a></li>
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
                                    <li  class="active"><a href="./prayer.php">Prayer Request</a></li>
                                    <li><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li><a href="./contact.php">Contact</a></li>

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
    		    <!-- Prayer Request Content Here -->
                        
                <div class="container">
                
                    <div class="card" style="background-color: #793232;">
                    <div class="prayer-request-header">
                        <h2>Prayer Request</h2><br>
                       
                        <i id="modalBtn" title="Add Prayer Request" class="icon_pencil_alt" style="color: #efd1d1;"></i>
                    </div>
                </div>
                    <p style="text-align: center;">Your prayer request will be included in our daily Masses.<p>
                        <hr>
                    <div class="prayer-request-card">
                        <div class="prayer-request-form">
                            <div id="chatbox">
                                    <?php include 'approved.php'; ?>
                                
                            </div>
                        </div>
                        <div class="prayer-request-image">
                            <img src="img/sj.jpg" alt="St. John Image">
                        </div>
                    </div>
                </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color: #630707; margin-bottom: 8px;">Prayer Request Form</h2>
            <form method="POST" action="send.php">  
                <input type="text" id="nameInput" name="name" placeholder="Your Name (Optional)">

                <input type="text" id="messageInput" name="prayer" placeholder="Type your prayer request here...">
                <select id="prayerType" name="intention">
                    <option value="Thanksgiving">Thanksgiving</option>
                    <option value="Special Intention">Special Intention</option>
                    <option value="Soul">Soul</option>
                </select><br>
                <!-- Toggle for Public or Private Request -->
<label for="privacyToggle" style="margin-top: 10px; display: block; color: #630707; text-align: left;">Request Type:</label>
<div style="display: flex; align-items: center; margin-top: 5px;">
    <span style="margin-right: 10px;">Private</span>
    <label class="switch">
        <input type="checkbox" id="privacyToggle" name="kind" value="public" onchange="updatePrivacyMessage()">
        <span class="slider round"></span>
    </label>
    <span style="margin-left: 10px;">Public</span>
</div>



        <button type="submit" style="background-color: #793232; margin-top: 15px;">Send</button> 
    </form>

    <p>Please provide the necessary information when submitting a prayer request.</p>
    
    <!-- Privacy Message -->
    <p id="privacyMessage" style="color: #793232; font-style: italic; margin-top: 10px;">
        Note: Your prayer request will be kept private and will not be posted online.
    </p>
</div>
    </div>    
<br><br>
<!-- CSS for Toggle Switch -->
<style>
.switch {
    position: relative;
    display: inline-block;
    margin-top: 1.5%;
    width: 34px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 20px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #793232;
}

input:checked + .slider:before {
    transform: translateX(14px);
}


</style>
<!-- JavaScript to Update Privacy Message -->
<script>
function updatePrivacyMessage() {
    var privacyToggle = document.getElementById("privacyToggle");
    var privacyMessage = document.getElementById("privacyMessage");

    if (privacyToggle.checked) {
        privacyMessage.innerHTML = "Note: Your prayer request will be posted online.";
    } else {
        privacyMessage.innerHTML = "Note: Your prayer request will be kept private and will not be posted online.";
    }
}

document.querySelector("form").onsubmit = function() {
    var privacyToggle = document.getElementById("privacyToggle");
    // Update the `kind` field based on the checkbox state
    privacyToggle.value = privacyToggle.checked ? "public" : "private";
};

</script>
    <script>
        // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("modalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
    // Disable scrolling on the body and html
    document.body.style.overflow = "hidden"; // Prevent scrolling on the body
    document.documentElement.style.overflow = "hidden"; // Prevent scrolling on the HTML
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    // Enable scrolling on the body and html
    document.body.style.overflow = "auto"; // Allow scrolling on the body
    document.documentElement.style.overflow = "auto"; // Allow scrolling on the HTML
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        // Enable scrolling on the body and html
        document.body.style.overflow = "auto"; // Allow scrolling on the body
        document.documentElement.style.overflow = "auto"; // Allow scrolling on the HTML
    }
}


        // Function to add a new message to the chatbox
        function addMessage(prayerType, name, message) {
            const chatbox = document.getElementById('chatbox');
            const messageCard = document.createElement('div');
            messageCard.classList.add('message-card');
            messageCard.innerHTML = `<strong>${name ? name + ':' : ''}</strong> ${message} <em>(${prayerType})</em>`;
            chatbox.appendChild(messageCard);
            chatbox.scrollTop = chatbox.scrollHeight; // Auto-scroll to the bottom
        }

        // Event listener for form submission
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            const prayerType = document.getElementById('prayerType').value;
            const nameInput = document.getElementById('nameInput');
            const messageInput = document.getElementById('messageInput');
            const name = nameInput.value.trim();
            const message = messageInput.value.trim(); // Get the message content
            if (message !== '') {
                addMessage(prayerType, name, message); // Add the message to the chatbox
                modal.style.display = "none"; // Close the modal
                nameInput.value = ''; // Clear the name input field
                messageInput.value = ''; // Clear the message input field
            }
        });
  
        // Function to add a new message to the chatbox
        function addMessage(prayerType, name, message) {
            const chatbox = document.getElementById('chatbox');
            const messageCard = document.createElement('div');
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12; // Convert hours to 12-hour format
            const formattedMinutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero to minutes if less than 10
            const formattedTime = `${formattedHours}:${formattedMinutes} ${ampm}`;

            // Create message object
            const newMessage = {
                prayerType: prayerType,
                name: name,
                message: message,
                time: formattedTime
            };

            // Retrieve existing messages from local storage or initialize an empty array
            let messages = JSON.parse(localStorage.getItem('messages')) || [];

            // Add the new message to the array
            messages.push(newMessage);

            // Save the updated messages back to local storage
            localStorage.setItem('messages', JSON.stringify(messages));

            // Update the chatbox display
            messageCard.classList.add('message-card');
            messageCard.innerHTML = `<strong>${name ? name + ':' : ''}</strong> ${message} <em>(${prayerType})</em><span class="message-time">${formattedTime}</span>`;
            chatbox.appendChild(messageCard);
            chatbox.scrollTop = chatbox.scrollHeight; // Auto-scroll to the bottom
        }

        // Function to load messages from local storage and display them in the chatbox
        function loadMessages() {
            const chatbox = document.getElementById('chatbox');
            let messages = JSON.parse(localStorage.getItem('messages')) || [];
            messages.forEach(message => {
                const messageCard = document.createElement('div');
                messageCard.classList.add('message-card');
                messageCard.innerHTML = `<strong>${message.name ? message.name + ':' : ''}</strong> ${message.message} <em>(${message.prayerType})</em><span class="message-time">${message.time}</span>`;
                chatbox.appendChild(messageCard);
            });
            chatbox.scrollTop = chatbox.scrollHeight; // Auto-scroll to the bottom
        }

        // Load messages when the page is loaded
        window.onload = function() {
            loadMessages();
        }

        // Event listener for form submission
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            const prayerType = document.getElementById('prayerType').value;
            const nameInput = document.getElementById('nameInput');
            const messageInput = document.getElementById('messageInput');
            const name = nameInput.value.trim();
            const message = messageInput.value.trim(); // Get the message content
            if (message !== '') {
                addMessage(prayerType, name, message); // Add the message to the chatbox
                nameInput.value = ''; // Clear the name input field
                messageInput.value = ''; // Clear the message input field
            }
        });
    </script>
 </script>
 <!-- Prayer Request Content End Here -->
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