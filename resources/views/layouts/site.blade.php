<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="OVR - Owner Vacation Rentals">
      <meta name="author" content="Ansonika">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>OVR | Owner Vacation Rentals</title>
     
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
      <link href="{{ asset('site/css/custom.css') }}" rel="stylesheet">
      <!-- Modernizr -->
      <script src="{{ asset('site/js/modernizr.js') }}"></script>

      <script src="{{ asset('site/js/jquery-3.3.1.slim.min.js') }}"></script>
      <script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>
      <!-- Data Range -->
      <script src="{{ asset('/js/jquery.min.js') }}"></script>
      <script src="{{ asset('/js/moment.min.js') }}"></script>
      <script src="{{ asset('/js/daterangepicker.min.js') }}"></script>
      <link href="{{ asset('/css/daterangepicker.css') }}" rel="stylesheet">
      
      <style>
      input.parsley-success,
   select.parsley-success,
   textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
   }

   input.parsley-error,
   select.parsley-error,
   textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
   }

   .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;
   color: #B94A48;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
   }

   .parsley-errors-list.filled {
   opacity: 1;
   }
</style>
   </head>
   <body>
      <div id="page">
         <header class="header menu_fixed">
            <div id="preloader">
               <div data-loader="circle-side"></div>
            </div>
            <!-- /Page Preload -->
            <div id="logo">
               <a href="{{ URL::to('/') }}">

                  @isset($logo)
                  <img src="{{ asset('images/setting/'.$logo->value )}}"  width="150" height="36" data-retina="true" alt="" class="logo_normal">
               @endisset
               
               
               @isset($site_sticky_logo)
                  <img src="{{ asset('images/setting/'.$site_sticky_logo->value )}}" width="150" height="36" data-retina="true" alt="" class="logo_sticky">
               @endisset
               </a>
            </div>
            <ul id="top_menu">
               {{-- 
               <li><a href="cart-1.html" class="cart-menu-btn" title="Cart"><strong>4</strong></a></li>
               --}}
               @if (Auth::guest())
               	<li><a href="#sign-in-dialog" id="sign-in" class="login" title="Sign In">Sign In</a></li>
               @endif
               {{-- 
               <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
               --}}
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
               <div class="hamburger hamburger--spin" id="hamburger">
                  <div class="hamburger-box">
                     <div class="hamburger-inner"></div>
                  </div>
               </div>
            </a>
            @include('inc.navbar')
         </header>
         <!-- /header -->
         
         @yield('site-content')
         <!-- /main -->
         <footer>
            <div class="container margin_60_35">
               <div class="row">
                  <div class="col-lg-5 col-md-12 p-r-5">
                     <p>
                        @isset($footer_logo)
                        <img src="{{ asset('images/setting/'.$footer_logo->value )}}" width="150" height="36" data-retina="true" alt="">
                        @endisset
                     </p>
                     <p>@isset($footer_desc){{$footer_desc->value}}@endisset</p>
                     {{-- 
                     <div class="follow_us">
                        <ul>
                           <li>Follow us</li>
                           <li><a href="#0"><i class="ti-facebook"></i></a></li>
                           <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                           <li><a href="#0"><i class="ti-google"></i></a></li>
                           <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                           <li><a href="#0"><i class="ti-instagram"></i></a></li>
                        </ul>
                     </div>
                     --}}
                  </div>
                  <div class="col-lg-3 col-md-6 ml-lg-auto">
                     <h5>Useful links</h5>
                     <ul class="links">
                        <li><a href="{{ URL::to('/login') }}">Login</a></li>
                        <li><a href="{{ URL::to('/select') }}">Register</a></li>
                        @isset($navs)
                        @foreach ($navs as $nav)
                        <li><a href="{{ URL::to('/page', $nav->slug) }}">{{$nav->name}}</a></li>
                        @endforeach
                        @endisset
                     </ul>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <h5>Contact with Us</h5>
                     <ul class="contacts">
                        <li><a href="tel://61280932400"><i class="ti-mobile"></i>@isset($footer_contact){{$footer_contact->value}}@endisset</a></li>
                        <li><a href="mailto:info@Panagea.com"><i class="ti-email"></i>@isset($footer_email){{$footer_email->value}}@endisset</a></li>
                     </ul>
                     <div id="newsletter">
                        <h6>Newsletter</h6>
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                           <div class="form-group">
                              <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                              <input type="submit" value="Submit" id="submit-newsletter">
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!--/row-->
               <hr>
               <div class="row">
               
                  <div class="col-lg-6">
                     <!-- <ul id="footer-selector">
                        <li>
                           <div class="styled-select" id="lang-selector">
                              <select>
                                 <option value="English" selected>English</option>
                                 <option value="French">French</option>
                                 <option value="Spanish">Spanish</option>
                                 <option value="Russian">Russian</option>
                              </select>
                           </div>
                        </li>
                        <li>
                           <div class="styled-select" id="currency-selector">
                              <select>
                                 <option value="US Dollars" selected>US Dollars</option>
                                 <option value="Euro">Euro</option>
                              </select>
                           </div>
                        </li>
                        <li><img src="{{ asset('site/img/cards_all.svg')}}" alt=""></li>
                     </ul> -->
                  </div>

                  <div class="col-lg-6">
                     <ul id="additional_links">
                        <li><a href="{{ route('terms-and-conditions') }}">Terms and conditions</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy</a></li>
                        <li><span>@isset($footer_trademark){{$footer_trademark->value}}@endisset
                           </span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </footer>
         <!--/footer-->
      </div>
      <!-- page -->
      <!-- Sign In Popup -->
      <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
         <div class="small-dialog-header">
            <h3>Sign In</h3>
         </div>
         <form method="POST" action="{{ route('login') }}">
            <div class="sign-in-wrapper">
               {{ csrf_field() }}
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" class="form-control" name="email" id="email">
                     <i class="icon_mail_alt"></i>
                     @if ($errors->has('email'))
                     <span class="help-block">
                     <strong>{{ $errors->first('email') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="password" id="password" value="">
                     <i class="icon_lock_alt"></i>
                     @if ($errors->has('password'))
                     <span class="help-block">
                     <strong>{{ $errors->first('password') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>
               {{-- 
               <div class="clearfix add_bottom_15">
                  <div class="checkboxes float-left">
                     <label class="container_check">Remember me
                     <input type="checkbox">
                     <span class="checkmark"></span>
                     </label>
                  </div>
                  <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
               </div>
               --}}
               <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
               <div class="text-center">
                  Don’t have an account? <a href="{{ URL::to('/select') }}">Sign up</a>
               </div>
            </div>
         </form>
         <!--form -->
      </div>
      <!-- /Sign In Popup -->
      <div id="toTop"></div>
      <!-- Back to top button -->
      <!-- COMMON SCRIPTS -->`
      <script src="{{ asset('plugins/repeater/jquery-1.11.1.js') }}"></script>`
      <script src="{{asset('plugins/repeater/jquery.repeater.min.js')}}"></script>
      <script src="{{asset('plugins/parsley/parsley.min.js')}}"></script>
      <script src="{{ asset('site/js/common_scripts.js') }}"></script>
      <script src="{{ asset('site/js/main.js') }}"></script>
      <script src="{{ asset('site/assets/validate.js') }}"></script>

   </body>
</html>