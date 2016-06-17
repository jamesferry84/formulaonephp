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
                        <form class="form-horizontal" action="updateEmail.php" method="post" onsubmit='return confirm("This will de-activate the current email address:  <?php echo $emailAddress ?>  and the new address:  " + document.getElementById("email").value + "  will need to be activated");'>
                            <div class="table-responsive  col-lg-12 col-md-12 col-sm-12 ">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <td class="success">Team Name:</td>
                                        <td><?php echo $teamName?></td>
                                    </tr>
                                    <tr>
                                        <td class="success">Email:</td>
                                        <td> <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $emailAddress?>" required="required"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-md-offset-9 col-sm-offset-9 col-lg-offset-9col-lg-9 col-md-9 col-sm-9">
                                        <input type="submit" class="btn btn-success" name="Submit" value="Update Email">
                                    </div>
                                </div>
                                <!--
<button class="btn btn-success" onclick='alert("Are you sure? \n This will de-activate the current email address <?php echo $emailAddress ?> and the new address " + document.getElementById("email").value + " will need to be activated")'>Update Email</button>
                            -->
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>