<?php 
Route::get('/', ['uses' => 'Home@index', 'as' => 'guest_home']);
Route::get('page/{judul}/{id}', ['uses' => 'Home@page', 'as' => 'guest_single_page']);
Route::get('/wisata/{lokasi}', ['uses' => 'Home@lokasi', 'as' => 'guest_list_lokasi']);
Route::get('berita/{judul}/{id}', ['uses' => 'Home@berita', 'as' => 'guest_single_berita']);
Route::get('/daftarberita', ['uses' => 'Home@listberita', 'as' => 'guest_list_berita']);
