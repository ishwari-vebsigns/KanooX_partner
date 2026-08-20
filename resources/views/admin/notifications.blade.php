@extends('layouts.admin-app')
@section('content')


   
    <!-- Datatable -->
    <link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{$base_url}}/css/style.css" rel="stylesheet">

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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Notification</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">All Notification</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
              @foreach($mnotifications as $notification)
              @if($notification->type==1)
              <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card text-white bg-warning">
                    <div class="card-header">
                        <h5 class="card-title text-white">{{$notification->title}}</h5>
                    </div>
                    <div class="card-body mb-0">
                        <p class="card-text">{{$notification->description}}</a>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-white">
                        @php
                          $newdate=date_format($notification->updated_at,"d-m-Y");    
                        @endphp
                        {{$newdate}}
                    </div>
                </div>
              </div>
              @endif
              @if($notification->type==2)
              <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card text-white bg-info">
                    <div class="card-header">
                        <h5 class="card-title text-white">{{$notification->title}}</h5>
                    </div>
                    <div class="card-body mb-0">
                        <p class="card-text">{{$notification->description}}</a>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-white">
                        @php
                        $newdate=date_format($notification->updated_at,"d-m-Y");    
                      @endphp
                      {{$newdate}}
                    </div>
                </div>
            </div>
              @endif
              @if($notification->type==3)
              <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card text-white bg-danger">
                    <div class="card-header">
                        <h5 class="card-title text-white">{{$notification->title}}</h5>
                    </div>
                    <div class="card-body mb-0">
                        <p class="card-text">{{$notification->description}}</a>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-white">@php
                        $newdate=date_format($notification->updated_at,"d-m-Y");    
                      @endphp
                      {{$newdate}}
                    </div>
                </div>
            </div>
              @endif
               @if($notification->type==4)
                <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                    <div class="card mb-3">
                        <img class="card-img-top img-fluid" src="{{$base_url}}/storage/app/{{$notification->image}}" alt="Card image cap">
                        <div class="card-header">
                            <h5 class="card-title">{{$notification->title}}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$notification->description}}</p>
                            <p class="card-text text-dark">@php
                                $newdate=date_format($notification->updated_at,"d-m-Y");    
                              @endphp
                              {{$newdate}}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if($notification->type==5)
                <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                  <div class="card text-white bg-primary">
                      <div class="card-header">
                          <h5 class="card-title text-white">{{$notification->title}}</h5>
                      </div>
                      <div class="card-body mb-0">
                          <p class="card-text">{{$notification->description}}</a>
                      </div>
                      <div class="card-footer bg-transparent border-0 text-white">@php
                        $newdate=date_format($notification->updated_at,"d-m-Y");    
                      @endphp
                      {{$newdate}}
                      </div>
                  </div>
              </div>
              @endif
               @endforeach
            </div>
        </div>
    </div>


    <script src="{{$base_url}}/js/quixnav-init.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>    


    <!-- Datatable -->
    <script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>



@endsection