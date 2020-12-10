<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
         return view('restaurants.show', compact('restaurant')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
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
        $sum = 0;
         $first_order = $request->except('_token', '_method','money');
        // dd($request->input('meal_2'));
        //$test = $request->input('meal_2');
        //dd($test);
        //dd(DB::table('dishes')->where('id', 2)->first()->price);
        foreach ($request->except('_token', '_method','money') as  $value)
        {
            $sum +=DB::table('dishes')->where('id', $value)->first()->price;        
        }
        //dd($sum);

        if($sum < ($request->money * 1.05))
        {
            $money = $request->money;
            return view('restaurants.choise',compact('sum','money','first_order'))->with('success','U can purches');

        }
        else
        {
            dd("нямате достатачно пари");
        }

    }
    public function final_order(request $request)
    {   
        
        dd($request->all());
    }
}

