function initMap(){
  fetchMarkers();
    var options = {
      zoom:10,
      streetViewControl: false,
      center:{lat:59.4286454, lng:24.7321419}
    }
    let map = new google.maps.Map(document.getElementById('map'), options);
    //=================fetchMarkers Start============================
    function fetchMarkers() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var markers = JSON.parse(this.responseText);
            let counter = 0;
            for(m in markers) {
                pos = new google.maps.LatLng(markers[m][1], markers[m][2]);

                var infowindow = new google.maps.InfoWindow({
                content: markers[m][0].toString()
                });

                var marker = new google.maps.Marker({
                      map: map,
                      position: pos,
                      title : toString(markers[m][0])
                });
                marker.addListener('click', function() {
                infowindow.open(map, this);
            });
          }
        }
    };
    xmlhttp.open("GET", "mapFunctions.php", true);
    xmlhttp.send();
    }
    //==========================fetchMarkers End========================
}
