<?php 
session_start();

if(empty($_SESSION["username"])){
    echo "<script>window.location.href='../../view/index.php';</script>";
    exit; // Make sure to exit after redirection
}

require_once('../../fpdf/fpdf.php');
require_once('../../fpdi/src/autoload.php');
require_once('../class/Confirmation.php');

use setasign\Fpdi\Fpdi;

// Check if the "mid" parameter is set
if(isset($_GET['mid'])) {
    $mid = $_GET['mid'];

    // Fetch Confirmation data
    $Confirmation = new Confirmation();
    $Confirmation_arr = $Confirmation->generate();

    // Find the specific record using $mid
    $data = null;
    foreach ($Confirmation_arr as $item) {
        if ($item['confirmation_id'] == $mid) {
            $data = $item;
            break;
        }
    }

    if(!empty($data)) {
        // Create new FPDI instance
        $pdf = new FPDI();
    
        // Add a page
        $pdf->AddPage();
    
        // Import the Confirmation.pdf as a template
        $pageCount = $pdf->setSourceFile('confirmation.pdf');
        $tplIdx = $pdf->importPage(1);
        
        // Use the imported page as the template
        $pdf->useTemplate($tplIdx, 0, 0);
        
        // Add data to the PDF
        $pdf->SetFont('Times', '', 11);
        $pdf->SetXY(55, 72);
        $pdf->SetXY(56, $pdf->GetY() + 1); // Left align for 'name'
        $pdf->Cell(0, 5, "{$data['first_name']} {$data['middle_name']} {$data['last_name']}", 0, 1);
        
        $pdf->SetXY(57, $pdf->GetY() + 1); // Left align for 'age'
        $pdf->Cell(0, 6, "{$data['age']}", 0, 1);
    
        // Father's Name
        $pdf->SetXY(60, $pdf->GetY()); // Left align for 'father' name
        $pdf->Cell(0, 7, "{$data['father_name']}", 0, 1);;
    
        // Mother's Name and Address
        $pdf->SetXY(60, $pdf->GetY()); // Left align for 'mother' name
        $pdf->Cell(0, 6, "{$data['mother_name']}", 0, 1);
    
        $pdf->SetXY(70, $pdf->GetY() + 1); 
        $pdf->Cell(0, 3, "{$data['place_of_baptism']}", 0, 1);
    
        $pdf->SetXY(59, $pdf->GetY() + 10); // Left align for 'Confirmation_date'
        // Original Confirmation date string
        $dateString = $data['confirmation_date'];
        // Create a DateTime object from the date string
        $date = new DateTime($dateString);
        // Format the date to your desired format (e.g., 'F d, Y')
        $formattedDate = $date->format('F d, Y');
        // Use the formatted date in the PDF cell
        $pdf->Cell(0, 17, "{$formattedDate}", 0, 1);
    
        $pdf->SetXY(120, $pdf->GetY() + 1); 
        $pdf->Cell(0, -19, "{$data['priests']}", 0, 1);
    
        // Sponsors' Names and Addresses
        $pdf->SetXY(50, $pdf->GetY() + 1);  // Set starting Y position for the first sponsor name

        // Limit the number of sponsors to display
        $sponsors_to_display = array_slice($data['sponsors'], 0, 1);

        foreach ($sponsors_to_display as $sponsor) {
            // Print sponsor name (left column)
            $pdf->SetXY(65, $pdf->GetY());   // Set X position for names
            $pdf->Cell(0, 30, "{$sponsor['sponsor_name']}", 0, 1);

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
    $pdf->SetXY(172, 132);
    $pdf->Cell(0, 17, "{$formattedDay}", 0, 1);

    // Set position for formatted day and month
    $pdf->SetXY(44, 138); // Adjust Y position for the first cell
    $pdf->Cell(0, 17, "{$monthName}", 0, 1); // Day and Month

    $pdf->SetXY(105, 138); // Adjust Y position for the second cell
    $pdf->Cell(0, 17, substr($year, -2), 0, 1); // Last two digits of Year


     // Set a fixed position for book number (X = 50, Y = 100)
     $pdf->SetXY(53, 157); 
     $pdf->Cell(0, 17, "{$data['purpose']}", 0, 1);

       // Set a fixed position for book number (X = 50, Y = 100)
        $pdf->SetXY(50, 201); 
        $pdf->Cell(0, 17, "{$data['book_no']}", 0, 1);

        // Set a fixed position for page number (X = 50, Y = 180)
        $pdf->SetXY(50, 211); 
        $pdf->Cell(0, 10, "{$data['page_no']}", 0, 1);

        // Set a fixed position for line number (X = 50, Y = 180)
        $pdf->SetXY(50, 218); 
        $pdf->Cell(0, 10, "{$data['line_no']}", 0, 1);
    
        // Clean (erase) the output buffer and turn off output buffering
        ob_end_clean();
        
        // Output the PDF directly to the browser
        $pdf->Output('certificate_confirmation.pdf', 'I'); // 'I' option to send the file inline to the browser
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
