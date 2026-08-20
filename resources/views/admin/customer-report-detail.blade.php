@extends('layouts.admin-app')
@section('content')
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
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/report/customer-report">Loan Report</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$user_loan->full_name}} Loan Details</a></li>
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
                                    
                                    <form class="form-valide" action="{{$user_loan->loan_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Name of Customer
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" name="user_name" value="{{old('full_name', $user_loan->full_name)}}" placeholder="Enter a Name of Customer.." >
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
                                                        <input type="text" class="form-control" value="{{old('mobile', $user_loan->mobile)}}" id="val-phoneus" name="phone" placeholder="2129990000" >
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
                                                        <input type="text" class="form-control" id="email" value="{{old('email', $user_loan->email)}}" name="email" placeholder="Customer valid email.." >
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
                                                        <input type="text" class="form-control" value="{{old('zip_code', $user_loan->zip_code)}}" id="val-range" name="pincode" placeholder="Customer 6 digit Pincode" >
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Mother Maiden Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('mother_maiden_name') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('mother_maiden_name', $user_loan->mother_maiden_name)}}" name="mother_maiden_name" placeholder="Mother Maiden Name" >
                                                        @if ($errors->has('mother_maiden_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('mother_maiden_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Company Incorporation Date
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('company_incor_date') ? 'has-error' : '' }}">
                                                        <input type="date" class="form-control" id="val-range" value="{{old('company_incorporation_date', $user_loan->company_incorporation_date)}}" name="company_incor_date" placeholder="Customer Company Incorporation Date" >
                                                        @if ($errors->has('company_incor_date'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('company_incor_date') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Date of Birth
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('dob') ? 'has-error' : '' }}">
                                                        <input type="date" class="form-control" id="val-range" value="{{old('dob', $user_loan->dob)}}" name="dob" placeholder="Date of Birth" >
                                                        @if ($errors->has('dob'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Loan Amount
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('loan_amount') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('loan_amount', $user_loan->loan_amount)}}" name="loan_amount" placeholder="Your Loan amount" zip_code>
                                                        @if ($errors->has('loan_amount'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('loan_amount') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Residential Address/ Mailing Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('residential_address') ? 'has-error' : '' }}">
                                                        <textarea class="form-control" id="val-suggestions" name="residential_address" rows="3" placeholder="Residential Address/ Mailing Address please..." >{{$user_loan->residence_address}}</textarea>
                                                        @if ($errors->has('residential_address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('residential_address') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Company Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('company_address') ? 'has-error' : '' }}">
                                                        <textarea class="form-control" id="val-suggestions" name="company_address" rows="3" placeholder="Company address please..." >{{$user_loan->office_address}}</textarea>
                                                        @if ($errors->has('company_address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('company_address') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Permanent Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('permanent_address') ? 'has-error' : '' }}">
                                                        <textarea class="form-control" id="val-suggestions" name="permanent_address" rows="3" placeholder="Permanent address please..." >{{$user_loan->permanent_address}}</textarea>
                                                        @if ($errors->has('permanent_address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('permanent_address') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">GST No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('gst_no', $user_loan->gst_no)}}" name="gst_no" placeholder="GST Number" >
                                                        @if ($errors->has('gst_no'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('gst_no') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        @if(Auth::user()->role_id == 1)
                                                        <button name="save" class="btn btn-success">Save</button>
                                                        @if($user_loan->status_id==0)
                                                        <button type="submit" name="approve" class="btn btn-primary">Approve</button>
                                                        
                                                        @endif
                                                        @if($user_loan->status_id==1)
                                                        {{-- <button class="btn btn-success">Approved</button> --}}

                                                        <button name="disburse" class="btn btn-info">Disburse</button>
                                                        <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                                        @endif
                                                        @if($user_loan->status_id==3)
                                                            <button name="sanction" class="btn btn-warning">Sanction</button>
                                                        @endif
                                                        @if($user_loan->status_id==2)
                                                        <button type="submit" class="btn btn-danger">Rejected</button>
                                                        @endif
                                                        @if($user_loan->status_id==0)
                                                        <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                                        @endif
                                                         @if($errors->any())
                                                        <strong>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </strong>
                                                        @endif
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
        <script class="">
 @if(session()->has('success'))
    document.querySelector(".sweet-success").onclick = function () {
        swal("Hey, Good job !!", "You clicked the button !!", "success");
    };
@endif

</script>

@endsection

