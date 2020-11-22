<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@index')->name('HomePage');
//restourants
Route::resource('/restaurants', 'RestaurantsController')->only('index','show');

Route::post('restaurants/chose/restaurant/{restorant_id}', 'RestaurantsController@restaurants_menu')->name('restaurant.menu');

Route::post('restaurants/chose/restaurant/calc/{rostarants_id}', 'RestaurantsController@calc_sum')->name('calc.sum');

//dishes
Route::resource('dishes', 'DishesController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
