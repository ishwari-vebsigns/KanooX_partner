@extends('layouts.admin-app')
@section('content')
<style>
  .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 170px;
  margin-left:320px;
  height:50px;
  font-size: 14px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}
.hidden{
  visibility:hidden;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div class="content-body">
            <div class="container-fluid">
            <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/bank/all">Banks</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Bank</a></li>
                        </ol>
                    </div>
                </div>
 
@if(Auth::user()->kyc_status==0)
  <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
@endif   

                    
  
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Bank</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="add" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Bank Image/Logo <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                                        <input type="file" class="form-control" id="sub_service_image" name="sub_service_image" required>
                                                        @if ($errors->has('sub_service_image'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('sub_service_image') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Bank Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('bank_name')}}" id="bank_name" name="bank_name" placeholder="Bank Name" required>
                                                        @if ($errors->has('bank_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Effective Interest -->
<div class="form-group row">
  <label class="col-lg-4 col-form-label">Effective Interest *</label>
  <div class="col-lg-6">
    <input type="text"
           class="form-control"
           name="effective_interest_range"
           value="{{ old('effective_interest_range') }}"
           placeholder="6.90 - 24.40 %"
           required>
  </div>
</div>

<!-- Age Limit -->
<div class="form-group row">
  <label class="col-lg-4 col-form-label">Age Limit *</label>
  <div class="col-lg-6">
    <input type="text"
           class="form-control"
           name="age_limit"
           value="{{ old('age_limit') }}"
           placeholder="25 years"
           required>
  </div>
</div>

                                                {{-- <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="sub_service_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($services as $service)
                                                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="desc" rows="5" placeholder="What would you like to see?">{{old('desc')}}</textarea>
                                                        @if ($errors->has('desc'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('desc') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
    <!--<label>Know More Description</label>-->
    <label class="col-lg-4 col-form-label">Know More Description</label>
    <div class="col-lg-6">
    <textarea
        name="know_more_description"
        class="form-control"
        rows="6"
    >{{ old('know_more_description') }}</textarea>
    </div>
</div>

                                                {{-- <div class="form-group row">
                                                <div class="radio-inputs">
                                                    <label for=""></label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio" checked="">
                                                        <span id="api_name" class="name">API</span>
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="radio">
                                                        <span id="url_name" class="name">URL</span>
                                                    </label>
                                                        
                                                  
                                                    </div>
                                                </div>
                                                <div class="form-group row hidden" id="url_show">
                                                <label class="col-lg-4 col-form-label" for="val-skill">Bank URL
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_url') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="bank_url" name="bank_url" placeholder="Bank URL">
                                                        @if ($errors->has('bank_url'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_url') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
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



       
      
</div>
</div>

<script class="">
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
$("#url_name").click(function(){
    // alert("yes");
    document.getElementById("url_show").style.visibility = "visible";


});
$("#api_name").click(function(){
    // alert("yes");
    $("#bank_url").val("");
    document.getElementById("url_show").style.visibility = "hidden";

});
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");
    
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

