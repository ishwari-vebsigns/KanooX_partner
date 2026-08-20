@extends('layouts.admin-app')
@section('content')
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Associate Access</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Employee </a>
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
              <h4 class="card-title">Associate Access</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Add <code>Employee</code></p>



                <!-- Multiple Rule Validation end -->
                <form class="form-horizontal" role="form" method="POST" action="add" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
                  <div class="contact-form">
                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Full Name"  name="name" type="text" required="">
                            @if ($errors->has('name'))
                            <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
              
                      <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Email" name="email"  type="email" required="">
                            @if ($errors->has('email'))
                            <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Contact Number"  name="contact_number" type="number" required="">
                            @if ($errors->has('contact_number'))
                            <span class="help-block">
                              <strong>{{ $errors->first('contact_number') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                            <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('designation') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Designation"  name="designation" type="text" required="">
                            @if ($errors->has('designation'))
                            <span class="help-block">
                              <strong>{{ $errors->first('designation') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('designation') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>DOJ</label>
                          <div class="controls">
                              
                            <input class="form-control" placeholder="Date of Joining"  name="doj" type="date" required="">
                            @if ($errors->has('doj'))
                            <span class="help-block">
                              <strong>{{ $errors->first('doj') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('job_location') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Job Location"  name="job_location" type="text" required="">
                            @if ($errors->has('job_location'))
                            <span class="help-block">
                              <strong>{{ $errors->first('job_location') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                            <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('present_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Present Address"  name="present_address" type="text" required="">
                            @if ($errors->has('present_address'))
                            <span class="help-block">
                              <strong>{{ $errors->first('present_address') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                       <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('c_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Permanent Address"  name="c_address" type="text" required="">
                            @if ($errors->has('c_address'))
                            <span class="help-block">
                              <strong>{{ $errors->first('c_address') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                     
                       
                       <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('g_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Guardian Address"  name="g_address" type="text" required="">
                            @if ($errors->has('c_address'))
                            <span class="help-block">
                              <strong>{{ $errors->first('c_address') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                               <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('guardian_contact_number') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                            <input class="form-control" placeholder="Guardian Contact Number"  name="guardian_contact_number" type="number" required="">
                            @if ($errors->has('guardian_contact_number'))
                            <span class="help-block">
                              <strong>{{ $errors->first('guardian_contact_number') }}</strong>
                            </span>
                          @endif</div>
                        </div>
                      </div>
                      
                              
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <div class="controls">

                           <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                           @if ($errors->has('password'))
                           <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif</div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-submit mt-10 mb-30 text-center">

                       <button type="submit" class="btn btn-primary">Add Employee</button>
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
  $(".editor").on('keyup  mouseover',function(e) {
    var myEditor = document.querySelector('.editor')
    var html = myEditor.children[0].innerHTML;
    $('.new-editor').val(html);
  });

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