<?php

session_start(); // Start the session to access session variables
require_once('config.php');


// Ensure required data is present
if (isset($_POST['TaskTitle'], $_POST['DueDate'], $_POST['Priority'], $_POST['Status'], $_POST['taskDescription'], $_POST['Category'])) {
    $taskTitle = trim($_POST['TaskTitle']);
    $dueDate = trim($_POST['DueDate']);
    $priority = trim($_POST['Priority']);
    $status = trim($_POST['Status']);
    $taskDescription = trim($_POST['taskDescription']);
    $category = trim($_POST['Category']);

    // Get the logged-in user's email from the session
    if (isset($_SESSION['userEmail'])) {
        $userEmail = $_SESSION['userEmail'];
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit();
    }

    // Check if category already exists
    $stmt = $conn->prepare("SELECT CategoryID FROM categories WHERE CategoryName = ? AND UserEmail = ?");
    $stmt->bind_param("ss", $category, $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert new category into the database
        $stmt = $conn->prepare("INSERT INTO categories (CategoryName, UserEmail) VALUES (?, ?)");
        $stmt->bind_param("ss", $category, $userEmail);
        if ($stmt->execute()) {
            $categoryId = $stmt->insert_id;
            echo "category inserted";
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to insert category']);
            exit();
        }
        $stmt->close();
    } else {
        $row = $result->fetch_assoc();
        $categoryId = $row['CategoryID'];
    }

    // Insert task into the database
    $stmt = $conn->prepare("INSERT INTO task (TaskTitle, DueDate, Priority, Status, TaskDescription, CategoryID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $taskTitle, $dueDate, $priority, $status, $taskDescription, $categoryId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Task added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add task']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}

mysqli_close($conn);
?>
