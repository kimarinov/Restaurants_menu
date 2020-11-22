@extends('layouts.admin')
@section('content')
<div class="card">
	<div class="card-body">
	    <div class="form-group">
	        <div class="form-group">
	        	<table class="table table-bordered table-striped">
	            <tbody>
	                <tr>
	                    <th>
	                        Dish name
	                    </th>
	                    <td>
	                        {{$dish->dish_name}}
	                    </td>
	                </tr>
	               	<tr>
	                    <th>
	                        Dish price
	                    </th>
	                    <td>
	                        {{$dish->price}}
	                    </td>
	                </tr>
	                  <tr>
	                    <th>
	                        Category meal
	                    </th>
	                    <td>
	                        {{$dish->category_name}}
	                    </td>
	                </tr>
	                </tr>
	                  <tr>
	                    <th>
	                        Restorants
	                    </th>
	                    <td>
	            			@foreach($restaurants as $restaurant)
		            			@if($dish->id == $restaurant->dish_id)
		            				{{$restaurant->restaurant_name}}<br>
		            			@endif
	            			@endforeach
            			</td>
	                </tr>
	                <tr>
	                    <th>
	                        Created at
	                    </th>
	                    <td>
	                        {{$dish->created_at}}
	                    </td>
	                </tr>
	                <tr>
	                    <th>
	                        Updated at
	                    </th>
	                    <td>
	                        {{$dish->updated_at}}
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	        </div>
	    </div>
	</div>
</div>
@endsection