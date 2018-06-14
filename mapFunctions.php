<?php

$database = "if17_Stressmap";
require('config.php');
require('dataFunctions.php');
if($_POST["action"]="default"){
    echo json_encode(loadMarkers());
}

function loadMarkers(){
  //
  cleanMarkers();
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
  //$stmt = $mysqli->prepare("SELECT MarkerID, Latitude, Longitude FROM Markers");
  $stmt = $mysqli->prepare("SELECT Markers.MarkerID, Markers.Latitude, Markers.Longitude, AVG(Measurements.AlphaValue), AVG(Measurements.BetaValue),
  AVG(Measurements.GammaValue), AVG(Measurements.ThetaValue), AVG(Measurements.DeltaValue), Experiments.ExperimentID, Experiments.ExperimentCreator,
  Experiments.ExperimentDate, Experiments.Gender, Experiments.Age
    FROM Measurements
    INNER JOIN Markers
    ON Measurements.MarkerID = Markers.MarkerID
    INNER JOIN Experiments
    ON Markers.ExperimentID = Markers.ExperimentID
    GROUP BY MarkerID;");
  //$stmt->bind_param("i", $experimentID);
  $stmt->bind_result($markerID, $latitude, $longitude, $aVal, $bVal, $gVal, $tVal, $dVal, $experimentID, $creator, $date, $gender, $age);
  $stmt->execute();
  if($stmt->fetch()) {
    //1460-1485
    $output = array();
    while($stmt->fetch()) {
      $line = array($markerID, $latitude, $longitude, $aVal, $bVal, $gVal, $tVal, $dVal, $experimentID, $creator, $date, $gender, $age);
      array_push($output, $line);
    }
  } else {
    $output = "Failed to fetch the markers";
  }
  return $output;
}
//SELECT avg(AlphaValue) FROM Measurements where MarkerID = 1200;
//SELECT Marker.MarkerID, Marker.Latitude, Marker.Longitude, avg(AlphaValue) FROM Markers
?>
