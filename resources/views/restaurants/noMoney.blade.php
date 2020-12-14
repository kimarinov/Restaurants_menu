@extends('layouts.admin')
@section('content')
<h3>Нямате такава сума </h3>
<h4>Вашата сметка е: {{$sum}} ,Вие имате: {{$money}}</h4>
<a href="{{route('restaurants.index')}}" class="btn btn-warning"> Върни ме на ресторантите</a> 
@endsection