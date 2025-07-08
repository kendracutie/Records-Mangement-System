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
    background-color: #793232; /* Lighter shade of red on hover */
    border-color: #cc0000; /* Border color on hover */
    color: white;
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
        font-weight: bold; /* Emphasized title */

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

<!-- Admin Management -->
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top:2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Activity Log</h4>
            </div>

            <!-- Filter Form -->
<div class="card minimalist-card mb-3">
    <div class="card-body">
        <form id="generateForm" action="generate.php" method="GET">
            <div class="row">
                <!-- Filter by Admin -->
                <div class="col-md-4">
                    <label for="admin">Admin Username:</label>
                    <select name="admin" id="admin" class="form-control">
                        <option value="">All</option>
                        <?php
                        // Fetch unique admin usernames for the dropdown
                        $admins = $Admin->getUniqueAdmins(); 
                        foreach ($admins as $admin) {
                            echo "<option value='{$admin['username']}'>{$admin['username']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Filter by Month -->
                <div class="col-md-4">
                    <label for="month">Month:</label>
                    <input type="month" name="month" id="month" class="form-control">
                </div>
       

            <!-- Submit Button -->
            <div class="row mt-3">
                <div class="col-md-12 text-right" style="margin-top: 13px;">
                    <!-- Button to Trigger Generate PDF Modal -->
                    <button type="button" class="btn btn-dark-red" id="generatePdfButton">
                        Generate PDF <i class="bi bi-file-earmark-pdf"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
        </div></div>

        
        <!-- Activity Log Section -->
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
                        <th>Date/Time</th>
                        <th>Admin Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $activityLog_arr = $Admin->getActivityLogs(); // Call the method from ActivityLog class
                $j = 1; // Start counting from 1

                if (!is_array($activityLog_arr) || empty($activityLog_arr)) {
                    echo "<tr><td colspan='4' style='text-align: center;'>No activity logs found.</td></tr>";
                } else {
                    foreach ($activityLog_arr as $log) {
                        echo "<tr style='padding-left: 20px;'>
                            <td data-label='#'> " .$j++." </td>
                            <td data-label='DATE/TIME:'>" . date('F j, Y / g:i A', strtotime($log['date'])) . "</td> <!-- Format the date here -->
                            <td data-label='ADMIN USERNAME:'>{$log['username']}</td>
                            <td data-label='ACTION:'>{$log['action']}</td>
                        </tr>";
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Generate PDF Modal -->
<div class="modal fade" id="generatePdfModal" tabindex="-1" role="dialog" aria-labelledby="generatePdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generatePdfModalLabel">Activity Log Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Iframe to show the generated PDF -->
                <iframe id="pdfIframe" src="" style="width:100%; height:520px;" frameborder="0"></iframe>
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

</style>



<!-- Existing Modal Code... -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<script>
   // JavaScript to handle form submission and modal opening
document.getElementById('generatePdfButton').addEventListener('click', function() {
    var form = document.getElementById('generateForm');
    
    // Submit the form to generate.php with selected parameters
    var formData = new FormData(form);
    
    // Check if any filters are selected and prepare the URL
    var admin = formData.get('admin');
    var month = formData.get('month');
    
    var url = 'generate.php?';
    
    if (admin) {
        url += 'admin=' + admin + '&';
    }
    
    if (month) {
        url += 'month=' + month + '&';
    }
    
    // Clean the URL by removing the trailing '&' if it exists
    url = url.slice(0, -1);
    
    // Set the iframe source to the new URL with parameters
    document.getElementById('pdfIframe').src = url;
    
    // Open the modal
    $('#generatePdfModal').modal('show');
});

</script>
<?php require_once "../table.php"; ?>
