<?php

session_start();
unset($_SESSION["$userEmail"]);
header("location:../index.html");

?>