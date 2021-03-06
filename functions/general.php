<?php
include 'init.php';

function sanitize($data) {
    return mysql_real_escape_string($data);
}

function doesSubmissionExistForUser($username, $country)
{
    global $conn;
    $sql = "SELECT * FROM submissions WHERE username = '$username' AND country = '$country'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        return true;
    }
    return false;
}

function user_exists($username)
{
    global $conn;
    $sql="SELECT * FROM users WHERE Email='$username'";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        return true;
    }
    return false;
}

function team_exists($teamname)
{
    global $conn;
    $sql="SELECT * FROM users WHERE teamname='$teamname'";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        return true;
    }
    return false;
}

function user_active($username)
{
    global $conn;
    $sql="SELECT * FROM users WHERE Email='$username'";
    $result = $conn->query($sql);


    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($row["Activated"] == 1) {
            return true;
        }
    }
    return false;
}

function username_pass_correct($username, $password)
{
    global $conn;
    $sql="SELECT * FROM users WHERE Email='$username' AND Password='$password'";
    $result = $conn->query($sql);


    if($result->num_rows == 1){
       return true;
    }
    else {
       return false;
    }
}

function check_login($username, $password)
{
    global $conn;
    $sql="SELECT * FROM users WHERE Email='$username' AND Password='$password'";
    $result = $conn->query($sql) or die(mysqli_error($conn));


    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["UserName"];
        $_SESSION["admin"] = $row["isadmin"];
        header("location:index.php");
    }
    else {
        print_r($result);
        echo "Something went wrong";
        echo "USername is: " . $username;
       // header("location:error.php?");
    }
}

function register_user($email, $password, $username, $teamname)
{
    global $conn;
    $sql = "INSERT INTO users (UserName,Password,Email,teamname,Activated,jokers,budget,points) VALUES ('$username','$password','$email','$teamname','0','0','55.00','0')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        return true;
    } else {
        return false;
    }
}

function output_errors($errors) {
    $output = array();

    foreach($errors as $error) {
        $output[] = '<li>' . $error . '</li>';
    }
    return '<ul>' . implode('', $output) . '</ul>';
}

function is_user_admin($username) {
    global $conn;
    $sql="SELECT * FROM users WHERE Email='$username'";
    $result = $conn->query($sql);


    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($row["isadmin"] == 1) {
            return true;
        }
    }
    return false;
}

?>