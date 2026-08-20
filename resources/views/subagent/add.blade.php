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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/sub-agent/all">Subagents</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Sub Agent</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Sub Agent</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="add" method="post" enctype='multipart/form-data'>
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                @if(Auth::user()->role_id==1)
                                                {{-- <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Refer Code (Optional)
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('refer_code') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('refer_code')}}" name="refer_code" placeholder="Enter Refered code">
                                                        @if ($errors->has('refer_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('refer_code') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                   
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Super Agent
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="agent_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($agents as $agent)
                                                            <option value="{{ $agent->id }}" {{ old('id') == $agent->id ? 'selected' : '' }}>{{$agent->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Sub Agent Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('user_name')}}" id="val-username" name="user_name" placeholder="Enter Sub Agent Name">
                                                        @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('phone')}}" id="val-phoneus" name="phone" placeholder="Enter contact number">
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
                                                        <input type="text" class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="Your valid email..">
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
                                                        <input type="text" class="form-control" value="{{old('pincode')}}" id="val-range" name="pincode" placeholder="Your 6 digit Pincode" required>
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('bank_name')}}" name="bank_name" placeholder="Agent bank name" required>
                                                        @if ($errors->has('bank_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Account Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_account_number') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('bank_account_number')}}" name="bank_account_number" placeholder="Bank Account Number" required>
                                                        @if ($errors->has('bank_account_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('ifsc_code')}}" name="ifsc_code" placeholder="Enter IFSC Code" required>
                                                        @if ($errors->has('ifsc_code'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc_code') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">KYC Video(should be less than 5MB)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('kyc_video') ? ' has-error' : '' }}">
                                                        <input type="file" class="form-control" accept="video/*" id="val-range" name="kyc_video" id="kyc_video">
                                                         @if ($errors->has('kyc_video'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('kyc_video') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Front
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_front') ? ' has-error' : '' }}">
                                                   
                                                        
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_front" accept="image/*" id="aadhar_front">
                                                        @if ($errors->has('aadhar_front'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('aadhar_front') }}</strong>
                                                        </span> 
                                                        @endif
                                                   
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Back
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_back') ? ' has-error' : '' }}">
                                                   
                                                   
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_back" accept="image/*" id="aadhar_back">
                                                        @if ($errors->has('aadhar_back'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('aadhar_back') }}</strong>
                                                        </span> 
                                                        @endif
                                                  
                                                    </div>
                                                </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="val-range">Pan Card
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                                                       
                                                     
                                                            <input type="file" class="form-control" id="val-range" name="pan_card" accept="image/*" id="pan_card">
                                                            @if ($errors->has('pan_card'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('pan_card') }}</strong>
                                                            </span> 
                                                            @endif
                                                       
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="val-range">Create Password
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6 {{ $errors->has('password') ? 'has-error' : '' }}">
                                                            <input type="password" class="form-control" id="val-range" name="password" placeholder="Enter Password">
                                                            @if ($errors->has('password'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                            </span> 
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="val-range">Confirm Password
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6 {{ $errors->has('c_password') ? 'has-error' : '' }}">
                                                            <input type="password" class="form-control" id="val-range" name="c_password" placeholder="Enter Password again">
                                                            @if ($errors->has('c_password'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('c_password') }}</strong>
                                                            </span> 
                                                            @endif
                                                        </div>
                                                    </div>
                                                   
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                       
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
             const fileInput = document.getElementById('aadhar_front');
    const fileLabel = document.querySelector('label[for="aadhar_front"]');
    
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            fileLabel.innerText = fileInput.files[0].name;
        } else {
            fileLabel.innerText = 'Choose Aadhar Front Image';
        }
    });
        </script>
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

