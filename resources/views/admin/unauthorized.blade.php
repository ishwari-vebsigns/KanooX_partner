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
                            @if(Auth::user()!=null)
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
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
                                    <div class="alert alert-dark notification" style="text-align: center;">
                                        <p class="notificaiton-title" style="text-align: center; font-size:20px;"><strong>Sorry! </strong> You dont have access for this page.
                                        </p>
                                        <p></p>
                                        <button class="btn btn-dark btn-sm rounded-0">Confirm</button>
                                        {{-- <button class="btn btn-link btn-sm">Cancel</button> --}}
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

