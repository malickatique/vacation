@extends('layouts.admin')
@section('admin-content')

<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Property
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Property</a></li>
         <li class="active">Add</li>
      </ol>
   </section>
   <section class="content container-fluid">
      <!-- /.box-header -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Add Property</h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
         <form method="POST" class="repeater"  action="{{ route('admin.storeproperty') }}" aria-label="{{ __('Upload') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="col-md-12">
               <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                               <label>Property For:</label>
                               <p>Select owner account for this property.</p>
                               <select name="user_id" class="form-control" id="user_id">
                                   <option selected disabled hidden >Select Owner account</option>
                                   @foreach ($owners as $owner)
                                     <option value="{{$owner->id}}">{{$owner->name}} | {{$owner->email}}</option>
                                   @endforeach
                               </select>
                            </div>
                         </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Property Title</label>
                        <input class="form-control" required type="text" id="title" name="name">
                     </div>
                  </div>
                  <!-- <div class="col-md-6">
                     <div class="form-group">
                        <label>Per Night Rent*</label>
                        <input class="form-control" required type="number" placeholder="$" id="per_night_rent" name="per_night_rent">
                     </div>
                  </div> -->
               </div>
            </div>
            <div class="form-group col-md-12">
               <label>Property Description</label>
               <textarea class="form-control" required id="description" name="description" style="height:150px;"></textarea>
            </div>
            <!-- /row -->
            <div class="col-md-12">
               <div class="row">
                  

                  <!-- <div class="col-md-6">
                     <label>Ocassion Availability:</label>
                     <input type="text" placeholder="Occasion Availability"
                     name="daterange" id="daterange" onclick="setIndex(index)">
                 </div> -->

                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Property Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Property Address</label>
                        <textarea class="form-control" required id="address" name="address" style="height:100px;"></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /row -->
            <hr>
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Type</label>
                        <div class="custom-select-form">
                           <select class="form-control" name="type" id="type">
                              <option value="" selected="">Select your type</option>
                              <option value="House">House</option>
                              <option value="Apartment">Apartment</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-6">
                     <div class="form-group">
                        <label>Status</label>
                        <div class="custom-select-form">
                           <select class="form-control" name="status" id="status">
                              <option value="" selected="">Select your Status</option>
                              <option value="Rent">Rent</option>
                              <option value="Sale">Sale</option>
                           </select>
                        </div>
                     </div>
                  </div> -->
               </div>
            </div>
            <div class="col-md-12">
               <div class="row">
                  <!-- <div class="col-md-4">
                     <div class="form-group">
                        <label>Location</label>
                        <input class="form-control" type="text" id="location" name="location">
                     </div>
                  </div> -->
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Bedrooms</label>
                        <input class="form-control" type="number" id="bedroom" name="bedrooms">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Bathrooms</label>
                        <input class="form-control" type="number" id="bathroom" name="bathrooms">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Floors</label>
                        <input class="form-control" type="number" id="floor" name="floors">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Garages</label>
                        <input class="form-control" type="number" id="garage" name="garages">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Area</label>
                        <input class="form-control" type="number" id="area" name="area">
                     </div>
                  </div>
                  <!-- <div class="col-md-4">
                     <div class="form-group">
                        <label>Size</label>
                        <input class="form-control" type="number" id="size" placeholder="sqft" name="size">
                     </div>
                  </div> -->
               </div>
            </div>
            <hr>
            <h3 class="col-md-12">Property Features</h3>
            <hr>
            <div class="col-md-12">
               <div class="row">
                  @isset($features)
                  @foreach ($features as $feature)
                  <div class="col-md-3">
                     <div class="checkboxes float-left">
                        <input type="checkbox" name="features[]" value="{{$feature->id}}" >
                        <span class="container_check">{{$feature->name}}
                        <span class="checkmark"></span>
                        </span>
                     </div>
                  </div>
                  @endforeach
                  @endisset
               </div>
            </div>
            <hr>
            <h3 class="col-md-12">Property Occasions</h3>
            <hr>
            <div class="container">
               <div data-repeater-list="multipleOccasions">
                  <div data-repeater-item="">
                     <div class="row">

                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Occasion</label>
                              <input class="form-control" placeholder="Occasion name" type="text" id="occasion_name" name="multipleOccasions[0][occasion_name]">
                           </div>
                        </div>

                                                
                        <!-- <div class="col-md-3">
                              <label>Availability</label>
                           <div class="form-group" id="input_date">
                              <input class="form-control" type="text" id="daterange" name="daterange" placeholder="Date range">
                              <i class="icon_calendar"></i>
                           </div>
                        </div> -->

                        
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Availability From</label>
                              <input class="form-control" required="" type="date" id="occasion_availability_from" name="multipleOccasions[0][occasion_availability_from]">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Availability To</label>
                              <input class="form-control" required="" type="date" id="occasion_availability_to" name="multipleOccasions[0][occasion_availability_to]">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Per Night Rent*</label>
                              <input class="form-control" required="" type="number" placeholder="$" id="per_night_rent" name="multipleOccasions[0][occasion_per_night_rent]">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group" style="margin-top: 20px;">
                              <input data-repeater-delete="" class="btn btn-danger " type="button" value="Delete">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <input data-repeater-create type="button" class="btn btn-success"  value="Add"/>
            </div>
            <hr>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Add Property</button>
            </div>
         </form>
      </div>
   </section>
</div>
@endsection
@section('admin-js')
<script src="{{asset('plugins/repeater/jquery.repeater.min.js')}}"></script>


<script>


   $(document).ready(function () {
      'use strict';
   
      $('.repeater').repeater({
         defaultValues: {
               'textarea-input': 'foo',
               'text-input': 'bar',
               'select-input': 'B',
               'checkbox-input': ['A', 'B'],
               'radio-input': 'B'
         },
         show: function () {
               $(this).slideDown();
         },
         hide: function (deleteElement) {
               if(confirm('Are you sure you want to delete this element?')) {
                  $(this).slideUp(deleteElement);
               }
         },
         ready: function (setIndexes) {
   
         }
      });

      //Date range picker
    // var index = this.currentIndex;
   
      $('input[id="daterange"]').daterangepicker({
      opens: 'center'
      }, function(start, end, label) {
         // console.log("index: "+currentIndex);
         multipleOccasions[currentIndex].availability = start.format('YYYY-MM-DD')+' to '+end.format('YYYY-MM-DD');
         // console.log("new date: " + start.format('YYYY-MM-DD')+'to'+end.format('YYYY-MM-DD')+ index);
      });

   
      
   });
</script>
      <script src="/js/jquery.min.js"></script>
      <script src="/js/moment.min.js"></script>
      <script src="/js/daterangepicker.js"></script>
@endsection