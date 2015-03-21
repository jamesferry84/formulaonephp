<div class="modal fade" id="chooseteam" role="dialog">
    <div class ="modal-dialog">
        <div class = "modal-content">
            <form class="form-horizontal" action="submit.php" method="post">
                <div class="modal-header">
                    <h4>Choose Team</h4>
                </div>
                <div class = "modal-body">
                    <div class="form-group">
                        <label for = "driver" class = "col-lg-3 control-label">Driver 1:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="driver1DropDown" name="driver1" required="required">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "driver" class = "col-lg-3 control-label">Driver 2:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="driver2DropDown" name="driver2" required="required">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "constructor" class = "col-lg-3 control-label">Constructor 1:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="constructor1DropDown" name="constructor1" required="required">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "constructor" class = "col-lg-3 control-label">Constructor 2:</label>
                        <div class = "col-lg-7">
                            <select class="form-control" id="constructor2DropDown" name="constructor2" required="required">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>


                    <div class="checkbox">
                        <?php
                        $sql = "select * from users where username = '{$_SESSION['username']}'";
                        $queryResult = $conn->query($sql);
                        $numrows=mysqli_num_rows($queryResult);

                        $row = mysqli_fetch_assoc($queryResult)

                        ?>
                        <label>
                            <input type="checkbox" name="jokerUsed" value="1"  <?php if ($row["jokers"] == 0) echo 'disabled="disabled"' ?>>
                            Use Joker? (Jokers available <?php echo $row["jokers"] ?>)
                        </label>
                    </div>


                    <div class="form-group">
                        <?php
                        $sql = "select * from users where username = '{$_SESSION['username']}'";
                        $queryResult = $conn->query($sql);
                        $numrows=mysqli_num_rows($queryResult);

                        $row = mysqli_fetch_assoc($queryResult)

                        ?>
                        <label for = "carriedOver" class = "col-lg-5 control-label">Carried Over:</label>
                        <div class = "col-lg-5">
                            <input type = "text" class="form-control" id="carriedOver" placeholder="Hint Text" value=<?php echo $row["budget"] ?> />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for = "remainingBudget" class = "col-lg-5 control-label">Remaining Budget:</label>
                        <div class = "col-lg-5">
                            <input type = "text" class="form-control" id="remainingBudget" name="remainingBudget" placeholder="Hint Text" />
                        </div>
                    </div>
                <div class = "modal-footer">
                    <a href="#" class="btn btn-danger" data-dismiss = "modal">Cancel</a>
                    <button class="btn btn-success" id="submitButton" type="submit">Submit Selection</button>
                </div>
            </form>
        </div>
    </div>
</div>
