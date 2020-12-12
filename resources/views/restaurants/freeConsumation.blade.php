@extends('layouts.admin')
@section('content')
<h3>You order:</h3>

<table class="table table-secondary">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Dish</th>
					<th scope="col" class="text-center">Price</th>
					<th scope="col" class="text-center">Total price</th>
				</tr>
			</thead>
			<tbody>
				@php
				$num = 1;
				@endphp
				@foreach($free_consumation_orders as $key =>$free_consumation_order )
				<tr>
					<td class="text-center">{{$num++}}</td>
					@foreach($free_consumation_order as $key2 =>$value )
						<td class="text-center">{{$value}}</td>	 
					@endforeach
					
				</tr>
				@endforeach
			</tbody>
			<tfoot class="table-dark">
			 	<tr>
				 	<th scope="col" class="text-center"></th>	
				 	<th scope="col" class="text-center">Total dishes</th>	
				 	<th scope="col" class="text-center">Total price:</th>
				 	<th scope="col" class="text-center">Total price:</th>	
			 	</tr>
			 	<tr>
				 	<td class="text-center">#</td>
				 	<td class="text-center">{{$dish_count}}</td>
	      			<td class="text-center">{{$total_price}}</td>
	      			<td class="text-center">{{$sum * 1.05}}</td>
      			</tr>
			 </tfoot>
		</table>

@endsection