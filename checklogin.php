<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';

$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$encryptedPass = md5($mypassword);

$sql="SELECT * FROM users WHERE email='$myusername' && password='$encryptedPass'";
$result = $conn->query($sql);


if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION["username"] = $row["UserName"];
    $_SESSION["admin"] = $row["isadmin"];
    header("location:index.php");
}
else {
    $error = "Wrong Username or Password";
    header("location:login.php?");
}
?>