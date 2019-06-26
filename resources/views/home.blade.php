@extends('layouts.site')

@section('site-content')
<link href="{{ asset('site/userprofile.css') }}" rel="stylesheet">

<section class="hero_in general start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>Owner Dashboard</h1>
            </div>
        </div>
    </section>

<br> 


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row profile">
                            <div class="col-md-3">
                                <div class="profile-sidebar">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic text-center">
                                        <img src="{{ asset('site/userprofile.png') }}" class="img-responsive" alt="">
                                    </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name">
                                            {{Auth::user()->name}}
                                        </div>
                                        <div class="profile-usertitle-job">
                                            Owner
                                        </div>
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
                                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <!-- SIDEBAR MENU -->

                                    <br>

                                    <ul class="nav flex-column">
                                            <li class="nav-item">
                                                    <a class="nav-link active" href="{{route('home')}}">Dashboard</a>
                                                 </li>
                                                 <li class="nav-item">
                                                      <a class="nav-link" href="{{ route('property.index')}}">Properties</a>
                                                   </li>
                                                 <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('property.create')}}">Add Property</a>
                                                 </li>
                                            {{-- <li class="nav-item">
                                              <a class="nav-link" href="#">Link</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                            </li> --}}
                                          </ul>
                                    <!-- END MENU -->
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="profile-content">
                                   <h3>Welcome to dashboard</h3>
                                </div>
                            </div>
                        </div>

                
    </div>
<br>
@endsection
