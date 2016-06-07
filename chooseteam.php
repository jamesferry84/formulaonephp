<?php
$active="chooseTeam";
include 'includes/header.php';
include 'includes/navbar.php';
$username = $_SESSION["username"];
?>

<div class="container">
    <div class = "row">
        <div class = "col-lg-8 col-md-8 col-sm-8">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <h3>Team Choices</h3>
                        <div class="well">
                            <div class="alert-danger">
                                <?php

                                if (empty($_SESSION['submitErrorMessage']) == false) {
                                    echo $_SESSION["submitErrorMessage"];
                                }
                                ?>
                        </div>
                    </div>
                    <form class="form-horizontal" action="submit.php" method="post">
                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver1DropDown" name="driver1" required="required" >
                                    <option value="">First Driver</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "driver" class = "col-lg-3 control-label">Driver 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="driver2DropDown" name="driver2" required="required">
                                    <option value="">Second Driver</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 1:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor1DropDown" name="constructor1" required="required">
                                    <option value="">First Constructor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "constructor" class = "col-lg-3 control-label">Constructor 2:</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="constructor2DropDown" name="constructor2" required="required" >
                                    <option value="">Second Constructor</option>
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
                            <label for = "jokerUsed" class = "col-lg-3 control-label">Use Joker? (Jokers available <?php echo $row["jokers"] ?>)</label>
                            <div class = "col-lg-5">
                                <select class="form-control" id="jokerUsed" name="jokerUsed" <?php if($row["jokers"] <= 0){echo "disabled";}?>>
                                    <option value="0">No</option>
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
                                <input type = "text" class="form-control" id="carriedOver" name="carriedOver" placeholder="Hint Text" readonly value=<?php echo $row["budget"] ?>  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for = "remainingBudget" class = "col-lg-3 control-label">Remaining Budget:</label>
                            <div class = "col-lg-5">
                                <input type = "text" class="form-control" id="remainingBudget" name="remainingBudget" placeholder="Hint Text" readonly />
                            </div>
                        </div>

                        <div class="form-horizontal">
                            <a href="index.php" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-success" id="submitButton" type="submit">Submit Team</button>
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




</body>


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

    var startingWeeklyBudget = 55.00;

    var carryOver = document.getElementById('carriedOver').value;
    var elem = document.getElementById("remainingBudget");
    var totalAvailable;

    if (carryOver < startingWeeklyBudget)
    {
        elem.value = (startingWeeklyBudget + carryOver * 1); // multiply used to force integer addition instead of concatenation
        totalAvailable = elem.value;
    }
    else
    {
        elem.value = carryOver;
        totalAvailable = carryOver;
    }


    var firstSelected = null;
    var secondSelected = null;

    var firstConstructorSelected = null;
    var secondConstructorSelected = null;

    function Update()
    {
        var newValue = parseFloat(totalAvailable - selectedPrices[0] - selectedPrices[1] - selectedPrices[2] - selectedPrices[3]).toFixed(2);
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
</html>


