<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
URL::forceScheme('https');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');



Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function(){
    require_once 'routes_admin.php';
});

Route::group(['namespace' => 'guest'], function(){
   require_once 'routes_guest.php';
});
