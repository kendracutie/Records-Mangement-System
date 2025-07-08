
<style>
/* Mobile Sidebar Styles */
.mobile-sidebar {
    position: fixed; /* Fixed position to stay on the screen */
    top: 0; /* Align to the top */
    left: -250px; /* Initially hidden off-screen */
    width: 250px; /* Width of the sidebar */
    height: 100%; /* Full height */
    background-color: #630707; /* Background color */
    transition: left 0.3s ease; /* Smooth transition for sliding in/out */
    z-index: 1000; /* Ensure it appears above other content */
    /* Style all <i> tags within the navigation to be black */
      .bi-chevron-right::before, .bi-chevron-down::before{
    color: black;
    overflow-y: auto; /* Enable vertical scrolling */
    /* Optional styling for scrollbar (modern browsers) */
    scrollbar-width: thin; /* Firefox */
    scrollbar-color: #ccc transparent; /* Firefox */
}
#sacramentsMenu ul li a, #archivesMenu ul li a, #prayer_requestMenu ul li a, #adminMenu ul li a, #certificate_requestsMenu ul li a, #reportsMenu ul li a, #settingsMenu ul li a{
    color: black;
    width: 74%;
}
#sacramentsMenu ul li i, #archivesMenu ul li i, #prayer_requestMenu ul li i, #adminMenu ul li i, #certificate_requestsMenu ul li i, #reportsMenu ul li i, #settingsMenu ul li i{
    color: black;
}
#sacramentsMenu ul li:hover, #archivesMenu ul li:hover, #prayer_requestMenu ul li:hover, #adminMenu ul li:hover, #certificate_requestsMenu ul li:hover, #reportsMenu ul li:hover, #settingsMenu ul li:hover {
    background-color: whitesmoke;
}
#sidebar ul li a:hover, 
#sacramentsMenu li a:hover,
#archivesMenu li a:hover,
#prayer_requestMenu li a:hover,
#adminMenu li a:hover,
#certificate_requestsMenu li a:hover,
#reportsMenu li a:hover,
#settingsMenu li a:hover{
    background-color: whitesmoke;
}
[class^="bi-"]::before, [class*=" bi-"]::before{
    color: black;
}

.nav-item {
    padding: -0px;
}

.nav-item a{
    border-bottom: 1px solid #ddd; /* Thin border for a visible line */
}
.menu-toggle{
    border-bottom: 1px solid #ddd; /* Thin border for a visible line */
}
}

.mobile-sidebar.active {
    left: 0; /* Slide in when active */
}

/* Sidebar Components */
.components {
    list-style: none; /* Remove default list styling */
    padding: 0; /* Remove padding */
    margin: 0; /* Remove margin */
}

/* Navigation Items */
.nav-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Separator between items */
}

/* Link styling */
.nav-item a {
    display: flex; /* Flexbox for icon and text alignment */
    align-items: center; /* Center items vertically */
    color: black; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 15px; /* Padding for clickable area */
    transition: background 0.3s; /* Smooth background transition */
    width: 100%;
}

/* Hover effect for list items */


/* Menu Toggle for Submenus */
.menu-toggle {
    display: flex; /* Flexbox for icon and text alignment */
    justify-content: space-between; /* Space between text and icon */
    align-items: center; /* Center items vertically */
    color: black; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 10px; /* Padding for clickable area */
    transition: background 0.3s; /* Smooth background transition */
    width: 100%;
}

/* Hover effect for menu toggle */
.menu-toggle:hover {
    color: black;
    text-decoration: none
}

/* Submenu Styles */
.list-unstyled {
    list-style: none; /* Remove default list styling */
    padding-left: 20px; /* Indent for submenus */
    display: none; /* Hide submenus by default */
}

.menu-toggle.active + .list-unstyled {
    display: block; /* Show submenu when parent is active */
}

/* Icons */
.bi {
    margin-right: 10px; /* Space between icon and text */
}

/* Responsive Adjustments */
/* Table Responsive Styling */
.table-responsive {
    position: relative; /* Ensure the parent element is positioned relative */
}

/* Initially visible for smaller screens */
button[onclick="sortTable(1)"] {
    background: transparent; /* Removes the button's background */
    border: none; /* Removes the button's border */
    padding: 0; /* Removes the padding */
    cursor: pointer; /* Keeps the button clickable */
    display: inline-block; /* Ensures the icon is inline and functional */
    outline: none; /* Removes any default outline */
    position: absolute; /* Position the button relative to its parent container */
    top: 10px; /* Adjust as necessary to position the button */
    right: 10px; /* Adjust as necessary to position the button */
    z-index: 10; /* Ensures the button stays above other elements */
}

button[onclick="sortTable(1)"] i {
    color: black; /* Icon stays visible and black */
    font-size: 18px; /* Adjust the size of the icon for visibility */
}

/* Hide the button on desktop (screens wider than 768px) */
@media (min-width: 769px) {
    button[onclick="sortTable(1)"] {
        display: none; /* Hides the button on desktop and larger screens */
    }
}

/* Responsive Design for Smaller Screens (Tablets and below) */


@media (max-width: 480px) {
    button[onclick="sortTable(1)"] {
        top: 5px; /* Further adjust the top margin for very small screens */
        right: 5px; /* Further adjust the right margin for very small screens */
    }

    button[onclick="sortTable(1)"] i {
        font-size: 14px; /* Make the icon even smaller for very small screens */
        margin-left: -900%;
        margin-top: 350%;
    }
}

@media (max-width: 360px) {
    button[onclick="sortTable(1)"] {
        top: 5px; /* Further adjust the top margin for very small screens */
        right: 5px; /* Further adjust the right margin for very small screens */
    }

    button[onclick="sortTable(1)"] i {
        font-size: 14px; /* Make the icon even smaller for very small screens */
        margin-left: -640%;
        margin-top: 350%;
    }
}


/* Adjustments for mobile-only visibility */
@media (max-width: 768px) {
    .mobile-sidebar {
        display: block; /* Display sidebar on mobile */
    }
}

@media (min-width: 769px) {
    .mobile-sidebar {
        display: none; /* Hide sidebar on desktop */
    }
    
}

.menu-toggle1 {
    display: flex; /* Flexbox for icon and text alignment */
    justify-content: space-between; /* Space between text and icon */
    align-items: center; /* Center items vertically */
    color: black; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 10px; /* Padding for clickable area */
    transition: background 0.3s; /* Smooth background transition */
    width: 100%;
    margin:5%;
}

/* Hover effect for menu toggle */
.menu-toggle1:hover {
    color: black;
    text-decoration: none;
}

#ProfileMenu ul li a{
        color: black;
        width: 74%;
        margin: -2%;
        margin-left: 8%;
        font-size: 11px;
        margin-top: -8%;
    }

    .profile{
        font-size: 12px;
        padding: -1%;
        width: 93%;
        margin-top: -8%;
        margin: 5%;
    }

/* Notification dropdown styling */
#notificationDropdown {
    display: flex; /* Flexbox for icon and text alignment */
    align-items: center; /* Center items vertically */
    color: black; /* Text color */
    text-decoration: none; /* Remove underline */
    padding: 10px 15px; /* Padding for clickable area */
    transition: background 0.3s; /* Smooth background transition */
    cursor: pointer; /* Show pointer cursor */
}



/* Badge styling */
.badge {
    padding: 4px 6px; /* Padding for badge */
    border-radius: 12px; /* Rounded corners for badge */
    background-color: red; /* Background color for badge */
    color: white; /* Text color for badge */
    font-size: 0.8em; /* Font size for badge */
}
.user-info {
    display: flex;
    align-items: center; /* Center icon and text vertically */
    margin-left: 7%;
}

.user-info i {
    margin-right: 4px; /* Adjust spacing between the icon and username */
}
.menu-toggle .menu-toggle-icon {
    margin-left: auto; /* Pushes chevron icon to the far right */
}


.notification-bell {
    color: black;
    padding: 5px 1px;
    position: absolute; /* Use absolute positioning for easier control */
    right: 5%; /* Adjusted for desktop */
    top: 10px; /* Adjusted for desktop */
    text-decoration: none;
    font-size: 14px;
}

.notification-bell .fa-bell {
    font-size: 16px;
    vertical-align: middle;
}

.notification-bell .badge-danger {
    font-size: 12px;
    padding: 2px 5px;
}

@media (max-width: 768px) {
    /* For mobile view */
    .notification-bell {
        right: 10px; /* Move to a more accessible location on smaller screens */
        top: 5px;
        margin-top: 0; /* Reset any margin-top for mobile view */
    }
    :root {
    font-size: 13px;
}
.card-body{
    font-size: 12px;
}
.modal-content{
    width: 123%;
}
}

@media (min-width: 700px) and (max-width: 1024px) {
    /* Fine-tuning for iPad Mini and other tablets */
    .notification-bell {
        margin-top: 1%;
    }

    :root {
        font-size: 14px; /* Slightly larger base font size for readability */
    }

    .card-body {
        font-size: 13px; /* Adjust font size for tablet view */
    }

    .menu-toggle{
        font-size: 15px;
    }

    .table th:first-child, .table td:first-child, .table th:last-child, .table td:last-child {
        margin-right: -11%;
    }

    .nav-item a {
        padding: 12px 10px; /* Adjust padding for better fit on tablets */
    }

    .modal-content {
        width: 100%; /* Keep modal width contained within the screen */
        max-width: 95%; /* Limit max width to prevent overflow */
        margin: 0 auto; /* Center modal on the screen */
    }

    /* Sidebar Adjustments */
    .mobile-sidebar {
        width: 300px; /* Adjust width for better display on tablets */
    }

    /* Font and Layout Adjustments for Better Alignment */
    .nav-item, 
    .nav-item a {
        font-size: 15px; /* Slightly larger for tablets */
        padding: 12px; /* Adjust spacing */
    }
    button[onclick="sortTable(1)"] {
        top: 3px; /* Adjust the top margin for smaller screens */
        left: 5px; /* Adjust the right margin for smaller screens */
        
    }

    button[onclick="sortTable(1)"] i {
        margin-right: 60%;
        font-size: 16px; /* Make the icon slightly smaller for smaller screens */
    }
}

/* Larger Tablet and Small Desktop Styles (1024px and up) */
@media (min-width: 1024px) {
    .modal-content {
        width: 100%; /* Keep modal width full on larger screens */
    }

    /* Hide mobile sidebar on larger screens */
    .mobile-sidebar {
        display: none;
    }
}


/*index css*/

@media (max-width: 768px) {
    /* Hide the table header on mobile */
    .table thead {
        display: none;
    }

    /* Make each table row behave like a list item */
    .table tbody tr {
        display: block; /* Make each row a block element */
        margin-bottom: 15px; /* Add space between rows */
        border: 1px solid #e0e0e0; /* Add border for visual separation */
        border-radius: 5px; /* Round corners */
        padding: 10px; /* Add padding */
        background-color: #f9f9f9; /* Light background color */
    }

    /* Style for each cell */
    .table tbody tr td {
        display: block; /* Make each cell a block element */
        text-align: left; /* Align text to the left */
        border: none; /* Remove borders between cells */
        padding: 5px 0; /* Add padding to cells */
    }

    /* Add a label for each cell */
    .table tbody tr td::before {
        content: attr(data-label); /* Use data-label attribute for cell labels */
        font-weight: bold; /* Make labels bold */
        display: inline-block; /* Display as inline block */
        margin-right: 10px; /* Add space between label and value */
    }
}
/* Hide action buttons in mobile view */


/* Hide action buttons and show three-dot menu in mobile view */
@media (max-width: 768px) {
    .action-buttons {
        display: none;
    }
    .three-dots {
        display: inline-block;
        position: relative;
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        top: 100%; /* Position below the three-dot icon */
        left: 0;
        background-color: #fff;
        z-index: 1;
        min-width: 60px;
        border-radius: 5px;
        overflow: hidden;
        margin-left: 74%;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    .action-button1 {
        display: inline-block;
        width: 100px; 
        height: 40px; 
        text-align: center; 
        line-height: 40px;
        transition: background-color 0.3s, transform 0.2s;
        margin-right: 5px; /* Optional spacing between buttons */
        flex-shrink: 0;     /* Prevent shrinking of buttons */
    }
    
    .action-button1 {
    background-color: #f5f5f9;
    cursor: pointer; /* Pointer cursor on hover */
    }
}

/* Show action buttons in desktop view */
@media (min-width: 769px) {
    .three-dots {
        display: none;
    }
    .action-buttons {
        display: inline-flex;
    }
}

/* Hide the three-dot menu on desktop */
@media (min-width: 768px) {
    .mobile-menu {
        display: none;
    }
}

/* Hide regular action buttons on mobile */
@media (max-width: 767px) {
    .desktop-menu {
        display: none;
    }
    
    /* Optional: Align three-dot menu in mobile */
    .three-dots {
        display: inline-block;
        cursor: pointer;
    }
}


/* Show the mobile menu and hide desktop buttons in mobile view */
.dropdown-menu {
    display: none; /* Default state is hidden */
}


/* Show the toggle button only on mobile (up to 768px) */
@media (max-width: 768px) {
    .toggle-btn {
        display: block; /* Show toggle button on mobile view */
    }
}

/* Sidebar is visible on desktop but hidden on mobile */
.sidebar {
    display: block; /* Visible by default (desktop) */
}

@media (max-width: 768px) {
    .sidebar {
        display: none; /* Hide sidebar on mobile */
    }
    #sidebar.active{
        display: none;
    }
}

/* For very small screens (max-width: 540px) */
@media (max-width: 540px) {
    button[onclick="sortTable(1)"] {
        top: 5px; /* Further adjust the top margin for very small screens */
        right: 5px; /* Further adjust the right margin for very small screens */
    }

    button[onclick="sortTable(1)"] i {
        font-size: 14px; /* Make the icon even smaller for very small screens */
        margin-left: -432%;
        margin-top: 350%;
    }
}

/* For small screens between 541px and 640px */
@media (min-width: 541px) and (max-width: 640px) {
    button[onclick="sortTable(1)"] {
        top: 5px; /* Further adjust the top margin for small screens */
        right: 5px; /* Further adjust the right margin for small screens */
    }

    button[onclick="sortTable(1)"] i {
        font-size: 14px; /* Make the icon even smaller for small screens */
        margin-left: -2068%;
        margin-top: 350%;
    }
}

/* For medium screens between 641px and 740px */
@media (min-width: 641px) and (max-width: 740px) {
    button[onclick="sortTable(1)"] {
        top: 3px; /* Adjust the top margin for smaller screens */
        left: 5px; /* Adjust the left margin for smaller screens */
    }

    button[onclick="sortTable(1)"] i {
        margin-right: 50%;
        font-size: 16px; /* Make the icon slightly smaller for smaller screens */
    }
}

/* For screens between 1024px and 1280px */
@media (min-width: 1024px) and (max-width: 1280px) {
    button[onclick="sortTable(1)"] {
        top: 2px; /* Adjust the top margin for screens between 1024px and 1280px */
        right: 10px; /* Adjust the right margin */
    }

    button[onclick="sortTable(1)"] i {
        font-size: 18px; /* Adjust the font size for larger screens */
        margin-left: 0;
        margin-top: 0;
    }
}


</style>

<div id="mobileSidebar" class="mobile-sidebar">
<div class="nav-item mobile-only">
<span class="notification-bell"  onclick="location.href='../notifications/notification.php';" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell" style=" color:black; font-size: 16px; vertical-align: middle; margin-right: -5px; margin-top: 12px"></i>
    <span class="badge badge-danger" style="font-size: 12px; padding: 2px 5px;"><?php echo $pendingCount; ?></span>
</span>
</div>

<ul class="components">
<li id="ProfileMenu">
    <a class="menu-toggle1" href="#">
    <span class="user-info">
            <i style="color: black; font-size: 33px;"class="fa fa-user-circle" id="menu"></i> <!-- User icon -->
            <?php echo $_SESSION['username']; ?>
        </span>
        <i style="margin-right: 50%;" class="bi bi-chevron-right menu-toggle-icon"></i> <!-- Chevron icon for toggling -->
    </a>
        <ul class="list-unstyled profile">
         <li class="profile"><i style="color: black; " class="fa fa-lock"></i> <a href="#" style="color: black;" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
        <li class="profile"><i style="color: black;" class='fa fa-sign-out'></i><a   style="color: black;" href='../logout.php' onclick='confirm_logout(event, this.href)' title='Logout'> Logout</a></li>
        </ul>
    </li>
    </ul>

    <div class="margin" style="margin: 30px; font-size: 11px;">
<ul class="components">
        <li class="nav-item" style="margin-left: -5px;"><a href="../dashboard/index.php">Overview</a></li>
        <li id="sacramentsMenu">
        <a href="#" class="menu-toggle">Sacraments <i class="bi bi-chevron-right  menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-droplet"></i><a href="../baptism/index.php">Baptism Records</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../confirmation/index.php">Confirmation Records</a></li>
            <li class="nav-item"><i class="bi bi-heart"></i><a href="../marriage/index.php">Marriage Records</a></li>
        </ul>
    </li>
    <li id="archivesMenu">
        <a href="#" class="menu-toggle">Archives <i class="bi bi-chevron-right  menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-archive"></i><a href="../baptism_archive/index.php">Baptism Archives</a></li>
            <li class="nav-item"><i class="bi bi-box-seam"></i><a href="../confirm_archive/index.php">Confirmation Archives</a></li>
            <li class="nav-item"><i class="bi bi-folder"></i><a href="../marr_archive/index.php">Marriage Archives</a></li>
        </ul>
    </li>
    <li id="prayer_requestMenu">
        <a href="#" class="menu-toggle">Prayer Requests <i class="bi bi-chevron-right  menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-clock"></i><a href="../prayer_req/index.php">Pending Requests</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../prayer_req/approve.php">Approved Requests</a></li>
        </ul>
    </li>
    <li id="certificate_requestsMenu">
        <a href="#" class="menu-toggle">Certificate Requests <i class="bi bi-chevron-right  menu-toggle-icon"></i></a>
        <ul class="list-unstyled">
            <li class="nav-item"><i class="bi bi-clock"></i><a href="../certificates/index.php">Pending Requests</a></li>
            <li class="nav-item"><i class="bi bi-check-circle"></i><a href="../certificates/approve_req.php">Approved Requests</a></li>
            <li class="nav-item"><i class="bi bi-x-circle"></i><a href="../certificates/decline.php">Declined Requests</a></li>
        </ul>
    </li>
    <li id="adminMenu">
        <a href="#" class="menu-toggle">Admin Management <i class="bi bi-chevron-right  menu-toggle-icon"></i></a>
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
    
    <li class="nav-item" style="margin-left: -5px;"><a href="../event/index.php">Event Calendar</a></li>

        <li class="nav-item" style="margin-left: -5px;"><a href="../activity_log/index.php">Activity Log</a></li>
        <!-- <li id="reportsMenu">
            <a href="#" class="menu-toggle">Reports/Analytics<i class="bi bi-chevron-down"></i></a>
            <ul class="list-unstyled">
                <li class="nav-item"><i class="bi bi-bar-chart"></i><a href="../reports/sacrament_reports.php">Sacrament Reports</a></li>
                <li class="nav-item"><i class="bi bi-file-earmark-bar-graph"></i><a href="../reports/request_reports.php">Request Reports</a></li>
                <li class="nav-item"><i class="bi bi-journal-text"></i><a href="../reports/admin_activity.php">Admin Activity</a></li>
            </ul>
        </li> -->
        <!-- <li id="settingsMenu">
            <a href="#" class="menu-toggle">Settings<i class="bi bi-chevron-down"></i></a>
            <ul class="list-unstyled">
                <li class="nav-item"><i class="bi bi-info-circle"></i><a href="../settings/parish_info.php">Parish Info</a></li>
                <li class="nav-item"><i class="bi bi-tools"></i><a href="../settings/system_settings.php">System Settings</a></li>
            </ul>
        </li> -->

    </ul>
    </div>
    </div>

<div id="content">
    <!-- Your main content goes here -->
</div>

<!-- for option dropdown-->
<script>
    // Get all menu toggle elements
    const menuToggles = document.querySelectorAll('.menu-toggle, .menu-toggle1');

    // Add click event listener to each toggle
    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            
            const subMenu = this.nextElementSibling; // Get the submenu
            // Toggle the display property of the submenu
            subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';

            // Change only the chevron icon based on submenu visibility
            const chevronIcon = this.querySelector('.menu-toggle-icon'); // Target the chevron icon
            if (subMenu.style.display === 'block') {
                chevronIcon.classList.remove('bi-chevron-right');
                chevronIcon.classList.add('bi-chevron-down'); // Change to "down" icon
            } else {
                chevronIcon.classList.remove('bi-chevron-down');
                chevronIcon.classList.add('bi-chevron-right'); // Change back to "right" icon
            }
        });
    });
</script>

<script>
    function toggleDropdown(element) {
    // Select the dropdown menu within the parent <td>
    const dropdownMenu = element.parentNode.querySelector('.dropdown-menu');
    
    // Toggle dropdown menu display
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' 
        ? 'block' 
        : 'none';
}


// Close the dropdown if clicked outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.three-dots')) {
        document.querySelectorAll('.dropdown-menu1').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

</script>

<script>
  function sortTable(columnIndex) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    dir = "asc"; // Set the sorting direction to ascending initially

    // Reset all sort icons before starting the sort
    var icons = table.querySelectorAll('.sort-icon');
    icons.forEach(icon => {
        icon.style.display = 'none'; // Hide all sorting icons
    });

    // Keep looping until no switching is needed
    while (switching) {
        switching = false;
        rows = table.rows;
        
        // Loop through all table rows (except the first, which contains the headers)
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[columnIndex];
            y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
            
            // Check if the two rows should switch place based on the direction (asc or desc)
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        
        if (shouldSwitch) {
            // If a switch is needed, make the switch and mark that a switch has been done
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            // If no switching has been done and the direction is "asc", set the direction to "desc" and run the loop again
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }

    // Display the correct sort icon in the header
    var th = table.rows[0].cells[columnIndex];  // Get the clicked header cell
    var sortIcon = th.querySelector('.sort-icon');
    sortIcon.style.display = 'inline'; // Show the icon
    sortIcon.innerHTML = (dir == "asc") ? "▲" : "▼"; // Update icon based on the sort direction
}
</script>

<script>
    // Toggle the mobile sidebar when the button is clicked
    document.getElementById('toggleMobileSidebar').addEventListener('click', function () {
        var mobileSidebar = document.getElementById('mobileSidebar');
        mobileSidebar.classList.toggle('active'); // Toggle the mobile sidebar's active class
    });
    </script>
