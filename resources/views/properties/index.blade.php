@extends('layouts.site')
@section('site-content')
<link href="{{ asset('site/userprofile.css') }}" rel="stylesheet">

<section class="hero_in general start_bg_zoom">
   <div class="wrapper">
      <div class="container">
         <h1 class="fadeInUp animated"><span></span>Owner Dashboard</h1>
      </div>
   </div>
</section>
<br> 
<div class="panel-body">
   @if (session('status'))
   <div class="alert alert-success">
      {{ session('status') }}
   </div>
   @endif
   <div class="row profile">
      <div class="col-md-3">
         <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic text-center">
               <img src="{{ asset('site/userprofile.png') }}" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
               <div class="profile-usertitle-name">
                  {{Auth::user()->name}}
               </div>
               <div class="profile-usertitle-job">
                  Owner
               </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
               <button type="button" class="btn btn-success btn-sm">Follow</button>
               <button type="button" class="btn btn-danger btn-sm">Message</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <br>
            <ul class="nav flex-column">
               <li class="nav-item">
                  <a class="nav-link active" href="{{route('home')}}">Dashboard</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('property.index')}}">Properties</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('property.create')}}">Add Property</a>
               </li>
               {{-- 
               <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
               </li>
               --}}
            </ul>
            <!-- END MENU -->
         </div>
      </div>
      <div class="col-md-9">
         <div class="profile-content">
            <h5>Properties</h5>
            <hr>
            <table id= "propTable" class="table table-striped cart-list">
               <thead>
                  <tr>
                     <th>
                        Property
                     </th>
                     <th>
                        Status
                     </th>
                     <th>
                        Price
                     </th>
                     <th>
                        Actions
                     </th>
                  </tr>
               </thead>
               <tbody>


                  @foreach ($properties as $property)
                  <tr>
                        <td>
                           <div class="thumb_cart">

                                 @if (empty($property->thumbnail))
                                 <img src="{{ URL::to('/images/property/') .'/noImagefound.jpg' }}">
                                 @else 
                                 <img src="{{ URL::to('/images/property/' . $property->thumbnail) }}">
                                 @endif

                              
                           </div>
                        <span class="item_cart">{{$property->name}}</span>
                        </td>
                        <td>
                           @if ($property->status == 2)
                           <span class="badge badge-pill badge-primary">Pending</span>
                           @elseif($property->status == 1)
                           <span class="badge badge-pill badge-success">Published</span>

                           @endif
                        </td>
                        <td>
                           <strong>${{$property->per_night_rent}}</strong>
                        </td>
                        <td class="options" style="width:17%; text-align:center;">
                           <a href="{{route('single-property', $property->id)}}"><i class="icon-eye"></i></a>
                           <a href="{{route('property.edit', $property->id)}}"><i class="icon-edit"></i></a>



                           <form style="display: -webkit-inline-box;" action="{{action('propertiesController@destroy', $property->id)}}" method="post">
                                 {{csrf_field()}}
                                 <input name="_method" type="hidden" value="DELETE">
                                 <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this property?');"><i class="icon-trash"></i></button>
                           </form>



                           
                        </td>
                     </tr>
                  @endforeach

                  
               </tbody>
               

            </table>
            <br>
            {{ $properties->links( "pagination::bootstrap-4") }}
                  
            
         </div>
      </div>
   </div>
</div>
<br>

@endsection