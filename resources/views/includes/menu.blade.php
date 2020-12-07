<ul>
	<li class="nav-item">
		<a class="nav-link" href="{{route('HomePage')}}">Home</a>
	</li>
	@if( Auth::check())
		<li class="nav-item">
			<a class="nav-link" href="{{route('restaurants.index')}}">Restourants</a>
		</li>
		@if( Auth::user()->role->role_name == 'admin')
			<li class="nav-item">		
				<a class="nav-link" href="{{route('dishes.index')}}">Meals</a>		
			</li>
			<li class="nav-item">		
				<a class="nav-link" href="">Drinks</a>		
			</li>
			<li class="nav-item">		
				<a class="nav-link" href="">Users</a>		
			</li>
		@endif
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
	<li class="nav-item">
		<button id="theme-toggle" class="fas fa-{{ $theme == 'dark' ? 'sun' : 'moon' }} nav-link" onclick="toogle()"><i>Light/Dark</i></button>
	</li>

</ul> 