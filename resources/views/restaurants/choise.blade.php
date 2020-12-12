{{-- {{dd(32)}} --}}
@extends('layouts.admin')
@section('content')
<h3>Whaat You choose</h3>
{{-- {{dd($restaurant)}} --}}
{{-- {{dd($json_first_oreder)}} --}}


<form action="{{route('final_order',$restaurant_id)}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
 	<input type="radio" id="" name="choose" value="1" >
	<label for="choise">Приемате менюто</label><br>
	<input type="radio" id="" name="choose" value="2">
	<label for="choise">Отказвате менюто</label><br>
	<input type="radio" id="" name="choose" value="3" checked="">
	<label for="choise">Частично приемате менюто</label><br>
	<input type="hidden" name="json_first_oreder" value="{{$json_first_oreder}}">
	<input type="hidden" name="people" value="{{$people}}">
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="sum" value="{{$sum}}">
	<input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
	<input type="submit" name="" value="submit!">
</form>

@endsection