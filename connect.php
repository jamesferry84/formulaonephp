<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 09/03/2015
 * Time: 20:07
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulaonepredictor";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
/**
echo "Connected successfully";

$sql = "SELECT * FROM team ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "TeamName: " . $row["Name"] . "<br>";
    }
} else {
    echo "No Results";
}
*/
?>