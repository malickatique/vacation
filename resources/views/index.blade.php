@extends('layouts.site')

@section('site-content')
<main>
<style>
.centered {
  position: absolute;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-weight: bold;
}
#fixed{
    background: url('{{ asset('site/img/tour_5.jpg') }}')no-repeat center center fixed;
    height: 340px;
	/* filter: brightness(60%); */
    width: 100%;

    background-size:cover;
}
</style>
	<section class="header-video">
		<div id="hero_video">
			<div class="wrapper">
			<div class="container">
				<h3>Book unique experiences</h3>
				<p>Expolore top rated tours, hotels and restaurants around the world</p>

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
							<option value="apartment">Apartment</option>
							<option value="house">House</option>
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
		</div>
		<img src="{{ asset('site/img/video_fix.png') }}" alt="" class="header-video--media" data-video-src="{{ asset('site/video/intro')}}" data-teaser-source="{{ asset('site/video/intro')}}" data-provider="" data-video-width="1920" data-video-height="960">
	</section>
	<!-- /header-video -->

	<div class="container-fluid margin_80_0">
		<div class="main_title_2">
			<span><em></em></span>
			<h2>Latest Properties</h2>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
		</div>

		<div id="reccomended" class="owl-carousel owl-theme">
				@if(count($properties) > 0)
				@foreach ($properties as $property)
			<div class="item">
				<div class="box_grid">
					<figure>
						<a href="#0" class="wish_bt"></a>
						<a href="{{ route('single-property', [ str_slug($property->name) ,$property->id] ) }}">
						<!-- <a href="/view/{$property->name}/{$property->id}"> -->
						
						

								@if (empty($property->thumbnail))
								<img src="{{ URL::to('/images/property/') .'/noImagefound.jpg' }}" class="img-fluid" alt="" width="800" height="533">
								@else 
								<img src="{{ URL::to('/images/property/' . $property->thumbnail) }}" class="img-fluid" alt="" width="800" height="533">
								@endif


						
						
						<div class="read_more"><span>Read more</span></div></a>
						<small>{{$property->name}}</small>
					</figure>

					<div class="wrapper">
						<h3><a href="{{route('single-property', [str_slug($property->name), $property->id] )}}">{{$property->name}}</a></h3>
						<p>{{str_limit($property->description, $limit = 20, $end = '...')}}</p>
						<span class="price">From <strong>${{$property->per_night_rent}}</strong> /per night</span>
					
						<br>
								
						<span class="price">Posted by: <strong class="text-capitalize"><a href="#">{{$property->user->name}}</a></strong></span>
					</div>
					<!-- <ul>
						<li><i class="icon_clock_alt"></i> 1h 30min</li>
						<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
					</ul>  -->
				</div>
			</div>
			@endforeach
			@endif
			<!-- /item -->
			
		</div>
		<!-- /carousel -->
		<div class="container">
		<p class="btn_home_align"><a href="{{route('show-properties')}}" class="btn_1 rounded">View all Properties</a></p>
		</div>
		<!-- /container -->
		<hr class="large">
	</div>
	<!-- /container -->

	<!-- three simple steps -->
	<div class="container-fluid">
		<div class="row bg-white py-5">
			<div class="col-12">
				<div class="row">
					<div class="col text-center">
						<h1>Simple Steps</h1>
						<p> Duis aute irure dolor in reprehed in volupted velit esse dolore </p>
					</div>
				</div>
				
				<div class="row text-center my-5">
					<div class="col-md-4 col-xs-12 col-sm-6">
						<img src="{{ asset('site/img/1.png') }}" alt="">
						<h6 class="my-3">Search For Real Estates</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper accumsan. </p>
					</div>

					<div class="col-md-4 col-xs-12 col-sm-6">
						<img src="{{ asset('site/img/2.png') }}" alt="">
						<h6 class="my-3">Select Your Favorite</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper accumsan. </p>
					</div>

					<div class="col-md-4 col-xs-12 col-sm-6">
						<img src="{{ asset('site/img/3.png') }}" alt="">
						<h6 class="my-3">Take Your Key</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper accumsan. </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /three simple steps -->

	<div class="container-fluid" style="background-color: #F2F7FE;">

	<section class="gallery-block cards-gallery">
	    <div class="container">
	        <div class="heading text-center py-5">
	          <h2>Property By City</h2>
	        </div>
	        <div class="row">
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
	                	<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'New York']) }}">
	                		<img src="{{ asset('site/img/newyork.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
	                	</a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'New York']) }}"> New York </a></h6>
							<p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['New York'] }}+ </h3> 
							Properties registered in New York </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
						<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'Chicago']) }}">
		                	<img src="{{ asset('site/img/chicago.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
		                </a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'Chicago']) }}"> Chicago </a></h6>
	                        <p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['Chicago'] }}+ </h3> 
							Properties registered in Chicago </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
	                	<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'Manhattan']) }}">
	                		<img src="{{ asset('site/img/manhatten.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
	                	</a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'Manhattan']) }}"> Manhattan </a></h6>
	                        <p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['Manhatten'] }}+ </h3> 
							Properties registered in Manhatten </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
	                	<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'Los Angeles']) }}">
	                		<img src="{{ asset('site/img/Los Angeles.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
	                	</a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'Los Angeles']) }}"> Los Angeles </a></h6>
	                        <p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['Los Angeles'] }}+ </h3> 
							Properties registered in Los Angeles </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
	                	<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'San Francisco']) }}">
	                		<img src="{{ asset('site/img/San Francisco.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
	                	</a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'San Francisco']) }}">San Francisco</a></h6>
	                        <p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['San Francisco'] }}+ </h3> 
							Properties registered in San Francisco </p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-lg-4 py-4">
	                <div class="card border-0 transform-on-hover shadow-lg">
	                	<a class="lightbox" href="{{ action('PublicRequestsController@by_location', ['city' => 'Austin']) }}">
	                		<img src="{{ asset('site/img/austin.jpg') }}" alt="Card Image" class="card-img-top" style="height:250px">
	                	</a>
	                    <div class="card-body">
	                        <h6><a href="{{ action('PublicRequestsController@by_location', ['city' => 'Austin']) }}">Austin</a></h6>
	                        <p class="text-muted card-text"> <h3 class="text-success"> {{ $by_city['Austin'] }}+ </h3> 
							Properties registered in Austin </p>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </section>
		
	</div>
	<!-- fixed bg image -->
<figure class="my my-5">
    <div id="fixed" class="shadow-lg">
        <h1 class="font-weight-bolder text-center text-white" style="padding: 145px 0px 0px 0px; font-size: 1.5em;">
			Join our professional team & agents to start selling your house 
			<br> <br> <a href="{{ URL::to('/select') }}" class="btn btn-success btn"> Join Us </a>
        </h1>
    </div>
</figure>

	<div class="container-fluid margin_30_95 pl-lg-5 pr-lg-5">
		<section class="add_bottom_45">
			<div class="main_title_3">
				<span><em></em></span>
				<h2>Popular Properties</h2>
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>
			<div class="row">
					@if(count($properties) > 0)
					@foreach ($properties as $property)
				<div class="col-xl-3 col-lg-6 col-md-6">
					<a href="{{route('single-property', [str_slug($property->name), $property->id] )}}" class="grid_item">
						<figure>
							{{-- <div class="score"><strong>8.9</strong></div> --}}
							@if (empty($property->thumbnail))
								<img src="{{ URL::to('/images/property/') .'/noImagefound.jpg' }}" class="img-fluid">
								@else 
								<img src="{{ URL::to('/images/property/' . $property->thumbnail) }}" class="img-fluid">
								@endif
							<div class="info">
								{{-- <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div> --}}
								<h3>{{$property->name}}</h3>
							</div>
						</figure>
					</a>
								
						<span class="price">Posted by: <strong class="text-capitalize"><a href="#">{{$property->user->name}}</a></strong></span>
				</div>
				@endforeach
			@endif
				
			</div>
			<!-- /row -->
			<a href="{{route('show-properties')}}"><strong>View all <i class="arrow_carrot-right"></i></strong></a>
		</section>
		<!-- /section -->
		
		
	</div>
	<!-- /container -->


	<div class="call_section">
		<div class="container clearfix">
			<div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
				<div class="block-reveal">
					<div class="block-vertical"></div>
					<div class="box_1">
						<h3>Enjoy a GREAT travel with us</h3>
						<p>Ius cu tamquam persequeris, eu veniam apeirian platonem qui, id aliquip voluptatibus pri. Ei mea primis ornatus disputationi. Menandri erroribus cu per, duo solet congue ut. </p>
						<a href="#0" class="btn_1 rounded">Read more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/call_section-->

	</main>
	<!-- <script src="{{ asset('js/app.js') }}"></script> -->
	<!-- SPECIFIC SCRIPTS -->
	<script src="{{ asset('site/js/video_header.js') }}"></script>
	<script>
		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
	</script>
	@endsection