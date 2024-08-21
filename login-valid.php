
<?php
session_start();



$con = mysqli_connect("localhost", "root", "", "timezone") or die(mysqli_error($con));

$username = $_POST['username'];
$password = $_POST['password'];

//sql injection


$username = mysqli_escape_string($con, $username);
$password = mysqli_escape_string($con, $password);

$sql = "SELECT * FROM users WHERE username='$username'";

$result = $con->query($sql);
print_r($result);
if ($result->num_rows == 1) {
    $pass;
    $row = $result->fetch_assoc();
    if ($row['username'] != $username) {
        $pass = 1;
        echo ("Account Not Found");
        header("refresh:1; url=index.php");
    } elseif ($row['password'] != $password) {
        $pass = 1;
        echo ("Password Was Wrong");
        header("refresh:1; url=index.php");
    }

    if (isset($pass)) {
        echo ("Login Failed");
        header("refresh:1; url=index.php");
    }
    echo 'Login Successfull';
    $_SESSION['user_logged_in'] = true;
    $_SESSION['username'] = $username;
    session_start();
    header("refresh:2; url=index.php");
    // After successful login



} else {
    echo "account Not Found";
    header("refresh:1; url=index.php");
}




?>