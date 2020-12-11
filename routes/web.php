<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@index')->name('HomePage');

Route::middleware(['auth'])->group(function () {
	//restourants
	Route::resource('/restaurants', 'RestaurantsController')->only('index','show');

	Route::post('restaurants/chose/restaurant/{restorant_id}', 'RestaurantsController@restaurants_menu')->name('restaurant.menu');

	Route::post('restaurants/chose/restaurant/calc/new', 'RestaurantsController@calc_sum')->name('calc.sum');

	Route::post('restaurants/chose/restaurant/calc/new/final', 'RestaurantsController@final_order')->name('final_order');

	Route::post('restaurants/chose/restaurant/calc/new/final/secondChoise', 'RestaurantsController@secondChoise')->name('secondChoise');
	Route::post('restaurants/chose/restaurant/calc/new/final/secondChoise/secondChoiseFinalOrder', 'RestaurantsController@secondChoiseFinalOrder')->name('secondChoiseFinalOrder');

	//dishes
	Route::resource('dishes', 'DishesController')->middleware('isAdmin');

	Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();