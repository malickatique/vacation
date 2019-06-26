@extends('layouts.site')

@section('site-content')

<div id="error_page">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-7 col-lg-9">
                    <h1 class="text-uppercase">Register as </h1>

                    <h3><a href="{{ URL::to('/renter') }}">Renter</a> | <a href="{{ URL::to('/register') }}">Owner</a></h3>
                    {{-- <p>We're sorry, but the page you were looking for doesn't exist.</p> --}}
                    {{-- <form>
                        <div class="search_bar_error">
                            <input type="text" class="form-control" placeholder="What are you looking for?">
                            <input type="submit" value="Search">
                        </div>
                    </form> --}}
                </div>
                
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection