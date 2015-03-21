<?php

include 'init.php';
include 'functions/general.php';
include 'includes/header.php';
if (isset($_SESSION["username"]))
{
    // DO NOTHING
}
else{
    header("location:login.php");
}
$sql = "select * from racecalendar where Date >= CURDATE() LIMIT 0,1";
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
    <div class="jumbotron text-center">
        <h1>Welcome to the F1 Predictor</h1>
        <p>Welcome to the University of Stirling's Computing Science and Mathematics department's Formula 1 Predictor League for the new and improved 2015 season!</p>
        <p> Next Race:
            <?php
            echo $country;
            ?>
        </p>

        <a href="#chooseteam" data-toggle="modal" class = "btn btn-success" <?php if ($alreadySubmitted == 1) echo 'disabled="true"' ?>>Choose Team</a>
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
                    $sql = "select * from racecalendar where Date >= CURDATE() LIMIT 0,3";
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





<?php
include 'includes/chooseteam.php';
include 'includes/footer.php';
?>