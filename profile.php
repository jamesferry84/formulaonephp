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
        <div class = "col-lg-12 col-md-12 col-sm-12">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <h3>Profile</h3>
                    </div>

                    <div id="emailBox" style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-success" >
                            <div class="panel-heading">
                                <div class="panel-title">Team Details</div>
                            </div>

                            <div class="panel-body" >
                                <form id="emailUpdateForm" class="form-horizontal" action="updateEmail.php" method="post" onsubmit='return checkEmail()'>

                                    <div class="form-group" style="margin-top:20px;">
                                        <label for="teamname" class="col-md-3 control-label">Team Name:</label>
                                        <div class="col-md-9">
                                            <input id="login-username" type="email" class="form-control" name="teamname" placeholder="<?php echo $teamName?>" disabled="disabled"  >
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:20px;">
                                        <label for="email" class="col-md-3 control-label">Email:</label>
                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email" placeholder="<?php echo $emailAddress?>"   >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-success" name="updateEmail" value="Update Email">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="panel-body" >
                                <form id="passwordUpdateForm" class="form-horizontal" action="updatePAssword.php" method="post" onsubmit='return checkPassword()'>

                                    <div class="form-group" style="margin-top:20px;">
                                        <label for="currentPassword" class="col-md-3 control-label">Current Password:</label>
                                        <div class="col-md-9">
                                            <input id="currentPassword" type="password" class="form-control" name="currentPassword" required="required" >
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:20px;">
                                        <label for="newPassword" class="col-md-3 control-label">New Password:</label>
                                        <div class="col-md-9">
                                            <input id="newPassword" type="password" class="form-control" name="newPassword" required="required" >
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:20px;">
                                        <label for="confrimNewPassword" class="col-md-3 control-label">Confirm New Password:</label>
                                        <div class="col-md-9">
                                            <input id="confirmNewPassword" type="password" class="form-control" name="confirmNewPassword" required="required" >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-success" name="updatePassword" value="Update Password">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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