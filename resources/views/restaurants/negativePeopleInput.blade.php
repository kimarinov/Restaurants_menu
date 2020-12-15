@extends('layouts.admin')
@section('content')
<h3>Броя на хората е отрицателен</h3>
<button onclick="goBack()" class="btn btn-primary">Върни ме на менюто с хората</button>
<script>
function goBack() {
  window.history.back();
}
</script>
<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 
@endsection