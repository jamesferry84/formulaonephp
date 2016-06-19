<?php

include 'init.php';

$driverPrices = $_POST["driverPrices"];
$driverNames = $_POST["driverName"];


$mytestarray = array_combine($driverNames, $driverPrices);

foreach($mytestarray as $key => $value) {
    global $conn;
    $sql="UPDATE driver SET Price ='$value' WHERE Name='$key'";
    $result = $conn->query($sql);
}
header("location:admin.php?");



