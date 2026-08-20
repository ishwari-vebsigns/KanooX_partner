@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Status</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Status </a>
              </li>
              <li class="breadcrumb-item">
              Add                                </li>
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
              <h4 class="card-title">Status</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Add <code> Status</code></p>
           

          <!-- Multiple Rule Validation end -->
          <form class="form-horizontal" role="form" method="POST" action="add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
            <div class="contact-form">
              <div class="row">
               
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('status_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="status_name" value="{{ old('status_name') }}" placeholder="Status">
                      @if ($errors->has('status_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('status_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
               
                

             
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Add Status</button>
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

<script>


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
