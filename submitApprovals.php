<?php

include 'init.php';

$approvals = $_POST["approve"];
$emails = $_POST["email"];

$mytestarray = array_combine($emails, $approvals);

foreach($mytestarray as $key => $value) {
    global $conn;
    $sql="UPDATE users SET Activated ='$value' WHERE Email='$key'";
    $result = $conn->query($sql);
}
header("location:admin.php?");

