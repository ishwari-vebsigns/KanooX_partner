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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add User</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="{{$user->id}}" method="post" enctype='multipart/form-data'>
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                @if(Auth::user()->role_id==1)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select User
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="role_id" name="role_id" required>
                                                            <option value="">Please select</option>
                                                            @foreach($roles as $role)
                                                            <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>{{$role->role}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">User Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('user_name',$user->name)}}" id="val-username" name="user_name" placeholder="Enter User Name">
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
                                                        <input type="text" class="form-control" value="{{old('phone',$user->contact_number)}}" id="val-phoneus" name="phone" placeholder="Enter Contact No.">
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
                                                        <input type="text" class="form-control" value="{{old('email',$user->email)}}" id="email" name="email" placeholder="Your valid email..">
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
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
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($user->is_active==1)
                                                        <button name="inactive" class="btn btn-danger">In-Active</button>
                                                        @else
                                                        <button name="active" class="btn btn-success">Active</button>
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
        
        <script>
    $("#role_id option[value={{$user->role_id}}]").prop('selected',true);

        </script>

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

