<?php 
session_start();

if(empty($_SESSION["username"])){
    echo "<script>window.location.href='../../view/index.php';</script>";
    exit; // Make sure to exit after redirection
}

require_once('../../fpdf/fpdf.php');
require_once('../../fpdi/src/autoload.php');
require_once('../class/Baptism.php');

use setasign\Fpdi\Fpdi;

// Check if the "mid" parameter is set
if(isset($_GET['mid'])) {
    $mid = $_GET['mid'];

    // Fetch baptism data
    $Baptism = new Baptism();
    $Baptism_arr = $Baptism->generate();

    // Find the specific record using $mid
    $data = null;
    foreach ($Baptism_arr as $item) {
        if ($item['baptism_id'] == $mid) {
            $data = $item;
            break;
        }
    }

    if(!empty($data)) {
        // Create new FPDI instance
        $pdf = new FPDI();
    
        // Add a page
        $pdf->AddPage();
    
        // Import the baptism.pdf as a template
        $pageCount = $pdf->setSourceFile('baptism.pdf');
        $tplIdx = $pdf->importPage(1);
        
        // Use the imported page as the template
        $pdf->useTemplate($tplIdx, 0, 0);
        
        // Add data to the PDF
        $pdf->SetFont('Times', '', 10);
        $pdf->SetXY(55, 72);
        $pdf->SetXY(58, $pdf->GetY() + 1); // Left align for 'name'
        $pdf->Cell(0, -23, "{$data['first_name']} {$data['middle_name']} {$data['last_name']}", 0, 1);
        $pdf->SetXY(56, $pdf->GetY() + 1); // Left align for 'dob'
            // Original date string
            $dateString = $data['dob'];
            // Create a DateTime object from the date string
            $date = new DateTime($dateString);
            // Format the date to your desired format (e.g., 'd-m-Y')
            $formattedDate = $date->format('F d, Y');
            // Use the formatted date in the PDF cell
        $pdf->Cell(0, 34, "{$formattedDate}", 0, 9);
        
        $pdf->SetXY(56, $pdf->GetY() + 1); // Left align for 'place_of_birth'
        $pdf->Cell(5, -22, "{$data['place_of_birth']}", 0, 1);
    
        // Father's Name and Address
        $pdf->SetXY(45, $pdf->GetY()); // Left align for 'father' name
        $pdf->Cell(0, 35, "{$data['father_name']}", 0, 1);
    
        $pdf->SetXY(130, $pdf->GetY() - 23); // Align 'father' address with name on the same Y line
        $pdf->Cell(0, 11, "{$data['father_address']}", 0, 1);
    
        // Mother's Name and Address
        $pdf->SetXY(48, $pdf->GetY()); // Left align for 'mother' name
        $pdf->Cell(0, 2, "{$data['mother_name']}", 0, 1);
    
        $pdf->SetXY(132, $pdf->GetY() - 6); // Align 'mother' address with name on the same Y line
        $pdf->Cell(0, 10, "{$data['mother_address']}", 0, 1);
    
        $pdf->SetXY(59, $pdf->GetY() + 2); 
        $pdf->Cell(0, 0, "{$data['address']}", 0, 1);
    
        $pdf->SetXY(80, $pdf->GetY() + 14); // Left align for 'baptism_date'
        // Original baptism date string
        $dateString = $data['baptism_date'];
        // Create a DateTime object from the date string
        $date = new DateTime($dateString);
        // Format the date to your desired format (e.g., 'F d, Y')
        $formattedDate = $date->format('F d, Y');
        // Use the formatted date in the PDF cell
        $pdf->Cell(0, -15, "{$formattedDate}", 0, 1);
    
        $pdf->SetXY(44, $pdf->GetY() + 1); 
        $pdf->Cell(0, 27, "{$data['priests']}", 0, 1);
    
       // Set starting Y position for the first sponsor name
$pdf->SetXY(50, $pdf->GetY() + 1);

// Track unique sponsors to avoid repetition
$unique_sponsor_names = [];
$sponsors_to_display = [];

// Loop through all sponsors and get only unique ones (up to 3)
foreach ($data['sponsors'] as $sponsor) {
    // Check if the sponsor's name is already in the unique list
    if (!in_array($sponsor['sponsor_name'], $unique_sponsor_names)) {
        // Add the sponsor's name to the unique names list
        $unique_sponsor_names[] = $sponsor['sponsor_name'];

        // Add the sponsor to the display list
        $sponsors_to_display[] = $sponsor;

        // Stop after collecting 3 unique sponsors
        if (count($sponsors_to_display) >= 3) {
            break;
        }
    }
}

    // Now display the unique sponsors
    foreach ($sponsors_to_display as $sponsor) {
        // Print sponsor name (left column)
        $pdf->SetXY(47, $pdf->GetY());   // Set X position for names
        $pdf->Cell(0, 5, "{$sponsor['sponsor_name']}", 0, 1);

        // Print sponsor address (right column)
        $pdf->SetXY(135, $pdf->GetY() - 5);  // Set X position for addresses
        $pdf->Cell(0, 5, "{$sponsor['sponsor_address']}", 0, 1);

        // Adjust Y position for the next line
        $pdf->SetXY(10, $pdf->GetY() + 2);  // Increment Y position for the next sponsor
    }


    // Set the timezone to your preferred timezone
date_default_timezone_set('Asia/Manila'); // Example: Set to Manila timezone

// Get today's date
$today = date("Y-m-d"); // Format: YYYY-MM-DD

// Slice the date into three parts
list($year, $month, $day) = explode("-", $today); // Splitting the date string
$monthName = date("F", strtotime($today)); // Get the full month name

$day = date('j'); // Use 'j' for day of the month without leading zeros

$daySuffix = 'th'; // Default suffix

// Check for the correct suffix based on the day
if ($day == 1 || $day == 21 || $day == 31) {
    $daySuffix = 'st';
} elseif ($day == 2 || $day == 22) {
    $daySuffix = 'nd';
} elseif ($day == 3 || $day == 23) {
    $daySuffix = 'rd';
}

// Format the day and add the suffix
$formattedDay = $day . $daySuffix; // e.g., "1st"

// Set a fixed position for book number (X = 50, Y = 100)
$pdf->SetXY(160, 139);
$pdf->Cell(0, 17, "{$formattedDay}", 0, 1);

// Set position for formatted day and month
$pdf->SetXY(29, 146); // Adjust Y position for the first cell
$pdf->Cell(0, 17, "{$monthName}", 0, 1); // Day and Month

$pdf->SetXY(85, 146); // Adjust Y position for the second cell
$pdf->Cell(0, 17, substr($year, -2), 0, 1); // Last two digits of Year



     // Set a fixed position for book number (X = 50, Y = 100)
     $pdf->SetXY(53, 158); 
     $pdf->Cell(0, 17, "{$data['purpose']}", 0, 1);

       // Set a fixed position for book number (X = 50, Y = 100)
        $pdf->SetXY(50, 209); 
        $pdf->Cell(0, 17, "{$data['book_no']}", 0, 1);

        // Set a fixed position for page number (X = 50, Y = 180)
        $pdf->SetXY(50, 219); 
        $pdf->Cell(0, 10, "{$data['page_no']}", 0, 1);

        // Set a fixed position for line number (X = 50, Y = 180)
        $pdf->SetXY(50, 226); 
        $pdf->Cell(0, 10, "{$data['line_no']}", 0, 1);
    


        
        // Clean (erase) the output buffer and turn off output buffering
        ob_end_clean();
        
        // Output the PDF directly to the browser
        $pdf->Output('certificate_baptism.pdf', 'I'); // 'I' option to send the file inline to the browser
        exit; // Exit after generating PDF
    }
     else {
        echo "No data found for mid: " . htmlspecialchars($mid);
    }
} else {
    echo "No mid parameter provided.";
}

// If "mid" is not set or data not found, redirect to index.php
echo "<script>window.location.href='view.php';</script>";
exit;
?>
