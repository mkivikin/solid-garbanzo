<?php

require("functions.php");
require("control.css");
require("config.php");
require("control.js");
	
	$signupFirstName = "";
	$signupLastName = "";
	$signupEmail = "";
	$signupUserName = "";
	//$signupPassword ="";
    //$confirmPassword ="";
	
	$signupFirstNameError = "";
	$signupLastNameError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupUserNameError= "";
	$confirmPasswordError= "";

	
	if(isset($_POST["signupButton"])){	
		
	if (isset ($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName =($_POST["signupFirstName"]);
		}
	}
	
	if (isset ($_POST["signupLastName"])){
		if (empty($_POST["signupLastName"])){
			$signupLastNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupLastName =($_POST["signupLastName"]);
		}
	}

	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail =($_POST["signupEmail"]);
						
			$signupEmail = filter_var($signupEmail, FILTER_SANITIZE_EMAIL);
			$signupEmail = filter_var($signupEmail, FILTER_VALIDATE_EMAIL);
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			$signupPasswordError = "NB! Väli on kohustuslik!";
		}  else if (strlen($_POST["signupPassword"]) < 8) {
			$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}
		}
	
	if (isset ($_POST["confirmPassword"])){
		if (empty ($_POST["confirmPassword"])){
			$confirmPasswordError = "NB! Väli on kohustuslik!";
		} else if ($_POST["confirmPassword"] != $_POST["signupPassword"]){
				$signupUserNameError = "Paroolid ei kattu!";
			}
		}
	
	if (isset ($_POST["signupUserName"])){
		if (empty ($_POST["signupUserName"])){
			$signupUsernameError = "NB! Väli on kohustuslik!";
		} else {
			$signupUserName =($_POST["signupUserName"]);
		} /*else if (strlen($_POST["signupUserName"]) < 6){
			$signupUserNameError = "NB! Liiga lühike nimi, vaja vähemalt 6 tähemärki!";
	}*/
  }

	
		/*$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupUserName, $signupPassword, $signupEmail, $signupFirstName, $signupLastName);*/
		
	if (!empty($_POST["signupButton"])){
		echo "Hakkan salvestama!";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupUserName, $signupPassword, $signupEmail, $signupFirstName, $signupLastName);
	}
	}
?>
<!DOCTYPE html>
<head>
</head>
<body>
<div class="container">
<form  method="POST">
  <h1>Registreeri</h1><br/>

  <span class="input"></span>
  <input type="text" name="signupFirstName" placeholder="Eesnimi" required />
  <span class="input"></span>
  <input type="text" name="signupLastName" placeholder="Perekonnanimi" required />
  <span class="input"></span>
  <input type="email" name="signupEmail" placeholder="Email" title="Näidisemail kasutaja@kasutaja.ee" required />
  <span class="input" span>
  <input type="text" name="signupUserName" placeholder="Kasutajatunnus" id="username" pattern=".{6,}" title="Kasutajatunnus peab olema vähemalt 6 tähemärgi pikkune!" onchange="validate()" required />
  <span class="input" id="span1"></span>
  <input type="password" name="signupPassword" id="password" placeholder="Parool" onchange="checkPassword()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Peab sisaldama vähemalt ühte suurt tähte, ühte väikest tähte, ühte numbrit ning pikkuselt vähemalt 8 tähemärki!" required />
  <span class="input" id="span2"></span>
  <input type="password" name="confirmPassword" id="cpassword" onchange="checkPassword()" placeholder="Korda parooli"required />
  <span id='message'></span>
  <br></br>
  <button type="submit" name="signupButton" id="submit" value="submit" title="Submit form" class="icon-arrow-right" onclick="checkPassword()" ><span>Registreeru</span></button>
</form>
</div>

</body>
</html>