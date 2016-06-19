<?php
include 'init.php';
$active="admin";
include 'includes/header.php';
include 'includes/navbar.php';

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

                                   $query = "SELECT u.teamname, s.Driver1, s.Driver2, s.Constructor1,s.Constructor2 FROM `users` u left join `submissions` s on u.username = s.username  AND s.country = '$country'";
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
</div>

<?php
include 'includes/footer.php';
?>
