@extends('layouts.admin')
@section('content')
{{-- <h3>Меню на питиета  за ресторант: "{{$dishes->first()->restaurant_name}}"</h3> --}}
<form action="{{route('secondChoiseFinalOrder',$restaurant_id)}}" method="POST" accept-charset="utf-8">
	{{ csrf_field() }}
	{{ method_field('POST') }}

	<table class="table table-dark">
		<thead>
			<tr>
				<th scope="col" class="text-center">#</th>	
				<th scope="col" class="text-center">Питиета</th>
				<th scope="col" class="text-center">Цена</th>
			</tr>
		</thead>
		<tbody>
			@php
			$num = 1;
			@endphp
			@foreach($drinks as $drink)
				<tr>
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">{{$drink->drinks_name}}
						<input type="checkbox" name="{{$drink->drinks_name}}" value="{{$drink->id}}" checked="">
					<td class="text-center">{{$drink->price}}</td>
					</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
	<input type="hidden" name="first_orders_sum" value="{{$first_orders_sum}}">
	<input type="hidden" name="first_order_people" value="{{$first_order_people}}">
	<input type="hidden" name="first_orders" value="{{$first_orders}}">
	<input type="hidden" name="new_money" value="{{$new_money}}"> 
	<input type="hidden" name="second_orders" value="{{$second_orders}}"> 
	<input type="hidden" name="second_order_people" value="{{$second_order_people}}">
	<input type="hidden" name="second_orders_sum" value="{{$second_orders_sum}}">


		
	<input type="submit" name="" value="Избирам"  class="btn btn-success">
	<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 

</form>

@endsection