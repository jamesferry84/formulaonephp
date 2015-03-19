<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';

session_destroy();
header("location:login.php");

include 'includes/footer.php';
