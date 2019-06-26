@extends('layouts.admin')
@section('js')
<script>
   window.setTimeout(function() {
   $(".alert").fadeTo(500, 0).slideUp(500, function(){
       $(this).remove(); 
   });
   }, 4000);
</script>
@append
@section('admin-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         User Profile
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">User profile</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif
      <div class="row">
         <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
               <div class="box-body box-profile">
                  {{-- <img class="profile-user-img img-responsive img-circle" src="{{ asset('admin/dist/img/user4-128x128.jpg')}}"
                     alt="User profile picture"> --}}
                  <img class="profile-user-img img-responsive img-circle" width="100px" height="140px" src="{{ (Auth::user()->imageurl)?asset('images/users/'.Auth::user()->imageurl):asset('images/userprofile.png')}}" alt="User profile picture">
                  
                  <h3 class="profile-username text-center">{{ (Auth::user()->name)?Auth::user()->name:'Admin User'}}</h3>
                  <form method="POST" action="{{ route('admin.changepicture') }}" enctype="multipart/form-data" >
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="exampleInputFile">Change Profile Picture</label>
                        <input type="file" class="btn btn-primary btn-block" name="image" id="file">
                     </div>
                     <input type="submit" class="btn btn-success btn-block" name="submit" value="Update">
                  </form>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- About Me Box -->
         </div>
         <!-- /.col -->
         <div class="col-md-9">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Change Password</a></li>
                  <li><a href="#changeinfo" data-toggle="tab">Admin Information</a></li>
               </ul>
               <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                     <form class="form-horizontal" method="POST" action="{{ route('admin.changepassword') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label for="old_password" class="col-sm-2 control-label">Old Password</label>
                           <div class="col-sm-10">
                              <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="new_password" class="col-sm-2 control-label">New Password</label>
                           <div class="col-sm-10">
                              <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="retype_password" class="col-sm-2 control-label">Retype Password</label>
                           <div class="col-sm-10">
                              <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Retype Password">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-2"></div>
                           <div class="col-sm-10">
                              <input type="submit" class="btn btn-success" value="Change Password">
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane" id="changeinfo">
                     <form class="form-horizontal" method="POST" action="{{ route('admin.changeinfo') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Name</label>
                           <div class="col-sm-10">
                              <input type="text" class="form-control" value="{{ (Auth::user()->name)}}" name="name" id="name" placeholder="Name">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="email" class="col-sm-2 control-label">Email</label>
                           <div class="col-sm-10">
                              <input type="email" name="email" value="{{ (Auth::user()->email)}}" class="form-control" id="email" placeholder="Email">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-2"></div>
                           <div class="col-sm-10">
                              <input type="submit" class="btn btn-success" value="Update">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection