<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
  
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

    public function show(Restaurant $restaurant)
    {
         return view('restaurants.show', compact('restaurant')); 
    }

    public function edit(Restaurant $restaurant)
    {
        //
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    public function destroy(Restaurant $restaurant)
    {
        //
    }

    public function restaurants_menu(Request $request)
    {
        //dd($request->all());
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', $request->restaurant)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
        $categories = DB::table('categories')->get();
        $choose = $request->choose;
        $people = $request->number_of_people;
        $money = $request->money;
        return view('restaurants.menu', compact('dishes', 'categories','choose','people','money'));  
    }
    public function calc_sum(request $request)
    {
        //dd($request->all());
       
        $first_order = $request->except('_token', '_method','money','people');
        $json_first_oreder = json_encode($first_order);
        $people = $request['people'];
        $money = $request->money;


        $sum = 0;
        foreach ($request->except('_token', '_method','money','people') as  $value)
        {
            $sum +=DB::table('dishes')->where('id', $value)->first()->price;        
        }

        $sum = $sum * $people * 1.05;
    
        if($sum < $request->money)
        {
            return view('restaurants.choise',compact('sum','money','json_first_oreder','people'))->with('success','U can purches');
        }
        else
        {
            dd("нямате достатачно пари");
        }

    }
    public function final_order(request $request)
    {   
        //dd($request->all());
        $json_first_oreder = json_decode($request->input('j1'));
        $people = $request->people;
        $sum = $request->sum;


        $orders = [];
        foreach ($json_first_oreder as  $value) {
             $orders[DB::table('dishes')->where('id', $value)->first()->dish_name] = DB::table('dishes')->where('id', $value)->first()->price;
        }
        if ($request->choose == 3) {
            //dd(2);
           //return view('restaurants.secondChoise');
            // to do:add restorant id
            $dishes = DB::table('dish_restaurant')->where('restaurant_id', 1)
                ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
                ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
                ->havingRaw('dish_id  = ?', [3])
                ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
    
                ->get();
                 $categories = DB::table('categories')->get();
                 dd($dishes);
                $choose = 1;
                $money = $request->money;
            return view('restaurants.menu',compact('dishes','categories','choose','money','people'));  
        }
        
         return view('restaurants.final_order', compact('orders','people','sum'));   
       
    }
}