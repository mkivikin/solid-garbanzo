<?php

require("functions.php");
//require("registyle.css");
require("config.php");
	
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	$signupUsername = "";
	$signupPassword ="";
    $confirmPassword ="";
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupUsernameError= "";
	$confirmPasswordError= "";
	
	
		function validPW(){
		if(strlen($_POST["signupPassword"]) < 8) {            
		if(!ctype_upper($_POST["signupPassword"]) && !ctype_lower($_POST["signupPassword"])) {
			return FALSE;
		if($_POST["signupPassword"]=$_POST["confirmPassword"]){
			return FALSE;
	  }
	}
  }
}
	

	
	if(isset($_POST["signupButton"])){
		
		$test=validPW();
		echo $test;
	/*function validPW(){
		if(strlen($_POST["signupPassword"]) < 8) {            
		if(!ctype_upper($_POST["signupPassword"]) && !ctype_lower($_POST["signupPassword"])) {
			return TRUE;
		if($_POST["signupPassword"]=$_POST["confirmPassword"]){
			return TRUE;
	  }
	}
  }
}*/
	
	if (isset ($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName =($_POST["signupFirstName"]);
		}
	}
	
	if (isset ($_POST["signupFamilyName"])){
		if (empty($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName =($_POST["signupFamilyName"]);
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
		} else {
			if (strlen($_POST["signupPassword"]) < 8){
				$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}
		}
	}
	
	if (isset ($_POST["confirmPassword"])){
		if (empty ($_POST["confirmPassword"])){
			$confirmPasswordError = "NB! Väli on kohustuslik!";
		} else {
			if ($_POST["confirmPassword"] != $_POST["signupPassword"]);
				$signupUsernameError = "Paroolid ei kattu!";
			}
		}
	
	if (isset ($_POST["signupUsername"])){
		if (empty ($_POST["signupUsername"])){
			$signupUsernameError = "NB! Väli on kohustuslik!";
		} else {
			if (strlen($_POST["signupUsername"]) < 6){
				$signupUsernameError = "NB! Liiga lühike nimi, vaja vähemalt 6 tähemärki!";
			}
		}
	}
	
		/*$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword, $signupUsername);
	/*	
	if (!empty($_POST["signupButton"])){
		echo "Hakkan salvestama!";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		signUp($signupFirstName, $signupFamilyName, $signupEmail, $signupPassword, $signupUsername);
	}*/
	}
?>
<!DOCTYPE html>

<form  method="POST">
  <h1>Registreeri</h1><br/>

  <span class="input"></span>
  <input type="text" name="signupFirstName" placeholder="Eesnimi" required />
  <span class="input"></span>
  <input type="text" name="signupFamilyName" placeholder="Perekonnanimi" required />
  <span class="input"></span>
  <input type="email" name="signupEmail" placeholder="Email" required />
  <span class="input"></span>
  <input type="username" name="signupUsername" placeholder="Kasutajanimi" required />
  <span id="passwordMeter"></span>
  <input type="password" name="signupPassword" id="password" placeholder="Parool" required />
  <span class="input"></span>
  <input type="password" name="confirmPassword" id="password" placeholder="Korda parooli" required />

  <button type="submit" name="signupButton" value="Sign Up" title="Submit form" class="icon-arrow-right" ><span>Registreeru</span></button>
</form>
</html>