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
<html>

<body>
    <?php
    // get customer name from GET variable
    $custname = strval($_GET['user']);
    // need to include this in order to connect to db
    include_once '../objects/database.php';
    $db = new Database(); // create db obj
    $conn = $db->getMySQLiConnection(); // connect

    $query = "SELECT * FROM carorder WHERE custname = '" . $custname . "'";
    $result = mysqli_query($conn, $query); // execute the SQL statement
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><b>Product ordered: ' . $row['ordereditem'] . '</b></h5>';
        echo '<p class="card-text">Customer name: ' . $row['custname'] . ', customer phone: ' . $row['custphone'] . ', customer email: ' . $row['custmail'] . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<span class="card-text">Price paid: £' . $row['itemprice'] . '  </span>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
    }
    mysqli_close($conn);
    ?>
</body>

</html>