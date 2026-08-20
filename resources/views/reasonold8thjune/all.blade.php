@extends('layouts.admin-app')
@section('content')


   
    <!-- Datatable -->
    <link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{$base_url}}/css/style.css" rel="stylesheet">




    
    <!--**********************************
        Main wrapper start
    ***********************************-->
   

        <!--**********************************
            Nav header start
        ***********************************-->
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
      
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Report</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Service Report</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
               
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                 <P></P>              <h4 class="card-title">
                    <a href="add" style="color:white;" class="btn btn-secondary">Add Wallet Reason</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Wallet Reason Name</th>
                                                <th>Wallet Reason Amount</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($walletreasons as $walletreason)
                                            <tr>
                                                <td>{{$walletreason->reason_id}}</td>
                                                <td>{{$walletreason->reason_name}}</td>
                                                <td>{{$walletreason->amount}}</td>
                                                @php
                                                $newdate=date_format($walletreason->updated_at,"d-m-Y");    
                                                @endphp
                                                <td>{{$newdate}}</td>
                                                @if($walletreason->status_id==1)
                                                <td><span class="badge badge-success">Active</span></td>
                                                @else
                                                <td><span class="badge badge-danger">Inactive</span></td>
                                                @endif
                                                <td>
                                                    <a type="button" href="{{$walletreason->reason_id}}" class="btn btn-dark">Details</a>
                                                </td>
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
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
       
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

   
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
     {{-- <script src="{{$base_url}}/js/quixnav-init.js"></script> --}}
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>     --}}
    {{-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> --}}
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
    <!-- Datatable -->
    <script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>



@endsection