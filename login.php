<?php
  //require("style.css");
  require("functions.php");
  require("config.php");
  
  $notice = "";
  $loginUserName = "";
  $loginPassword = "";
  $loginUsernameError = "";
  $loginPasswordError = "";
  
  	if(isset($_SESSION["userid"])){
	header("Location: index.php");
	exit();
}
  
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="vendor/bootstrap/css/upload.css">
  
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <title>Sisselogimine</title>

    <style>
      body {
        padding-top: 10%;
        background-image: url("dsg/map.jpg");
        background-size: 100%;
        background-repeat: no-repeat;
      }
      .login-header{
        font-size: 30px;
        padding-top: 1px;
        padding-bottom: 20px;
        color: #2FC0AE;
      }
      .shadow {
        box-shadow: 5px 5px 2px grey;
        }
    </style>
</head>

<body>  
   <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Stressikaart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
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
              <a class="login" href="register.php">Registreeri</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<section id="login">  
  <div class="box container shadow">
      <div class="col-xs-12">
         <h1 class="login-header"> <b>Sisselogimine</b></h1>
    <form role="form"  method="POST" id="login-form" autocomplete="off">
    <div class="form-group">
      <input type="text" name="loginUserName" class="form-control" placeholder="Kasutajatunnus" required />
    </div>
    <div class="form-group">
      <input type="password" name="loginPassword" class="form-control" placeholder="Parool" required />
    </div>

<div class="loginbutton">
      <div class="row">
        <div class="col-lg-12 text-center">
          <input name="loginButton" type="submit" class="btn btn-success" value="Logi Sisse"> <span><?php echo $notice; ?></span>
          <ul class="list-unstyled">
          </ul>
        </div>
      </div>
    </div>

    </form>
     </div>
    </div>
  </div>
</div>
       </div>
    </div>
  </section>
</body>
</html>