@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Setting</li>
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
            <h3 class="box-title text-uppercase">Setting</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            
            <table class="table table-bordered " >
                <thead>
                   <tr>
                      <th width="20">#</th>
                      <th >Name</th>
                      <th>Value</th>
                      <th width="60" class="text-center">Action</th>
                      
                   </tr>
                </thead>
                <tbody>
                   @isset($settings)
                       @foreach ($settings as $setting)
                       <tr>
                           <td>{{$setting->id}} </td>
                           <td class="text-capitalize">{!! str_replace('_', ' ', $setting->name) !!}</td>
                           <td>

                              @if ($setting->name === 'site_logo')

                                 @if (empty($setting->value))
                                     No logo set yet
                                 @else
                                 
                                 <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">

                                 @endif
                                   
                                 @elseif($setting->name === 'footer_logo')   
                                    

                                    @if (empty($setting->value))
                                     No logo set yet
                                 @else
                                 
                                 <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">

                                 @endif

                                 @elseif($setting->name === 'site_sticky_logo')   
                                    

                                 @if (empty($setting->value))
                                  No logo set yet
                              @else
                              
                              <img src="{{asset('images/setting/'. $setting->value)}}" alt="" width="150px" height="36px">

                              @endif

                                 @elseif($setting->name === 'footer_desc')
                                 {{$setting->value}}
                                 {{-- {{str_limit($setting->value, $limit = 50, $end = '...')}} --}}
                                       
                                 @else
                                    {{$setting->value}}
                              @endif



                           </td>
                           <td>

                        <a href="{{route('setting.edit' ,$setting->name)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>


                           </td>
                       </tr>
                       @endforeach
                   @endisset
                    
                </tbody>
                
             </table>
            
            
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>
@endsection
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 1500);
</script>