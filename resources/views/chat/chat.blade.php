@extends('layouts.admin')
@section('admin-content')

<style>
.xs-img{
    width: 30px;
    height: 30px;
}
.chat-box{
}
.chat-single-view{
  margin: 10px 0px;
    /* float: left; */
}
</style>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Messaging
      <small>threads</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Messaging</li>
    </ol>
  </section>

  <section class="content container-fluid">

              <!-- {{ $data[0][0]['total_msg'] }} -->

    <!-- users -->
    <div class="col-md-6 col-md-offset-2 my-5">
        <div class="card">
                <ul class="list-group list-group-flush">
                @foreach ($data as $thread)

                    <li class="list-group-item d-flex justify-content-between align-items-center row chat-box d-flex"> 

                        <div class="chat-single-view">
                            <!-- <img src="images/user.png" alt="user" class="image-fluid xs-img"> -->
                            <img src="{{asset('/images/user/owner/'.$thread[0]['user1_image'] ) }}" alt="user" class="img-fluid xs-img"> 
                            {{ $thread[0]['user1_name'] }} (Owner)
                        </div>

                        <div class="chat-single-view">
                            <img src="{{asset('/images/user/renter/'.$thread[0]['user2_image'] ) }}" alt="user" class="img-fluid xs-img"> 
                            {{ $thread[0]['user2_name'] }} (Renter)
                        </div>
                        <span> Total Messages: {{ $thread[0]['total_msg'] }} </span>
                        <div class="chat-single-view">
                            <form action="{{ route('thread.view') }}" method="POST">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="conversation_id" value="{{ $thread[0]['conversation_id'] }}">
                                <input type="submit" class="btn btn-success" value="View Chat">
                            </form>
                        </div>

                    </li>
                    <br>
                @endforeach
                </ul>
        </div>
    </div>


        
  </section>


</div>
@endsection