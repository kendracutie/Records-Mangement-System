<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_document']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $uploadDir = '../view/certificates/uploads/';
    $fileName = basename($_FILES['new_document']['name']);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['new_document']['tmp_name'], $filePath)) {
        // Update the document path and status in the database
        $stmt = $conn->prepare("UPDATE certificate_requests SET supporting_document = ?, status = 'pending' WHERE request_id = ?");
        $stmt->bind_param("si", $fileName, $request_id);

        if ($stmt->execute()) {
            echo "Document updated and status set to pending.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
