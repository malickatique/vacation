@extends('layouts.admin')
@section('admin-js')
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/froala_editor.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/froala_style.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/code_view.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/colors.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/emoticons.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/image_manager.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/image.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/line_breaker.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/table.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/char_counter.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/video.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/fullscreen.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/file.css')}}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/froala_editor_2.9.3/css/plugins/quick_insert.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
@append
@section('admin-js')
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/froala_editor.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/align.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/char_counter.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/code_beautifier.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/code_view.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/colors.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/draggable.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/emoticons.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/entities.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/file.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/font_size.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/font_family.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/fullscreen.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/image.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/image_manager.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/line_breaker.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/inline_style.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/link.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/lists.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/paragraph_format.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/paragraph_style.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/quick_insert.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/quote.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/table.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/save.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/url.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/bower_components/froala_editor_2.9.3/js/plugins/video.min.js')}}"></script>
<script>
   $(function(){
     $.FroalaEditor.DefineIcon('imageInfo', {NAME: 'info'});
     $.FroalaEditor.RegisterCommand('imageInfo', {
       title: 'Info',
       focus: false,
       undo: false,
       refreshAfterCallback: false,
       callback: function () {
         var $img = this.image.get();
         alert($img.attr('src'));
       }
     });
   
     $('#edit').froalaEditor({
       imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove']
     })
   });
</script>

<script>
   $(document).ready(function(){
      $('#page_type').change(function(){
         var type = $(this).val();
         
         if(type === 'custom'){
            $('#custom_page_required_option').css('display','inline');
            $('#about_page_required_option').css('display','none');
         }

         if(type === 'about-us'){
            $('#custom_page_required_option').css('display','none');
            $('#about_page_required_option').css('display','inline');
         }

         if(type === 'faq'){
            $('#custom_page_required_option').css('display','none');
            $('#about_page_required_option').css('display','none');
         }

         if(type === 'contact-us'){
            $('#custom_page_required_option').css('display','none');
            $('#about_page_required_option').css('display','none');
         }

      })
   })
</script>

@append
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Pages</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Pages</a></li>
         <li class="active">Create</li>
      </ol>
   </section>
   <section class="content container-fluid">
      <!-- /.box-header -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Pages | Step 1:</h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form" method="POST" action="{{ route('page.store') }}">
            <div class="box-body">
               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
               <div class="form-group">
                  <label for="pageName">Page Name</label> 
                  <input type="text" class="form-control" name="name" id="pageName" placeholder="Enter Name">
               </div>
               <div class="form-group">
                  <label for="pageTitle">Page Title</label> 
                  <input type="text" class="form-control" name="title" id="pageTitle" placeholder="Enter Page Title">
               </div>
               <div class="form-group">
                  <label for="content">Content</label> 
                  <textarea name="content" id="edit" cols="30" rows="15" class="form-control" ></textarea>
               </div>
               <div class="form-group">
                  <label for="short_description">SEO Short Description</label> 
                  <textarea name="short_description" id="editor2" cols="30" rows="5" class="form-control" ></textarea>
               </div>
               <div class="form-group">
                  <label for="keywords">SEO Keywords</label> 
                  <textarea name="keywords" id="keywords" cols="30" rows="5" class="form-control" ></textarea>
               </div>
               <div class="form-group">
                  <label for="keywords">Page Template</label> 
                  <select class="form-control" name="page_type" id="page_type">
                     <option selected disabled hidden>Select Page template</option>
                     <option value="custom">Custom</option>
                     <option value="faq">FAQ</option>
                     <option value="about-us">About Us</option>
                     <option value="contact-us">Contact Us</option>
                  </select>
               </div>
               <div class="form-group" id="custom_page_required_option" style="display:none">
                  <label for="keywords">Custom Page Required Option</label> 
                  <div class="checkboxes float-left">
                     <input type="checkbox" name="custom[]" value="faq" >
                     <span class="container_check">FAQ
                     <span class="checkmark"></span>
                     </span>
                     <input type="checkbox" name="custom[]" value="gallary" >
                     <span class="container_check">Gallary
                     <span class="checkmark"></span>
                     </span>
                     <input type="checkbox" name="custom[]" value="grid-box" >
                     <span class="container_check">Grid Box
                     <span class="checkmark"></span>
                     </span>
                  </div>
               </div>

               <div class="form-group" id="about_page_required_option" style="display:none">
                  <label for="keywords">About Page Required Option</label> 
                  <div class="checkboxes float-left">
                     <input type="checkbox" name="about[]" value="gallary" >
                     <span class="container_check">Gallary
                     <span class="checkmark"></span>
                     </span>
                     <input type="checkbox" name="about[]" value="grid-box" >
                     <span class="container_check">Grid Box
                     <span class="checkmark"></span>
                     </span>
                  </div>
               </div>
               
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Next ></button>
            </div>
          
         </form>
         
      </div>
   </section>
</div>
@endsection
