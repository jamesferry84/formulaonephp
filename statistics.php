<?php
include 'init.php';
$active="statistics";
include 'includes/header.php';
include 'includes/navbar.php';
$username = $_SESSION["username"];
?>

    <div class="container">
        <div class = "row">
            <div class="table-responsive  col-lg-12">
                <table class="table table-bordered text-center">
                    <tr class ="success">
                        <td>+/-</td><td>Rank</td><td>Player Name</td><td>Team Name</td><td>Player Score</td><td>Jokers Played</td><td>Budget Rollover</td>
                    </tr>
                    <?php
                    $today = date("y-m-d");
                    $sql = "select * from users order by points desc LIMIT 0,3";
                    $queryResult = $conn->query($sql);
                    $numrows=mysqli_num_rows($queryResult);
                    $rank = 0;
                    while($row = mysqli_fetch_assoc($queryResult))
                    {
                        $rank++;
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $rank?></td>
                            <td><?php echo $row["UserName"]?></td>
                            <td><?php echo $row["teamname"]?></td>
                            <td><?php echo $row["points"]?></td>
                            <td> <?php echo $row["jokers"]?></td>
                            <td> <?php echo $row["budget"]?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>