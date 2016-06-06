<?php
include 'init.php';
$active="profile";
include 'includes/header.php';
include 'includes/navbar.php';
$username = $_SESSION["username"];
?>


    <div class="container">
        <div class = "row">
            <div class = "col-lg-12 col-md-12 col-sm-12">
                <div class = "panel panel-default">
                    <div class = "panel-body">
                        <div class="page-header">
                            <h3>Your Selections</h3>
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Race</th>
                                    <th>Driver 1</th>
                                    <th>Driver 2</th>
                                    <th>Constructor 1</th>
                                    <th>Constructor 2</th>
                                    <th>Joker Used</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    $sql = "select Country, driver1, driver2, constructor1, constructor2, joker from submissions where UserName = '$username' order by date desc  ";
                                    $result = $conn->query($sql);
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo'<tr>' .
                                            '<td>' . $row["Country"] . '</td>' .
                                            '<td>' . $row["driver1"] . '</td>' .
                                            '<td>' . $row["driver2"] . '</td>' .
                                            '<td>' . $row["constructor1"] . '</td>' .
                                            '<td>' . $row["constructor2"] . '</td>' .
                                            '<td>' . $row["joker"] . '</td>' .
                                            '</tr>';
                                    }
                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>