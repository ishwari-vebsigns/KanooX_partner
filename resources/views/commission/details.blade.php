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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Commission</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Commission</a></li>
                        </ol>
                    </div>
                </div>
 
@if(Auth::user()->kyc_status==0 && Auth::user()->role_id==2)
  <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
@endif   

                    
  
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Commission</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                <form class="" action="{{$check_commission->commission_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                              
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Sub Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="sub_service_id" name="sub_service_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($services as $service)
                                                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Bank
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="bank_id" name="bank_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($banks as $bank)
                                                            <option value="{{$bank->bank_id}}">{{$bank->bank_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Commission in Percentage<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('commission') ? ' has-error' : '' }}">
                                                        <input type="text" value="{{old('percent)', $check_commission->percent)}}" class="form-control" id="" name="commission" placeholder="Add Commission in Percentage...">
                                                        @if ($errors->has('commission'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('commission') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($check_commission->status_id ==0)
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        @else
                                                        <button name="inactive" class="btn btn-danger">In-Active</button>
                                                        @endif
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
    $("#sub_service_id option[value={{$check_commission->sub_service_id}}]").prop('selected',true);
    $("#bank_id option[value={{$check_commission->bank_id}}]").prop('selected',true);
    
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

