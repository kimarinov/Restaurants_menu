@extends('layouts.admin')
@section('content')
<h3>Whaat You choose</h3>
{{-- {{dd($restaurant)}} --}}


<form action="{{route('restaurant.menu',$restaurant->id)}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
 	<input type="number" name="number_of_people">How many people YOU are?<br>
 	<input type="number" name="money"> How much money You have?<br>
	<input type="radio" id="" name="choose" value="1">
	<label for="male">starter + salad + main + drinks</label><br>
	<input type="radio" id="" name="choose" value="2">
	<label for="male">salad + drinks</label><br>
	<input type="radio" id="" name="choose" value="3">
	<label for="male">Free consumation</label><br>
	<input type="submit" name="" value="submit!">
	<input type="hidden" name="restaurant" value="{{$restaurant->id}}">
</form>

@endsection