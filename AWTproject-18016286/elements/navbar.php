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
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'client_list.php') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="./about.php">
                        About
                    </a>
                </li>
            </ul>

            <?php if (empty($_SESSION['loggedin'])) { ?>
                <a href="./login.php">
                    <button class="btn btn-success">Log In</button>
                </a>
                <a href="./register.php">
                    <button class="btn btn-secondary">Register</button>
                </a>
            <?php }
            if (!empty($_SESSION['loggedin'])) { ?>
                <form class="form-inline my-2 my-lg-0" action="./logout.php">
                    <button class="btn btn-danger" type="submit">Log Out</button>
                </form>
            <?php } ?>
        </div>
    </div>
</nav>