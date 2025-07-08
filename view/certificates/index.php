<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/certificate_req.php';
$certificate_req = new certificate_req();

$current_page = 'pending';
require_once "../header.php"; 

?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
    background-color: #8b0000; /* Dark red color */
    border-color: #8b0000; /* Match the border color with the solid color */
    color: white; /* Text color */
}

.btn-dark-red:hover {
    background-color: #cc0000; /* Lighter shade of red on hover */
    border-color: #cc0000; /* Border color on hover */
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

<!-- Certificate Requests -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Pending Certificate Requests</h4>
            </div>

            <div class="card mb-5 minimalist-card">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="myTable" class="table minimalist-table table-striped">
                        <div class="sorting-controls">
                            <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
                        </div>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Requester Name</th>
                                    <th>Person Name</th>
                                    <th>Email</th>
                                    <th>Date of Birth</th>
                                    <th>Certificate Type</th>
                                    <th>Request Purpose</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
$i = 1;
$Cert_req_arr = $certificate_req->getAll(); // Retrieve all certificate requests

// Display all rows without highlighting
foreach ($Cert_req_arr as $value) {
    if ($value['status'] == 'pending') {
        echo "<tr style='padding-left: 20px;'>
                            <td data-label='#'> " .$i++." 
                                <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                    <i class='fa fa-ellipsis-v'></i>
                                    <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                        <a href='#' title='View Details' onclick='viewDetails(event, {$value['request_id']})' class='action-button1 view-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-eye'></i> View
                                        </a>
                                        <a href='#' onclick='approveRequest(event, {$value["request_id"]})' title='Approve' class='action-button1 approve-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-check'></i> Approve
                                        </a>
                                        <a href='#' onclick='declineRequest(event, {$value["request_id"]})' title='Decline' class='action-button1 decline-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-times'></i> Decline
                                        </a>
                                    </div>
                                </div>
                            </td>
            <td data-label='REQUESTER NAME:'>{$value['requester_first_name']} {$value['requester_middle_name']} {$value['requester_last_name']}</td>
            <td data-label='PERSON NAME:'>{$value['person_first_name']} {$value['person_middle_name']} {$value['person_last_name']} </td>
            <td data-label='EMAIL:'>{$value['requester_email']}</td>
            <td data-label='DATE OF BIRTH:'>" . (!empty($value['person_dob']) && $value['person_dob'] != '0000-00-00' ? $value['person_dob'] : 'N/A') . "</td>
            <td data-label='CERTIFICATE TYPE:'>{$value['certificate_type']}</td>
            <td data-label='REQUEST PURPOSE:'>{$value['request_purpose']}</td>
            <td>
                <div class='action-buttons'>
                    <a href='#' class='action-button view-button' title='View Details' onclick='viewDetails(event, {$value['request_id']})'><i class='fa fa-eye'></i></a>
                    <a href='#' onclick='approveRequest(event, {$value["request_id"]})' title='Approve' class='action-button approve-button'><i class='fa fa-check'></i></a>
                    <a href='#' onclick='declineRequest(event, {$value["request_id"]})' class='action-button decline-button' title='Decline'><i class='fa fa-times'></i></a>
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

.approve-button {
    color: #5F370E; 
}

.decline-button {
    color: #5F370E; 
}

.action-button:hover {
    background-color: #FFF5EE; /* Default seashell background */

        color: #333; /* Darker text color on hover */
    }

</style>
<style>
    .btn-burlywood {
        background-color: burlywood;
        color: white;
    }
    .btn-burlywood:hover {
        background-color: #cdaa7d; /* Lighter burlywood */
        color: white;
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
<!-- Modal for Viewing Details -->
<div id="detailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Certificate Request Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent">Loading...</div>
            </div>
        </div>
    </div>
</div>

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
            <button type="button" class="btn btn-burlywood" id="verifyPasswordButton">Verify</button>
            <button type="button" class="btn btn-maroon" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal for Approving Requests -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="approveModalLabel">Approve Certificate Request</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content will be loaded here -->
                <div id="approveFormContainer">Loading...</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Declining Requests -->
<div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="declineModalLabel">Decline Certificate Request</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content for declining will be loaded here -->
                <div id="declineFormContainer">Loading...</div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to open modal and load PHP file -->
<script>
function viewDetails(event, mid) {
    event.preventDefault(); // Prevent default link behavior

    // Set the URL of the PHP file to load with the request ID
    var phpUrl = 'view_request_details.php?mid=' + mid;

    // Use AJAX to load the PHP file into the modal
    fetch(phpUrl)
        .then(response => response.text())
        .then(data => {
            // Insert the form HTML into the modal body
            document.getElementById('modalContent').innerHTML = data;

            // Open the modal
            $('#detailsModal').modal('show');
        })
        .catch(error => console.error('Error loading the PHP file:', error));
}
</script>

<script>
    // Global variable to track the current action
    let currentAction = '';

    // Approve request function
    function approveRequest(event, requestId) {
        event.preventDefault(); // Prevent the default link action

        // Set the request ID in the hidden input field
        document.getElementById('mid').value = requestId;

        // Set current action to 'approve'
        currentAction = 'approve';

        // Show the password verification modal
        $('#passwordVerificationModal').modal('show');
    }

    // Decline request function
    function declineRequest(event, requestId) {
        event.preventDefault(); // Prevent the default link action

        // Set the request ID in the hidden input field
        document.getElementById('mid').value = requestId;

        // Set current action to 'decline'
        currentAction = 'decline';

        // Show the password verification modal
        $('#passwordVerificationModal').modal('show');
    }

    // Function to verify password against the database
    document.getElementById('verifyPasswordButton').addEventListener('click', function() {
        const passwordInput = document.getElementById('passwordInput').value;
        const passwordError = document.getElementById('passwordError');
        const requestId = document.getElementById('mid').value;

        // AJAX request to verify the password
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'verify_password.php', true); // Adjust the URL as needed
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

                    // Perform the action based on the currentAction variable
                    if (currentAction === 'approve') {
                        // Load and show the approve modal only after password verification
                        const approveUrl = 'approved_requests.php?mid=' + requestId;
                        fetch(approveUrl)
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('approveFormContainer').innerHTML = data;
                                $('#approveModal').modal('show');
                            })
                            .catch(error => console.error('Error loading approve form:', error));
                    } else if (currentAction === 'decline') {
                    // Load and process the decline request
                    const declineUrl = 'decline_request.php?mid=' + requestId;
                    fetch(declineUrl)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('declineFormContainer').innerHTML = data; // Update the form or UI for declining
                            $('#declineModal').modal('show'); // Show the decline modal after password verification
                        })
                        .catch(error => console.error('Error declining request:', error));
                }

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

<script>
function toggleSelect() {
    const customMessage = document.getElementById('custom_message').value.trim();
    const predefinedMessages = document.getElementById('predefined_messages');

    // Disable the select if there is input in the textarea
    if (customMessage !== '') {
        predefinedMessages.disabled = true;
        predefinedMessages.selectedIndex = 0; // Reset the select to the default option
    } else {
        predefinedMessages.disabled = false; // Enable select if textarea is empty
    }
}

function toggleTextarea() {
    const predefinedMessages = document.getElementById('predefined_messages').value;
    const customMessage = document.getElementById('custom_message');

    // Disable the textarea if a predefined message is selected
    if (predefinedMessages !== '') {
        customMessage.disabled = true;
        customMessage.value = ''; // Clear the textarea if a predefined message is selected
    } else {
        customMessage.disabled = false; // Enable textarea if no predefined message is selected
    }
}

// Initial check to set the state of the elements on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleSelect();
    toggleTextarea();
});
</script>

<?php require_once "../table.php"; ?>
