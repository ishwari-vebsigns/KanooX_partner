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
                    {{-- <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Details</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">My Details</a></li>
                        </ol>
                    </div> --}}
                </div>  
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        {{-- <div class="card-header d-block">
                            <h4 class="card-title">Alert left icon big </h4>
                            <p class="mb-0 subtitle">add <code>.left-icon-big</code> to change the style</p>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                               
                                <div class="col-xl-12">
                                    <div class="alert alert-warning left-icon-big alert-dismissible fade show">
                                        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button> --}}
                                        <div class="media">
                                            <div class="alert-left-icon-big">
                                                <span><i class="mdi mdi-help-circle-outline"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="mt-1 mb-1">Pending!</h5>
                                                <p class="mb-2">Your KYC Approval is Pending!</p>
                                                <a href="{{$base_url}}/admin/agent-profile" class="btn btn-light btn-sm text-warning">KYC Now </a>
                                            </div>
                                        </div>
                                    </div>
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
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");
    
});
</script>

@endsection

