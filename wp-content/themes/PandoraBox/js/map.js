var mapAddress, markerTitle;

function initialize() {
	var geocoder;
	var map;

  	geocoder = new google.maps.Geocoder();
  	var latlng = new google.maps.LatLng(-34.397, 150.644);
  	var mapOptions = {
	    zoom: 15,
	    center: latlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	}

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  geocoder.geocode( { 'address': mapAddress}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      map.panBy(200,0);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
          title: markerTitle
      });
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function getMap(address, mtitle){
if (address) {mapAddress = address} else {mapAddress = 'Auckland, New Zealand'}
markerTitle = mtitle;
google.maps.event.addDomListener(window, 'load', initialize);
}