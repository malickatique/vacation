@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Edit Setting</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Edit Setting</li>
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
            <h3 class="box-title text-uppercase">Edit Setting</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">

            <form role="form" method="POST" aria-label="{{ __('Upload') }}" enctype="multipart/form-data" action="{{ route('setting.update',$setting->id) }}">
               <div class="box-body">

                  <input name="_method" type="hidden" value="PUT">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                  @if ($setting->name === 'site_logo')
                  @if (empty($setting->value))
                        No logo set yet
                    @else
                    
                    <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">

                    @endif

                  <div class="form-group">

                        <label class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</label>
                        <input type="file" class="form-control" placeholder="Enter Value here" name="site_logo" value="{{$setting->value}}" >
                        <p style="color:red" >Default logo size is 150x36</p>

                    </div>


                  @elseif($setting->name === 'footer_logo') 
                  @if (empty($setting->value))
                        No logo set yet
                    @else
                    
                    <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">

                    @endif

                  <div class="form-group">

                        <label class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</label>
                        <input type="file" class="form-control" placeholder="Enter Value here" name="footer_logo" value="{{$setting->value}}" >
                        <p style="color:red" >Default logo size is 150x36</p>

                    </div>

                    @elseif($setting->name === 'site_sticky_logo') 
                    @if (empty($setting->value))
                          No logo set yet
                      @else
                      
                      <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">
  
                      @endif
  
                    <div class="form-group">
  
                          <label class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</label>
                          <input type="file" class="form-control" placeholder="Enter Value here" name="sticky_logo" value="{{$setting->value}}" >
                          <p style="color:red" >Default logo size is 150x36</p>
  
                      </div>

                  
                  @elseif($setting->name === 'footer_desc')
                  {{-- {{str_limit($setting->value, $limit = 50, $end = '...')}} --}}
                  <div class="form-group">
                     <label class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</label>
                     <textarea name="value" class="form-control" cols="30" rows="5">{{$setting->value}}</textarea> 
                  </div>
                  @else
                  <div class="form-group">
                     <label class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</label>
                     <input type="text" class="form-control" placeholder="Enter Value here" name="value" value="{{$setting->value}}" >
                  </div>
                  @endif

               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
               </div>
            </form>

         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>
@endsection
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 1500);
</script>