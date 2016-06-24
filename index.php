<?php

include 'init.php';
include 'functions/general.php';
$active="home";
include 'includes/header.php';
if (isset($_SESSION["username"]))
{
    // DO NOTHING
}
else{
    header("location:login.php");
}
$previousRaceSql = "select * from racecalendar where Date <= CURDATE() ORDER BY date desc LIMIT 0,1;";
$result = $conn->query($previousRaceSql);
$prevracesql = mysqli_fetch_assoc($result);
$previousRace = $prevracesql["Country"];
$sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);

while($row = mysqli_fetch_assoc($queryResult))
{
    $country =  $row["Country"];
}

//For testing
//$alreadySubmitted = 0;
$alreadySubmitted = doesSubmissionExistForUser($_SESSION["username"], $country);
include 'includes/navbar.php';
?>

<div class="container">
    <div class="jumbotron text-center container">
        <h1>Welcome to F1 Predictor 2016</h1>
        <p>If you love Formula 1 or motorsport in general then this is the F1 Predictor league for you!
            Unlike other F1 Predictor websites, who ask you to predict who will finish on the podium (dull!!), you choose a Team of 2 Drivers and 2 Constructors for each Race weekend and score Points based on how well they perform from First Practice to the chequered flag.
            This is the fourth year our League has been up and running, and the first year it has been available online.
            Our Predictor League is a privately run website for Players we know.</p>
<!--        <p> Next Race: --><?php //echo $country; ?><!--</p>-->
<!--        <p >Submissions close in: <p id="clock"></p></p>-->
<!--        <a href="chooseteam.php" class = "btn btn-success" --><?php //if ($alreadySubmitted == 1) echo 'disabled="true"' ?><!-->
        <!--Choose Team</a>-->
    </div>
</div>

<div class = "container">
    <div class="row">
        <div class="page-header text-center">
            <h3>Overall League Standings - After <?php echo $previousRace ?> GP</h3>
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
        <div class="table-responsive  col-lg-6 col-md-12 col-sm-12 ">
            <table class="table table-bordered text-center">
                <th class="text-center" colspan="2">Current Drivers Prices after <?php echo $previousRace?> GP</th>
                <tr class ="success">
                    <td>Driver</td>
                    <td>Price (£m)</td>
                </tr>
                <?php
                $sql = "select d.name,d.price,t.name as teamname,t.price as teamprice from driver d join team t on d.team = t.name order by d.price DESC";
                $result = $conn->query($sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo'<tr>' .
                        '<td>' . $row["name"] . '</td>' .
                        '<td>' . $row["price"] . '</td>' .
                        '</tr>';
                }
                ?>
            </table>

        </div>
        <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
            <table class="table table-bordered text-center">
                <th class="text-center" colspan="2">Current Constructors Prices after <?php echo $previousRace?> GP</th>
                <tr class ="success">
                    <td>Constructor</td>
                    <td>Price (£m)</td>
                </tr>
                <?php
                $sql = "select Name,Price from team order by Price DESC";
                $result = $conn->query($sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo'<tr>' .
                        '<td>' . $row["Name"] . '</td>' .
                        '<td>' . $row["Price"] . '</td>' .
                        '</tr>';
                }
                ?>
            </table>
        </div>
        <div class="clearfix visible-xs-block"></div>





    </div>
</div>

</body>
</html>