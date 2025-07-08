<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/Confirmation.php';
$Confirmation = new Confirmation();

$current_page = 'confirmation';
require_once "../header.php"; 



?>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
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
    </style>

<!-- Confirmation -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top:2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Confirmation Records</h4>
            </div>
            <div class="card mb-5 minimalist-card">
    <div class="card-body">
        <!-- Button to open the Add Confirmation Record modal -->
        <button type="button" class="btn btn-dark-red" onclick="openConfirmationModal()">
            <i class="fa fa-plus"></i> New Confirmation
        </button>

        <!-- Add margin-top to create space before the table -->
        <div class="table-responsive mt-3">
            <table id="myTable" class="table minimalist-table table-striped">
            <div class="sorting-controls">
                <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
            </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Parents</th>
                        <th>Place of Baptism</th>
                        <th>Priest</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $Confirm_arr = $Confirmation->getall(); // Assuming 'getall()' fetches data from both tables

                    foreach ($Confirm_arr as $value) {
                        if ($value['status'] == 'active') {
                            echo "<tr style='padding-left: 20px;'>
                            <td data-label='#'> " .$i++." 
                                <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                    <i class='fa fa-ellipsis-v'></i>
                                    <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                        <a href='#' onclick='openCertificateModal({$value['confirmation_id']})' class='action-button1 view-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-eye'></i> View
                                        </a>
                                        <a href='#' onclick='openEditModal({$value['confirmation_id']})' class='action-button1 edit-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-edit'></i> Modify
                                        </a>
                                        <a href='archive.php?mid={$value['confirmation_id']}' onclick='confirm_archive(event, this.href)' class='action-button1 archive-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-archive'></i> Archive
                                        </a>
                                        <a href='delete.php?mid={$value['confirmation_id']}' onclick='confirm_delete(event, this.href)' class='action-button1 delete-button' style='display: block; padding: 8px 12px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td data-label='Date:'>{$value['confirmation_date']}</td>
                            <td data-label='Name:'>{$value['first_name']} {$value['middle_name']} {$value['last_name']}</td>
                            <td data-label='Age:'>{$value['age']}</td>
                            <td data-label='Parents:'>{$value['father_name']} & {$value['mother_name']}</td>
                            <td data-label='Place of Baptism:'>{$value['place_of_baptism']}</td>
                            <td data-label='Priest:'>{$value['priests']}</td>
                            <td>
                            
                            <div class='action-buttons'>
                                <a href='#' title='View Certificate' onclick='openCertificateModal({$value["confirmation_id"]})' class='action-button view-button'>
                                    <i class='fa fa-eye'></i>
                                </a>
                                <a href='#' onclick='openEditModal({$value["confirmation_id"]})' title='Modify' class='action-button edit-button'>
                                    <i class='fa fa-edit'></i>
                                </a>
                                <a href='archive.php?mid={$value["confirmation_id"]}' onclick='confirm_archive(event, this.href)' title='Archive' class='action-button archive-button'>
                                    <i class='fa fa-archive'></i>
                                </a>
                                <a href='delete.php?mid={$value['confirmation_id']}' onclick='confirm_delete(event, this.href)' title='Delete' class='action-button delete-button'>
                                    <i class='fa fa-trash'></i>
                                </a>
                            </div>
                            </td>
                            </tr>";
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

    /* Remove outer borders */
    .table th:first-child,
    .table td:first-child,
    .table th:last-child,
    .table td:last-child {
        border-left: none; /* Remove left outer border */
        border-right: none; /* Remove right outer border */
    }

      /* Button Container */
    .button-container {
        display: flex;          /* Use flexbox for layout */
        justify-content: flex-start; /* Align items to the start */
        gap: 5px;            /* Space between buttons */
        flex-wrap: nowrap;    /* Prevent wrapping */
        overflow: hidden;      /* Hide overflow */
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

    .view-button {
        color: #5F370E; 
    }
    .edit-button {
        color: #5F370E; 
    }

    .archive-button {
        color: #5F370E;
    }

    .delete-button {
        color: #5F370E; 
    }

    .action-button:hover {
        background-color: #FFF5EE; /* Default seashell background */
        color: #333; /* Darker text color on hover */
    }

</style>


<!-- Modal for Certificate -->
<div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateModalLabel">Certificate of Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- PDF content will be loaded here -->
                <iframe id="certificateFrame" src="" style="width:100%; height:520px;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Cofirmation Record -->
<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">New Confirmation Record</h5>
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

<!-- Modal for Editing Confirmation Record -->
<div class="modal fade" id="editConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="editConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmationModalLabel">Edit Confirmation Record</h5>
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

<!-- Simplified Modal for Password Verification -->
<div class="modal fade" id="passwordVerificationModal" tabindex="-1" aria-labelledby="passwordVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Added 'modal-dialog-centered' class here -->
        <div class="modal-content" style="background-color: whitesmoke;">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordVerificationModalLabel">Verify Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="passwordForm">
                    <div class="form-group">
                        <label for="passwordInput">Password:</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="Enter Password" required>
                        <div id="passwordError" class="text-danger" style="display:none;">Incorrect password, please try again.</div>
                    </div>
                    <input type="hidden" id="mid"> <!-- Hidden field for request ID -->
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn" style="background-color: burlywood; color: black;" id="verifyPasswordButton">Verify</button>
            <button type="button" class="btn" style="background-color: #630707; color: white;" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript to open modal and load PDF -->
<script>
function openCertificateModal(mid) {
    event.preventDefault(); // Prevent default link behavior

    // Set the PDF URL dynamically using the passed mid parameter
    var pdfUrl = 'generate.php?mid=' + mid;

    // Set the source of the iframe inside the modal
    document.getElementById('certificateFrame').src = pdfUrl;

    // Open the modal
    $('#certificateModal').modal('show');
}
</script>


<!-- JavaScript to open modal and load PHP file -->
<script>
function openConfirmationModal() {
    event.preventDefault(); // Prevent default link behavior

    // Set the URL of the PHP file to load
    var phpUrl = 'form.php'; // Change this to the path of your PHP file

    // Use AJAX to load the PHP file into the modal
    fetch(phpUrl)
        .then(response => response.text())
        .then(data => {
            // Insert the form HTML into the modal body
            document.querySelector('#confirmationModal .modal-body').innerHTML = data;

            // Open the modal
            $('#confirmationModal').modal('show');
        })
        .catch(error => console.error('Error loading the PHP file:', error));
}
</script>

<script>
function openEditModal(mid) {
    event.preventDefault(); // Prevent default link behavior

    // Set the URL to load the edit form dynamically
    var editUrl = 'edit.php?mid=' + mid;

    // Load the form content into the modal
    fetch(editUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('editFormContainer').innerHTML = data;
            $('#editConfirmationModal').modal('show');
        })
        .catch(error => console.error('Error loading edit form:', error));
}
</script>


<script>
    function addSponsor() {
        const sponsorContainer = document.getElementById('sponsors');
        const sponsorHTML = `
            <div class="sponsor-row">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label><b>First Name</b></label>
                        <input required type="text" name="sponsor_first_name[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label><b>Middle Name</b></label>
                        <input required type="text" name="sponsor_middle_name[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label><b>Last Name</b></label>
                        <input required type="text" name="sponsor_last_name[]" class="form-control">
                    </div>
                    
                    <div class="col-md-3">
                        <label><b>Relation</b></label>
                        <select name="relation[]" class="form-control">
                            <option value="" disabled selected>Please Select</option>
                            <option value="Ninong">Ninong</option>
                            <option value="Ninang">Ninang</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        sponsorContainer.insertAdjacentHTML('beforeend', sponsorHTML);
    }
</script>

<script>
    function clearSponsor() {
        const sponsorRows = document.querySelectorAll('.sponsor-row');
        
        // Remove the last sponsor row if there's more than one row
        if (sponsorRows.length > 1) {
            sponsorRows[sponsorRows.length - 1].remove();
        }
    }
</script>

<script>
    // Existing approveRequest function
function approveRequest(requestId) {
    // Set the hidden input field with the request ID
    document.getElementById('mid').value = requestId;

    // Show the password verification modal
    $('#passwordVerificationModal').modal('show');
}

// Password verification logic
document.getElementById('verifyPasswordButton').addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput').value;
    const passwordError = document.getElementById('passwordError');
    const requestId = document.getElementById('mid').value;

    // AJAX request to verify the password
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../certificates/verify_password.php', true); // Adjust the URL as needed
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = xhr.responseText.trim(); // Get the plain text response

            // Check if password verification was successful
            if (response === 'success') {
                // Hide the password error message
                passwordError.style.display = 'none';

                // Close the password verification modal
                $('#passwordVerificationModal').modal('hide');

                // Now proceed to delete the record
                window.location.href = requestId; // Redirect to the delete URL
            } else {
                // Show the password error message
                passwordError.style.display = 'block';
            }
        }
    };

    // Send the password to the server
    xhr.send('password=' + encodeURIComponent(passwordInput));
});
</script>   
<?php require_once "../table.php" ?>
