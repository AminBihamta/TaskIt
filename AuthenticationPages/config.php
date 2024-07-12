<?php

$servername = "127.0.0.1";
$username = "root";
$dbpassword = ""; // Add your MySQL password if you have set one
$dbname = "taskitdb";

// Creating connection
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

