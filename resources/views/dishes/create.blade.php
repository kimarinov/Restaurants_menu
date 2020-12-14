@extends('layouts.admin')
@section('content')
<div class="card">
	 <div class="card-body">
	 	<div class="card-body">
	 		<form action="{{route('dishes.store')}}" method="POST">
	 			{{csrf_field()}}
	 			<div class="form-group">
	 				<label for="name">
						Ястие:
					</label>
					<input type="text" id="name" class="form-control" name="name" value="{{old('name')}}">
					@if($errors->has('name'))
						<div class="col-sm-7 col-sm-offset-1 text-danger">
							{{ $errors->first('name') }} 
						</div>
					@endif

	 				<label for="category">
						Категория:
					</label>
					<select name="category_id" id="category_id" class="form-control">
						@foreach( $categories as $categoty )
							<option value="{{$categoty->id}}"> {{ $categoty->category_name }}</option>
						@endforeach
					</select>	
					<label for="category">
						Цена:
					</label>
					<input type="text" id="price" class="form-control" name="price" value="{{old('price')}}">
					@if($errors->has('price'))
						<div class="col-sm-7 col-sm-offset-1 text-danger">
							{{ $errors->first('price') }} 
						</div>
					@endif
					
					<input type="submit" name=""class="btn btn-danger" value="Create meal">
	 			</div>
	 		</form>
	 	</div>
 	 </div>
</div>

@endsection