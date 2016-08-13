<?php
include 'init.php';
$sql = "select teamname, carryover from users order by teamname";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);


while($row = mysqli_fetch_assoc($queryResult))
{
    $rows[] = $row;
}
echo json_encode($rows);
?>