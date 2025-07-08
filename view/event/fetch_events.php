<?php
session_start();
if (empty($_SESSION["username"])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

require_once '../class/calendar.php';
$calendar = new Calendar();

$events = $calendar->getAllEvents();
header('Content-Type: application/json');
echo json_encode($events);
?>
