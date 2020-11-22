@extends('layouts.admin')

@section('content')

<h1>Wellcome Page</h1>
{{dd($user->role->role_name)}}
@endsection