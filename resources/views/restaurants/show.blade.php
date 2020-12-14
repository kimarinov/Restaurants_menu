@extends('layouts.admin')
@section('content')
<h3>Изберете и попълнете:</h3>

<form action="{{route('restaurant.menu',$restaurant->id)}}" method="POST">
	{{csrf_field()}}
 	{{-- {{method_field('POST')}} --}}
 	<label>
 		Брой на хората:
 	</label>
 	<input class="input-group-text" type="number" name="number_of_people" value="4">
 	@if($errors->has('number_of_people'))
		<div class="col-sm-7 col-sm-offset-1 text-danger">
			{{ $errors->first('number_of_people') }} 
		</div>
	@endif
 	<label>
 		Сума с която разполагате:
 	</label>
 	<input class="input-group-text" type="number" name="money" value="10000">
 	@if($errors->has('money'))
		<div class="col-sm-7 col-sm-offset-1 text-danger">
			{{ $errors->first('money') }} 
		</div>
	@endif
 	<label>
 		Какво избирате?:
 	</label><br>
	<input  type="radio" id="" name="choose" value="1" checked >
	<label for="male">Стартер + салата + основно + питие</label><br>
	<input type="radio" id="" name="choose" value="2">
	<label for="male">Салата + питие </label><br>
	<input type="radio" id="" name="choose" value="3" >
	<label for="male">Свободна консумация</label><br>
	<input type="hidden" name="restaurant" value="{{$restaurant->id}}">
	<input  class="btn btn-success" type="submit" name="" value="Избирам!">
	<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 
</form>

@endsection