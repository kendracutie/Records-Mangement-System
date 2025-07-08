<?php
session_start();

if (empty($_SESSION["username"])) {
    echo json_encode(['success' => false, 'message' => 'User  not logged in']);
    exit;
}

require_once '../../includes/connect.php'; // Assuming this is where the database connection is handled
require_once '../class/calendar.php'; // Include the Calendar class for encryption
$conn = new Conn();
$cn = $conn->connect(1);

// Create an instance of the Calendar class
$calendar = new Calendar();

// Get event data from the POST request
$eventId = isset($_POST['eventId']) ? $_POST['eventId'] : '';
$eventName = isset($_POST['eventName']) ? $_POST['eventName'] : '';

// Check if required fields are provided
if (empty($eventId) || empty($eventName)) {
    echo json_encode(['success' => false, 'message' => 'Event ID or name is missing']);
    exit;
}

// Sanitize inputs
$eventId = intval($eventId); // Ensure eventId is an integer
$eventName = $cn->real_escape_string($eventName); // Sanitize the event name

// Call the updateEvent method from the Calendar class
if ($calendar->updateEvent($eventId, $eventName)) {
    echo json_encode(['success' => true, 'message' => 'Event updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update event or no event found with the given ID']);
}
?>