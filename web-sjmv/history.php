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
    <title>Parish History</title>

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
    <link rel="stylesheet" href="css/history.css">

     <!-- SweetAlert2 CSS -->
     <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
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
                <li class="active"><a href="#">About</a>
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
            <li><a href="./prayer.php">Prayer Request</a></li>
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
                                    <li class="active"><a href="#">About</a>
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
                                    <li><a href="./prayer.php">Prayer Request</a></li>
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

  <!-- Parish History content begin here -->
     <h2>Brief History of St. John Mary Vianney and SJMV<span class="black-text"> </span><span class="maroon-text">Parish</span></h2>
     <p class="ft">by Cardinal Tagle and Rev. Fr. Marco Divine B. Pangilinan, SSS</p>
     <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/7fhlySEfR_M?si=vcbf4QOki311mQ9c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="history">
     

         <p>Early Life
        -St. John Mary Vianney, also known as the Curé of Ars, was a French priest renowned for his dedication to pastoral care and his deep spirituality.Birth and Family:John Mary Vianney was born on May 8, 1786, in Dardilly, a small village near Lyon, France. His parents, Matthew and Mary Vianney, were poor farmers.
        - Education and Formation: Despite his modest background, he was educated in his local parish and showed a strong inclination towards the priesthood. However, his academic performance was poor, particularly in Latin, which made his seminary studies challenging. He was ordained a priest on August 13, 1815, after years of struggle and perseverance.</p>
        
         <p>Ministry in Ars
        - Assignment: After his ordination, Vianney was assigned to the parish of Ars, a small village with a troubled reputation. At first, his efforts to reform the parish were met with resistance and skepticism.
        - Pastoral Work: Vianney devoted himself tirelessly to the spiritual welfare of his parishioners. He became known for his profound homilies, compassionate confessionals, and rigorous pastoral care. His dedication to the sacrament of confession became legendary, with people traveling from all over France and beyond to seek his guidance and penance.</p>
        
        <p>Challenges and Mysticism
        -  and Trials: Throughout his ministry, Vianney faced various trials, including opposition from local authorities and personal health issues. Despite these difficulties, he remained steadfast in his mission.
        - Spiritual Gifts: He was known for his deep prayer life, asceticism, and mystical experiences. Many reports of his life include accounts of supernatural occurrences, such as visions and prophetic insights, although these are often considered aspects of his profound spiritual life rather than miraculous events.</p>
        
        <p>Legacy and Canonization
        - Reputation:Vianney's reputation for holiness and his transformative impact on the parish of Ars earned him widespread admiration. He became a symbol of dedication to the priesthood and pastoral care.
        - Death: He died on August 4, 1859, at the age of 73. His funeral was attended by thousands of people, reflecting the wide-reaching influence he had had.
        - Beatification and Canonization: St. John Mary Vianney was beatified by Pope Pius XI on January 3, 1905, and canonized by Pope Pius XI on May 31, 1925. He was declared the patron saint of priests by Pope Pius XI, highlighting his exemplary role in the priestly vocation.</p>
        
        <p>Feast Day and Impact
        - Feast Day: His feast day is celebrated on August 4, the anniversary of his death.
        - Impact: Vianney’s life and work continue to inspire clergy and laypeople alike. He is remembered for his commitment to the pastoral mission of the Church and his profound spiritual depth.</p>
        
       
       <p>
        St. John Mary Vianney Parish in San Leonardo was established on August 4, 2011, and is located in Tambo Adorable, San Leonardo, Nueva Ecija. It is currently led by Rev. Fr. Marco Divine B. Pangilinan, SSS. The parish includes 10 chapels. They provide various sacraments for the parishioners.
        </p><br><br>
    </div>
  <!-- Parish History content  End here -->


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
                            <p style="padding: 0px;">We inspire and reach thousands of Parishioner<br /> in San Leonardo</p>
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
                                <li>st.johmarievianney@gmail.com</li>
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

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->
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
    // JavaScript function to execute on page load
    window.onload = function() {
        console.log("Page has loaded successfully.");
        // Add any initialization logic here
    };
</script>

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
</body>

</html>