<?php 
require_once ("../config.php");; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_type = trim($_POST['type']);
    $user_name = trim($_POST['name']);
    $user_email = trim($_POST['email']);
    $user_pass = trim($_POST['pass']);

    // Hashing the password before storing it in the database
    $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);

    // Preparing and binding the SQL statement
    $stmt = $conn->prepare("INSERT INTO user (UserType, NickName, Email, Password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("ssss", $user_type, $user_name, $user_email, $hashed_password);
    if ($bind === false) {
        die('Bind failed: ' . htmlspecialchars($stmt->error));
    }

    $execute = $stmt->execute();
    if ($execute) {
        echo "<script>
                alert('New user added successfully');
              </script>";
    } else {
        echo "<script>alert('Error: Could not add user');</script>";
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
