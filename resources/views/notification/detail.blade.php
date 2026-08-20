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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/notification/all">Notifications</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Notification</a></li>
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
                                <h4 class="card-title">Edit Notification</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="{{$notification->notification_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Notification Title <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('notification_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('title',$notification->title)}}" id="notification_name" name="notification_name" placeholder="Notification Title" required>
                                                        @if ($errors->has('notification_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('notification_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Notification Image
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                                                        <div class="col-md-12 p-3 product-div">
                                                            <img class="img-fluid" src="{{$base_url}}/storage\app/{{$notification->image}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">
                                                          </div>
                                                        <input type="file" class="form-control" id="image" name="image" placeholder="">
                                                        @if ($errors->has('image'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Notification Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="type" name="type" required>
                                                            <option value="">Please select</option>
                                                            <option value="1">Alert</option>
                                                            <option value="2">Information</option>
                                                            <option value="3">Emergancy</option>
                                                            <option value="4">Image</option>
                                                            <option value="5">Primary</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="description" rows="5" placeholder="What would you like to see?" required>{{old('title',$notification->description)}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($notification->status_id ==0)
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        @endif
                                                        @if($notification->status_id ==1)
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
   $("#type option[value={{$notification->type}}]").prop('selected',true);
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

