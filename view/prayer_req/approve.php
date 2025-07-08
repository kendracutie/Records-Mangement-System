<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/prayer_req.php';
$prayer_req = new prayer_req();

$current_page = 'approved';
require_once "../header.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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

<!-- Confirmation -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Approved Prayer Requests</h4>
            </div>
            <div class="card mb-5 minimalist-card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table minimalist-table table-striped">
                <div class="sorting-controls">
                    <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
                </div>
            <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Prayer Request</th>
        <th>Intention</th>
        <th>Date Requested</th>
        <th>Date Approved</th>
        <th>Approved By</th>
        <th>Options</th>
    </tr>
</thead>
<tbody>
<?php
                                $i = 1;
                                $Confirm_arr = $prayer_req->getApprovedRequests(); // Assuming this retrieves all requests

                                foreach ($Confirm_arr as $value) {
                                    if ($value['status'] == 'approved') {
                                        // Format both dates to display them nicely
                                        $dateRequested = date('M-d-Y h:i A', strtotime($value['time']));
                                        $dateApproved = $value['approved_date'] ? date('M-d-Y h:i A', strtotime($value['approved_date'])) : 'Pending';

                                        $approverUsername = $value['approved_by'];

                                        echo "<tr style='padding-left: 20px;'>
                                            <td data-label='#'> " .$i++." 
                                            <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                            <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                                <i class='fa fa-ellipsis-v'></i>
                                                <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 6px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                                    <a href='delete.php?mid={$value['prayer_id']}&source=index' onclick='confirm_delete(event, this.href)'  title='Delete' class='action-button1 delete-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                                        <i class='fa fa-trash'></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                            <td data-label='NAME:'>{$value['Name']}</td>
                                            <td data-label='PRAYER REQUEST:'>{$value['prayer_rq']}</td>
                                            <td data-label='INTENTION:'>{$value['prayerType']}</td>
                                            <td data-label='DATE REQUESTED:'>{$dateRequested}</td>
                                            <td data-label='DATE APPROVED:'>{$dateApproved}</td>
                                            <td data-label='APPROVED BY:'>{$approverUsername}</td>

                                            <td>
                                            <div class='action-buttons'>
                                            <a href='delete.php?mid={$value['prayer_id']}&source=approve' onclick='confirm_delete(event, this.href)' style='margin-left: 30px;' title='Delete' class='action-button delete-button'>
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

.delete-button {
    color: #5F370E; 
}

.action-button:hover {
        background-color: #FFF5EE; /* Default seashell background */
        color: #333; /* Darker text color on hover */
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
            <button type="button" class="btn btn-burlywood" id="verifyPasswordButton">Verify</button>
            <button type="button" class="btn btn-maroon" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

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
