@extends('layouts.site')
@section('site-content')
<main>
   <section class="hero_in general">
      <div class="wrapper">
         <div class="container">
            <h1 class="fadeInUp"><span></span>{{$page->name}}</h1>
         </div>
      </div>
   </section>
   @if ($page->type === 'faq')
   <div class="bg_color_1">
      <div class="container margin_80_55">
         <div class="row justify-content-between">
            <div class="col-lg-12">
               {!! nl2br($page->content) !!}
            </div>
         </div>
         <!--/row-->
      </div>
      <!--/container-->
   </div>
   @endif
   @if ($page->type === 'custom')
   <div class="bg_color_1">
      <div class="container margin_80_55">
         <div class="row justify-content-between">
            <div class="col-lg-12">
               {!! nl2br($page->content) !!}
            </div>
         </div>
         <!--/row-->
      </div>
      <!--/container-->
   </div>
   @endif
   @if ($page->type === 'about-us')
   <div class="bg_color_1">
      <div class="container margin_80_55">
         <div class="row justify-content-between">
            <div class="col-lg-12">
               {!! nl2br($page->content) !!}
            </div>
         </div>
         <!--/row-->
      </div>
      <!--/container-->
   </div>
   @endif
   @isset($contact)
   <div class="contact_info">
      <div class="container">
         <ul class="clearfix">
            <li>
               <i class="pe-7s-map-marker"></i>
               <h4>Address</h4>
               <span>{{$contact->address}}</span>
            </li>
            <li>
               <i class="pe-7s-mail-open-file"></i>
               <h4>Email address</h4>
               <span>{{$contact->email}}</small></span>
            </li>
            <li>
               <i class="pe-7s-phone"></i>
               <h4>Contacts info</h4>
               <span>{{$contact->contact}}</span>
            </li>
         </ul>
      </div>
   </div>
   <div class="bg_color_1">
      <div class="container margin_80_55">
         <div class="row justify-content-between">
            <div class="col-lg-5">
               <div class="map_contact" style="position: relative; overflow: hidden;">
                  <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                     <div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                        <div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;">
                           <div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%;">
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div>
                              </div>
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: -1;"></div>
                              </div>
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div>
                              <div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div>
                           </div>
                           <div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0; transition-duration: 0.2s;">
                              <p class="gm-style-pbt"></p>
                           </div>
                           <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;">
                              <div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%;">
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                                 <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
                              </div>
                           </div>
                        </div>
                        <iframe aria-hidden="true" frameborder="0" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;" src="about:blank"></iframe>
                     </div>
                  </div>
                  <div style="background-color: white; font-weight: 500; font-family: Roboto, sans-serif; padding: 15px 25px; box-sizing: border-box; top: 5px; border: 1px solid rgba(0, 0, 0, 0.12); border-radius: 5px; left: 50%; max-width: 375px; position: absolute; transform: translateX(-50%); width: calc(100% - 10px); z-index: 1;">
                     <div><img alt="" src="http://maps.gstatic.com/mapfiles/api-3/images/google_gray.svg" draggable="false" style="padding: 0px; margin: 0px; border: 0px; height: 17px; vertical-align: middle; width: 52px; user-select: none;"></div>
                     <div style="line-height: 20px; margin: 15px 0px;"><span style="color: rgba(0, 0, 0, 0.87); font-size: 14px;">This page can't load Google Maps correctly.</span></div>
                     <table style="width: 100%;">
                        <tr>
                           <td style="line-height: 16px; vertical-align: middle;"><a href="https://developers.google.com/maps/documentation/javascript/error-messages?utm_source=maps_js&amp;utm_medium=degraded&amp;utm_campaign=keyless#api-key-and-billing-errors" target="_blank" rel="noopener" style="color: rgba(0, 0, 0, 0.54); font-size: 12px;">Do you own this website?</a></td>
                           <td style="text-align: right;"><button class="dismissButton">OK</button></td>
                        </tr>
                     </table>
                  </div>
               </div>
               <!-- /map -->
            </div>
            <div class="col-lg-6">
               <h4>Send a message</h4>
               <p>Ex quem dicta delicata usu, zril vocibus maiestatis in qui.</p>
               <div id="message-contact"></div>
               <form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Name</label>
                           <input class="form-control" type="text" id="name_contact" name="name_contact">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Last name</label>
                           <input class="form-control" type="text" id="lastname_contact" name="lastname_contact">
                        </div>
                     </div>
                  </div>
                  <!-- /row -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Email</label>
                           <input class="form-control" type="email" id="email_contact" name="email_contact">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Telephone</label>
                           <input class="form-control" type="text" id="phone_contact" name="phone_contact">
                        </div>
                     </div>
                  </div>
                  <!-- /row -->
                  <div class="form-group">
                     <label>Message</label>
                     <textarea class="form-control" id="message_contact" name="message_contact" style="height:150px;"></textarea>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Are you human? 3 + 1 =</label>
                           <input class="form-control" type="text" id="verify_contact" name="verify_contact">
                        </div>
                     </div>
                  </div>
                  <p class="add_top_30"><input type="submit" value="Submit" class="btn_1 rounded" id="submit-contact"></p>
               </form>
            </div>
         </div>
         <!-- /row -->
      </div>
      <!-- /container -->
   </div>
   @endisset
   @isset($box_section)
   <div class="container margin_80_55">
      <div class="main_title_2">
         <span><em></em></span>
         <h2>{{$box_section->section_heading}}</h2>
         <p>{{$box_section->section_heading_paragraph}}</p>
      </div>
      <div class="row">
         @foreach ($boxes as $box)
         <div class="col-lg-4 col-md-6">
            <a class="box_feat" href="#0">
               {{-- <i class="pe-7s-medal"></i> --}}
               <h3>{{$box->box_heading}}</h3>
               <p>{{$box->box_paragraph}}</p>
            </a>
         </div>
         @endforeach
      </div>
      <!--/row-->
   </div>
   @endisset
   @isset($questions)
   <hr>
   <div class="container">
      <div class="col-lg-12" id="faq">
         <h4 class="nomargin_top">Have some question in mind! We know have a look below</h4>
         <br>
         <div role="tablist" class="add_bottom_45 accordion_2" id="payment">
            @foreach ($questions as $question)
            <div class="card">
               <div class="card-header" role="tab">
                  <h5 class="mb-0">
                     <a class="collapsed" data-toggle="collapse" href="#qa_{{$question->id}}" aria-expanded="false">
                     <i class="indicator ti-plus"></i>{{$question->question}}
                     </a>
                  </h5>
               </div>
               <div id="qa_{{$question->id}}" class="collapse" role="tabpanel" data-parent="#payment">
                  <div class="card-body">
                     <p>{{$question->answer}}</p>
                  </div>
               </div>
            </div>
            @endforeach                    
         </div>
      </div>
   </div>
   @endisset
   @isset($gallary)
   <div class="container margin_60_35">
      <div class="main_title_2">
         <span><em></em></span>
         <h2>Here some pictures</h2>
      </div>
      <div class="grid">
         <ul class="magnific-gallery">
            @foreach ($gallary as $item)
            <li>
               <figure>
                  <img src="{{ URL::to('/images/page-gallary/' . $item->image) }}" alt="">
                  <figcaption>
                     <div class="caption-content">
                        <a href="{{ URL::to('/images/page-gallary/' . $item->image) }}" title="OVR" data-effect="mfp-zoom-in">
                           <i class="pe-7s-albums"></i>
                           {{-- 
                           <p>Your caption</p>
                           --}}
                        </a>
                     </div>
                  </figcaption>
               </figure>
            </li>
            @endforeach
         </ul>
      </div>
   </div>
   @endisset
</main>
@endsection