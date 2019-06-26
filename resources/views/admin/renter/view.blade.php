@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Renters</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">View Renter</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">View Renter</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label >Profile</label><br>
               @if (empty($account->user_image))
               <img src="{{asset('images/users/')}}/noImagefound.jpg" class="img-responsive" width="200px" height="200px" alt="" >
               @else
               <img src="{{asset('images/user/renter/')}}/{{$account->user_image}}" width="200px" height="200px" class="img-responsive" alt="" >
               @endif
            </div>
            <div class="form-group">
               <label>Email</label>
               <input type="text" class="form-control " value="{{$account->email}}" disabled>
            </div>
            <div class="form-group">
               <label>Account Status</label>
               <input type="text" class="form-control text-capitalize" value="@if($account->status == 1)Verfied & active @else Not Verfied & inactive @endif" disabled>
            </div>
         </div>
      </div>
      @isset($renter)
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Renter's Detail</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label>Name</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->name}}" disabled>
            </div>
            <div class="form-group">
               <label >Surname</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->surname}}" disabled>
            </div>
            <div class="form-group">
               <label >city</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->city}}" disabled>
            </div>
            <div class="form-group">
               <label >State</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->state}}" disabled>
            </div>
            <div class="form-group">
               <label >Zip</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->zip}}" disabled>
            </div>
            <div class="form-group">
               <label >Address</label>
               <textarea class="form-control text-capitalize" rows="5" disabled>{{$renter->address}}</textarea>
            </div>
            <div class="form-group">
               <label >Number</label>
               <input type="text" class="form-control text-capitalize" value="{{$renter->number}}" disabled>
            </div>
            <div class="form-group">
               <label >Driving license</label><br>
               <img src="{{asset('images/license/')}}/{{$renter->driving_license}}" class="img-responsive" alt="" >
            </div>
         </div>
      </div>
      @endisset
      
      <!-- /.box-body -->
   </section>
</div>
@endsection