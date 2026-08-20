@extends('layouts.admin-app')
@section('content')
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
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer OTP</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer OTP</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="" action="{{$customer->loan_signin_id}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Customer OTP
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                      <input type="hidden" class="form-control" id="val-range" value="{{$id}}" name="id" placeholder="Your 4 digit OTP" required>
                                                        <input type="text" class="form-control" id="val-range" value="{{$customer->otp}}" name="otp" placeholder="Your 4 digit OTP" required>
                                                        @if ($errors->any())
                                                        <span class="help-block">
                                                          @foreach ($errors->all() as $error)
                                                            <strong>{{ $error }}</strong>
                                                          @endforeach
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="button" id="resendOtpBtn" class="btn btn-secondary">Resend OTP</button>
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
            $(document).ready(function() {
            $('#resendOtpBtn').click(function() {
            $.ajax({
            url: "{{ route('resendOtp') }}", // Replace with your route
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                customer_id: "{{$customer->loan_signin_id}}"
            },

            success: function(response) {
                // Handle the response, e.g., display a success message

                alert('OTP resent successfully.');
            },
            error: function(xhr, status, error) {
                    var responseText = xhr.responseText;
                    var jsonStartIndex = responseText.indexOf('{');
                    var errorMessage = responseText.substring(0, jsonStartIndex).trim();

                    alert(errorMessage);
                }
        });
    });
});

        </script>
@endsection

