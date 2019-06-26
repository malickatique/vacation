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
         <li class="active">Owner's Property List</li>
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
            <h3 class="box-title text-uppercase">Property's Detail</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label>Property Feature Image</label><br>
               @if (empty($property->thumbnail))
               <img src="{{asset('images/users/')}}/noImagefound.jpg" class="img-thumbnail	" width="200px" height="200px" alt="" >
               @else
               <img src="{{asset('/images/property')}}/{{$property->thumbnail}}" width="200px" height="200px" class="img-thumbnail	" alt="" >
               @endif
            </div>

            <div class="form-group">
               <label>Property Name</label>
               <input type="text" class="form-control " value="{{$property->name}}" disabled>
            </div>
            <div class="form-group">
               <label>Property Description</label>
               <textarea class="form-control" rows="6" disabled >{{$property->description}}</textarea>
            </div>
            <div class="form-group">
               <label>Availability From</label>
               <input type="text" class="form-control " value="{{$property->availability_from}}" disabled>
            </div>
            <div class="form-group">
               <label>Availability To</label>
               <input type="text" class="form-control " value="{{$property->availability_to}}" disabled>
            </div>
            <div class="form-group">
               <label>Per Night Rent</label>
               <input type="text" class="form-control " value="${{$property->per_night_rent}}" disabled>
            </div>
         </div>
      </div>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Property's Metadata</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="form-group">
               <label>Property Type</label>
               <input type="text" class="form-control " value="{{$property->metadata->type}}" disabled>
            </div>
            <div class="form-group">
               <label>Property Status</label>
               <input type="text" class="form-control " value="{{$property->metadata->status}}" disabled>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Property location</label>
                     <input type="text" class="form-control " value="{{$property->metadata->location}}" disabled>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Bedrooms</label>
                     <input type="text" class="form-control " value="{{$property->metadata->bedrooms}}" disabled>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Bathrooms</label>
                     <input type="text" class="form-control " value="{{$property->metadata->bathrooms}}" disabled>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Floors</label>
                     <input type="text" class="form-control " value="{{$property->metadata->floors}}" disabled>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Garages</label>
                     <input type="text" class="form-control " value="{{$property->metadata->garages}}" disabled>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Area</label>
                     <input type="text" class="form-control " value="{{$property->metadata->area}}" disabled>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Size</label>
                     <input type="text" class="form-control " value="{{$property->metadata->size}}" disabled>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Property's Availability For Specific Occasions</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            @foreach ($occasions as $occasion)
            {{-- <strong>Occasion Name:</strong>  {{$occasion->occasion_name}}| 
            <p><strong>From:</strong> {{$occasion->availability_from}}  <strong>To:</strong> {{$occasion->availability_to}} for  <strong><span style="font-size:22px;">${{$occasion->per_night_rent}}</span></strong>  per night</p>
            --}}
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Occasion Name</label>
                     <input type="text" class="form-control " value="{{$occasion->occasion_name}}" disabled>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label>Availability From</label>
                     <input type="text" class="form-control " value="{{$occasion->availability_from}}" disabled>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label>Availability To</label>
                     <input type="text" class="form-control " value="{{$occasion->availability_to}}" disabled>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <label>Per Night Rent</label>
                     <input type="text" class="form-control " value="${{$occasion->per_night_rent}}" disabled>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>

      <div class="box">
            <div class="box-header">
               <h3 class="box-title text-uppercase">Property's Feature</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <div class="row">
                        <div class="col-lg-12">
                            <ul class="bullets">
                                @foreach ($features as $feature)
                                    <li>{{$feature->feature->name}}</li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
            </div>
         </div>

         <div class="box">
               <div class="box-header">
                  <h3 class="box-title text-uppercase">Property's Gallary</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  @foreach ($gallaries as $gallary)

                  <img src="{{ URL::to('/images/property/gallary/' . $gallary->media) }}" width="200px" height="200px" class="img-thumbnail" >
                        
                  @endforeach
               </div>
            </div>
   </section>
</div>
@endsection