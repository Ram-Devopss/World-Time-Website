<?php
session_start(); // Start the session

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <title>World Time</title>
</head>

<body>

    <section id="cta" class="s-cta py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-12">
                    <div class="text-center mb-4">
                        <h2 style="color:aliceblue" class="display-4">Login Form</h2>
                    </div>
                    <form action="login-valid.php" method="post" class="p-4 bg-light rounded">
                        <div class="form-group">
                            <label for="username">Enter Username</label>
                            <input type="text" name="username" id="username" class="form-control" required autofocus autocomplete="true">
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="off">
                        </div>
                        <button class="btn btn--primary" type="submit">Login</button>
                    </form>

                    <p style="text-align:center">Don't have a Account ? <a href="signup.php" class="btn btn--info"> Signup</a></p>

                </div>
            </div>
        </div>
    </section> <!-- end s-cta -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>