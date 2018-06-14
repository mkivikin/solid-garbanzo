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
	<link rel="stylesheet" href="upload.css">
	<!--<script src="upload.js" defer></script>-->
	<title>
		Marek
	</title>
</head>
<body>
		<div id="formContainer">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
				<span id="experimentNameSpan">Eksperimendi nimi: </span>
				<input type="text" name="experimentName" id="experimentName">
				<br>
				<span id="experimentGender">Eksperimendi katsealuse sugu: </span>
				<select name="experimentGender">
					<option value="">Select...</option>
					<option value="">Male</option>
					<option value="">Female</option>
				</select>
				<br>
				<span id="experimentAge">Eksperimendi katsealuse vanus: </span>
				<select name="experimentAge">
					<option value="">Select...</option>
					<?php foreach(range(1,120) as $value){
						echo('<option value="' . $value . '">' . $value . '</option>');
					}?>
				</select>
				<br>
				<h1>Lohista failid siia</h1>
				<!--<div id="dropfiles" class="dropfile" ondrop="upload(event, this)" ondragover="onDrag(event, this)" ondragleave="onLeave(event, this)"></div> -->
				<input type="file" name="files[]" id="filesupload" multiple="multiple">
				<input type="submit" value="Loo eksperiment" name="submit">
			</form>
		</div>
	</p>

</body>
</html>
