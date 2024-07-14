<?php
require_once ("../config.php");; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new username and email from the form
    $new_username = trim($_POST['new-username']);
    $user_email = trim($_POST['email']);

    // Validate the inputs
    if (empty($new_username) || empty($user_email)) {
        echo "<script>
                alert('Please fill in all fields');
                window.location.replace('admin.php');
              </script>";
        exit();
    }

    // Preparing the SQL statement to update the username
    $stmt = $conn->prepare("UPDATE user SET NickName = ? WHERE Email = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("ss", $new_username, $user_email);
    if ($bind === false) {
        die('Bind failed: ' . htmlspecialchars($stmt->error));
    }

    // Executing the statement and check for errors
    $execute = $stmt->execute();
    if ($execute) {
        echo "<script>
                alert('Username updated successfully');
              </script>";
    } else {
        echo "<script>alert('Error updating username');</script>";
    }

    // Closing the statement
    $stmt->close();

    echo '<script>
            window.location.replace("admin.php");
          </script>';
} else {
    echo "<script>
            alert('Not using post');
            window.location.replace('admin.php');
          </script>";
}
?>
