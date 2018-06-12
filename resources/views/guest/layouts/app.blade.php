<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Borneotrip.id | Borneo Destination</title>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href="{{ asset('guest/css/bootstrap.css') }}" rel='stylesheet' type='text/css'/>
<link href="{{ asset('guest/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--js--> 
<script src="{{ asset('guest/js/jquery.min.js') }}"></script>

<!--/js-->
<!--animated-css-->
<link href="{{ asset('guest/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
<script src="{{ asset('guest/js/wow.min.js') }}"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
@yield('additional-header')
<script>
 new WOW().init();
</script>
<!--/animated-css-->
</head>
<body>
@include('guest.partials.header')
@include('guest.partials.slider')
@include('guest.partials.profil')
@include('guest.partials.tour')
@include('guest.partials.testimoni')
@include('guest.partials.map')
@include('guest.partials.contact')
@include('guest.partials.berita')
@include('guest.partials.footer')
<!--/container-->
@yield('content')  

</body>
</html>