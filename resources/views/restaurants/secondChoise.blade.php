@extends('layouts.admin')
@section('content')
<form action="{{route('final_order')}}" method="POST">
	{{ csrf_field() }}
 	{{ method_field('POST') }}
 		Колко човека приемата менюто?<input type="text" name="new_people"><br>
	<input type="submit" name="" value="submit!">
</form>


@endsection