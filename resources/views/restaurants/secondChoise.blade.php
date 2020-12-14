@extends('layouts.admin')
@section('content')
<form action="{{route('secondChoise',$restaurant_id)}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
	Колко човека приемата менюто?<input type="text" name="first_order_people" value="2"><br>
	<input type="hidden" name="sum" value="{{$sum}}">
	<input type="hidden" name="people" value="{{$people}}">
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="json_first_oreder" value="{{$json_first_oreder}}">
	<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
	<input  class="btn btn-success" type="submit" name="" value="Избирам!">
	<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a>  
</form>


@endsection