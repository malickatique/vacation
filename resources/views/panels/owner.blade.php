@extends('panels.panel_master')
@section('content')


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Owner</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{route('owner')}}" class="brand-link">
      <img src="images/logo-pic.png" alt="Logo" class="panel-logo"
           style="">
      <span class="brand-text font-weight-light panel-text-logo"> Owner Vacation Rentals </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">  {{ Auth::user()->name }}  </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>
                Dashboard
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">

            <li class="nav-item">
                <router-link to="/properties" class="nav-link">
                  <i class="nav-icon fa fa-home"></i>
                <p>
                    Properties
                </p>
                </uter-link>
            </li>


              <li class="nav-item">
                <router-link to="/owner_profile" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p> Profile </p>
                </uter-link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
              <router-link to="/chat" class="nav-link">
                <i class="fa fa-comments nav-icon"></i>
                <p> Messages</p>
              </uter-link>
          </li>
          
          <li class="nav-item">
            <router-link to="/messaging" class="nav-link">
                <i class="nav-icon fa fa-external-link"></i>
              <p>Others</p>
            </router-link>
          </li>

          <li class="nav-item">
            <a href="{{route('user.logout')}}" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>Log Out</p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Main content --> 
  <!-- Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          {{-- <keep-alive> --}}
              <router-view> </router-view>
          {{-- </keep-alive> --}}
      </div>
    </div>
 
  </div>



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-sm-none d-md-block">
      Letsss
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-2022 <a href="#"> OVR </a>.</strong> All rights reserved.
  </footer>


@endsection