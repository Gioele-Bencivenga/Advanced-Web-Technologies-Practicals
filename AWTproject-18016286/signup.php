<?php
// get database connection
include_once 'database.php';

// instantiate user object
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// set user property values
$user->username = $_GET['username'];
$user->password = $_GET['password'];
$user->created = date('Y-m-d H:i:s');
/*
if(empty($user->username))
 {
 echo("No user name");
 }
 else
 {
 echo("user name:" . $user->password);
 }
*/
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
