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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/help&support/all">Support</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Support</a></li>
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
                                <h4 class="card-title">Add Support</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class=""action="support" method="POST" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Loan ID<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('trans_id') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="trans_id" name="trans_id" placeholder="Loan ID ">
                                                        @if ($errors->has('trans_id'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('trans_id') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="service_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($services as $service)
                                                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Sub Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="sub_service_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($subservices as $service)
                                                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Problem
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="comment" required>
                                                            <option value="">Please select</option>
                                                            <option value="Not deducted money from account">Not deducted money from account</option>
                                                            <option value="Amount Debited from account">Amount Debited from account</option>
                                                            <option value="Amount not received">Amount not received</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Attach file (if Any)<!-- <span
                                                            class="text-danger">*</span> -->
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('file_image') ? ' has-error' : '' }}">
                                                        <input type="file" class="form-control" id="file_image" name="file_image"  accept="application/pdf, image/*">
                                                        @if ($errors->has('file_image'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('file_image') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Message <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="message" rows="5" placeholder="Message Here....." required></textarea>
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

