@extends('layouts.admin-app')
@section('content')
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Blog</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Blog </a>
              </li>
              <li class="breadcrumb-item">
              Edit                                </li>
            </ol> 
          </div>
        </div>
      </div>
    </div>

  </div>                    
  <div class="content-body">

    <!-- Simple Validation start -->
    <section class="simple-validation">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Blog</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Edit <code>Blog</code></p>



          <!-- Multiple Rule Validation end -->
          <form class="form-horizontal" role="form" method="POST" action="{{config('app.baseURL')}}/admin/blog/{{$blog->blog_id}}" enctype="multipart/form-data" novalidate="">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
            <div class="contact-form">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6  {{ $errors->has('blog_type_id') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    <div class="selected-box form-group{{ $errors->has('blog_type_id') ? ' has-error' : '' }} ">
                      <select id="blog_type_id" class="form-control" id="basicSelect" name="blog_type_id" required="" data-validation-required-message="This field is required">
                        @foreach($blog_types as $blog_type)
                        <option value="{{$blog_type->blog_type_id}}">{{$blog_type->blog_type_name}}</option>
                        @endforeach
                      </select>                                        
                      @if ($errors->has('blog_type_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('blog_type_id') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('blog_title') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="blog_title" value="{{ old('blog_title',$blog->blog_title) }}" placeholder="Blog Title">
                    @if ($errors->has('blog_title'))
                    <span class="help-block">
                      <strong>{{ $errors->first('blog_title') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                 <div class="form-group mg-b-0 mg-md-l-20 mg-t-20 mg-md-t-0">
              
              <img class="img-fluid" src="{{config('app.baseURL')}}/storage/app/{{$blog->image}}" id="blog_image" style="max-height:150px;max-width:150px;" onerror="this.src='{{config('app.baseURL')}}/images/preview.png';">


            </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input type="file" class="form-control" name="image"  accept="image/*" style="padding-top: 10px;"  onchange="document.getElementById('blog_image').src = window.URL.createObjectURL(this.files[0])">
                    @if ($errors->has('image'))
                    <span class="help-block">
                      <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                <!-- full Editor start -->

             

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('blog_description') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                <textarea name="blog_description" class="form-control summernote-editor" rows="5" value="{{old('blog_description',$blog->blog_description)}}" placeholder="Enter blog description">{{old('blog_description',$blog->blog_description)}}</textarea>
                @if ($errors->has('blog_description'))
                <span class="help-block">
                  <strong>{{ $errors->first('blog_description') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('url') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="url" value="{{ old('url',$blog->url) }}" placeholder="Blog URL">
                    @if ($errors->has('url'))
                    <span class="help-block">
                      <strong>{{ $errors->first('url') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('seo_title') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="seo_title" value="{{ old('seo_title',$blog->seo_title) }}" placeholder="SEO Title">
                    @if ($errors->has('seo_title'))
                    <span class="help-block">
                      <strong>{{ $errors->first('seo_title') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('seo_keywords') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="keywords" value="{{ old('keywords',$blog->keywords) }}" placeholder="SEO Keywords">
                    @if ($errors->has('keywords'))
                    <span class="help-block">
                      <strong>{{ $errors->first('keywords') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="description" value="{{ old('description',$blog->description) }}" placeholder="SEO Description">
                    @if ($errors->has('description'))
                    <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Edit Blog</button>
                 </div>
               </div>
             </div>
           </div> 
         </form>
       </div>
     </div>
   </div>
 </div>
</div>
</section>
</div>
</div>
<script type="text/javascript">

  $(document).ready(function(){


    var options = $.extend(true, {lang: '' , codemirror: {theme: 'monokai', mode: 'text/html', htmlMode: true, lineWrapping: true} } , {
      "toolbar": [
      ["style", ["style"]],
      ["font", ["bold", "underline", "italic", "clear"]],
      ["color", ["color"]],
      ["para", ["ul", "ol", "paragraph"]],
      ["insert", ["link","picture"]],
      ["view", ["fullscreen", "codeview", "help"]],
      ['fontname', ['fontname']
      ],
      ['fontNames', [ 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento']],
      ['fontNamesIgnoreCheck', [ 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento']],
      ],
      cleaner:{
        action: 'both',
        newline: '<br>', 
        notStyle: 'position:absolute;top:0;left:0;right:0',
        icon: '<i class="note-icon">[Your Button]</i>',
        keepHtml: false, 
        keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'],
        keepClasses: false, 
        badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], 
        badAttributes: ['style', 'start'],
        limitChars: false,
        limitDisplay: 'both', 
        limitStop: false
      }
    });
    $("textarea.summernote-editor").summernote(options);

  });
</script>
<script>

  $(document).ready(function() {
    
    
  $("#blog_type_id option[value='{{$blog->blog_type_id}}']").prop('selected',true);

  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch(type){
    case 'info':
    toastr.info("{{ Session::get('message') }}");
    break;

    case 'warning':
    toastr.warning("{{ Session::get('message') }}");
    break;
    case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
    case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
  }
  @endif

</script>
@endsection