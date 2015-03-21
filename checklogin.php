<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
include 'functions/general.php';

if (empty($_POST) === false) {

    unset($_SESSION["loginErrorMessage"]);
    unset($_SESSION["registerErrorMessage"]);
    unset($_SESSION["registerSuccessMessage"]);

    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $encryptedPass = md5($password);
    if (empty($username) === true || empty($password) === true) {
        $errors[] = "You need to enter a username and password";
    } else if (username_pass_correct($username, $encryptedPass) === false) {
        $errors[] = "Username and password combination is incorrect";
    } else if (user_exists($username) === false) {
        $errors[] = "We cant find that username. Have you registered?";
    } else if (user_active($username) === false) {
        $errors[] = "Your account has not been activated by our admins yet";
    } else {

        check_login($username, $encryptedPass);
    }


    if (empty($errors) === false) {
        $_SESSION["loginErrorMessage"] = output_errors($errors);
        header("location:login.php?");
    }

}

