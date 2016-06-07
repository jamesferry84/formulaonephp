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
        <h1>Welcome to the F1 Predictor</h1>
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
        <div class="col-md-6">
            <h3>Top 3</h3>
            <div class="table-responsive ">
                <table class="table table-bordered">
                    <tr class ="success">

                        <td>Name</td>
                        <td>Points</td>
                    </tr>
                    <?php
                    $today = date("y-m-d");
                    $sql = "select * from users order by points desc LIMIT 0,3";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);

                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        ?>
                        <tr>
                            <td> <?php echo $row["teamname"]?></td>
                            <td> <?php echo $row["points"]?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h3>Next 3 Races</h3>
            <div class="table-responsive ">
                <table class="table table-bordered">
                    <tr class ="success">

                        <td>Date</td>
                        <td>Country</td>
                    </tr>
                    <?php
                    $today = date("y-m-d");
                    $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,3";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);

                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        ?>
                        <tr>
                            <td> <?php echo $row["Date"]?></td>
                            <td> <?php echo $row["Country"]?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>