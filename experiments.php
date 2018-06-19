<?php
  require('dataFunctions.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
	body{
		background-color: #F8F9F9;
		display: flex;
  		justify-content: center;
  		align-items: center;

	}
 .login-header{
        font-size: 35px;
        color: #2FC0AE;
      }

.padded{
	padding-top: 8%;
}
</style>
</head>


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
              <a class="login" href="register.php">Registreeri</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


<div class="padded">
<p class="login-header">Eksperimendid</p>
    <table class="table table-responsive">
      <thead>
           <tr>
             <th>ExperimentID</th>
             <th>ExperimentCreator</th>
             <th>ExperimentDate</th>
             <th>ExperimentName</th>
             <th>Gender</th>
             <th>Age</th>
             <th>Edit</th>
           </tr>
</thead>
<?php
  loadExperiments();
 ?>
</table>
</div>    
</body>
<html>