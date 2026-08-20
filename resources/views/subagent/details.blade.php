@extends('layouts.admin-app')
@section('content')
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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/sub-agent/all">Sub Agents</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$agent->subagent->name}} Details</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$agent->subagent->name}} Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="{{$agent->subagent->id}}" method="post" enctype='multipart/form-data'>
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('name', $agent->subagent->name)}}" id="val-username" name="user_name" placeholder="Enter a username..">
                                                        @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Agent ID(Auto Generated)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('agent_id') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('new_id', $agent->subagent->new_id)}}" name="agent_id" placeholder="" readonly>
                                                        @if ($errors->has('agent_id'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('agent_id') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Agent Access Code(Auto Generated)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('agent_id') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('agent_access_code', $agent->subagent->agent_access_code)}}" name="agent_access_code" placeholder="" readonly>
                                                        @if ($errors->has('agent_id'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('agent_id') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('contact_number', $agent->subagent->contact_number)}}" id="val-phoneus" name="phone" placeholder="2129990000">
                                                        @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('email', $agent->subagent->email)}}" id="email" name="email" placeholder="Your valid email..">
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('pincode', $agent->subagent->pincode)}}" id="val-range" name="pincode" placeholder="Your 6 digit Pincode" required>
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($agent_bank!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('bank_name', $agent_bank->bank_name)}}" name="bank_name" placeholder="Agent bank name" required>
                                                        @if ($errors->has('bank_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="" name="bank_name" placeholder="Agent bank name" required>
                                                        @if ($errors->has('bank_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($agent_bank!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Account Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_account_number') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('bank_account_number', $agent_bank->bank_account_number)}}" name="bank_account_number" placeholder="Bank Account Number" required>
                                                        @if ($errors->has('bank_account_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Account Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_account_number') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="" name="bank_account_number" placeholder="Bank Accound Number" required>
                                                        @if ($errors->has('bank_account_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($agent_bank!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('ifsc_code', $agent_bank->ifsc_code)}}" name="ifsc_code" placeholder="Your Monthly Take Home Salary" required>
                                                        @if ($errors->has('ifsc_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc_code') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="" name="ifsc_code" placeholder="IFSC Code" required>
                                                        @if ($errors->has('ifsc_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc_code') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">KYC Video
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_front') ? ' has-error' : '' }}">
                                                    @if($agent->subagent->kyc_status==1 || $agent->subagent->video_kyc!=null)
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="{{$base_url}}/storage\app/{{$agent->subagent->video_kyc}}">
                                                            </iframe>
                                                        </div>
                                                    @else
                                                    <label class="col-lg-10 col-form-label" for="val-range">KYC Video Not Uploaded!!!
                                                        {{-- <span class="text-danger">*</span> --}}
                                                    </label>
                                                    @endif
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Front
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_front') ? ' has-error' : '' }}">
                                                    @if($agent->subagent->kyc_status==1 || $agent->subagent->aadhar_front!=null)
                                                        <div class="col-md-12 p-0 product-div">
                                                          <!--<img class="img-fluid" src="{{$base_url}}/storage\app/{{$agent->subagent->aadhar_front}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">-->
                                                          <a href="{{$base_url}}/storage/app/{{$agent->subagent->aadhar_front}}" target="_blank">
    <img class="img-fluid"
         src="{{$base_url}}/storage/app/{{$agent->subagent->aadhar_front}}"
         style="margin:auto;max-height:200px;max-width:200px;">
</a>
                                                        </div>
                                                    @endif
                                                    @if(Auth::user()->role_id==1)
                                                        @if($agent->subagent->kyc_status==0 || $agent->subagent->aadhar_front==null)
                                                            <input type="file" class="form-control" id="val-range" name="aadhar_front">
                                                            @if ($errors->has('aadhar_front'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('aadhar_front') }}</strong>
                                                            </span> 
                                                            @endif
                                                        @endif
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Back
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_back') ? ' has-error' : '' }}">
                                                    @if($agent->subagent->kyc_status==1 || $agent->subagent->aadhar_back!=null)
                                                        <div class="col-md-12 p-0 product-div">
                                                          <!--<img class="img-fluid" src="{{$base_url}}/storage\app/{{$agent->subagent->aadhar_back}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">-->
                                                          <a href="{{$base_url}}/storage/app/{{$agent->subagent->aadhar_back}}" target="_blank">
    <img class="img-fluid"
         src="{{$base_url}}/storage/app/{{$agent->subagent->aadhar_back}}"
         style="margin:auto;max-height:200px;max-width:200px;">
</a>
                                                        </div>
                                                    @endif
                                                    @if(Auth::user()->role_id==1)
                                                         @if($agent->subagent->kyc_status==0 || $agent->subagent->aadhar_back==null)
                                                            <input type="file" class="form-control" id="val-range" name="aadhar_back">
                                                            @if ($errors->has('aadhar_back'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('aadhar_back') }}</strong>
                                                            </span> 
                                                            @endif
                                                        @endif
                                                    @endif
                                                    </div>
                                                </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="val-range">Pan Card
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                                                        @if($agent->subagent->kyc_status==1 || $agent->subagent->pan_card!=null)
                                                            <div class="col-md-12 p-0 product-div">
                                                              <!--<img class="img-fluid" src="{{$base_url}}/storage\app/{{$agent->subagent->pan_card}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">-->
                                                              <a href="{{$base_url}}/storage/app/{{$agent->subagent->pan_card}}" target="_blank">
    <img class="img-fluid"
         src="{{$base_url}}/storage/app/{{$agent->subagent->pan_card}}"
         style="margin:auto;max-height:200px;max-width:200px;">
</a>
                                                            </div>
                                                        @endif
                                                        @if(Auth::user()->role_id==1)
                                                            @if($agent->subagent->kyc_status==0 || $agent->subagent->pan_card==null)
                                                                <input type="file" class="form-control" id="val-range" name="pan_card">
                                                                @if ($errors->has('pan_card'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('pan_card') }}</strong>
                                                                </span> 
                                                                @endif
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        @if(Auth::user()->role_id==1)
                                                            <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                            @if($agent->subagent->kyc_status!=1)
                                                            <button name="kyc" class="btn btn-success">Approve KYC</button>
                                                            @endif
                                                            @if($agent->subagent->video_kyc==null)
                                                            {{-- <button name="nokyc" class="btn btn-danger">KYC Video Not available</button> --}}
                                                            @endif
                                                            @if($agent->subagent->kyc_status==1)
                                                            {{-- <button class="btn btn-success"></button> --}}
                                                            <span class="label mb-xl-2 label-pill label-success">KYC Approved!!</span>
                                                            @endif
                                                        @endif
                                                        {{-- <button name="inactive" class="btn btn-danger">In-Active</button> --}}
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
        

        <link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">
        <script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    
        
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
 {{-- <script>
    $(document).ready(function() {
   
  
    var table = $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        columns: [
            { data: "loan_id" },
            { data: "email" },
            {data: "full_name"},
            { data: "mobile" },
            { data: "loan_amount" },
            {
                data: null,
                render: function(data, type, row) {
                    
                    
                        return '<span class="badge badge-success">Pending</span>'

                    
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    
                   
                        return '<a type="button" href="customer-report/' + data.loan_id + '" class="btn btn-dark">Details</a>'
                   
                  
                }
            },
           
        ]
    });
           
    // Fetch data using AJAX
			

    $.ajax({
        url: '{{$agent->id}}/allData',
        method: 'GET',
        success: function(response) {
            var newData = response.data;
            table.rows.add(newData).draw();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });

    // Convert table data to Excel format
    function convertToExcel() {
        var workbook = XLSX.utils.table_to_book(document.getElementById('example'), { sheet: 'Sheet 1' });
        var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
        return excelData;
    }

    // Generate and download the Excel file
    function downloadExcel() {
        var excelData = convertToExcel();
        var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'data.xlsx';
        a.click();
        URL.revokeObjectURL(url);
    }

    // Attach event listener to download button
    $('#downloadButton').on('click', downloadExcel);

   
		});


 </script>
     --}}
<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    
    <script src="{{$base_url}}/vendor/moment/moment.min.js"></script>
    <script src="{{$base_url}}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- clockpicker -->
    <script src="{{$base_url}}/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <!-- asColorPicker -->
    <script src="{{$base_url}}/vendor/jquery-asColor/jquery-asColor.min.js"></script>
    <script src="{{$base_url}}/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
    <script src="{{$base_url}}/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
    <!-- Material color picker -->
    <script src="{{$base_url}}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- pickdate -->
    <script src="{{$base_url}}/vendor/pickadate/picker.js"></script>
    <script src="{{$base_url}}/vendor/pickadate/picker.time.js"></script>
    <script src="{{$base_url}}/vendor/pickadate/picker.date.js"></script>



    <!-- Daterangepicker -->
    <script src="{{$base_url}}/js/plugins-init/bs-daterange-picker-init.js"></script>
    <!-- Clockpicker init -->
    <script src="{{$base_url}}/js/plugins-init/clock-picker-init.js"></script>
    <!-- asColorPicker init -->
    <script src="{{$base_url}}/js/plugins-init/jquery-asColorPicker.init.js"></script>
    <!-- Material color picker init -->
    <script src="{{$base_url}}/js/plugins-init/material-date-picker-init.js"></script>
    <!-- Pickdate -->
    <script src="{{$base_url}}/js/plugins-init/pickadate-init.js"></script>



@endsection

