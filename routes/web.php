<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@index')->name('HomePage');
//restourants
Route::resource('/restaurants', 'RestaurantsController')->only('index','show');