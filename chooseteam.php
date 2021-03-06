<?php
include 'init.php';
$active="chooseTeam";
include 'includes/header.php';
include 'includes/navbar.php';
unset($_SESSION["passwordErrorMessage"]);
unset($_SESSION["passwordSuccessMessage"]);
$username = $_SESSION["username"];
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



?>

<div class="container">
    <div class = "row">
        <div class = "col-lg-12 col-md-8 col-sm-8">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <h3>Team Choices for <?php echo $country ?></h3>
                        <div class="well">
                            <div class="alert-danger">
                                <?php

                                if (empty($_SESSION['submitErrorMessage']) == false) {
                                    echo $_SESSION["submitErrorMessage"];
                                }
                                ?>
                        </div>
                    </div>
                    <form class="form-horizontal" action="submit.php" method="post" onsubmit="return confirm('Are you sure you want to submit this team?');">
                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver1DropDown" name="driver1" required="required" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver2DropDown" name="driver2" required="required">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor1DropDown" name="constructor1" required="required">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor2DropDown" name="constructor2" required="required" >
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
                            <?php
                            $sql2 = "select * from submissions where username = '{$_SESSION['username']}' and Country = '$country'";
                            $queryResult2 = $conn->query($sql2);
                            $numrows2=mysqli_num_rows($queryResult2);
                            $row2 = mysqli_fetch_assoc($queryResult2)

                            ?>
                            <label for = "jokerUsed" class = "col-lg-3 control-label">Use Joker? (Jokers available <?php echo (5 - ($row["jokers"] - $row2["joker"])) ?>)</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="jokerUsed" name="jokerUsed" >
                                    <option selected value="0">No</option>
                                    <?php if(($row["jokers"] - $row2["joker"]) < 5){echo '<option value="1">Yes</option>';}?>
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
                            <label for = "carriedOver" class = "col-lg-3 control-label">Carried Over To Next Race:</label>
                            <div class = "col-lg-5">
                                <input type = "text" class="form-control" id="carriedOver" name="carriedOver" readonly value=<?php echo $row["carryover"] ?>  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "remainingBudget" class = "col-lg-3 control-label">Remaining Budget For Current Race:</label>
                            <div class = "col-lg-5">
                                <input type = "text" class="form-control" id="remainingBudget" name="remainingBudget" readonly />
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $sql = "select Country, driver1, driver2, constructor1, constructor2, joker from submissions where UserName = '$username' order by date desc  ";
                    $result = $conn->query($sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo'<tr>' .
                            '<td>' . $row["Country"] . '</td>' .
                            '<td>' . $row["driver1"] . '</td>' .
                            '<td>' . $row["driver2"] . '</td>' .
                            '<td>' . $row["constructor1"] . '</td>' .
                            '<td>' . $row["constructor2"] . '</td>' .
                            '<td>' . $row["joker"] . '</td>' .
                            '</tr>';
                    }
                    ?>

                </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>



<div id="nextrace" style="display: none">
    <?php
    $today = date("y-m-d");
    $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,1";
    $queryResult = $conn->query($sql);
    $numrows=mysqli_num_rows($queryResult);

    while($row = mysqli_fetch_assoc($queryResult))
    {
        echo $row["Date"];
    }
    ?>
</div>

<div id="nextpractice" style="display: none">
    <?php
    $today = date("y-m-d");
    $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,1";
    $queryResult = $conn->query($sql);
    $numrows=mysqli_num_rows($queryResult);

    while($row = mysqli_fetch_assoc($queryResult))
    {
        echo $row["FirstPractice"];
    }
    ?>
</div>



<script>

    var alreadySubmitted = <?php echo $numberofrows ?>;
    var driver1Price = <?php echo $driver1Price ?>;
    var driver2Price = <?php echo $driver2Price ?>;
    var constructor1Price = <?php echo $constructor1Price ?>;
    var constructor2Price = <?php echo $constructor2Price ?>;

    var div = document.getElementById("nextpractice");
    var timeToNextPractice = div.textContent;
    timeToNextPractice = timeToNextPractice.replace(/-/g, ' ');

    var date = new Date(timeToNextPractice);
    var todayDate = new Date();
    var isSubmissionClosed = false;


    $(function() {

        var hasAdminOpenedSubmissions;
        $.ajax({
            url : "textdata/admin.txt",
            dataType: "text",
            success : function (result) {
                hasAdminOpenedSubmissions = result;


                if (hasAdminOpenedSubmissions == 1) {
                   // alert("yes admin opened");
                    isSubmissionClosed = false;
                }

                if (todayDate >= date || hasAdminOpenedSubmissions == 0) {
                  //  alert("submissions are closed")
                    isSubmissionClosed = true;
                }

                if (isSubmissionClosed)
                {
                    var element = document.getElementById('submitButton');
                    element.setAttribute('disabled', 'false');
                    var element = document.getElementById('resetButton');
                    element.setAttribute('disabled', 'disabled');
                 //   $('#submitButton').prop('disabled',true);
                 //   $('#resetButton').prop('disabled',true);
                }
                else
                {
                    var element = document.getElementById('submitButton');
                    element.removeAttribute('disabled');
                    var element = document.getElementById('resetButton');
                    element.removeAttribute('disabled');
//                    $('#submitButton').prop('disabled',false);
//                    $('#resetButton').prop('disabled',false);
                }

            }
        });


    });

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

//    if (carryOver < startingWeeklyBudget)
//    {
//        elem.value = (startingWeeklyBudget + carryOver * 1); // multiply used to force integer addition instead of concatenation
//        totalAvailable = elem.value;
//    }
//    else
//    {
//        elem.value = carryOver;
//        totalAvailable = carryOver;
//    }
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
            $('#submitButton').prop('disabled',true);
        }
        else
        {
            if (todayDate < date || hasAdminOpenedSubmissions == 1) {
                $('#submitButton').prop('disabled', false);
            }
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
</html>


