@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Owners</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Edit Renter</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif
      <div class="box">
            <form role="form" method="POST" action="{{ route('renter.update',$account->id) }}" enctype="multipart/form-data">

                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

         <div class="box-header">
            <h3 class="box-title text-uppercase">Edit Renter</h3>
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

               <input type="file" name="profile" class="form-control">
            </div>
            <div class="form-group">
               <label>Email</label>
               <input type="text" class="form-control " disabled value="{{$account->email}}">
            </div>
            <div class="form-group">
               <label>Account Status</label>
               <input type="text" class="form-control text-capitalize" disabled value="@if($account->status == 1)Verfied & active @else Not Verfied & inactive @endif">
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
               <input type="text" name="name" class="form-control text-capitalize" value="{{$renter->name}}">
            </div>
            <div class="form-group">
               <label >Surname</label>
               <input type="text" name="surname" class="form-control text-capitalize" value="{{$renter->surname}}">
            </div>
            <div class="form-group">
               <label >city</label>
               <input type="text" name="city" class="form-control text-capitalize" value="{{$renter->city}}">
            </div>
            <div class="form-group">
               <label >State</label>
               <input type="text" name="state" class="form-control text-capitalize" value="{{$renter->state}}">
            </div>
            <div class="form-group">
               <label >Zip</label>
               <input type="text" name="zip" class="form-control text-capitalize" value="{{$renter->zip}}">
            </div>
            <div class="form-group">
               <label >Address</label>
               <textarea name="address" class="form-control text-capitalize" rows="5">{{$renter->address}}</textarea>
            </div>
            <div class="form-group">
               <label >Number</label>
               <input type="text" name="number" class="form-control text-capitalize" value="{{$renter->number}}">
            </div>
            <div class="form-group">
               <label >Driving license</label><br>
               <img src="{{asset('images/license/')}}/{{$renter->driving_license}}" class="img-responsive" alt="" >
               <input type="file" name="driving_license" class="form-control">
            </div>
         </div>
      </div>
      @endisset
      
      <div class="question-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      <!-- /.box-body -->
    </form>
   </section>
   
</div>
@endsection