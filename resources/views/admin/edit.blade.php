@extends('layouts.admin')
@section('js')

@append
@section('admin-content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Admin
        <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->    
        <form role="form" method="POST" action="{{ route('admin.update',$result->id) }}">
            <div class="box-body">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="pageName">Name</label>
                <input type="text" class="form-control" name="name" value=@php echo $result->name; @endphp id="pageName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value=@php echo $result->email; @endphp id="email" placeholder="Enter Name">
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{($result->status == 1)?'selected':false}} value="1">Active</option>
                            <option {{($result->status == 0)?'selected':false}} value="0">Pending</option>
                        </select>
                </div>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    </div>
    </section>
</div>
@endsection