<?php
session_start();
require_once('../config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['$userEmail']) || !isset($_POST['taskId'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit();
    }

    $taskId = intval($_POST['taskId']);
    $userEmail = $_SESSION['$userEmail'];

    // First, check if the task exists and belongs to the user
    $checkSql = "SELECT COUNT(*) FROM task WHERE TaskID = ? AND Email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("is", $taskId, $userEmail);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count === 0) {
        echo json_encode(['success' => false, 'message' => 'No task found with ID: ' . $taskId . ' for this user']);
        exit();
    }

    // If the task exists and belongs to the user, proceed with deletion
    $sql = "DELETE FROM task WHERE TaskID = ? AND Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $taskId, $userEmail);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Task successfully deleted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the task']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting task: ' . $conn->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>