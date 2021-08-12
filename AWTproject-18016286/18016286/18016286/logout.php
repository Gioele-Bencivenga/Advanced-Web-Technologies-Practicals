<?php
// start session if not started
if (!isset($_SESSION)) {
    session_start();
}

// display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Company | Logout</title>
    <meta name="description" content="Log out from the website.">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices, log, out, logout, order, place">
    <meta name="author" content="18016286">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- get react and babel -->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <!-- get bootstrap -->
    <?php include './functions/get_bootstrap.php'; ?>

    <!-- get my style -->
    <link rel="stylesheet" type="text/css" href="./styles/my_style.css">
</head>

<body>
    <?php include './elements/navbar.php'; ?>

    <div id="root" class="container">
        <br>
        <h4>You have been logged out.</h4>
        <h5>
            To log in again, <a class="btn btn-success btn-lg" href="./login.php">click here</a>
        </h5>
        <h5>
            Alternatively, <a class="btn btn-primary btn-lg" href="./index.php">go to the homepage</a>
        </h5>
    </div>
</body>

</html>