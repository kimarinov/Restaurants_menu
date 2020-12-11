@extends('layouts.admin')
@section('content')
<form action="{{route('secondChoise')}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
	Колко човека приемата менюто?<input type="text" name="first_order_people" value="2"><br>
	<input type="hidden" name="sum" value="{{$sum}}">
	<input type="hidden" name="people" value="{{$people}}">
	<input type="hidden" name="money" value="{{$money}}">
	<input type="hidden" name="json_first_oreder" value="{{$json_first_oreder}}">
	<input type="submit" name="" value="submit!">
</form>


@endsection