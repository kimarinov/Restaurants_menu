@extends('layouts.admin')
@section('content')
<h3>Restaurant MENU FOR "{{$dishes->first()->restaurant_name}}"</h3>


@if($choose == 1 || $choose == 2)
	<form action="{{route('calc.sum')}}" method="POST" accept-charset="utf-8">
		{{ csrf_field() }}
 		{{ method_field('POST') }}

			<table class="table table-dark">
				<thead>
					<tr>
						<th scope="col" class="text-center">#</th>	
						<th scope="col" class="text-center">First Menu</th>
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
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>

		<input type="hidden" name="money" value="{{$money}}">
		<input type="hidden" name="people" value="{{$people}}">
		<input type="hidden" name="choose" value="{{$choose}}">
		<input type="submit" name="" value="Total price">

	</form>
@endif

@if($choose == 3)
	<form action="{{route('calc.sum',$dishes->first()->restaurant_id)}}" method="POST" accept-charset="utf-8">
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
						{{-- <input type="hidden" name="{{ $dish->price}}" value="{{ $dish->price}} "> --}}
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
						{{-- <input type="hidden" name="{{ $dish->price}}" value="{{ $dish->price}} "> --}}
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
						{{-- <input type="hidden" name="{{ $dish->price}}" value="{{ $dish->price}} "> --}}
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
		<input type="submit" name="" value="Total price">
	</form>
@endif
@endsection