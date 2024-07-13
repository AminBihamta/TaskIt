<?php

session_start(); // Start the session to access session variables
require_once("../config.php");

header('Content-Type: application/json'); // Set the content type to JSON

function sendJsonResponse($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit();
}

if (!isset($_SESSION['$userEmail'])) {
    echo json_encode(['success' => false, 'message' => 'Session variable userEmail not set']);
    exit();
}

// Ensure required data is present
if (isset($_POST['TaskTitle'], $_POST['DueDate'], $_POST['Priority'], $_POST['Status'], $_POST['taskDescription'], $_POST['Category'])) {
    $taskTitle = trim($_POST['TaskTitle']);
    $dueDate = trim($_POST['DueDate']);
    $priority = trim($_POST['Priority']);
    $status = trim($_POST['Status']);
    $taskDescription = trim($_POST['taskDescription']);
    $category = trim($_POST['Category']);

    // Get the logged-in user's email from the session
    $userEmail = $_SESSION['$userEmail'];

    // Check if category already exists
    $stmt = $conn->prepare("SELECT CategoryID FROM category WHERE CategoryName = ? AND UserEmail = ?");
    if (!$stmt) {
        sendJsonResponse(false, 'Database query preparation failed: ' . $conn->error);
        exit();
    }
    $stmt->bind_param("ss", $category, $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert new category into the database
        $stmt = $conn->prepare("INSERT INTO category (CategoryName, UserEmail) VALUES (?, ?)");
        if (!$stmt) {
            sendJsonResponse(false, 'Failed to insert category: ' . $stmt->error);
            exit();
        }
        $stmt->bind_param("ss", $category, $userEmail);
        if ($stmt->execute()) {
            $categoryId = $stmt->insert_id;
        } else {
            sendJsonResponse(false, 'Failed to insert category: ' . $stmt->error);
            exit();
        }
        $stmt->close();
    } else {
        $row = $result->fetch_assoc();
        $categoryId = $row['CategoryID'];
    }

    // Insert task into the database
    $stmt = $conn->prepare("INSERT INTO task (TaskTitle, DueDate, Priority, Status, TaskDescription, CategoryID) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        sendJsonResponse(false, 'Database query preparation failed: ' . $conn->error);
        exit();
    }
    $stmt->bind_param("sssssi", $taskTitle, $dueDate, $priority, $status, $taskDescription, $categoryId);

    if ($stmt->execute()) {
        sendJsonResponse(true, 'Task added successfully');
    } else {
        sendJsonResponse(false, 'Failed to add task: ' . $stmt->error);
    }
    $stmt->close();
} else {
    sendJsonResponse(false, 'Missing required fields');
}

mysqli_close($conn);

?>
