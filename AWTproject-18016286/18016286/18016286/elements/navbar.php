<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <b>Car Company</b>
        </a>

        <button class="navbar-toggler" aria-expanded="false" aria-controls="navList" aria-label="Toggle navigation" type="button" data-target="#navList" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['loggedin'])) { ?>
                    <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'orders.php') {
                                            echo 'active';
                                        } ?>">
                        <a class="nav-link" href="orders.php">
                            Order History
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="about.php">
                        About This
                    </a>
                </li>
            </ul>

            <?php if (!isset($_SESSION['loggedin'])) { ?>
                <a href="./login.php">
                    <button class="btn btn-success btn-lg">Log In</button>
                </a>
                <br>
                <a href="./register.php">
                    <button class="btn btn-info btn-lg">Register</button>
                </a>
            <?php } else { ?>
                <span class="navbar-text" style="font-size: 22px; color: white">
                    Logged in as <?php echo $_SESSION['username'] ?>
                </span>
                <a href="./functions/logout_user.php?logout">
                    <button class="btn btn-danger btn-lg">Log Out</button>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>