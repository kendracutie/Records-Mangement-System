<?php
session_start();
require_once "../../includes/config.php";

// Get year from the request
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Fetch active records for the specified year
$sql = "SELECT 
            (SELECT COUNT(*) FROM baptism WHERE YEAR(baptism_date) = ? AND status='active') AS baptism,
            (SELECT COUNT(*) FROM confirmation WHERE YEAR(confirmation_date) = ? AND status='active') AS confirmation,
            (SELECT COUNT(*) FROM marriage WHERE YEAR(marriage_date) = ? AND status='active') AS marriage";

$mysql = $connection->prepare($sql);
$mysql->bind_param("iii", $year, $year, $year);
$mysql->execute();
$mysql->bind_result($baptism, $confirmation, $marriage);
$mysql->fetch();
$mysql->close();

$response = [
    'records' => [$baptism, $confirmation, $marriage],
    'total' => [$baptism, $confirmation, $marriage], // Can be adjusted for the bar chart
    'totalRecords' => $baptism + $confirmation + $marriage
];

header('Content-Type: application/json');
echo json_encode($response);
?>
