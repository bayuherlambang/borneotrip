<div id="map"></div>  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgHnyFEq0oIjEJ_aBc7weL77z0Tq_STwE&libraries=places"></script>
<script type="text/javascript">
      
var locations = [
      @foreach($tour as $t)
        ['{{$t['judul_artikel']}}', {{$t['latitude']}},{{$t['longitude']}}],
      @endforeach
    ];
function initMap() {
  var loc = {lat: -3.316694, lng: 114.590111 };
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 9,
    center: loc
  });

    var infowindow;

    var marker, i;
    for (i = 0; i < locations.length; i++) { 
        infowindow = new google.maps.InfoWindow({
          content: locations[i][0]
        });
    }
    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        title: locations[i][0],
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      //infowindow.open(map,marker);
    }
    infowindow.open(map,marker);
  }
initMap();
</script>

<style type="text/css">
#map {
  height: 580px;
  width: 100%;
}

</style>