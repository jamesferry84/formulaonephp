<?php
//unset($_SESSION['username']);
//session_destroy();
session_start();
setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
header("location:login.php");

