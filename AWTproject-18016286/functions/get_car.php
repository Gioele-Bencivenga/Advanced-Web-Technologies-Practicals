<!DOCTYPE html>
<html>

<body>
    <?php
    // get car brand from GET variable
    $brand = strval($_GET['brand']);
    // need to include this in order to connect to db
    include_once '../objects/database.php';
    $db = new Database(); // create db obj
    $conn = $db->getMySQLiConnection(); // connect

    $sql = "SELECT * FROM car WHERE brand = '" . $brand . "'";
    $result = mysqli_query($conn, $sql); // execute the SQL statement
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="card">';
        echo '<img class="card-img-top" src="./assets/' . $row['brand'] . '_' . $row['model'] . '.png" alt="' . $row['brand'] . ' ' . $row['model'] . ' image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><small>' . $row['brand'] . '</small> <b>' . $row['model'] . '</b></h5>';
        echo '<p class="card-text">' . $row['info'] . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<small class="text-muted">' . $row['price'] . '</small>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
    }
    mysqli_close($conn);
    ?>
</body>

</html>