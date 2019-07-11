<aside class="main-sidebar">
    <section class="sidebar">
       <div class="user-panel">
          <div class="pull-left image">
             <img class="img-circle" src="{{ (Auth::user()->imageurl)?asset('images/users/'.Auth::user()->imageurl):asset('images/userprofile.png')}}" alt="User profile picture">
          </div>
          <div class="pull-left info">
             <p>{{ Auth::user()->name }}</p>
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
       </div>
       
       <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
             <input type="text" name="q" class="form-control" placeholder="Search...">
             <span class="input-group-btn">
             <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
             </button>
             </span>
          </div>
       </form>
      
       <ul class="sidebar-menu" data-widget="tree">
          <li class="active" ><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="header">Users</li>
          {{-- <li><a href="{{route('usertype.index')}}"><i class="fa fa-user"></i> <span>User Types</span></a></li> --}}
          <li ><a href="{{route('owner.index')}}"><i class="fa fa-file"></i> <span>Owners</span></a></li>
          <li><a href="{{route('renter.index')}}"><i class="fa fa-file"></i> <span>Renters</span></a></li>
          
          <li class="header">CMS Option</li>
          <li><a href="{{route('admin.allproperties')}}"><i class="fa fa-home"></i> <span>Properties</span></a></li>
          {{-- <li><a href="{{route('emailtemplate.index')}}"><i class="fa fa-envelope"></i> <span>Email Template</span></a></li> --}}
          <li><a href="{{route('subscription.index')}}"><i class="fa fa-dollar"></i> <span>Subscription</span></a></li>
          
          <li><a href="{{route('page.index')}}"><i class="fa fa-file"></i> <span>Pages</span></a></li>
          <li><a href="{{route('setting.view')}}"><i class="fa fa-cogs"></i> <span>Setting</span></a></li>
          <li><a href="{{route('chat.view')}}"><i class="fa fa-comments-o"></i> <span>Threads</span></a></li>
          
          {{-- <li class="treeview">
             <a href="#"><i class="fa fa-users"></i> <span>Users</span>
             <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
             </span>
             </a>
             <ul class="treeview-menu">
                <li><a href="{{route('admin.list')}}">Admin</a></li>
                <li><a href="{{route('owner.index')}}">Owner</a></li>
                <li><a href="#">Renters</a></li>
             </ul>
          </li> --}}
       </ul>
    </section>
 </aside>