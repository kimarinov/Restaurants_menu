{{-- {{dd(32)}} --}}
@extends('layouts.admin')
@section('content')
<h3>Whaat You choose</h3>
{{-- {{dd($restaurant)}} --}}
{{-- {{dd($first_order)}} --}}


<form action="{{route('final_order')}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
 	<input type="radio" id="" name="choose" value="2" checked=>
	<label for="choise">Приемате менюто</label><br>
	<input type="radio" id="" name="choose" value="2">
	<label for="choise">Отказвате менюто</label><br>
	<input type="radio" id="" name="choose" value="3">
	<label for="choise">Частично приемате менюто</label><br>
{{-- 	<input type="hidden" name="first_order" value="{{$first_order->first()}}"> --}}
	<input type="submit" name="" value="submit!">
</form>

@endsection