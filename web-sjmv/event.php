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
    <title>Mission and Vision</title>

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
    <link rel="stylesheet" href="css/mission.css">
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
    .con {
    font-family: Arial, sans-serif;
    background-color: #e1d9cb;
    margin: 20px auto;
    border-radius: 10px;
    padding: 0;
    max-width: 700px; /* Changed from 600px to 500px */
}

.calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px; /* Reduced gap between calendar cells */
    text-align: center;
    margin-top: 5px;
    background: #d7d6d4;
    padding: 4px; /* Reduced padding */
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    max-width: 100%; /* Ensure it doesn't exceed the container */
}

.container1 {
    margin: 5px;
}

.container2 {
    margin: 0;
    padding: 5px;
}

/* Calendar Header */
.calendar-header {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 5px;
    flex-wrap: wrap;
}

h1 {
    font-size: 1em;
    font-weight: 600;
    color: #495057;
    margin: 0;
    text-align: center;
    margin-top: 6px;
}

h1 .month {
    color: #495057;
    margin-right: 3px;
}

h1 .year {
    color: #793232;
}

.navigation {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 250px;
    font-size: 25px;
    margin: 0;
}

.navigation a {
    color: #793232;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s;
}

.navigation a:hover {
    color: #793232;
}

/* Mobile View */
@media (max-width: 768px) {
    .calendar-header {
        flex-direction: column;
    }

    h1 {
        font-size: 0.9em;
    }

    .navigation {
        width: 100%;
        justify-content: space-evenly;
    }
}

/* Very Small Mobile View */
@media (max-width: 576px) {
    .calendar-header h1 {
        font-size: 0.8em;
    }

    .navigation a {
        font-size: 0.7em;
    }
}


.header {
    font-weight: bold;
    background-color: #e9ecef;
    padding: 3px;
    border-radius: 3px;
}

.day {
    min-height: 85px; /* Keep the minimum height */
    background-color: #f8f9fa;
    position: relative;
    padding: 5px;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Show ellipsis for overflow text */
    white-space: nowrap; /* Prevent text from wrapping */
    text-align: left;
}

.day:hover {
    background-color: #e9ecef;
}

.day span {
    top: 3px;
    left: 3px;
    font-weight: bold;
    font-size: 0.8em;
}

.event {
    font-size: 0.7em;
    margin-top: 1px;
    background: #793232;
    color: white;
    padding: 2px 4px;
    border-radius: 3px;
    display: block;
    text-align: center;
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Show ellipsis for overflow text */
    white-space: nowrap; /* Prevent text from wrapping */
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Darker background */
    justify-content: center;
    align-items: center;
    z-index: 10;
    padding: 10px;
    box-sizing: border-box;
}

/* Modal content */
.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 90%;
    width: 500px;
    box-sizing: border-box;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

/* Modal header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.5em;
    color: #333;
    flex-grow: 1;
    text-align: center;
}

.modal-header .close {
    cursor: pointer;
    font-size: 1.5em;
    color: #333;
    background: transparent;
    border: none;
    transition: color 0.2s;
}

.modal-header .close:hover {
    color: #793232;
}

/* Modal body (Event List) */
.modal ul {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 300px;
    overflow-y: auto;
}

.modal li {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;
    font-size: 1em;
    margin-bottom: 8px;
    color: #555;
    transition: background-color 0.3s;
    border-left: 6px solid #793232;
}

.modal li:hover {
    background-color: #f1f1f1;
}

/* Very Small Mobile View */
@media (max-width: 576px) {
    .calendar {
        grid-template-columns: repeat(7, 1fr);
        gap: 3px;
    }

    .day {
        min-height: 50px;
    }

    .modal-content {
        padding: 5px;
    }
}

.additional-events {
    font-size: 0.7em; /* Make the font smaller */
    color: gray; /* Set the text color to gray */
    margin-top: 2px; /* Optional: Add some space above */
    text-align: center; /* Center the text if needed */
}
</style>


<?php
require_once 'calendar.php';
$calendar = new Calendar();

// Get the current month and year or use the ones from the query parameters
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Fetch the events for the specified month and year
$events = $calendar->getAllEvents($month, $year);

// Calculate the first day of the month and the number of days in the month
$firstDayOfMonth = date('w', strtotime("$year-$month-01"));
$daysInMonth = date('t', strtotime("$year-$month-01"));
?>

<h2>Parish Event<span class="black-text"> </span><span class="maroon-text">Calendar</span></h2>
<div class="con">

<div class="container1">
    <div class="container2">
        <!-- Calendar Header -->
        <div class="calendar-header">
    <!-- Navigation -->
    <div class="navigation">
        <a href="?month=<?php echo $month - 1 == 0 ? 12 : $month - 1; ?>&year=<?php echo $month - 1 == 0 ? $year - 1 : $year; ?>" class="previous">&laquo;</a>
        <h1>
            <span class="month"><?php echo date('F', strtotime("$year-$month-01")); ?></span>
            <span class="year"><?php echo date('Y', strtotime("$year-$month-01")); ?></span>
        </h1>
        <a href="?month=<?php echo $month + 1 == 13 ? 1 : $month + 1; ?>&year=<?php echo $month + 1 == 13 ? $year + 1 : $year; ?>" class="next">&raquo;</a>
    </div>
</div>


        <!-- Calendar Grid -->
        <div class="calendar">
            <!-- Calendar Headers -->
            <div class="header">Sun</div>
            <div class="header">Mon</div>
            <div class="header">Tue</div>
            <div class="header">Wed</div>
            <div class="header">Thu</div>
            <div class="header">Fri</div>
            <div class="header">Sat</div>

            <!-- Blank Days Before the Start of the Month -->
            <?php for ($i = 0; $i < $firstDayOfMonth; $i++): ?>
                <div class="day"></div>
            <?php endfor; ?>
            <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
    <div class="day" onclick="showModal(<?php echo $day; ?>)">
        <span><?php echo $day; ?></span>
        <?php if (isset($events[$day])): ?>
            <?php 
            $eventCount = count($events[$day]);
            if ($eventCount > 2): // Check if there are more than 3 events
                // Display the first three events
                for ($i = 0; $i < 2; $i++): // Show first three events
                    if (isset($events[$day][$i])): // Check if the event exists
                        ?>
                        <div class="event" onclick="showEventDetails(<?php echo $events[$day][$i]['id']; ?>)">
                            <?php echo $events[$day][$i]['event_name']; ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
                <div class="additional-events">+<?php echo $eventCount - 2; ?></div> <!-- Show count of additional events -->
            <?php else: ?>
                <?php foreach ($events[$day] as $event): ?>
                    <div class="event" onclick="showEventDetails(<?php echo $event['id']; ?>)">
                        <?php echo $event['event_name']; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="eventModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Upcoming Events</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <ul id="eventList"></ul>
    </div>
</div>

<script>
    function showModal(day) {
    var events = <?php echo json_encode($events); ?>;
    var eventList = document.getElementById('eventList');
    eventList.innerHTML = ''; // Clear previous events

    if (events[day]) {
        events[day].forEach(function(event) {
            var listItem = document.createElement('li');
            listItem.textContent = event.event_name; // Access the event_name property
            eventList.appendChild(listItem);
        });
    } else {
        const noEventMessage = document.createElement('li');
        noEventMessage.textContent = "No events for this day.";
        noEventMessage.style.fontStyle = 'italic';
        eventList.appendChild(noEventMessage);
    }
    document.getElementById('eventModal').style.display = 'flex';
}

    function closeModal() {
        document.getElementById('eventModal').style.display = 'none';
    }
</script>

</div>



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