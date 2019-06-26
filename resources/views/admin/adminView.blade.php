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
                            <?php if($result->imageurl){ ?>
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/users/'.$result->imageurl)}}" alt="User profile picture">
                            <?php }else{?>
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/userprofile.png')}}" alt="User profile picture">
                            <?php }?>
                        <h3 class="text-center">{{$result->name}}</h3>
                        
                        
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
                        <li class="active"><a href="#activity" data-toggle="tab"><b>Admin Information</b></a></li>
                        {{-- <li><a href="#changeinfo" data-toggle="tab">Admin Information</a></li> --}}
                        
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                                
                                <div class="table-responsive">
                                        <table class="table">
                                            <tbody><tr>
                                                <th style="width:50%">Name:</th>
                                                <td>{{$result->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{$result->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>


                                                <?php if($result->status){ ?>
                                                    <span class="label label-success">Active</span>
                                                 <?php }else{ ?>
                                                    <span class="label label-danger">Pending</span>
                                                 <?php }?>
                                                 {{-- {{($result->status)?'Active':'Pending'}} --}}
                                                </td>

                                            </tr>
                                            
                                            
                                        </tbody></table>
                                    </div>
                            
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