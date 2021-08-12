<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Company | Register</title>
    <meta name="description" content="Sign up to be able to order great cars!">
    <meta name="keywords" content="Cars, sale, buy, BMW, Toyota, best, prices, sign, up, register, order, place">
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

    <!-- registration form will be displayed here -->
    <div id="root">
    </div>

    <!-- registration form definition -->
    <script type="text/babel">
        class RegistrationForm extends React.Component {
            constructor(props) {
			super(props);
			
            // bind events
			this.handleNameChanged = this.handleNameChanged.bind(this);
			this.handlePhoneChanged = this.handlePhoneChanged.bind(this);
			this.handleEmailChanged = this.handleEmailChanged.bind(this);	
			this.handlePasswordChanged = this.handlePasswordChanged.bind(this);	
		    }
		  
			// name needs to be only letters
			handleNameChanged(event) {
                document.getElementById("submit").disabled = true;
				var input = event.target.value.toString();
				// regex testing for anyhting that is not a letter or whitespace between letters
				if(!/[A-Za-z]+$|^$|^\s$/.test(input)) { // inputted wrong
					// display hint
                    document.getElementById("hint_name").innerHTML = "<font color='red'><b>&#10060; Name must be only letters</b></font>";
					// disable register button 
					document.getElementById("submit").disabled = true;
				}else{ 
                    if(input.length > 1){ // inputted right
                        // display confirmation
                        document.getElementById("hint_name").innerHTML = "<font color='pastelgreen'><b>&#10003; Name ok</b></font>";
                        // enable register button
                        document.getElementById("submit").disabled = false;
                    }else{ // too short
                        document.getElementById("hint_name").innerHTML = "<font color='white'>Name must be 2 letters minimum, no numbers or symbols</font>";
                    }
                }
		    }

			// phone number needs to be only numbers
            handlePhoneChanged(event) {
                document.getElementById("submit").disabled = true;
				var input = event.target.value.toString();
				// regex testing for anything that is not a number, including whitespaces
				if(!/^[0-9]*$/.test(input)) {// inputted wrong
					document.getElementById("hint_phone").innerHTML = "<font color='red'><b>&#10060; Phone must be 10 numbers and no other character!</b></font>";
				}else{ 
                    if(input.length == 10){ // inputted right
                        document.getElementById("hint_phone").innerHTML = "<font color='pastelgreen'><b>&#10003; Phone ok</b></font>";
                        document.getElementById("submit").disabled = false;
                    }else{ // too short
                        document.getElementById("hint_phone").innerHTML = "<font color='white'>Phone must be 10 numbers</font>";
                    }
                }
            }

            // email needs to be something@something.something only
            handleEmailChanged(event) {
                document.getElementById("submit").disabled = true;
                var input = event.target.value.toString();
                // regex checking email format, removing special chars
                if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(input)) {
                    document.getElementById("hint_email").innerHTML = "<font color='red'><b>&#10060; Email must be in the format something@something.something</b></font>";
                }else{ 
                    if(input.length > 1){ // inputted right
                        document.getElementById("hint_email").innerHTML = "<font color='pastelgreen'><b>&#10003; Email ok</b></font>";
                        document.getElementById("submit").disabled = false;
                    }else{ // too short (should never happen)
                        document.getElementById("hint_email").innerHTML = "<font color='white'>Email must be in the format something@something.something</font>";
                    }
                }
            }

            handlePasswordChanged(event) {
                document.getElementById("submit").disabled = true;
				var input = event.target.value.toString();
				// regex testing for anyhting that is not a letter or whitespace between letters
				if(!/[A-Za-z]+$|^$|^\s$/.test(input)) { // inputted wrong
                    document.getElementById("hint_password").innerHTML = "<font color='red'><b>&#10060; Password must be only letters</b></font>";
					document.getElementById("submit").disabled = true;
				}else{ 
                    if(input.length > 1){ // inputted right
                        // display confirmation
                        document.getElementById("hint_password").innerHTML = "<font color='pastelgreen'><b>&#10003; Password ok</b></font>";
                        // enable register button
                        document.getElementById("submit").disabled = false;
                    }else{ // too short
                        document.getElementById("hint_password").innerHTML = "<font color='white'>Password must be 2 letters minimum, no numbers, symbols, or spaces</font>";
                    }
                }
            }

		    render() {
			return (
				<div class="container">
                <br/>
                <h4>Register New User</h4>
                <br/>
                <form class="form-signup" name="user_registration_form" action="./functions/register_user.php" method="POST">
				<div class="form-group">
				
                <div class="form-group row">
                <label for="name_input" class="col-sm-2 col-form-label"><h5>Username</h5></label>
				<br/>
                <div class="col-sm-10">
				<input type="text" class="form-control form-control-lg" name="name_input" id="name_input" onChange={this.handleNameChanged} placeholder="Julian Robinson" required/>
                <div id="hint_name"></div>
				</div>
                </div>
				<br/>

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
                <label for="email_input" class="col-sm-2 col-form-label"><h5>Email Address</h5></label>
				<br/>
                <div class="col-sm-10">
				<input type="email" class="form-control form-control-lg" id="email_input" name="email_input" onChange={this.handleEmailChanged} placeholder="julianrob@live.com" required/>
				<div id="hint_email"></div>
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
                <a href="login.php" class="btn btn-success btn-block btn-large">Already Registered - <small>Log In</small></a>
				</div>
                <div class="form-group col">
                <button type="submit" id="submit" name="submit" class="btn btn-info btn-block btn-large"><b>Register &#10003;</b></button>
                </div>
                </div>
				
                <br/>
                </div>
			    </form>				
                <?php
                if (isset($_GET['success'])) {
                    echo "<font color='pastelgreen'><h3><b>&#10003; User Successfully Registered!</b></h3><a href='./login.php'><button class='btn btn-success btn-large'>Log In</button></a></font>";
                } elseif (isset($_GET['error'])) {
                    switch ($_GET['error']) {
                        case "emptyfields":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; No field should be left empty!</b></h3></font>";
                            break;
                        case "nameletters":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Username has to be only letters!</b></h3></font>";
                            break;
                        case "phonenumbers":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Phone number has to be only numbers!</b></h3></font>";
                            break;
                        case "phonedigits":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Phone number has to be exactly 10 digits!</b></h3></font>";
                            break;
                        case "emailval":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Email has to be in the correct format! name@my.mail</b></h3></font>";
                            break;
                        case "passletters":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Password has to contain only letters!</b></h3></font>";
                            break;
                        case "userexists":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Error: User already exists in the database and was not registered</b></h3></font>";
                            break;
                        case "phoneexists":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; Error: The same phone number cannot be inserted in multiple accounts</b></h3></font>";
                            break;
                        case "sqlerror":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; User could not be registered due to an error in the SQL</b></h3></font>";
                            break;
                        case "undeferror":
                            echo "<font color='red'><h3 class=\"error\"><b>&#10060; User could not be registered due to an undefined error</b></h3></font>";
                            break;
                    }
                }
                ?>
				</div>	
			);
		  }
		}
    ReactDOM.render(
        <RegistrationForm />, 
        document.getElementById('root')
    );
    </script>
</body>

</html>