<?php
require_once '../class/prayer_req.php';
$prayer_req = new prayer_req();

require_once '../class/certificate_req.php';


$certificate_req = new  certificate_req();

// Initialize the counter for pending requests
$pendingCount = 0;

// Fetch both prayer and certificate requests
$Prayer = $prayer_req->getAll();
$Certificate = $certificate_req->getAll();

// Loop through the prayer requests to count pending requests
foreach ($Prayer as $value) {
    if ($value['status'] == 'pending') {
        $pendingCount++;
    }
}

// Loop through the certificate requests to count pending requests
foreach ($Certificate as $value) {
    if ($value['status'] == 'pending') {
        $pendingCount++;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../assets/sjmv-logo.jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/animate.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <title>St. John Mary Vianney Parish</title>

    <style>

  body {
    margin: 0;
    padding: 0;
    font-family: Cabin, sans-serif;
    font-size: 14px;
}

header {
    background: #793232; /* Maroon gradient */
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

@media (max-width: 768px) {
            header {
                display: none; /* Hide the header on mobile */
            }


            .toggle-btn{
                display: block;
            }

            #content {
                margin-left: 0; /* Reset margin for content */
            }
            .toggle-btn1 {
            display: block; /* Show the button on mobile */
            position: fixed; /* Position it at the top left */
            top: 10px; /* Adjust as needed */
            left: 10px; /* Adjust as needed */
            z-index: 1001; /* Ensure it's above the sidebar */
        }
        }
        
.toggle-btn {
    cursor: pointer;
    font-size: 1.5rem;
    color: white;
    margin-right: 20px;
    margin-top: -10px;
}

.navbar-brand {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.navbar-brand img {
    border-radius: 90%;
    width: 50px;
    height: 50px;
    margin-right: 10px;
    margin-top: -13px;
    margin-left: -3px;
}

.navbar-text {
    font-family: "Lora", serif !important;
    color: white;
    margin-left: 10px;
    margin-top:-10px;
}

#mobileSidebar {
            width: 70%; /* Full width on mobile */
            height: 100%; /* Full height on mobile */
            background: #ffffff; /* Sidebar background */
            position: fixed; /* Fixed position */
            left: -100%; /* Hide sidebar off-screen */
            transition: left 0.3s; /* Smooth transition */
            z-index: 999; /* Ensure it's on top */
            padding-top: 60px; /* Space for header */
        }

        #mobileSidebar.active {
            left: 0; /* Show mobile sidebar */
        }
/* Sidebar Styles */
#sidebar {
    height: 90vh;
    width: 270px;
    background: #793232;
    position: fixed;
    left: -270px;
    top: 77px;
    transition: left 0.3s;
    z-index: 1000;
    overflow-y: scroll; /* Allow vertical scrolling */
    scrollbar-width: none; /* Hide scrollbar in Firefox */
    -ms-overflow-style: none; /* Hide scrollbar in IE and Edge */
}

/* Hide scrollbar for Webkit browsers (Chrome, Safari) */
#sidebar::-webkit-scrollbar {
    display: none;
}

#sidebar.active {
    left: 0;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #A52A2A;
    text-align: center;
    color: white;
    font-weight: bold;
}

#sidebar ul.components {
    padding: 10px 10px 10px 0px;
    list-style: none;
    margin: 0;
}

#sidebar ul li {
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    margin-left: 5px;
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    width: 100%;
}

#sidebar ul li a:hover, #sacramentsMenu li a:hover {
    background: burlywood;
    color: black;
}

#sidebar ul ul {
    display: none; /* Hide submenus by default */
    padding-left: 5px; /* Indent submenus */
}

#sidebar ul li.active > ul {
    display: block; /* Show submenu when parent is active */
}

#content {
    margin-top: 60px; /* To offset the fixed header */
    margin-left: 0;
    position: relative;
    margin-top: 60px; /* To offset the fixed header */
    transition: left 0.4s ease;
}

#sidebar.active ~ #content {
    margin-left: 270px; /* Matches the width of the sidebar */
}

.nav-item {
    display: flex;
    align-items: center;
}

/* Styles the icon to be white and adjusts size if necessary */
.nav-item i {
    color: white;
    font-size: 24px; /* Adjust the size if needed */
    margin-right: 5px; /* Adds space between icon and text */
    margin-left: 10px;
}

/* Styles the link text */
.nav-item a {
    color: white; /* Makes the text white */
}

/* Adds some padding to the list item */
.nav-item {
    padding: 5px;
}

#adminDropdown {
    width:250%;
}

#sacramentsMenu ul, #archivesMenu ul, #prayer_requestMenu ul, #adminMenu ul, #certificate_requestsMenu ul, #reportsMenu ul, #settingsMenu ul {
    padding: 0;
    list-style: none;
}

#sacramentsMenu ul li a, #archivesMenu ul li a, #prayer_requestMenu ul li a, #adminMenu ul li a, #certificate_requestsMenu ul li a, #reportsMenu ul li a, #settingsMenu ul li a {
    padding: 10px;
    margin-left: 5px;
    display: flex;
    align-items: center; /* Aligns icon and text vertically */
    color: white;
    text-decoration: none;
    width: 100%; /* Ensure link covers the entire list item */
}

#sacramentsMenu ul li:hover, #archivesMenu ul li:hover, #prayer_requestMenu ul li:hover, #adminMenu ul li:hover, #certificate_requestsMenu ul li:hover, #reportsMenu ul li:hover, #settingsMenu ul li:hover {
    background: burlywood; /* Background color on hover */
}

#sacramentsMenu ul li:hover a, #archivesMenu ul li:hover a, #prayer_requestMenu ul li:hover a, #adminMenu ul li:hover a, #certificate_requestsMenu ul li:hover a, #reportsMenu ul li:hover a, #settingsMenu ul li:hover a {
    color: black; /* Text color on hover */
}

#sacramentsMenu ul li:hover i, #archivesMenu ul li:hover i, #prayer_requestMenu ul li:hover i, #adminMenu ul li:hover i, #certificate_requestsMenu ul li:hover i, #reportsMenu ul li:hover i, #settingsMenu ul li:hover i {
    color: black; /* Icon color on hover */
}

#sacramentsMenu ul li i, #archivesMenu ul li i, #prayer_requestMenu ul li i, #adminMenu ul li i, #certificate_requestsMenu ul li i, #reportsMenu ul li i, #settingsMenu ul li i {
    color: white; /* Default icon color */
    font-size: 18px; /* Smaller icon size */
    margin-right: 5px; /* Adds space between icon and text */
}

/* Style the arrow icon for sacraments menu */
#sacramentsMenu a i, #archivesMenu a i, #prayer_requestMenu a i, #adminMenu a i, #certificate_requestsMenu a i, #reportsMenu a i, #settingsMenu a i {
    font-size: 14px; /* Adjust size of the arrow */
    margin-left: 49%; /* Adds space between the text and the icon */
    vertical-align: middle; /* Align the icon vertically with the text */
    color: white; /* Icon color */
}

#archivesMenu a i {
    margin-left: 59%;
}

#prayer_requestMenu a i {
    margin-left: 36%;
}

#adminMenu a i, #certificate_requestsMenu a i {
    margin-left: 26%;
}

#reportsMenu a i {
    margin-left: 29%;
}

#settingsMenu a i {
    margin-left: 60%;
}

/* Sidebar styles */
#sidebar {
    width: 0; /* Sidebar is hidden initially */
    transform: translateX(-200%); /* Move sidebar out of view */
    transition: left 0.4s ease;
}

#sidebar.active {
    width: 270px; /* Width of the sidebar when open */
    transform: translateX(0); /* Move sidebar into view */
}

/* Adjust content width when sidebar is active */
#sidebar.active ~ #content {
    width: calc(100% - 270px); /* Adjust width to account for sidebar width */
}

.dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: linear-gradient(to right, #8B0000, #A52A2A);
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        } 

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-top: 1px solid burlywood;
        }

        .dropdown-content a:hover {
            color: burlywood;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-link.active, .dropdown-content a.active {
            color: burlywood;
        }
        
       /* Style for the dropdown menu */
.dropdown-menu {
    margin-top: -3px;
    margin-right: -14px;
    max-width: 300px; /* Optional max width */
    padding: 0; /* Optional: Remove padding for better layout */
    max-height: 300px; /* Optional: Limit the height if too many notifications */
    overflow-y: auto; /* Allow vertical scrolling if the list overflows */
    z-index: 1050; /* Ensure it's on top */
}

/* Right-aligned dropdown menu */
.dropdown-menu.dropdown-menu-right {
    margin-top: -3px; /* Align margin with the default dropdown */
    margin-right: -14px; /* Adjust for right alignment */
    right: 9%; /* Adjust to position the dropdown properly on the right */
}


.notification-text {
    display: block;
    max-width: 180px; /* Set a maximum width */
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide overflowing text */
    text-overflow: ellipsis; /* Add ellipsis (...) for truncated text */
}

/* Style for the notification list items */
.list-group-item {
    padding: 5px;
    text-decoration: none;
    color: inherit;
    transition: background-color 0.3s;
    font-size: 11px; /* Smaller font size */
    display: flex;
    justify-content: space-between;
    position: relative;
    width: 100%; /* Ensure it takes full width within the dropdown */
    height: auto; /* Let the height adjust based on content */
}


/* Hover effect for list items */
.list-group-item:hover {
    background-color: #e0e0e0; /* Change to your desired hover color */
    border-radius: 5px; /* Optional: round the corners */
}


.time-ago {
    color: gray; /* Set the color for the time-ago text */
    margin-top: 40px; /* Add some space between the text and time */
    white-space: nowrap; /* Keep time text in one line */
}

.notification-list {
    height: 340px !important;
    overflow-y: scroll;
    font-size: 12px;
    scrollbar-width: thin; /* For Firefox */
}



/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidebar {
        padding-top: 15px;
    }

    .sidebar a {
        font-size: 18px;
    }
}

/* Normal state */
.item {
    color: maroon; /* Set the logout link color to maroon */
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
</head>
<body>
<div class="toggle-btn1" style=" position: absolute;
    right: 0;
    top: 10px; /* Adjust as needed */
    padding: 10px; /* Optional for spacing */
    width: 60px" id="toggleMobileSidebar">☰</div>
    
    <header>
    <nav class="navbar navbar-expand-md navbar-light fixed-top">
        <div class="toggle-btn" id="toggleSidebar">☰</div>
        <a class="navbar-brand" href="#">
            <img src="../assets/sjmv-logo.jpg" alt="Logo">
            <span class="navbar-text" style="color:white;">St. John Mary Vianney Parish</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"></ul>
            <div class="form-inline mt-2 mt-md-0">
                <a href="#" class="navbar-text nav-link dropdown-toggle" style="color:white;" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i> Notifications <span class="badge badge-danger" style="padding: 4px 3px 2.5px;"><?php echo $pendingCount; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
    <div class="notification-list" style="max-height: 221px; overflow-y: auto;">
        <ul class="list-group">
            <?php
            date_default_timezone_set('Asia/Manila');

            // Fetch prayer requests
            $Prayer = $prayer_req->getAll();
            $pendingRequests = array_filter($Prayer, function($value) {
                return isset($value['status']) && $value['status'] == 'pending';
            });

            // Fetch certificate requests
            $Certificate = $certificate_req->getAll();
            $pendingCertificateRequests = array_filter($Certificate, function($value) {
                return isset($value['status']) && $value['status'] == 'pending';
            });

            // Combine prayer and certificate requests
            $allPendingRequests = array_merge($pendingRequests, $pendingCertificateRequests);

            // Prepare to sort requests by time
            $sortedRequests = [];
            foreach ($allPendingRequests as $value) {
                if (isset($value['prayer_id'])) {
                    // Prayer request
                    if (isset($value['time']) && strtotime($value['time']) !== false) {
                        $requestTime = new DateTime($value['time']);
                        $value['request_time'] = $requestTime; // Add a request_time field for sorting
                    }
                } elseif (isset($value['request_id'])) {
                    // Certificate request
                    if (isset($value['request_date']) && strtotime($value['request_date']) !== false) {
                        $requestTime = new DateTime($value['request_date']);
                        $value['request_time'] = $requestTime; // Add a request_time field for sorting
                    }
                }

                // Only add to sortedRequests if request_time is set
                if (isset($value['request_time'])) {
                    $sortedRequests[] = $value;
                }
            }

            // Sort requests by request_time in descending order
            usort($sortedRequests, function($a, $b) {
                return $b['request_time'] <=> $a['request_time'];
            });


            // Check if there are any pending requests
            if (empty($sortedRequests)) {
                echo "<li class='list-group-item text-center'>No requests</li>";
            } else {
                foreach ($sortedRequests as $value) {
                    // Initialize timeAgo variable
                    $timeAgo = 'Unknown time';

                    // Calculate time difference based on request_time
                    if (isset($value['request_time'])) {
                        $now = new DateTime(); // Get current time
                        $interval = $now->diff($value['request_time']);

                        // If the difference is less than a minute, show 'just now'
                        if ($interval->y > 0) {
                            $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->m > 0) {
                            $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->d > 0) {
                            $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->h > 0) {
                            $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->i > 0) {
                            $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                        } else {
                            $timeAgo = 'just now'; // Catch-all for very recent times
                        }
                    }

                    // Generate notification type and message
                    if (isset($value['prayer_id'])) {
                        // Prayer request notification
                        echo "<li class='list-group-item d-flex justify-content-between'>
                            <a href='../prayer_req/' class='notification-item' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                                <b>" . htmlspecialchars($value['Name']) . "</b> <span style='color: gray;'> requested a " . htmlspecialchars($value['prayerType'])." prayer</span><br>
                            </a>
                            <small class='time-ago' style='color: gray;'>$timeAgo</small>
                        </li>";
                    } elseif (isset($value['request_id'])) {
                        // Certificate request notification
                        echo "<li class='list-group-item d-flex justify-content-between'>
                            <a href='../certificates/' class='notification-item' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                                <b>" . htmlspecialchars($value['requester_first_name']) . "</b> 
                                <span style='color: gray;'> requested a " . htmlspecialchars($value['certificate_type']) . " certificate</span><br>
                            </a>
                            <small class='time-ago' style='color: gray;'>$timeAgo</small>
                        </li>";
                    }
                }
            }
            ?>
        </ul>
    </div>
</div>



       <!-- Admin dropdown -->
<div class="dropdown">
  <a class="nav-link dropdown-toggle navbar-text" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
    <i class="fa fa-user-circle"></i> <?php echo $_SESSION['username']; ?>
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
    <!-- Button to trigger the modal -->
    <a class="dropdown-item item" href="#" data-toggle="modal" data-target="#changePasswordModal">
      <i class="fa fa-lock"></i> Change Password
    </a>

    <!-- Logout button with confirmation -->
    <a href='../logout.php' onclick='confirm_logout(event, this.href)' title='Logout' class='dropdown-item item'>
      <i class='fa fa-sign-out'></i> Logout
    </a>
  </div>
</div>



<!-- Logout confirmation logic using SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirm_logout(event, url) {
        event.preventDefault(); // Prevent the default link action

        Swal.fire({
            title: '<span style="color: #800000;">Are you sure?</span>',
            text: 'Do you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            background: '#fffef0', // Light cream background
            confirmButtonColor: 'burlywood', // Burlywood color for the confirm button background
            cancelButtonColor: 'maroon', // Maroon color for the cancel button background
            confirmButtonText: 'Yes, log out!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'black-text' // Custom class for confirm button styling
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Redirect to the logout page if confirmed
            }
        });
    }
</script>

<style>
    /* CSS to set confirm button text color to black, remove border, box-shadow, and outline */
    .swal2-confirm.black-text {
        outline: none !important; /* Remove the default focus outline */
    }
</style>




                    </div>
                </div>
            </div>
        </div>

                
            </div>
        </div>
    </nav>
</header>

<div id="sidebar">
    <ul class="components">
        <li class="nav-item"><a href="../dashboard/index.php">Overview</a></li>
        <li id="sacramentsMenu">
        <a href="#" class="menu-toggle">Sacraments <i class="bi bi-chevron-right menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-droplet"></i><a href="../baptism/index.php">Baptism Records</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../confirmation/index.php">Confirmation Records</a></li>
            <li class="nav-item"><i class="bi bi-heart"></i><a href="../marriage/index.php">Marriage Records</a></li>
        </ul>
    </li>
    <li id="archivesMenu">
        <a href="#" class="menu-toggle">Archives <i class="bi bi-chevron-right menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-archive"></i><a href="../baptism_archive/index.php">Baptism Archives</a></li>
            <li class="nav-item"><i class="bi bi-box-seam"></i><a href="../confirm_archive/index.php">Confirmation Archives</a></li>
            <li class="nav-item"><i class="bi bi-folder"></i><a href="../marr_archive/index.php">Marriage Archives</a></li>
        </ul>
    </li>
    <li id="prayer_requestMenu">
        <a href="#" class="menu-toggle">Prayer Requests <i class="bi bi-chevron-right menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-clock"></i><a href="../prayer_req/index.php">Pending Requests</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../prayer_req/approve.php">Approved Requests</a></li>
        </ul>
    </li>
    <li id="certificate_requestsMenu">
        <a href="#" class="menu-toggle">Certificate Requests <i class="bi bi-chevron-right menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-clock"></i><a href="../certificates/index.php">Pending Requests</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../certificates/approve_req.php">Approved Requests</a></li>
            <li class="nav-item"><i class="bi bi-x-circle"></i><a href="../certificates/decline.php">Declined Requests</a></li>
        </ul>
    </li>
    <li id="adminMenu">
        <a href="#" class="menu-toggle">Admin Management <i class="bi bi-chevron-right menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <?php if ($_SESSION['role'] === 'super_admin'): ?>
                <li class="nav-item"><i class="bi bi-person-gear"></i><a href="../admin_management/index.php">Add/Edit Admin</a></li>
                <li class="nav-item"><i class="bi bi-archive"></i><a href="../admin_management/archived.php">Archived Admin</a></li>
            <?php elseif ($_SESSION['role'] === 'super_admin'): ?>
                <li class="nav-item"><i class="bi bi-person-gear"></i><span style="color: gray;">Add/Edit Admin (Disabled)</span></li>
                <li class="nav-item"><i class="bi bi-archive"></i><span style="color: gray;">Archived Admin (Disabled)</span></li>
            <?php else: ?>
                <li class="nav-item"><i class="bi bi-person-gear"></i><span style="color: gray;">Admin Management (Access Denied)</span></li>
            <?php endif; ?>
        </ul>
    </li>
         <li class="nav-item"><a href="../event/index.php">Event Calendar</a></li>
        <li class="nav-item"><a href="../activity_log/index.php">Activity Log</a></li>
        <!-- <li class="nav-item"><a href="../../web-sjmv/customize_reqform.php">Customize Request Form</a></li> -->
    </ul>
</div>

<?php include 'header_mobile.php' ?>

<div id="content">
    <!-- Your main content goes here -->
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: whitesmoke">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" method="POST" action="../change_pass_admin.php">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <small id="username-password-error" class="form-text text-danger" style="display:none;">Password should not be the same as the username.</small>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <small id="password-match-error" class="form-text text-danger" style="display:none;">Passwords do not match.</small>
                    </div>
                    <button type="submit" class="btn change-password-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Display the alert if it is set in the session
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];

    // Determine the icon color based on the alert type
    $iconColor = ($alert['type'] === 'success') ? 'darkgreen' : 'maroon';

    // Include custom styles for the alert
    echo "<style>
        .my-popup {
            background-color: #fffef0 !important; /* Light background color */
        }
        .my-confirm-button {
            background-color: burlywood !important; /* Burlywood button color */
            color: white !important; /* Text color for the button */
            border: none !important; /* Remove border */
            box-shadow: none !important; /* Remove box shadow */
        }
    </style>";

    // Display the SweetAlert2 alert with the appropriate icon color
    echo "<script>
            Swal.fire({
                icon: '{$alert['type']}',
                iconColor: '$iconColor', // Set icon color dynamically
                title: '{$alert['title']}', // Added title to the alert
                text: '{$alert['text']}',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'my-popup', // Custom class for the popup background
                    confirmButton: 'my-confirm-button' // Custom class for the confirm button
                }
            });
          </script>";

    unset($_SESSION['alert']); // Clear the alert after displaying
}
?>


<style>
.modal-backdrop {
    background-color: rgba(0, 0, 0, .2); /* Adjust as needed */
}
</style>

    <style>
  .change-password-btn {
    background-color: burlywood;
    color: white;
    border: none; /* Optional: to remove border */
    cursor: pointer; /* Optional: to indicate it's clickable */
}

.change-password-btn:hover {
    background-color: #e6c59c; 
    color: white;
}


    </style>

        </form>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Retrieve username from dropdown
    const username = document.getElementById('adminDropdown').textContent.trim();

    // Get form and input elements
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    const usernamePasswordError = document.getElementById('username-password-error');
    const passwordMatchError = document.getElementById('password-match-error');

    // Validation function
    function validatePasswords() {
      const newPasswordValue = newPassword.value;
      const confirmPasswordValue = confirmPassword.value;

      // Check if new password matches the username
      if (newPasswordValue === username) {
        usernamePasswordError.style.display = 'block';
      } else {
        usernamePasswordError.style.display = 'none';
      }

      // Check if new password matches confirm password
      if (newPasswordValue !== confirmPasswordValue) {
        passwordMatchError.style.display = 'block';
      } else {
        passwordMatchError.style.display = 'none';
      }
    }

    // Add input event listeners for validation
    newPassword.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);

    // Optional: Prevent form submission if there are errors
    const form = document.getElementById('changePasswordForm');
    form.addEventListener('submit', function (e) {
      if (usernamePasswordError.style.display === 'block' || passwordMatchError.style.display === 'block') {
        e.preventDefault(); // Stop form submission
      }
    });
  });
</script>


<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const sacramentsMenu = document.getElementById('sacramentsMenu');
    const archivesMenu = document.getElementById('archivesMenu');
    
    // Load sidebar state from local storage
    const sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState === 'closed') {
        sidebar.classList.add('unactive');
    } else {
        sidebar.classList.remove('unactive');
    }
    
    toggleSidebar.addEventListener('click', function() {
        const isOpen = sidebar.classList.toggle('active');
        localStorage.setItem('sidebarState', isOpen ? 'open' : 'closed');
    });
    
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleSidebar.contains(event.target)) {
            sidebar.classList.remove('active');
            localStorage.setItem('sidebarState', 'closed');
        }
    });

    document.querySelectorAll('.menu-toggle').forEach(function(menuToggle) {
        menuToggle.addEventListener('click', function(event) {
            event.preventDefault();
            const parentLi = this.parentElement;
            const otherMenus = document.querySelectorAll('#sidebar ul.components > li:not(#' + parentLi.id + ')');
            
            if (parentLi.classList.contains('active')) {
                parentLi.classList.remove('active');
            } else {
                otherMenus.forEach(function(item) {
                    item.classList.remove('active');
                });
                parentLi.classList.add('active');
            }
        });
    });

    
</script>

<script>
    // Get all menu toggle elements
    const menuToggles = document.querySelectorAll('.menu-toggle');

    // Add click event listener to each toggle
    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            
            const subMenu = this.nextElementSibling; // Get the submenu
            // Toggle the display property of the submenu
            subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';

            // Change the icon based on submenu visibility
            const icon = this.querySelector('i');
            if (subMenu.style.display === 'block') {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-down'); // Change to "up" icon
            } else {
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-right'); // Change back to "down" icon
            }
        });
    });
</script>

</body>
</html>
