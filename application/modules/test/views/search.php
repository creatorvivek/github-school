<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script> -->
  <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyC29AuoDi4-Bsh-8zPHr-Z2sgJHxSOZn90"></script>
</head>
<body>
<div id="map" style="width: 100%; height: 300px;"></div>  

<?= $latitude ?>
<script type="text/javascript">
function initialize() {
  // console.log($lat);
  // console.log(<?= $latitude ?>);
   var latlng = new google.maps.LatLng(<?= $latitude ?>,<?= $longitude ?>); 
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoomControl: true,
    mapTypeControl: true,
    scaleControl: true,
    streetViewControl: true,
    overviewMapControl: true,
    rotateControl: true   ,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      // draggable: true,
      animation: google.maps.Animation.DROP,
      anchorPoint: new google.maps.Point(0, -29),
      title:"i am here"
   });
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow();   
    google.maps.event.addListener(marker, 'click', function() {
       geocodeLatLng(geocoder, map, infowindow);
      
    });
}
function geocodeLatLng(geocoder, map, infowindow) {
 
  var latlng = {lat: parseFloat(<?= $latitude ?>), lng: parseFloat(<?= $longitude ?>)};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[0]) {
        map.setZoom(11);
        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        });
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>