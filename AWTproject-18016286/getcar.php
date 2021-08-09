<!DOCTYPE html>
<html>

<body>
    <?php
    // get car id from get variable
    $id = intval($_GET['id']);
    $host = "localhost";
    $db = "finalproj";
    $usern = "root";
    $passw = "";
    $conn = mysqli_connect($host, $usern, $passw, $db);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $sql = "SELECT * FROM car WHERE id = '" . $id . "'";
    $result = mysqli_query($conn, $sql); // execute the SQL statement
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="card">';
        echo '<img class="card-img-top" src="..." alt="' . $row['brand'] . ' ' . $row['model'] . ' image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['brand'] . ' ' . $row['model'] . '</h5>';
        echo '<p class="card-text">' . $row['info'] . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<small class="text-muted">' . $row['price'] . '</small>';
        echo '</div>';
        echo '</div>';
    }
    mysqli_close($conn);
    ?>
</body>

</html>