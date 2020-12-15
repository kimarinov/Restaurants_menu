@extends('layouts.admin')
@section('content')
<div class="card">
   	<div class="card-body">
	    <div class="table-responsive">
	        <table class=" table table-bordered table-striped table-hover datatable datatable-Meal">
	            <thead>
	                <tr>
	                    <th>
	                        #
	                    </th>
	                    <th>
	                        Юзер име:
	                    </th>
	                    <th>
	                        Емейл:
	                    </th>
	                    <th>
	                        Роля:
	                    </th>
	                </tr>
	            </thead>
	            @php
	            	$num = 1;
	            @endphp
	            @foreach($users as $user)
	            <tbody>
	            	<tr>
	            		<td>
	            			{{$num++}}
	            		</td>
	            		<td>
	            			{{$user->name}}
	            		</td>
	            		<td>
	            			{{$user->email}}
	            		</td>
	            		<td>
	            			{{$user->role_name}}
	            		</td>
	            	</tr>
	            </tbody>
	            @endforeach
	        </table>
	   </div>
   </div>
</div>

@endsection