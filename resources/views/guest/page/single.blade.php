@extends('guest.layouts.page')
@section('additional-header')

@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="top-tours-head text-center">
        <h3 class="tour-guides-head" id="title">{{$data['title']}}</h3>
        <span></span><img src="{{ asset('guest/images/star.png') }}" alt=""><span></span><br>
        <div class="col-md-12">
            <img src="{{url('files/tour/').'/'.$data['image']}}" class="img-fluid" width=83%>
        </div>
        <span></span>
        <div class="col-md-12 artikel">
            <p>{{$data['content']}}</p>
        </div>
        <span></span>
      </div>
    </div>   

</div>
 <div id="map"></div>  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgHnyFEq0oIjEJ_aBc7weL77z0Tq_STwE&libraries=places"></script>
<script type="text/javascript">
      var title = '<h5>{{$data['title']}}</h5><br><p>{{$data['lokasi']}}</p>';
      
      function initMap() {
        var loc = {lat: {{$data['latitude']}}, lng: {{$data['longitude']}}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: loc
        });
        
        var infowindow = new google.maps.InfoWindow({
          content: title
        });
        var marker = new google.maps.Marker({
          position: loc,
          map: map,
          title: 'Uluru (Ayers Rock)'
        });
        marker.addListener('click', function() {
        infowindow.open(map, marker);
        });
        infowindow.open(map,marker);

      }

      initMap();
</script>

<style type="text/css">
#map {
  height: 400px;
  width: 100%;
  margin-top: 25px;
}

</style>
@endsection