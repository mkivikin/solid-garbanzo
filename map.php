<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<style>
   body {
   		background-image: none;
   		background-color: #F8F9F9;
        padding-top: 5%;
        padding-left: 25%;
      }

  #map{
    height: 600px;
    width:1000px;
  }
</style>
</head>

<body>

<!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
              <a class="nav-link" href="upload.php">Lisa faile</a>
            </li>
            <li class="nav-item">
              <a class="login" href="login.php">Logi sisse</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<!-- MAP -->
<div id= "intensitySliderContainer"></div>
<div id="map"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="mapScript.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBodsu1bZRowWo0767dbprzUHMPvVZe7l0&callback=initMap&libraries=visualization"></script>
</body>
<html>
