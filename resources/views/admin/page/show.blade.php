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
         <li class="active">Pages</li>
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
            <h3 class="box-title text-uppercase">Pages</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-6">
                  <a href="{{route('page.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a>
               </div>
            </div>
            <br>
            <table id="pagesTable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
               <thead>
                  <tr>
                     <th width="20">#</th>
                     <th>Name</th>
                     <th>Title</th>
                     <th>Slug</th>
                     <th>Status</th>
                     <th>Event</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @isset($pages)
                  @foreach ($pages as $page)
                  <tr>
                     <td>{{$page->id}}</td>
                     <td>{{$page->name}}</td>
                     <td>{{$page->title}}</td>
                     <td>{{$page->slug}}</td>
 
                     <td class="text-center" >
                           <?php if($page->status == 1){ ?>
                           <span class="label label-success">Active</span>
                           <?php }else{ ?>
                           <span class="label label-danger">Pending</span>
                           <?php }?>
                        </td>


                     <td class="text-center">
                           @if ($page->status == 1)
                           <form method="POST" action="{{ route('page.pagestatus') }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="page_id" value="{{$page->id}}">
                              <input type="hidden" name="status" value="{{$page->status}}">
                              <button type="submit" data-toggle="tooltip" title="Deactivate page" class="btn btn-danger btn-xs">X</button>
                           </form>
                           @elseif($page->status == 0)
                           <form method="POST" action="{{ route('page.pagestatus') }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="page_id" value="{{$page->id}}">
                              <input type="hidden" name="status" value="{{$page->status}}">
                              <button type="submit" data-toggle="tooltip" title="Activate page" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button>
                           </form>
                           @endif
                        </td>


                     <td class="text-center">
                        <a href="{{route('page.show' ,$page->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                        {{-- <a href="{{route('page.copy' ,$page->id)}}" class="btn btn-success btn-xs"><i class="fa fa-clone"></i></a> --}}
                        <a href="{{route('page.edit' ,$page->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        {{-- <a href="/admin/page/{{$page->id}}/" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> --}}
                        <form style="display: -webkit-inline-box;" action="{{action('pagesController@destroy', $page->id)}}" method="post">
                           {{csrf_field()}}
                           <input name="_method" type="hidden" value="DELETE">
                           <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Are you sure you want to delete this page?');"><i class="fa fa-trash"></i></button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
                  @endisset
               </tbody>
               <tfoot>
                  <tr>
                     <th width="20">#</th>
                     <th>Name</th>
                     <th>Title</th>
                     <th>Slug</th>
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