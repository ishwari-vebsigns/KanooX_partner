@extends('layouts.admin-app')
@section('content')
<style type="text/css">
  .modal-header .close {
    padding: 1rem;
    margin: 0rem 0rem 0rem auto;
}
@media print{ 
.no-print{
  display: none !important;
}
}
</style>
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Loans</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Loans </a>
              </li>
              <li class="breadcrumb-item">
              All                                </li>
            </ol> 
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="content-body">
    <section class="simple-validation">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Loan @if($loandetails->associate!="") Assigned to: <b>{{$loandetails->associate->name}}</b>   @endif</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <p class="mt-1">All <code>Loan</code></p>
              <!-- <form class="form-horizontal" role="form"> -->
              @php
              $user=Auth::user();
              $role_id=$user->role_id;
              
              @endphp
              @if($role_id==1)
              <form method="post" action="{{config('app.baseURL')}}/postAssignAssociate">
                      @csrf
                      <input type="hidden" name="loan_id" value="{{$loan_id}}" />
                      <label><b>Assign Associate</b></label>
                      <div class="row">
                       <div class="col-lg-6 {{ $errors->has('assigned_to') ? ' has-error' : '' }}">
                      <select class="form-control" name="assigned_to" required>
                      
                      @foreach($associates as $associate)
                       <option value="{{$associate->id}}">{{$associate->name}} - {{$associate->contact_number}}</option>
                      @endforeach
                  
                     </select>
                     </div>
                     <div class="col-lg-4 {{ $errors->has('assigned_to') ? ' has-error' : '' }}">
                      <button type="submit" class="btn btn-primary">Assign</button>
                     </div>
                     </div>
                      
                      
                  </form> 
                  
                   <hr>
                   @endif
                
                
              <div class="row col-lg-12 col-md-12 col-sm-6">
                  
                 

                <?php
                 $status = $loandetails->status;
                ?>
                @if($status==0)
                <!-- Loan In Process -->
                <a href="" id="myAnchor" onClick="inprocess()"><button type="button" class="btn btn-success mr-1 mt-1 mb-1">In process</button></a>
                <a id="myAnchord"><button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">Documents Pending</button></a>
                <a href="" id="myAnchora" onClick="approved()"><button type="button" class="btn btn-primary m-1">Loan Approved</button></a>
                <a href="" id="myAnchorr" onClick="reject()"><button type="button" class="btn btn-primary m-1">Loan Rejected</button></a>

                @elseif($status==1)
                <!-- Documents Pending -->
                <a href="" id="myAnchor" onClick="inprocess()"><button type="button" class="btn btn-primary mr-1 mt-1 mb-1">In process</button></a>
                <a id="myAnchord" onClick="docpending()"><button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#exampleModal">Documents Pending</button></a>
                <a href="" id="myAnchora" onClick="approved()"><button type="button" class="btn btn-primary m-1">Loan Approved</button></a>
                <a href="" id="myAnchorr" onClick="reject()"><button type="button" class="btn btn-primary m-1">Loan Rejected</button></a>
                
                @elseif($status==2)

                <!-- Loan Approved -->
                <a href="" id="myAnchor" onClick="inprocess()"><button type="button" class="btn btn-primary mr-1 mt-1 mb-1" >In process</button></a>
                <a id="myAnchord" onClick="docpending()"><button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">Documents Pending</button></a>
                <a href="" id="myAnchora" onClick="approved()"><button type="button" class="btn btn-success m-1">Loan Approved</button></a>
                <a href="" id="myAnchorr" onClick="reject()"><button type="button" class="btn btn-primary m-1">Loan Rejected</button></a>

                @elseif($status==3)
                <!-- Loan Rejected -->
                <a href="" id="myAnchor" onClick="inprocess()"><button type="button" class="btn btn-primary mr-1 mt-1 mb-1">In process</button></a>
                <a id="myAnchord" onClick="docpending()"><button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">Documents Pending</button></a>
                <a href="" id="myAnchora" onClick="approved()"><button type="button" class="btn btn-primary m-1">Loan Approved</button></a>
                <a href="" id="myAnchorr" onClick="reject()"><button type="button" class="btn btn-success m-1">Loan Rejected</button></a>
                @endif
              </div>
            <!-- </form> -->

          <!-- Multiple Rule Validation end -->
          <!-- <form class="form-horizontal" role="form" method="" action="" enctype="multipart/form-data" novalidate=""> -->
            <!-- <input type="hidden" name="_token" value="<?php //echo csrf_token(); ?>"> 
                                    -->
            <div class="contact-form">
              <div class="row">
                  
                 
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('loan_type') ? ' has-error' : '' }}">
                  <label class="margin-label">Loan Term (In Yrs)</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="loan_type" value="{{ $loandetails->loan_type }}" >
                    @if ($errors->has('loan_type'))
                    <span class="help-block">
                      <strong>{{ $errors->first('loan_type') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('loan_amount') ? ' has-error' : '' }}">
                  <label class="margin-label">Loan Amount</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="loan_amount" value="{{ $loandetails->loan_amount }}" >
                    @if ($errors->has('loan_amount'))
                    <span class="help-block">
                      <strong>{{ $errors->first('loan_amount') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('full_name') ? ' has-error' : '' }}">
                  <label class="margin-label">Name</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="full_name" value="{{ $loandetails->full_name }}" >
                    @if ($errors->has('full_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('full_name') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('residence_address') ? ' has-error' : '' }}">
                  <label class="margin-label">Residence Address</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="residence_address" value="{{ $loandetails->residence_address }}" >
                    @if ($errors->has('residence_address'))
                    <span class="help-block">
                      <strong>{{ $errors->first('residence_address') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('office_address') ? ' has-error' : '' }}">
                  <label class="margin-label">Office Address</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="office_address" value="{{ $loandetails->office_address }}" >
                    @if ($errors->has('office_address'))
                    <span class="help-block">
                      <strong>{{ $errors->first('office_address') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('firm_company_name') ? ' has-error' : '' }}">
                  <label class="margin-label">Firm/Company Name</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="firm_company_name" value="{{ $loandetails->firm_company_name }}" >
                    @if ($errors->has('firm_company_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('firm_company_name') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('work_experience') ? ' has-error' : '' }}">
                  <label class="margin-label">Work Experience</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="work_experience" value="{{ $loandetails->work_experience }}" >
                    @if ($errors->has('work_experience'))
                    <span class="help-block">
                      <strong>{{ $errors->first('work_experience') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('nature_of_work') ? ' has-error' : '' }}">
                  <label class="margin-label">Nature Of Work</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="nature_of_work" value="{{ $loandetails->nature_of_work }}" >
                    @if ($errors->has('nature_of_work'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nature_of_work') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('business_estabish_date') ? ' has-error' : '' }}">
                  <label class="margin-label">Business Estabish Date</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="business_estabish_date" value="{{ $loandetails->business_estabish_date }}" >
                    @if ($errors->has('business_estabish_date'))
                    <span class="help-block">
                      <strong>{{ $errors->first('business_estabish_date') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('qualification') ? ' has-error' : '' }}">
                  <label class="margin-label">Qualification</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="qualification" value="{{ $loandetails->qualification }}" >
                    @if ($errors->has('qualification'))
                    <span class="help-block">
                      <strong>{{ $errors->first('qualification') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="margin-label">Email</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="email" value="{{ $loandetails->email }}" >
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
               
               <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('mobile') ? ' has-error' : '' }}">
                  <label class="margin-label">Mobile</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="mobile" value="{{ $loandetails->mobile }}" >
                    @if ($errors->has('mobile'))
                    <span class="help-block">
                      <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

            <!--     <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('mobile') ? ' has-error' : '' }}">
                  <label class="margin-label">Mobile</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="mobile" value="{{ $loandetails->mobile }}" >
                    @if ($errors->has('mobile'))
                    <span class="help-block">
                      <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div> -->

                @if($loandetails->year_one_netprofit!="")
                <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <label class="margin-label">Year</label>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <label class="margin-label">Net Profit</label>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <label class="margin-label">depreciation</label>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <label class="margin-label">Loan Interest</label>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <label class="margin-label">Gross Profit</label>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <label class="margin-label">Sales</label>
                  </div>
                  
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                         <div class="form-group">
                          <div class="controls">
                        <label class="margin-label">Year 1</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_one_netprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_one_netprofit" value="{{ $loandetails->year_one_netprofit }}" >
                      @if ($errors->has('year_one_netprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_one_netprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_one_depreciation') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_one_depreciation" value="{{ $loandetails->year_one_depreciation }}" >
                      @if ($errors->has('year_one_depreciation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_one_depreciation') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_one_loaninterest') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_one_loaninterest" value="{{ $loandetails->year_one_loaninterest }}" >
                      @if ($errors->has('year_one_loaninterest'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_one_loaninterest') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_one_grossprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_one_grossprofit" value="{{ $loandetails->year_one_grossprofit }}" >
                      @if ($errors->has('year_one_grossprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_one_grossprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('  year_one_sales') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="  year_one_sales" value="{{ $loandetails->  year_one_sales }}" >
                      @if ($errors->has(' year_one_sales'))
                      <span class="help-block">
                        <strong>{{ $errors->first(' year_one_sales') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                
              </div>
              <!-- year2 -->
              <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                     <div class="form-group">
                      <div class="controls">
                    <label>Year 2</label>
                  </div>
                </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_two_netprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_two_netprofit" value="{{ $loandetails->year_two_netprofit }}" >
                      @if ($errors->has('year_two_netprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_two_netprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_two_depreciation') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_two_depreciation" value="{{ $loandetails->year_two_depreciation }}" >
                      @if ($errors->has('year_two_depreciation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_two_depreciation') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_two_loaninterest') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_two_loaninterest" value="{{ $loandetails->year_two_loaninterest }}" >
                      @if ($errors->has('year_two_loaninterest'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_two_loaninterest') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_two_grossprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_two_grossprofit" value="{{ $loandetails->year_two_grossprofit }}" >
                      @if ($errors->has('year_two_grossprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_two_grossprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_two_sales') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_two_sales" value="{{ $loandetails->  year_two_sales }}" >
                      @if ($errors->has('year_two_sales'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_two_sales') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                
              </div>
              <!-- year3 -->
              <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                     <div class="form-group">
                      <div class="controls">
                    <label>Year 3</label>
                  </div>
                </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_three_netprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_three_netprofit" value="{{ $loandetails->year_three_netprofit }}" >
                      @if ($errors->has('year_three_netprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_three_netprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_three_depreciation') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_three_depreciation" value="{{ $loandetails->year_three_depreciation }}" >
                      @if ($errors->has('year_three_depreciation'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_three_depreciation') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_three_loaninterest') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_three_loaninterest" value="{{ $loandetails->year_three_loaninterest }}" >
                      @if ($errors->has('year_three_loaninterest'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_three_loaninterest') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_three_grossprofit') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="year_three_grossprofit" value="{{ $loandetails->year_three_grossprofit }}" >
                      @if ($errors->has('year_three_grossprofit'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_three_grossprofit') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('year_three_sales') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <div class="controls">
                      
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="  year_three_sales" value="{{ $loandetails->  year_three_sales }}" >
                      @if ($errors->has(' year_three_sales'))
                      <span class="help-block">
                        <strong>{{ $errors->first(' year_three_sales') }}</strong>
                      </span>
                      @endif</div>
                    </div>
                  </div>
                
              </div>
                @endif
                <!-- salaried -->
                @if($loandetails->month_one_net_salary!="")
                <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_one_net_salary') ? ' has-error' : '' }}">
                    <label class="margin-label">Month</label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_one_net_salary') ? ' has-error' : '' }}">
                    <label class="margin-label">Net Salary</label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_one_net_salary') ? ' has-error' : '' }}">
                    <label class="margin-label">Gross Salary</label>
                  </div>
                </div>
                <div class="row col-lg-12 col-md-12 col-sm-6">

                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_one_net_salary') ? ' has-error' : '' }}">
                   <label class="margin-label">Month 1</label>
                </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_one_net_salary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Net Salary</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_one_net_salary" value="{{ $loandetails->month_one_net_salary }}" >
                    @if ($errors->has('month_one_net_salary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_one_net_salary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_two_net_salary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Gross Salary</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_one_grosssalary" value="{{ $loandetails->month_one_grosssalary }}" >
                    @if ($errors->has('month_one_grosssalary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_one_grosssalary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
              </div>
                <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_two_net_salary') ? ' has-error' : '' }}">
                   <label class="margin-label">Month 2</label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_two_net_salary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Net Salary Month 3</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_two_net_salary" value="{{ $loandetails->month_two_net_salary }}" >
                    @if ($errors->has('month_two_net_salary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_two_net_salary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_two_grosssalary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Net Salary Month 3</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_two_grosssalary" value="{{ $loandetails->month_two_grosssalary }}" >
                    @if ($errors->has('month_two_grosssalary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_two_grosssalary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
              </div>

              <div class="row col-lg-12 col-md-12 col-sm-6">
                  <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_three_net_salary') ? ' has-error' : '' }}">
                   <label class="margin-label">Month 3</label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_three_net_salary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Net Salary Month 3</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_three_net_salary" value="{{ $loandetails->month_three_net_salary }}" >
                    @if ($errors->has('month_three_net_salary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_three_net_salary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 {{ $errors->has('month_three_grosssalary') ? ' has-error' : '' }}">
                  <!-- <label class="margin-label">Net Salary Month 3</label> -->
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="month_three_grosssalary" value="{{ $loandetails->month_three_grosssalary }}" >
                    @if ($errors->has('month_three_grosssalary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('month_three_grosssalary') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
              </div>
                @endif

                <!-- Existing Loan -->
                @if($loandetails->exist_loan_type!="")
                <div class="col-lg-12 col-md-12 col-sm-6">
                  <label>Existing loan Information</label>
                </div>
                  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_loan_type') ? ' has-error' : '' }}">
                  <label class="margin-label">Exist Loan Type</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_loan_type" value="{{ $loandetails->exist_loan_type }}" >
                    @if ($errors->has('exist_loan_type'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_loan_type') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_loan_amount') ? ' has-error' : '' }}">
                  <label class="margin-label">Loan Amount</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_loan_amount" value="{{ $loandetails->exist_loan_amount }}" >
                    @if ($errors->has('exist_loan_amount'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_loan_amount') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_tenor_of_loan') ? ' has-error' : '' }}">
                  <label class="margin-label">Tenor Of Loan</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_tenor_of_loan" value="{{ $loandetails->exist_tenor_of_loan }}" >
                    @if ($errors->has('exist_tenor_of_loan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_tenor_of_loan') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_emi') ? ' has-error' : '' }}">
                  <label class="margin-label">EMI</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_emi" value="{{ $loandetails->exist_emi }}" >
                    @if ($errors->has('exist_emi'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_emi') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_sanction_dt') ? ' has-error' : '' }}">
                  <label class="margin-label">Sanction Date</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_sanction_dt" value="{{ $loandetails->exist_sanction_dt }}" >
                    @if ($errors->has('exist_sanction_dt'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_sanction_dt') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('exist_emi_bounce') ? ' has-error' : '' }}">
                  <label class="margin-label">EMI Bounce</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="exist_emi_bounce" value="{{ $loandetails->exist_emi_bounce }}" >
                    @if ($errors->has('exist_emi_bounce'))
                    <span class="help-block">
                      <strong>{{ $errors->first('exist_emi_bounce') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>
                @endif

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('extra_income') ? ' has-error' : '' }}">
                  <label class="margin-label">Extra Income</label>
                  <div class="form-group">
                    <div class="controls">
                    
                    <input class="form-control" required="" data-validation-required-message="This field is required" type="text" name="extra_income" value="{{ $loandetails->extra_income }}" >
                    @if ($errors->has('extra_income'))
                    <span class="help-block">
                      <strong>{{ $errors->first('extra_income') }}</strong>
                    </span>
                    @endif</div>
                  </div>
                </div>

                            @if($loandetails->loandoc!= '')
                             <div class="single-job-post me-1 wow fadeInUp mt-25 col-lg-12" data-wow-delay="0.3s">
                                <div class="post-header">
                                    <div>
                                        <h6 class="job-title"><a href="javascript:void(0);">Uploaded Documents</a> </h6>
                                        
                                    </div>
                                </div>

                               @php
                                $count=0;

                               @endphp

                                @foreach($loandetails->loandoc as $loan_doc)

                                <?php 
                                $count++;
                                    $loan_dully=$loan_doc->where('name','dully_form')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                            
                             @if($count==1)
                             @if($loan_dully!="[]")
                                <div class="post-content">
                                    <div class="card" style="padding:10px;border:1px solid #ddd;width:70%;">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Dully filled Application Form with Photograph :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                            </div>
                                            @foreach($loan_dully as $loans_dully)
                                      
                                           <div class="row">
                                           <div class="col-md-3">
                                               <p>Name</p>
                                           </div>
                                           <div class="col-md-2">
                                               <a href="{{config('app.baseURL')}}/storage/app/{{$loans_dully->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                           </div>
                                           <div class="col-md-2">
                                               <a href="{{config('app.baseURL')}}/storage/app/{{$loans_dully->documents}}" class="btn btn-success" >view</a>
                                           </div>
                                           <div class="col-md-1">
                                               <a href="{{config('app.baseURL')}}/storage/app/{{$loans_dully->documents}}" class="btn btn-danger" >Delete</a>
                                           </div>
                                         
                                           
                                    
                                    
                                </div><br>
                                       
                                        <!--<iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_dully->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>-->
                                       @endforeach
                                       </div>
                                    </div>
                                    
                                @endif
                                @endif

                                   @if($loandetails->profession_type!="salaried")
                                 <?php 
                               
                                    $loan_identity=$loan_doc->where('name','identity')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_identity!="[]")
                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Age Proof (PAN Card, Passport, Any other Certificate from Statutory Authority) Residence Proof (Passport, Driving License, Telephone Bill, Ration Card, Election Card, Any other Certificate from Statutory Authority) :</h6><br>
                                            </div>
                                            @foreach($loan_identity as $loans_identity)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                 @endif
                                @endif
                                @endif

                                <?php 
                                  $loan_edu=$loan_doc->where('name','education')->where('loan_id',$loan_doc->loan_id)->get();
                                ?>
                                @if($count==1)
                                @if($loan_edu!="[]")
                                <div class="post-content">
                                    <div class="">
                                         
                                      <div class="job-location me-lg-3 me-2"><h6>Educational Qualification Proof - Latest Degree (for professionals) :</h6><br>
                                            </div>
                                        @foreach($loan_edu as $loans_edu)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_edu->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_edu->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_edu->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                 @endif
                                @endif
                                  
                                @if($loandetails->profession_type!="salaried")
                                  <?php 
                                    $loan_business=$loan_doc->where('name','business_certificateproof')->where('loan_id',$loan_doc->loan_id)->get();
                                ?>
                                @if($count==1)
                                @if($loan_business!="[]")
                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Certificate & Proof of business existence along with Business Profile :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                            </div><br>
                                            @foreach($loan_business as $loans_business)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_business->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_business->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_business->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                 @endif
                                @endif

                                  <?php 
                                    $loan_tax=$loan_doc->where('name','tax_return_proof')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_tax!="[]")
                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Last 3 years Income Tax returns with Profit & Loss Account & Balance Sheets duly certified/audited by a Chartered Accountant :</h6><br>
                                            </div>
                                            @foreach($loan_tax as $loans_tax)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_tax->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_tax->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_tax->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                @endif
                                @endif
                                @endif 
 

                                 <?php 
                                    $loan_bank=$loan_doc->where('name','bankstatement_proof')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_bank!="[]")
                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Last 12 months Bank Account Statements :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6><br>
                                            </div>
                                             @foreach($loan_bank as $loans_bank)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_bank->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_bank->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_bank->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                @endif
                                @endif

                               <!--  <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Processing Fee Cheque in favour of '……………………………' :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6><br>
                                            </div>
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loan_doc->cheque}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       
                                    </div>
                                </div>

                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Photocopy of Title Documents of the Property, Approved Plan etc. :</h6><br>
                                            </div>
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loan_doc->property_document}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       
                                    </div>
                                </div> -->

                                @if($loandetails->profession_type=="salaried")

                                 <?php 
                               
                                    $loan_identity=$loan_doc->where('name','identity')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_identity!="[]")
                                 <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Age Proof (PAN Card, Passport, Any other Certificate from Statutory Authority) :</h6><br>
                                            </div>
                                            @foreach($loan_identity as $loans_identity)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_identity->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                 @endif
                                @endif

                                <?php 
                                    $loan_residence=$loan_doc->where('name','residence')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_residence!="")
                                    <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Residence Proof (Passport, Driving License, Telephone Bill, Ration Card, Election Card, Any other Certificate from Statutory Authority) :</h6><br>
                                            </div>
                                            @foreach($loan_residence as $loans_residence)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_residence->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_residence->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_residence->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                @endif
                                @endif
                               
                                <?php 
                                    $loan_salary=$loan_doc->where('name','income_proof')->where('loan_id',$loan_doc->loan_id)->get();
                                    // echo $loan_dully;die;
                                ?>
                                @if($count==1)
                                @if($loan_salary!="")
                                  <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Latest Salary-slips for last 3 months :</h6><br>
                                            </div>
                                            @foreach($loan_salary as $loans_salary)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_salary->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                    </div>
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_salary->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_salary->documents}}" class="btn btn-success" >view</a>
                                </div><br>
                                @endif
                                @endif

                                <?php 
                                    $loan_formsix=$loan_doc->where('name','form_sixteendoc')->where('loan_id',$loan_doc->loan_id)->get();
                                ?>
                                @if($count==1)
                                @if($loan_formsix!="")
                                <div class="post-content">
                                    <div class="">
                                         
                                          <div class="job-location me-lg-3 me-2"><h6>Form 16 for last 2 years </h6>
                                            @foreach($loan_formsix as $loans_formsix)
                                        <iframe class="mr-2 mb-1 mt-1" src="{{config('app.baseURL')}}/storage/app/{{$loans_formsix->documents}}" id="pdf_display_frame" width="48%" height="400px"></iframe>
                                       @endforeach
                                          </div>
                                          <a href="{{config('app.baseURL')}}/storage/app/{{$loans_formsix->documents}}" class="btn btn-primary" download>Download</a>&nbsp;&nbsp;
                                    <a href="{{config('app.baseURL')}}/storage/app/{{$loans_formsix->documents}}" class="btn btn-success" >view</a>
                                        </div>
                                    
                                  </div>
                                  @endif
                                  @endif
                                  @endif 
                                  @endforeach
                            @endif

                @if($loandetails->note!= '')
                <div class="{{ $errors->has('note') ? ' has-error' : '' }}">
                  <label class="margin-label">Pending Documents</label>
                  <div class="form-group">
                    <div class="controls">
                      <div class="form-group mg-b-0 mg-md-l-20 mg-t-20 mg-md-t-0">
                        <textarea class="form-control" cols="5" rows="8">{{$loandetails->note}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                @endif

              </div>
           </div> 
         <!-- </form> -->
       </div>
     </div>
   </div>
 </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Mention ending Documents Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{config('app.baseURL')}}/admin/loandocpending/{{$loandetails->loan_id}}" method="POST" id="userForm">
        @csrf
        <input type="hidden" name="loan_id" value="{{$loandetails->loan_id}}">
        <textarea class="form-control" name="note" rows="10"></textarea>
        <button type="button" class="btn btn-secondary mt-1" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary mt-1">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
      
    </div>
  </div>
</div>
<button type="button" onclick="window.print();" class="btn btn-success waves-effect waves-light m-r-20 no-print">Print
      </button>
</section>
  </div>
</div>

<script type="text/javascript">
  function inprocess() {
    // alert("Do you want to change the status?");
    var retVal = confirm("Do you want to change the status?");
    if(retVal == true){
      document.getElementById("myAnchor").href = "{{config('app.baseURL')}}/admin/loaninprocess/{{$loandetails->loan_id}}";
    }
    else{
      document.getElementById("myAnchor").href = "";
    }
    
  }
  function approved() {
    // alert("Do you want to change the status?");
    var retVal = confirm("Do you want to change the status?");
    if(retVal == true){
      document.getElementById("myAnchora").href = "{{config('app.baseURL')}}/admin/loanapproved/{{$loandetails->loan_id}}";
    }
    else{
      document.getElementById("myAnchora").href = "";
    }
    
  }
function reject() {
    // alert("Do you want to change the status?");
    var retVal = confirm("Do you want to change the status?");
    if(retVal == true){
      document.getElementById("myAnchorr").href = "{{config('app.baseURL')}}/admin/loanrejected/{{$loandetails->loan_id}}";
    }
    else{
      document.getElementById("myAnchorr").href = "";
    }
    
  }
  // function docpending() {

  //    var retVal = confirm("Do you want to change the status?");
  //   if(retVal == true){

  //     document.getElementById("myAnchord").href = "{{config('app.baseURL')}}/admin/loandocpending/{{$loandetails->loan_id}}";
  //   }
  //   else{
  //     document.getElementById("myAnchord").href = "";
  //   }
  // }

  
</script>

<!-- <script type="text/javascript">       
  function docpending() {
   var person = prompt("Please mention pending documents");
    var retVal = confirm("Do you want to change the status?");
      if(retVal == true){
      document.getElementById("myAnchord").href = "{{config('app.baseURL')}}/admin/loandocpending/{{$loandetails->loan_id}}/"+person;
    }
    else{
       document.getElementById("myAnchord").href = "";
    }   
}
            
</script> -->
 
@endsection