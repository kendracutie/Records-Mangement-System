<?php 
session_start();

if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
    exit;
}

require_once('../../fpdf/fpdf.php');
require_once('../../fpdi/src/autoload.php');
require_once('../class/Admin.php');

use setasign\Fpdi\Fpdi;

// Initialize Admin class
$Admin = new Admin();

// Get filter values from query string
$filter_admin = isset($_GET['admin']) && $_GET['admin'] !== '' ? $_GET['admin'] : null;
$filter_month = isset($_GET['month']) && $_GET['month'] !== '' ? $_GET['month'] : null; // Format: YYYY-MM

// Fetch filtered activity logs
$activity_logs = $Admin->getFilteredLogs($filter_admin, $filter_month);

// Generate PDF if logs are found
if (!empty($activity_logs)) {
    $pdf = new FPDI();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    // Add a title
    $pdf->Cell(0, 10, "Activity Log Report", 0, 1, 'C');
    $pdf->Ln(5);

    // Add filters summary
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10, "Filters Applied:");
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);
    
    // Display the selected admin or 'All' if no admin is selected
    $pdf->Cell(50, 10, "Admin: " . ($filter_admin ?? 'All'));
    $pdf->Ln(5);
    
    // Display the selected month or 'All' if no month is selected
    $pdf->Cell(50, 10, "Month: " . ($filter_month ? date("F Y", strtotime($filter_month . "-01")) : 'All'));
    $pdf->Ln(10);

    // Add table headers
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 10, "#", 1, 0, 'C'); // Column for #
    $pdf->Cell(50, 10, "Date/Time", 1, 0, 'C'); // Wider Date/Time column
    $pdf->Cell(130, 10, "Action", 1, 1, 'C'); // Maximize Action column

    // Add table rows
    $pdf->SetFont('Arial', '', 10);
    $count = 1;

    foreach ($activity_logs as $log) {
        $pdf->Cell(10, 10, $count++, 1, 0, 'C');
        $pdf->Cell(50, 10, date('F j, Y, g:i A', strtotime($log['date'])), 1, 0, 'C');
        $pdf->Cell(130, 10, $log['action'], 1, 1, 'L'); // Align action text to the left
    }

    // Output the PDF directly into the iframe
    ob_end_clean();
    $pdf->Output('activity_log.pdf', 'I');
    exit;
} else {
    echo "No activity logs found with the specified filters.";
}
?>
