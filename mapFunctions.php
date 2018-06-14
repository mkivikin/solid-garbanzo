<?php

$database = "if17_Stressmap";
require('../../config.php');
require('dataFunctions.php');
/*If($_POST["action"]="test"){
    echo "ASDASDASDASFDSV DFV";
}*/

function loadMarkers($experimentID){
  cleanMarkers();
  $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],$GLOBALS["serverPassword"], $GLOBALS["database"]);
  //$stmt = $mysqli->prepare("SELECT MarkerID, Latitude, Longitude FROM Markers");
  $stmt = $mysqli->prepare("SELECT Markers.MarkerID, Markers.Latitude, Markers.Longitude, AVG(Measurements.AlphaValue)
    FROM Measurements
    INNER JOIN Markers
    ON Measurements.MarkerID = Markers.MarkerID
    GROUP BY MarkerID;");
  //$stmt->bind_param("i", $experimentID);
  $stmt->bind_result($markerID, $latitude, $longitude, $aVal);
  $stmt->execute();
  if($stmt->fetch()) {
    //1460-1485
    $output = array();
    while($stmt->fetch()) {
      $line = array($markerID, $latitude, $longitude, $aVal);
      array_push($output, $line);
    }
  } else {
    $output = "Failed to fetch the markers";
  }
  return $output;
}

echo json_encode(loadMarkers(13));
//SELECT avg(AlphaValue) FROM Measurements where MarkerID = 1200;
//SELECT Marker.MarkerID, Marker.Latitude, Marker.Longitude, avg(AlphaValue) FROM Markers
?>
