function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
function initMap(){

    var options = {
      zoom:10,
      streetViewControl: false,
      center:{lat:59.4286454, lng:24.7321419},
      maxZoom: 17
    }
    var map = new google.maps.Map(document.getElementById('map'), options);
    fetchMarkers();
    //=================fetchMarkers Start============================
    function fetchMarkers() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var markers = JSON.parse(this.responseText);
            let counter = 0;
            var heatmapData = new Array();
            var polyboi = new Array();
            for(m in markers) {
                pos = new google.maps.LatLng(markers[m][1], markers[m][2]);
                }
                var marker = new google.maps.Marker({
                      map: map,
                      position: pos,
                      title : toString(markers[m][0])
                });
                google.maps.event.addListener(marker, 'click', function() {
                  infowindow.setContent(contentString);
                  infowindow.open(map,marker);
                });
            }
          }
          xmlhttp.open("GET", "mapFunctions.php", true);
          xmlhttp.send();
        }
    //==========================fetchMarkers End========================
}
