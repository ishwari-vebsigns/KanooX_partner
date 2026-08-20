@extends('layouts.admin-app')
@section('content')


{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Details</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">My Details</a></li>
                        </ol>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="update-profile" method="post" enctype='multipart/form-data'>
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                                        <input type="text" value="{{old('$user->name',$user->name)}}" class="form-control" id="val-username" name="name" placeholder="Enter a username..">
                                                        @if ($errors->has('name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                                @if($user->contact_number!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-phoneus" name="phone_number" value="{{old('$user->contact_number',$user->contact_number)}}" placeholder="2129990000" readonly required>
                                                        @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-phoneus" name="phone_number" value="{{old('$user->contact_number',$user->contact_number)}}" placeholder="2129990000">
                                                        @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($user->email!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="email" name="email" value="{{old('$user->email',$user->email)}}" placeholder="Your valid email.." required>
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="email" name="email" value="{{old('$user->email',$user->email)}}" placeholder="Your valid email..">
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($user->pincode!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" name="pincode" value="{{old('$user->pincode',$user->pincode)}}" placeholder="Your 6 digit Pincode" required readonly>
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" name="pincode" value="" placeholder="Your 6 digit Pincode" required>
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Front
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_front') ? ' has-error' : '' }}">
                                                    @if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1)
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="{{$base_url}}/storage\app/{{$user->aadhar_front}}">
                                                            </iframe>
                                                          {{-- <img class="img-fluid" src="{{$base_url}}/storage\app/{{$user->aadhar_front}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';"> --}}
                                                        </div>
                                                    @endif
                                                    @if(Auth::user()->aadhar_front==null)
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_front">
                                                        @if ($errors->has('aadhar_front'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('aadhar_front') }}</strong>
                                                        </span> 
                                                        @endif
                                                    @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                                                @if(Auth::user()->video_kyc==null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Upload KYC video(upload video with holding aadhar card or PAN card & Max. file size 5MB)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                    
                                                    
                                                        <input type="file" class="form-control" id="val-range" name="video_kyc" required>
                                                        @if ($errors->has('video_kyc'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('video_kyc') }}</strong>
                                                        </span> 
                                                    @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">KYC video
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    @if(Auth::user()->kyc_status==0)
                                                    <div class="col-lg-8 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                                                        <!-- <label class="col-lg-4 col-form-label" for="val-range">KYC video Upload wait for the approval!
                                                        </label> -->
                                                         <iframe width="320" height="200" src="{{$base_url}}/storage\app/{{$user->video_kyc}}">
                                                            </iframe>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-8 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                                                        <label class="col-lg-4 col-form-label" for="val-range">KYC approved!
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif
                                                @endif
                                            </div>
                                            <div class="col-xl-6">
                                                @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                                              <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Back
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('aadhar_back') ? ' has-error' : '' }}">
                                                    @if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1)
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="{{$base_url}}/storage\app/{{$user->aadhar_back}}">
                                                            </iframe>
                                                          {{-- <img class="img-fluid" src="{{$base_url}}/storage\app/{{$user->aadhar_back}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';"> --}}
                                                        </div>
                                                    @endif
                                                    @if(Auth::user()->aadhar_back==null)
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_back">
                                                        @if ($errors->has('aadhar_back'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('aadhar_back') }}</strong>
                                                        </span> 
                                                        @endif
                                                    @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pan Card
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? ' has-error' : '' }}">
                                                    @if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1)
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="{{$base_url}}/storage\app/{{$user->pan_card}}">
                                                            </iframe>
                                                          {{-- <img class="img-fluid" src="{{$base_url}}/storage\app/{{$user->pan_card}}" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';"> --}}
                                                        </div>
                                                    @endif
                                                    @if(Auth::user()->pan_card==null)
                                                        <input type="file" class="form-control" id="val-range" name="pan_card">
                                                        @if ($errors->has('pan_card'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pan_card') }}</strong>
                                                        </span> 
                                                        @endif
                                                    @endif
                                                    </div>
                                                </div>
                                                @endif

                                                 @if($bankdetails!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Account number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('account_number') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" name="account_number" value="{{old('$bankdetails->bank_account_number',$bankdetails->bank_account_number)}}" placeholder="Enter account number..">
                                                        @if ($errors->has('account_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('account_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Account number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('account_number') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-username" name="account_number" value="" placeholder="Enter account number..">
                                                        @if ($errors->has('account_number'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('account_number') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($bankdetails!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('ifsc') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-website" name="ifsc" value="{{old('$bankdetails->ifsc_code',$bankdetails->ifsc_code)}}" placeholder="IFSC Code">
                                                        @if ($errors->has('ifsc'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('ifsc') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-website" name="ifsc" value="" placeholder="IFSC Code">
                                                        @if ($errors->has('ifsc'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('ifsc') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                @if($bankdetails!=null)
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" name="bank_name" value="{{old('$bankdetails->bank_name',$bankdetails->bank_name)}}" placeholder="Bank Name">
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
                                                    <div class="col-lg-6 {{ $errors->has('bank_name') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" name="bank_name" value="" placeholder="Bank Name">
                                                        @if ($errors->has('bank_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
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
    </div>


  
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitButton').click(function() {
            $(this).prop('disabled', true);
        });
    });
</script>
<script class="">
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");
    
});
</script>

@endsection

