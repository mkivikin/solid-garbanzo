google.maps.event.addListener(map, 'zoom_changed', function() {
  var zoom = map.getZoom();
  if (zoom <= 10) {
    Polyline.setOptions({strokeColor: "#000000"});
  } else {
    Polyline.setOptions({strokeColor: "#666DDD"});
  }
  console.log(zoom);
});
