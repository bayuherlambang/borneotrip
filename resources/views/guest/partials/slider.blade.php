<!--banner->
<!--start-slider-script-->
<script src="{{ asset('guest/js/responsiveslides.min.js') }}"></script>
<script>
	// You can also use "$(window).load(function() {"
	$(function () {
	  // Slideshow 4
	  $("#slider4").responsiveSlides({
	    auto: true,
	    pager: true,
	    nav: true,
	    speed: 500,
	    namespace: "callbacks",
	    before: function () {
	      $('.events').append("<li>before event fired.</li>");
	    },
	    after: function () {
	      $('.events').append("<li>after event fired.</li>");
	    }
	  });

	});
</script>
<!----//End-slider-script---->
<!-- Slideshow 4 -->
<div id="section-1" class="section">
    <div id="top" class="callbacks_container">
      <ul class="rslides" id="slider4">
      	@foreach($slider as $s)
        <li>
          <img src="{{$s['image']}}" alt="{{$s['caption']}}">
		  <div class="caption">
     	  		<div class="header-info">
				<h2><a href="#">Get Away On This Weekend</a></h2>
				<lable></lable>
				<h1><a href="#">{{$s['caption']}}</a></h1>
				</div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>	         
    <div class="clearfix"> </div>
</div>
<!-- //End-slider-->
<!---banner->