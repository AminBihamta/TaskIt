<?php


require_once("config.php");

// Get the email and password from the form
$email = trim($_POST["Email"]);
$password = trim($_POST["Password"]);

// Input validation
if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
    // Run a SQL query to check if the email and password are in the db
    $stmt = $conn->prepare("SELECT email FROM user WHERE email =? AND password =?");
    // Bind parameters and execute the statement

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Logged in";
    } else {
        // Check if the email exists
        $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email exists but password is incorrect
            echo "Incorrect password. Try again.";
        } else {
            // If not found, redirect to register page
            echo " please register";
        }
    }
    $stmt->close();
} else {
    echo "Invalid input. Please enter a valid email and password.";
}
mysqli_close($conn);

?>

