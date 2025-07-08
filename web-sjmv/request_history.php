<?php
session_start();
$isLoggedIn = isset($_SESSION['username']) ? 'true' : 'false';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request History</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/cert_req.css">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
    
      
        <nav class="mainmenu mobile-menu">
            <ul>
                <li ><a href="./index.php">Home</a></li>
                <li><a href="#">About</a>
                    <ul class="dropdown">
                        <li><a href="mv.php">Mission/Vision</a></li>
                        <li><a href="history.php">Parish History</a></li>
                        <li><a href="image.php">St.John Marie Vianney Image</a></li>
                        <li><a href="priest.php">Parish Priest</a></li>
                        <li><a href="event.php">Event Calendar</a></li>
                        <li><a href="FAQ.php">FAQ</a></li>
                
            </ul>
            <li><a href="#">Parish</a>
                <ul class="dropdown">
                    <li><a href="sacraments.php">Sacraments</a></li>
                    <li><a href="pb.php">Pastoral Board</a></li>
                    <li><a href="pt.php">Pastoral Team</a></li>
                    <li><a href="os.php">Office & Staff</a></li>
                </ul>
            </li>
            <li><a href="#">Devotion</a>
                <ul class="dropdown">
                    <li><a href="sjmv.php">St. John Marie Vianney</a></li>
                    <li><a href="nov.php">The Novena</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="hw.php">Holy Week in SJMV</a></li>
                </ul>
            </li>
            <li><a href="donate.php">Donate</a></li>
            <li><a href=".prayer.php">Prayer Request</a></li>
            <li class="active"><a href="./contact.php">Contact</a></li>
        </nav>

        <div id="mobile-menu-wrap"></div>
        <div class="top-social">
            <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
            <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
            <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
            <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
        </div>

        <ul class="top-widget">
            <li><i class="fa fa-phone"></i> 
                0915 554 2330</li>
            <li><i class="fa fa-envelope"></i> stjohnmarievianneyparish@gmail.com</li>
        </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="logo">
                    <a href="index.php">
                        <img src="logo.jpg" alt="Logo">
                    </a>
                </div>
            </div>
  
        <div class="menu-item">
            <div class="container">
                <div class="row">
                   
                    <div class="col-lg-12">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li><a href="./index.php">Home</a></li>
                                    <li><a href="#">About</a>
                                        <ul class="dropdown">
                                            <li><a href="mv.php">Mission/Vision</a></li>
                                            <li><a href="history.php">Parish History</a></li>
                                            <li><a href="image.php">St.John Marie Vianney Image</a></li>
                                            <li><a href="priest.php">Parish Priest</a></li>
                                            <li><a href="event.php">Event Calendar</a></li>
                                            <li><a href="FAQ.php">FAQ</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="#">Parish</a>
                                        <ul class="dropdown">
                                            <li><a href="sacraments.php">Sacraments</a></li>
                                            <li><a href="pb.php">Pastoral Board</a></li>
                                            <li><a href="pt.php">Pastoral Team</a></li>
                                            <li><a href="os.php">Office & Staff</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Devotion</a>
                                        <ul class="dropdown">
                                            <li><a href="sjmv.php">St. John Marie Vianney</a></li>
                                            <li><a href="nov.php">The Novena</a></li>
                                            <li><a href="gallery.php">Gallery</a></li>
                                            <li><a href="hw.php">Holy Week in SJMV</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./prayer.php">Prayer Request</a></li>
                                    <li><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li><a href="./contact.php">Contact</a></li>

                                </ul>
                                <div class="top-social">
                                    <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                    <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                                 </div>
                                 <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle navbar-text" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                                            <i class="fas fa-user-circle icon-spacing"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                            
                                            <!-- Link to edit personal information -->
                                            <a class="dropdown-item item" href="edit_personal_info.php">
                                                <i class="fas fa-user-edit"></i> Edit Personal Information
                                            </a>

                                            <!-- Link to change password -->
                                            <a class="dropdown-item item" href="change_password.php">
                                                <i class="fas fa-key"></i> Change Password
                                            </a>

                                            <!-- Link to certificate request history -->
                                            <a class="dropdown-item item" href="request_history.php">
                                                <i class="fas fa-history"></i> Certificate Request History
                                            </a>

                                            <!-- Logout button with confirmation -->
                                            <a href='../web-sjmv/logout.php' onclick='confirm_logout(event, this.href)' title='Logout' class='dropdown-item item'>
                                                <i class='fas fa-sign-out-alt'></i> Logout
                                            </a>
                                        </div>

                                        </div>
                                    <?php } ?>
                            </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <style>
.dropdown {
    position: absolute;
    top: 23px;
    right: -120px;
}

.icon-spacing {
    margin-right: 5px; /* Adjust the value as needed */
}

.dropdown-menu {
    margin-top: 16px;
    min-width: 240px; /* Set a minimum width for the dropdown */
    height: 240px; /* Fixed height for the dropdown */
    border-radius: 0.5rem; /* Rounded corners */
    margin-right: -20px;
}

.navbar-text {
    display: flex; /* Use flex for better alignment */
    align-items: center; /* Center align items */
}

.dropdown-item.item {
    color: maroon; /* Set the logout link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
    padding: 15px; /* Add padding for better spacing */
}

/* Normal state */
.item {
    color: maroon; /* Set the link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
}

/* Hover state */
.item:hover {
    color: #800000; /* Darker shade of maroon on hover (optional) */
}

/* Active and focus state */
.item:active, .item:focus {
    color: maroon; /* Keep maroon color when clicked or focused */
    outline: none; /* Remove the default outline (focus state) */
    text-decoration: none;
    background-color: transparent; /* Ensure no background color change */
}
</style>
<style>
    /* Default btn-info btn-sm style */
    .btn-info.btn-sm {
        background-color: burlywood !important; /* Set background color */
        color: white !important;              /* Set text color */
        border-color: burlywood !important;   /* Optional: match border color */
    }

    /* Hover effect for btn-info btn-sm */
    .btn-info.btn-sm:hover {
        background-color: #deb887 !important; /* Darker shade of burlywood for hover */
        color: white !important;              /* Keep text white */
        border-color: #deb887 !important;     /* Optional: match border color */
    }
</style>


    <!-- Header End -->
    <div class="container mt-5">
        <!-- Page Header -->
        <h2 class="text mb-4">Certificate Request History</h2>
        
        <!-- PHP Code to Fetch and Display Certificate Requests -->
        <?php
require_once 'connection.php'; // Include your database connection file

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decrypt data function
function decryptData($encryptedData, $cipher_algo, $key) {
    $decoded = base64_decode($encryptedData);
    $iv_length = openssl_cipher_iv_length($cipher_algo);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);
    
    // Suppress warnings by using the @ operator
    $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
    
    // Optionally check if decryption failed
    if ($decrypted === false) {
        // Log error or handle failure
        error_log("Decryption failed for data: " . $encryptedData);
        return null; // Handle decryption failure appropriately
    }
    
    return $decrypted;
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session

    // Get the current page from URL, default to 1
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Number of records per page
    $offset = ($currentPage - 1) * $limit; // Calculate offset for SQL query

    // Count total certificate requests
    $countSql = "SELECT COUNT(*) as total FROM certificate_requests WHERE user_id = ?";
    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param("i", $userId);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalRequests = $countResult->fetch_assoc()['total'];
    $countStmt->close();

    // SQL query to fetch the latest 10 requests and all records for pagination
    $sql = "SELECT 
        cr.request_id,
        cr.request_date, 
        p.first_name AS person_first_name, 
        p.middle_name AS person_middle_name, 
        p.last_name AS person_last_name, 
        cr.certificate_type, 
        cr.request_purpose, 
        cr.status, 
        cr.supporting_document 
    FROM 
        certificate_requests cr
    JOIN 
        person p ON cr.person_id = p.person_id
    WHERE 
        cr.user_id = ?
    ORDER BY 
        cr.request_date DESC
    LIMIT ? OFFSET ?"; // Pagination with LIMIT and OFFSET

    $stmt = $conn->prepare($sql);
    if ($stmt) { // Check if statement preparation was successful
        $stmt->bind_param("iii", $userId, $limit, $offset); // Bind the user ID, limit, and offset to the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are results and display them
        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover custom-table">';
            echo '<thead class="thead" style="background-color:#793232; color: white;">
                    <tr>
                        <th>Date Requested</th>
                        <th>Person Name</th>
                        <th>Certificate Type</th>
                        <th>Request Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>';
            echo '<tbody>';

            // Fetch each row and create a table row
            while ($row = $result->fetch_assoc()) {
                $formattedDate = date('F j, Y', strtotime($row['request_date']));
                $documentUrl = '../view/certificates/uploads/' . htmlspecialchars($row['supporting_document']); // Adjust path as needed

                // Encryption setup
                $cipher_algo = 'AES-256-CBC';
                $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
                $iv_length = openssl_cipher_iv_length($cipher_algo);

                // Decrypt person names
                $decryptedFirstName = decryptData($row['person_first_name'], $cipher_algo, $key);
                $decryptedMiddleName = decryptData($row['person_middle_name'], $cipher_algo, $key);
                $decryptedLastName = decryptData($row['person_last_name'], $cipher_algo, $key);
                
                // Decrypt certificate type
                $decryptedCertificateType = decryptData($row['certificate_type'], $cipher_algo, $key);

                // Check for decryption failure for person names
                if ($decryptedFirstName === null || $decryptedLastName === null) {
                    $fullName = "Decryption failed";
                } else {
                    $fullName = htmlspecialchars(trim($decryptedFirstName . ' ' . $decryptedMiddleName . ' ' . $decryptedLastName));
                }

                // Check for decryption failure for certificate type
                $displayCertificateType = $decryptedCertificateType !== null 
                    ? htmlspecialchars($decryptedCertificateType) 
                    : "Decryption failed";

                // Conditionally render "Edit" or "View" button based on status
                $actionButton = $row['status'] === 'declined' 
                    ? '<button class="btn btn-warning btn-sm" onclick="editSupportingDocument(\'' . htmlspecialchars($documentUrl) . '\', ' . $row['request_id'] . ')">Edit</button>'
                    : '<button class="btn btn-info btn-sm" onclick="viewSupportingDocument(\'' . htmlspecialchars($documentUrl) . '\')">View</button>';

                echo '<tr>
                        <td>' . htmlspecialchars($formattedDate) . '</td>
                        <td>' . $fullName . '</td>
                        <td>' . $displayCertificateType . '</td>
                        <td>' . htmlspecialchars($row['request_purpose']) . '</td>
                        <td style="background-color: ' . 
                            ($row['status'] === 'declined' ? '#f8d7da' : ($row['status'] === 'approved' ? '#d4edda' : '')) . 
                            ';">' . htmlspecialchars($row['status']) . '</td>
                        <td>' . $actionButton . '</td>
                    </tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            // Pagination logic
            $totalPages = ceil($totalRequests / $limit); // Calculate total pages
            echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';

for ($page = 1; $page <= $totalPages; $page++) {
    $activeClass = ($page === $currentPage) ? ' active' : '';
    echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>'; // Maroon for pagination links
}

echo '</ul>';
echo '</nav>';
        } else {
            echo "<p>No certificate requests found.</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "<p>User not logged in.</p>";
}

// Close the connection
$conn->close();
?>

<style>
    .custom-table {
        border: 1.5px solid gray;
        border-collapse: collapse;
    }
    .custom-table th, .custom-table td {
        border: 1px solid gray; /* Adds border to each cell */
    }

    .pagination {
        color: #800000; /* Maroon for the pagination container */
    }

    .pagination .page-link {
        color: #800000; /* Maroon for links */
    }

    .pagination .page-item.active .page-link {
        background-color: #800000; /* Maroon for active page */
        color: white; /* White text for active page number */
    }

    .pagination .page-link:hover {
        color: #A52A2A; /* Darker maroon on hover */
    }
</style>


    </div>

    </section>
    <!-- Request History Section End -->
        <br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br>
    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logoo">
                                <a href="#">
                                    <img src="logo.jpg" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach thousands of Parishioner<br /> in San Leonardo</p>
                            <div class="fa-social">
                                <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a>
                                <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6 style="color: white;">Contact Us</h6>
                            <ul>
                                <li>0915 554 2330</li>
                                <li>stjohnmarievianneyparish@gmail.com</li>
                                <li>Tambo Adorable, San Leonardo Nueva Ecija</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6 style="color: white;">New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

<!-- Edit Supporting Document Modal -->
<div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size to large -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDocumentModalLabel">Edit Supporting Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Current Document: <a id="currentDocumentLink" href="#" target="_blank"></a></p>
                <div id="currentDocumentPreview" style="margin-bottom: 30px;"></div>
                <form id="editDocumentForm" method="post" enctype="multipart/form-data" action="edit_supporting_document.php">
                    <input type="hidden" id="documentUrlField" name="documentUrl">
                    <input type="hidden" id="requestIdField" name="request_id" value="">
                    <div class="mb-3">
                        <label for="new_document" class="form-label">Choose a new document to upload:</label>
                        <input type="file" class="form-control" id="new_document" name="new_document" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Upload New Document</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
    .btn {
        background-color: burlywood;
    }
</style>

<!-- View Supporting Document Modal -->
<div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDocumentModalLabel">View Supporting Document</h5>
            </div>
            <div class="modal-body">
                <!-- Document preview -->
                <div id="documentPreview" class="text-center mb-4">
                    <!-- Placeholder for document preview (image or link) -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editSupportingDocument(documentUrl, requestId) {
    // Set the href of the link to the current document URL
    document.getElementById("currentDocumentLink").href = documentUrl;

    // Set the document URL to the hidden input field
    document.getElementById("documentUrlField").value = documentUrl;

    // Set the request ID in the hidden input field
    document.getElementById("requestIdField").value = requestId;

    // Update the current document preview based on file type
    var extension = documentUrl.split('.').pop().toLowerCase();
    var preview = document.getElementById("currentDocumentPreview");

    if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
        // If it's an image, show the image preview
        preview.innerHTML = '<img src="' + documentUrl + '" alt="Current Supporting Document" class="supporting-doc-img" style="max-width: 100%; height: auto;">';
    } else {
        // Otherwise, show a link to the document
        preview.innerHTML = '<a href="' + documentUrl + '" target="_blank">View Current Document</a>';
    }

    // Show the modal
    var myModal = new bootstrap.Modal(document.getElementById('editDocumentModal'));
    myModal.show();
}

</script>

<script>
    function viewSupportingDocument(url) {
        const documentPreview = document.getElementById("documentPreview");
        
        // Determine file extension to check if it's an image
        const extension = url.split('.').pop().toLowerCase();
        
        if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            // Display image in the modal with max dimensions
            documentPreview.innerHTML = `
                <img src="${url}" alt="Supporting Document" 
                     class="img-fluid" 
                     style="width: 300px; max-height: 300px; object-fit: contain;">
            `;
        } else {
            // Display link to view document in a new tab
            documentPreview.innerHTML = `<p>Document: <a href="${url}" target="_blank">Open Document in New Tab</a></p>`;
        }

        // Show the modal
        const viewDocumentModal = new bootstrap.Modal(document.getElementById('viewDocumentModal'));
        viewDocumentModal.show();
    }
</script>

<style>
#currentDocumentPreview {
    text-align: center; /* Center the image within the preview area */
}

#currentDocumentPreview img {
    max-width: 60%;  /* Responsive image but allows some margin on sides */
    height: auto;     /* Maintain aspect ratio */
    max-height: 300px; /* Increased maximum height for better visibility */
    border: 1px solid #ccc; /* Border for visibility */
    border-radius: 4px;    /* Rounded corners */
}

#currentDocumentPreview a {
    display: inline-block; /* Make the link look like a button */
    padding: 10px 15px;
    background-color: #f0f0f0; /* Light background */
    border-radius: 4px; /* Rounded corners */
    text-decoration: none; /* No underline */
    color: #007bff; /* Bootstrap primary color */
    transition: background-color 0.3s;
}

#currentDocumentPreview a:hover {
    background-color: #e2e2e2; /* Change background on hover */
}
</style>

</section>

<!-- JavaScript for handling modal display and submission -->


     <!-- SweetAlert2 JS -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- Js Plugins -->
     <script src="js/jquery-3.3.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/jquery.nice-select.min.js"></script>
     <script src="js/jquery-ui.min.js"></script>
     <script src="js/jquery.slicknav.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/main.js"></script>
    
     <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM fully loaded and parsed");

        // Get the login status passed from PHP
        const isLoggedIn = <?php echo $isLoggedIn; ?>; // Pass the boolean directly

        const requestCertLink = document.getElementById("reqCertificate");

        if (requestCertLink) {
            requestCertLink.addEventListener("click", function(e) {
                e.preventDefault();
                console.log("Request Certificate clicked");

                // Check if the user is logged in
                if (isLoggedIn) {
                    // If logged in, redirect to the certificate request page
                    window.location.href = "certificate_req.php";
                } else {
                    // Show SweetAlert if not logged in
                    Swal.fire({
                        title: 'Login Required',
                        text: 'To request a certificate, you must log in or sign up first.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Login / Sign Up',
                        cancelButtonText: 'Cancel',
                        backdrop: 'rgba(0, 0, 0, 0.6)',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../view/index.php"; // Change this to your login/signup URL
                        }
                    });
                }
            });
        } else {
            console.error("Element with ID 'reqCertificate' not found");
        }
    });
</script>

 <!-- Bootstrap JavaScript -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

 <!-- Logout confirmation logic using SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirm_logout(event, url) {
    event.preventDefault(); // Prevent the default link action

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        background: '#fffef0', // Light cream background
        confirmButtonColor: 'burlywood', // Burlywood color for the confirm button
        cancelButtonColor: '#793232', // Maroon color for the cancel button
        confirmButtonText: 'Yes, log out!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Redirect to the logout page if confirmed
        }
    });
}
</script>

</body>

</html>