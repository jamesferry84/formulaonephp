<?php

include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
include 'functions/general.php';
$active="home";



if (empty($_POST) === false) {
    $teamname = $_POST["teamname"];
    $getUsername = "select UserName from users WHERE teamname='$teamname'";
    $result = $conn->query($getUsername);
    $rowresult = mysqli_fetch_assoc($result);
    $username = $rowresult["UserName"];
    $driver1 = $_POST["driver1"];
    $driver2 = $_POST["driver2"];
    $constructor1 = $_POST["constructor1"];
    $constructor2 = $_POST["constructor2"];
    $joker = $_POST["jokerUsed"];
    $carryOver = $_POST["remainingBudget"];

    $driver1parts = explode(',', $driver1);
    $driver2parts = explode(',', $driver2);
    $constructor1parts = explode(',', $constructor1);
    $constructor2parts = explode(',', $constructor2);

    $driver1 = $driver1parts[0];
    $driver2 = $driver2parts[0];
    $constructor1 = $constructor1parts[0];
    $constructor2 = $constructor2parts[0];

    unset($_SESSION["submitErrorMessage"]);

    if (empty($driver1) === true || empty($driver2) === true || empty($constructor1) === true || empty($constructor2) === true) {
        $errors[] = "Submit Error: You need to select Two Drivers and Two Constructors";
    }
    else {
        $today = date("y-m-d");
        $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,1";
        $queryResult = $conn->query($sql);
        $numrows=mysqli_num_rows($queryResult);
        $country = "";

        while($row = mysqli_fetch_assoc($queryResult))
        {
            $country =  $row["Country"];
        }

        $balance = $_POST["remainingBudget"];

        $query = "INSERT INTO `submissions` (`UserName`, `driver1`, `driver2`, `constructor1`, `constructor2`, `joker`, `Country`, `BudgetRollover`)
                  VALUES ('$username', '$driver1', '$driver2', '$constructor1', '$constructor2', '$joker', '$country', '$carryOver') ON DUPLICATE KEY UPDATE
                  driver1 = VALUES(driver1),
                  driver2 = VALUES(driver2),
                  constructor1 = VALUES(constructor1),
                  constructor2 = VALUES(constructor2),
                  joker = VALUES(joker)";

        $conn->query($query);


        if ($joker == 1)
        {
            $sql="SELECT * FROM users WHERE UserName='$username'";
            $result = $conn->query($sql);


            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $numJokers = $row["jokers"] + 1;

                $query = "UPDATE `users` SET `jokers`='$numJokers',`carryover`='$carryOver' WHERE `UserName`='$username'";
                $conn->query($query);
            }
        }
        else
        {
            $query = "UPDATE `users` SET carryover='$carryOver' WHERE `UserName`='$username'";
            $conn->query($query);
        }
    }

    if (empty($errors) === false) {
        $_SESSION["submitErrorMessage"] = output_errors($errors);
        header("location:chooseteam.php?");
    }


}
else
{
    header("location:chooseteam.php?");
}
?>
<div class="container">
    <div class=" col-lg-12 col-md-12 col-sm-12">
        <h5 class="alert-success">Thank You. Your selections have been accepted and are displayed below.</h5>
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
                    <th>Carried Over</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $country; ?></td>
                    <td><?php echo $driver1; ?></td>
                    <td><?php echo $driver2; ?></td>
                    <td><?php echo $constructor1; ?></td>
                    <td><?php echo $constructor2; ?></td>
                    <td><?php echo $joker; ?></td>
                    <td><?php echo '£' . number_format($balance,2,'.',''); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
