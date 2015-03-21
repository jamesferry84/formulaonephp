<?php
include 'init.php';
include 'functions/general.php';

if (empty($_POST) === false) {

    unset($_SESSION["registerErrorMessage"]);
    unset($_SESSION["loginErrorMessage"]);
    unset($_SESSION["registerSuccessMessage"]);

    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST['password']);
    $firstname = sanitize($_POST['firstname']);
    $lastname = sanitize($_POST['lastname']);
    $teamname = sanitize($_POST['teamname']);
    $username = $firstname.$lastname;

    if (empty($email) === true || empty($password) === true || empty($firstname) === true || empty($lastname) === true || empty($teamname) === true) {
        $errors[] = "Register Error: All fields not filled out";
    } else if (user_exists($email) === true) {
        $errors[] = "Register Error: That email is already taken";
    } else {
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

