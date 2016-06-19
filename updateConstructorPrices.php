<?php

include 'init.php';

$constructorPrices = $_POST["constructorPrices"];
$constructorNames = $_POST["constructorName"];

$mytestarray = array_combine($constructorNames, $constructorPrices);

foreach($mytestarray as $key => $value) {
    global $conn;
    $sql="UPDATE team SET Price ='$value' WHERE Name='$key'";
    $result = $conn->query($sql);
}
header("location:admin.php?");



