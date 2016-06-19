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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pharetra pretium nisi.
            Praesent mollis mauris sit amet tristique fermentum. Maecenas at urna sollicitudin, blandit justo vitae, volutpat leo. Nam pellentesque diam sed lorem
            iaculis aliquet. Sed condimentum, risus vehicula semper blandit, ex purus tincidunt dolor, ut elementum libero augue eget ante. Sed ac arcu sed
            nibh hendrerit molestie. Vestibulum tempus, neque sit amet congue tincidunt, nunc ante molestie eros, id ultricies eros velit efficitur nisi. Nulla facilisi.
            Ut tempus semper condimentum. Nullam pharetra euismod odio, ac auctor ante ultricies vitae. Suspendisse pharetra feugiat nisl. Integer sed ante in dui pellentesque ultrices.
            Aliquam eu odio vulputate, feugiat risus sit amet, tempor massa. Suspendisse sit amet erat mauris. Ut quis nibh in velit molestie pretium. Fusce lorem arcu, consequat et augue at, finibus ultricies ex.</p>
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