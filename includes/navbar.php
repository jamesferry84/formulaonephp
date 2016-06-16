<?php
include 'init.php';
//include 'functions/general.php';
$sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);

while($row = mysqli_fetch_assoc($queryResult))
{
    $country =  $row["Country"];
}
?>

<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <a href="index.php" class="navbar-brand">Next Race: <?php echo $country; ?> | Submit Team by:  <span id="clock"></span></a>

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class = "nav navbar-nav navbar-right">
                <li <?php if ($active == 'home') {echo 'class="active"';} ?>>
                    <a href="index.php">Home</a>
                </li>
                <li <?php if ($active == 'chooseTeam') {echo 'class="active"';} ?>>
                    <a href="chooseteam.php">Choose Team</a>
                </li>
                <li <?php if ($active == 'statistics') {echo 'class="active"';} ?>>
                    <a href="statistics.php">Stats</a>
                </li>
                <li <?php if ($active == 'rules') {echo 'class="active"';} ?>>
                    <a href="rules.php">Rules</a>
                </li>
                <li <?php if ($active == 'profile') {echo 'class="active"';} ?>>
                    <a href="profile.php">Profile</a>
                </li>
                <li>

                    <a href="logout.php">Log Out (<?php echo $_SESSION["username"]?>)</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="nextrace" style="display: none">
    <?php
    $today = date("y-m-d");
    $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,1";
    $queryResult = $conn->query($sql);
    $numrows=mysqli_num_rows($queryResult);

    while($row = mysqli_fetch_assoc($queryResult))
    {
        echo $row["Date"];
    }
    ?>
</div>
<script>

    var div = document.getElementById("nextrace");
    var timeToNextRace = div.textContent;
    var date = new Date(timeToNextRace);
    date.setDate(date.getDate()-2);
    $('#clock').countdown(date, function(event) {
        $(this).html(event.strftime('%D days %H:%M:%S'));
        // var totalHours = event.offset.totalDays * 24 + event.offset.hours;
        // $(this).html(event.strftime(totalHours + ' hr %M min %S sec'));
    });
</script>