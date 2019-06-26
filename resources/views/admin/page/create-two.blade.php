@extends('layouts.admin')


@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Pages</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Pages</a></li>
         <li class="active">Create Form two</li>
      </ol>
   </section>
   <section class="content container-fluid">
      <!-- /.box-header -->

      @foreach ($features as $feature)
      @if ($feature->feature == 'gallary')
      <div class="box box-primary">
          <h3 class="text-center">Page Gallary Section</h3>
          <p class="text-center">Click below and upload multiple images in a single click</p>
          <hr>
                <form method="post" action="{{url('/pagegallary/upload/store')}}" enctype="multipart/form-data" 
                    class="dropzone" id="dropzone">
                    {{ csrf_field() }}
                    <input type="hidden" name="page_id" id="page_id" value="{{$feature->page_id}}">
                
                </form>
        
      </div>
      @endif
      @endforeach




      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Pages | Step 2:</h3>
         </div>
         <!-- /.box-header -->
         <form role="form" method="POST" action="{{ route('page.store-two') }}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <input type="hidden" name="page_id" value="{{$id}}">
            <div class="box-body">

         @foreach ($features as $feature)

                @if ($feature->feature == 'faq')
                <input type="hidden" name="faq" value="enable">

                <hr>
                <h3>FAQ Section</h3>
                <hr>


                <div class="repeater2">
                        <div data-repeater-list="group-ab" >
                            <div data-repeater-item>
                            
                            <label> Question</label>
                            <input type="text" class="form-control" placeholder="Enter question here" required name="question"/>
    
                            <label>Answer</label>
                            <textarea name="answer" placeholder="Enter answer here"  required class="form-control" ></textarea>
                        
                        
                            <input data-repeater-delete type="button" class="btn btn-danger btn-sm" value="Delete"/>
                            </div>
                            
                        </div>
                        <br>
                        <input data-repeater-create type="button" class="btn btn-success btn-sm" value="Add"/>
                    </div>
                

                @endif

                @if ($feature->feature == 'contact-us')
                <input type="hidden" name="contact-us" value="enable">
                <hr>
                    <h3>Contact Section</h3>
                <hr>

                <div class="form-group">
                    <label >Address</label> 
                    <textarea name="address" required class="form-control" name="address" placeholder="Enter address"></textarea>
                </div>

                <div class="form-group">
                    <label >Email</label> 
                    <input type="email" required class="form-control" name="email" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label >Contact Number</label> 
                    <input type="text" required class="form-control" name="contact" placeholder="Enter contact">
                </div>

                <div class="form-group">
                    <label >Google Map Key</label> 
                    <input type="text" required class="form-control" name="map" placeholder="Enter map link/key">
                </div>

                @endif

                @if ($feature->feature == 'grid-box')
                <input type="hidden" name="grid-box" value="enable">
                <hr>
                    <h3>Grid Box Section</h3>
                <hr>

                <div class="form-group">
                    <label >Section Heading</label> 
                    <input type="text" required class="form-control" name="section_heading" placeholder="Enter box top section heading here">
                </div>

                <div class="form-group">
                    <label >Section Heading Paragraph (meta data)</label> 
                    <input type="text" required class="form-control" name="section_heading_paragraph" placeholder="Enter box top section heading here">
                </div>

                <hr>
                <h5  class="text-center">Multiple Box Section</h5>
                <hr>


                <div class="repeater">
                    <div data-repeater-list="group-a" >
                        <div data-repeater-item>
                        
                        <label> Box Heading</label>
                        <input type="text" class="form-control" placeholder="Enter box heading" required name="box_heading"/>

                        <label> Box Paragraph</label>
                        <textarea name="box_paragraph" placeholder="Enter box paragraph"  required class="form-control" ></textarea>
                    
                    
                        <input data-repeater-delete type="button" class="btn btn-danger btn-sm" value="Delete"/>
                        </div>
                        
                    </div>
                    <br>
                    <input data-repeater-create type="button" class="btn btn-success btn-sm" value="Add"/>
                </div>

                @endif



         @endforeach


         
            </div>

         <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
             </div>
           
         </form>


      </div>

      

   </section>
</div>
@endsection

@section('admin-js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script src="{{asset('plugins/repeater/jquery.repeater.min.js')}}"></script>
<script>
        $(document).ready(function () {
            'use strict';
    
            $('.repeater').repeater({
                
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

            $('.repeater2').repeater({
                
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
    
            window.outerRepeater = $('.outer-repeater').repeater({
                isFirstItemUndeletable: true,
                show: function () {
                    console.log('outer show');
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    console.log('outer delete');
                    $(this).slideUp(deleteElement);
                },
                repeaters: [{
                    isFirstItemUndeletable: true,
                    selector: '.inner-repeater',
                    show: function () {
                        // console.log('inner show');
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        // console.log('inner delete');
                        $(this).slideUp(deleteElement);
                    }
                }]
            });
        });
        </script>
    
@endsection
