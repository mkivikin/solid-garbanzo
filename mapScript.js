function initMap(){
    var options = {
      zoom:10,
      streetViewControl: false,
      center:{lat:59.4286454, lng:24.7321419},
      maxZoom: 19
    }
    var map = new google.maps.Map(document.getElementById('map'), options);
    fetchMarkers();


    //=================fetchMarkers Start============================
    function fetchMarkers() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var markers = JSON.parse(this.responseText);
            var heatmapData = new Array();
            for(m in markers) {
                pos = new google.maps.LatLng(markers[m][1], markers[m][2]);
                var weightedPos = {location: pos, weight: (markers[m][3]*10)};
                heatmapData.push(weightedPos);
            }
              var heatmap = new google.maps.visualization.HeatmapLayer({
              data: heatmapData,
              map: map
              });

              /*google.maps.event.addListener(map, 'zoom_changed', function(){
                  var zoom = map.getZoom();
                  console.log(zoom);
                  if (zoom >= 14){
                    heatmap.setOptions({
                    dissipating: true,
                    maxIntensity: 2000
                  });
                } else {
                  heatmap.setOptions({
                    dissipating: false,
                    radius: 20,
                    maxIntensity: 2000
                  });
                }
              });*/

        };
      }
      /*$.post("mapFunctions.php", {action:"test"}, function(result){
            var markers = result;
        });*/
      xmlhttp.open("GET", "mapFunctions.php", true);
      xmlhttp.send();
    }
    //==========================fetchMarkers End========================
}