<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 09/03/2015
 * Time: 20:00
 */
include 'init.php';
?>

<html>
<head>
    <title>Formula 1 Predictor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

</head>
<body>


    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">F1 Predictor 2015</a>

            <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class = "nav navbar-nav navbar-right">
                    <li class = "active"><a href="index.php">Home</a></li>

                    <li><a href="rules.html">Rules</a></li>
                    <!--
                   <li><a href="login.html">Log In</a></li>
                   <li><a href="Register.html">Register</a></li>
                   -->
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-success" >
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                </div>

                <div class="panel-body" >
                    <form id="loginform" class="form-horizontal" action="checklogin.php" method="post">

                        <div class="form-group" style="margin-top:20px;">
                            <label for="username" class="col-md-3 control-label">Email:</label>
                            <div class="col-md-9">
                                <input id="login-username" type="email" class="form-control" name="username" value="" placeholder="email" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">password:</label>
                            <div class="col-md-9">
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" class="btn btn-success" name="Submit" value="Login">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    Don't have an account!
                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        Sign Up Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                </div>
                <div class="panel-body" >
                    <form id="signupform" class="form-horizontal" action="register.php" method="post">

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">First Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="firstname" placeholder="First Name" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teamname" class="col-md-3 control-label">Team Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="teamname" placeholder="Team Name" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" class="btn btn-success" name="Submit" value="Sign Up">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
