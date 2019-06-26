@extends('layouts.admin')
@section('js')
<script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
@append
@section('admin-content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Owner
        <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Email Template</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit emial templategg</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('emailtemplate.update',$result->id) }}">
            <div class="box-body">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="pageName">Name</label>
                <input type="text" class="form-control" name="name" value=@php echo $result->name; @endphp id="name" placeholder="Enter Name">
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="editor1" name="content" rows="10" cols="80">
                    @php echo $result->content; @endphp
                </textarea>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
    </section>
</div>
@endsection