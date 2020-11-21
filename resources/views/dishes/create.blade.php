@extends('layouts.admin')
@section('content')
<div class="card">
	 <div class="card-body">
	 	<div class="card-body">
	 		<form action="{{route('dishes.store')}}" method="POST">
	 			{{csrf_field()}}
	 			<div class="form-group">
	 				<label for="name">
						Meal name
					</label>
					<input type="text" id="name" class="form-control" name="name" value="{{old('name')}}">
	 				<label for="category">
						Meal category
					</label>
					<select name="category_id" id="category_id" class="form-control">
						@foreach( $categories as $categoty )
							<option value="{{$categoty->id}}"> {{ $categoty->category_name }}</option>
						@endforeach
					</select>	
					<label for="category">
						Price
					</label>
					<input type="text" id="price" class="form-control" name="price" value="{{old('price')}}">
					<label for="restaurant">
						Restaurant:
					</label>
					<div class="form-group row">				
					    <div class="col-sm-10">
					      	<div class="form-check">
					        	@foreach( $restaurants as $restaurant )
									<input type="checkbox" name="restaurant" value="{{$restaurant->id}}"  class="form-check-input">
									<label for="category" class="form-check-label">
										{{ $restaurant->restaurant_name }}
									</label>
									<br>
								@endforeach
					      	</div>
					    </div>	
				    </div>	
					<input type="submit" name=""class="btn btn-danger" value="Create meal">
	 			</div>
	 		</form>
	 	</div>
 	 </div>
</div>

@endsection