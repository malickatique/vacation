@extends('layouts.site')
@section('site-content')
<link href="{{ asset('site/userprofile.css') }}" rel="stylesheet">
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
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
      
      <div class="col-md-12">
         <div class="profile-content">
            <h4 class="text-left text-capitalize" >Step 2: Enter Property Gallary media</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis placeat tenetur animi labore molestiae? Rerum voluptatibus, fugiat porro incidunt quasi ipsum soluta id quae magnam aperiam maxime, voluptatum assumenda tempore.</p>
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
            <form method="post" action="{{url('/gallary/upload/store')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
               {{ csrf_field() }}

            <input type="hidden" name="property_id" id="property_id" value="{{$property_id}}">
               
            </form>

            <p class="add_top_30">
               <a href="{{ URL::route('gallary.final') }}" class="btn_1 rounded">Finish</a>
            </p>
         </div>
      </div>
   </div>
</div>
<br>
<script type="text/javascript">
   Dropzone.options.dropzone =
    {
       maxFilesize: 12,
       renameFile: function(file) {
           var dt = new Date();
           var time = dt.getTime();
          return time+file.name;
       },
       acceptedFiles: ".jpeg,.jpg,.png,.gif",
       addRemoveLinks: true,
       timeout: 50000,
       removedfile: function(file) 
       {
           var name = file.upload.filename;
           var property_id = $('#property_id"]').val();
           $.ajax({
            
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                       },
               type: 'POST',
               url: '{{ url("gallary/delete") }}',
               data: {filename: name, property_id: property_id},
               success: function (data){
                   console.log("File has been successfully removed!!");
               }, 
               error: function(e) {
                   console.log(e);
               }});




               var fileRef;
               return (fileRef = file.previewElement) != null ? 
               fileRef.parentNode.removeChild(file.previewElement) : void 0;
       },
  
       success: function(file, response) 
       {
           console.log(response);
       },
       error: function(file, response)
       {
          return false;
       }
};
</script>
@endsection