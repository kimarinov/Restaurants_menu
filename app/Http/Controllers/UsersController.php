<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function index()
    {
    	
    	$users = DB::table('Users')
    			->Join('roles', 'roles.id','=', 'users.role_id')
    			->get();
    			
    	return view('users.index', compact('users'));
    }
}
