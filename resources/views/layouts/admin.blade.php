<!DOCTYPE html>
<html>
   <head>
      
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>OVR | Dashboard</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-black.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
              <!-- Bootstrap 4 -->

    </head>
   <body class="hold-transition skin-black sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
            <span class="logo-mini"><b>O</b>VR</span>
            <span class="logo-lg"><b>Admin</b>OVR</span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="user-image img-responsive img-circle" src="{{ (Auth::user()->imageurl)?asset('images/users/'.Auth::user()->imageurl):asset('images/userprofile.png')}}" alt="User profile picture">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="user-header">
                              <img class="img-circle" src="{{ (Auth::user()->imageurl)?asset('images/users/'.Auth::user()->imageurl):asset('images/userprofile.png')}}" alt="User profile picture">
                              <p>
                                 {{ Auth::user()->name }}
                              </p>
                           </li>
                           <li class="user-body">
                           </li>
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>
         @include('inc.admin-sidebar')
         @yield('admin-content')
         <!-- /.content-wrapper -->
         <!-- Main Footer -->
         <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
               Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">OVR</a>.</strong> All rights reserved.
         </footer>
      </div>


    

      <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
      <script src="{{asset('plugins/repeater/jquery-1.11.1.js')}}"></script>
      <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
      <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
      @yield('admin-js')
      <script type="text/javascript">
        $(document).ready( function () {
            $('#pagesTable').DataTable();
        } );
      </script>
      <script type="text/javascript">
        $(document).ready( function () {
            $('#ownersTable').DataTable();
        } );
      </script>

      
   </body>
</html>