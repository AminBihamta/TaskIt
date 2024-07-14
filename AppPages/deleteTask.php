<?php
session_start();
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['taskId'];
    $userEmail = $_SESSION['$userEmail']; // Ensure this session variable is set correctly

    $sql = "DELETE FROM task WHERE TaskID = ? AND Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $taskId, $userEmail);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Task successfully updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made to the task']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating task: ']);
    }

    $stmt->close();
    $conn->close();
}
?>
