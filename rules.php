<?php
include 'init.php';
$active="rules";
include 'includes/header.php';
include 'includes/navbar.php';
include 'functions/general.php';
$sql = "select * from racecalendar where Date >= CURDATE() ORDER BY date LIMIT 0,1";
$queryResult = $conn->query($sql);
$numrows=mysqli_num_rows($queryResult);

while($row = mysqli_fetch_assoc($queryResult))
{
    $country =  $row["Country"];
}
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
                        <li>Register your intention to join the league by emailing f1predictor@virginmedia.com</li>
                        <li>You are allocated an operating budget &pound;55 million for your team line-ups during the season - for each race you recruit two Drivers and two Constructors who each incur a cost.  The current prices going into the 2016 <?php echo $country?> Grand Prix are shown below: </li>
                        <div class="clearfix visible-xs-block"></div>
                        <br />
                        <div class="table-responsive  col-lg-6 col-md-12 col-sm-12 ">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Driver</td>
                                    <td>Price (£m)</td>
                                </tr>
                                <?php
                                $sql = "select d.name,d.price,t.name as teamname,t.price as teamprice from driver d join team t on d.team = t.name order by d.price DESC";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo'<tr>' .
                                        '<td>' . $row["name"] . '</td>' .
                                        '<td>' . $row["price"] . '</td>' .
                                        '</tr>';
                                }
                                ?>
                            </table>

                        </div>

                        <div class="table-responsive  col-lg-6 col-md-12 col-sm-12">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Constructor</td>
                                    <td>Price (£m)</td>
                                </tr>
                                <?php
                                $sql = "select Name,Price from team order by Price DESC";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo'<tr>' .
                                        '<td>' . $row["Name"] . '</td>' .
                                        '<td>' . $row["Price"] . '</td>' .
                                        '</tr>';
                                }
                                ?>
                            </table>
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <li>Unspent Team budgets from one Race will be rolled over into the next race.</li>
                        <li>Driver and Constructor prices will be recalculated after each race, based on their performance over a rolling 12 month period. For example, once the Australian G.P. is complete each Driver's and Team's price for the next race will be re-calculated on the Total 2014 season points scored minus the 2015 Australian GP plus the 2016 Australian GP points, and so on after each race.</li>
                        <li>You cannot submit the same Driver or Constructor more than once for a race, e.g. choose Alonso as your Driver twice for any Grand Prix.</li>
                        <li>Driver and Constructor prices will be calculated using the points they have scored in OUR predictor league over the previous 12 months, rather than only the points they have earned in the official F1 championship.</li>
                        <li>Each team will be given 5 'Jokers' to play on any race over the season. A Joker played before a race weekend starts will double the points scored by your team over the weekend.</li>
                        <li>Your Team can be altered between Grand Prixs but not during a Grand Prix weekend, which runs from the start of the First Practice session until the end of the Race itself during each Grand Prix weekend.</li>

                        <li>The current<sup>1</sup> race calendar is:</li>
                        <br />
                        <div class="table-responsive  col-lg-12 col-md-8 col-sm-8">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Date (DD-MM-YYYY)</td>
                                    <td>Country</td>
                                </tr>
                                <?php
                                $sql = "select * from racecalendar order by date asc;";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $originalDate = $row["Date"];
                                    $newDate = date("d-m-Y", strtotime($originalDate));
                                    echo'<tr>' .
                                        '<td>' . $newDate . '</td>' .
                                        '<td>' . $row["Country"] . '</td>' .
                                        '</tr>';
                                }
                                ?>
                            </table>
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <li>If you fail to submit your Team for a Race before First Practice begins, your submission for the previous Race will be used provided it will be within your current Race Budget (see Rule 11). This will prevent any Team from being excessively penalised for late or no submission of a Team line-up.</li>
                        <li>If your team has been rolled over unchanged from one race to the next, and your Team's value is above your current rolling Budget, then the MOST EXPENSIVE component of your Team will be dropped from your Line-up. This will bring your Budget spend for the Race within your current Budget allowance. However you will also be fined £10 million for the CURRENT Race weekend, as you should not be intentionally or unintentionally spending more than your current Budget. This would potentially result in you losing the SECOND MOST EXPENSIVE component of your Team for the CURRENT Race. If you have some unspent Budget left (after the Fine and dropping Team components) then this will be rolled over into the following Race's unspent Budget value.</li>
                        <li>There are a number of ways in which your Drivers and Constructors can score Points (see below for an example). </li>
                        <div class="clearfix visible-xs-block"></div>
                        <br />
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
                        <div class="clearfix visible-xs-block"></div>
                        <li>Here is an example of the scoring system using results from the Australian Grand Prix in Melbourne in 2013 with a team comprised of :</li>
                        <div class="clearfix visible-xs-block"></div>
                        <br />
                        <div class="table-responsive  col-lg-12">
                            <table class="table table-bordered text-center">
                                <tr class ="success">
                                    <td>Drivers</td><td>Constructors</td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                    <td>Driver 1 : Alonso (£15.39 million)</td><td>Constructor 1 : Mercedes (£16.32 million)</td>
                                </tr>
                                <tr>
                                    <td>Driver 2 : Grosjean (£11.73 million)</td><td>Constructor 2 : Sauber (£10.14 million)</td>
                                </tr>
                                <tr>
                                    <td>Driver 1 : 18 Points - Final Race Position</td><td>Constructor 1 : 8 Points - Combined Race Position</td>
                                </tr>
                                <tr>
                                    <td>Driver 1 : 5 Bonus Points</td><td>Constructor 1 : 0 Bonus Points</td>
                                </tr>
                                <tr>
                                    <td>DRIVER 1 TOTAL : 23 Points	</td><td>CONSTRUCTOR 1 TOTAL : 8 Points</td>
                                </tr>
                                <tr>
                                    <td>Driver 2 : 1 Points - Final Race Position</td><td>Constructor 2 : 1 Points - Combined Race Position</td>
                                </tr>
                                <tr>
                                    <td>Driver 2 : 5 Bonus Points</td><td>Constructor 2 :	0 Bonus Points</td>
                                </tr>
                                <tr>
                                    <td>DRIVER 2 TOTAL : 6 Points</td><td>CONSTRUCTOR 2 TOTAL : 1 Points</td>
                                </tr>
                                <tr>
                                    <td>DRIVERS TOTAL : 29 Points</td><td>CONSTRUCTORS TOTAL : 9 Points</td>
                                </tr>
                            </table>
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <li>The constructor placings will be determined by addition of the Constructor's Driver's final Race positions, with the lowest scoring constructor placing first and the highest scoring constructor placing eleventh. In the event of a tie between constructors for a particular race, the average number of points will be used, i.e. 3 constructors tying for 4th place, then the points for 4th, 5th and 6th places will be equally shared between the 3 constructors (rounded up to nearest whole number).</li>
                        <li>If you do not use the most recent spreadsheet to select your team line-up, you run the risk of submitting a team which will be over your current budget (due to Driver and Constructor Prices being recalculated after every race). If you submit a team which is over budget, your team line-up from the previous race will be used. No Joker for the current race will be applied in this circumstance whether you have asked for one or not.</li>
                        <li>If any Constructor teams are tied for Best Combined Qualifying Performance, then all tied teams will score 5 Points.</li>
                        <li>The Driver Placing, Constructor Placing, Fastest Lap Time, Fastest Pitstop and Completed Race Points will all be determined using the official www.f1.com results. The Fastest Pitstop is determined from data on the FIA's website, with the time use being from when the Driver enters the pitlane, then exits it after his stop.</li>
                        <li>A driver will be deemed to have completed the race if he is not listed as having retired from the race on www.f1.com - if a driver finishes the race but has been lapped by the race winner then they will be deemed to have completed the race and will score the 5 point bonus.</li>

                    </ol>
                    <p>* Disclaimer - The Dictator-in-Chief of the League does not accept responsibility if you suffer any symptoms due to the thrilling effects of being part of this league. Please consult your G.P. if you experience any shortness of breath, arrythmia, sweaty palms or homicidal tendencies towards fellow League members during the course of the season.</p>
                    <p><small><sup>1</sup> Subject to change by the FIA.</small></p>
                </div>
            </div>
        </div>



    </div>
</div>


</body>
</html>
