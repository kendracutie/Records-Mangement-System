<?php $current_page = 'marr_archive'; ?>
<?php 
session_start();
if(empty($_SESSION["username"])){
    echo "<script>window.location.href='../view/index.php';</script>";
}

require_once '../class/Marriage.php';
$marriage = new Marriage();

require_once "../header.php";
?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
            font-family: 'Arial', sans-serif;
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

<!-- Marriage  -->

<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12  animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Marriage Archives</h4>
            </div>
			<div class="card mb-5 minimalist-card" style="border-radius: 10px;">
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table minimalist-table table-striped">
                <div class="sorting-controls">
                    <button onclick="sortTable(1)"><i class="fa fa-sort"></i></button>
                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Groom / Bride</th>
                        <th>Date Issued</th>
                        <th>Date of Nuptial</th>
                        <th>Priest</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $marriage_array = $marriage->getCouple();

                    foreach ($marriage_array as $value) {
                        // Check if the status is active before displaying the record
                        if ($value['status'] == 'archived') {
                            echo "<tr style='padding-left: 20px;'>
                                <td data-label='#'> " .$i++." 
                                <span style='margin-right: 83%;'></span> <!-- Add some margin to separate the number -->
                                <div class='three-dots style='display: inline-block; cursor: pointer;' onclick='toggleDropdown(this)'>
                                    <i class='fa fa-ellipsis-v'></i>
                                    <div class='dropdown-menu' style='display: none; position: absolute; background: white; border: 1px solid #ccc; padding: 6px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); z-index: 10; margin-left: -3500%;'>
                                        <a href='restore.php?mid={$value["marriage_id"]}' onclick='confirm_restore(event, this.href)'  title='Restore' class='action-button1 restore-button' style='display: block; padding: 8px 12px; padding-top:1px; margin-left:3px;'>
                                            <i class='fa fa-undo'></i> Restore
                                        </a>
                                    </div>
                                </div>
                            </td>
                                <td data-label='Groom/Bride:'>{$value['groom_first_name']} {$value['groom_last_name']} & {$value['bride_first_name']} {$value['bride_last_name']}</td>
                                <td data-label='Priest:'>{$value['priests']}</td>
                                <td data-label='Date Issued:'>{$value['registration_date']}</td>
                                <td data-label='Date of Nuptial:'>{$value['marriage_date']}</td>
                                <td> 
                                <div class='action-buttons'>
                                <a href='restore.php?mid={$value["marriage_id"]}' onclick='confirm_restore(event, this.href)' class='action-button restore-button' style='margin-left: 30px;' title='Restore'>
                                    <i class='fa fa-undo'></i>
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

    .action-button:hover {
        background-color: #FFF5EE; /* Default seashell background */
        color: #333; /* Darker text color on hover */
  }
  .restore-button {
        color: #5F370E; 
    }
</style>


<?php require_once "../table.php" ?>
