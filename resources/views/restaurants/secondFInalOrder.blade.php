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
				$first_total_price = 0;
				@endphp
				@foreach($first_orders as $key =>$first_order)
				<tr>
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">{{"$first_order_people x "}}{{$key}} </td>
					<td class="text-center">{{$first_order}} </td>
					<td class="text-center"><?php $first_total_price += $first_order_people * $first_order; echo $first_order_people * $first_order; ?> </td>
				</tr>
				@endforeach
				<tr>
					<th scope="col" class="text-center"></th>	
					<th scope="col" class="text-center">Total Dish</th>
					<th scope="col" class="text-center">Total Price</th>
					<th scope="col" class="text-center">Total Price</th>
				</tr>
				<tr>
					<th scope="col" class="text-center"></th>	
					<th scope="col" class="text-center">{{$first_dish_price= $first_order_people * ($num-1) }}</th>
					<th scope="col" class="text-center">{{$first_dishes_price = $first_total_price / $first_order_people}}</th>
					<th scope="col" class="text-center">{{$first_total_price}}</th>
				</tr>
				@php
				$num = 1;
				$second_total_price = 0;
				@endphp
				@foreach($second_orders as $key =>$second_order)
				<tr>
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">{{"$second_order_people x "}}{{$key}} </td>
					<td class="text-center">{{$second_order}} </td>
					<td class="text-center"><?php $second_total_price += $second_order_people * $second_order; echo $second_order_people * $second_order; ?> </td>
				</tr>
				@endforeach
				<tr>
					<th scope="col" class="text-center"></th>	
					<th scope="col" class="text-center">Total Dish</th>
					<th scope="col" class="text-center">Total Price</th>
					<th scope="col" class="text-center">Total Price</th>
				</tr>
				<tr>
					<th scope="col" class="text-center"></th>	
					<th scope="col" class="text-center">{{$second_dish_price = $second_order_people * ($num-1)}}</th>
					<th scope="col" class="text-center">{{$second_dishes_price =$second_total_price / $second_order_people}}</th>
					<th scope="col" class="text-center">{{$second_total_price}}</th>
				</tr>
			</tbody>
			 <tfoot class="table-dark">
			 	<tr>
				 	<th scope="col" class="text-center">#</th>	
				 	<th scope="col" class="text-center">Number of dishes</th>	
				 	<th scope="col" class="text-center">Total price:</th>
				 	<th scope="col" class="text-center">Total price:</th>	
			 	</tr>
			 	<tr>
				 	<td class="text-center">#</td>
				 	<td class="text-center">{{$first_dish_price+$second_dish_price}}</td>
	      			<td class="text-center">{{$first_dishes_price+$second_dishes_price}} </td>
	      			<td class="text-center">{{($second_total_price + $first_total_price) * 1.05}} </td>
      			</tr>
			 </tfoot>



		</table>

@endsection