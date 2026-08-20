@extends('layouts.admin-app')
@section('content')
<style>
    video {
      width: 50%;
      height: auto;
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Get Training</a></li>
                        </ol>
                    </div>
                  </div>
                @if(Auth::user()->kyc_status==0 && Auth::user()->role_id==2)
                   <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
                @endif  
                
                {{-- <iframe width="620" height="345" src="https://www.youtube.com/embed/PUO5k6zlz9E">
                </iframe> --}}
               <div class="row">
                @foreach($trainings as $training)
                <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                  <div class="card mb-3">
                    <iframe class="card-img-top img-fluid" src="https://www.youtube.com/embed/{{$training->training_url}}">
                    </iframe>
                      <div class="card-header">
                          <h5 class="card-title">{{$training->training_name}}</h5>
                      </div>
                      <div class="card-body">
                          <p class="card-text">{{$training->description}}
                          </p>
                      </div>
                      <div class="card-footer">
                          {{-- <p class="card-text d-inline">Card footer</p> --}}
                          <a href="https://www.youtube.com/embed/{{$training->training_url}}" target="blank" class="card-link float-right">Card link</a>
                      </div>
                  </div>
              </div>
              @endforeach
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

@endsection

