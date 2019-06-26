@extends('layouts.admin')
@section('admin-content')
<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Property
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Property</a></li>
         <li class="active">Add</li>
      </ol>
   </section>
   <section class="content container-fluid">
      <!-- /.box-header -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Add Property Gallary Section</h3>
         </div>
         <!-- /.box-header -->
         <br><br>
         <form method="post" action="{{url('/gallary/upload/store')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
               {{ csrf_field() }}

            <input type="hidden" name="property_id" id="property_id" value="1">
               
            </form>

        <hr>

        <div class="container  ">
            <a href="#" class="btn btn-success">Submit</a>
        </div>
         
        <br>
      </div>
   </section>
</div>
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
