@extends('layouts.site')

@section('site-content')
<style>
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #F2F7FE;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
</style>
<main>
    <section class="hero_in restaurants_detail" >
        <div class="wrapper" >
            <div class="container">
            <h1 class="fadeInUp"><span></span>{{$property->name}}</h1>
            </div>
            <span class="magnific-gallery">

                @foreach ($gallaries as $gallary)
                    <a href="{{ URL::to('/images/property/' . $gallary->media) }}" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos</a>
                @endforeach

                
            </span>
        </div>
    </section>
    <!--/hero_in-->

    

    <div style="background-color: #F2F7FE;">

        <div class="container mt-2">
            <ul class="breadcrumb">
                <li><a href="{{ action('PublicRequestsController@by_city', ['city' => 'United Nations']) }}" class="">United Nations</a></li>
                <li><a href="{{ action('PublicRequestsController@by_city', ['city' => 'New York']) }}" class=""> State </a></li>
                <li><a href="{{ action('PublicRequestsController@by_city', ['city' => $property->address ]) }}" class="active">{{$property->address}}</a></li>
            </ul>
        </div>
        <!-- <nav class="nav">
            <div class="container">
                <ul class="clearfix">
                    
                    <li><a href="{{ action('PublicRequestsController@by_city', ['city' => 'United Nations']) }}" class="">United Nations</a></li>
                    /
                    <li><a href="{{ action('PublicRequestsController@by_city', ['city' => 'New York']) }}" class=""> State </a></li>
                    /
                    <li><a href="{{ action('PublicRequestsController@by_city', ['city' => $property->address ]) }}" class="active">{{$property->address}}</a></li>

                    <li><a href="#sidebar">Booking</a></li>
                </ul>
            </div>
        </nav> -->
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <section id="description">

                        <h1>{{$property->name}}</h1>
                        <p><img src="{{ asset('site/img/map-marker.png') }}" alt="" style="width:15px; height: 18px;">
                            {{$property->address}}
                        </p>

                        <h2>For Sale: <span style="color:green;"> ${{$occasions[0]->per_night_rent}} </span></h2>
                        <hr>

                    <div class="card">
                        <div class="card-body">

                            <h2>Description</h2>
                            
                                <div class="row my-5">
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/area.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Area:</b> {{$property->metadata->area}} sqft </span> 
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/beds.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Beds:</b> {{$property->metadata->bedrooms}} Bedrooms </span> 
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/rooms.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Type:</b> {{$property->metadata->type}} </span> 
                                    </div>
                                </div>
                                <div class="row my-5">
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/baths.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Baths:</b> {{$property->metadata->bathrooms}} Bathrooms </span> 
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/floors.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Floors:</b> {{$property->metadata->floors}} Floors </span> 
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('site/img/garage.png') }}" style="width:35px; height: 35px;"> 
                                        <span> <b>Garage:</b> {{$property->metadata->garages}} Garages </span> 
                                    </div>
                                </div>

                                
                            <p>{{$property->description}}</p>

                        </div>
                    </div>
                        <hr>
                    <div class="card">
                        <div class="card-body">

                    <h5>Availability For Specific Occasions</h5><br>

                    @foreach ($occasions as $occasion)
                    <strong>Occasion Name:</strong>  {{$occasion->occasion_name}}| <p><strong>From:</strong> {{$occasion->availability_from}}  <strong>To:</strong> {{$occasion->availability_to}} for  <strong><span style="font-size:22px; color: green;">${{$occasion->per_night_rent}}</span></strong>  per night</p>
                        <hr>
                    @endforeach

                    </div>
                    </div>
                    <hr>

                    <div class="card">
                        <div class="card-body">
                            <h5>Property Features</h5><br>
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="bullets">
                                            @foreach ($features as $feature)
                                                <li>{{$feature->feature->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>


                        <!-- /row -->
                        <hr>

                <div class="card">
                    <div class="card-body">
                        <h3>Address: </h3>
                        <p><img src="{{ asset('site/img/map-marker.png') }}" alt="" style="width:15px; height: 18px;">
                        {{$property->address}}
                        <div id="map" class="map map_single add_bottom_30">

                        </div>
                    </div>
                </div>
<script>
    // Initialize and add the map
    function initMap() {
        var geocoder, map;
        var address = "<?php echo $property->address ?>";
        codeAddress(address);
        function codeAddress(address) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var myOptions = {
                        zoom: 8,
                        center: results[0].geometry.location,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    map = new google.maps.Map(document.getElementById("map"), myOptions);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                }
            });
        }
    }
</script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoz4QoGE6E0uoOox3eNzL4HfLYs4k56_Q&callback=initMap">
    </script>
                        <!-- End Map -->
                    </section>
                    <!-- /section -->
                
                    <hr>

                </div>
                <!-- /col -->
                
                <aside class="col-lg-4" id="sidebar">
                    <div class="box_detail booking">
                        <div class="price">
                            <span>${{$occasions[0]->per_night_rent}} <small>/day</small></span>
                            <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div>
                        </div>
                        
                        <div class="form-group" id="input_date">
                            <input class="form-control" type="text" name="daterange" placeholder="When..">
                            <i class="icon_calendar"></i>
                        </div>

                        <div class="form-group" id="input_date">
                            <input class="form-control" type="number" name="menbers" placeholder="Total Members">
                            <!-- <i class="icon_calendar"></i> -->
                        </div>
                        
                        <a href="/2019/ovrvue/renterDash" class=" add_top_30 btn_1 full-width purchase">Book now</a>
                        <div class="text-center"><small>No money charged in this step</small></div>
                    </div>
                    <ul class="share-buttons">
                    <li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
                    <li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
                    <li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
                </ul>
                </aside>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
</main>

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

@endsection
