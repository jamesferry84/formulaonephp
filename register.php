<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 10/03/2015
 * Time: 07:09
 */
include 'connect.php';

$email = $_POST["email"];
$password = $_POST["password"];
$encryptedPass = md5($password);
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$teamname = $_POST["teamname"];
$username = $firstname.$lastname;

$sql = "INSERT INTO users
        (UserName,Password,Email,teamname,Activated,jokers,budget,points)
        VALUES ('$username','$encryptedPass','$email','$teamname','0','3','55','0')";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>