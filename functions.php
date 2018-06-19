<?php
session_start();
$database = "if17_Stressmap";
require("config.php");

	function signIn($loginUserName, $loginPassword){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT UserID, UserName, Password, Email, FirstName, LastName FROM Users WHERE UserName = ?");
		$stmt->bind_param("s", $loginUserName);
		$stmt->bind_result($UserId, $UserNameFromDb, $PasswordFromDb, $EmailFromDb, $FirstNameFromDb, $LastNameFromDb);
		$stmt->execute();
		
		if ($stmt->fetch()){	
			$hash = hash("sha512", $loginPassword);
			if ($hash == $PasswordFromDb){
				$notice = "Logisite sisse!";
				
				$_SESSION["userid"] = $UserId;
				$_SESSION["UserName"] = $UserNameFromDb;
				$_SESSION["FirstName"] = $FirstNameFromDb;
				$_SESSION["LastName"] = $LastNameFromDb;
				$_SESSION["Email"] = $EmailFromDb;
				
				
				header("Location: index.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$loginUserName .") ei ole!";
		}
		return $notice;
	}


function signUp($signupUserName, $signupPassword, $signupEmail, $signupFirstName, $signupLastName){
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO Users (UserName, Password, Email, FirstName, LastName) VALUES (?, ?, ?, ?, ?)");
	echo $mysqli->error;
	//s - string
	//i - integer
	//d - decimal
	$stmt->bind_param("sssss",  $signupUserName, $signupPassword, $signupEmail, $signupFirstName, $signupLastName);
	//$stmt->execute();
	if ($stmt->execute()){
		//echo "\n Õnnestus!";
		//echo("<script>location.href = '/~rooppeet/Veebiprogre/login.php$msg';</script>");
		header("Location: login.php");
		exit();
	} else {
		echo "\n Tekkis viga : " .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
}

?>
