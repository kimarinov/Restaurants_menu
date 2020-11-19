<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@index')->name('HomePage');
//restourants
Route::resource('/restaurants', 'RestaurantsController')->only('index','show');

Route::get('restaurants/chose/{restaurant}', 'RestaurantsController@choose_level')->name('restorant.choose');

Route::post('restaurants/chose/restaurant/{restorant_id}', 'RestaurantsController@restaurants_menu')->name('restaurant.menu');
