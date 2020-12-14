@extends('layouts.admin')
@section('content')
<h3>Меню за ресторант: "{{$dishes->first()->restaurant_name}}"</h3>


@if($choose == 1 || $choose == 2)
	<form action="{{route('calc.sum', $restaurant_id)}}" method="POST" accept-charset="utf-8">
		{{ csrf_field() }}
 		{{ method_field('POST') }}

			<table class="table table-dark">
				<thead>
					<tr>
						<th scope="col" class="text-center">#</th>	
						<th scope="col" class="text-center">First Menu</th>
						<th scope="col" class="text-center">Price</th>
					</tr>
				</thead>
				<tbody>
					@php
					$num = 1;
					@endphp
					@foreach($dishes as $dish)
					<tr>
						@if($dish->category_id == 1)
						<td class="text-center"><?= $num++ ?></td>
						<td class="text-center">
							<input type="checkbox" name="{{$dish->dish_name}}" value="{{$dish->dish_id}}" checked>
							<label>
								{{ $dish->dish_name}}
							</label>
						<td class="text-center">{{ $dish->price}}</td>
						</td>
					
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Second Menu</th>
					<th scope="col" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@php
				$num = 1;
				@endphp
				@foreach($dishes as $dish)
					<tr>
						@if($dish->category_id == 2)
							<td class="text-center"><?= $num++ ?></td>
							<td class="text-center">
								<input type="checkbox" name="{{$dish->dish_name}}" value="{{$dish->dish_id}}" checked>
								<label>
									{{ $dish->dish_name}}
								</label>
							</td>
							<td class="text-center">{{ $dish->price}}</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Third Menu</th>
					<th scope="col" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@php
				$num = 1;
				@endphp
				@foreach($dishes as $dish)
					<tr>
						@if($dish->category_id == 3)
							<td class="text-center"><?= $num++ ?></td>
							<td class="text-center">
								<input type="checkbox" name="{{$dish->dish_name}}" value="{{$dish->dish_id}}" checked="">
								<label>
									{{ $dish->dish_name}}
								</label>
							</td>
							<td class="text-center">{{$dish->price}}</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>

		<input type="hidden" name="money" value="{{$money}}">
		<input type="hidden" name="people" value="{{$people}}">
		<input type="hidden" name="choose" value="{{$choose}}">
		<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
		<input type="submit" name="" value="Избирам"  class="btn btn-success">
		<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 

	</form>
@endif

@if($choose == 3)
	<form action="{{route('calc.sum',$restaurant_id)}}" method="POST" accept-charset="utf-8">
		{{ csrf_field() }}
 		{{ method_field('POST') }}
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Dish name from first menu</th>
					<th scope="col" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@php
					$num = 1;
				@endphp
				@foreach($dishes as $dish)

				<tr>
					@if($dish->category_id == 1)
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">
						<input type="number" name="{{ $dish->dish_id}}"  width: 80px >
						<label>
							{{ $dish->dish_name}}
						</label>
					</td>
					<td class="text-center">{{ $dish->price}}</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>

		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Dish name from first menu</th>
					<th scope="col" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@php
					$num = 1;
				@endphp
				@foreach($dishes as $dish)

				<tr>
					@if($dish->category_id == 2)
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">
						<input type="number" name="{{ $dish->dish_id}}"  width: 80px >
						<label>
							{{ $dish->dish_name}}
						</label>
					</td>
					<td class="text-center">{{ $dish->price}}</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Dish name from first menu</th>
					<th scope="col" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@php
					$num = 1;
				@endphp
				@foreach($dishes as $dish)

				<tr>
					@if($dish->category_id == 3)
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">
						<input type="number" name="{{ $dish->dish_id}}"  width: 80px >
						<label>
							{{ $dish->dish_name}}
						</label>
					</td>
					<td class="text-center">{{ $dish->price}}</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<input type="hidden" name="money" value="{{$money}}">
		<input type="hidden" name="choose" value="{{$choose}}">
		<input type="submit" name="" value="Избирам"  class="btn btn-success">
		<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a>  
	</form>
@endif
@endsection