<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
if ($_SESSION["admin"] == 1)
{
    // DO NOTHING
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
                                        '<td>' . $row["Email"] . '</td>' .
                                        '<td>' . $row["teamname"] . '</td>' .
                                        '<td><input type="submit" class="btn btn-success" name="Submit" value="Approve"></td>' .
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
