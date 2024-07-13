<?php

session_start();

require_once ("../config.php");

$nickname = trim($_POST["NickName"]);
$email = trim($_POST["Email"]);
$password = trim($_POST["Password"]);


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (nickname, email, password) VALUES (?, ?, ?)";


if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $nickname, $email, $hashedPassword);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['$userEmail'] = $email;
        header("Location:../Dashboard/dashboard.php");
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