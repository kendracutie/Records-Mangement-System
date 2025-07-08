<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Your code that uses $username
} 
?>
<?php
// Function to check if the user is on a mobile device
function isMobile() {
    return preg_match('/Mobile|Android|iPhone|iPad|iPod|Opera Mini|IEMobile|WPDesktop/', $_SERVER['HTTP_USER_AGENT']);
}

// If the user is not on a mobile device, redirect them to a different page
if (!isMobile()) {
    header('Location: ../dashboard/index.php'); // Redirect to dashboard or another page
    exit();
}

require_once '../class/prayer_req.php';
$prayer_req = new prayer_req();

require_once '../class/certificate_req.php';
require_once "../header.php"; 

$certificate_req = new certificate_req();

// Initialize the counter for pending requests
$pendingCount = 0;

// Fetch both prayer and certificate requests
$Prayer = $prayer_req->getAll();
$Certificate = $certificate_req->getAll();

// Loop through the prayer requests to count pending requests
foreach ($Prayer as $value) {
    if ($value['status'] == 'pending') {
        $pendingCount++;
    }
}

// Loop through the certificate requests to count pending requests
foreach ($Certificate as $value) {
    if ($value['status'] == 'pending') {
        $pendingCount++;
    }
}
?>
<style>
/* Hide notifications link on desktop view */
@media (min-width: 769px) {
    .mobile-only {
        display: none; /* Hide on screens larger than 768px */
    }
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .notification-list {
            max-height: 600px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            padding: 9px;
            border-bottom: 2px solid #dee2e6;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .time-ago {
            color: gray;
            font-size: 0.85em;
        }
        .notification-item {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .notification-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Notifications</h1>
    <div class="notification-list">
        <ul class="list-group">
            <?php
            date_default_timezone_set('Asia/Manila');

            // Fetch prayer requests
            $Prayer = $prayer_req->getAll();
            $pendingRequests = array_filter($Prayer, function($value) {
                return isset($value['status']) && $value['status'] == 'pending';
            });

            // Fetch certificate requests
            $Certificate = $certificate_req->getAll();
            $pendingCertificateRequests = array_filter($Certificate, function($value) {
                return isset($value['status']) && $value['status'] == 'pending';
            });

            // Combine prayer and certificate requests
            $allPendingRequests = array_merge($pendingRequests, $pendingCertificateRequests);

            // Prepare to sort requests by time
            $sortedRequests = [];
            foreach ($allPendingRequests as $value) {
                if (isset($value['prayer_id'])) {
                    // Prayer request
                    if (isset($value['time']) && strtotime($value ['time']) !== false) {
                        $requestTime = new DateTime($value['time']);
                        $value['request_time'] = $requestTime; // Add a request_time field for sorting
                    }
                } elseif (isset($value['request_id'])) {
                    // Certificate request
                    if (isset($value['request_date']) && strtotime($value['request_date']) !== false) {
                        $requestTime = new DateTime($value['request_date']);
                        $value['request_time'] = $requestTime; // Add a request_time field for sorting
                    }
                }

                // Only add to sortedRequests if request_time is set
                if (isset($value['request_time'])) {
                    $sortedRequests[] = $value;
                }
            }

            // Sort requests by request_time in descending order
            usort($sortedRequests, function($a, $b) {
                return $b['request_time'] <=> $a['request_time'];
            });

            // Check if there are any pending requests
            if (empty($sortedRequests)) {
                echo "<li class='list-group-item text-center'>No requests</li>";
            } else {
                foreach ($sortedRequests as $value) {
                    // Initialize timeAgo variable
                    $timeAgo = 'Unknown time';

                    // Calculate time difference based on request_time
                    if (isset($value['request_time'])) {
                        $now = new DateTime(); // Get current time
                        $interval = $now->diff($value['request_time']);

                        // If the difference is less than a minute, show 'just now'
                        if ($interval->y > 0) {
                            $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->m > 0) {
                            $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->d > 0) {
                            $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->h > 0) {
                            $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->i > 0) {
                            $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                        } else {
                            $timeAgo = 'just now'; // Catch-all for very recent times
                        }
                    }

                    // Generate notification type and message
                    if (isset($value['prayer_id'])) {
                        // Prayer request notification
                        echo "<li class='list-group-item d-flex justify-content-between'>
                            <a href='../prayer_req/' class='notification-item' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                                <b>" . htmlspecialchars($value['Name']) . "</b> <span style='color: gray;'> requested a prayer</span><br>
                                <span style='color: gray;'>" . htmlspecialchars($value['prayerType']) . "</span>
                            </a>
                            <small class='time-ago' style='color: gray;'>$timeAgo</small>
                        </li>";
                    } elseif (isset($value['request_id'])) {
                        // Certificate request notification
                        echo "<li class='list-group-item d-flex justify-content-between'>
                            <a href='../certificates/' class='notification-item' style='text-decoration: none; color: inherit; flex-grow: 1;'>
                                <b>" . htmlspecialchars($value['requester_first_name']) . "</b> 
                                <span style='color: gray;'> requested a " . htmlspecialchars($value['certificate_type']) . " certificate</span><br>
                            </a>
                            <small class='time-ago' style='color: gray;'>$timeAgo</small>
                        </li>";
                    }
                }
            }
            ?>
        </ul>
    </div>
</div>

<script>
    // Store the previous page URL
    var previousPage = document.referrer;

    // Check if the user is on mobile
    if (window.innerWidth > 768) {
        window.location.href = previousPage; // Redirect to previous page
    }

    // Add event listener for resize event
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            window.location.href = previousPage; // Redirect to previous page
        }
    });
</script>

</body>
</html>