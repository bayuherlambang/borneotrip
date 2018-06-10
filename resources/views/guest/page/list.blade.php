@extends('guest.layouts.page')

@section('content')
<div  class="section" id="section-3">
    <div id="portfolio" class="portfolio">
        <div class="top-tours-head text-center">
            <h3>{{ucfirst($lokasi)}}</h3>
            <span></span><img src="{{ asset('guest/images/star.png') }}" alt=""><span></span>
            
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
<br>
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
@endsection

