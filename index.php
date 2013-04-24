<!DOCTYPE html>
<html>
<head>
<link href='style.css' rel='stylesheet' />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="util.js"></script>
<script type="text/javascript">
  var infowindow;
  var map;

  function initialize() {
    var myLatlng = new google.maps.LatLng(0, 0);
    var myOptions = {
      zoom: 17,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
downloadUrl("data.xml", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
        var marker = createMarker(markers[i].getAttribute("name"), latlng);
       }
     });
  }

  function createMarker(name, latlng) {
    var marker = new google.maps.Marker({position: latlng, map: map});
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: name});
      infowindow.open(map, marker);
    });
    return marker;
  }
if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
  
$('#recenter').click( function() {
    map.setCenter(pos);
	map.setZoom(17);
	
});

      var myLocation = new google.maps.Marker({
        map: map,
        position: pos,
	anchor: 0,
	icon: 'http://i.imgur.com/wZUAT8V.png'
      });
	google.maps.event.addListener(myLocation, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: '<h2>YOU ARE HERE!</h2>'});
      infowindow.open(map, marker);
    });
	
      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }

</script>
</head>
<body onload="initialize()">
<div id='nav'>
<div id="logo"><center><img src="http://i.imgur.com/1keL41X.png"></center></div>
<center><div class="controls">
	<a href="#" id="recenter"><div id="mylocation">MY LOCATION</div></a>
	<a href="#"><div id="places"><form action="">
<select name="places">
<option value="all">ALL PLACES</option>
<option value="atm">ATMs</option>
<option value="bar">Bars & Pubs</option>
<option value="casinos">Casinos</option>
<option value="food">Food</option>
<option value="gas">Gas Stations</option>
<option value="hospitals">Hospitals</option>
<option value="hotels">Hotels</option>
<option value="minimarkets">Minimarkets</option>
<option value="pharmacy">Pharmacies</option>
<option value="supermarkets">Supermarkets</option>
</select>
</form></div></a>
	<div id="search"> <input id="s" name="s" type="text" size="40" placeholder="SEARCH..." /></div>
</div>
</center>

            </div>
<div id='map'></div>
</body>
</html>

