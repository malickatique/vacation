@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Pages</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">List renters</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
         {{Session::forget('status')}}
      </div>
      @endif
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">List renters</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-6">
                  <a href="{{route('renter.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a>
               </div>
            </div>
            <br>
            <table id="rentersTable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
               <thead>
                  <tr>
                     <th width="20">#</th>
                     <th width="30">Image</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th width="50">Status</th>
                     <th width="20">Event</th>
                     <th width="160" class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @isset($renters)
                  @foreach ($renters as $renter)
                  <tr>
                     <td class="text-center">{{$renter->id}}</td>
                     <td class="text-center">

                           @if (empty($renter->user_image))
                           <img src="{{asset('images/users/')}}/noImagefound.jpg" class="img-responsive" width="40px" height="40px" alt="" >
                           @else
                           <img src="{{asset('images/user/renter/')}}/{{$renter->user_image}}" width="40px" height="40px" class="img-responsive" alt="" >
                           @endif

                     </td>
                     <td class="text-capitalize">{{$renter->name}}</td>
                     <td>{{$renter->email}}</td>
                     <td class="text-center" >
                        <?php if($renter->status == 1){ ?>
                        <span class="label label-success">Active</span>
                        <?php }else{ ?>
                        <span class="label label-danger">Pending</span>
                        <?php }?>
                     </td>
                     <td class="text-center">
                        @if ($renter->status == 1)
                        <form method="POST" action="{{ route('renter.renterstatus') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="user_id" value="{{$renter->id}}">
                           <input type="hidden" name="status" value="{{$renter->status}}">
                           <button type="submit" data-toggle="tooltip" title="Deactivate user" class="btn btn-danger btn-xs">X</button>
                        </form>
                        @elseif($renter->status == 0)
                        <form method="POST" action="{{ route('renter.renterstatus') }}">
                           {{ csrf_field() }}
                           <input type="hidden" name="user_id" value="{{$renter->id}}">
                           <input type="hidden" name="status" value="{{$renter->status}}">
                           <button type="submit" data-toggle="tooltip" title="Activate user" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button>
                        </form>
                        @endif
                     </td> 
                     <td width="60" class="text-center">
                            <a href="{{route('renter.view' ,$renter->id)}}" data-toggle="tooltip" title="View." class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                           <a href="{{route('renter.edit' ,$renter->id)}}" data-toggle="tooltip" title="Edit user info" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <form style="display: -webkit-inline-box;" action="{{action('AdminController@destroyRenter', $renter->id)}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete user" type="submit" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash"></i></button>
                            </form>
                        {{--<a href="{{route('renter.show' ,$renter->id)}}" data-toggle="tooltip" title="View user info" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                         --}}
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
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 1500);
</script>
<script>
   $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();   
   });
</script>