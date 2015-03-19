<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
/**
 * Created by PhpStorm.
 * User: James
 * Date: 09/03/2015
 * Time: 20:17

$servername="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$dbname="formulaonepredictor"; // Database name
$tbl_name="users"; // Table name

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
echo "Connected successfully";
*/
// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$encryptedPass = md5($mypassword);

// To protect MySQL injection (more detail about MySQL injection)

$sql="SELECT * FROM users WHERE email='$myusername' && password='$encryptedPass'";
$result = $conn->query($sql);



// If result matched $myusername and $mypassword, table row must be 1 row
if($result->num_rows == 1){
$row = $result->fetch_assoc();
// Register $myusername, $mypassword and redirect to file "login_success.php"
    $_SESSION["username"] = $row["UserName"];
    header("location:index.php");
}
else {
    $error = "Wrong Username or Password";
    header("location:login.php?" . $error);

}
?>