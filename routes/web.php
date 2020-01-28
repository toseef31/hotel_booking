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

Route::get('/', function () {
    return view('frontend.index');
});

Route::match(['get','post'],'/listing','frontend\HotelController@hotel_listing');
Route::match(['get','post'],'/listing-ajax','frontend\HotelController@hotel_listing_ajax');
Route::get('hotel-detail/{id}','frontend\HotelController@hotel_detail');
Route::match(['get','post'],'/room-detail-ajax/{id}','frontend\HotelController@room_detail');
Route::match(['get','post'],'/getcities','frontend\HotelController@get_cities');
// Route::get('/room-detail-ajax/{id}', function () {
//     return view('frontend.room-details-ajax');
// });
Route::get('/detail', function () {
    return view('frontend.detail');
});
Route::get('/dashboard', function () {
    return view('frontend.dashboard');
});
