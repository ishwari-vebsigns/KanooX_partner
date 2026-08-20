@extends('layouts.admin-app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>
<!-- Jquery -->
<script type="text/javascript" src="{{asset('assets\js\jquery.min.js')}}"></script>

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">MIS</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> MIS </a>
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
              <h4 class="card-title">MIS</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">Add <code> Mis</code></p>
            
          <form class="form-horizontal" role="form" method="POST" action="addMis" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
            <div class="contact-form">
              <div class="row">
               
                <div class="col-sm-3 {{ $errors->has('customer_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Customer Name">
                      @if ($errors->has('customer_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('customer_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('customer_residence') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <textarea name="customer_residence" class="form-control summernote-editor" rows="1" value="{{ old('customer_residence') }}" placeholder="Enter Residence Address">{{old('customer_residence')}}</textarea>
                      @if ($errors->has('customer_residence'))
                      <span class="help-block">
                        <strong>{{ $errors->first('customer_residence') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('office_shop_add') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <textarea name="office_shop_add" class="form-control summernote-editor" rows="1" value="{{ old('office_shop_add') }}" placeholder="Enter Office/Shop Address">{{old('office_shop_add')}}</textarea>
                      @if ($errors->has('office_shop_add'))
                      <span class="help-block">
                        <strong>{{ $errors->first('office_shop_add') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('contact_no') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="contact_no" value="{{ old('contact_no') }}" placeholder="Contact Number">
                      @if ($errors->has('contact_no'))
                      <span class="help-block">
                        <strong>{{ $errors->first('contact_no') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                      @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('required_loan') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="required_loan" value="{{ old('required_loan') }}" placeholder="Required Loan">
                      @if ($errors->has('required_loan'))
                      <span class="help-block">
                        <strong>{{ $errors->first('required_loan') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('product') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="product" value="{{ old('product') }}" placeholder="Product">
                      @if ($errors->has('product'))
                      <span class="help-block">
                        <strong>{{ $errors->first('product') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('bank_nbfc_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="bank_nbfc_name" value="{{ old('bank_nbfc_name') }}" placeholder="Bank/NBFC Name">
                      @if ($errors->has('product'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_nbfc_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('property_details') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <textarea name="property_details" class="form-control summernote-editor" rows="1" value="{{ old('property_details') }}" placeholder="Enter Property Details">{{old('property_details')}}</textarea>
                      @if ($errors->has('property_details'))
                      <span class="help-block">
                        <strong>{{ $errors->first('property_details') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('city') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="city" value="{{ old('city') }}" placeholder="City">
                      @if ($errors->has('city'))
                      <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                 <div class="col-sm-3 {{ $errors->has('state') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="state" value="{{ old('state') }}" placeholder="State">
                      @if ($errors->has('state'))
                      <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> 
                <div class="col-sm-3 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="pincode" value="{{ old('pincode') }}" placeholder="Pin Code">
                      @if ($errors->has('pincode'))
                      <span class="help-block">
                        <strong>{{ $errors->first('pincode') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-sm-3 {{ $errors->has('remarks') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="remarks" value="{{ old('remarks') }}" placeholder="Remarks">
                      @if ($errors->has('remarks'))
                      <span class="help-block">
                        <strong>{{ $errors->first('remarks') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
            

             
       
           </div> 
                  <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30">

                   <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{config('app.baseURL')}}/admin/mis"><button type="button" class="btn btn-danger">Cancel
   </button></a>
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
