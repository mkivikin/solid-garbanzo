<?php
	//require("style.css");
	require("functions.php");
	require("config.php");
	
	$notice = "";
	$loginUserName = "";
	$loginPassword = "";
	$loginUsernameError = "";
	$loginPasswordError = "";
	

	if(isset($_POST["loginButton"])){
	
	if (isset ($_POST["loginUserName"])){
		if (empty ($_POST["loginUserName"])){
			$loginUsernameError ="NB! Sisselogimiseks on vajalik kasutajatunnus!";
		} else {
			$loginUserName = $_POST["loginUserName"];
		}
	}
	
	if(!empty($loginUserName) and !empty($_POST["loginPassword"])){
		$notice = signIn($loginUserName, $_POST["loginPassword"]);
	}
	}
	
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sisselogimine</title>
  
  
  
      <!--<link rel="stylesheet" href="css/style.css">-->

  
</head>

<body>
	
  <div class="login-page">
  <div class="form">
  <h1>Logi Sisse</h1>
  <p>Kasutaja puudumisel on teil võimalus registeerida uus kasutaja</p>
    <form class="login-form" method="POST">
      <input type="text" name="loginUserName" placeholder="Kasutajatunnus" required />
      <input type="password" name="loginPassword" placeholder="Parool" required />
      <input name="loginButton" type="submit" value="Logi Sisse"> <span><?php echo $notice; ?></span>
    </form>
  </div>
  <h2>Registeeri kasutaja</h2>
  <form action="register.php">
  <input name="registerButton" type="submit" value="Registeeri uus kasutaja">
  </form>
</div>


</body>
</html>