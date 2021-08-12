<?php
// start session if not started
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit();
}

// display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include database connection file
include '../objects/database.php';
// connect
$db = new Database();
$dbConn = $db->getMySQLiConnection();
// get passed and session values
$order_customer = $_SESSION['username'];
$order_phone = $_SESSION['phone'];
$order_item = $_GET['brand'] . $_GET['model'];
$order_price = $_GET['price'];
// fill in email address from db
$query = "SELECT * FROM userer WHERE phonenumber=?";
// prepare query statement
$stmt = mysqli_stmt_init($dbConn);
if (!mysqli_stmt_prepare($stmt, $query)) {
    header("Location: ../index.php?stmtProblem");
    exit();
} else {
    // bind parameters
    mysqli_stmt_bind_param($stmt, "s", $order_phone);
    // execute
    mysqli_stmt_execute($stmt);
    // store the result
    $result = mysqli_stmt_store_result($stmt);
    // get values stored in result
    if ($row = mysqli_fetch_assoc($result)) {
        // store email
        $order_email = $row['emailaddress'];
    }
}

// query to insert record
$query = "INSERT INTO carorder (custname, custphone, custmail, ordereditem, itemprice) VALUES (?,?,?,?,?)";

// prepare stmt
$stmt = mysqli_stmt_init($dbConn);
if (!mysqli_stmt_prepare($stmt, $query)) {
    header("Location: ../index.php");
    exit();
} else {
    // bind values to statement
    mysqli_stmt_bind_param($stmt, "sssss", $order_customer, $order_phone, $order_email, $order_item, $order_price);
    // execute
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt); // delete stored stmt
    mysqli_close($dbConn); // close connection
    // success
    header("Location: ../orders.php");
    exit();
}
