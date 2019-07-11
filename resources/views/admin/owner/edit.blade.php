@extends('layouts.admin')

@section('admin-content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Owner
        <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Owner</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Owner</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('owner.update',$result->owner['id']) }}">
            <div class="box-body">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="pageName">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$result->owner['name']}}" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="pageName">Surname</label>
                <input type="text" class="form-control" name="surname" value="{{$result->owner['surname']}}" id="surname" placeholder="Enter surname">
            </div>
            <div class="form-group">
                <label for="pageName">City</label>
                <input type="text" class="form-control" name="city" value="{{$result->owner['city']}}"  id="city" placeholder="Enter city">
            </div>
            <div class="form-group">
                <label for="pageName">State</label>
                <input type="text" class="form-control" name="state" value="{{$result->owner['state']}}"  id="state" placeholder="Enter state">
            </div>
            <div class="form-group">
                <label for="pageName">Zip</label>
                <input type="text" class="form-control" name="zip" value="{{$result->owner['zip']}}"  id="zip" placeholder="Enter zip">
            </div>
            <div class="form-group">
                <label for="pageTitle">Address</label>
                <input type="text" class="form-control" name="address" value="{{$result->owner['address']}}"  id="address" placeholder="Enter address">
            </div>
            <div class="form-group">
                <label for="pageTitle">Number</label>
            <input type="text" class="form-control" name="number" value="{{$result->owner['number']}}" id="number" placeholder="Enter address">
            </div>

        </div>
        <!-- /.box-body -->
        

        

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    </div>

    @isset($card_info)
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Owner's Credit Card Info</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label>Card Number</label>
               <input type="text" class="form-control " value="{{$card_info->card_number}}" disabled>
            </div>
            <div class="form-group">
               <label>Exp Month</label>
               <input type="text" class="form-control " value="{{$card_info->exp_month}}" disabled>
            </div>
            <div class="form-group">
               <label>Exp Year</label>
               <input type="text" class="form-control " value="{{$card_info->exp_year}}" disabled>
            </div>
            <div class="form-group">
               <label>Seceret Code</label>
               <input type="text" class="form-control " value="{{$card_info->sec_code}}" disabled>
            </div>
         </div>
      </div>
      @endisset
    </section>
</div>
@endsection