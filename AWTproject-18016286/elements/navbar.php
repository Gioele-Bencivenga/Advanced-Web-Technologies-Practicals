<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/../index.php">Car Company</a>

        <button class="navbar-toggler" aria-expanded="false" aria-controls="navList" aria-label="Toggle navigation" type="button" data-target="#navList" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'overview.php') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/../pages/brands.php">
                        Brands
                    </a>
                </li>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'client_list.php') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/../pages/about.php">
                        About
                    </a>
                </li>
            </ul>

            <?php if (empty($_SESSION['loggedin'])) { ?>
                <a href="../pages/login.php">
                    <button class="btn btn-success">Log In</button>
                </a>
                <a href="../pages/register.php">
                    <button class="btn btn-secondary">Register</button>
                </a>
            <?php }
            if (!empty($_SESSION['loggedin'])) { ?>
                <form class="form-inline my-2 my-lg-0" action="../pages/logout.php">
                    <button class="btn btn-danger" type="submit">Log Out</button>
                </form>
            <?php } ?>
        </div>
    </div>
</nav>