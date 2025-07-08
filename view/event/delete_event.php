<?php
session_start();

if (empty($_SESSION["username"])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

require_once '../../includes/connect.php'; // Assuming this is where the database connection is handled
$conn = new Conn();
$cn = $conn->connect(1);

// Get event ID from the POST request
$eventId = isset($_POST['eventId']) ? $_POST['eventId'] : '';

// Debugging: Check if the event ID is received properly
if (empty($eventId)) {
    echo json_encode(['success' => false, 'message' => 'Event ID is missing']);
    exit;
}

// Sanitize event ID
$eventId = intval($eventId); // Ensure eventId is an integer

// Prepare the SQL statement to delete the event
$sql = "DELETE FROM calendar WHERE id = ?";
$stmt = $cn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $eventId); // 'i' for integer

    if ($stmt->execute()) {
        $stmt->close();
        echo json_encode(['success' => true, 'message' => 'Event deleted successfully']);
    } else {
        error_log("Error executing query: " . $stmt->error); // Log execution error
        $stmt->close();
        echo json_encode(['success' => false, 'message' => 'Failed to delete event']);
    }
} else {
    error_log("Error preparing statement: " . $cn->error); // Log preparation error
    echo json_encode(['success' => false, 'message' => 'Failed to prepare the statement']);
}
?>
