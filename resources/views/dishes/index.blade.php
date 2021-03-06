@extends('layouts.admin')
@section('content')
@if( Session::has('success') )
	<div class="alert alert-success">
		{{ Session::get('success') }}
	</div>
@endif
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('dishes.create')}}">
            	Create meal
        	</a>
        	<a class="btn btn-success" href="{{route('MealsToRestaurants')}}">
            	Add meals to restaurants
        	</a>
        </div>
    </div>
<div class="card">
   	<div class="card-body">
	    <div class="table-responsive">
	        <table class=" table table-bordered table-striped table-hover datatable datatable-Meal">
	            <thead>
	                <tr>
	                    <th>
	                        #
	                    </th>
	                    <th>
	                        Meal name
	                    </th>
	                    <th>
	                        Meal category
	                    </th>
	                    <th>
	                        Price
	                    </th>
	                    <th>
	                        Restaurant
	                    </th>
	                      <th>
	                        Make
	                    </th>
	                </tr>
	            </thead>
	            @php
	            	$num = 1;
	            @endphp
	            @foreach($dishes as $dish)
	            <tbody>
	            	<tr>
	            		<td>
	            			{{$num++}}
	            		</td>
	            		<td>
	            			{{$dish->dish_name}}
	            		</td>
	            		<td>
	            			{{$dish->category_name}}
	            		</td>
	            		<td>
	            			{{$dish->price}}
	            		</td>
	            		<td>
	            			@foreach($restaurants as $restaurant)
	            			@if($dish->id == $restaurant->dish_id)
	            				{{$restaurant->restaurant_name}}<br>
	            			@endif
	            			@endforeach
	            		</td>

	            		<td>
	            			<a class="btn btn-xs btn-primary" href="{{route('dishes.show',$dish->id )}}">
	            				View
	            			</a>
	            			<a  class="btn btn-xs btn-info" href="{{route('dishes.edit',$dish->id )}}">
	            				Edit
	            			</a>
	            			<form action="{{route('dishes.destroy',$dish->id )}}" method="Post" style="display: inline-block;">
	            				{{ csrf_field() }}
								{{ method_field('DELETE') }}
	            				<input type="submit" class="btn btn-xs btn-danger" name="" value="Delete">
	            			</form>
	            		</td>
	            	</tr>
	            </tbody>
	            @endforeach
	        </table>
	   </div>
   </div>
</div>
@endsection