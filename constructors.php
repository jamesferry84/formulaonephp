<?php
	include 'connect.php';
	$sql = "select * from team order by Price desc";
	$queryResult = $conn->query($sql);
	$numrows=mysqli_num_rows($queryResult);

	while($row = mysqli_fetch_assoc($queryResult))
	{
		$rows[] = $row;
	}
	echo json_encode($rows);
?>
