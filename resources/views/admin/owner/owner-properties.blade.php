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
                    <h3 class="box-title text-uppercase">Owner's Property List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  {{-- <div class="col-md-6">
                     <a href="{{route('owner.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a>
                  </div> --}}
               </div>
               <br>
               <table id="ownersTable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                     <tr>
                        <th width="20">#</th>
                        <th width="30">Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="50">Status</th>
                        <th width="20">Event</th>
                        <th width="160" class="text-center">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @isset($owner_properties)
                     @foreach ($owner_properties as $owner_property)
                     <tr>
                        <td class="text-center">{{$owner_property->id}}</td>
                        <td class="text-center">

                              @if (empty($owner_property->thumbnail))
                              <img src="{{asset('images/users/')}}/noImagefound.jpg" class="img-thumbnail	" width="40px" height="40px" alt="" >
                              @else
                              <img src="{{asset('/images/property')}}/{{$owner_property->thumbnail}}" width="40px" height="40px" class="img-thumbnail	" alt="" >
                              @endif

                        </td>
                        <td class="text-capitalize">{{$owner_property->name}}</td>
                        <td>{{str_limit($owner_property->description, $limit = 150, $end = '...')}}</td>
                        <td class="text-center" >
                            @if ($owner_property->status == 1)
                                <span class="badge badge-success">Published</span>
                            @elseif($owner_property->status == 2)
                                <span class="badge badge-primary">Not Published</span>
                            @endif
                        </td>
                        <td class="text-center">


                           @if ($owner_property->status == 1)
                        <form method="POST" action="{{ route('property.propertystatus') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="property_id" value="{{$owner_property->id}}">
                           <input type="hidden" name="status" value="{{$owner_property->status}}">
                           <button type="submit" data-toggle="tooltip" title="Unpublished this Post" class="btn btn-danger btn-xs">X</button>
                        </form>
                        @elseif($owner_property->status == 2)
                        <form method="POST" action="{{ route('property.propertystatus') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="property_id" value="{{$owner_property->id}}">
                           <input type="hidden" name="status" value="{{$owner_property->status}}">
                           <button type="submit" data-toggle="tooltip" title="Published this Post" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button>
                        </form>
                        @endif



                        </td>
                        <td width="60" class="text-center">
                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                        {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-x">X</i></a> --}}
                        <a href="{{route('owner.owner-property-detail' , $owner_property->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                        </td>
                     </tr>
                     @endforeach
                     @endisset
                  </tbody>
               </table>
            </div>
            <!-- /.box-body -->
   </section>
</div>

@endsection
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script>
   $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();   
   });
</script>


