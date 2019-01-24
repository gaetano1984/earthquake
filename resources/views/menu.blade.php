<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="#">{{__('earthquake.earthquake')}}</a>
	<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{route('quake_list')}}">
				{{__('earthquake.menu.most_recent')}}
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('quake_stats')}}">
				{{__('earthquake.menu.stats')}}
			</a>
		</li>
	</ul>
	<span class="my-2 my-lg-0" style="color:white; "><a href="{{url('user_profile')}}">Bentornato {{$user['name']}} {{$user['surname']}}</a></span>&nbsp; 
	<form method="POST" action="{{url('logout')}}">
		{{ csrf_field() }}
		<button class="btn btn-outline-danger">Logout</button>
	</form>
</nav>