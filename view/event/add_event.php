<?php
require_once '../class/calendar.php';
$calendar = new Calendar();

$eventName = isset($_POST['eventName']) ? trim($_POST['eventName']) : '';
$eventDate = isset($_POST['eventDate']) ? trim($_POST['eventDate']) : '';

if (empty($eventName) || empty($eventDate)) {
    echo json_encode(['success' => false, 'message' => 'Event name or date is missing']);
    exit;
}

if ($calendar->addEvent($eventDate, $eventName)) {
    echo json_encode(['success' => true, 'message' => 'Event added successfully']);
} else {
    $error = error_get_last(); // Fetch the last error
    echo json_encode(['success' => false, 'message' => 'Failed to add event', 'error' => $error]);
}

?>



