@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Partner Banks</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Partner Banks </a>
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
              <h4 class="card-title">Partner Banks</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Add <code> Banks</code></p>
            <!-- <form class="form-horizontal" novalidate="">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <input type="text" name="text" class="form-control" placeholder="First Name" required="" data-validation-required-message="This First Name field is required">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="controls">
                      <input type="email" name="email" class="form-control" placeholder="Email" required="" data-validation-required-message="This Email field is required">
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          -->         
          <!-- Input Validation end -->


          <!-- Multiple Rule Validation end -->
          <form class="form-horizontal" role="form" method="POST" action="add" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
            <div class="contact-form">
              <div class="row">
               
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
                <div class="form-group mg-b-0 mg-md-l-20 mg-t-20 mg-md-t-0">
                  <img class="image-size"  src="{{config('app.baseURL')}}/images/preview.png" id="bank_image" alt="" style="height: 100px;">
                </div><!-- form-group -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_image') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input type="file" class="form-control" required="" data-validation-required-message="This field is required" name="bank_image" accept="image/*" onchange="document.getElementById('bank_image').src = window.URL.createObjectURL(this.files[0])" style="padding-top: 10px;">
                      @if ($errors->has('bank_image'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_image') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
            

             
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Add Bank</button>
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
