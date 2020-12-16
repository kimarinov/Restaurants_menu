<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckNumberRequest;
use App\Http\Requests\NumberOfPeopleRequest;

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

    public function restaurants_menu(CheckNumberRequest $request)
    {
        $restaurant_id = $request->restaurant;
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', $restaurant_id)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
        $drinks = DB::table('drinks')->get();
        $categories = DB::table('categories')->get();
        $choose = $request->choose;
        $people = $request->number_of_people;
        $money = $request->money;
        return view('restaurants.menu', compact('dishes', 'categories','choose','people','money','restaurant_id','drinks'));  
    }

    public function menuDrinks(request $request)
    {
       // dd($request->all());
        $restaurant_id = $request->restaurant_id;
        $choose = $request->choose;
        $people = $request->number_of_people;
        $money = $request->money;
        $sum = 0;

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

            if (($sum * 1.05) > $money) {
               return view('restaurants.noMoney', compact('sum', 'money'));
            }
           
            return view ('restaurants.freeConsumation',compact('free_consumation_orders','sum','dish_count','total_price','restaurant_id'));
        }

        //calculating for other choose
        if ($choose == 1 || $choose == 2)
        {

            $first_order = $request->except('_token', '_method','money','people','choose','restaurant_id');
            $json_first_oreder = json_encode($first_order);
            $people = $request['people'];
            $choose = $request->choose;

            foreach ($request->except('_token', '_method','money','people','restaurant_id','choose','json_first_oreder','sum') as  $value)
            {
                $sum += DB::table('dishes')->where('id', $value)->first()->price;        
            }
                            $sum = $sum * $people * 1.05;
            if ($sum > $money) {
                return view('restaurants.noMoney', compact('sum', 'money'));
            }
        } 

 
        //Get id of cheked dishes of category "starter"
        $dishes = DB::table('dishes')
                ->get();
        $dishes_id = [];
        foreach ($request->except('_token', '_method','money','people','choose','restaurant_id') as  $key => $value)
        {   
            foreach ($dishes as $key2 => $dish)
            {
                if ($dish->id == $value) 
                {
                    $dishes_id[] = $value;
                }
            }
                          
        }

        //get the id of drinks 
        $get_drinks_id = [];
        foreach ($dishes_id as $key => $value) {
            $get_drinks_id[] = DB::table('dishes_drinks')
                               ->where('dish_id', '=',  $value)
                               ->LeftJoin('drinks', 'drinks.id', '=', 'dishes_drinks.drink_id')
                               ->get();
        }
        $drinks_id = [];
        //get id-s of drinks
        foreach ($get_drinks_id as $key => $get_drink_id) {
            foreach ($get_drink_id as $key2 => $value) {
                $drinks_id[] = $value->id;
            }
        }
        //get the unique ides
        $drinks_id = array_unique($drinks_id);

        //DB only for drinks from dishes
        $drinks = DB::table('drinks')
                ->whereIn('id', $drinks_id)
                ->get();

        return view('restaurants.menuDrinks', compact('sum','drinks','choose','people','money','restaurant_id','drinks','json_first_oreder'))->with('success','Може да поръчаш');

    }
    public function calc_sum(request $request)
    {
       
        $choose = $request->choose;
        $money = $request->money;
        $restaurant_id = $request->restaurant_id;
        $sum = $request->sum;
        $people = $request->people;
        $json_first_oreder=$request->json_first_oreder;
        
        $sum_drinks = 0;
        
       //calculating for free consumation
        if ($choose == 3) {
            dd($request->all());
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

            $first_order_drinks = $request->except('_token', '_method','money','people','choose','restaurant_id','sum','json_first_oreder');
            $json_first_oreder_drinks = json_encode($first_order_drinks);
            //dd($first_order_drinks);
            $choose = $request->choose;
        
            foreach ($request->except('_token', '_method','money','people','restaurant_id','choose','json_first_oreder','sum') as  $value)
            {
                $sum_drinks += DB::table('drinks')->where('id', $value)->first()->price;        
            }

            $sum_drinks = $sum_drinks * $people * 1.05;
            $sum = $sum + $sum_drinks;
            if ($sum > $money) {
                return view('restaurants.noMoney', compact('sum', 'money'));
            }
           // dd($first_order_drinks);
            return view('restaurants.choise',compact('sum','money','json_first_oreder','people','restaurant_id','json_first_oreder_drinks'))->with('success','Може да поръчаш');
        } 
    }
    public function final_order(request $request)
    {   
        
        $json_first_oreder = json_decode($request->input('json_first_oreder'));
        $json_first_oreder_drinks = json_decode($request->input('json_first_oreder_drinks'));
        //dd($json_first_oreder_drinks);
        $people = $request->people;
        $sum = $request->sum;

        //make array for print
        $orders = [];
        foreach ($json_first_oreder as  $value) {
             $orders[DB::table('dishes')->where('id', $value)->first()->dish_name] = DB::table('dishes')->where('id', $value)->first()->price;
        }
        foreach ($json_first_oreder_drinks as  $value) {
             $orders[DB::table('drinks')->where('id', $value)->first()->drinks_name] = DB::table('drinks')->where('id', $value)->first()->price;
        }
        

        if ($request->choose == 3) {

            $restaurant_id =  $request->restaurant_id;
            $money = $request->money;
            $json_first_oreder = $request->input('json_first_oreder');
            $json_first_oreder_drinks = json_encode($json_first_oreder_drinks);

            return view('restaurants.secondChoise',compact('money','people','sum','json_first_oreder','restaurant_id','json_first_oreder_drinks')); 
        }

         return view('restaurants.final_order', compact('orders','people'));   
       
    }

    public function secondChoise(NumberOfPeopleRequest $request)
    {  
        //dd($request->all());
        $first_order_people = $request->first_order_people;
        $second_order_people = $request->people - $first_order_people;
        
        //check for negative people input
        if ($second_order_people <= 0) {
            return view('restaurants.negativePeopleInput');
        }
        $choose = 1;
        $secondChoise = 1;
        
        $restaurant_id = $request->restaurant_id;
        //to do negative people check
        $json_first_oreder = $request->json_first_oreder;
        $json_first_oreder_drinks = $request->json_first_oreder_drinks;
        $money =  $request->money;
        $sum = $request->sum;
        $new_money = $money - $sum;
       
        $dishes = DB::table('dish_restaurant')->where('restaurant_id', $restaurant_id)
            ->join('restaurants', 'restaurants.id', '=', 'dish_restaurant.restaurant_id')
            ->Join('dishes', 'dishes.id', '=', 'dish_restaurant.dish_id')
            ->LeftJoin('categories', 'dishes.category_id', '=','categories.id' )
            ->get();
            $categories = DB::table('categories')->get();
        
        return view('restaurants.secondMenu', compact('dishes','categories','new_money','first_order_people','second_order_people','json_first_oreder','json_first_oreder_drinks','choose','secondChoise','money','restaurant_id'));
    }

    public function secondChoiseDrinks(request $request)
    {

        $money=$request->money;
        $restaurant_id= $request->restaurant_id;

        
        //first order
        $first_orders_sum = 0;
        $first_order_people =$request->first_order_people;
        $json_first_oreder = json_decode($request->json_first_oreder);
        $json_first_oreder_drinks =  json_decode($request->json_first_oreder_drinks);
        $first_orders = [];
        foreach ($json_first_oreder as  $key =>$value) {
            $first_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
            $first_orders_sum += DB::table('dishes')->where('id', $value)->first()->price;
        }
        foreach ($json_first_oreder_drinks as  $key =>$value) {
            $first_orders[$key] = DB::table('drinks')->where('id', $value)->first()->price;
            $first_orders_sum += DB::table('drinks')->where('id', $value)->first()->price;
        }
        $first_orders =json_encode($first_orders);
       
       //second order
        $second_orders_sum = 0;
        $new_money = $request->new_money;
        $second_order_people= $request->second_order_people;

        $second_orders = $request->except('_token', '_method','first_order_people','new_money','second_order_people','json_first_oreder','money','json_first_oreder_drinks','restaurant_id');

        foreach ($second_orders as  $key => $value) {
             $second_orders[$key] = DB::table('dishes')->where('id', $value)->first()->price;
              $second_orders_sum += DB::table('dishes')->where('id', $value)->first()->price;
        }
        $second_orders = json_encode($second_orders);


        //Get id of cheked dishes of category "starter"
        $dishes = DB::table('dishes')
                ->where('category_id', 2)
                ->get();
        $dishes_id = [];
        foreach ($request->except('_token', '_method','money','people','choose','restaurant_id') as  $key => $value)
        {   
            foreach ($dishes as $key2 => $dish)
            {
                if ($dish->id == $value) 
                {
                    $dishes_id[] = $value;
                }
            }
                          
        }

        //get the id of drinks 
        $get_drinks_id = [];
        foreach ($dishes_id as $key => $value) {
            $get_drinks_id[] = DB::table('dishes_drinks')
                               ->where('dish_id', '=',  $value)
                               ->LeftJoin('drinks', 'drinks.id', '=', 'dishes_drinks.drink_id')
                               ->get();
        }
        $drinks_id = [];
        //get id-s of drinks
        foreach ($get_drinks_id as $key => $get_drink_id) {
            foreach ($get_drink_id as $key2 => $value) {
                $drinks_id[] = $value->id;
            }
        }
        //get the unique ides
        $drinks_id = array_unique($drinks_id);

        //DB only for drinks from dishes
        $drinks = DB::table('drinks')
                ->whereIn('id', $drinks_id)
                ->get();

        return view('restaurants.secondMenuDrinks',compact('drinks','restaurant_id','money','first_orders_sum','first_order_people','first_orders','new_money','second_orders_sum','second_order_people','second_orders'));
       

    }

    public function secondChoiseFinalOrder(request $request)
    {
       
    
        $first_orders = json_decode($request->first_orders);
        $second_orders = json_decode($request->second_orders);
        $second_orders_sum = $request->second_orders_sum;
        $new_money = $request->new_money;
        $second_order_people = $request->second_order_people;
        $first_order_people = $request->first_order_people;
        $first_orders_sum = $request->first_orders_sum;
        $money = $request->money;
       
        if(($first_orders_sum + $second_orders_sum) > $money)
        {
            $sum = $first_orders_sum + $second_orders_sum;
            return view('restaurants.noMoney', compact('sum','money'));
        }

        $second_orders_drinks = $request->except('_token', '_method','first_order_people','new_money','second_order_people','json_first_oreder','money','first_orders_sum','first_orders','second_orders','second_orders_sum','restaurant_id');
        
        foreach ($second_orders_drinks as  $key => $value) {
             $second_orders_drinks[$key]= DB::table('drinks')->where('id', $value)->first()->price;
            $second_orders_sum += DB::table('drinks')->where('id', $value)->first()->price;
        }
        //put drinks and dishes in one array

        $final_second_orders = [];
        foreach ($second_orders as $key => $value) {
            $final_second_orders[$key] = $value;
        }
        foreach ($second_orders_drinks as $key => $value) {
            $final_second_orders[$key] = $value;
        }
    
        if ($second_orders_sum > $new_money && $sum > $money) {
            return view('restaurants.noMoney', compact('sum','money'));
        }

        return view('restaurants.secondFinalOrder', compact('first_order_people','first_orders','final_second_orders','second_order_people',));
    }
}