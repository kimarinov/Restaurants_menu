@extends('layouts.admin')
@section('content')
<h3>Какво избирате:</h3>

<form action="{{route('final_order',$restaurant_id)}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
 	<input type="radio" id="" name="choose" value="1" >
	<label for="choise">Приемате менюто</label><br>
	<input type="radio" id="" name="choose" value="3" >
	<label for="choise">Частично приемате менюто</label><br>
	<input type="hidden" name="json_first_oreder" value="{{$json_first_oreder}}">
	<input type="hidden" name="people" value="{{$people}}">
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="sum" value="{{$sum}}">
	<input type="hidden" name="json_first_oreder_drinks" value="{{$json_first_oreder_drinks}}">
	<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
	<input  class="btn btn-success" type="submit" name="" value="Избирам меню!">
	<a href="{{route('HomePage')}}" class="btn btn-warning">Отказвам менюто</a> 
</form>

@endsection