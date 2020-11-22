<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link" href="{{route('HomePage')}}">Home</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{route('restaurants.index')}}">Restourants</a>
	</li>
	<li class="nav-item">		
		<a class="nav-link" href="{{route('dishes.index')}}">Meals</a>		
	</li>
	<li class="nav-item">		
		<a class="nav-link" href="">Drinks</a>		
	</li>
	<li class="nav-item">		
		<a class="nav-link" href="">Users</a>		
	</li>
	@if( Auth::check()) 
 		<li class="nav-item">		
			<a class="nav-link" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        Logout
    </a>	
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>	
		</li>
	@else
		<li class="nav-item">		
			<a class="nav-link" href="{{route('login')}}">Login</a>		
		</li>
		<li class="nav-item">		
			<a class="nav-link" href="{{route('register')}}">Register</a>		
		</li>
	@endif

</ul>