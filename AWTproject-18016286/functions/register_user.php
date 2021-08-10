<?php
// get database connection
include_once 'database.php';

// instantiate user object
include_once 'user.php';

$db = new Database();
$dbConn = $db->getMySQLiConnection();

$user = new User($dbConn);

// get passed in values
$user->username = $_GET['username'];
$user->password = $_GET['password'];
$user->dateCreated = date('Y-m-d H:i:s');

// create the user
if ($user->signup()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
print_r(json_encode($user_arr));
