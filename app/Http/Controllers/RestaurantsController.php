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
    public function calc_sum(Request $request, $money)
    {
        //dd($request->except('_token', '_method'));
        // dd($request->input());
       // dd($request->all());
        // dd($money);

        $sum = 0;
        foreach ($request->except('_token', '_method','money') as  $value)
        {
            $sum +=$value;        
        }

        if($sum < $request->money)
        {
            dd(Session::has('success'));
            return view('restaurants.calc_sum',compact('sum','money'))->with('success','U can purches');
        }

        dd(2);
    }
   

}
