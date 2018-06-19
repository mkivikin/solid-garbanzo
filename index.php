<?php
//Et pääseks ligi funktsioonidele ja sessionile

$notice = "";
require("config.php");
require("functions.php");

if(isset($_GET["logout"])){
	echo "test";
	session_destroy();
	header("Location: login.php");
	exit();
}

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <title>Stressikaart</title>

     <style>
      body {
        background-image: url("dsg/map.jpg");
        background-size: 100%;
        background-repeat: no-repeat;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
      .shadow {
        box-shadow: 5px 5px 2px grey;
      }
      .cont{
        background-color:#D5DBDB;
      }
    </style>

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
              <?php if(!isset($_SESSION["userid"])){
								echo'<li class="nav-item">
								<a class="login" href="login.php">Logi sisse</a>
								</li>';
								} else {
								echo'<li class="nav-item">
								<a class="nav-link" href="?logout=1" >Logi välja!</a>
								</li>';
							}
							?>
          </ul>
        </div>
      </div>
    </nav>

  </head>

  <body>
    <!-- Login button -->
		<?php if(!isset($_SESSION["userid"])){
    echo'<div class="loginbutton">
      <div class="row">
        <div class="col-lg-12 text-center">
          <a class="btn btn-success" href="login.php">Logi sisse</a>
        </div>
      </div>
    </div>';
	}
?>

<!-- User guide -->
<div class="box container shadow">
  <div class="row">
        <div>
  <p style="color:#2C3E50"><b>Lihtne õpetus veebilehe kasutamiseks:</b></p>
  <li class="cont">Failide üleslaadimiseks ja eksperimenteerijate kontrollimiseks on tarvis kasutajat, seega esimese asjana tuleb registeerida endale uus kasutaja või sisse logida juba olemasoleva kasutajaga.</li>
  <br>
  <li>Pärast sisselogimist on võimalik liikuda navigatsiooniribal “Katsed” ja “Lisa faile” lehtedele ning seal ka tegutseda.</li>
  <br>
  <li class="cont">”Lisa faile” lehel tuleb anda eksperimendile nimi, sugu ja vanus. Seejärel vajutada nupule “Lehitse” ning valida 1 gpx fail ja sellega samaaegselt loodud csv fail. Seejärel vajutage “Loo eksperiment” ning andmebaasid asuvad tegutsema.</li>
  <br>
  <li>Pärast on võimalus kontrollida, kas kõik läks nii nagu ta pidi - lehele “Katsed” ilmub lisatud eksperimendi nimi, sugu ja vanus.</li>
  <br>
  <li class="cont">Seejärel võite navigatsiooniribalt liikuda lehele “Kaart” ning kõik muu on Teie eest tehtud.</li>
</div>
  </div>
</div>
</div>

  </body>

<!-- Footer
<footer>
    <div class="footer">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <h1>Tere</h1>
            <ul class="column list-unstyled">
              <li><a href="index.html">Sup</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <h1>Tere1</h1>
            <ul class="column list-unstyled">
              <li><a href="uyegiris.html">Niisama</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <h1>Tere2</h1>
            <ul class="column list-unstyled">
              <li>Sama</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</footer> -->

</html>
