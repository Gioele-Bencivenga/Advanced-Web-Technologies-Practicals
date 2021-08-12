<?php
if (isset($_POST['submit'])) {
    // get database connection
    include_once '../objects/database.php';

    // instantiate user object
    include_once '../objects/user.php';

    $db = new Database();
    $dbConn = $db->getMySQLiConnection();

    // get passed in values and sanitize from html tags and special chars
    $username = sanitize($dbConn, $_POST['name_input']);
    $phone = sanitize($dbConn, $_POST['phone_input']);
    $email = sanitize($dbConn, $_POST['email_input']);
    $password = sanitize($dbConn, $_POST['password_input']);

    // check for problems with the inputted data
    if (empty($username) || empty($phone) || empty($email) || empty($password)) { // any field empty?
        header("Location: ../register.php?error=emptyfields");
        exit();
    } elseif (!preg_match("/^[a-zA-Z]*$/", $username)) { // username with not only letters and spaces?
        header("Location: ../register.php?error=nameletters");
        exit();
    } elseif (!preg_match("/^[0-9]*$/", $phone)) { // phone with incorrect number?
        header("Location: ../register.php?error=phonenumbers");
        exit();
    } elseif (strlen($phone) != 10) { // phone with incorrect number of digits?
        header("Location: ../register.php?error=phonedigits");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // invalid email?
        header("Location: ../register.php?error=emailval");
        exit();
    } elseif (!preg_match("/^[a-zA-Z]*$/", $password)) { // password with not only letters and spaces?
        header("Location: ../register.php?error=passletters");
        exit();
    } else { // try to register user
        // create user object with passed values
        $user = new User($dbConn, $username, $phone, $email, $password);

        // try to register the user into the db (check if name and phone are unique)
        $outcome = $user->signup();
        // get feedback
        if ($outcome == "success") {
            header("location: ../register.php?success");
            exit();
        } else if ($outcome == "userAlreadyExists") {
            header("location: ../register.php?error=userexists");
            exit();
        } else if ($outcome == "phoneAlreadyExists") {
            header("location: ../register.php?error=phoneexists");
            exit();
        } else if ($outcome == "stmtPrepError") {
            header("location: ../register.php?error=sqlerror");
            exit();
        } else if ($outcome == "strangError") {
            header("location: ../register.php?error=undeferror");
            exit();
        }
    }
} else { // if the user came on this page by accident redirect
    header("Location: ../register.php");
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
