@extends('guest.layouts.page')

@section('content')
<div class="container">
  <div class="row">
    <div class="top-tours-head text-left">
        <h3 class="tour-guides-head" id="title">{{$data->title}}</h3>
        <span></span><img src="{{ asset('guest/images/star.png') }}" alt=""><span></span><br>
      </div>
      <div class="col-md-12 artikel">
            <p>{{$data->content}}</p>
        </div>
    </div>   
</div>
 
@endsection