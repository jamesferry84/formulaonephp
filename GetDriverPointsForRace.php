<?php
include 'init.php';

$raceAbbr = $_POST["driverPointsRace"];

$sql = "select DriverName, $raceAbbr from driver_rolling_points order by $raceAbbr desc";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);


while($row = mysqli_fetch_assoc($queryResult))
{
    $rows[] = $row;
}
echo json_encode($rows);
?>