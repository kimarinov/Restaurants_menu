@extends('layouts.admin')
@section('content')
<h3>You order:</h3>
<table class="table table-secondary">
			<thead>
				<tr>
					<th scope="col" class="text-center">#</th>	
					<th scope="col" class="text-center">Dish</th>
					<th scope="col" class="text-center">Price</th>

				</tr>
			</thead>
			<tbody>
				@php
				$num = 1;
				@endphp
				@foreach($orders as $key =>$order)
				<tr>
					<td class="text-center"><?= $num++ ?></td>
					<td class="text-center">{{"$people x "}}{{$key}} </td>
					<td class="text-center">{{$order}} </td>
					
				</tr>
				@endforeach
			</tbody>
			 <tfoot class="table-dark">
			 	<tr>
				 	<th scope="col" class="text-center">#</th>	
				 	<th scope="col" class="text-center">Number of dishes</th>	
				 	<th scope="col" class="text-center">Total price:</th>	
			 	</tr>
			 	<tr>
				 	<td class="text-center">#</td>
				 	<td class="text-center">{{$people * $num}}</td>
	      			<td class="text-center">{{$sum}} </td>
      			</tr>
			 </tfoot>
		</table>

@endsection