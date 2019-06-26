@extends('layouts.admin')
@section('admin-js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css')}}">
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
<script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
{{-- <script>
    CKEDITOR.replace('editor1');
    // CKEDITOR.replace('editor2');
</script> --}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

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
            <h3 class="box-title">Edit CMS Page</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('page.update',$page->id) }}">
            <div class="box-body">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="pageName">Page Name</label>
            <input type="text" class="form-control" name="name" value="{{$page->name}}" id="pageName" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="pageTitle">Page Title</label>
                <input type="text" class="form-control" name="title"  value="{{$page->title}}" id="pageTitle" placeholder="Enter Page Title">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="edit" name="content" rows="10" cols="30">{{$page->content}}</textarea>
            </div>

            <div class="form-group">
                <label for="short_description">SEO Short Description</label>
                <textarea name="short_description" id="editor2" cols="30" rows="5" class="form-control">{{$page->short_description}}</textarea>
            </div>

            <div class="form-group">
                <label for="keywords">SEO Keywords</label>
                <textarea name="keywords" id="keywords" cols="30" rows="5" class="form-control">{{$page->keywords}}</textarea>
            </div>

            @isset($contact)
                  <hr>
                     <h4>Contact page Detail</h4>
                  <hr>
                    <input type="hidden" name="contact-page" value="enable" >
                     <div class="form-group">
                        <label>Address</label> 
                     <textarea name="address"  rows="3" class="form-control" >{{$contact->address}}</textarea>
                     </div>

                     <div class="form-group">
                        <label>Email address</label> 
                        <input name="email" type="text" value="{{$contact->email}}" class="form-control" >
                     </div>

                     <div class="form-group">
                        <label>Contacts info</label> 
                        <input name="contact" type="text" value="{{$contact->contact}}" class="form-control" >
                     </div>

                     <div class="form-group">
                        <label>Map</label> 
                        <input name="map" type="text" value="{{$contact->map}}" class="form-control" >
                     </div>

                  @endisset

                  @isset($box_section)
                    <input type="hidden" name="box-section" value="enable" >

                  <div class="form-group">
                        <label>Box Section Heading</label> 
                        <input type="text" name="section_heading" value="{{$box_section->section_heading}}"  class="form-control" >
                     </div>
                     <div class="form-group">
                        <label>Box Section Heading Paragraph</label> 
                        <input name="section_heading_paragraph" type="text" value="{{$box_section->section_heading_paragraph}}"  class="form-control" >
                     </div>

                  @endisset

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
    </div>

    @isset($box_section)

    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Box Section Data</h3>
            </div>
            {{-- <form role="form" method="POST" action="{{ route('page.update',$page->id) }}"> --}}
                <div class="box-body">

                     @foreach ($boxes as $box)

                    <table class="table table-bordered">

                        <tr>
                            <th>Heading</th>
                            <th>Paragraph</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>{{$box->box_heading}}</td>
                            <td>{{$box->box_paragraph}}</td>
                            <td>
                            <a href="{{route('page.edit.box', $box->id)}}" class="btn btn-warning btn-xs">Edit</a>

                            </td>
                        </tr>
                    </table>

                     @endforeach
                 

                </div>
            {{-- </form> --}}
    </div>

    @endisset



    @isset($questions)

    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">FAQ Section Data</h3>
            </div>
            {{-- <form role="form" method="POST" action="{{ route('page.update',$page->id) }}"> --}}
                <div class="box-body">

                     @foreach ($questions as $question)

                    <table class="table table-bordered">

                        <tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>{{$question->question}}</td>
                            <td>{{$question->answer}}</td>
                            <td>
                            <a href="{{route('page.edit.question', $question->id)}}" class="btn btn-warning btn-xs">Edit</a>

                            </td>
                        </tr>
                    </table>

                     @endforeach
                 

                </div>
            {{-- </form> --}}
    </div>

    @endisset

    @isset($gallary)

    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Page Gallary Section</h3>
            </div>
            {{-- <form role="form" method="POST" action="{{ route('page.update',$page->id) }}"> --}}
                <div class="box-body">

                     

                    <table class="table table-bordered">

                        <tr>
                            <th>Gallary Picture</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($gallary as $item)
                        <tr>
                            <td>
                                <img src="{{ URL::to('/images/page-gallary/' . $item->image) }}" width="60px" height="60px" class="img-thumbnail" >
                            </td>
                            <td>
                            <a href="{{route('page.edit.pagegallary', $item->id)}}" class="btn btn-warning btn-xs">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                     
                 

                </div>
            {{-- </form> --}}
    </div>

    @endisset





    </section>
</div>
@endsection