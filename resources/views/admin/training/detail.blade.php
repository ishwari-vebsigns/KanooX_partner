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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Training</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Training URL</a></li>
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
                                <h4 class="card-title">Edit Traing URL</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="{{$training->training_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Training Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('training_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('training_name',$training->training_name)}}" id="training_name" name="training_name" placeholder="Training Name " required>
                                                        @if ($errors->has('training_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('training_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Training Youtube URL
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('training_url') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('training_url',$training->training_url)}}" id="training_url" name="training_url" placeholder="Please enter only URL Code" required>
                                                        @if ($errors->has('training_url'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('training_url') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="description" rows="5" placeholder="What would you like to see?" required>{{old('description',$training->description)}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($training->status_id ==0)
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        @endif
                                                        @if($training->status_id ==1)
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

