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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Bank Details</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Bank Details</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="{{$bank->bank_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                            <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number"><span
                                                            class="text-danger"></span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                                    <img class="img-fluid" src="{{$base_url}}/storage\app/{{$bank->bank_image}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">
                                                    </div>
                                                </div>
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Bank Image/Logo <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">

                                                        <input type="file" class="form-control" id="sub_service_image" name="logo">
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
                                                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{old('bank_name)', $bank->bank_name)}}" placeholder="Bank Name">
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
           value="{{ old('effective_interest_range', $bank->effective_interest_range) }}"
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
           value="{{ old('age_limit', $bank->age_limit) }}"
           placeholder="25 years"
           required>
  </div>
</div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea name="desc" class="form-control" id="val-suggestions" name="desc"  rows="5" placeholder="What would you like to see?">{{$bank->description}}
                                                        </textarea>
                                                    </div>
                                                </div>
             <div class="form-group row">
    <!--<label>Know More Description</label>-->
    <label class="col-lg-4 col-form-label">Know More Description </label>
    <div class="col-lg-6">
    <textarea
        name="know_more_description"
        class="form-control"
        rows="6"
    >{{ old('know_more_description', $bank->know_more_description) }}</textarea>
    </div>
</div>

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($bank->is_active ==0)
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        @endif
                                                        @if($bank->is_active ==1)
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Sub-Service for {{$bank->bank_name}}</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="{{$bank->bank_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                            
                                              
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" name="sub_service_id" id="service_id">
                                                            <option value="">Please select</option>
                                                            @foreach($services as $service)
                                                            <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                               
                                                <div class="form-group row">
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
                                                        <input type="text" class="form-control" id="bank_url" value ="{{old('bank_url')}}" name="bank_url" placeholder="Bank URL">
                                                        @if ($errors->has('bank_url'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_url') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                 @if($errors->any())
                                                        <strong>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </strong>
                                                    @endif
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="add-service" type="submit" class="btn btn-primary">Submit</button>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$bank->bank_name}} Services</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Service</th>
                                                <th>Bank Name</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($banks as $bank)
                                            <tr>
                                                <td>{{$bank->bank_subservice_id}}</td> 
                                                <td>{{$bank->service->service_name}}</td>
                                                <td>{{$bank->bank->bank_name}}</td>
                                                @php
                                                $newdate=date_format($bank->service->updated_at,"d-m-Y");    
                                                @endphp
                                                <td>{{$newdate}}</td>
                                                @if($bank->status_id==1)
                                                <td><span class="badge badge-success">Active</span></td>
                                                @else
                                                <td><span class="badge badge-danger">Inactive</span></td>
                                                @endif
                                                <td><a type="button" href="{{$bank->bank_id}}/{{$bank->bank_subservice_id}}" class="btn btn-dark">Details</a></td>
                                            </tr>
                                            @endforeach
                                           
                                        
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">
        <script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
       
    <script>
       $( document ).ready(function() {
        @if(session('success'))
        toastr.success("{{Session::get('success')}}", "Success!", {
                        timeOut: 5e3,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        positionClass: "toast-top-right",
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1
                    })
        @endif   
        @php
        session()->forget('success');
        @endphp
    });
    </script>
<script class="">
  // alert();
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
</script>

<link href="{{$base_url}}/css/style.css" rel="stylesheet">
<script src="{{$base_url}}/js/quixnav-init.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>    


<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>
    <link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection

