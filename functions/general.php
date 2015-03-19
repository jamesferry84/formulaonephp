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

?>