@extends('layouts.admin')
@section('admin-content')

<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Add Subscription Feature</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Add Subscription Feature</li>
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
                <h3 class="box-title">Add Subscription Feature</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form role="form" method="POST" action="{{ route('subscription-feature-insert')}}">
                <div class="box-body">
    
                
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    
                <div class="form-group">
                    <label>Feature For</label>
                    <select name="subscription_id" id="subscription_id" class="form-control">
                        <option selected disabled hidden>Select Subscription</option>
                        @isset($subscriptions)
                            @foreach ($subscriptions as $subscription)
                                <option value="{{$subscription->id}}">{{$subscription->name}}</option>
                            @endforeach
                        @endisset
                        
                    </select>
                </div>
                <div class="form-group">
                    <label >Feature Name</label>
                    <input type="text" class="form-control" placeholder="Enter Feature Name" name="feature_name"   >
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