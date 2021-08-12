<?php
// redirect to index if we are not logged in
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: ./login.php");
    exit();
}
// display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Company | Orders</title>
    <meta name="description" content="View previously placed orders.">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices, order, place, list">
    <meta name="author" content="18016286">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- get react and babel -->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <!-- get bootstrap -->
    <?php include './functions/get_bootstrap.php'; ?>

    <script>
        function showOrders(user) {
            if (user == "") {
                document.getElementById("orders_list").innerHTML = "<h6>No User Selected</h6>";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("orders_list").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "./functions/get_order.php?user=" + user, true);
                xmlhttp.send();
            }
        }
        window.onload = showOrders("<?php echo $_SESSION['username']; ?>");
    </script>
</head>

<body>
    <?php include './elements/navbar.php'; ?>

    <div id="root" class="container">
        <br>
        <div class="form-group">
            <button class="btn btn-primary" onclick="showOrders('<?php echo $_SESSION['username']; ?>')">Refresh</button>
            <label for="orders_list">
                <h4>View Past Orders by <?php echo $_SESSION['username'] ?></h4>
            </label>
            <div id="orders_list">

            </div>
        </div>
    </div>
</body>

</html>