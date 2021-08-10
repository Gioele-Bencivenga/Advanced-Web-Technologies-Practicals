<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Company | Home</title>
    <meta name="description" content="Home page of Car Company's website, where you can find many good cars on sale!">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices">

    <!-- get react and babel -->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <!-- get bootstrap -->
    <?php include './functions/get_bootstrap.php'; ?>

    <script>
        function showCars(brand) {
            if (brand == "") {
                document.getElementById("loadingText").innerHTML = "<h6>No Brand Selected</h6>";
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
                        document.getElementById("loadingText").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "./functions/get_car.php?brand=" + brand, true);
                xmlhttp.send();
            }
        }
    </script>
</head>

<body>
    <?php include './elements/navbar.php'; ?>

    <div class="container">
        <br>
        <form>
            <div class="form-group">
                <label for="car_brands">
                    <h4>View Cars by Brand</h4>
                </label>
                <select name="car_brands" onchange="showCars(this.value)" class="form-control form-control-lg">
                    <option value="">Select a Brand:</option>
                    <option value="BMW">BMW</option>
                    <option value="Toyota">Toyota</option>
                </select>
            </div>
        </form>
        <br>

        <div id="loadingText">

        </div>
    </div>
</body>

</html>