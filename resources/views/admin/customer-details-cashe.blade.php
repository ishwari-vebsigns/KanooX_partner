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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Report</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Loan Report</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$user_loan->full_name}} Loan Report</a></li>
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
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('full_name', $user_loan->full_name)}}" name="user_name" placeholder="Enter a username.." readonly>
                                                        @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Father's name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('fname') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('full_name', $user_loan->fathers_name)}}" name="fname" placeholder="Enter a father's name.." readonly>
                                                        @if ($errors->has('fname'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('fname') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('contact_no', $user_loan->mobile)}}" id="val-phoneus" name="phone" placeholder="2129990000" readonly>
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
                                                        <input type="text" class="form-control" id="email" value="{{old('email', $user_loan->email)}}" name="email" placeholder="Your valid email.." required>
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
                                                        <input type="text" class="form-control" value="{{old('zip_code', $user_loan->zip_code)}}" id="val-range" name="pincode" placeholder="Your 6 digit Pincode" readonly>
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
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
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Monthly Take Home Salary
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('monthly_salary') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('month_one_net_salary', $user_loan->month_one_net_salary)}}" name="monthly_salary" placeholder="Your Monthly Take Home Salary" readonly>
                                                        @if ($errors->has('monthly_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('monthly_salary') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @foreach($user_loan->custdocument as $docs)
                                                <div class="input-group mb-3">
                                                    <iframe id="" style="margin:auto;max-height:300px;max-width:400px;" src="{{ $base_url }}/storage\app/{{$docs->document}}" alt=""></iframe>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Gender
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="gender" name="gender" >
                                                            <option value="">Please select</option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Employee Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="employee_type" name="employee_type" >
                                                            <option value="">Please select</option>
                                                            <option value="Salaried full-time">Salaried full-time</option>
                                                            <option value="Unemployed">Unemployed</option>
                                                            <option value="Self-Employed">Self-Employed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Address<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('address') ? 'has-error' : '' }}">
                                                        <textarea class="form-control" id="val-suggestions" name="address" rows="2" placeholder="Your address please..." readonly>{{$user_loan->residence_address}}</textarea>
                                                        @if ($errors->has('address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('city') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-website" value="{{old('city', $user_loan->city)}}" name="city" placeholder="Your city" readonly>
                                                        @if ($errors->has('city'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('state') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('state', $user_loan->state)}}" name="state" placeholder="Your state" readonly>
                                                        @if ($errors->has('state'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pancard No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('pan_card', $user_loan->pan_card)}}" name="pan_card" placeholder="Your PAN Number" readonly>
                                                        @if ($errors->has('pan_card'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pan_card') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Date of Birth
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('dob') ? 'has-error' : '' }}">
                                                        <input type="date" class="form-control" id="val-range" value="{{old('dob', $user_loan->dob)}}" name="dob" placeholder="Your Birth date" readonly>
                                                        @if ($errors->has('dob'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <!-- <button name ="save" type="submit" class="btn btn-success">Submit</button> -->
                                                        {{-- @foreach($user_loan->bankresponse as $response)
                                                            @if($response->statuscode == 200)
                                                                @if($response->filetype=="profile" && $response->message="Successfully Uploaded")   
                                                                @dd($response);
                                                                @endif    
                                                            @endif
                                                        @endforeach --}}
                                                        {{-- @dd($collectfiletype); --}}
                                                           
                                                            @if(!in_array("profile", $collectfiletype) || !in_array("pancard", $collectfiletype) || !in_array("bankStatement", $collectfiletype))
                                                                <a href="{{$base_url}}/admin/document-upload/{{$user_loan->loan_id}}" class="btn btn-dark">Upload Document</a>
                                                            @else
                                                            <a href="{{$base_url}}/admin/document-upload/{{$user_loan->loan_id}}" class="btn btn-dark">Update Document</a>

                                                            @endif
                                                        @if(Auth::user()->role_id == 1)
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
            $("#gender option[value={{$user_loan->gender}}]").prop('selected',true);
            $("#emp option[value={{$user_loan->profession_type}}]").prop('selected',true);

 <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
</script>
@endsection

