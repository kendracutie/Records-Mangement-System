<?php 
session_start();

// Redirect to login page if user is not logged in
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../view/index/php';</script>";
    exit; // Exit to prevent further code execution
}

if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "super_admin" || $_SESSION["role"] == "admin") {
        // Redirect to dashboard if not already on the dashboard
        if (basename($_SERVER['PHP_SELF']) != 'index.php') {
            header("Location: ../../view/dashboard/index.php");
            exit;
        }
    } elseif ($_SESSION["role"] == "user") {
        // Redirect to certificate request page if not already on it
        if (basename($_SERVER['PHP_SELF']) != 'certificate_req.php') {
            header("Location: ../../web-sjmv/certificate_req.php");
            exit;
        }
    }
}

?>
<?php

require_once "../../includes/config.php";

// Function to handle database errors
function handle_db_error($stmt) {
    if ($stmt->errno) {
        die("Database error: " . $stmt->error);
    }
}

// Fetch total active records
$sql = "SELECT 
            (SELECT COUNT(*) FROM baptism WHERE status='active') AS baptism,
            (SELECT COUNT(*) FROM confirmation WHERE status='active') AS confirmation,
            (SELECT COUNT(*) FROM marriage WHERE status='active') AS marriage";

$mysql = $connection->prepare($sql);
if (!$mysql) {
    die("Prepare failed: " . $connection->error);
}
$mysql->execute();
handle_db_error($mysql);
$mysql->bind_result($tbaptism, $tconfirmation, $tmarriage);
$mysql->fetch();
$mysql->close();

$total_records = $tbaptism + $tconfirmation + $tmarriage;

// Get year from the URL, default to current year if not set
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Fetch active records for the specified year
$sql_year = "SELECT 
                (SELECT COUNT(*) FROM baptism WHERE YEAR(baptism_date) = ? AND status='active') AS baptism,
                (SELECT COUNT(*) FROM confirmation WHERE YEAR(confirmation_date) = ? AND status='active') AS confirmation,
                (SELECT COUNT(*) FROM marriage WHERE YEAR(marriage_date) = ? AND status='active') AS marriage";

$mysql_year = $connection->prepare($sql_year);
if (!$mysql_year) {
    die("Prepare failed: " . $connection->error);
}
$mysql_year->bind_param("iii", $year, $year, $year); // Bind the year parameter
$mysql_year->execute();
handle_db_error($mysql_year);
$mysql_year->bind_result($ybaptism, $yconfirmation, $ymarriage);
$mysql_year->fetch();
$mysql_year->close();

// $tr_4year = $ybaptism + $yconfirmation + $ymarriage;

// Sample SQL query to fetch data from your database
$sql_requests = "
SELECT 
    DATE(created_at) AS request_date,
    COUNT(CASE WHEN prayerType IS NOT NULL AND status='active' THEN 1 END) AS prayer_requests,
    COUNT(CASE WHEN prayerType IS NOT NULL THEN 1 END) AS certificate_requests  -- Replace 'certificate_column' with the actual column name
FROM (
    SELECT time AS created_at, prayerType, status FROM prayer_req WHERE status='active'
    UNION ALL
    SELECT request_date AS created_at, certificate_type AS certificate_column, NULL AS status FROM certificate_requests  -- Replace 'certificate_type' if necessary
) AS requests
GROUP BY request_date
ORDER BY request_date";



// Execute the SQL query and fetch the results
$mysql_requests = $connection->prepare($sql_requests);
$mysql_requests->execute();
$mysql_requests->bind_result($request_date, $prayer_requests, $certificate_requests);

// Arrays to hold the results
$months = [];
$prayer_counts = [];
$certificate_counts = [];

// Populate the arrays with data from the query
while ($mysql_requests->fetch()) {
    $months[] = date('F Y', strtotime($request_date));  // Format date as "Month Year"
    $prayer_counts[] = $prayer_requests;
    $certificate_counts[] = $certificate_requests;
}
$mysql_requests->close();



// Now you can use $months, $prayer_counts, and $certificate_counts in your JavaScript for the chart
$current_page = 'overview';
require_once "../header.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. John Marie Vianney Parish</title>
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        
    body {
    background-color: #f3f4f6;
    font-family: 'Cabin', sans-serif;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add this line */
}
.card {
    border-radius: 15px;
    margin-top: 20px;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Add this line */
}
.card1 {
    background-color: rgba(128, 0, 0, 0.6); /* Maroon with some transparency */
    border-radius: 10px;
    padding: 15px;
    color: #FFFFFF; /* White text for better contrast */
    font-weight: bold; /* Make text bold */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Add subtle shadow for emphasis */
}

.card2 {
    background-color: rgba(255, 221, 51, 0.6); /* Dandelion Yellow with some transparency */
    border-radius: 10px;
    padding: 15px;
    color: #800000; /* Maroon text */
    font-weight: bold; /* Make text bold */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Add subtle shadow for emphasis */
}

.card3 {
    background-color: rgba(255, 230, 180, 1); /* Cream with some transparency */
    border-radius: 10px;
    padding: 15px;
    color: #800000; /* Maroon text for better contrast */
    font-weight: bold; /* Make text bold */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Add subtle shadow for emphasis */
}

.card h4 {
    margin: 12px 0px;
}


    .chart { margin-top: 30px; }
    #barChart, #pieChart { width: 100%; height: 400px; }
        .font-weight-dark { color: #333; }

        /* Hide scrollbar for Chrome, Safari and Opera */
        body::-webkit-scrollbar { display: none; }

        /* Hide scrollbar for IE, Edge, and Firefox */
        body { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .dropdown-content::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .dropdown-content {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
        margin-left: 137px;
    }
</style>

<style>
.modal-backdrop {
    background-color: rgba(0, 0, 0, .5); /* Adjust as needed */
}
</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div id="content" class="container mt-3 mb-3" style="max-width: 1610px;">
    <div class="row">
        <div class="col-md-12 animated fadeIn">
            <div class="card mb-2" style="border-radius: 10px; margin-top: 2.5%;">
                <h4 class="font-weight-dark navbar-text ml-3">Overview</h4>
            </div>
            <div class="card mb-5" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4" style="padding-bottom: 10px;">
                            <div class="card1">
                                <h3 class="text-center font-weight-light">Total Baptism</h3>
                                <h4 class="text-center text-white font-weight-light"><?php echo $tbaptism; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 10px;">
                            <div class="card2">
                                <h3 class="text-center text-white font-weight-light">Total Confirmation</h3>
                                <h4 class="text-center text-white font-weight-light"><?php echo $tconfirmation; ?></h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 10px;">
                            <div class="card3">
                                <h3 class="text-center text-white font-weight-light">Total Marriage</h3>
                                <h4 class="text-center text-white font-weight-light"><?php echo $tmarriage; ?></h4>
                            </div>                        
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-7">
                            <h4 class="text-center font-weight-light">Total Records</h4>
                            <div class="chart">
                                <canvas id="barChart" width="600" height="400"></canvas>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h4 class="text-center font-weight-light" style="position: relative;">
                                <i class="fa fa-caret-down" id="dropdownIcon" style="cursor:pointer;"></i> 
                                <span id="currentYear"><?php echo date("Y"); ?></span> Annual Report 
                            </h4>  
                            <div class="dropdown-content" id="yearDropdown" style="display:none; position:absolute; background-color: #f9f9f9; z-index: 1; max-height: 150px; overflow-y: auto;">
                                <?php 
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2011; $year--) {
                                        echo "<a href='#' onclick='updateYear($year)'>$year</a>";
                                    }
                                ?>
                            </div>
                            <div class="chart">
                                <canvas id="pieChart" width="600" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row mt-5">
                        <div class="col-md-12">
                            <h4 class="text-center font-weight-light">Prayer and Certificate Requests Over Time</h4>
                            <div class="chart">
                                <canvas id="lineChart" width="600" height="400"></canvas> <!-- Adjusted size for better visibility -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<script src="../assets/chartjs-old/Chart.min.js"></script>
<script>
var ctxBar = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Baptism', 'Confirmation', 'Marriage'],
        datasets: [{
            label: 'Total Records',
            data: [<?php echo $tbaptism; ?>, <?php echo $tconfirmation; ?>, <?php echo $tmarriage; ?>],
            backgroundColor: [
                'rgba(128, 0, 0, 0.6)',  // Maroon
                'rgba(255, 221, 51, 0.6)',  // Dandelion Yellow
                'rgba(255, 230, 180, 1)'  // Cream
            ],
            borderColor: [
                'rgba(102, 0, 0, 1)',  // Dark Maroon
                'rgba(204, 170, 0, 1)',  // Darker Dandelion Yellow
                'rgba(255, 230, 180, 1)'  // Warm Cream
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{ ticks: { beginAtZero: true } }]
        },
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Total Number of Records: <?php echo $total_records; ?>'
        }
    }
});

var ctxPie = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Baptism', 'Confirmation', 'Marriage'],
        datasets: [{
            data: [<?php echo $ybaptism; ?>, <?php echo $yconfirmation; ?>, <?php echo $ymarriage; ?>],
            backgroundColor: [
                'rgba(128, 0, 0, 0.6)',    // Maroon
                'rgba(255, 221, 51, 0.6)',  // Dandelion Yellow
                'rgba(255, 230, 180, 1)'     // Cream
            ],
            borderColor: [
                'rgba(102, 0, 0, 1)',       // Dark Maroon Border
                'rgba(204, 170, 0, 1)',     // Darker Dandelion Yellow Border
                'rgba(255, 230, 180, 1)'     // Warm Cream Border
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Records for the Year <?php echo date("Y"); ?>'
        },
        plugins: {
            datalabels: {
                formatter: function(value, ctx) {
                    return value; // Display the actual value (number of records)
                },
                color: 'white',
                font: {
                    weight: 'bold'
                }
            }
        }
    }
});

function updateYear(year) {
    document.getElementById('currentYear').textContent = year;
    document.getElementById('yearDropdown').style.display = 'none'; // Hide dropdown after selection

    // Fetch new data based on the selected year
    fetchData(year).then(data => {
        if (data) {
            // Update the chart data with the new data
            pieChart.data.datasets[0].data = data.records; // Update with the new records
            pieChart.options.title.text = 'Records for the Year ' + year; // Update the chart title
            pieChart.update(); // Redraw the chart
        }
    }).catch(error => {
        console.error('Error fetching data:', error);
    });
}

// Function to fetch data from the server
function fetchData(year) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_data.php?year=' + year, true); // Your PHP file to fetch data
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);
                resolve(response);
            } else {
                reject(xhr.statusText);
            }
        };
        xhr.onerror = function() {
            reject(xhr.statusText);
        };
        xhr.send();
    });
}

// Toggle dropdown visibility when the dropdown icon is clicked
document.getElementById('dropdownIcon').onclick = function() {
    var dropdown = document.getElementById('yearDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
};

// Close dropdown if clicked outside of it
window.onclick = function(event) {
    if (!event.target.matches('#dropdownIcon')) {
        var dropdown = document.getElementById('yearDropdown');
        dropdown.style.display = "none"; // Hide the dropdown
    }
};
</script>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months); ?>,  // Month names
            datasets: [
                {
                    label: 'Prayer Requests',
                    data: <?php echo json_encode($prayer_counts); ?>,  // Data for prayer requests
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',  // Light Green
                    borderColor: 'rgba(0, 128, 0, 1)',  // Dark Green
                    borderWidth: 2,
                    fill: false,  // Set this to false to show lines clearly
                    tension: 0.4  // Makes the line curve
                },
                {
                    label: 'Certificate Requests',
                    data: <?php echo json_encode($certificate_counts); ?>,  // Data for certificate requests
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',  // Light Blue
                    borderColor: 'rgba(0, 0, 255, 1)',  // Dark Blue
                    borderWidth: 2,
                    fill: false,  // Set this to false to show lines clearly
                    tension: 0.4  // Makes the line curve
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Requests'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Tracking Prayer and Certificate Requests'
                }
            }
        }
    });
});
</script> -->

</body>
</html>
