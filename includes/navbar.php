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
        <a href="index.php" class="navbar-brand"><span id="preText"></span><?php echo $country ?><span id="clock"></span></a>

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
                <?php
                if ($_SESSION["admin"] == 1)
                {
                    echo "<li ";if ($active == 'admin') {echo 'class="active"';};
                    echo ">";
                    echo "<a href='admin.php'>Admin</a>";
                    echo "</li>";
                }
                ?>
                <li>
                    <a href="logout.php">Log Out (<?php echo $_SESSION["username"]?>)</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="nextrace" style="display: none">
    <?php

    $sql = "select * from racecalendar where Date >= CURDATE() order by date LIMIT 0,1";
    $queryResult = $conn->query($sql);
    $numrows=mysqli_num_rows($queryResult);

    while($row = mysqli_fetch_assoc($queryResult))
    {
        $originalDate = $row["Date"];
        $newDate = date("Y/m/d H:i:s", strtotime($originalDate));
        //echo $row["Date"];
        echo $newDate;
    }
    ?>
</div>
<script>


    var div = document.getElementById("nextrace");
    var timeToNextRace = div.textContent;
    var nowDate = new Date();
    var date = new Date(timeToNextRace);
    var hasAdminOpenedSubmissions;
    date.setDate(date.getDate()-2);

    $(function() {
        $.ajax({
            url : "textdata/admin.txt",
            dataType: "text",
            success : function (result) {
                hasAdminOpenedSubmissions = result;
                var todayDate = new Date();
                //date.setDate(date.getDate()-2);
                var isSubmissionClosed = false;

                if (hasAdminOpenedSubmissions == 1) {
                    isSubmissionClosed = false;
                }

                if (todayDate >= date || hasAdminOpenedSubmissions == 0) {
                    isSubmissionClosed = true;
                }

                if (isSubmissionClosed)
                {
                    $('#preText').html("Current Race: ");
                    $('#clock').html(" | Submissions CLOSED");
                }
                else
                {
                    $('#clock').countdown(date, function(event) {
                        $('#preText').html("Next Race: ");
                        $(this).html(" | Submit Team before: " + event.strftime('%D days %H:%M:%S'));
                    });
                }
            }
        });
    });
</script>