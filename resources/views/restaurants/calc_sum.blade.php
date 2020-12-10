{{-- {{dd(2323)}} --}}
@extends('layouts.admin')
@section('content')
	@if( Session::has('success') )
		<div class="alert alert-success">
			{{ Session::get('success') }}
		</div>
	@endif

<h3>Total price is {{$sum}}</h3>

@endsection