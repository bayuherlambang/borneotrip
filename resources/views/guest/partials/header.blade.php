<!--header-->
<!--sticky-->
<div class="header-top">
<!--container-->
	<div class="container">
	 	<div class="top-nav">
			<div class="logo">
				<a href="{{route('guest_home')}}"><img src="{{ asset('guest/images/logo1.png') }}" id="section-1" class="img-responsive" alt=""/></a>
				</div>
				<div class="menu">
				<ul id="nav">
					 <li><a href="{{route('guest_home')}}#section-1">Home</a></li>
					 <li><a href="{{route('guest_home')}}#section-2">About</a></li>
					 <li><a href="{{route('guest_home')}}#section-3">Top tours</a></li>
					 <li><a href="{{route('guest_home')}}#section-4">Guides</a></li>
					 <li><a href="{{route('guest_home')}}#section-5">Contact</a></li>
					 <div class="clearfix"></div>
				 </ul>
			</div>
		</div>
	<div class="clearfix"> </div>
	</div>
</div>
<script src="{{ asset('guest/js/jquery.scrollTo.js') }}"></script>
<script src="{{ asset('guest/js/jquery.nav.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#nav').onePageNav({
			begin: function() {
			//console.log('start')
			},
			end: function() {
			//console.log('stop')
			}
		});
	});
</script>