<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckNumberRequest;

class RestaurantsController extends Controller
{
  
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show(restaurant $restaurant)
    {
         return view('restaurants.show', compact('restaurant')); 
    }

    public function restaurants_menu(request $request)
    {
        $restaurant_id = $request->restaurant;
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', $restaurant_id)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
        $categories = DB::table('categories')->get();
        $choose = $request->choose;
        $people = $request->number_of_people;
        $money = $request->money;
        return view('restaurants.menu', compact('dishes', 'categories','choose','people','money','restaurant_id'));  
    }
    public function calc_sum(request $request)
    {
       //dd($request->except('_token', '_method','money','people','choose','restaurant_id'));
        $choose = $request->choose;
        $money = $request->money;
        $restaurant_id = $request->restaurant_id;
        $sum = 0;
        
       //calculating for free consumation
        if ($choose == 3) {
            $free_consumation_orders = array();
            $dish_count = 0;
            $total_price = 0;
            foreach ($request->except('_token', '_method','money','people','choose','restaurant_id') as  $key => $value)
            {   
                if ($value != NULL) {
                    $free_consumation_orders[] = [$value.' x '.DB::table('dishes')->where('id', $key)->first()->dish_name  , DB::table('dishes')->where('id', $key)->first()->price ,DB::table('dishes')->where('id', $key)->first()->price * $value];
                    $sum +=DB::table('dishes')->where('id', $key)->first()->price * $value;
                    $dish_count += $value; 
                    $total_price += DB::table('dishes')->where('id', $key)->first()->price;
                }                   
            }

            if ($sum > $money) {
               return view('restaurants.noMoney', compact('sum', 'money'));
            }
            return view ('restaurants.freeConsumation',compact('free_consumation_orders','sum','dish_count','total_price'));
        }

        //calculating for other choose
        if ($choose == 1 || $choose == 2)
        {

            $first_order = $request->except('_token', '_method','money','people','choose','restaurant_id');
            $json_first_oreder = json_encode($first_order);
            $people = $request['people'];
            $choose = $request->choose;
        
            foreach ($request->except('_token', '_method','money','people','restaurant_id','choose') as  $value)
            {
                $sum += DB::table('dishes')->where('id', $value)->first()->price;        
            }

            $sum = $sum * $people * 1.05;
            if ($sum > $money) {
                return view('restaurants.noMoney', compact('sum', 'money'));
            }
            return view('restaurants.choise',compact('sum','money','json_first_oreder','people','restaurant_id'))->with('success','Може да поръчаш');
        } 
    }
    public function final_order(request $request)
    {   
        
        $json_first_oreder = json_decode($request->input('json_first_oreder'));

        $people = $request->people;
        $sum = $request->sum;


        $orders = [];
        foreach ($json_first_oreder as  $value) {
             $orders[DB::table('dishes')->where('id', $value)->first()->dish_name] = DB::table('dishes')->where('id', $value)->first()->price;
        }
        if ($request->choose == 3) {

            $restaurant_id =  $request->restaurant_id;
            $money = $request->money;
            $json_first_oreder = $request->input('json_first_oreder');

            return view('restaurants.secondChoise',compact('money','people','sum','json_first_oreder','restaurant_id')); 
        }
        
         return view('restaurants.final_order', compact('orders','people'));   
       
    }

    public function secondChoise(request $request)
    {
        $choose = 1;
        $secondChoise = 1;
        $first_order_people = $request->first_order_people;
        $second_order_people = $request->people - $first_order_people;
        $restaurant_id = $request->restaurant_id;
        //to do negative people check
        $json_first_oreder = $request->json_first_oreder;
        $money =  $request->money;
        $sum = $request->sum;
        $new_money = $money - $sum;
       
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', $restaurant_id)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
            $categories = DB::table('categories')->get();
        
        return view('restaurants.secondMenu', compact('dishes','categories','new_money','first_order_people','second_order_people','json_first_oreder','choose','secondChoise','money'));
    }

    public function secondChoiseFinalOrder(request $request)
    {
        $money=$request->money;
        
        //first order
        $first_orders_sum = 0;
        $first_order_people =$request->first_order_people;
        $json_first_oreder = json_decode($request->json_first_oreder);
        $first_orders = [];
        foreach ($json_first_oreder as  $key =>$value) {
            $first_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
            $first_orders_sum += DB::table('dishes')->where('id', $value)->first()->price;
        }
        

        //second order
        $second_orders_sum = 0;
        $new_money = $request->new_money;
        $second_order_people= $request->second_order_people;
        $second_orders = $request->except('_token', '_method','first_order_people','new_money','second_order_people','json_first_oreder','money');

        foreach ($second_orders as  $key => $value) {
             $second_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
              $second_orders_sum += DB::table('dishes')->where('id', $value)->first()->price;
        }
        //calc total sum
        $sum = ($first_orders_sum * $first_order_people) + ($second_orders_sum * $second_order_people);

        if ($second_orders_sum > $new_money && $sum > $money) {
            return view('restaurants.noMoney', compact('sum','money'));
        }

        return view('restaurants.secondFinalOrder', compact('first_order_people','first_orders','second_orders','second_order_people','second_order_people'));
    }
}