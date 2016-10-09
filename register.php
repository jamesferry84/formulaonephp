<?php
include 'init.php';
include 'functions/general.php';

if (empty($_POST) === false) {

    unset($_SESSION["registerErrorMessage"]);
    unset($_SESSION["loginErrorMessage"]);
    unset($_SESSION["registerSuccessMessage"]);

    $email = $_POST["email"];
    $password =$_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $teamname = $_POST['teamname'];
    $username = $firstname.$lastname;

    if (empty($email) === true || empty($password) === true || empty($firstname) === true || empty($lastname) === true || empty($teamname) === true) {
        $errors[] = "Register Error: All fields not filled out";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Register Error: That email address is not a valid format";
    }
    else if (user_exists($email) === true) {
        $errors[] = "Register Error: That email has already been registered";
    }
    else if (team_exists($teamname) === true) {
        $errors[] = "Register Error: That team name has already been registered";
    }
    else {
        $encryptedPass = md5($password);
         if (register_user($email, $encryptedPass, $username, $teamname) == true)
         {
             $_SESSION["registerSuccessMessage"] = "Thank you we have received your registration.";
             header("location:login.php?");
         }
    }

    if (empty($errors) === false) {
        $_SESSION["registerErrorMessage"] = output_errors($errors);
        header("location:login.php?");
    }

}
else {
    header("location:login.php?");
}

