<?php

date_default_timezone_set('Asia/Manila');
require "connection.php";

try {
    // Prepare and execute the query to fetch approved, public prayer requests
    $stmt = $conn->prepare("SELECT * FROM prayer_req WHERE status = 'approved' AND kind = 'public'");
    $stmt->execute();
    $result = $stmt->get_result();

    // Display each approved, public prayer request with formatted time
    while ($row = $result->fetch_assoc()) {
        echo "<div class='message-card'>";
        echo "<strong>" . htmlspecialchars($row['Name']) . ":</strong> ";
        echo htmlspecialchars($row['prayer_rq']) . " <em>(" . htmlspecialchars($row['prayerType']) . ")</em>";

        // Format and display the submission time
        $time = new DateTime($row['time']);
        echo "<small> at " . $time->format('g:i a') . "</small><br>";

        echo "</div>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    echo "Error displaying prayer requests: " . $e->getMessage();
}

?>
