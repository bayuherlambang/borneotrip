<?php 
Route::get('/', ['uses' => 'Home@index', 'as' => 'guest_home']);
Route::get('page/{judul}/{id}', ['uses' => 'Home@page', 'as' => 'guest_single_page']);
Route::get('/{lokasi}', ['uses' => 'Home@lokasi', 'as' => 'guest_list_lokasi']);
