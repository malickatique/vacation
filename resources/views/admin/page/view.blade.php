@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Page View</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Page View</li>
      </ol>
   </section>
   <section class="content container-fluid">
      @if (session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
      @endif
      <div class="box">
         <div class="box-header">
            <h3 class="box-title text-uppercase">Page View</h3>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form role="form" >
               <div class="box-body">
                  <div class="form-group">
                     <label for="pageName">Page Name</label> 
                     <input type="text" value="{{$page->name}}" disabled class="form-control" name="name" id="pageName" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                     <label>Page Title</label> 
                     <input type="text" value="{{$page->title}}" disabled class="form-control" name="title" id="pageTitle" placeholder="Enter Page Title">
                  </div>
                  <div class="form-group">
                     <label for="content">Content</label> 
                     <textarea name="content" id="edit" cols="30" rows="15" disabled class="form-control" >{{$page->content}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="short_description">SEO Short Description</label> 
                     <textarea name="short_description" id="editor2" disabled cols="30" rows="5" class="form-control" >{{$page->short_description}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="keywords">SEO Keywords</label> 
                     <textarea name="keywords" id="keywords" cols="30" rows="5" disabled class="form-control" >{{$page->keywords}}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="keywords">Page Type</label> 
                     <input type="text" value="{{$page->type}}" disabled class="form-control text-capitalize " name="name" id="pageName" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                     <label for="keywords">Page Features</label> <br>
                     <ul>
                        @foreach ($pagefeatures as $item)
                        <li class="text-capitalize">{{$item->feature}}</li>
                        @endforeach
                     </ul>
                  </div>
                  @isset($contact)
                  <hr>
                  <h4>Contact page Detail</h4>
                  <hr>
                  <div class="form-group">
                     <label>Address</label> 
                     <textarea name="keywords" id="keywords" rows="3" disabled class="form-control" >{{$contact->address}}</textarea>
                  </div>
                  <div class="form-group">
                     <label>Email address</label> 
                     <input type="text" value="{{$contact->email}}" disabled class="form-control" >
                  </div>
                  <div class="form-group">
                     <label>Contacts info</label> 
                     <input type="text" value="{{$contact->contact}}" disabled class="form-control" >
                  </div>
                  <div class="form-group">
                     <label>Map</label> 
                     <input type="text" value="{{$contact->map}}" disabled class="form-control" >
                  </div>
                  @endisset
                  @isset($box_section)
                     <hr>
                     <h4>Box Section</h4>
                     <hr>
                     <div class="form-group">
                        <label>Section Heading</label> 
                        <input type="text" value="{{$box_section->section_heading}}" disabled class="form-control" >
                     </div>
                     <div class="form-group">
                        <label>Section Heading Paragraph</label> 
                        <input type="text" value="{{$box_section->section_heading_paragraph}}" disabled class="form-control" >
                     </div>
                     <h4>Boxes Data:</h4>
                     @foreach ($boxes as $box)
                     <div class="form-group">
                        <label>Box Heading</label> 
                        <input type="text" value="{{$box->box_heading}}" disabled class="form-control" >
                     </div>
                     <div class="form-group">
                        <label>Box Paragraph</label> 
                        <input type="text" value="{{$box->box_paragraph}}" disabled class="form-control" >
                     </div>
                     @endforeach
                  @endisset
                  @isset($questions)
                  <hr>
                  <h4>FAQ Section</h4>
                  <hr>
                  @foreach ($questions as $question)
                  <div class="form-group">
                     <label>Question</label> 
                     <input type="text" value="{{$question->question}}" disabled class="form-control" >
                  </div>
                  <div class="form-group">
                     <label>Answer</label> 
                     <input type="text" value="{{$question->answer}}" disabled class="form-control" >
                  </div>
                  @endforeach                    
                  @endisset
                  @isset($gallary)
                  <hr>
                  <h4>Gallary</h4>
                  <hr>
                  @foreach ($gallary as $item)
                  <img src="{{ URL::to('/images/page-gallary/' . $item->image) }}" width="200px" height="200px" class="img-thumbnail" >
                  @endforeach
                  @endisset
               </div>
               <!-- /.box-body -->
            </form>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
</div>
@endsection
<script type="text/javascript">
   setTimeout( function(){$('.alert').fadeOut();} , 1500);
</script>