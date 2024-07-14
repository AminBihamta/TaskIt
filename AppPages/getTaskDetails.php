<?php
session_start();
require_once("../config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['$userEmail']) || !isset($_GET['taskId'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$taskId = intval($_GET['taskId']);
$userEmail = $_SESSION['$userEmail'];

$stmt = $conn->prepare("SELECT t.*, c.CategoryName FROM task t LEFT JOIN category c ON t.CategoryID = c.CategoryID WHERE t.TaskID = ? AND t.Email = ?");
$stmt->bind_param("is", $taskId, $userEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($task = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'task' => $task]);
} else {
    echo json_encode(['success' => false, 'message' => 'Task not found']);
}

$stmt->close();
$conn->close();