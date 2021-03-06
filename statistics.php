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
                <h3>2017 Current Standings - After <?php echo $previousRace ?> GP</h3>
                <p>*Jokers Played and Carry Over values include any changes for the coming race</p>
            </div>
            <div class="table-responsive  col-lg-12">
                <table class="table table-bordered text-center">
                    <tr class ="success">
                        <td>+/-</td><td>Rank</td><td>Player Name</td><td>Team Name</td><td>Player Score</td><td>Jokers Played</td><td>Budget Carryover (£m)</td>
                    </tr>
                    <?php
                    $today = date("y-m-d");
                    $sql = "select * from users where Activated = '1' order by points desc";
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
                            <td> <?php echo $row["carryover"]?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <iframe width="900" height="800" frameborder="0" scrolling="no" src="https://plot.ly/~Menomaths/46.embed?share_key=OpYwvmHMYSD8H0wzoDJjiE"></iframe>
    </div>

<?php
include 'includes/footer.php';
?>