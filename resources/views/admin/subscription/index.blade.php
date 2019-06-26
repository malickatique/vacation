@extends('layouts.admin')
@section('admin-content')

<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Subscription</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Subscription</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif

      <div class="row">
            <div class="col-md-6">
            <a href="{{ route('subscription-add-feature') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"> ADD Features to Subscription</i></a>
            </div>
         </div>

         <br>

      @isset($subscriptions)
          @foreach ($subscriptions as $subscription)
      
         
         <!-- /.box-header -->
         
         <div class="box @if ($subscription->status === 1) box-success  @endif">
               <div class="container">
               <div class="row justify-content-md-center">

                     <div class="col-md-11 col-lg-11">
                           <div class="item">
                              <div class="heading">
                              <h3>{{$subscription->name}} | <a href="{{ route('subscription.edit',$subscription->id ) }}"><span class="fa fa-edit"></span></a></h3>
                              <p>Status:
                                    @if ($subscription->status === 1)
                                    <span class="badge">activated now</span>
                                    @elseif($subscription->status === 0)
                                    <span class="badge">not activated now</span>
                                    @endif
                                 </p>
                              </div>
                              <p>{{$subscription->detail}}</p>

                              <h3>Subscription Features:</h3>
                              @if ($subscription->name === 'BASIC')
                                 @foreach ($basic_features as $item)
                           <h4><span class="feature"> - {{$item->feature_name}}</span> <a href="{{ route('subscription-feature-delete', $item->id) }}"><span class="fa fa-trash"></span></a>  </h4> 
                                 @endforeach
                              @endif


                              @if ($subscription->name === 'PRO')
                                 @foreach ($pro_features as $item)
                                 <h4><span class="feature"> - {{$item->feature_name}}</span> <a href="{{ route('subscription-feature-delete', $item->id) }}"><span class="fa fa-trash"></span></a> </h4>
                                 @endforeach
                              @endif
                              
                              <div class="price">
                                 <h4>Price: ${{$subscription->price}}</h4>
                              </div>
                              @if ($subscription->status === 0)

                              <form role="form" method="POST" action="{{ route('subscription.enable-disable',$subscription->id) }}">
                        
                              <input name="_method" type="hidden" value="PUT">
                              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                              <input type="hidden" name="status" value="{{$subscription->status}}">

                              <button class="btn btn-block btn-outline-primary btn-success" type="submit">Activate this subscription</button>
                              
                              </form>
                              @endif
                              
                           </div>
                     </div>
                  

                     
                 </div>
            
               </div>
         </div>
         
         <!-- /.box-body -->
      
      @endforeach
                      
                  @endisset
   </section>
</div>
@endsection
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 3500);
</script>