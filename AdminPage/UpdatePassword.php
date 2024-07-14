<?php
require_once ("../config.php");; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting the new password and email from the form
    $new_password = trim($_POST['new-password']);
    $user_email = trim($_POST['email']);

    // Validating the inputs
    if (empty($new_password) || empty($user_email)) {
        echo "<script>
                alert('Please fill in all fields');
                window.location.replace('admin.php');
              </script>";
        exit();
    }

    // Hashing the new password before storing it in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Preparing the SQL statement to update the password
    $stmt = $conn->prepare("UPDATE user SET Password = ? WHERE Email = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("ss", $hashed_password, $user_email);
    if ($bind === false) {
        die('Bind failed: ' . htmlspecialchars($stmt->error));
    }

    // Executing the statement and check for errors
    $execute = $stmt->execute();
    if ($execute) {
        echo "<script>
                alert('Password updated successfully');
              </script>";
    } else {
        echo "<script>alert('Error updating password');</script>";
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