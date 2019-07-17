<nav id="menu" class="main-menu">
        <ul>
            <li><span><a href="{{ URL::to('/') }}">Home</a></span></li>
            <li><span><a href="{{ URL::to('/select') }}"">Register</a></span></li>
            <li><span><a href="{{route('show-properties')}}">Properties</a></span></li>
             
            @isset($navs)
                @foreach ($navs as $nav)
                    <li><span><a href="{{ URL::to('/page', $nav->slug) }}">{{$nav->name}}</a></span></li>
                @endforeach
            @endisset

            {{-- <li><span><a href="#">Gallary</a></span></li>
            <li><span><a href="#">About</a></span></li> --}}

            @isset(Auth::user()->user_type)
                @if (Auth::user()->user_type == 'owner')

                {{-- <li style="padding:4px" ><a href="{{ URL::route('property.create') }}" class="btn_1 rounded" >+ Add Property</a></li> --}}
                     
                @endif
            @endisset


            @isset(Auth::user()->user_type)
                @if (Auth::user()->user_type == 'owner' || Auth::user()->user_type == 'renter')
                    | <li class="text-capitalize"><span><a href="#">{{Auth::user()->name}}</a></span>
					<ul>
						<li><a href="{{url('/renterDash')}}">Dashboard</a></li>
						<li><span><a href="{{route('user.logout')}}">Logout</a></span></li>
					</ul>
				</li>  
                @endif
            @endisset

           

        </ul>
    </nav>