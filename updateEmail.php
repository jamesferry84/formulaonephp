<?php
include 'init.php';

unset($_SESSION["passwordErrorMessage"]);
unset($_SESSION["passwordSuccessMessage"]);

$username = $_SESSION["username"];
$newEmail = $_POST["email"];

if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["passwordErrorMessage"] = "Email Update Error: That email address is not a valid format";
    header("location:profile.php?");
    die();
}

if (empty($username) === true || empty($newEmail) === true ) {
    $_SESSION["passwordErrorMessage"] = "Email Update Error: All fields are not filled out";
    header("location:profile.php?");
    die();
}

$sql = "UPDATE users SET Email='$newEmail' WHERE UserName='$username'";
$queryResult = $conn->query($sql);
header("location:profile.php?");


