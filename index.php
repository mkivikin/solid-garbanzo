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
        padding-top: 54px;
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
      .box-max {
        word-wrap: break-word;
        text-align: center;
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
              <a class="nav-link" href="upload.php">Lisa faile</a>
            </li>
            <li class="nav-item">
              <a class="login" href="register.php">Registreeri</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  </head>

  <body>
    <!-- Login button -->
    <div class="loginbutton">
      <div class="row">
        <div class="col-lg-12 text-center">
          <a class="btn btn-success" href="login.php">Logi sisse</a>
        </div>
      </div>
    </div>

<!-- User guide -->
<div class="box container textmaxwidth">
  <div class="row">
        <div class="text-center box btn">
  <p>User guide tuleb siia
  </p>
</div>
  </div>
</div>
</div>

  </body>

<!-- Footer -->
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
</footer>

</html>
