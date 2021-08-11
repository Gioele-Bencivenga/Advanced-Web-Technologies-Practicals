<?php
// get database connection
include_once '../objects/database.php';

// instantiate user object
include_once '../objects/user.php';

$db = new Database();
$dbConn = $db->getMySQLiConnection();

// get passed in values and sanitize
$username = mysqli_real_escape_string($dbConn, strip_tags($_POST['name_input']));
$phone = mysqli_real_escape_string($dbConn, strip_tags($_POST['phone_input']));
$email = mysqli_real_escape_string($dbConn, strip_tags($_POST['email_input']));
$password = mysqli_real_escape_string($dbConn, strip_tags($_POST['password_input']));

// create user with passed values
$user = new User($dbConn, $username, $phone, $email, $password);

// create the user
$outcome = $user->signup();
// feedback
if ($outcome == "success") {
    $outcome_arr = array(
        "status" => true,
        "message" => "Successfully Signup!",
        "username" => $user->username
    );
} else if ($outcome == "userAlreadyExists") {
    $outcome_arr = array(
        "status" => false,
        "message" => "Username already exists!"
    );
} else if ($outcome == "stmtPrepError") {
    $outcome_arr = array(
        "status" => false,
        "message" => "SQL Error!"
    );
} else if ($outcome == "strangError") {
    $outcome_arr = array(
        "status" => false,
        "message" => "Undefined Error."
    );
}
print_r(json_encode($outcome_arr));
