@extends('layouts.admin-app')
@section('content')
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Mutual Fund</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Mutual Fund </a>
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
              <h4 class="card-title">Mutual Fund List</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Add <code>Mutual Fund</code></p>
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
          <form class="form-horizontal" role="form" method="POST" action="add" enctype="multipart/form-data" novalidate="">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
            <div class="contact-form">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6  {{ $errors->has('mutual_fund_type') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    <div class="selected-box form-group{{ $errors->has('mutual_fund_type') ? ' has-error' : '' }} ">
                      <select id="mutual_fund_type" class="form-control" id="basicSelect" name="mutual_fund_type" required="" data-validation-required-message="This field is required">
                       
                        <option value="large-cap">Large Cap</option>
                        <option value="mid-cap">Mid Cap</option>
                         <option value="focused">Focused</option>
                         <option value="elss">ELSS</option>
                       
                      </select>                                        
                      @if ($errors->has('mutual_fund_type'))
                      <span class="help-block">
                        <strong>{{ $errors->first('mutual_fund_type') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('mutual_fund_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="mutual_fund_name" value="{{ old('mutual_fund_name') }}" placeholder="Name">
                    @if ($errors->has('mutual_fund_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('mutual_fund_name') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                 <div class="form-group mg-b-0 mg-md-l-20 mg-t-20 mg-md-t-0">
              <img class="image-size"  src="{{config('app.baseURL')}}/images/preview.png" id="logo" alt="" style="height: 100px;">
            </div><!-- form-group -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('logo') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input type="file" class="form-control" required="" data-validation-required-message="This field is required" name="logo" accept="image/*" onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])" style="padding-top: 10px;">
                    @if ($errors->has('logo'))
                    <span class="help-block">
                      <strong>{{ $errors->first('logo') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                <!-- full Editor start -->


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('rating') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="number" name="rating" value="{{ old('rating') }}" placeholder="Rating">
                    @if ($errors->has('rating'))
                    <span class="help-block">
                      <strong>{{ $errors->first('rating') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('aum_cr') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="aum_cr" value="{{ old('aum_cr') }}" placeholder="AUM ( Cr )">
                    @if ($errors->has('aum_cr'))
                    <span class="help-block">
                      <strong>{{ $errors->first('aum_cr') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>



                 <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('one_year') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="one_year" value="{{ old('one_year') }}" placeholder="One Year">
                    @if ($errors->has('one_year'))
                    <span class="help-block">
                      <strong>{{ $errors->first('one_year') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>


                 <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('three_year') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="three_year" value="{{ old('three_year') }}" placeholder="Three Year">
                    @if ($errors->has('three_year'))
                    <span class="help-block">
                      <strong>{{ $errors->first('three_year') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>


                 <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('five_year') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="five_year" value="{{ old('five_year') }}" placeholder="Five Year">
                    @if ($errors->has('five_year'))
                    <span class="help-block">
                      <strong>{{ $errors->first('five_year') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

               
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Submit</button>
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