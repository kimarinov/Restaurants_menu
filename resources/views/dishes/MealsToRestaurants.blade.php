@extends('layouts.admin')
@section('content')
<div class="card">
	 <div class="card-body">
	 	<div class="card-body">
	 		<form action="{{route('addMealsToRestaurants')}}" method="POST">
	 			{{csrf_field()}}
	 			<div class="form-group">
	 				<label for="name">
						Ястие:
					</label>
					<select name="dishes" id="" class="form-control">
						@foreach( $dishes as $dish )
							<option value="{{$dish->id}}"> {{ $dish->dish_name }}</option>
						@endforeach
					</select>	
					<label for="name">
						Принадлежи на:
					</label>
					<div class="form-group row">				
					    <div class="col-sm-10">
					      	<div class="form-check">
					        	@foreach( $restaurants as $restaurant )
									<input type="checkbox" name="{{$restaurant->restaurant_name}}" value="{{$restaurant->id}}"  class="form-check-input">
									<label for="category" class="form-check-label">
										{{ $restaurant->restaurant_name }}
									</label>
									<br>
								@endforeach
					      	</div>
					    </div>	
				    </div>	
					<input type="submit" name=""class="btn btn-danger" value="Добави ястие!">
	 			</div>
	 		</form>
	 	</div>
 	 </div>
</div>
@endsection