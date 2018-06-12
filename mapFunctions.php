<?php
$database = "if17_Stressmap";
require('../../config.php');
function loadMarkers($experimentID){
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
  $stmt = $mysqli->prepare("SELECT MarkerID, Latitude, Longitude FROM Markers WHERE ExperimentID = ?");
  $stmt->bind_param("i", $experimentID);
  $stmt->bind_result($markerID, $latitude, $longitude);
  $stmt->execute();
  if($stmt->fetch()) {
    $output = array();
    while($stmt->fetch()) {
      $line = array($markerID, $latitude, $longitude);
      array_push($output, $line);
    }
  } else {
    $output = "Failed to fetch the markers";
  }
  return $output;
}

echo json_encode(loadMarkers(12));
?>
