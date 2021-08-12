<?php
if (isset($_POST['submit-login'])) {
    // include database connection file
    include_once '../objects/database.php';

    // include user object file
    include_once '../objects/user.php';

    $db = new Database();
    $dbConn = $db->getMySQLiConnection();

    // get passed in values and sanitize from html tags and special chars
    $phone = sanitize($dbConn, $_POST['phone_input']);
    $password = $_POST['password_input'];

    // check for problems with the inputted data
    if (empty($phone) || empty($password)) { // any field empty?
        header("Location: ../login.php?error=emptyfields");
        exit();
    } elseif (!preg_match("/^[0-9]*$/", $phone)) { // phone with more than numbers?
        header("Location: ../login.php?error=phonenumbers");
        exit();
    } elseif (strlen($phone) != 10) { // phone with incorrect number of digits?
        header("Location: ../login.php?error=phonedigits");
        exit();
    } elseif (!preg_match("/^[a-zA-Z]*$/", $password)) { // password with not only letters and spaces?
        header("Location: ../login.php?error=passletters");
        exit();
    } else { // try to log in user
        // create user object with passed values
        $user = new User($dbConn, "", $phone, "", $password);
        // try to login user
        $outcome = $user->login();
        // get feedback
        if ($outcome == "success") {
            header("location: ../index.php");
            exit();
        } else if ($outcome == "wrongPass") {
            header("location: ../login.php?error=passerror");
            exit();
        } else if ($outcome == "stmtPrepError") {
            header("location: ../login.php?error=sqlerror");
            exit();
        } else if ($outcome == "strangError") {
            header("location: ../login.php?error=undeferror");
            exit();
        }
    }
} else { // if the user came on this page by accident redirect
    header("Location: ../login.php");
    exit();
}

/**
 * Sanitizes the data so that it only contains letters and numbers.
 */
function sanitize($_dbConn, $_data)
{
    $_data = trim($_data); // remove blank spaces from both sides of the data
    $_data = stripslashes($_data); // remove backslashes
    $_data = htmlspecialchars($_data); // convert some predefined characters to HTML entities e.g. < (less than) becomes &lt;
    $_data = strip_tags($_data); // remove html and php tags
    $_data = mysqli_real_escape_string($_dbConn, $_data); // escape any eventual chars since we'll be using these in a query
    return $_data;
}
