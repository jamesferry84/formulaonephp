<?php

include 'init.php';

$constructorName = $_POST["constructorName"];
$position = $_POST["consPosition"];
$completeRace = $_POST["bothFinish"];
$fastestPit = $_POST["fastestPit"];
$bestCombined = $_POST["bestCombined"];


$raceAbbr = "";
$raceSql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
$raceResult = $conn->query($raceSql);
while($row = mysqli_fetch_assoc($raceResult))
{
    $country =  $row["RaceAbbr"];
}
$raceAbbr = $country . "Points";


$rowCount = count($_POST["constructorName"]);

$postions = array();
//check for duplicate positions
for ($i=0; $i <$rowCount; $i++) {
    $positions = $position[$i];
    echo "\n" . $positions;
}


for ($i=0; $i <$rowCount; $i++) {
    $total = $position[$i] + $completeRace[$i] + $fastestPit[$i] + $bestCombined[$i];
    echo "Constructor: " . $constructorName[$i] . " has a total of: " . $total . " Points";

    $sql = "UPDATE constructor_rolling_points SET $raceAbbr='$total' WHERE ConstructorName='$constructorName[$i]'";
    $queryResult = $conn->query($sql);
}

//echo json_encode($result);
header("location:admin.php?");