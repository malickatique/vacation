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
         <small>Pages</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">List Email Templates</li>
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
            <h3 class="box-title text-uppercase">List Email Templates</h3>
         </div>
         <!-- /.box-header -->

         


         <div class="box-body">

            <div class="row">
               <div class="col-md-6">
                  <a href="{{route('emailtemplate.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a>
               </div>
            </div>
            <br>

            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
               <thead>
                  <tr>
                     <th width="20">#</th>
                     <th>Name</th>
                     <th>Content</th>
                     <th width="60" class="text-center">Action</th>
                     
                  </tr>
               </thead>
               <tbody>

                @isset($EmailTemplates)
                    @foreach ($EmailTemplates as $EmailTemplate)
                        <tr>
                        <td>{{$EmailTemplate->id}}</td>
                     <td>{{$EmailTemplate->name}}</td>
                     <td>{{$EmailTemplate->content}}</td>
                     <td width="60" class="text-center">
                        <a href="#" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        <a href="{{route('emailtemplate.edit' ,$EmailTemplate->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        <form style="display: -webkit-inline-box;" action="{{action('EmailTemplateController@destroy', $EmailTemplate->id)}}" method="post">
                              {{csrf_field()}}
                              <input name="_method" type="hidden" value="DELETE">
                              <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Are you sure you want to delete this email template?');"><i class="fa fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
                    @endforeach
                @endisset

                  
               </tbody>
               <tfoot>
                  <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Content</th>
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