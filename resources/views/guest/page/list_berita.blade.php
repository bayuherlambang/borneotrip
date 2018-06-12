@extends('guest.layouts.page')

@section('content')
<div class="container">
	<div class="row">
	    <div class="top-tours-head text-center">
	        <h3 class="tour-guides-head" id="title">Berita</h3>
	        <span></span><img src="{{ asset('guest/images/star.png') }}" alt=""><span></span>
	      </div>
    </div>
	@foreach($berita as $data)
	<div class="row">
    	<div class="top-tours-head text-left">
    		<a href="{{route('guest_single_berita', ['judul' => $data['judul_artikel'], 'id' => $data['id']])}}">
        		<h4 class="tour-guides-head" id="title">{{$data['judul_artikel']}}</h4>
        	</a>
        	<br> 
     	</div>
     	<div class="artikel">
            <p>{{$data['intro']}}</p>
        </div>
   </div> 
   @endforeach  
</div>
 
@endsection