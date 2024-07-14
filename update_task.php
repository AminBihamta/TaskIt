<?php
session_start();
require_once ('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskID = $_POST['taskID'];
    $taskTitle = $_POST['taskTitle'];
    $dueDate = $_POST['dueDate'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $taskDescription = $_POST['taskDescription'];
    $categoryID = $_POST['categoryID'];

    $sql = "UPDATE task SET TaskTitle = ?, DueDate = ?, Priority = ?, Status = ?, TaskDescription = ?, CategoryID = ? WHERE TaskID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $taskTitle, $dueDate, $priority, $status, $taskDescription, $categoryID, $taskID);

    if ($stmt->execute()) {
        echo "Task updated successfully";
    } else {
        echo "Error updating task: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>