<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/prayer_req.php';
$prayer_req = new prayer_req();

$current_page = 'pending';
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
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Pending Prayer Requests</h4>
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
                        <th>Name</th>
                        <th>Prayer Request</th>
                        <th>Intention</th>
                        <th>Date Requested</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $Prayer_arr = $prayer_req->getall();
                   

                                    // Display the rest of the rows (excluding the highlighted one)
                    foreach ($Prayer_arr as $value) {
                        if ($value['status'] == 'pending') {
                            // Debug: print the raw value of the timestamp
                            echo "<tr style='padding-left: 20px;'>
                                <td data-label='#'> " .$i++." 
                                <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                    <i class='fa fa-ellipsis-v'></i>
                                    <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 6px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                        <a href='approved.php?mid={$value['prayer_id']}' onclick=''  title='Approve' class='action-button1 approve-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-check'></i> Approve
                                        </a>
                                        <a href='delete.php?mid={$value['prayer_id']}&source=index' onclick='confirm_delete(event, this.href)'  title='Delete' class='action-button1 decline-button' style='display: block; padding: 8px 12px; margin-bottom: 5px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                                <td data-label='NAME:'>{$value['Name']}</td>
                                <td data-label='PRAYER REQUEST:'>{$value['prayer_rq']}</td>
                                <td data-label='INTENTION:'>{$value['prayerType']}</td>
                                <td data-label='DATE REQUESTED:'>" . date('M-d-Y, h:i A', strtotime($value['time'])) . "</td>

                                <td>
                                <div class='action-buttons'>
                                <a href='approved.php?mid={$value['prayer_id']}' onclick='confirmApproval(event, this.href, {$value['prayer_id']})' class='action-button approve-button' style='margin-left: 60%;' title='Approve'><i class='fa fa-check'></i></a>
                                <a href='delete.php?mid={$value['prayer_id']}' onclick='confirmDelete(event, this.href)' title='Delete' class='action-button delete-button'>
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

    /* Highlighted Row */
    #highlighted-row {
        background-color: #f9f9f9 !important; /* Maintain highlighted background */
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



<!-- Add this script to your page -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(event, url) {
    event.preventDefault(); // Prevent the default action of the link

    // Show confirmation dialog
    Swal.fire({
        title: '<span style="color: #800000;">Are you sure?</span>', // Maroon title
        text: "You won't be able to revert this!",
        icon: 'warning',
        background: '#fffef0', // Cream background
        color: '#000000', // Black text
        showCancelButton: true,
        confirmButtonColor: '#deb887', // Burlywood confirm button
        cancelButtonColor: '#630707', // Maroon cancel button
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Navigate to the deletion URL if confirmed
            window.location.href = url;
        }
    });
}

</script>
<style>
    /* CSS to remove the default outline from SweetAlert2 buttons */
    .swal2-confirm,
    .swal2-cancel {
        outline: none !important; /* Remove the default focus outline */
    }
    .swal2-cancel:hover {
    background-color: #793232 !important; /* Hover color */
    color: white;
    }
    .swal2-confirm:hover {
      background-color: #e6c59c !important; /* Hover color */
    }
    /* Remove any box-shadow or border if needed */
    .swal2-confirm,
    .swal2-cancel {
        border: none !important; /* Remove border */
        box-shadow: none !important; /* Remove box-shadow */
    }

    
</style>
<script>
    // Function to trigger confirmation modal for approving prayer request
function confirmApproval(event, url, prayerId) {
    event.preventDefault(); // Prevent the default action of the link

    // First confirmation dialog for prayer request approval
    Swal.fire({
        title: '<span style="color: #800000;">Are you sure?</span>',
        text: "You won't be able to revert this!",
        icon: 'warning',
        background: '#fffef0',
        color: '#000000',
        showCancelButton: true,
        confirmButtonColor: '#deb887',
        cancelButtonColor: '#800000',
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'Cancel',
        customClass: {
            confirmButton: 'black-text'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the approval by redirecting to the approval URL
            window.location.href = url;
        }
    });
}

</script>



<?php require_once "../table.php" ?>
