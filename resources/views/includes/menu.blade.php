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
	<li class="nav-item">
		<button id="theme-toggle" class="fas fa-{{ $theme == 'dark' ? 'sun' : 'moon' }} nav-link" onclick="toogle()"><i>Light/Dark</i></button>
	</li>
</ul>
