<?php
session_start();
$database = "if17_Stressmap";
require("config.php");

	function signIn($loginUsername, $loginPassword){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, username, firstname, lastname, email, password FROM chatusers WHERE email = ?");
		$stmt->bind_param("s", $loginUsername);
		$stmt->bind_result($id, $usernameFromDb, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		if ($stmt->fetch()){
			$hash = hash("sha512", $loginPassword);
			if ($hash == $passwordFromDb){
				$notice = "Logisite sisse!";
				
				$_SESSION["userId"] = $id;
				$_SESSION["username"] = $usernameFromDb;
				$_SESSION["firstname"] = $firstnameFromDb;
				$_SESSION["lastname"] = $lastnameFromDb;
				$_SESSION["userEmail"] = $emailFromDb;
				
				
				header("Location: index.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$username .") ei ole!";
		}
		return $notice;
	}


function signUp($signupUsername, $signupPassword, $signupEmail, $signupFirstName, $signupFamilyName){
	
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO Users (UserName, Password, Email, FirstName, LastName) VALUES (?, ?, ?, ?, ?)");
	echo $mysqli->error;
	//s - string
	//i - integer
	//d - decimal
	$stmt->bind_param("sssss",  $signupUsername, $signupPassword, $signupEmail, $signupFirstName, $signupFamilyName);
	//$stmt->execute();
	if ($stmt->execute()){
		//echo "\n Õnnestus!";
		//echo("<script>location.href = '/~rooppeet/Veebiprogre/login.php$msg';</script>");
		exit();
	} else {
		echo "\n Tekkis viga : " .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
}

?>
