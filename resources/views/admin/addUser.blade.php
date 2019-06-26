@extends('layouts.admin')
@section('js')

@append
@section('admin-content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Admin
        <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
        <form role="form" method="POST" action="{{ route('admin.store') }}">
            <div class="box-body">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="pageName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Pending</option>
                        </select>
                </div>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
    </div>
    </section>
</div>
@endsection