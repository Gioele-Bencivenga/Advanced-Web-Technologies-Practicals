<!DOCTYPE html>
<html lang="en">

<head>
    <title>CarCo | Home</title>

    <!-- get bootstrap CSS, jQuery, JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/superhero/bootstrap.min.css" integrity="sha384-HnTY+mLT0stQlOwD3wcAzSVAZbrBp141qwfR4WfTqVQKSgmcgzk+oP0ieIyrxiFO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- get react and babel -->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <script>
        function showCar(id) {
            if (id == "") {
                document.getElementById("loadingText").innerHTML = "";
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
                        document.getElementById("loadingText").innerHTML += this.responseText;
                    }
                };
                xmlhttp.open("GET", "getcar.php?id=" + id, true);
                xmlhttp.send();
            }
        }

        function showAllCars() {
            var carN = 6;
            for (let i = 1; i <= carN; i++) {
                showCar(i);
            }
        }

        window.onload = showAllCars();
    </script>
</head>

<body>
    <?php include __DIR__ . '/elements/navbar.php'; ?>

    <div class="container">
        <h4>List of Cars</h4>

        <div id="loadingText" class="card deck">

        </div>
    </div>
</body>

</html>