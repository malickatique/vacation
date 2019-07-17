@extends('layouts.site')

@section('site-content')

<section class="hero_in contacts">
	<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span>Properties</h1>
		</div>
	</div>
</section>

<div class="row my-5 mx-3">
    <div class="col-12 my-5">
        <form method="post" action="{{action('PublicRequestsController@getSearchResults')}}">
            {{ csrf_field() }}
            <div class="row no-gutters custom-search-input-2">
                <div class="col-lg-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="lookingFor" placeholder="What are you looking for...">
                        <i class="icon_search"></i>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input class="form-control" type="text" name="location" placeholder="Where">
                        <i class="icon_pin_alt"></i>
                    </div>
                </div>
                <div class="col-lg-3">
                    <select class="wide" name="cator">
                        <option value="all">All Categories</option>	
                        <option value="rent">Rent</option>
                        <option value="sale">Sale</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input type="submit" class="btn_search" value="Search">
                </div>
            </div>
            <!-- /row -->
        </form>
    </div>
</div>

<div class="container margin_60_35">
    <div class="wrapper-grid">
        <div class="row">
        
            @if(count($properties) > 0)
            @foreach ($properties as $property)
            
            <div class="col-xl-4 col-lg-6 col-md-6">
                    
                <div class="box_grid">
                    <figure>
                        <a href="#0" class="wish_bt"></a>
                        <a href="{{route('single-property', [str_slug($property->name), $property->id] )}}">

                            @if (empty($property->thumbnail))
                            <img src="{{ URL::to('/images/property/') .'/noImagefound.jpg' }}" class="img-fluid" alt="" width="800" height="533">
                            @else 
                            <img src="{{ URL::to('/images/property/' . $property->thumbnail) }}" class="img-fluid" alt="" width="800" height="533">
                            @endif

                            

                            {{-- <img src="/public/images/property/{{$property->thumbnail}}" class="img-fluid" alt="" width="800" height="533"> --}}
                            
                        
                            
                            
                            <div class="read_more"><span>Read more</span></div></a>
                    <small>{{$property->name}} </small>
                    </figure>
                    <div class="wrapper">
                        <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
                    <h3><a href="{{route('single-property', [str_slug($property->name), $property->id] )}}">{{$property->name}}</a></h3>
                        <p>
                            
                                {{str_limit($property->description, $limit = 20, $end = '...')}}</p>
                                
                        <span class="price">For: <strong>${{$property->per_night_rent}}</strong> /per night</span>
                            <br>
                                
                        <span class="price">Posted by: <strong class="text-capitalize"><a href="#">{{$property->user->name}}</a></strong></span>
                    </div>
                    {{-- <ul>
                        <li><i class="ti-eye"></i> 164 views</li>
                        <li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
                    </ul> --}}
                </div>
            </div>
            
            @endforeach

            @else

            <h5>No properties found.</h5>

            @endif

            
            

            
            
        
        </div>
        <!-- /row -->
        </div>
        <!-- /wrapper-grid -->
        
        {{-- <p class="text-center"><a href="{{route('single-property', [str_slug($property->name), $property->id] )}}" class="btn_1 rounded add_top_30">Load more</a></p> --}}
        
    </div>

@endsection
