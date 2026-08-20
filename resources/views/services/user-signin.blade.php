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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Apply</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Details</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="{{$id}}" action="#" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Customer Contact Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-number" value="{{old('contact_no')}}" name="contact_no" placeholder="Enter Contact No." onchange="checkCustomer()">
                                                        <span id="phone-error" class="help-block"></span>
                                                        @if ($errors->has('contact_no'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('contact_no') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Customer Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="customer-name" value="{{old('customer_name')}}" name="customer_name" placeholder="Enter Customer Name">
                                                        @if ($errors->has('customer_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('customer_name') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Customer Pincode <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="pincode" value="{{old('pincode')}}" name="pincode" placeholder="Your 6 digit Pincode" required>
                                                        @if ($errors->has('pincode'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('pincode') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                 @if($id==6)
                                                  <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Company Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="company_name" value="{{old('company_name')}}" name="company_name" placeholder="Customer Company Name" required>
                                                        @if ($errors->has('company_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('company_name') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>

                                                 <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Customer Salary <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="salary" value="{{old('salary')}}" name="salary" placeholder="Customer Salary" required>
                                                        @if ($errors->has('salary'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('salary') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                 @endif

                                                   @if($id==61)
                                                  <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Annual Turnover (In Lakhs)<span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="annual_turnover" value="{{old('annual_turnover')}}" name="annual_turnover" placeholder="Company Annual Turnover (In Lakhs)" required>
                                                        @if ($errors->has('annual_turnover'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('annual_turnover') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>

                                                 <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Vintage Company (In Months) <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="vintage" value="{{old('vintage')}}" name="vintage" placeholder="Vintage Company (In Months)" required>
                                                        @if ($errors->has('vintage'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('vintage') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                 @endif

                                                 <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Loan Amount <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="number" class="form-control" id="loan_amount" value="{{old('loan_amount')}}" name="loan_amount" placeholder="Loan Amount" required>
                                                        @if ($errors->has('loan_amount'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('loan_amount') }}</strong>
                                                            </span> 
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
            function checkCustomer() {
                var phone = $('#val-number').val();
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: '{{ route('check-customer') }}',
                    method:'post',
                    data: {
                        _token: token,
                        phone: phone
                    },
                    success: function(response) {
                        if (response.name && response.pincode) {
                            $('#customer-name').val(response.name);
                            $('#pincode').val(response.pincode);
                             $('#salary').val(response.salary);
                             $('#company_name').val(response.company_name);
                             $('#annual_turnover').val(response.annual_turnover);
                             $('#vintage').val(response.vintage);
                             $('#loan_amount').val(response.loan_amount);
                        } else {
                            $('#customer-name').val('');
                            $('#pincode').val('');
                             $('#salary').val('');
                             $('#company_name').val('');
                             $('#annual_turnover').val('');
                             $('#vintage').val('');
                             $('#loan_amount').val('');
                        }
                        $('#phone-error').text('');
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors
                        $('#customer-name').val('');
                        $('#pincode').val('');
                        // $('#phone-error').text('Error occurred while checking customer.');
                        $('#phone-error').text('');
                    }
                });
            }
        </script>
@endsection

