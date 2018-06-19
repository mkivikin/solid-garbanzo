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
	
	if(isset($_SESSION["userid"])){
	header("Location: index.php");
	exit();
}

	
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
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<style>
	body{
		padding-top: 5%;
		/**background-color: #F8F9F9; **/
	}
	.padded{
		padding-top:2px;
	}
	.h1color{
		color:#2FC0AE;
	}
	.errorwidth{
		max-width: 100%
	}
</style>


<body>

<!-- Navbar -->
     <nav class="shadow navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Stressikaart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="map.php">Kaart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="experiments.php">Katsed</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="upload.php">Lisa faile</a>
            </li>
            <li class="nav-item">
              <a class="login" href="login.php">Logi sisse</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<div class="container">
<form  method="POST">
  <h1 class="h1color">Kasutaja loomine</h1><br/>

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
  <button type="submit" name="signupButton" id="submit" value="submit" title="Submit form" class="btn btn-success" onclick="checkPassword()" ><span>Registreeru</span></button>
</form>
</div>

</body>
</html>