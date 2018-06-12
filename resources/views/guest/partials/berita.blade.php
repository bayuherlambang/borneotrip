<div class="fotter">	
	 <div class="container">
		 <div class="fotter-grids">
			 <div class="col-md-4 fotter-left">
			 <img src="{{ asset('guest/images/fotter-logo1.png') }}" alt="">
			 <p>Oficial Media akan berbagi informasi program terbaru borneotip.id </p>
			 </div>
			 <div class="col-md-4 fotter-middle">
				 <h3>Latest News</h3>
				 <div class="footer-list">
						<ul>
							@foreach($berita as $b)
							<li><a href="{{route('guest_single_berita', ['judul' => $b['judul_artikel'], 'id' => $b['id']])}}"><span></span>{{$b['judul_artikel']}}</a></li> 
							@endforeach
						</ul>
				 </div>
			 </div>
			 <div class="col-md-4 fotter-right">
			 <h3>Newsletter</h3>
			 <form>
			 <input type="text" class="text" value="E-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your mail';}">
			 <input type="submit" value="Send">
			 <div class="clearfix"></div>
			 </form>
			 <div class="social-icons">
			 <a href="#"><span class="facebook"> </span></a>
			 <a href="#"><span class="twitter"> </span></a>
			 <a href="#"><span class="googleplus"> </span></a>
			 <a href="#"><span class="pinterest"> </span></a>
			 <a href="#"><span class="instagram"> </span></a>
			 </div>
			 <div class="clearfix"></div>
	     	</div>
		 <div class="clearfix"></div>
	 	</div>
	</div>
</div> 