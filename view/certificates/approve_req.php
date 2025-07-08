<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
    exit;
}

require_once '../class/certificate_req.php';
$certificate_req = new certificate_req();

$current_page = 'approved';  // Updated current page to 'approved'
require_once "../header.php"; 

require_once '../../includes/connect.php';
$conn = new Conn();
$cn = $conn->connect(1);

// Get the request ID from the URL
$request_id = isset($_GET['mid']) ? $_GET['mid'] : null;

if ($request_id) {
    // Validate the request ID
    if (!filter_var($request_id, FILTER_VALIDATE_INT)) {
        echo "<p>Invalid request ID.</p>";
        exit;
    }

    // Query to get the certificate request details
    $query = "SELECT * FROM certificate_requests WHERE request_id = ?";
    if ($stmt = $cn->prepare($query)) {
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $request = $result->fetch_assoc();
            // Display the record (add your HTML here)
            echo "<h1>Certificate Request Details</h1>";
            // Output the details here (customize as needed)
        } else {
            echo "<p>No certificate request found.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error preparing the statement.</p>";
    }
}

// Close the database connection
$cn->close();
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

<!-- Certificate Requests -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Approved Certificate Requests</h4>
            </div>

            <div class="card mb-5 minimalist-card table-striped">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="myTable" class="table minimalist-table">
                        <div class="sorting-controls">
                            <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
                        </div>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Requester Name</th>
                                    <th>Person Name</th>
                                    <th>Email</th>
                                    <th>Certificate Type</th>
                                    <th>Request Purpose</th>
                                    <th>Approved By</th> <!-- New column for approver's name -->
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
$i = 1;
$Cert_req_arr = $certificate_req->getApprovedRequests(); // Retrieve only approved certificate requests

// Display all approved requests
foreach ($Cert_req_arr as $value) {
    // Determine the URL based on the certificate type
    $certificateType = $value['certificate_type'];
    $requestId = $value['request_id'];

    // Format the approved date and date of birth
    $approvedDate = date('F j, Y', strtotime($value['approved_date']));
    $personDob = date('F j, Y', strtotime($value['person_dob']));

    // Use the username for the approver
    $approverUsername = $value['approved_by'];

    echo "<tr style='padding-left: 20px;'>
                            <td data-label='#'> " .$i++." 
                                <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                    <i class='fa fa-ellipsis-v'></i>
                                    <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                        <a href='#' title='View Details' onclick='viewDetails(\"$certificateType\", $requestId)' class='action-button1 view-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-eye'></i> View
                                        </a>
                                        <a href='delete.php?mid={$value['request_id']}' onclick='confirm_delete(event, this.href)' title='Delete' class='action-button1 delete-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
        <td data-label='REQEUSTER NAME:'>{$value['requester_first_name']} {$value['requester_middle_name']} {$value['requester_last_name']}</td>
        <td data-label='PERSON NAME:'>{$value['person_first_name']} {$value['person_middle_name']} {$value['person_last_name']}</td>
        <td data-label='EMAIL:'>{$value['requester_email']}</td>
        <td data-label='CERTIFICATE TYPE:'>{$value['certificate_type']}</td>
        <td data-label='REQUEST PURPOSE:'>{$value['request_purpose']}</td>
        <td data-label='APPROVED BY:'>{$approverUsername}</td> <!-- Display approver's username -->
        <td>
            <div class='action-buttons'>
                <a href='#' class='action-button view-button' title='View Details' onclick='viewDetails(\"$certificateType\", $requestId)'>
                    <i class='fa fa-eye'></i>
                </a>
                <a href='delete.php?mid={$value['request_id']}' onclick='confirm_delete(event, this.href)' title='Delete' class='action-button delete-button'>
                    <i class='fa fa-trash'></i>
                </a>
            </div>
        </td>
    </tr>";
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
    /* Card and Table Styling */
    .minimalist-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Arial', sans-serif;
        color: #333;
        border-radius: 8px;
        overflow: hidden;
    }
    .table thead {
        background-color: #f5f5f5;
    }
    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #e0e0e0;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        color: #555;
    }
    .table tbody tr:hover {
        background-color: #e0e0e0;
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



.delete-button {
    color: #5F370E; 
}

.action-button:hover {
    background-color: #FFF5EE; /* Default seashell background */
        color: #333; /* Darker text color on hover */
    }

</style>

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
        <div class="modal-content" style="background-color:whitesmoke">
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
                        <input type="password" class="form-control" id="passwordInput" placeholder="Enter Password" required >
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
function viewDetails(certificateType, requestId) {
    let viewUrl = '';
    if (certificateType === 'baptism') {
        viewUrl = `../baptism/index.php?mid=${requestId}`;
    } else if (certificateType === 'confirmation') {
        viewUrl = `../confirmation/index.php?mid=${requestId}`;
    } else {
        viewUrl = '#'; // Fallback if type is unknown
    }

    // Redirect to the constructed URL
    if (viewUrl !== '#') {
        window.location.href = viewUrl;
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


<?php require_once "../table.php"; ?>
