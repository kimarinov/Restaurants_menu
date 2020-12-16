@extends('layouts.admin')
@section('content')
<form action="{{route('calc.sum', $restaurant_id)}}" method="POST" accept-charset="utf-8">
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
						<input type="checkbox" name="{{$drink->drinks_name}}" value="{{$drink->id}}">
					<td class="text-center">{{$drink->price}}</td>
					</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="people" value="{{$people}}">
	<input type="hidden" name="choose" value="{{$choose}}">
	<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
	<input type="hidden" name="sum" value="{{$sum}}">
	<input type="hidden" name="json_first_oreder" value="{{$json_first_oreder}}">

		
	<input type="submit" name="" value="Избирам"  class="btn btn-success">
	<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 

</form>

@endsection