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
        <div class=" col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert-danger">
            <?php

            if (empty($_SESSION['passwordErrorMessage']) == false) {
                echo $_SESSION["passwordErrorMessage"];
            }
            ?>
        </div>
        <div class=" col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert-success">
            <?php

            if (empty($_SESSION['passwordSuccessMessage']) == false) {
                echo $_SESSION["passwordSuccessMessage"];
            }

            ?>
        </div>
        <div class = "row">
            <div class = "col-lg-12 col-md-12 col-sm-12">
                <div class = "panel panel-default">
                    <div class = "panel-body">
                        <div class="page-header">
                            <h3>Profile</h3>
                        </div>
                        <form class="form-horizontal" action="updateEmail.php" method="post" onsubmit='return checkEmail()'>

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

                            </div>
                        </form>

                        <form class="form-horizontal" action="updatePassword.php" method="post" onsubmit='return checkPassword()'>
                            <div class="table-responsive  col-lg-12 col-md-12 col-sm-12 ">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <td class="success">Current Password:</td>
                                        <td><input type="password" class="form-control" name="currentPassword" id="currentPassword" required="required"></td>
                                    </tr>
                                    <tr>
                                        <td class="success">New Password:</td>
                                        <td> <input type="password" class="form-control" name="newPassword" id="newPassword"  required="required"></td>
                                    </tr>
                                    <tr>
                                        <td class="success">Confirm New Password:</td>
                                        <td> <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword"  required="required"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-md-offset-9 col-sm-offset-9 col-lg-offset-9col-lg-9 col-md-9 col-sm-9">
                                        <input type="submit" class="btn btn-success" name="Submit" value="Update Password">
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkEmail() {
            var currentEmail = "<?php echo $emailAddress?>";
            var newEmail = document.getElementById("email").value;
            var lowerNewEmail = newEmail.toLowerCase();
            var lowerCurrentEmail = currentEmail.toLowerCase();

            if (lowerCurrentEmail == lowerNewEmail)
            {
                alert("Cannot use the email address already registered")
                return false;
            }

            return confirm("This will update your email to: " + lowerNewEmail + " are you sure?");
        }

        function checkPassword() {
            var newPassword = document.getElementById("newPassword").value;
            var confirmNewPassword = document.getElementById("confirmNewPassword").value;

            if (newPassword == confirmNewPassword)
                return true;

            alert("New Password and Confirm New Password do not match. Password not updated");
            return false;
        }


    </script>

<?php
include 'includes/footer.php';
?>