@extends('layouts.admin-app')
@section('content')
<style>
  .default{
    visibility:hidden;
  }
    .navpaddingone{
        padding-left:20px;
    }
    .nav-pills>li.active>a.navpaddingone {
    color: #fff;
    background-color: #542f6d;
    padding: 10px;
    border-radius: 5px;
    margin-left: 10px;
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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/sub-services/all">Sub-Services</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Sub Service</a></li>
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
                                <h4 class="card-title">Add Sub Service</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="add" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Sub Service Image/Logo <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                                        <input type="file" class="form-control" value="{{old('sub_service_image')}}" id="sub_service_image" name="sub_service_image" required>
                                                        @if ($errors->has('sub_service_image'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('sub_service_image') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group row">
    <label class="col-lg-4 col-form-label">
        Sub Service Image 2
    </label>
    <div class="col-lg-6">
        <input type="file" class="form-control" name="sub_service_image_2">
    </div>
</div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="service_id" value="{{old('service_id')}}" required>
                                                            <option value="">Please select</option>
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->service_id }}" {{ old('service_id') == $service->service_id ? 'selected' : '' }}>{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Sub Service Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="sub_service" name="sub_service" value="{{old('sub_service')}}" placeholder="Service Name ">
                                                        @if ($errors->has('sub_service'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('sub_service') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Service URL
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service_url') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="sub_service_url" name="sub_service_url" value="{{old('sub_service_url')}}" placeholder="Service URL" required>
                                                        @if ($errors->has('sub_service_url'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('sub_service_url') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="description" rows="5" placeholder="What would you like to see?" required>{{old('description')}}</textarea>
                                                    </div>
                                                </div>
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
     $("#sub_service").keyup(function(){
    var Text = $(this).val();
        $("#sub_service_url").val(Text);        
      });
      $( document ).ready(function() {
     <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

