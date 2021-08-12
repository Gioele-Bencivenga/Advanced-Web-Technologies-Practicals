<?php
// did the user find this page by clicking on something?
if (isset($_GET['logout'])) {
    // restart sess
    session_start();
    session_destroy();
    // unset sess vars
    unset($_SESSION["username"]);
    unset($_SESSION["loggedin"]);

    header('Location: ../logout.php');
    exit;
} else {
    header("Location: ../index.php");
    exit();
}
