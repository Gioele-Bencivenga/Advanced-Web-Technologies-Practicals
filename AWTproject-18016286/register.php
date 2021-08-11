<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Company | Register</title>
    <meta name="description" content="Sign up to be able to order great cars!">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices, sign, up, register, order, place">

    <!-- get react and babel -->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <!-- get bootstrap -->
    <?php include './functions/get_bootstrap.php'; ?>

    <!-- get my style -->
    <link rel="stylesheet" type="text/css" href="./styles/my_style.css">
</head>

<body>
    <?php include './elements/navbar.php'; ?>

    <div class="container">
        <br>
        <h4>Register New User</h4>
        <br>
        <form name="user_registration_form" action="./functions/register_user.php" method="POST">
            <div class="form-group row">
                <label for="name_input" class="col-sm-2 col-form-label">
                    <h5>Username</h5>
                </label>
                <div class="col-sm-10">
                    <input type="text" id="name_input" name="name_input" class="form-control form-control-lg" placeholder="Enter username" />
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_input" class="col-sm-2 col-form-label">
                    <h5>Phone Number</h5>
                </label>
                <div class="col-sm-10">
                    <input type="tel" id="phone_input" name="phone_input" class="form-control form-control-lg" placeholder="Enter phone number" />
                </div>
            </div>
            <div class="form-group row">
                <label for="email_input" class="col-sm-2 col-form-label">
                    <h5>Email Address</h5>
                </label>
                <div class="col-sm-10">
                    <input type="email" id="email_input" name="email_input" class="form-control form-control-lg" placeholder="Enter email address" />
                </div>
            </div>
            <div class="form-group row">
                <label for="password_input" class="col-sm-2 col-form-label">
                    <h5>Password</h5>
                </label>
                <div class="col-sm-10">
                    <input type="password" id="password_input" name="password_input" class="form-control form-control-lg" placeholder="Enter a secure password" />
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-3">
                    <button type="reset" name="reset" class="btn btn-danger btn-block btn-lg">Clear Fields</button>
                </div>
                <div class="form-group col">
                    <button type="submit" name="submit" class="btn btn-info btn-block btn-lg">Register</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>