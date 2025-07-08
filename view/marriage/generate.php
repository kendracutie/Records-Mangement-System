<?php 
session_start();

if(empty($_SESSION["username"])){
    echo "<script>window.location.href='../../view/index.php';</script>";
    exit; // Make sure to exit after redirection
}

require_once('../../fpdf/fpdf.php');
require_once('../../fpdi/src/autoload.php');
require_once('../class/Marriage.php');

use setasign\Fpdi\Fpdi;

// Check if the "mid" parameter is set
if(isset($_GET['mid'])) {
    $mid = $_GET['mid'];

    // Fetch marriage data (including photo paths)
    $Marriage = new Marriage();
    $Marriage_arr = $Marriage->generate();

    // Find the specific record using $mid
    $data = null;
    foreach ($Marriage_arr as $item) {
        if ($item['marriage_id'] == $mid) {
            $data = $item;
            break;
        }
    }

    if(!empty($data)) {
        // Create new FPDI instance
        $pdf = new FPDI();

        // Add a page
        $pdf->AddPage();

        // Import the template (marriage.pdf)
        $pageCount = $pdf->setSourceFile('marriage.pdf');
        $tplIdx = $pdf->importPage(1);
        
        // Use the imported page as the template
        $pdf->useTemplate($tplIdx, 0, 0);
        
        // Add text data to the PDF (same as before)
        $pdf->SetFont('Times', '', 11);
        $pdf->SetXY(55, 74);

        $pdf->SetXY(65, $pdf->GetY() + 1);
        $dateString = $data['marriage_date'];
        $date = new DateTime($dateString);
        $formattedDate = $date->format('F d, Y');
        $pdf->Cell(0, 0, "{$formattedDate}", 0, 9);
        
        $pdf->Ln(9); 

        $pdf->SetX(65);  

        $parishAddress = "Tambo Adorable, Nueva Ecija";
        $pdf->Cell(0, 0, $parishAddress, 0, 9); 

        $pdf->SetXY(42, 163); 
        $pdf->Cell(0, 1, "{$data['groom_first_name']} {$data['groom_middle_name']} {$data['groom_last_name']}", 0, 1);

        $pdf->SetXY(42, 169);
        $pdf->Cell(0, 1, "{$data['groom_age']}", 0, 1);

        $pdf->SetXY(48, 175);
        $pdf->Cell(0, 1, "{$data['groom_address']}", 0, 1);

        $pdf->SetXY(43, 181); 
        $pdf->Cell(0, 1, "{$data['groom_father_name']}", 0, 1);

        $pdf->SetXY(44, 188); 
        $pdf->Cell(0, 1, "{$data['groom_mother_name']}", 0, 1);

        $pdf->SetXY(123, 162); 
        $pdf->Cell(0, 1, "{$data['bride_first_name']} {$data['bride_middle_name']} {$data['bride_last_name']}", 0, 1);

        $pdf->SetXY(123, 169);
        $pdf->Cell(0, 1, "{$data['bride_age']}", 0, 1);

        $pdf->SetXY(130, 175);
        $pdf->Cell(0, 1, "{$data['bride_address']}", 0, 1);

        $pdf->SetXY(126, 182); 
        $pdf->Cell(0, 1, "{$data['bride_father_name']}", 0, 1);

        $pdf->SetXY(126, 188); 
        $pdf->Cell(0, 1, "{$data['bride_mother_name']}", 0, 1);

        // Check if a photo exists in the database and insert it
        if (!empty($data['groom_photo'])) {
            // Assuming $data['groom_photo'] contains the file path
            $photoPath = 'uploads/' . $data['groom_photo']; // Adjust path as needed

            if (file_exists($photoPath)) {
                // Set image position and size (e.g., x = 150, y = 50, width = 30, height = 30)
                $pdf->Image($photoPath, 43, 100, 45, 45); // 2x2 inch photo (144x144 points)

            }
        }

        if (!empty($data['bride_photo'])) {
            // Assuming $data['bride_photo'] contains the file path
            $photoPath = 'uploads/' . $data['bride_photo']; // Adjust path as needed

            if (file_exists($photoPath)) {
                // Set image position and size (e.g., x = 120, y = 50, width = 30, height = 30)
                $pdf->Image($photoPath, 124, 100, 45, 45); // Adjust position and size as needed
            }
        }

        // Clean (erase) the output buffer and turn off output buffering
        ob_end_clean();
        
        // Output the PDF directly to the browser
        $pdf->Output('certificate_marriage.pdf', 'I'); 
        exit;

    } else {
        echo "No data found for mid: " . htmlspecialchars($mid);
    }
} else {
    echo "No mid parameter provided.";
}

echo "<script>window.location.href='view.php';</script>";
exit;
?>
