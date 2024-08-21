<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "timezone") or die(mysqli_error($con));

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

//sql injection


$username = mysqli_escape_string($con, $username);
$email = mysqli_escape_string($con, $email);
$password = mysqli_escape_string($con, $password);

// SQL query to insert data into the dishes table
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($con->query($sql) === TRUE) {
    // Record inserted successfully
    echo "Registeration Sucessfully";

    $_SESSION['user_logged_in'] = true;
    $_SESSION['username'] = $username;
    session_start();
    header("refresh:2; url=index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("refresh:1; url=index.php");
}
