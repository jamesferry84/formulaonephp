<?php
include 'init.php';
unset($_SESSION["passwordErrorMessage"]);
unset($_SESSION["passwordSuccessMessage"]);

$username = $_SESSION["username"];
$oldPassword = $_POST['currentPassword'];
$password =$_POST['newPassword'];
$encryptedOldPass = md5($oldPassword);
$encryptedPass = md5($password);

$getUserSql = "SELECT * from users WHERE UserName='$username'";
$queryResult = $conn->query($getUserSql);
$row = mysqli_fetch_assoc($queryResult);

if (empty($oldPassword) === true || empty($password) === true ) {
    $_SESSION["passwordErrorMessage"] = "Password Update Error: All fields are not filled out";
    header("location:profile.php?");
    die();
}

if ($encryptedOldPass == $row["Password"]) {
    if ($encryptedPass != $row["Password"]) {
        $sql = "UPDATE users SET Password='$encryptedPass' WHERE UserName='$username'";
        $queryResult = $conn->query($sql);
        $_SESSION["passwordSuccessMessage"] = "Your password has been successfully updated";
    }
    else {
        $_SESSION["passwordErrorMessage"] = "Your new password cannot be the same as your old password";
    }
}
else {
    $_SESSION["passwordErrorMessage"] = "'Current Password' does not match our records";
    header("location:profile.php?");
    die();
}



header("location:profile.php?");