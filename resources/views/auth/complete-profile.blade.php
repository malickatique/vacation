@extends('layouts.site')

@section('site-content')
<meta name="_token" content="{{csrf_token()}}" />
<section class="hero_in general start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>Complete Your Profile</h1>
            </div>
        </div>
    </section>
<div class="container">

        
        <div class="box_cart">
        <form method="POST" action="{{ route('complete-profile') }}" enctype="multipart/form-data" >

                        {{ csrf_field() }}
                <div class="message">
                <p>Exisitng Account? <a href="{{route('login')}}"  class="login" >Click here to login</a></p>
                </div>

                <div class="message">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>



                <div class="form_title">
                    
                    <h3><strong>1</strong>Your Account Details</h3>
                    <p>
                        {{-- Mussum ipsum cacilds, vidis litro abertis. --}}
                    </p>
                </div>
                <div class="step">
                    <div class="row">
                            <input id="owner_account_id" name="owner_account_id"  value="{{$user->id}}" type="hidden">

                            <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('owner_email') ? ' has-error' : '' }}">
                                        <label for="owner_email" class="col-md-4 control-label">E-Mail Address</label>
            
                                        
                                            <input id="owner_email" disabled value="{{$user->email}}" type="email" class="form-control" name="email" value="{{ old('owner_email') }}" required>
            
                                            @if ($errors->has('owner_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('owner_email') }}</strong>
                                                </span>
                                            @endif
                                        
                                    </div>
                                </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>
        
                                <input id="name" value="{{$user->name}}" type="text" class="form-control" name="name" required autofocus>
        
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    
                                </div>
                            </div>

                            <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                        <label for="surname" class="col-md-4 control-label">Surname</label>
            
                                            <input id="surname" type="text" class="form-control" name="surname" value="{{ old('name') }}" required autofocus>
            
                                            @if ($errors->has('surname'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('surname') }}</strong>
                                                </span>
                                            @endif
                                        
                                    </div>
                                </div>

                            
                   

                    </div>




                </div>
                <hr>
                <!--End step -->

                <div class="form_title">
                    <h3><strong>2</strong>Payment Information</h3>
                    <p>
                        {{-- Mussum ipsum cacilds, vidis litro abertis. --}}
                    </p>
                </div>




                <div class="step">
                    
                <div class="row">

                        <div class="col-md-6 col-sm-12">
                        <div class="form-group{{ $errors->has('card_no') ? ' has-error' : '' }}">
                                <label>Card number</label>
                                
                                    <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus>
                                    @if ($errors->has('card_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('card_no') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>
                        </div>

                    <div class="col-md-6 col-sm-12">
                        <img src="{{ asset('site/img/cards_all.svg') }}" alt="Cards" class="cards-payment">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Expiration date</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <input id="ccExpiryMonth" type="text" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" autofocus>
                                        @if ($errors->has('ccExpiryMonth'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <input id="ccExpiryYear" type="text" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                        @if ($errors->has('ccExpiryYear'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Security code</label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                            <input id="cvvNumber" type="text" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus>
                                            @if ($errors->has('cvvNumber'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cvvNumber') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <input id="amount" type="hidden" class="form-control" name="amount" value="0">
                                <div class="col-8">
                                    <img src="{{ asset('site/img/icon_ccv.gif') }}" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End row -->

                
                </div>
                <hr>
                <!--End step -->

                <div class="form_title">
                    <h3><strong>3</strong>Personal Information</h3>
                    <p>
                        {{-- Mussum ipsum cacilds, vidis litro abertis. --}}

                    </p>
                </div>
                <div class="step">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <div class="custom-select-form">
                                <select class="wide add_bottom_15"  name="country" id="country" style="display: none;">
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <div class="nice-select wide add_bottom_15" tabindex="0">
                                    <span class="current">Select your country</span>
                                    <ul class="list">
                                        <li data-value="" class="option">Select your country</li>
                                        @foreach ($countries as $country)
                                        <option data-value="{{$country->id}}" class="option">{{$country->name}}</option>
                                        @endforeach
                                    </ul>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <div class="custom-select-form">
                                    <select class="wide add_bottom_15" name="state" id="state" style="display: none;">
                                        
                                    </select>
                                    <div class="nice-select wide add_bottom_15" tabindex="0">
                                        <span class="current">Select your state</span>
                                        <ul class="list" id="state_list">
                                            
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="custom-select-form">
                                        <select class="wide add_bottom_15" name="city" id="city" style="display: none;">
                                            
                                        </select>
                                        <div class="nice-select wide add_bottom_15" tabindex="0">
                                            <span class="current">Select your city</span>
                                            <ul class="list" id="city_list">
                                                
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text" id="zip_code" name="zip" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" id="phone_number" name="number" class="form-control">
                                            </div>
                                        </div>
                                 </div>




                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                       
                    </div>

                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Driving Liscence</label>
                                    <input type="file" id="driving_license" name="driving_license" class="form-control">
                                </div>
                            </div>
                           
                        </div>

                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Complete Registration
                                </button>
                            </div>
                        </div>
                </div>

                
                <hr>
                <!--End step -->
                <div id="policy">
                    <h5>Cancellation policy</h5>
                    <p class="nomargin">Lorem ipsum dolor sit amet, vix <a href="#0">cu justo blandit deleniti</a>, discere omittantur consectetuer per eu. Percipit repudiare similique ad sed, vix ad decore nullam ornatus.</p>
                </div>

                </form>
                </div>
                
</div>

<script src="{{ asset('plugins/repeater/jquery-1.11.1.js') }}"></script>
<script>
$(document).ready(function(){
    $('#country').on('change', function(){

        var country = this.value;
        $.ajax({
            
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
            type: 'POST',
            url: '{{ url("ajax/get_state_data") }}',
            data: {country: country},
            success: function (data){

                var to_append = '';
                $.each(data.success,function(i,o){
                    to_append += '<option value="'+o.id+'">'+o.name+'</option>';
                });

                var to_append_list = '';
                $.each(data.success,function(i,o){
                    to_append_list += '<li data-value="'+o.id+'" class="option">'+o.name+'</li>';
                });

                $("#state").empty();
                $("#state_list").empty();
                $('#state').append(to_append);
                $('#state_list').append(to_append_list);

            }, 
            error: function(e) {
                console.log(e);
            }});

    })


    $('#state').on('change', function(){

       var state = this.value;

       $.ajax({
            
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
            type: 'POST',
            url: '{{ url("ajax/get_city_data") }}',
            data: {state: state},
            success: function (data){
                console.log(data)
                var city_to_append = '';
                $.each(data.success,function(i,o){
                    city_to_append += '<option value="'+o.id+'">'+o.name+'</option>';
                });

                var city_to_append_list = '';
                $.each(data.success,function(i,o){
                    city_to_append_list += '<li data-value="'+o.id+'" class="option">'+o.name+'</li>';
                });

                $("#city").empty();
                $("#city_list").empty();
                $('#city').append(city_to_append);
                $('#city_list').append(city_to_append_list);

            }, 
           
            

            })
    })

})

</script>


@endsection
