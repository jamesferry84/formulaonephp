<?php
include 'init.php';
$active="statistics";
include 'includes/header.php';
include 'includes/navbar.php';
unset($_SESSION["passwordErrorMessage"]);
unset($_SESSION["passwordSuccessMessage"]);
$username = $_SESSION["username"];
$previousRaceSql = "select * from racecalendar where Date <= CURDATE() ORDER BY date desc LIMIT 0,1;";
$result = $conn->query($previousRaceSql);
$row = mysqli_fetch_assoc($result);
$previousRace = $row["Country"];
?>

    <div class="container">
        <div class = "row">
            <div class="page-header">
                <h3>2016 Current Standings - After <?php echo $previousRace ?> GP</h3>
            </div>
            <div class="table-responsive  col-lg-12">
                <table class="table table-bordered text-center">
                    <tr class ="success">
                        <td>+/-</td><td>Rank</td><td>Player Name</td><td>Team Name</td><td>Player Score</td><td>Jokers Played</td><td>Budget Rollover (£m)</td>
                    </tr>
                    <?php
                    $today = date("y-m-d");
                    $sql = "select * from users order by points desc";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);
                    $rank = 0;
                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        $rank++;
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $rank?></td>
                            <td><?php echo $row["UserName"]?></td>
                            <td><?php echo $row["teamname"]?></td>
                            <td><?php echo $row["points"]?></td>
                            <td> <?php echo $row["jokers"]?></td>
                            <td> <?php echo $row["budget"]?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>