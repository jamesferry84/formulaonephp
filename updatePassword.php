<?php
include 'init.php';
$username = $_SESSION["username"];
$oldPassword = $_POST['currentPassword'];
$password =$_POST['newPassword'];
$encryptedOldPass = md5($oldPassword);
$encryptedPass = md5($password);

$getUserSql = "SELECT * from users WHERE UserName='$username'";
$queryResult = $conn->query($getUserSql);
$row = mysqli_fetch_assoc($queryResult);

if ($encryptedOldPass == $row["Password"]) {
    $sql = "UPDATE users SET Password='$encryptedPass' WHERE UserName='$username'";
    $queryResult = $conn->query($sql);
}

header("location:profile.php?");