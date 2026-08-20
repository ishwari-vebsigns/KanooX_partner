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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Register</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Registration</a></li>
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
                                    @if(Auth::user()!=null)
                                    <form class="form-valide" action="apply-user" method="post" enctype='multipart/form-data'>
                                    @else
                                    <form class="form-valide" action="apply-user?access_code={{$code}}" method="post" enctype='multipart/form-data'>
                                    @endif
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('user_name', $user_loan->customer_name)}}" name="user_name" placeholder="Enter a username.." >
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
                                                        <input type="text" class="form-control" value="{{old('contact_no', $user_loan->contact_no)}}" id="val-phoneus" name="phone" placeholder="2129990000" >
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
                                                        <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Your valid email.." >
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
                                                        <input type="text" class="form-control" value="{{old('pincode', $user_loan->pincode)}}" id="val-range" name="pincode" placeholder="Your 6 digit Pincode" >
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
                                                        <input type="text" class="form-control" id="val-range" value="{{old('loan_amount')}}" name="loan_amount" placeholder="Your Loan amount" >
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
                                                        <input type="text" class="form-control" id="val-range" value="{{old('monthly_salary')}}" name="monthly_salary" placeholder="Your Monthly Take Home Salary" >
                                                        @if ($errors->has('monthly_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('monthly_salary') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Gender
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="gender" name="gender" >
                                                            <option value="">Please select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Employee Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="employee_type" >
                                                            <option value="">Please select</option>
                                                            <option value="Salaried full-time">Salaried full-time</option>
                                                            <option value="Unemployed">Unemployed</option>
                                                            <option value="Self-Employed">Self-Employed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Salary Received Type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="salary_type" >
                                                            <option value="">Please select</option>
                                                            <option value="1">Cash</option>
                                                            <option value="2">Cheque</option>
                                                            <option value="3">Direct Account Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Company Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('locality') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('company_name')}}" name="company_name" placeholder="Enter a Company name..">
                                                        @if ($errors->has('company_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">House No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('locality') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('address1')}}" name="address1" placeholder="Enter a House No.">
                                                        @if ($errors->has('address1'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('address1') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Address Line 2
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('address2') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('address2')}}" name="address2" placeholder="Enter Area, City.">
                                                        @if ($errors->has('address2'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('address2') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Locality
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('locality') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" value="{{old('locality')}}" name="locality" placeholder="Enter a Locality name..">
                                                        @if ($errors->has('locality'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('locality') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="state" >
                                                            <option value="">Please select</option>
                                                            <option value="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</option>
                                                            <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                                            <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                                            <option value="ASSAM">ASSAM</option>
                                                            <option value="BIHAR">BIHAR</option>
                                                            <option value="CHANDIGARH">CHANDIGARH</option>
                                                            <option value="CHATTISGARH">CHATTISGARH</option>
                                                            <option value="DADRA & NAGAR HAVELI">DADRA & NAGAR HAVELI</option>
                                                            <option value="DAMAN & DIU">DAMAN & DIU</option>
                                                            <option value="DELHI">DELHI</option>
                                                            <option value="GOA">GOA</option>
                                                            <option value="GUJARAT">GUJARAT</option>
                                                            <option value="HARYANA">HARYANA</option>
                                                            <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                                            <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                                                            <option value="JHARKHAND">JHARKHAND</option>
                                                            <option value="KARNATAKA">KARNATAKA</option>
                                                            <option value="KERALA">KERALA</option>
                                                            <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                                                            <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                                            <option value="MAHARASHTRA">MAHARASHTRA</option>
                                                            <option value="MANIPUR">MANIPUR</option>
                                                            <option value="Megalaya">Megalaya</option>
                                                            <option value="MEGHALAYA">MEGHALAYA</option>
                                                            <option value="MIZORAM">MIZORAM</option>
                                                            <option value="NAGALAND">NAGALAND</option>
                                                            <option value="ODISHA">ODISHA</option>
                                                            <option value="PUNJAB">PUNJAB</option>
                                                            <option value="RAJASTHAN">RAJASTHAN</option>
                                                            <option value="SIKKIM">SIKKIM</option>
                                                            <option value="TAMIL NADU">TAMIL NADU</option>
                                                            <option value="TELANGANA">TELANGANA</option>
                                                            <option value="TRIPURA">TRIPURA</option>
                                                            <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                                            <option value="UTTARAKHAND">UTTARAKHAND</option>
                                                            <option value="WEST BENGAL">WEST BENGAL</option>
                                                            
                                                        </select>
                                                        @if ($errors->has('state'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('city') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-website" value="{{old('city')}}" name="city" placeholder="Your city" >
                                                        @if ($errors->has('city'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pancard No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('pan_card')}}" name="pan_card" placeholder="Your PAN Number" onkeyup="convertToUppercase(this)">
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
                                                        <input type="date" class="form-control" id="val-range" value="{{old('dob')}}" name="dob" placeholder="Your Birth date" >
                                                        @if ($errors->has('dob'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name ="save" type="submit" class="btn btn-primary">Submit</button>
                                                        <button name ="cancel" type="submit" class="btn btn-light">Cancel</button>
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
    function convertToUppercase(input) {
        input.value = input.value.toUpperCase();
    }
</script>
    <script class="">
        <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
        
        @if(session()->has('error'))
        swal("OHH !!", "{{ Session::get('error') }}", "error");
        @php
            session()->forget('error');
        @endphp
        @endif
    </script>
@endsection

