<?php

include 'init.php';

$driverName = $_POST["driverName"];
$position = $_POST["position"];
$completeRace = $_POST["completeRace"];
$fastestLap = $_POST["fastestLap"];
$pole = $_POST["pole"];

$raceAbbr = $_POST["raceSelection"];

//$raceSql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
//$raceResult = $conn->query($raceSql);
//
//while($row = mysqli_fetch_assoc($raceResult))
//{
//    $country =  $row["RaceAbbr"];
//}
//
//$raceAbbr = $country . "Points";

$rowCount = count($_POST["driverName"]);
for ($i=0; $i <$rowCount; $i++) {
    $total = $position[$i] + $completeRace[$i] + $fastestLap[$i] + $pole[$i];
    echo "Driver: " . $driverName[$i] . " has a total of: " . $total . " Points";
//    echo $position[$i];
//    echo $completeRace[$i];
//    echo $fastestLap[$i];
//    echo $pole[$i];

    $sql = "UPDATE driver_rolling_points SET $raceAbbr='$total' WHERE DriverName='$driverName[$i]'";
    $queryResult = $conn->query($sql);
}

//echo json_encode($result);
header("location:admin.php?");