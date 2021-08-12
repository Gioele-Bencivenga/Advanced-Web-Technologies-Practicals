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
<html lang="en">

<head>
    <title>Car Company | Login</title>
    <meta name="description" content="Log in to place some orders!">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices, log, in, login, order, place">
    <meta name="author" content="18016286">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

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

    <!-- login form will be displayed here -->
    <div id="root">
    </div>

    <!-- login form definition -->
    <script type="text/babel">
        class LoginForm extends React.Component {
            constructor(props) {
			super(props);
			
            // bind events
			this.handlePhoneChanged = this.handlePhoneChanged.bind(this);
			this.handlePasswordChanged = this.handlePasswordChanged.bind(this);	
		    }
		  
			// phone number needs to be only numbers
            handlePhoneChanged(event) {
                document.getElementById("submit-login").disabled = true;
				var input = event.target.value.toString();
				// regex testing for anything that is not a number, including whitespaces
				if(!/^[0-9]*$/.test(input)) {// inputted wrong
					document.getElementById("hint_phone").innerHTML = "<font color='red'><b>&#10060; Phone must be 10 numbers and no other character!</b></font>";
				}else{ 
                    if(input.length == 10){ // inputted right
                        document.getElementById("hint_phone").innerHTML = "<font color='pastelgreen'><b>&#10003; Phone ok</b></font>";
                        document.getElementById("submit-login").disabled = false;
                    }else{ // too short
                        document.getElementById("hint_phone").innerHTML = "<font color='white'>Phone must be 10 numbers</font>";
                    }
                }
            }

            // password needs to be only letters
            handlePasswordChanged(event) {
                document.getElementById("submit-login").disabled = true;
				var input = event.target.value.toString();
				// regex testing for anyhting that is not a letter or whitespace between letters
				if(!/[A-Za-z]+$|^$|^\s$/.test(input)) { // inputted wrong
                    document.getElementById("hint_password").innerHTML = "<font color='red'><b>&#10060; Password must be only letters</b></font>";
				}else{ 
                    if(input.length > 1){ // inputted right
                        // display confirmation
                        document.getElementById("hint_password").innerHTML = "<font color='pastelgreen'><b>&#10003; Password ok</b></font>";
                        // enable register button
                        document.getElementById("submit-login").disabled = false;
                    }else{ // too short
                        document.getElementById("hint_password").innerHTML = "<font color='white'>Password must be 2 letters minimum, no numbers, symbols, or spaces</font>";
                    }
                }
            }

		    render() {
			return (
				<div class="container">
                <br/>
                <h4>Log In</h4>
                <br/>
                <form name="login_form" action="<?php echo htmlspecialchars('./functions/login_user.php') ?>" method="POST">
				<div class="form-group">

                <div class="form-group row">
                <label for="phone_input" class="col-sm-2 col-form-label"><h5>Phone Number</h5></label>
				<br/>
                <div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" id="phone_input" name="phone_input" onChange={this.handlePhoneChanged} maxlength = "10" placeholder="7595285472" required/>
				<div id="hint_phone"></div>
                </div>
                </div>
				<br/>

                <div class="form-group row">
                <label for="password_input" class="col-sm-2 col-form-label"><h5>Password</h5></label>
				<br/>
                <div class="col-sm-10">
				<input type="password" class="form-control form-control-lg" id="password_input" name="password_input" onChange={this.handlePasswordChanged} placeholder="*********" required/>
				<div id="hint_password"></div>
                </div>
                </div>
                <br/>

                <div class="form-group row">
                <div class="form-group col-3">
                <a href="register.php" class="btn btn-info btn-block btn-lg">Need to Register</a>
				</div>
                <div class="form-group col">
                <button type="submit" id="submit-login" name="submit-login" value="submit-login" class="btn btn-success btn-block btn-lg"><b>Log In &#10003;</b></button>
                </div>
                </div>
				
                <br/>
                </div>
			    </form>				
                <?php
                if (isset($_GET['success'])) {
                    echo "<font color='pastelgreen'><h3><b>&#10003; Successful Login!</b></h3><a href='./index.php'><button class='btn btn-primary btn-lg'>Home Page</button></a></font>";
                } elseif (isset($_GET['error'])) {
                    switch ($_GET['error']) {
                        case "emptyfields":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; No field should be left empty!</b></h3></font>";
                            break;
                        case "phonenumbers":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Phone number has to be only numbers!</b></h3></font>";
                            break;
                        case "phonedigits":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Phone number has to be exactly 10 digits!</b></h3></font>";
                            break;
                        case "passletters":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Password has to contain only letters!</b></h3></font>";
                            break;
                        case "passerror":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Incorrect phone / password combination entered!</b></h3></font>";
                            break;
                        case "sqlerror":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; User could not be logged in due to an error in the SQL</b></h3></font>";
                            break;
                        case "undeferror":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; User could not be logged in due to an undefined error</b></h3></font>";
                            break;
                    }
                }
                ?>
				</div>	
			);
		  }
		}
    ReactDOM.render(
        <LoginForm />, 
        document.getElementById('root')
    );
    </script>
</body>

</html>