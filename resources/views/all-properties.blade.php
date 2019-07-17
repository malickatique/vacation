@extends('layouts.site')

@section('site-content')

<main>
		
    <link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/custom.scss">
	
		<section class="hero_in hotels start_bg_zoom">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp animated"><span></span>Properties</h1>
				</div>
			</div>
		</section>
        <!--/hero_in-->

		
		<div class="filters_listing sticky_horizontal" style="">
			<div class="container">
				<ul class="clearfix">
					<li>
						<div class="switch-field">
							<input type="radio" id="all" name="listing_filter" value="all" checked="">
							<label for="all">All</label>
							<input type="radio" id="popular" name="listing_filter" value="popular">
							<label for="popular">Popular</label>
							<input type="radio" id="latest" name="listing_filter" value="latest">
							<label for="latest">Latest</label>
						</div>
					</li>
					<li>
						<div class="layout_view">
							<a href="#0" class="active"><i class="icon-th"></i></a>
							<a href="hotels-list-isotope.html"><i class="icon-th-list"></i></a>
						</div>
					</li>
					<li>
						<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
					</li>
				</ul>
			</div>
			<!-- /container -->
		</div>
		<!-- /filters -->
		
		<div class="collapse" id="collapseMap">
			<div id="map" class="map"></div>
		</div>
		<!-- End Map -->

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
			
			{{-- <p class="text-center"><a href="{{route('single-property', $property->id)}}" class="btn_1 rounded add_top_30">Load more</a></p> --}}
			
		</div>
			
		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-help2"></i>
							<h4>Need Help? Contact us</h4>
							<p>Cum appareat maiestatis interpretaris et, et sit.</p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-wallet"></i>
							<h4>Payments</h4>
							<p>Qui ea nemore eruditi, magna prima possit eu mei.</p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-note2"></i>
							<h4>Cancel Policy</h4>
							<p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>
						</a>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
		
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
	</main>

@endsection
