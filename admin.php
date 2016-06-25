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

if ($_SESSION["admin"] == 1)
{


}
else{
    header("location:index.php");
}
?>

<div class="container">

    <div class = "row">
        <div class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <h3>New User Approvals</h3>
                    </div>
                    <div class="table-responsive ">
                        <form action="submitApprovals.php" method="post">
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
                            <button class="btn btn-success" name="submitButton" type="submit">Submit Selections</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "row">
        <div class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <?php
                        $sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
                        $queryResult = $conn->query($sql);
                        $numrows=mysqli_num_rows($queryResult);

                        while($row = mysqli_fetch_assoc($queryResult))
                        {
                            $country =  $row["Country"];
                        }

                        ?>
                        <h3>Submissions for -  <?php echo $country ?> </h3>
                    </div>
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

                                   $query = "SELECT u.teamname, s.Driver1, s.Driver2, s.Constructor1,s.Constructor2, s.joker FROM `users` u left join `submissions` s on u.username = s.username  AND s.country = '$country'";
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
                                            '</tr>';
                                    }
                                    ?>
                                </tr>
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
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


</div>

<?php
include 'includes/footer.php';
?>
