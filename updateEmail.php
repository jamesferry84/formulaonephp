<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
$username = $_SESSION["username"];
$newEmail = $_POST["email"];

$sql = "UPDATE users SET Email='$newEmail' WHERE UserName='$username'";
$queryResult = $conn->query($sql);
header("location:profile.php?");


