@extends('layouts.site')

@section('site-content')

<main>
		
    <link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/custom.scss">
	
		<section class="hero_in hotels start_bg_zoom">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp animated"><span></span>Privacy Policy</h1>
				</div>
			</div>
		</section>
        <!--/hero_in-->

		
		<div class="filters_listing sticky_horizontal" style="">
			<div class="container">
                
                <h4 class="text-center py-2"> Privacy Policy of Owner Vacation Rentals </h4>
			</div>
			<!-- /container -->
		</div>
		<!-- /filters -->
		
		<!-- End Map -->

		<div class="container margin_60_35">
		<div class="wrapper-grid">
			<div class="row">
                <p>
                    <h3> Why do we use it? </h3>
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
			</div>
			<!-- /row -->
			</div>
			<!-- /wrapper-grid -->
			
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
