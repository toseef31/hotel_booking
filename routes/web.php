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
Route::post('/register','frontend\UserController@accountRegister');
Route::post('/login','frontend\UserController@accountLogin');
Route::get('/logout', 'frontend\UserController@logout');

Route::get('/detail', function () {
    return view('frontend.detail');
});
Route::get('/dashboard', function () {
    return view('frontend.dashboard');
});

Route::match(['get','post'],'/admin/login', 'Dashboard\JobManageController@admin_login');

Route::group(['middleware' => 'admin'], function () {
Route::group(['prefix' => 'dashboard'], function () {
	Route::get('/', function(){
		return view('/admin.index');
	});

	Route::match(['get','post'],'/logout', 'Dashboard\JobManageController@logout');
	Route::get('/job_management', 'Dashboard\JobManageController@index');
	Route::get('/blogs', 'Dashboard\JobManageController@blogs');
	Route::get('/blog/create', 'frontend\BlogController@create');
	Route::get('/blog/edit/{id}', 'frontend\BlogController@edit');
	Route::get('/blog/delete/{id}', 'frontend\BlogController@destroy');
	Route::post('/blog/store', 'frontend\BlogController@store');
	Route::match(['get','post'],'/template/{id}', 'Dashboard\JobManageController@template');
	Route::get('/upload_tamplate', 'Dashboard\JobManageController@showtemplate');
	Route::get('/job_delete/{id}', 'Dashboard\JobManageController@destroy');
	Route::post('/post_portal', 'Dashboard\JobManageController@post_portal');
	Route::post('/mark', 'Dashboard\JobManageController@mark');
	Route::match(['get','post'],'/jobstatus_update/{id}', 'Dashboard\JobManageController@jobstatus_update');

	Route::get('/icons', function(){
		return view('/admin.icons');
	});
	Route::get('/add_tamplate', function(){
		return view('/admin.add_tamplate');
	});
	Route::get('/quotes','Dashboard\JobManageController@quotes');
	Route::get('/map', function(){
		return view('/admin.map');
	});
	Route::get('/notifications', function(){
		return view('/admin.notifications');
	});
	Route::get('/user', 'Dashboard\ProfileController@show_partner');
	Route::get('/tables', function(){
		return view('/admin.tables');
	});
	Route::get('/typography', function(){
		return view('/admin.typography');
	});
	Route::get('/upgrade', function(){
		return view('/admin.upgrade');
	});
	Route::get('/add-users', function(){
		return view('/admin.add-users');
	});
	Route::get('/edit_user/{id}', function(){
		return view('/admin.edit_user');
	});
});
});
//////////////////////// Admin Dashboard Close ////////////////////////////