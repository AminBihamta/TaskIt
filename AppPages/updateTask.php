<?php
session_start();
require_once('../config.php'); // Assuming config.php contains the database connection

header('Content-Type: application/json');

try{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming 'userEmail' is the correct session variable name
        $userEmail = $_SESSION['$userEmail'];
        $title = $_POST['updateTaskTitle'];
        $description = $_POST['update-task-desc'];
        $category = $_POST['update-categories'];
        $deadline = $_POST['update-task-date'];
        $priority = $_POST['update-task-priority'];
        $status = $_POST['update-task-status'];
        $taskId = $_POST['updateTaskId'];
    
        $stmt = $conn->prepare("SELECT CategoryID FROM category WHERE CategoryName = ? AND UserEmail = ?");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Database query preparation failed: ' . $conn->error]);
            exit();
        }
        $stmt->bind_param("ss", $category, $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 0) {
            // Insert new category into the database
            $stmt = $conn->prepare("INSERT INTO category (CategoryName, UserEmail) VALUES (?, ?)");
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare category insertion: ' . $conn->error]);
                exit();
            }
            $stmt->bind_param("ss", $category, $userEmail);
            if ($stmt->execute()) {
                $categoryId = $stmt->insert_id;
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert category: ' . $stmt->error]);
                exit();
            }
            $stmt->close();
        } else {
            $row = $result->fetch_assoc();
            $categoryId = $row['CategoryID'];
        }
    
        
        // Update SQL statement
        $sql = "UPDATE task SET 
                TaskTitle = ?,
                TaskDescription = ?,
                CategoryID = ?,
                DueDate = ?,
                Status = ?,
                Priority = ?
                WHERE TaskID = ? AND Email = ?";
    
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssis", $title, $description, $categoryId, $deadline, $status, $priority, $taskId, $userEmail);
    
        error_log("Updating task: ID=$taskId, Title=$title, Email=$userEmail");
    
    
        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Task successfully updated']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No changes were made to the task']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating task: ']);
        }
    
        // Close statement (no need to close connection if it's shared and managed in config.php)
        $stmt->close();
    }
}catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Caught exception: '  . $e->getMessage()]);
}
?>
