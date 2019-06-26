@extends('layouts.admin')

@section('admin-content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Dashboard
        <small>Pages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pages</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Box</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('page.update.box',$box->id) }}">
            <div class="box-body">

            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label>Box Heading</label>
            <input type="text" class="form-control" name="box_heading" value="{{$box->box_heading}}" >
            </div>
            <div class="form-group">
                <label >Box Paragraph</label>
                <input type="text" class="form-control" name="box_paragraph"  value="{{$box->box_paragraph}}" >
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