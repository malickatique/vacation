<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panagea - Premium site template for travel agencies, hotels and restaurant listing.">
    <meta name="author" content="Ansonika">
    <title>OVR | Owner Vacation Rentals</title>

    <!-- Favicons-->
    {{-- <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"> --}}
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('site/css/vendors.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body id="login_bg">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<div id="login">
		<aside>
			<figure>
            <a href="/"><img src="{{asset('site/img/logo_sticky.png')}}" width="155" height="36" data-retina="true" alt="" class="logo_sticky"></a>
			</figure>
			  <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                <h4 class="text-center text-uppercase">Login now</h4>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <h5 class="alert alert-danger">{{ $errors->first('email') }}</h5>
                    </span>
                @endif 

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                
                <br>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        <i class="icon_mail_alt"></i>
                            {{-- @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif --}}
                        
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required>
                                <i class="icon_lock_alt"></i>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
				{{-- <div class="clearfix add_bottom_30">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                </div> --}}
                
                <button type="submit" class="btn_1 rounded full-width" class="btn btn-primary">
                        Login to OVR
                    </button>

				{{-- <a href="#0" class="btn_1 rounded full-width">Login to OVR</a> --}}
				<div class="text-center add_top_10">New to OVR? <strong><a href="{{route('select-view')}}">Sign up!</a></strong></div>
			</form>
			<div class="copy">© <?php echo date('Y'); ?> OVR</div>
		</aside>
	</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
<script src="{{ asset('site/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('site/js/common_scripts.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
	<script src="{{ asset('site/assets/validate.js') }}"></script>	
  
</body>
</html>