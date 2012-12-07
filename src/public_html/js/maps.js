function initialize() {
  var map = new GMap2(document.getElementById("map_canvas"));
  map.addControl(new GSmallMapControl());
  map.addControl(new GMapTypeControl());
  map.setCenter(new GLatLng(43.65668,-79.380684), 14);

  // Create a base icon for all of our markers that specifies the
  // shadow, icon dimensions, etc.
  var baseIcon = new GIcon(G_DEFAULT_ICON);
  baseIcon.shadow = "images/marker-shadow.png";
  baseIcon.iconSize = new GSize(44, 49);
  baseIcon.shadowSize = new GSize(72, 49);
  baseIcon.iconAnchor = new GPoint(9, 34);
  baseIcon.infoWindowAnchor = new GPoint(9, 2);

  // Creates a marker whose info window displays the letter corresponding
  // to the given index.
  function createMarker(point, index) {
    // Create a lettered icon for this point using our icon class
    var letteredIcon = new GIcon(baseIcon);
    letteredIcon.image = "images/marker-image.png";

    // Set up our GMarkerOptions object
    markerOptions = { icon:letteredIcon };
    var marker = new GMarker(point, markerOptions);


    marker.openInfoWindowHtml("<strong>Rayku Headquarters</strong> <br /> 10 Dundas Street E Suite 502 <br /> Toronto, Ontario, Canada <br /><br /> Get in touch! <em>cs@rayku.com</em>");

    return marker;
  }

  // Add 10 markers to the map at random locations
  var bounds = map.getBounds();
  var southWest = bounds.getSouthWest();
  var northEast = bounds.getNorthEast();
  var lngSpan = northEast.lng() - southWest.lng();
  var latSpan = northEast.lat() - southWest.lat();
  var point = new GLatLng(43.65668,-79.380684);
  map.addOverlay(createMarker(point, 0));
}