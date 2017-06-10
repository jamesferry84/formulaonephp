<?php
$active="admin";
$adminfile = 'textdata/admin.txt';
$handle = fopen($adminfile, 'r');
$data = fread($handle,filesize($adminfile));
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
unset($_SESSION["passwordErrorMessage"]);
unset($_SESSION["passwordSuccessMessage"]);
$previousRaceSql = "select * from racecalendar where Date <= CURDATE() ORDER BY date desc LIMIT 0,1;";
$result = $conn->query($previousRaceSql);
$row = mysqli_fetch_assoc($result);
$previousRace = $row["Country"];

$sql = "select * from submissions where Country = '$country'  and UserName = '{$_SESSION['username']}'";
$queryResult = $conn->query($sql);
$numberofrows = mysqli_num_rows($queryResult);
$driver1Price = 0;
$driver2Price = 0;
$constructor1Price = 0;
$constructor2Price = 0;

if ($numberofrows > 0) {
    $sql = "select * from submissions where Country = '$country'  and UserName = '{$_SESSION['username']}'";
    $queryResult = $conn->query($sql);
    $row = mysqli_fetch_assoc($queryResult);
    $driver1 = $row["Driver1"];
    $driver2 = $row["Driver2"];
    $constructor1 = $row["Constructor1"];
    $constructor2 = $row["Constructor2"];

    $driver1priceSql = "select * from driver where Name = '$driver1'";
    $queryResult = $conn->query($driver1priceSql);
    $driver1PriceRow = mysqli_fetch_assoc($queryResult);
    $driver1Price = $driver1PriceRow["Price"];

    $driver2priceSql = "select * from driver where Name = '$driver2'";
    $queryResult = $conn->query($driver2priceSql);
    $driver2PriceRow = mysqli_fetch_assoc($queryResult);
    $driver2Price = $driver2PriceRow["Price"];

    $constructor1priceSql = "select * from team where Name = '$constructor1'";
    $queryResult = $conn->query($constructor1priceSql);
    $constructor1PriceRow = mysqli_fetch_assoc($queryResult);
    $constructor1Price = $constructor1PriceRow["Price"];


    $constructor2priceSql = "select * from team where Name = '$constructor2'";
    $queryResult = $conn->query($constructor2priceSql);
    $constructor2PriceRow = mysqli_fetch_assoc($queryResult);
    $constructor2Price = $constructor2PriceRow["Price"];

    if (empty($driver1Price)) {
        $driver1Price = 0;
    }
    if (empty($driver2Price)) {
        $driver2Price = 0;
    }
    if (empty($constructor1Price)) {
        $constructor1Price = 0;
    }
    if (empty($constructor2Price)) {
        $constructor2Price = 0;
    }
}

if ($_SESSION["admin"] == 1)
{


}
else{
    header("location:index.php");
}
?>

<div class="container">
    <div class = "col-lg-12 col-md-12 col-sm-12">
        <div class = "panel panel-default">
            <div class = "panel-body">
                <div class="page-header">
                    <h3>Profile</h3>
                </div>

                <div id="newUserApproval" style="margin-top:50px;" class="col-lg-12 col-md-12 ">
                    <div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-title">New User Approvals</div>
                        </div>

                        <div class="panel-body" >
                            <form action="submitApprovals.php" method="post">

                                <div class="form-group" style="margin-top:20px;">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Team Name</th>
                                            <th>Approve?</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            $sql = "select UserName, Email, teamname from users where Activated = 0";
                                            $result = $conn->query($sql);
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                echo'<tr>' .
                                                    '<td>' . $row["UserName"] . '</td>' .
                                                    '<td>' . '<input name="email[]" value="' . $row["Email"] .'" readonly>' . '</td>' .
                                                    '<td>' . $row["teamname"] . '</td>' .
                                                    '<td>
                                                    <select class="form-control" id="approve" name="approve[]">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>' .
                                                    '</tr>';
                                            }
                                            ?>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-10 col-md-9">
                                        <button class="btn btn-success" name="submitButton" type="submit">Submit Selections</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div id="submissions" style="margin-top:50px;" class="col-lg-12 col-md-12 ">
                    <?php
                    $sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);

                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        $country =  $row["Country"];
                    }

                    ?>
                    <div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-title">Submissions for -  <?php echo $country ?></div>
                        </div>

                        <div class="panel-body" >
                            <form action="" method="post">

                                <div class="form-group" style="margin-top:20px;">
                                    <div class="table-responsive ">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Team</th>
                                                <th>Driver 1</th>
                                                <th>Driver 2</th>
                                                <th>Constructor 1</th>
                                                <th>Constructor 2</th>
                                                <th>Joker?</th>
                                                <th>Carried Over</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php
                                                $sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
                                                $queryResult = $conn->query($sql);
                                                $numrows=mysqli_num_rows($queryResult);

                                                while($row = mysqli_fetch_assoc($queryResult))
                                                {
                                                    $country =  $row["Country"];
                                                }

                                                $query = "SELECT u.teamname, s.Driver1, s.Driver2, s.Constructor1,s.Constructor2, s.joker, u.carryover FROM `users` u left join `submissions` s on u.username = s.username  AND s.country = '$country'";
                                                // $query = "SELECT teamname, driver1, driver2, constructor1,constructor2 FROM `submissions` s join `users` u on u.username = s.username  AND s.country = '$country'";
                                                $usersNotSubmitted = $conn->query($query);
                                                while($row = mysqli_fetch_assoc($usersNotSubmitted))
                                                {
                                                    echo'<tr>' .
                                                        '<td>' . $row["teamname"] . '</td>' .
                                                        '<td>' . $row["Driver1"] . '</td>' .
                                                        '<td>' . $row["Driver2"] . '</td>' .
                                                        '<td>' . $row["Constructor1"] . '</td>' .
                                                        '<td>' . $row["Constructor2"] . '</td>' .
                                                        '<td>';  if ($row["joker"] == 1) {echo "Y";} else {echo "N";} echo '</td>' .
                                                        '<td>' . $row["carryover"] . '</td>' .
                                                    '</tr>';
                                                }
                                                ?>
                                            </tr>
                                            </tbody>

                                        </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                    <div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-title">Points</div>
                        </div>

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for = "driverPointsRace" class = "col-lg-3 control-label">Select Race:</label>
                                <div class = "col-lg-5">
                                    <select class="form-control" id="driverPointsRace" name="driverPointsRace">
                                        <option value="AbuDPoints">Abu Dhabi</option>
                                        <option value="AmerPoints">American</option>
                                        <option value="OzzyPoints">Australian</option>
                                        <option value="AustPoints">Austrian</option>
                                        <option value="BahrPoints">Bahraini</option>
                                        <option value="BelgPoints">Belgian</option>
                                        <option value="BrazPoints">Brazilian</option>
                                        <option value="BritPoints">British</option>
                                        <option value="CanaPoints">Canadian</option>
                                        <option value="ChinPoints">Chinese</option>
                                        <option value="EuroPoints">European</option>
                                        <option value="GermPoints">German</option>
                                        <option value="HungPoints">Hungarian</option>
                                        <option value="ItalPoints">Italian</option>
                                        <option value="JapaPoints">Japanese</option>
                                        <option value="MalaPoints">Malaysian</option>
                                        <option value="MexiPoints">Mexican</option>
                                        <option value="MonaPoints">Monaco</option>
                                        <option value="RussPoints">Russian</option>
                                        <option value="SingPoints">Singapore</option>
                                        <option value="SpanPoints">Spanish</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <form class="form-horizontal">
                                <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
                                    <table class="table table-bordered text-center">
                                        <tr class ="success">
                                            <th class="text-center">Driver</th>
                                            <th class="text-center">Points</th>
                                        </tr>
                                        </thead>
                                        <tbody id="driverRacePointsTable">

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="form-horizontal">
                                <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
                                    <table class="table table-bordered text-center">
                                        <tr class ="success">
                                            <th class="text-center">Constructor</th>
                                            <th class="text-center">Points</th>
                                        </tr>
                                        </thead>
                                        <tbody id="constructorRacePointsTable">

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>





            </div>
        </div>
    </div>

    <div class="row">
        <form class="form-horizontal" action="updatePlayerPoints.php" method="post">
            <div class="table-responsive  col-lg-12 col-md-12 col-sm-12">
                <table class="table table-bordered text-center">
                    <th class="text-center" colspan="2">Update Player Points</th>
                    <tr class ="success">
                        <td>Team Name</td>
                        <td>Points</td>
                    </tr>
                    <?php
                    $sql = "select teamname,points from users order by points DESC";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo'<tr>' .
                            '<td>' . '<input name="teamnames[]" value="' . $row["teamname"] .'" readonly>' . '</td>' .
                            '<td>' . '<input id="playerPoints" name="playerPoints[]" type="text" value="' . $row["points"] . '">' . '</td>' .
                            '</tr>';
                    }
                    ?>
                </table>
                <div class="form-group">
                    <div class="col-md-offset-8 col-md-9 col-sm-offset-8 col-sm-9">
                        <button class="btn btn-success" name="submitPlayerPoints" type="submit">Update Player Points</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <br />
    <div class="clearfix visible-xs-block"></div>

        <!-- Points Driver / Constructor -->

    <div class="row">
        <form class="form-horizontal" action="updateDriverPrices.php" method="post">
            <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
                <table class="table table-bordered text-center">
                    <th class="text-center" colspan="2">Current Driver Prices</th>
                    <tr class ="success">
                        <td>Driver</td>
                        <td>Price (£m)</td>
                    </tr>
                    <?php
                    $sql = "select Name,Price from driver order by Price DESC";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo'<tr>' .
                            '<td>' . '<input name="driverName[]" value="' . $row["Name"] .'" readonly>' . '</td>' .
                            '<td>' . '<input id="driverPrices" name="driverPrices[]" type="text" value="' . $row["Price"] . '">' . '</td>' .
                            '</tr>';
                    }
                    ?>
                </table>
                <button class="btn btn-success" name="submitDriverButton" type="submit">Update Driver Prices</button>
            </div>
        </form>



        <form class="form-horizontal" action="updateConstructorPrices.php" method="post">
            <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
                <table class="table table-bordered text-center">
                    <th class="text-center" colspan="2">Current Constructors Prices</th>
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
                            '<td>' . '<input name="constructorName[]" value="' . $row["Name"] .'" readonly>' . '</td>' .
                            '<td>' . '<input id="constructorPrices" name="constructorPrices[]" type="text" value="' . $row["Price"] . '">' . '</td>' .
                            '</tr>';
                    }
                    ?>
                </table>
                <button class="btn btn-success" name="submitConstructorButton" type="submit">Update Constructor Prices</button>
            </div>
        </form>
    </div>
    <br />
    <div class="clearfix visible-xs-block"></div>

    <div class="row">
        <form class="form-horizontal" action="updateAdminText.php" method="post">
            <input type="hidden" name="data" value="<?php echo $data ?>">
            <div class="table-responsive  col-lg-12 col-md-12 col-sm-12">
                <table class="table table-bordered text-center">
                    <th class="text-center" colspan="2">Submissions</th>
                    <?php if ($data == 0) {
                        echo '<td>' .
                        '<button class="btn btn-success" name="submitConstructorButton" type="submit">Open Submissions</button></td>';
                    };?>
                    <?php if ($data == 1) {
                        echo '<td>' .
                            '<button class="btn btn-danger" name="submitConstructorButton" type="submit">Close Submissions</button></td>';
                    };?>
                </table>
            </div>
        </form>
    </div>








    <!--
    SUBMISSIONS

    -->


    <div class = "col-lg-12 col-md-8 col-sm-8">
        <div class = "panel panel-default">
            <div class = "panel-body">
                <div class="page-header">
                    <h3>Override Team Choices</h3>
                    <div class="well">
                        <div class="alert-danger">
                            <?php

                            if (empty($_SESSION['submitErrorMessage']) == false) {
                                echo $_SESSION["submitErrorMessage"];
                            }
                            ?>
                        </div>
                    </div>
                    <form class="form-horizontal" action="adminSubmitTeam.php" method="post" onsubmit="return confirm('Are you sure you want to submit this team?');">

                        <div class="form-group">
                            <label for = "user" class = "col-lg-3 control-label">Team Name:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="teamnameDropDown" name="teamname" required="required" onchange="getTeamSubmissions()" >
                                    <option value=""></option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "race" class = "col-lg-3 control-label">Race:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="raceDropDown" name="race" required="required">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver1DropDown" name="driver1" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver2DropDown" name="driver2">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor1DropDown" name="constructor1">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor2DropDown" name="constructor2" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            $sql = "select * from users where username = '{$_SESSION['username']}'";
                            $queryResult = $conn->query($sql);
                            $numrows=mysqli_num_rows($queryResult);

                            $row = mysqli_fetch_assoc($queryResult)

                            ?>
                            <label for = "jokerUsed" class = "col-lg-3 control-label">Use Joker?</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="jokerUsed" name="jokerUsed" >
                                    <option selected value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <?php
                            $sql = "select * from users where username = '{$_SESSION['username']}'";
                            $queryResult = $conn->query($sql);
                            $numrows=mysqli_num_rows($queryResult);

                            $row = mysqli_fetch_assoc($queryResult)

                            ?>
                            <label for = "carriedOver" class = "col-lg-3 control-label">Carried Over:</label>
                            <div class = "col-lg-5">
                                <input type = "text" class="form-control" id="carriedOver" name="carriedOver"  value=<?php echo $row["carryover"] ?>  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "remainingBudget" class = "col-lg-3 control-label">Remaining Budget:</label>
                            <div class = "col-lg-5">
                                <input type = "text" class="form-control" id="remainingBudget" name="remainingBudget"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9 col-sm-offset-3 col-sm-9">
                                <button type="button" class="btn btn-danger " id="resetButton" onclick="resetTeam()">Reset Team</button>
                                <button class="btn btn-success" id="submitButton" type="submit">Submit Team</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- SUBMISSIONS ENDS-->


    <div id="raceResults" style="margin-top:50px;" class="col-lg-12 col-md-12 ">
        <div class="panel panel-success" >
            <div class="panel-heading">
                <div class="panel-title">Driver Results</div>
            </div>

            <div class="panel-body" >
                <form action="submitDriverResults.php" method="post">

                    <div class="form-group">
                        <label for = "raceSelection" class = "col-lg-3 control-label">Select Race:</label>
                        <div class = "col-lg-5">
                            <select class="form-control" id="raceSelection" name="raceSelection">
                                <option value="AbuDPoints">Abu Dhabi</option>
                                <option value="AmerPoints">American</option>
                                <option value="OzzyPoints">Australian</option>
                                <option value="AustPoints">Austrian</option>
                                <option value="BahrPoints">Bahraini</option>
                                <option value="BelgPoints">Belgian</option>
                                <option value="BrazPoints">Brazilian</option>
                                <option value="BritPoints">British</option>
                                <option value="CanaPoints">Canadian</option>
                                <option value="ChinPoints">Chinese</option>
                                <option value="EuroPoints">European</option>
                                <option value="GermPoints">German</option>
                                <option value="HungPoints">Hungarian</option>
                                <option value="ItalPoints">Italian</option>
                                <option value="JapaPoints">Japanese</option>
                                <option value="MalaPoints">Malaysian</option>
                                <option value="MexiPoints">Mexican</option>
                                <option value="MonaPoints">Monaco</option>
                                <option value="RussPoints">Russian</option>
                                <option value="SingPoints">Singapore</option>
                                <option value="SpanPoints">Spanish</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:20px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Position</th>
                                <th>Complete Race?</th>
                                <th>Fastest Lap?</th>
                                <th>Pole?</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $sql = "select Name, Team from driver";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo'<tr>' .
                                        '<td>' . $row["Name"] . '</td>' .
                                        '<td>
                                                    <select class="form-control" id="position" name="position[]">
                                                        <option value="0">NA</option>
                                                        <option value="25">1st</option>
                                                        <option value="18">2nd</option>
                                                        <option value="15">3rd</option>
                                                        <option value="12">4th</option>
                                                        <option value="10">5th</option>
                                                        <option value="8">6th</option>
                                                        <option value="6">7th</option>
                                                        <option value="4">8th</option>
                                                        <option value="2">9th</option>
                                                        <option value="1">10th</option>
                                                    </select>
                                                </td>' .
                                        '<td>
                                                    <select class="form-control" id="completeRace" name="completeRace[]">
                                                        <option value="5">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </td>' .
                                        '<td>
                                            <select class="form-control" id="fastestLap" name="fastestLap[]">
                                                        <option value="0">No</option>
                                                        <option value="5">Yes</option>
                                                    </select>
                                        </td>' .
                                        '<td>
                                             <select class="form-control" id="pole" name="pole[]">
                                                        <option value="0">No</option>
                                                        <option value="5">Yes</option>
                                                    </select>
                                        </td>' .
                                        '<td>  <input type="hidden" name="driverName[]" value="' . $row["Name"] .'" ></td>' .
                                        '</tr>';
                                }
                                ?>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-10 col-md-9">
                            <button class="btn btn-success" name="submitButton" type="submit">Submit Selections</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="constructorResults" style="margin-top:50px;" class="col-lg-12 col-md-12 ">
        <div class="panel panel-success" >
            <div class="panel-heading">
                <div class="panel-title">Constructor Results</div>
            </div>

            <div class="panel-body" >
                <form action="submitConstructorResults.php" method="post">

                    <div class="form-group">
                        <label for = "raceSelection" class = "col-lg-3 control-label">Select Race:</label>
                        <div class = "col-lg-5">
                            <select class="form-control" id="raceSelection" name="raceSelection">
                                <option value="AbuDPoints">Abu Dhabi</option>
                                <option value="AmerPoints">American</option>
                                <option value="OzzyPoints">Australian</option>
                                <option value="AustPoints">Austrian</option>
                                <option value="BahrPoints">Bahraini</option>
                                <option value="BelgPoints">Belgian</option>
                                <option value="BrazPoints">Brazilian</option>
                                <option value="BritPoints">British</option>
                                <option value="CanaPoints">Canadian</option>
                                <option value="ChinPoints">Chinese</option>
                                <option value="EuroPoints">European</option>
                                <option value="GermPoints">German</option>
                                <option value="HungPoints">Hungarian</option>
                                <option value="ItalPoints">Italian</option>
                                <option value="JapaPoints">Japanese</option>
                                <option value="MalaPoints">Malaysian</option>
                                <option value="MexiPoints">Mexican</option>
                                <option value="MonaPoints">Monaco</option>
                                <option value="RussPoints">Russian</option>
                                <option value="SingPoints">Singapore</option>
                                <option value="SpanPoints">Spanish</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:20px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Constructor</th>
                                <th>Position</th>
                                <th>Best Combined Qualifying?</th>
                                <th>Both Cars Finish Race?</th>
                                <th>Fastest Pit?</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $sql = "select Name from team";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo'<tr>' .
                                        '<td>' . $row["Name"] . '</td>' .
                                        '<td>
                                                     <select class="form-control" id="consPosition" name="consPosition[]">
                                                        <option value="25">1st</option>
                                                        <option value="18">2nd</option>
                                                        <option value="15">3rd</option>
                                                        <option value="12">4th</option>
                                                        <option value="10">5th</option>
                                                        <option value="8">6th</option>
                                                        <option value="6">7th</option>
                                                        <option value="4">8th</option>
                                                        <option value="2">9th</option>
                                                        <option value="1">10th</option>
                                                    </select>
                                                </td>' .
                                        '<td>
                                                    <select class="form-control" id="bestCombined" name="bestCombined[]">
                                                        <option value="0">No</option>
                                                        <option value="5">Yes</option>
                                                    </select>
                                                </td>' .
                                        '<td>
                                                    <select class="form-control" id="bothFinish" name="bothFinish[]">
                                                        <option value="0">No</option>
                                                        <option value="5">Yes</option>
                                                    </select>
                                                </td>' .
                                        '<td>
                                               <select class="form-control" id="fastestPit" name="fastestPit[]">
                                                        <option value="0">No</option>
                                                        <option value="5">Yes</option>
                                                    </select>
                                        </td>' .
                                        '<td>  <input type="hidden" name="constructorName[]" value="' . $row["Name"] .'" ></td>' .
                                        '</tr>';
                                }
                                ?>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-10 col-md-9">
                                                        <button class="btn btn-success" name="submitButton" type="submit" >Submit Selections</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>


<script>
    var alreadySubmitted = <?php echo $numberofrows ?>;
    var driver1Price = <?php echo $driver1Price ?>;
    var driver2Price = <?php echo $driver2Price ?>;
    var constructor1Price = <?php echo $constructor1Price ?>;
    var constructor2Price = <?php echo $constructor2Price ?>;

    var teamnames = [];
    var races = [];
    var selectedTeam = "";
    var selectedTeamsCarryOver = 0;

    var constructorNames = [];
    var constructorPrices = [];
    var driverPrices = [];
    var driverNames = [];

    var selectedPrices = [];
    selectedPrices[0] = 0;
    selectedPrices[1] = 0;
    selectedPrices[2] = 0;
    selectedPrices[3] = 0;

    var startingWeeklyBudget;
    if (alreadySubmitted) {
        startingWeeklyBudget = driver1Price + driver2Price + constructor1Price + constructor2Price;
    }
    else
        startingWeeklyBudget = 55.00;


    var carryOver = document.getElementById('carriedOver').value;
    var elem = document.getElementById("remainingBudget");
    var totalAvailable;
    elem.value = (startingWeeklyBudget + carryOver * 1).toFixed(2); // multiply used to force integer addition instead of concatenation
    totalAvailable = elem.value;

    var firstSelected = null;
    var secondSelected = null;

    var firstConstructorSelected = null;
    var secondConstructorSelected = null;

    Update();

    function resetTeam()
    {
        document.getElementById("constructor1DropDown").value = "";
        document.getElementById("constructor2DropDown").value = "";
        document.getElementById("driver1DropDown").value = "";
        document.getElementById("driver2DropDown").value = "";
        selectedPrices[0] = 0;
        selectedPrices[1] = 0;
        selectedPrices[2] = 0;
        selectedPrices[3] = 0;
        if (alreadySubmitted) {
            startingWeeklyBudget = driver1Price + driver2Price + constructor1Price + constructor2Price;
        }
        else
            startingWeeklyBudget = 55.00;

        elem.value = (startingWeeklyBudget + carryOver * 1).toFixed(2);
    }

    function Update()
    {

        if (selectedPrices[0] == undefined) { selectedPrices[0] = 0; }
        if (selectedPrices[1] == undefined) { selectedPrices[1] = 0; }
        if (selectedPrices[2] == undefined) { selectedPrices[2] = 0; }
        if (selectedPrices[3] == undefined) { selectedPrices[3] = 0; }
        var newValue = parseFloat(totalAvailable - selectedPrices[0] - selectedPrices[1] - selectedPrices[2] - selectedPrices[3]).toFixed(2);

        document.getElementById("remainingBudget").value = newValue;

        if (newValue < 0)
        {
           // $('#submitButton').prop('disabled',true);
        }
        else
        {
            $('#submitButton').prop('disabled',false);
        }
    }

    $('#teamnameDropDown').change(function() {
        selectedTeam = $('#teamnameDropDown option:selected')
        Update();


    });

    $('#raceDropDown').change(function() {
        selectedTeam = $('#raceDropDown option:selected')
        Update();


    });

    $('#driver1DropDown').change(function() {
        var selectedValue = $('#driver1DropDown option:selected')
        var str = selectedValue.val();
        var result = str.split(",");
        selectedPrices[0] = result[1];
        Update();

        if (selectedValue.val() != "") {
            $('#driver2DropDown option[value="' + selectedValue.val() + '"]').remove();
        }
        else {
            selectedValue = null;
        }
        if (firstSelected != null) {
            $('#driver2DropDown').append($('<option>', { value : firstSelected.val() }).text(firstSelected.text()));

        }
        firstSelected = selectedValue;
    });

    $('#driver2DropDown').change(function() {
        var selectedValue = $('#driver2DropDown option:selected')

        var str = selectedValue.val();
        var result = str.split(",");
        selectedPrices[1] = result[1];
        Update();

        if (selectedValue.val() != "") {
            $('#driver1DropDown option[value="' + selectedValue.val() + '"]').remove();
        }
        else {
            selectedValue = null;
        }

        if (secondSelected != null) {
            $('#driver1DropDown').append($('<option>', { value : secondSelected.val() }).text(secondSelected.text()));

        }

        //save the currently selected value
        secondSelected = selectedValue;
    });

    $('#constructor1DropDown').change(function() {
        var selectedValue = $('#constructor1DropDown option:selected')

        var str = selectedValue.val();
        var result = str.split(",");
        selectedPrices[2] = result[1];
        Update();

        if (selectedValue.val() != "") {
            $('#constructor2DropDown option[value="' + selectedValue.val() + '"]').remove();
        }
        else {
            selectedValue = null;
        }
        if (firstConstructorSelected != null) {
            $('#constructor2DropDown').append($('<option>', { value : firstConstructorSelected.val() }).text(firstConstructorSelected.text()));

        }
        firstConstructorSelected = selectedValue;
    });

    $('#constructor2DropDown').change(function() {
        var selectedValue = $('#constructor2DropDown option:selected')

        var str = selectedValue.val();
        var result = str.split(",");
        selectedPrices[3] = result[1];
        Update();

        if (selectedValue.val() != "") {
            $('#constructor1DropDown option[value="' + selectedValue.val() + '"]').remove();
        }
        else {
            selectedValue = null;
        }

        if (secondConstructorSelected != null) {
            $('#constructor1DropDown').append($('<option>', { value : secondConstructorSelected.val() }).text(secondConstructorSelected.text()));

        }

        //save the currently selected value
        secondConstructorSelected = selectedValue;
    });

    $.getJSON("teams.php", function(data) {
        $.each(data, function(key,val) {
            teamnames.push(val.teamname);
            $("#teamnameDropDown").append($("<option />").val(val.teamname).text(val.teamname));
        })
    });

    $('#driverPointsRace').change(function() {
        var optionValue = $('#driverPointsRace').val();
        var trDriverHtml = "";
        var trConstructorHtml = "";
        $('#driverRacePointsTable').empty();
        $('#constructorRacePointsTable').empty();
        $.ajax({
            url:"GetDriverPointsForRace.php",
            type:"POST",
            dataType:'json',
            data: ({driverPointsRace: optionValue }),
            success: function(data) {
                $.each(data,  function(key,val) {
                    console.log(optionValue);
                    console.log(val[optionValue]);
                    trDriverHtml += '<tr><td>' + val.DriverName + '</td><td>' + val[optionValue] + '</td></tr>'

                });
                $('#driverRacePointsTable').append(trDriverHtml);

            }
        });
        $.ajax({
            url:"GetConstructorPointsForRace.php",
            type:"POST",
            dataType:'json',
            data: ({driverPointsRace: optionValue }),
            success: function(data) {
                $.each(data,  function(key,val) {
                    console.log(optionValue);
                    console.log(val[optionValue]);
                    trConstructorHtml += '<tr><td>' + val.ConstructorName + '</td><td>' + val[optionValue] + '</td></tr>'

                });
                $('#constructorRacePointsTable').append(trConstructorHtml);

            }
        });

    });


    $.getJSON("races.php", function(data) {
        $.each(data, function(key,val) {
            races.push(val.Country);
            $("#raceDropDown").append($("<option />").val(val.Country).text(val.Country));
        })
    });

    $.getJSON("drivers.php", function(data) {
        $.each(data, function(key,val) {
            driverNames.push(val.Name);
            driverPrices.push(val.Price);
            $("#driver1DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
            $("#driver2DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
        })
    });

    $.getJSON("constructors.php", function(data) {
        $.each(data, function(key,val) {
            constructorNames.push(val.Name);
            constructorPrices.push(val.Price);
            $("#constructor1DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
            $("#constructor2DropDown").append($("<option />").val(val.Name + ", " + val.Price).text(val.Name + " £" + val.Price));
        })
    });

    function getTeamSubmissions() {
       // alert("insideGetTeamSubmission");
        $.getJSON("getTeamSelectionsForRace.php", function(data) {
         //   alert("Data is" + data);
            $.each(data, function(key,val) {
               // alert("inside");
            })
        });
    }
</script>



<?php
include 'includes/footer.php';
?>
