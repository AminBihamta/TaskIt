<?php
session_start();
require_once ('../config.php');

// Check if user is logged in
if (!isset($_SESSION['$userEmail'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$taskId = $_POST['taskId'] ?? '';
$newStatus = $_POST['newStatus'] ?? '';

if (empty($taskId) || empty($newStatus)) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

// Prepare and execute the update query
$stmt = $conn->prepare("UPDATE task SET Status = ? WHERE TaskID = ? AND Email = ?");
$stmt->bind_param("sis", $newStatus, $taskId, $_SESSION['$userEmail']);
$result = $stmt->execute();

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database update failed']);
}


$stmt->close();
$conn->close();