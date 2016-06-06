<?php
include 'init.php';
//include 'functions/general.php';

?>

<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">F1 Predictor 2016</a>

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class = "nav navbar-nav navbar-right">
                <li<?php if ($active == 'home') {echo 'class="active"';} ?>><a href="index.php">Home</a></li>
                <li<?php if ($active == 'rules') {echo 'class="active"';} ?>><a href="rules.php">Rules</a></li>
                <li<?php if ($active == 'profile') {echo 'class="active"';} ?>><a href="profile.php">Profile</a></li>
                <?php
                if ($_SESSION["admin"] == 1)
                {
                    echo "<li><a href='admin.php'>Admin</a></li>";
                }
                ?>

                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>