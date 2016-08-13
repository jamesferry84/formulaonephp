<?php
include 'init.php';
$username = $_POST["teamname"];

//$country = "Australian";
//$username = "Massa Fecked";

$raceSql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
$raceResult = $conn->query($raceSql);

while($row = mysqli_fetch_assoc($raceResult))
{
    $country =  $row["Country"];
}

$getUsername = "select UserName from users WHERE teamname='$username'";
$result = $conn->query($getUsername);
$rowresult = mysqli_fetch_assoc($result);
$username = $rowresult["UserName"];

$sql = "select * from submissions where UserName = '$username' AND Country = '$country'";
$queryResult = $conn->query($sql);
$row = mysqli_fetch_assoc($queryResult);
echo json_encode($row);
?>