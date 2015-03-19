<?php
include 'init.php';
include 'includes/header.php';
include 'includes/navbar.php';
include 'functions/general.php';

?>

<div class="container">
    <div class = "row">
        <div class = "col-lg-12">
            <div class = "panel panel-default">
                <div class = "panel-body">
                    <div class="page-header">
                        <h3>HOW TO PLAY</h3>
                    </div>
                    <ol>
                        <li>Register your intention to join the league by emailing <a href="mailto:meno38@sky.com">meno38@sky.com</a>. You will receive a welcome email and how to pay your &pound;3 entry fee to the League Organiser.</li>
                        <li>You are allocated an operating budget for your team during the season - you can spend up to &pound;55 million on your team's Line-up with each Constructor and Driver incurring a cost according to the current prices shown below:</li>

                        <div class="table-responsive  col-lg-12">
                            <table class="table table-bordered text-center">
                                <tr class ="success">

                                    <td>Driver</td>
                                    <td>Price</td>
                                    <td>Constructor</td>
                                    <td>Price</td>
                                </tr>
                                <?php
                                $sql = "select d.name,d.price,t.name as teamname,t.price as teamprice from driver d join team t on d.team = t.name order by d.price DESC";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                   echo'<tr>' .
                                           '<td>' . $row["name"] . '</td>' .
                                           '<td>' . $row["price"] . '</td>' .
                                           '<td>' . $row["teamname"] . '</td>' .
                                           '<td>' . $row["teamprice"] . '</td>' .
                                       '</tr>';
                                }
                                ?>

                            </table>
                        </div>
                        <li>Unspent team budgets from one Race  weekend will be rolled over into the next race.</li>
                        <li>Driver and Constructor prices will be recalculated after each race, based on their performance over a rolling 12 month period. For example, once the Australian G.P. is complete each Driver's and Team's price for the next race will be re-calculated on the Total 2014 season points scored minus the 2014 Australian GP plus the 2015 Australian GP points, and so on after each race.</li>
                        <li>You cannot submit the same Driver or Constructor more than once for a race, e.g. choose Alonso as your Driver twice for the same Race weekend.</li>
                        <li>Driver and Constructor prices will be calculated using the points they have scored in OUR league over the previous 12 months, rather than only the points they have earned in the official F1 championship.</li>
                        <li>Each team will be given 5 'Jokers' to play on any race over the season, an increase from the 4 Jokers available in 2014. A Joker played before a race weekend starts will double the points scored by your team over the weekend. There are no double points being scored in the final Race of the season at Abu Dhabi this year. Thankfully.</li>
                        <li>Your Team can be altered between Grand Prixs but not during a Grand Prix weekend, which runs from the start of the First Practice session until the end of the Race itself during each Grand Prix weekend.</li>
                        <li>The current<sup>1</sup> race calendar is:</li>

                        <div class="table-responsive  col-lg-12 col-md-12 col-sm-12">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Date</td>
                                    <td>Country</td>
                                </tr>
                                <?php
                                $sql = "select * from racecalendar order by date asc;";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo'<tr>' .
                                        '<td>' . $row["Date"] . '</td>' .
                                        '<td>' . $row["Country"] . '</td>' .
                                        '</tr>';
                                }
                                ?>
                            </table>
                        </div>
                        <li>If you fail to submit your team for a race on time , your submission for the previous race will be used. This will prevent anyone being excessively penalised for late or no submission of a team.</li>
                        <li>Your Team can be altered between Grand Prixs but not during a Grand Prix weekend, which runs from the start of the First Practice session until the end of the Race itself during each Grand Prix weekend.</li>
                        <li>There are a number of ways in which your Drivers and Constructors can score Points (see below how to score Points). </li>

                        <div class="table-responsive  col-lg-12">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Final Race Position - Drivers</td><td>Final Race Position - Constructors</td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td>1st Place : 25 Points</td><td>1st Place : 25 Points</td>
                                </tr>
                                <tr>
                                    <td>2nd Place : 18 Points</td><td>2nd Place : 18 Points</td>
                                </tr>
                                <tr>
                                    <td>3rd Place : 15 Points</td><td>3rd Place : 15 Points</td>
                                </tr>
                                <tr>
                                    <td>4th Place : 12 Points</td><td>4th Place : 12 Points</td>
                                </tr>
                                <tr>
                                    <td>5th Place : 10 Points</td><td>5th Place : 10 Points</td>
                                </tr>
                                <tr>
                                    <td>6th Place : 8 Points</td><td>6th Place : 8 Points</td>
                                </tr>
                                <tr>
                                    <td>7th Place : 6 Points</td><td>7th Place : 6 Points</td>
                                </tr>
                                <tr>
                                    <td>8th Place : 4 Points</td><td>8th Place : 4 Points</td>
                                </tr>
                                <tr>
                                    <td>9th Place : 2 Points</td><td>9th Place : 2 Points</td>
                                </tr>
                                <tr>
                                    <td>10th Place : 1 Point</td><td>10th Place : 1 Point</td>
                                </tr>
                                <tr>
                                    <td>Fastest Lap During Race : 5 Points</td><td>Fastest Pit Stop : 5 Points</td>
                                </tr>
                                <tr>
                                    <td>Pole Position in Qualifying : 5 Points</td><td>Best Combined Qualifying Performance : 5 Points</td>
                                </tr>
                                <tr>
                                    <td>Complete the Race : 5 Points</td><td>Both Constructor's Cars Finish the Race : 5 Points</td>
                                </tr>
                            </table>
                        </div>

                        <li>The constructor placings will be determined by addition of the Constructor's Driver's final Race positions, with the lowest scoring constructor placing first and the highest scoring constructor placing eleventh. In the event of a tie between constructors for a particular race, the average number of points will be used, i.e. 3 constructors tying for 4th place, then the points for 4th, 5th and 6th places will be equally shared between the 3 constructors (rounded up to nearest whole number).</li>
                        <li>If any Constructor teams are tied for Best Combined Qualifying Performance, then all tied teams will score 5 Points.</li>
                        <li>The Driver Placing, Constructor Placing, Fastest Lap Time, Fastest Pitstop and Completed Race Points will all be determined using the official www.f1.com results.</li>
                        <li>A driver will be deemed to have completed the race if he is not listed as having retired from the race on www.f1.com - if a driver finishes the race but has been lapped by the race winner then they will be deemed to have completed the race and will score the 5 point bonus.</li>
                        <li>If you fail to submit your team for a race on time , your submission for the previous race will be used. This will prevent anyone being excessively penalised for late or no submission of a team.</li>
                        <li> However, if your rolled over submission from the previous Race would result in you spending more than your current budget, then you would lose one of your Drivers or Constructors from your Team line-up. The Driver or Constructor you would lose would be the cheapest priced Drive/Constructor that brought you back into budget. If, after losing one of Driver or Constructor on your rollover line-up, you had underspent your budget then this would be rolled over into the next Race weekend.</li>
                    </ol>
                    <p><small><sup>1</sup> Subject to change by the FIA.</small></p>
                </div>
            </div>
        </div>



    </div>
</div>

<div class = "navbar navbar-default navbar-fixed-bottom">
    <div class = "container">
        <p class = "navbar-text pull-left">Please send e-mail to <a href="mailto:meno38@sky.com" data-toggle="modal">meno38@sky.com</a> to be registered to this website</p>
    </div>
</div>

</body>
</html>
