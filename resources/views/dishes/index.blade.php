@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('dishes.create')}}">
            	Create meal
        	</a>
        </div>
    </div>
    {{-- {{dd($dishes)}} --}}
   {{--  {{dd($restaurants)}} --}}
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
		            			{{-- 
		            			{{dd($dish->id)}} --}}
		            			@foreach($restaurants as $restaurant)
		            			@if($dish->id == $restaurant->dish_id)
		            				{{$restaurant->restaurant_name}}<br>
		            			@endif
		            			@endforeach
		            		</td>

		            		<td>
		            			<a class="btn btn-xs btn-primary" href="">
		            				View
		            			</a>
		            			<a  class="btn btn-xs btn-info" href="">
		            				Edit
		            			</a>
		            			<form action="index_submit" method="Post" accept-charset="utf-8" style="display: inline-block;">
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
<h2>dishes</h2>
@endsection