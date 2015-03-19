<?php

//require 'template.html';
include 'init.php';
include 'functions/general.php';
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
$alreadySubmitted = 0;
//$alreadySubmitted = doesSubmissionExistForUser($_SESSION["username"], $country);

/**
 * Created by PhpStorm.
 * User: James
 * Date: 09/03/2015
 * Time: 19:27
 */



?>
<!doctype html>
<html lang="en">
<head>
    <title>Formula 1 Predictor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

</head>
<body>
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">F1 Predictor 2015 <?php echo " - " . $_SESSION["username"] ?></a>

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class = "nav navbar-nav navbar-right">
                <li class = "active"><a href="index.php">Home</a></li>

                <li><a href="rules.php">Rules</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Log Out</a></li>
                <!--
               <li><a href="login.html">Log In</a></li>
               <li><a href="Register.html">Register</a></li>
               -->
            </ul>
        </div>
    </div>
</div>




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
                    $sql = "select * from users LIMIT 0,3";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);

                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        ?>
                        <tr>
                            <td> <?php echo $row["UserName"]?></td>
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


        <div class="col-md-3">

        </div>

        <div class="col-md-3">

        </div>
    </div>
</div>




<div class="modal fade" id="chooseteam" role="dialog">
    <div class ="modal-dialog">
        <div class = "modal-content">
            <form class="form-horizontal" action="submit.php" method="post">
                <div class="modal-header">
                    <h4>Choose Team</h4>
                </div>
                <div class = "modal-body">


                    <div class="form-group">
                        <label for = "driver" class = "col-lg-3 control-label">Driver 1:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="driver1DropDown" name="driver1" required="true">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "driver" class = "col-lg-3 control-label">Driver 2:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="driver2DropDown" name="driver2" required="true">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "constructor" class = "col-lg-3 control-label">Constructor 1:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="constructor1DropDown" name="constructor1" required="true">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "constructor" class = "col-lg-3 control-label">Constructor 2:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="constructor2DropDown" name="constructor2" required="true">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="jokerUsed" value="1">
                            Use Joker?
                        </label>
                    </div>


                    <div class="form-group">
                        <?php
                        $sql = "select * from users where username = '{$_SESSION['username']}'";
                        $queryResult = $conn->query($sql);
                        $numrows=mysqli_num_rows($queryResult);

                        $row = mysqli_fetch_assoc($queryResult)

                        ?>
                        <label for = "carriedOver" class = "col-lg-5 control-label">Carried Over:</label>
                        <div class = "col-lg-5">
                            <input type = "text" class="form-control" id="carriedOver" placeholder="Hint Text" value=<?php echo $row["budget"] ?> />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "remainingBudget" class = "col-lg-5 control-label">Remaining Budget:</label>
                        <div class = "col-lg-5">
                            <input type = "text" class="form-control" id="remainingBudget" name="remainingBudget" placeholder="Hint Text" />
                        </div>
                    </div>
                </div>

                <div class = "modal-footer">
                    <a href="#" class="btn btn-danger" data-dismiss = "modal">Cancel</a>
                    <button class="btn btn-success" id="submitButton" type="submit">Submit Selection</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class = "navbar navbar-default navbar-fixed-bottom">
    <div class = "container">
        <p class = "navbar-text pull-left">Please send e-mail to <a href="mailto:meno38@sky.com" data-toggle="modal">meno38@sky.com</a> to be registered to this website</p>
    </div>
</div>
<script>

    var constructorNames = [];
    var constructorPrices = [];
    var driverPrices = [];
    var driverNames = [];

    var selectedPrices = [];
    selectedPrices[0] = 0;
    selectedPrices[1] = 0;
    selectedPrices[2] = 0;
    selectedPrices[3] = 0;

    var myBudget = document.getElementById('carriedOver').value;
    var elem = document.getElementById("remainingBudget");
    elem.value = myBudget;

    var firstSelected = null;
    var secondSelected = null;

    var firstConstructorSelected = null;
    var secondConstructorSelected = null;

    function Update()
    {
        var newValue = parseFloat(myBudget - selectedPrices[0] - selectedPrices[1] - selectedPrices[2] - selectedPrices[3]).toFixed(2);
        document.getElementById("remainingBudget").value = newValue;

        if (newValue < 0)
        {
            $('#submitButton').prop('disabled',true);
        }
        else
        {
            $('#submitButton').prop('disabled',false);
        }
    }

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
</script>