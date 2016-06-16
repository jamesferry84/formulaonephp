<?php
include 'init.php';
$active="profile";
include 'includes/header.php';
include 'includes/navbar.php';
$username = $_SESSION["username"];
?>
<?php
$sql = "select teamname, Email from users where UserName = '$username' ";
$result = $conn->query($sql);
while($row = mysqli_fetch_assoc($result))
{
    $teamName = $row["teamname"];
    $emailAddress = $row["Email"];
}
?>

    <div class="container">
        <div class = "row">
            <div class = "col-lg-12 col-md-12 col-sm-12">
                <div class = "panel panel-default">
                    <div class = "panel-body">
                        <div class="page-header">
                            <h3>Profile</h3>
                        </div>
                        <div class="table-responsive  col-lg-12 col-md-12 col-sm-12 ">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <td class="success">Team Name:</td>
                                    <td><?php echo $teamName?></td>
                                </tr>
                                <tr>
                                    <td class="success">Players registered email:</td>
                                    <td><?php echo $emailAddress?></td>
                                </tr>
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