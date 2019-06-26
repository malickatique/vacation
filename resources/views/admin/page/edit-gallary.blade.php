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

    <!-- /.gallary-header -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Image</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('page.update.pagegallary',$gallary->id) }}" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
            <div class="box-body">

            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <img src="{{ URL::to('/images/page-gallary/' . $gallary->image) }}" width="200px" height="200px" class="img-thumbnail" >


            <div class="form-group">
                <label>Upload File</label>
            <input type="file" class="form-control" name="image" >
            </div>
            

        </div>
        <!-- /.gallary-body -->

        <div class="gallary-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
    </div>


    </section>
</div>
@endsection