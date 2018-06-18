<?php

$database = "if17_Stressmap";
require('../../config.php');

//=============================START OF GPXREAD===========================================
function createExperiment($experimentName, $experimentCreator, $experimentAge, $experimentGender) {
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO Experiments (ExperimentCreator, ExperimentName, Gender, Age) values (?, ?, ?, ?)");
	$stmt->bind_param('ssis', $experimentCreator, $experimentName, $experimentAge, $experimentGender);
	$stmt->execute();
	$stmt = $mysqli->prepare("SELECT ExperimentID FROM Experiments ORDER BY ExperimentDate DESC LIMIT 1;");
	$stmt->bind_result($experimentID);
	$stmt->execute();
	if($stmt->fetch()) {
		return $experimentID;
	} else {
		return "Experiment not created";
	}
}

function cleanMarkers() {
	//Function that deletes all the markers without any measurements referencing to them
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("DELETE FROM Markers WHERE MarkerID not in (SELECT MarkerID FROM Measurements);");
	$stmt->execute();
}

function cleanExperiments() {
	//Function that deletes all the experiments without any markers referencing to them
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("DELETE FROM Experiments WHERE ExperimentID not in (SELECT ExperimentID FROM Markers);");
	$stmt->execute();
}

function filestoDB($files, $experimentID){
	$gpx = array();
	$csv = array();
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO Files (FileName, ExperimentID) values (?, ?)");
	foreach($files as $file) {
		$stmt->bind_param('si', $file, $experimentID);
		$stmt->execute();
		if(strpos($file, '.gpx') !== false) {
			array_push($gpx, $file);
		}
		if(strpos($file, '.csv') !== false) {
			array_push($csv, $file);
		}
		}
		foreach($gpx as $gpxfile) {
			readGpx($gpxfile, $experimentID);
		}
		foreach($csv as $csvfile) {
			readMuse($csvfile, $experimentID);
	}
}


function checkDaylightSavingTime(){
	if (date('I') == 1) {
		return 'PT3H';
	} else {
		return 'PT2H';
	}
}

function readGpx($fileName, $experimentID){
	$lines = simplexml_load_string(file_get_contents($fileName));
	//simpleXML attribute example
	//var_dump($lines);
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("INSERT INTO Markers (ExperimentID, Latitude, Longitude, MarkerTime) values (?, ?, ?, ?)");
	$haversineCounter = 0;
	$prevLat;
	$prevLon;
	foreach($lines->trk->trkseg as $segment) {
	 $count = 0;
		foreach($segment->trkpt as $point) {
			if($haversineCounter == 0) {
				$insertTime = str_replace('T', ' ', $point->time);
				$insertTime = str_replace('Z', ' ', $insertTime);
				$stmt->bind_param('isss', $experimentID, $point['lat'], $point['lon'], $insertTime);
				$stmt->execute();
				$prevLat = $point['lat'];
				$prevLon = $point['lon'];
			} else {
				$distance = getDistance($point['lat'], $point['lon'], $prevLat, $prevLon);
				//if(doubleVal($distance) > 0.5){
				if($prevLat != $point['lat'] && $prevLon != $point['lon']) {
					$insertTime = str_replace('T', ' ', $point->time);
					$insertTime = str_replace('Z', ' ', $insertTime);
					$stmt->bind_param('isss', $experimentID, $point['lat'], $point['lon'], $insertTime);
					$stmt->execute();
				} else {
					//skip marker
				}
			}
			}
			$prevLat = $point['lat'];
			$prevLon = $point['lon'];
			$count++;
			$haversineCounter++;
		}
		$stmt->close();
		$mysqli->close();
	}

//=============================END OF GPXREAD===========================================

//=============================START OF MUSEREAD===========================================
function readMuse($fileName, $experimentID){
	$csv = array();
	$data = array();
	$lines1 = file('museTest.csv', FILE_IGNORE_NEW_LINES);
	foreach($lines1 as $key => $value) {
		$csv[$key] = str_getcsv($value);
	}
	$len = count($csv);
	$readingCount = 1;
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$mysqli1 = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT markerID, markerTime FROM Markers where experimentID = ? ");
	$stmt->bind_param('i', $experimentID);
	$stmt->bind_result($markerID, $markerTime);
	$stmt->execute();
	$counter = 0;
	$stmt1 = $mysqli1->prepare("INSERT INTO Measurements (MarkerID, AlphaValue, BetaValue, GammaValue, DeltaValue, ThetaValue) values (?, ?, ?, ?, ?, ?)");
	while($stmt->fetch()) {
		for($i = $readingCount; $i<$len; $i++) {
			//Gets the average wave values from four different sensors and returns the average
			$aVal = ($csv[$i][9]+$csv[$i][10]+$csv[$i][11]+$csv[$i][12])/4;
			$bVal = ($csv[$i][13]+$csv[$i][14]+$csv[$i][15]+$csv[$i][16])/4;
			$gVal = ($csv[$i][17]+$csv[$i][18]+$csv[$i][19]+$csv[$i][20])/4;
			$dVal = ($csv[$i][1]+$csv[$i][2]+$csv[$i][3]+$csv[$i][4])/4;
			$tVal = ($csv[$i][5]+$csv[$i][6]+$csv[$i][7]+$csv[$i][8])/4;
			$time = $csv[$i][0];
			$timeObject = new DateTime($time);
			$markerTimeObject = new DateTime($markerTime);
			//Syncs the Muse localtime with UTC markertime
			$syncAmount = checkDaylightSavingTime();
			$timeObject->sub(new DateInterval($syncAmount));
			$readingCount++;
			if($timeObject <= $markerTimeObject){
				if($aVal != 0 || $bVal != 0 || $gVal != 0 || $dVal != 0 || $tVal != 0){
					$stmt1->bind_param('iddddd', $markerID, $aVal, $bVal, $gVal, $dVal, $tVal);
					$stmt1->execute();
				} else {
					//Faulty readings wont be entered in to the database
				}
			} else {
				//Exits this for cycle to avoid pointlessly going through the entire list.
				break;
			}
		}
	}
	$stmt->close();
	$stmt1->close();
	$mysqli->close();
	$mysqli1->close();
}
//============================END OF MUSEREAD===========================================

function loadExperiments() {
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT ExperimentID, Users.UserName, ExperimentName, ExperimentDate, Gender, Age FROM Experiments
		INNER JOIN Users on Experiments.ExperimentCreator = Users.UserID
	");
	$stmt->bind_result($experimentID, $experimentCreator, $ExperimentName, $ExperimentDate, $gender, $age);
	$stmt->execute();
	while($stmt->fetch()) {
		echo '<tr><td>'.$experimentID .'</td><td>'. $experimentCreator .'</td><td>'.$ExperimentDate.'</td><td>' .$ExperimentName .'</td><td>'. $gender .'</td><td>'. $age.'</td><td><a class="btn" href="editExperiment.php?id='.$experimentID.'">Edit</a></td></tr>';
		echo '<br>';
	}
	$stmt->close();
	$mysqli->close();
}

function getRad($x){
	return $x * pi();
}
function getDistance($lat1, $lon1, $lat2, $lon2){
	$Radius = 6378137;
	$dLat = getRad($lat2 - $lat1);
	$dLon = getRad($lon2 - $lon2);
	$angle = 2 * asin(sqrt(pow(sin($dLat / 2), 2) + cos(doubleVal($lat1)) * cos(doubleVal($lat2)) * pow(sin($dLon / 2), 2)));
	return ($angle * $Radius * 1000); //Distance in meters
}
?>
