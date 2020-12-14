@extends('layouts.admin')
@section('content')
<div class="card-body">
	<h3>Edit</h3>
	<div class="card-body">
		<form action="{{route('dishes.update',$dish->id)}}" method="POST" >
			{{csrf_field() }}
			{{method_field('PUT')}}
			<div class="form-group">
				<label for="name">
						Meal name
					</label>
					<input type="text" id="name" class="form-control" name="name" value="{{$dish->dish_name}}">
					@if($errors->has('name'))
						<div class="col-sm-7 col-sm-offset-1 text-danger">
							{{ $errors->first('name') }} 
						</div>
					@endif
	 				<label for="category">
						Meal category
					</label>
					<select name="category_id" id="category_id" class="form-control">
						@foreach( $categories as $category )
							<option value="{{$category->id}}" @if($category->category_name == $dish->category_name) selected @endif>
								 {{ $category->category_name }}
							</option>
						@endforeach
					</select>	
					<label for="category">
						Price
					</label>
					<input type="text" id="price" class="form-control" name="price" value="{{$dish->price}}">
					@if($errors->has('price'))
						<div class="col-sm-7 col-sm-offset-1 text-danger">
							{{ $errors->first('price') }} 
						</div>
					@endif
					<input type="submit" name=""class="btn btn-danger" value="Промени ястие!">
			</div>
		</form>
	</div>
</div>
@endsection