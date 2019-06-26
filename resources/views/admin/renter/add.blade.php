@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Renter</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Add Renter</li>
      </ol>
   </section>
   <section class="content container-fluid">
        <div class="message">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif
      <div class="box">
            <form role="form" method="POST" action="{{ route('renter.admin.add') }}" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

         <div class="box-header">
            <h3 class="box-title text-uppercase">Add Renter</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
                
            
            <div class="form-group">
               <label>Email</label>
               <input type="text" name="email" class="form-control ">
            </div>

            <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control ">
                 </div>

                 <div class="form-group">
                        <label >Profile</label><br>
                        <input type="file" name="profile" class="form-control">
                     </div>
            
         </div>
      </div>
     
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Renter's Detail</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label>Name</label>
               <input type="text" name="name" class="form-control text-capitalize">
            </div>
            <div class="form-group">
               <label >Surname</label>
               <input type="text" name="surname" class="form-control text-capitalize" >
            </div>
            <div class="form-group">
                    <label >Country</label>
                    <input type="text" name="country" class="form-control text-capitalize" >
                 </div>
            <div class="form-group">
               <label >city</label>
               <input type="text" name="city" class="form-control text-capitalize" >
            </div>
            <div class="form-group">
               <label >State</label>
               <input type="text" name="state" class="form-control text-capitalize" >
            </div>
            <div class="form-group">
               <label >Zip</label>
               <input type="text" name="zip" class="form-control text-capitalize" >
            </div>
            <div class="form-group">
               <label >Address</label>
               <textarea name="address" class="form-control text-capitalize" rows="5"></textarea>
            </div>
            <div class="form-group">
               <label >Number</label>
               <input type="text" name="number" class="form-control text-capitalize" >
            </div>
            <div class="form-group">
               <label >Driving license</label><br>
               <input type="file" name="driving_license" class="form-control">
            </div>
         </div>
      </div>
      
      
      <div class="question-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
      <!-- /.box-body -->
    </form>
   </section>
   
</div>
@endsection