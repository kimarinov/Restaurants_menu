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

    public function show(Restaurant $restaurant)
    {
         return view('restaurants.show', compact('restaurant')); 
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
     
        $choose = $request->choose;
        $money = $request->money;
        $sum = 0;
        
       //calculating for free consumation
        if ($choose == 3) {
            $free_consumation_orders = array();
            $dish_count = 0;
            $total_price = 0;
            foreach ($request->except('_token', '_method','money','people','choose') as  $key => $value)
            {   
                if ($value != NULL) {
                    $free_consumation_orders[] = [$value.' x '.DB::table('dishes')->where('id', $key)->first()->dish_name  , DB::table('dishes')->where('id', $key)->first()->price ,DB::table('dishes')->where('id', $key)->first()->price * $value];
                    $sum +=DB::table('dishes')->where('id', $key)->first()->price * $value;
                    $dish_count += $value; 
                    $total_price += DB::table('dishes')->where('id', $key)->first()->price;
                }
                   
                          
            }

            if ($sum > $money) {
               dd("нямате достатачно пари");
            }
            return view ('restaurants.freeConsumation',compact('free_consumation_orders','sum','dish_count','total_price'));
        }

        //calculating for other choose
        if ($choose == 1 || $choose == 2)
        {

            $first_order = $request->except('_token', '_method','money','people','choose');
            $json_first_oreder = json_encode($first_order);
            $people = $request['people'];
            $choose = $request->choose;

            foreach ($request->except('_token', '_method','money','people') as  $value)
            {
                $sum +=DB::table('dishes')->where('id', $value)->first()->price;        
            }

            $sum = $sum * $people * 1.05;

            if ($sum > $money) {
               dd("нямате достатачно пари");
            }
            return view('restaurants.choise',compact('sum','money','json_first_oreder','people'))->with('success','U can purches');
        } 
    }
    public function final_order(request $request)
    {   
        //dd($request->all());
        $json_first_oreder = json_decode($request->input('j1'));

        //dd($json_first_oreder);
        $people = $request->people;
        $sum = $request->sum;


        $orders = [];
        foreach ($json_first_oreder as  $value) {
             $orders[DB::table('dishes')->where('id', $value)->first()->dish_name] = DB::table('dishes')->where('id', $value)->first()->price;
        }
        if ($request->choose == 3) {

                $money = $request->money;
                $json_first_oreder = $request->input('j1');

            return view('restaurants.secondChoise',compact('money','people','sum','json_first_oreder')); 
        }
        
         return view('restaurants.final_order', compact('orders','people'));   
       
    }

    public function secondChoise(request $request)
    {
        $choose = 1;
        $secondChoise = 1;
        $first_order_people = $request->first_order_people;
        $second_order_people = $request->people - $first_order_people;
        //to do negative people check
        $json_first_oreder = $request->json_first_oreder;
        //dd(2);
        //dd($json_first_oreder);
        $money =  $request->money;
        $sum = $request->sum;
        $new_money = $money - $sum;
        //dd($new_sum);
        // if (condition) {
        //     # code...
        // }
        //dd($request->all());
        
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', 1)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
            $categories = DB::table('categories')->get();
            //dd($dishes);

        return view('restaurants.secondMenu',compact('dishes','categories','new_money','first_order_people','second_order_people','json_first_oreder','choose','secondChoise'));
    }

    public function secondChoiseFinalOrder(request $request)
    {
        //first order
        $first_order_people =$request->first_order_people;
        $json_first_oreder = json_decode($request->json_first_oreder);
        $first_orders = [];
        foreach ($json_first_oreder as  $key =>$value) {
             $first_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
        }
        $total_first_price = $first_order_people *

        //second order
        $second_order_people= $request->second_order_people;
        $second_orders = $request->except('_token', '_method','first_order_people','new_money','second_order_people','json_first_oreder');

        foreach ($second_orders as  $key => $value) {
             $second_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
        }

        return view('restaurants.secondFinalOrder', compact('first_order_people','first_orders','second_orders','second_order_people','second_order_people'));
    }

}