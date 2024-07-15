<?php

session_start();

require_once ("../config.php");

$nickname = trim($_POST["NickName"]);
$email = trim($_POST["Email"]);
$password = trim($_POST["Password"]);
$type = "User";


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (nickname, email, password, UserType) VALUES (?, ?, ?, ?)";


if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssss", $nickname, $email, $hashedPassword, $type);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['$userEmail'] = $email;
        $_SESSION['$userNickname'] = $nickname;
        header("Location:../AppPages/dashboard.php");
        exit();
    } else {
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);


?>