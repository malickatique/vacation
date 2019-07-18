@extends('layouts.admin')
@section('js')
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example1').DataTable();
    });
</script>
@append
@section('admin-content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Properties</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">List Properties</li>
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
                <h3 class="box-title text-uppercase">List Properties</h3>
            </div>
            <!-- /.box-header -->




            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('admin.addproperty')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"> ADD NEW</i></a>
                    </div>
                </div>
                <br>

                <table id="ownersTable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                       <tr>
                          <th width="20">#</th>
                          <th width="30">Image</th>
                          {{-- <th>Property Owner</th> --}}
                          <th>Property Name</th>
                          {{-- <th>Description</th> --}}
                          <th width="50">Status</th>
                          <th width="20">Event</th>
                          <th width="160" class="text-center">Action</th>
                       </tr>
                    </thead>
                    <tbody>
                       @isset($properties)
                       @foreach ($properties as $property)
                       <tr>
                          <td class="text-center">{{$property->id}}</td>
                          <td class="text-center">

                                @if (empty($property->thumbnail))
                                <img src="{{asset('images/users/')}}/noImagefound.jpg" class="img-thumbnail	" width="40px" height="40px" alt="" >
                                @else
                                <img src="{{asset('/images/property')}}/{{$property->thumbnail}}" width="40px" height="40px" class="img-thumbnail	" alt="" >
                                @endif

                          </td>
                          {{-- {{$property->user->email}} --}}
                        {{-- <td><a href="{{ route('owner.show', $property->user_id) }}"> - </a></td> --}}
                          <td class="text-capitalize">{{$property->name}}</td>
                          {{-- <td>{{str_limit($property->description, $limit = 150, $end = '...')}}</td> --}}
                          <td class="text-center" >
                              @if ($property->status == 1)
                                  <span class="badge badge-success">Published</span>
                              @elseif($property->status == 0)
                                  <span class="badge badge-primary">Not Published</span>
                              @endif
                          </td>
                          <td class="text-center">
  
  
                        @if ($property->status == 1)
                          <form method="POST" action="{{ route('property.propertystatus') }}">
                             {{ csrf_field() }}
                             <input type="hidden" name="property_id" value="{{$property->id}}">
                             <input type="hidden" name="status" value="{{$property->status}}">
                             <input type="hidden" name="redirect" value="true">
                             <button type="submit" data-toggle="tooltip" title="Unpublished this Post" class="btn btn-danger btn-xs">X</button>
                          </form>
                          @elseif($property->status == 0)
                          <form method="POST" action="{{ route('property.propertystatus') }}">
                             {{ csrf_field() }}
                             <input type="hidden" name="property_id" value="{{$property->id}}">
                             <input type="hidden" name="status" value="{{$property->status}}">
                             <input type="hidden" name="redirect" value="true">
                             <button type="submit" data-toggle="tooltip" title="Published this Post" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button>
                          </form>
                        @endif
  
                          </td>
                          <td width="60" class="text-center">
                          {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-x">X</i></a> --}}
                          <a href="{{route('owner.owner-property-detail' , $property->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                          
                          <a href="{{route('admin.edit.property' , $property->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                         
                          {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> --}}

                          <form style="display: -webkit-inline-box;" action="{{route('admin.destroyProperty',[$property->id])}}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this property?');"><i class="fa fa-trash"></i></button>
                          </form>
  
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
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 1500);
</script>