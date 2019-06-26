@extends('layouts.admin')
@section('admin-content')

<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Edit Subscription</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Edit Subscription</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
      @endif

      <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Subscription</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form role="form" method="POST" action="{{ route('subscription.update', $subscription->id) }}">
                <div class="box-body">
    
                
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
                
                <div class="form-group">
                    <label >Subscription Name</label>
                    <input type="text" disabled class="form-control" placeholder="Enter Feature Name" name="name"  value="{{$subscription->name}}" >
                </div>

                <div class="form-group">
                    <label >Subscription Detail</label>
                    <textarea name="detail" id="detail" class="form-control">{{$subscription->detail}}</textarea>
                </div>

                <div class="form-group">
                    <label >Subscription Price</label>
                    <input type="text" class="form-control" placeholder="Enter Feature price" name="price"  value="{{$subscription->price}}" >
                </div>

                <div class="question-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    
            </div>
            <!-- /.question-body -->
    
            
    
        </form>
        </div>
         
         <!-- /.box-body -->
      
      
   </section>
</div>
@endsection
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 1500);
</script>