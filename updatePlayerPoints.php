<?php

include 'init.php';

$teamNames = $_POST["teamnames"];
$points = $_POST["playerPoints"];


$mytestarray = array_combine($teamNames, $points);

foreach($mytestarray as $key => $value) {
    global $conn;
    $sql="UPDATE users SET points ='$value' WHERE teamname='$key'";
    $result = $conn->query($sql);
}
header("location:admin.php?");