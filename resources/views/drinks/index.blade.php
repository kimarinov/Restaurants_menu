@extends('layouts.admin')
@section('content')
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
	                        Drinks name
	                    </th>
	                    <th>
	                        Price
	                    </th>
	                    <th>
	                        Belong to meal:
	                    </th>
	                </tr>
	            </thead>
	            @php
	            	$num = 1;
	            @endphp
	            @foreach($drinks as $drink)
	            <tbody>
	            	<tr>
	            		<td>
	            			{{$num++}}
	            		</td>
	            		<td>
	            			{{$drink->drinks_name}}
	            		</td>
	            		<td>
	            			{{$drink->price}}
	            		</td>
	            
	            		<td>
	            			@foreach($dishes_drinks as $dish_drink)
	            			@if($drink->id == $dish_drink->drink_id)
	            				{{$dish_drink->dish_name}}<br>
	            			@endif
	            			@endforeach
	            		</td>

	            	</tr>
	            </tbody>
	            @endforeach
	        </table>
	   </div>
   </div>
</div>

@endsection