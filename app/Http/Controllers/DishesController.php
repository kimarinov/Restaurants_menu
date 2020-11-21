<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;
use DB;

class DishesController extends Controller
{
   
    public function index()
    {
        $dishes = DB::table('dishes')
            ->Join('categories', 'dishes.category_id', '=', 'categories.id')
            ->select('dishes.*','categories.category_name')
            ->get();
        $restaurants = DB::table('dish_restaurant')
            ->Join('restaurants', 'dish_restaurant.restaurant_id','=', 'restaurants.id')
            ->select('dish_restaurant.dish_id','restaurants.restaurant_name') 
            ->get();

        return view('dishes.index',compact('dishes','restaurants'));
    }

    
    public function create()
    {
        $dishes = DB::table('dishes')
            ->Join('categories', 'dishes.category_id', '=', 'categories.id')
            ->select('dishes.*','categories.category_name')
            ->get();
        $restaurants = DB::table('restaurants')
            ->get(); 
            //dd($dishes);
        $categories = DB::table('categories')
        ->get();

        return view('dishes.create', compact('dishes','restaurants','categories'));

    }


    public function store(Request $request)
    {

        DB::table('dishes')->insert([
            ['dish_name'=>$request->name,
            'price' => $request->price,
            'category_id'=> $request->category_id,
            'created_at'=> now(),]
        ]);
        return redirect()->route('dishes.index')
            ->with('success', 'New meal created!');

    }

    public function show(Dish $dish)
    {
        $dish = DB::table('dishes')
            ->where('dishes.id',$dish->id)
            ->Join('categories', 'dishes.category_id', '=', 'categories.id')
            ->select('dishes.*','categories.category_name')
            ->get()->first();
        $restaurants = DB::table('dish_restaurant')
            ->Join('restaurants', 'dish_restaurant.restaurant_id','=', 'restaurants.id')
            ->select('dish_restaurant.dish_id','restaurants.restaurant_name') 
            ->get();
        return view('dishes.show',compact('dish', 'restaurants'));
    }

  
    public function edit(Dish $dish)
    {
        $dish = DB::table('dishes')
                ->where('dishes.id',$dish->id)
                ->Join('categories', 'dishes.category_id', '=', 'categories.id')
                ->select('dishes.*','categories.category_name')
                ->get()->first();
        $categories = DB::table('categories')
        ->get();

        return view('dishes.update',compact('dish','categories'));
    }


    public function update(Request $request, Dish $dish)
    {
        DB::table('dishes')
                ->where('dishes.id',$dish->id)
                ->update([
                        'dish_name'=>$request->name,
                        'price' => $request->price,
                        'category_id'=> $request->category_id,
                        'created_at'=> now(),
                        ]);
                return redirect()->route('dishes.index')
            ->with('success', 'Update!');
    }

    public function destroy(Dish $dish)
    {
       DB::table('dishes')->where('id', $dish->id)->delete();
         
         return redirect()->route('dishes.index')
            ->with('success', 'Deleted!');
    }
}
