@extends('layouts.admin')
@section('admin-content')

<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.outgoing_msg_img {
  display: inline-block;
  width: 10%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #d9d9d9 none repeat scroll 0 0;
  border-radius: 3px;
  color: #000000;
  font-size: 14px;
  margin: 0;
  padding: 10px 10px 10px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 10px 10px 10px 12px;
  width:100%;
}
.outgoing_msg{
     overflow:hidden; margin:26px 0 26px;
}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
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

  <div class="container-fluid">

    <h3 class="text-left col-md-6">Owner</h3>
    <h3 class="text-right col-md-6">Renter</h3>

<div class="messaging">
    <div class="inbox_msg">
        <div class="mesgs">
          <div class="msg_history">


        @foreach ($messages as $msg)
            @if ($msg['user_id'] === $data['user1_id'])
            <div class="incoming_msg" style="padding: 15px 0px;">
                <div class="incoming_msg_img"> <img src="{{asset('/images/user/owner/'.$data['user1_image'])}}" alt="Avatar"> 
                    <span></span>
                </div>

                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p> {{ $msg['message'] }} </p>
                        <span class="time_date"> {{ $msg['created_at'] }} </span>
                    </div>
                </div>
            </div>

            @else
            <div class="outgoing_msg">
                <div class="sent_msg">
                    <p> {{ $msg['message'] }} </p>
                    <!-- <img src="/images/user/renter/{{$data['user2_image']}}" alt="Avatar" class="outgoing_msg_img"> -->
                    <span class="time_date"> {{ $msg['created_at'] }} </span> 
                </div>
                <!-- <div class="outgoing_msg_img"> <img src="/images/user/renter/{{$data['user2_image']}}" alt="Avatar"> 
                    <span></span>
                </div> -->
            </div>
            @endif
        @endforeach

        </div>

          <div class="type_msg">
            <!-- <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div> -->
          </div>
        
        </div>
      </div>
      
      
    </div>
</div>

    <!-- users -->
    <!-- <div class="col-md-4 col-md-offset-2 my-5">
        <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach ($messages as $msg)
                        <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $msg['message'] }} </li>
                        <br>
                    @endforeach
                </ul>
        </div>
    </div> -->


        
  </section>


</div>
@endsection