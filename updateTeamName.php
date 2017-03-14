<?php
include 'init.php';
include 'functions/general.php';

unset($_SESSION["teamnameErrorMessage"]);
unset($_SESSION["teamnameSuccessMessage"]);

$username = $_SESSION["username"];
$newTeamname = $_POST["teamname"];

if (empty($username) === true || empty($teamname) === true ) {
    $_SESSION["teamnameErrorMessage"] = "Team Name Update Error: Team Name not filled out";
    header("location:profile.php?");
    die();
}

if (team_exists($newTeamname) === true) {
    $_SESSION["teamnameErrorMessage"] = " That team name has already been registered";
    header("location:profile.php?");
    die();
}

$sql = "UPDATE users SET teamname='$newTeamname' WHERE UserName='$username'";
$queryResult = $conn->query($sql);
header("location:profile.php?");


