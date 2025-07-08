<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/Admin.php';
$Admin = new Admin();

$current_page = 'admin';
require_once "../header.php"; 
?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

<!-- Admin Management -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top:2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Admin Management</h4>
            </div><div class="card mb-5 minimalist-card">
    <div class="card-body">
        <button type="button" class="btn btn-dark-red" onclick="openAdminModal()">
            <i class="fa fa-plus"></i> New Admin
        </button>
        
        <div class="table-responsive mt-3">
            <table id="myTable" class="table minimalist-table table-striped">
                <div class="sorting-controls">
                    <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Admin_arr = $Admin->getAllAdmin();
                    $i = 1; // Start counting from 1
                    if (!is_array($Admin_arr) || empty($Admin_arr)) {
                        echo "<tr><td colspan='6' style='text-align: center;'>No admins found.</td></tr>";
                    } else {
                        foreach ($Admin_arr as $admin) {
                            // Check if the admin's status is 'active'
                            if ($admin['status'] === 'active') {
                                echo "<tr style='padding-left: 20px;'>
                                    <td data-label='#'> " .$i++." 
                                        <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                        <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                            <i class='fa fa-ellipsis-v'></i>
                                            <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                                <a href='#' title='Edit' onclick='openEditAdminModal({$admin["admin_id"]})' class='action-button1 edit-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                                    <i class='fa fa-edit'></i> Edit
                                                </a>
                                                <a href='archive.php?mid={$admin["admin_id"]}' onclick='confirm_archive(event, this.href)' title='Archive' class='action-button1 archive-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                                    <i class='fa fa-archive'></i> Archive
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label='USERNAME:'>{$admin['username']}</td>
                                    <td data-label='FULL NAME:'>{$admin['admin_first_name']} {$admin['admin_last_name']}</td>
                                    <td data-label='EMAIL:'>{$admin['email']}</td>
                                    <td data-label='ROLE:'>{$admin['role']}</td>
                                    <td>
                                    <div class='action-buttons'>
                                            <a href='#' title='Modify Details' onclick='openEditAdminModal({$admin["admin_id"]})' style='margin-left: 60%;'class='action-button edit-button'>
                                                <i class='fa fa-edit'></i>
                                            </a>
                                            <a href='archive.php?mid={$admin["admin_id"]}' onclick='confirm_archive(event, this.href)' title='Archive' class='action-button archive-button'>
                                                <i class='fa fa-archive'></i>
                                            </a>
                                    </div>
                                </td>
                                </tr>";
                            }
                        }
                    }
                    ?>
                    
                </tbody>
            </table>
            </div>
    </div>
</div>

        </div>
    </div>
</div>
<style>
    .font-weight-dark {
        color: #333; /* Dark color */
    }

    .card {
        border-radius: 10px; /* Add border-radius to cards */
        padding: 3px; /* Add padding to cards */
    }

    .card h4 {
        margin: 10px 0; /* Add margin to h4 elements inside cards */
    }

    .btn-dark-red {
    background-color: burlywood; 
    border-color: #8b0000; /* Match the border color with the solid color */
    color: #630707; /* Text color */
}

.btn-dark-red:hover {
    background-color: #eecfa1; /* Slightly lighter red */
    border-color: #630707; /* Border color on hover */
    color:#630707;
}

    body {
        background-color: #f3f4f6;
        font-family: 'Cabin', sans-serif;
    }

    .card {
        border-radius: 15px;
        margin-top: 20px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        margin-bottom: 20px;
        color: #343a40;
    }

    .supporting-docs img {
        width: 280px; /* Adjust as needed */
        height: auto; /* Maintain aspect ratio */
        border-radius: 5px;
    }

    .btn-custom {
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    h5 {
        margin-top: 20px;
        color: #495057;
    }

    .container {
        max-width: 800px;
    }

    /* Card Styling */
    .minimalist-card {
        border: none;
        border-radius: 8px; /* Rounded corners for the card */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        background-color: #ffffff; /* White background for the card */
    }

    /* Table Styling */
    .table {
        width: 100%;
        border-collapse: collapse; /* Ensures there are no gaps between cells */
        font-family: 'Arial', sans-serif; /* Clean, modern font */
        color: #333; /* Text color */
        border-radius: 8px; /* Rounded corners for the table */
        overflow: hidden; /* Ensure rounded corners are effective */
    }

    .table thead {
        background-color: #f5f5f5; /* Light gray for the header */
    }

    .table th, .table td {
        padding: 12px 15px; /* Comfortable padding */
        text-align: left;
        border: 1px solid #e0e0e0; /* Light border for grid lines inside the table */
    }

    .table th {
        font-weight: 600; /* Bold header text */
        text-transform: uppercase; /* Uppercase for header */
        font-size: 14px; /* Slightly smaller header font */
        color: #555; /* Slightly darker header text */
    }

    .table tbody tr {
        transition: background-color 0.3s; /* Smooth background color change */
    }

    .table tbody tr:hover {
        background-color: #e0e0e0; /* Light gray on hover for feedback */
    }

    /* Action Button Styles */
    .action-buttons-container {
        display: flex; /* Use flexbox for alignment */
        align-items: center; /* Center items vertically */
    }

    /* Action Button Styles */
    .action-button {
    display: inline-block;
    width: 40px; 
    height: 40px; 
    border-radius: 8px; 
    text-align: center; 
    line-height: 40px;
    transition: background-color 0.3s, transform 0.2s;
    margin-right: 5px; /* Optional spacing between buttons */
    flex-shrink: 0;     /* Prevent shrinking of buttons */
    }
    
    .action-button {
    border: 2px solid #8B4513; /* Brown border for all buttons */
    background-color: #f5f5f9;
    color: #8B4513; /* Default brown text */
    cursor: pointer; /* Pointer cursor on hover */
    }

    .edit-button {
        color: #5F370E; 
    }

    .archive-button {
        color: #5F370E;
    }

    .action-button:hover {
        background-color: #FFF5EE; /* Default seashell background */
        color: #333; /* Darker text color on hover */
    }
</style>


<!-- Modal for Adding Admin Record -->
<div id="adminModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-s" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content will be loaded here -->
                <!-- Example form content -->
                <form action="form.php" method="post">
                    <!-- Your form fields go here -->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Admin Record -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-s" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content will be loaded here -->
                <div id="editFormContainer"></div>
            </div>
        </div>
    </div>
</div>


<!-- CSS for modal size -->
<style>
    .modal-dialog.modal-lg {
        max-width: 75%; /* Adjust as needed */
    }
    .modal-body {
        /* Remove fixed height to let the modal adjust based on content */
        overflow: auto;
    }
</style>


<!-- JavaScript to open modal and load PHP file -->
<script>
function openAdminModal() {
    event.preventDefault(); // Prevent default link behavior

    // Set the URL of the PHP file to load
    var phpUrl = 'form.php'; // Change this to the path of your PHP file

    // Use AJAX to load the PHP file into the modal
    fetch(phpUrl)
        .then(response => response.text())
        .then(data => {
            // Insert the form HTML into the modal body
            document.querySelector('#adminModal .modal-body').innerHTML = data;

            // Open the modal
            $('#adminModal').modal('show');
        })
        .catch(error => console.error('Error loading the PHP file:', error));
}
</script>

<script>
function openEditAdminModal(mid) {
    event.preventDefault(); // Prevent default link behavior

    // Set the URL to load the edit form dynamically
    var editUrl = 'edit_admin.php?mid=' + mid;

    // Load the form content into the modal
    fetch(editUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('editFormContainer').innerHTML = data;
            $('#editAdminModal').modal('show');
        })
        .catch(error => console.error('Error loading edit form:', error));
}
</script>

<?php require_once "../table.php"; ?>