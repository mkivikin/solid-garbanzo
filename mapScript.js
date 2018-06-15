function initMap(){
    var options = {
      zoom:10,
      streetViewControl: false,
      center:{lat:59.4286454, lng:24.7321419},
      maxZoom: 19
    }

    var map = new google.maps.Map(document.getElementById('map'), options);
    var action = "default";
    var value = "";
    fetchMarkers(action, value);

    //=================fetchMarkers Start============================
    function fetchMarkers(action, value) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var markers = JSON.parse(this.responseText);
            console.log(markers);
            createHeatmap(markers, map);
        };
      }
      /*$.post("mapFunctions.php", {action:"test"}, function(result){
            var markers = result;
        });*/
      xmlhttp.open("POST", "mapFunctions.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      if(action === "default") {
        xmlhttp.send("action=" + action);
      }
    }
    //==========================fetchMarkers End========================
}

function createHeatmap(markers, map) {
    var heatmapData = new Array();
    var weight;
    for(m in markers) {
        pos = new google.maps.LatLng(markers[m]["Latitude"], markers[m]["Longitude"]);
        var weight = reciprocal(markers[m]["alphamedian"]);
        var weightedPos = {location: pos, weight: (weight*100)};
        heatmapData.push(weightedPos);
    }
      var heatmap = new google.maps.visualization.HeatmapLayer({
      data: heatmapData,
      map: map
    });
    heatmap.setOptions({
      maxIntensity: 2000});


                    google.maps.event.addListener(map, 'zoom_changed', function(){
                        var zoom = map.getZoom();
                        console.log(zoom);
                        if (zoom == 16){
                          heatmap.setOptions({
                          maxIntensity: 2000
                        });
                      } else {
                        heatmap.setOptions({
                          maxIntensity: 3000
                        });
                      }
                    });
}



function checkBox(id){
  let checkBox = document.getElementById(id);
  if(checkBox.checked){
    fetchMarkers("byExperimentID", id);
    console.log("Ahoy");
  }
}

function reciprocal(number){
var gcd = function(a, b) {
  if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.

  return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
};

var fraction = number;
var len = fraction.toString().length - 2;

var denominator = Math.pow(10, len);
var numerator = fraction * denominator;

var divisor = gcd(numerator, denominator);    // Should be 5

numerator /= divisor;                         // Should be 687
denominator /= divisor;                       // Should be 2000

var test = denominator / numerator;
console.log(test);
return test;
}

function theFilter(input, key){
  var filteredInput = new Array();
  for (i = 0; i < input.length; i++) {
    for (j = 0; j < input[i].length;  j++) {
      if(key.includes(input[i][j])) {
        filteredInput.push(input[i][j]);
      }
    }
  }
  return(filteredInput);
}
