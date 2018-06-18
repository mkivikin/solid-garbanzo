<?php
require('dataFunctions.php');
if(!empty($_POST["experimentName"])) {
	if(!empty($_FILES['files']['name'][0])) {
		$files = $_FILES['files'];
		$file_dir = 'uploads/';
		$uploaded = array();
		$failed = array();

		$allowed = array('gpx', 'csv');

		foreach($files['name'] as $position => $file_name){
			$file_tmp = $files['tmp_name'][$position];
			$file_size = $files['size'][$position];
			$file_error = $files['error'][$position];
			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));
			if(in_array($file_ext, $allowed)) {
				if($file_error === 0) {
					if($file_size <= 2097152) {
							$new_filename = uniqid('', true) . '.' . $file_ext;
							$file_destination = $file_dir . $new_filename;
							if(move_uploaded_file($file_tmp, $file_destination)) {
								$uploaded[$position] = $file_destination;
							} else {
								$failed[$position] = "[{$file_name}] failed to upload";
							}
					} else {
						$failed[$position] = "[{$file_name}] is too large.";
					}
				} else {
					$failed[$position] = "[{$file_name}] failed to upload.";
				}
				} else {
				$failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not valid";
			} /*else {
				  for ($i = 0; $i < count($failed); $i++) {
				      echo $failed[i];
				  }*/
			}
			if(!empty($uploaded)) {
				$experimentID = createExperiment($_POST["experimentName"], 53, $_POST["experimentGender"] ,$_POST["experimentAge"]);
				FilestoDB($uploaded, $experimentID);
			}
	}
} else {
	$error = "Väli peab olema täidetud";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="vendor/bootstrap/css/upload.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!--<script src="upload.js" defer></script>-->
	<title>
		Failide laadimine
	</title>
	<style>
		body{
			padding-top: 10%;
        	background-image: url("dsg/map.jpg");
        	background-size: 100%;
        	background-repeat: no-repeat;
        	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			}

 		.login-header{
        font-size: 30px;
        padding-top: 1px;
        padding-bottom: 20px;
        color: #2FC0AE;
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

		<div id="formContainer">
			<div class="box container">
				<div class="col-xs-12">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
				<input class="form-control" type="text" name="experimentName" id="experimentName" placeholder="Eksperimendi nimi">
				<br>

				<span id="experimentGender">Eksperimendi katsealuse sugu: </span>
					<select name="experimentGender">
					<option value="">Select...</option>
					<option value="Male">Mees</option>
					<option value="Female">Naine</option>
				</select>
				<br>
				<br>
				<span id="experimentAge">Eksperimendi katsealuse vanus: </span>
				<select name="experimentAge">
					<option value="">Select...</option>
					<?php foreach(range(1,120) as $value){
						echo('<option value="' . $value . '">' . $value . '</option>');
					}?>
				</select>
				<br>
			</div>
		<br>
		<br>
				<!--<h1>Lohista failid siia</h1>
				<div id="dropfiles" class="dropfile" ondrop="upload(event, this)" ondragover="onDrag(event, this)" ondragleave="onLeave(event, this)"></div> -->


                        <input type="file" name="files[]" id="filesupload" multiple="multiple">
                    </div>
                </div>
				<br>
				<div>
				<input type="submit" class="btn btn-success" value="Loo eksperiment" name="submit">
			</div>
			</form>
		</div>
	</p>

</body>
</html>
