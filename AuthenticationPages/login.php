<?php

session_start();

require_once("config.php");

// Get the email and password from the form
$email = trim($_POST["Email"]);
$password = trim($_POST["Password"]);

// Input validation
if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
    // Check if the email exists
    $stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, verify the password
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        $test = password_verify($password, $hashedPassword);

        if ($test == true) {
            $_SESSION['$userEmail'] = $email;
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Incorrect password. Try again.";
        }
    } else {
        // If not found, redirect to register page
        header("Location: register.html");
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid input. Please enter a valid email and password.";
}
mysqli_close($conn);

?>
