@extends('layouts.admin')
@section('content')

<h2>Restaurants</h2>
<table class="table table-dark">
	<thead>
		<tr>
			<th scope="col" class="text-center">#</th>
			<th scope="col" class="text-center">Restaurant</th>
		</tr>
	</thead>
	<tbody>
		@php
		$num = 1;
		@endphp
		@foreach( $restaurants as $restaurant )
		<tr>
			<td class="text-center"><?= $num++ ?></td>
			<td class="text-center"><a href="" >{{ $restaurant->restaurant_name }}</a> </td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection