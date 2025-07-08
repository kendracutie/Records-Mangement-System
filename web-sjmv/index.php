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
    <title>Home</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

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
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                <li class="active"><a href="./index.php">Home</a></li>
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
            <li><a href="./prayer.php">Prayer Request</a></li>
            <li><a href="#">Certificate Request</a></li>
            <li><a href="./contact.php">Contact</a></li><br><br>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <ul class="top-widget">
            <li><a href="https://www.facebook.com/johnmarievianneyparish"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/StJohnVianneySc"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fab fa-chrome"></i></a></li>
            <li><a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fab fa-youtube-play"></i></a></li>
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
                                    <li class="active"><a href="./index.php">Home</a></li>
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
                                    <li><a href="./prayer.php">Prayer Request</a></li>
                                    <li><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li><a href="./contact.php">Contact</a></li>

                                </ul>
                                <div class="top-social">
                                    <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fab fa-facebook"></i></a>
                                    <a href="https://x.com/StJohnVianneySc"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fab fa-chrome"></i></a>
                                    <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fab fa-youtube-play"></i></a>
                                </div>
                                
                                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
                                    <div class="dropdownn">
                                        <a class="nav-link dropdown-toggle navbar-text" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                                            <i class="fa fa-user-circle icon-spacing"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
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

<style>
    .about-pic img {
        border-radius: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .about-pic img:hover {
        transform: scale(1.05);
    }
</style>

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text" >
                        <h1 >St. John Mary Vianney Parish</h1>
                        <p >Ang St. John Mary Vianney Parish, Bagong Parokyang nasasakupan ng Diocese ng Cabanatuan</p>
                        <a href="history.php" class="primary-btn" >Discover Now</a>
                    </div>
                </div>
             
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/bg3.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/bg2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/bg.jpg"></div>
            
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About</span>
                            <h2>St. John Mary Vianney Parish</h2>
                        </div>
                        <p class="f-para">Bagong Parokyang nasasakupan ng Diocese ng Cabanatuan.</p>
                        <p class="s-para">St. John Mary Vianney Parish Church established on August 4, 2011, located in Brgy. Tambo Adorable, San Leonardo, Nueva Ecija. Currently under the guidance of the respected Rev. Fr. Marco Divine B. Pangilinan, SSS. This parish is a strong center of religious beliefs among her residents and oversees the conduct of sacramental ceremonies such as baptism, confirmation, and matrimony.</p>
                        <a href="history.php" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                
                 <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row" style="gap: 10px;">
                            <div class="col-sm-12">
                                <img src="p1.jpg" alt="image" height="250" width="300px" class="gallery-img" >
                            </div>
                            <div class="col-sm-12">
                                <img src="p2.jpg" alt="image" height="250" width="300px" class="gallery-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About  Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <h4>Baptism</h4>
                        <p> At St. John Mary Vianney Parish, we're dedicated to helping families prepare for the beautiful sacrament of baptism. Our baptism preparation services include informative sessions, guidance on baptismal requirements, and support for parents and godparents. Join us as we celebrate the beginning of your child's spiritual journey at St. John Mary Vianney Parish.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <h4>Confirmation </h4>
                        <p>At St. John Mary Vianney Parish, we host a variety of Confirmation activities to support candidates on their journey. From informative sessions to community events, we ensure that each step towards Confirmation is engaging and meaningful. Join us as we celebrate this important sacrament together at St. John Mary Vianney Parish.</p>
                    </div>
                </div>
              
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <h4>Marriage</h4>
                        <p> At St. John Mary Vianney Parish, we offer comprehensive marriage preparation services to support couples as they embark on this sacred journey together. Our program includes counseling sessions, workshops, and resources designed to strengthen relationships and build a foundation for a lifelong partnership. Join us as we walk alongside you in preparation for your marriage at St. John Mary Vianney Parish.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Who are we Section Begin -->
    <div class="col-lg-12">
        <div class="section-title">
            <span>Who are we</span>
            <h2>Parish History</h2>
        </div>
    </div>
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/events/picc1.jpg">
                            <div class="hr-text">
                                <h3>About St. John Mary Vianney Parish</h3>
                                <a href="history.php" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/events/pic2.jpg">
                            <div class="hr-text">
                                <h3>Mission/Vision</h3>
                                <a href="mv.php" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/events/pic3.jpg">
                            <div class="hr-text">
                                <h3>Gallery</h3>
                                <a href="gallery.php" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/events/pic4.jpg">
                            <div class="hr-text">
                                <h3>FAQ</h3>
                                <a href="FAQ.php" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

    <!-- M/V Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Mission and Vision Statement</span>
                        <h2>St. John Mary Vianney Parish</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>The Mission of Saint John Vianney Catholic Church is to use our diverse community
                                and Eucharistic Centered Faith to follow the servant example of Christ and
                                nurture His loving spirit, so that all parishioners are empowered to practice
                                and spread the Gospel of Jesus Christ.</p>
                            
                        
                        </div>
                        <div class="ts-item">
                            <p>
                                The vision of St. John Mary Vianney Parish is to make an impact for God, here in San Leonardo, Nueva Ecija by helping people understand the enriching messages of eternal hope given to us by Jesus Christ through His words and deeds. Come just as you are - we'd love to get to know you better. </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- M/V Section End -->

    <!-- Parish Activities Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Parish Activities</span>
                        <h2>Events and Sacramental Ceremonies</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/pic1.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Easter Sunday 2024</span>
                            <h4><a href="gallery.php">St. John Mary Vianney Parish</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 31st March, 2024</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/pic2.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Linggo ng Palaspas</span>
                            <h4><a href="gallery.php">St. John Mary Vianney Parish</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 24th March, 2024</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/pic3.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Confirmation</span>
                            <h4><a href="gallery.php">St. John Mary Vianney Parish</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 31st August, 2018</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/pic4.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Marriage</span>
                            <h4><a href="gallery.php">St. John Mary Vianney Parish</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th Febuary, 2017</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/pic5.jpeg">
                        <div class="bi-text">
                            <span class="b-tag">Baptism</span>
                            <h4><a href="gallery.php">St. John Mary Vianney Parish</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 22nd September, 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Parish Activities Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logoo">
                                <a href="index.php">
                                    <img src="logo.jpg" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach thousands of Parishioners<br /> in San Leonardo</p>
                            <div class="fa-social">
                                <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fab fa-facebook"></i></a>
                                <a href="https://x.com/StJohnVianneySc"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fab fa-chrome"></i></a>
                                <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fab fa-youtube-play"></i></a>                    
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
       document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll('section');
    
            sections.forEach((section) => {
                section.addEventListener('wheel', (event) => {
                    event.preventDefault(); // Prevent default scrolling behavior
    
                    // Determine the direction of the scroll
                    const direction = event.deltaY > 0 ? 'down' : 'up';
                    const targetSection = direction === 'down' ? section.nextElementSibling : section.previousElementSibling;
    
                    // If a target section exists, scroll to it smoothly
                    if (targetSection) {
                        targetSection.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
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