<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomepageController@index')->name('HomePage');

Route::middleware(['auth'])->group(function () {
	//restourants
	Route::resource('/restaurants', 'RestaurantsController')->only('index','show');

	Route::post('restaurants/chose/restaurant/{restorant_id}', 'RestaurantsController@restaurants_menu')->name('restaurant.menu');

	Route::post('restaurants/chose/restaurant/{restorant_id}/drinks', 'RestaurantsController@menuDrinks')->name('menuDrinks');


	Route::post('restaurants/chose/restaurant/{restorant_id}/drinks/calc/new', 'RestaurantsController@calc_sum')->name('calc.sum');

	Route::post('restaurants/chose/restaurant/{restorant_id}/calc/new/final', 'RestaurantsController@final_order')->name('final_order');

	Route::post('restaurants/chose/restaurant/{restorant_id}/calc/new/final/secondChoise', 'RestaurantsController@secondChoise')->name('secondChoise');

	Route::post('restaurants/chose/restaurant/{restorant_id}/calc/new/final/secondChoise/drinks', 'RestaurantsController@secondChoiseDrinks')->name('secondChoiseDrinks');

	Route::post('restaurants/chose/restaurant/{restorant_id}/calc/new/final/secondChoise/drinks/secondChoiseFinalOrder', 'RestaurantsController@secondChoiseFinalOrder')->name('secondChoiseFinalOrder');

	//dishes
	Route::resource('dishes', 'DishesController')->middleware('isAdmin');
	Route::get('dishes/MealsToRestaurants/add', 'DishesController@MealsToRestaurants')->name('MealsToRestaurants');
	Route::post('dishes/addMealsToRestaurants/add/add', 'DishesController@addMealsToRestaurants')->name('addMealsToRestaurants');

	//drinks
	Route::resource('/drinks', 'DrinksController')->only('index');

	//Users
	Route::get('/users', 'UsersController@index')->name('users.index');

});

Auth::routes();