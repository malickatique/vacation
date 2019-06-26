@extends('layouts.admin')
@section('js')
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready( function () {
      $('#example1').DataTable();
   } );
</script>
@append
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
        Dashboard
         <small>User Types</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> userTypes</a></li>
         <li class="active">UserTypes</li>
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
            <h3 class="box-title text-uppercase">User TYpes</h3>
         </div>
         <!-- /.box-header -->

         


         <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                        {{-- <a href="{{route('page.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a> --}}
                </div>
            </div>
            <br>

            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
               <thead>
                  <tr>
                     <th width="20">#</th>
                     <th>User Type</th>
                     <th>Description</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>

                @isset($userTypes)
                    @foreach ($userTypes as $userType)
                        <tr>
                        <td>{{$userType->id}}</td>
                     <td>{{$userType->user_type}}</td>
                     <td>{{$userType->description}}</td>
                     
                     <td class="text-center">
                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                    @endforeach
                @endisset

                  
               </tbody>
               <tfoot>
                  <tr>
                        <th width="20">#</th>
                     <th>User Type</th>
                     <th>Description</th>
                     <th class="text-center">Action</th>
                  </tr>
               </tfoot>
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