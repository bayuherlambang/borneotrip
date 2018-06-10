<!--top-tours-->	
<div  class="section" id="section-3">
	<div id="portfolio" class="portfolio">
   		<div class="top-tours-head text-center">
		  	<h3>TOP TOURS</h3>
		  	<span></span><img src="{{ asset('guest/images/star.png') }}" alt=""><span></span>
		  	<div class="container">
				<p>Samber Gelap adalah salah satu pulau yang sangat unik, Bambu Rapting Loksado memberikan tantangan tersendiri, Pasar Terapung geliat ekonomi masyarakat dan kuliner khas, Terumbu Karang Angsana menyajikan pemandangan bawah laut yang mempesona atau ingin menyaksikan indahnya barisan pegunungan meratus dan sejuknya hawa di Gunung Mawar</p>
		  	</div>
		  	</div>
	      	<ul id="filters" class="clearfix wow bounceIn" data-wow-delay="0.4s">
				<li><span class="filter active" data-filter="@foreach($kategori as $k) {{$k['name']}} @endforeach">ALL</span></li>
				@foreach($kategori as $k)
				<li><span class="filter" data-filter="{{$k['name']}}">{{$k['name']}}</span></li>
				@endforeach
	      	</ul>
	 		<div id="portfoliolist">
	 			@foreach($tour as $t)
	 			
				<div class="portfolio {{$t['kategori']}} mix_all" data-cat="{{$t['kategori']}}" style="display: inline-block; opacity: 1;">
					<div class="portfolio-wrapper wow bounceIn" data-wow-delay="0.4s">		
						<a href="#" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
					    <img src="{{$t['gambar']}}" class="img-responsive" alt=""/></a>
						<div class="tour-caption">
							<span> </span>
							<a href="{{route('guest_single_page', ['judul' => $t['judul_artikel'], 'id' => $t['id']])}}">
							<p>{{$t['judul_artikel']}}</p>
							</a>	
						</div>
					</div>
				</div>
							
				@endforeach
	   			<div class="clearfix"></div>	
			</div>
	  		
	</div>
</div>  
<!-- Script for gallery Here-->
<script type="text/javascript" src="{{ asset('guest/js/jquery.mixitup.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		var filterList = {
			init: function () {
				$('#portfoliolist').mixitup({
					targetSelector: '.portfolio',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
				// call the hover effect
				onMixEnd: filterList.hoverEffect()
				});				
			},
			hoverEffect: function () {
			// Simple parallax effect
			$('#portfoliolist .portfolio').hover(
				function () {
				$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
				$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
				},
					function () {
						$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
						$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
					}		
				);				
			}
		};
	// Run the show!
		filterList.init();
	});	
</script>
<!--Gallery Script Ends-->	 
<!--/top-tours-->
<div class="tour-guides section" id="section-4">
	  <div class="tour-guides-head text-center">
		  <h3>GUIDES</h3>
		  <span></span><img src="{{ asset('guest/images/guide.png') }}" alt=" "><span></span>
		  <div class="container">
				<p>Masing masing wilayah di Kalimantan Selatan memiliki destinasi wisata dengan keunikan tersendiri. Destinasi wisata alam pegunungan, sungai, air terjun, pesisir pantai beserta terumbu karang dapat dikunjungi di masing-masing kabupataten dan kota di Kalimantan Selatan.</p>
		  </div>
	  </div>
	  <div class="container">
		<!-- requried-jsfiles-for owl -->
		<link href="{{ asset('guest/css/owl.carousel.css') }}" rel="stylesheet">
	    <script src="{{ asset('guest/js/owl.carousel.js') }}"></script>
	    <script>
		    $(document).ready(function() {
		      $("#owl-demo").owlCarousel({
		        items : 1,
		        lazyLoad : true,
		        autoPlay : true,
		        navigation : false,
		        navigationText :  false,
		        pagination : true,
		      });
		    });
	    </script>
		<!-- //requried-jsfiles-for owl -->
		<div id="owl-demo" class="owl-carousel">
			<div class="item text-center guide-sliders">
				 <div class="col-md-3 image-grid">
					<img src="{{ asset('guest/images/g1.jpg') }}">
					<div class="guide-caption">
					<span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					</div>
					<p><a href="{{route('guest_list_lokasi', ['lokasi' => 'banjarmasin'])}}">Banjarmasin</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g2.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'banjarbaru'])}}">Banjarbaru</a></p>
				 </div>
				 <div class="guest/col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g3.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'batulicin'])}}">Batulicin</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g4.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'tanah laut'])}}">Tanah Laut</a></p>
				 </div>   
			  </div>
			  <div class="item text-center guide-sliders">
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g5.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'barito kuala'])}}">Barito Kuala</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g6.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'rantau'])}}">Rantau</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g7.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'martapura'])}}">Martapura</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g8.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'tanjung'])}}">Tanjung</a></p>
				 </div>   
			  </div>
			  <div class="item text-center guide-sliders">
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g9.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'kotabaru'])}}">Kotabaru</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g10.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'balangan'])}}">Balangan</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g11.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'barabai'])}}">Barabai</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g12.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'amuntai'])}}">Amuntai</a></p>
				 </div>    
			  </div>   
			 <div class="item text-center guide-sliders">
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g4.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'tanah laut'])}}">Tanah Laut</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g13.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'kandangan'])}}">Kandangan</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g2.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'banjarbaru'])}}">Banjarbaru</a></p>
				 </div>
				 <div class="col-md-3 image-grid">
					 <img src="{{ asset('guest/images/g1.jpg') }}">
					 <div class="guide-caption">
					 <span></span>
						<a href="#"><span class="twit"> </span></a>
						<a href="#"><span class="fb"> </span></a>
						<a href="#"><span class="gplus"> </span></a>
					 </div>
					 <p><a href="{{route('guest_list_lokasi', ['lokasi' => 'banjarmasin'])}}">Banjarmasin</a></p>
				 </div>   
			  </div> 
		  </div>
		</div>
</div>