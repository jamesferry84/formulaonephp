<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 09/03/2015
 * Time: 20:57
 */
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';

$username = $_SESSION["username"];
$driver1 = $_POST["driver1"];
$driver2 = $_POST["driver2"];
$constructor1 = $_POST["constructor1"];
$constructor2 = $_POST["constructor2"];
$joker = (isset($_REQUEST['jokerUsed']));

$today = date("y-m-d");
$sql = "select * from racecalendar where Date >= CURDATE() LIMIT 0,1";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);

while($row = mysqli_fetch_assoc($queryResult))
{
    $country =  $row["Country"];
}


if ($joker == 1)
{
    $joker = 1;
}
else
{
    $joker = 0;
}

$balance = $_POST["remainingBudget"];

$query = "INSERT INTO `submissions` (`UserName`, `driver1`, `driver2`, `constructor1`, `constructor2`, `joker`, `country`) VALUES ('$username', '$driver1', '$driver2', '$constructor1', '$constructor2', '$joker', '$country')";

$conn->query($query);
?>
<div class="container">
    <div class=" col-lg-12 col-md-12 col-sm-12">
        <h5 class="alert-success">Thank You. Your selections have been accepted and are displayed below.</h5>
        <div class="table-responsive ">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Race</th>
                    <th>Driver 1</th>
                    <th>Driver 2</th>
                    <th>Constructor 1</th>
                    <th>Constructor 2</th>
                    <th>Joker Used</th>
                    <th>New Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $country; ?></td>
                    <td><?php echo $driver1; ?></td>
                    <td><?php echo $driver2; ?></td>
                    <td><?php echo $constructor1; ?></td>
                    <td><?php echo $constructor2; ?></td>
                    <td><?php echo $joker; ?></td>
                    <td><?php echo '£' . number_format($balance,2,'.',''); ?></td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
