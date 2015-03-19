<?php
include 'init.php';


function get_drivers_and_constructors_with_prices()
{
    global $conn;
    $sql = "select d.name,d.price,t.name,t.price from driver d join team t on d.team = t.name order by d.price DESC";
    $result = $conn->query($sql);
    $dataArray = array();
    $output = array();


    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
        array_push($dataArray, $row);
    }

    foreach($dataArray as $data)
    {
        $output[] = '<td>' . $data . '</td>';
    }
    return $output;
}

function doesSubmissionExistForUser($username, $country)
{
    global $conn;
    $sql = "SELECT * FROM submissions WHERE username = '$username' AND country = '$country'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        return true;
    }
    return false;
}

?>