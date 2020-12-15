<?php

namespace App\Http\Controllers;

use App\Drink;
use Illuminate\Http\Request;
use DB;

class DrinksController extends Controller
{
  
    public function index()
    {
        
        $drinks = DB::table('drinks')
                ->get();
        $dishes_drinks = DB::table('dishes_drinks')
                ->Join('dishes', 'dishes_drinks.dish_id','=', 'dishes.id')
                ->get();
        return view('drinks.index',compact('drinks','dishes_drinks'));
    }

    
}
