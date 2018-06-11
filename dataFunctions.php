<?php

$database = "if17_Stressmap";
require('../../config.php');

//=============================START OF GPXREAD===========================================

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
	foreach($lines->trk->trkseg as $segment) {
		foreach($segment->trkpt as $point) {
			echo $point['lat'];
			echo '<br>';
			echo $point['lon'];
			echo '<br>';
			//echo $point->time;
			$insertTime = str_replace('T', ' ', $point->time);
			$insertTime = str_replace('Z', ' ', $insertTime);
			echo $insertTime;
			echo '<br>';
			$stmt->bind_param('isss', $experimentID, $point['lat'], $point['lon'], $insertTime);
			echo $mysqli->error;
			$stmt->execute();
		}
	}
	$stmt->close();
	$mysqli->close();
}
//=============================END OF GPXREAD===========================================

//=============================START OF MUSEREAD===========================================
function readMuse($fileName){
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
	$stmt = $mysqli->prepare("SELECT markerID, markerTime FROM Markers where experimentID = 1 ");
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
					$stmt1->bind_param('isssss', $markerID, $aVal, $bVal, $gVal, $dVal, $tVal);
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

//=============================END OF MUSEREAD===========================================

?>
