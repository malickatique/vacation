@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Property
         <small>Edit</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Property</a></li>
         <li class="active">Edit</li>
      </ol>
   </section>
   <section class="content container-fluid">
      <!-- /.box-header -->
      <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Property</h3>
            </div>
         <!-- /.box-header -->
         <!-- form start -->
            <div class="box-body">
                <form role="form" method="POST" action="{{ route('admin.update.property', $property->id) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <label >Property Feature Image</label><br>
                    @if (empty($property->thumbnail))
                    <img src="{{asset('images/property/')}}/noImagefound.jpg" class="img-responsive" width="200px" height="200px" alt="" >
                    @else
                    <img src="{{asset('images/property/')}}/{{$property->thumbnail}}" width="200px" height="200px" class="img-responsive" alt="" >
                    @endif
                    <br>
                    <input type="file" name="thumbnail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Property Name</label>
                    <input type="text" class="form-control" name="name" value="{{$property->name}}"  id="name">
                </div>
                <div class="form-group">
                    <label for="pageName">Description</label>
                    <textarea name="description" rows="5" id="description"  class="form-control">{{$property->description}}</textarea>
                </div>

                <!-- <div class="form-group">
                    <label for="availability_from">Availability From</label>
                    <input type="date" class="form-control" name="availability_from" value="{{$property->availability_from}}" id="availability_from" placeholder="Enter Availability">
                </div>
                <div class="form-group">
                    <label for="availability_to">Availability To</label>
                    <input type="date" class="form-control" name="availability_to" value="{{$property->availability_to}}" id="availability_from" placeholder="Enter Availability">
                </div>
                <div class="form-group">
                    <label for="per_night_rent">Rent per night ($)</label>
                    <input type="text" class="form-control" name="per_night_rent" value="{{$property->per_night_rent}}" id="per_night_rent" placeholder="Enter Per night rent">
                </div> -->

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" rows="4" id="description"  class="form-control">{{$property->address}}</textarea>
                </div>
            </div>

            <hr>
            <div class="container">
                    <h3>Property Meta Data</h3>
            </div>
            <hr>

            <div class="box-body">
                    
                <div class="form-group">
                    <label for="type">Property Type</label>
                    <input type="text" class="form-control" name="type" value="{{$metadata->type}}"  id="name">
                </div>

                <!-- <div class="form-group">
                    <label for="status">Property status</label>
                    <input type="text" class="form-control" name="status" value="{{$metadata->status}}"  id="status">
                </div> -->

                <!-- <div class="form-group">
                    <label for="location">Property location</label>
                    <input type="text" class="form-control" name="location" value="{{$metadata->location}}"  id="location">
                </div> -->

                <div class="form-group">
                    <label for="bedrooms">Property bedrooms</label>
                    <input type="number" class="form-control" name="bedrooms" value="{{$metadata->bedrooms}}"  id="bedrooms">
                </div>

                <div class="form-group">
                    <label for="bathrooms">Property bathrooms</label>
                    <input type="number" class="form-control" name="bathrooms" value="{{$metadata->bathrooms}}"  id="bathrooms">
                </div>

                <div class="form-group">
                    <label for="floors">Property floors</label>
                    <input type="number" class="form-control" name="floors" value="{{$metadata->floors}}"  id="floors">
                </div>

                <div class="form-group">
                    <label for="garages">Property garages</label>
                    <input type="number" class="form-control" name="garages" value="{{$metadata->garages}}"  id="garages">
                </div>

                <div class="form-group">
                    <label for="area">Property area</label>
                    <input type="number" class="form-control" name="area" value="{{$metadata->area}}"  id="area">
                </div>

                <!-- <div class="form-group">
                    <label for="size">Property size</label>
                    <input type="number" class="form-control" name="size" value="{{$metadata->size}}"  id="size">
                </div> -->
                    
                    
                </div>
         <!-- /.box-body -->
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>



      </div>
   </section>
</div>
@endsection