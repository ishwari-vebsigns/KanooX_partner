  @extends('layouts.admin-app')
  @section('content')

  <style type="text/css">
    .hidden{
      display: none;
    }
    .card-title{
      font-size: 14px !important;
    }
    .form-control:disabled, .form-control[readonly] {
      background-color: #a6e7efd6 !important;
      opacity: 1;
    }
    .form-group {
      margin-bottom: 0.8rem !important;
    }
    .move-right{
      padding-left: 15px;
      padding-right: 15px;
    }
    .btn-align{
        margin-left:20px;
    }
    #input_fields_wrap  .form-control{
        width: 95% !important;
        margin-left:15px !important;
    }
    
     #input_fields_wrap  label{
        
        margin-left:15px !important;
    }
    
    
   @media print {
        
    .no-print{
        
        display:none;
    }
        
    }
    .label-input{
      padding: 0px !important;
    height: 19px;
    }
    .main-label{
      font-weight: 600;
    }
    .main-label-itr{
       font-weight: 600;
    }
  
    .col-md-2{
      padding-right: 0px !important;
      padding-left: 0px !important;
    }

  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <div class="content-wrapper">

    <div class="content-header row no-print">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Sanction Calculator</h2>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">

                <li class="breadcrumb-item">
                  <a href="#"> Home </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Sanction Calculator</a>
                </li>
                <li class="breadcrumb-item">
                Add                                </li>
              </ol> 
            </div>
          </div>
        </div>
      </div>

    </div>                    
    <div class="content-body">

      <!-- Simple Validation start -->
      <section class="simple-validation">
        <div class="row">


          <div class="col-md-12">
            <div class="card">

                 <div class="col-md-12 no-print" style="padding-top: 10px;">
               <span><b>Change Master Parameter </b><input type="checkbox" class="master_parameter" name="master_parameter"></span></div>
               <br>
                <div class="col-md-12  master_paramete_div no-print hidden">
              
               <div class="row">
                      <div class="col-lg-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">Gross Income Margin</label>
                                <input class="form-control master_income_margin" required="" data-validation-required-message="This field is required" type="number" name="" value="40" placeholder="Income Margin">
                                @if ($errors->has('master_income_margin'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('master_income_margin') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>
               
                                 <div class="col-lg-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">Rental Margin</label>
                                <input class="form-control master_rental_margin" required="" data-validation-required-message="This field is required" type="number" name="" value="60" placeholder="Rental Margin">
                                @if ($errors->has('master_rental_margin'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('master_rental_margin') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>

                              <div class="col-lg-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">LTV Margin one</label>
                                <input class="form-control master_ltv_margin_one" required="" data-validation-required-message="This field is required" type="number" name="" value="90" placeholder="LTV Margin">
                                @if ($errors->has('master_ltv_margin'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('master_ltv_margin') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>

                               <div class="col-lg-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">LTV Margin two</label>
                                <input class="form-control master_ltv_margin_two" required="" data-validation-required-message="This field is required" type="number" name="" value="80" placeholder="LTV Margin">
                                @if ($errors->has('master_ltv_margin'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('master_ltv_margin') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>

                                   <div class="col-lg-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">LTV Margin three</label>
                                <input class="form-control master_ltv_margin_three" required="" data-validation-required-message="This field is required" type="number" name="" value="75" placeholder="LTV Margin">
                                @if ($errors->has('master_ltv_margin'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('master_ltv_margin') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>
               </div>
              
             </div>


              <div class="col-md-12" style="padding-top: 20px;padding-bottom: 20px;">
                <div class="form-check form-check-inline me-5  selfTab">
                  <input class="form-check-input" type="radio" name="profession_type" id="selfTab" checked="" value="self" onclick="show1();">
                  <label class="form-check-label" for="self"><b style="font-size: 16px;">Self Employed/ Business Professionals</b></label>
                </div>
                <div class="form-check form-check-inline active me-5">
                  <input class="form-check-input" type="radio" name="profession_type" id="salariedTab"  value="salaried" onclick="show2();">
                  <label class="form-check-label" for="married"><b style="font-size: 16px;">Salaried Employees</b> </label>
                </div>
              </div>
        <div class="col-md-12 business" style="padding-top: 20px;padding-bottom: 20px;">
               <span><b>Year 1 </b><input type="checkbox" class="year_one_check" name="year_one" checked=""></span>&nbsp;&nbsp;
               <span> <b>Year 2</b> <input type="checkbox" class="year_two_check" name="year_two" checked=""></span>&nbsp;&nbsp;
               <span><b>Latest Year</b> <input type="checkbox" class="year_three_check" name="year_three" checked=""></span>
             </div>

               <div class="col-md-12 working hidden" style="padding-top: 20px;padding-bottom: 20px;">
                <span><b>Month 1 </b><input type="checkbox" class="month_one_check" name="year_one" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 2</b> <input type="checkbox" class="month_two_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 3</b> <input type="checkbox" class="month_three_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 4</b> <input type="checkbox" class="month_four_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 5</b> <input type="checkbox" class="month_five_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Latest Month</b> <input type="checkbox" class="month_six_check" name="year_two" checked=""></span>


               </div>
                              <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('age') ? ' has-error' : '' }}" style="padding-left: 20px !important;">
                    <div class="form-group">
                      <div class="controls">
                        <label class="label" for="">Name</label>
                        <input class="form-control name" required="" value="" data-validation-required-message="This field is required" type="text" name="" value="0" placeholder="Name">
                        @if ($errors->has('name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif</div>
                    </div>
                  </div>


                  <div style="display: inline-flex;">

                    <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('bank_name') ? ' has-error' : '' }}" style="padding-left: 20px !important;">
                      <div class="form-group">
                        <div class="controls">
                          <label class="label" for="">Date of Birth</label>
                          <input class="form-control date_of_birth" required="" value="1985-02-11" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Date of Birth">
                          @if ($errors->has('date_of_birth'))
                          <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                          </span>
                        @endif</div>
                      </div>
                    </div>



                    <div class="col-lg-2 col-md-2 col-sm-2 {{ $errors->has('age') ? ' has-error' : '' }}" style="padding-left: 20px !important;">
                      <div class="form-group">
                        <div class="controls">
                          <label class="label" for="">Age (In Years)</label>
                          <input class="form-control age" required="" value="37" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Age">
                          @if ($errors->has('age'))
                          <span class="help-block">
                            <strong>{{ $errors->first('age') }}</strong>
                          </span>
                        @endif</div>
                      </div>
                    </div>

                  </div>
                   <hr style="border:1px solid #ddd;">
              <div class="card-header">

                <h6 class="card-title">Borrower</h6>
              </div>
              <div class="card-content business">
                <div class="card-body">
                  <!-- <p class="mt-1">Add <code>Borrower</code></p> -->

                 

                  <!-- Multiple Rule Validation end -->
                  <form class="form-horizontal" role="form" method="POST" action="add" enctype="multipart/form-data" novalidate="">

      

             


                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
                  <div class="contact-form">
                    <div class="row">
                      <div class="col-md-2">
                        <h6 class="card-title" style="text-align: center; visibility: hidden;">Year 1</h6>


                <!--           <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">Date of ITR</label>
                                <input class="form-control self_itr_year_one" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div> -->
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Gross Income</label>
                                 <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Agriculture Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Other Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Depreciation</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Total Gross Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Tax</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                </div>
                            </div>
                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Other Deduction</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                              </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Total Deduction</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>

                  <!--  <div class="col-lg-12 {{ $errors->has('bank_name') ? ' has-error' : '' }}" id="input_fields_wrap_dep">
                    <label class="label" for="">Other deduction</label>
                   <div class="col-md-12" style="display: inline-flex;padding: 0px;" >
                                    <div class="col-md-10" > 
                                        <div class="form-group">
                               
                                            <label for="proposalTitle3">
                                            
                                            </label>
                                            <input type="number" class="form-control required" id="proposalTitle3" name="other_dep[]">
                                        </div>
                                        
                                    </div>


                                 
                                     
                                     <a  id="add_dep1_button"   class=' btn-plus btn btn-outline-primary btn-sm  btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-plus'></i></a>
                                 </div>
                               </div> -->




                             </div>

                      <div class="col-md-2 year_one_show">
                        <h6 class="card-title" style="text-align: center;">Year 1</h6>


                <!--           <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">Date of ITR</label>
                                <input class="form-control self_itr_year_one" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div> -->
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                              
                                <input class="form-control self_gross_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                               
                                <input class="form-control self_agriculture_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                              
                                <input class="form-control self_other_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                
                                <input class="form-control self_depreciation_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                
                                <input class="form-control self_total_gross_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                
                                <input class="form-control self_tax_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                               
                                <input class="form-control self_other_ded_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                               
                                <input class="form-control self_total_deduction_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div>

                  <!--  <div class="col-lg-12 {{ $errors->has('bank_name') ? ' has-error' : '' }}" id="input_fields_wrap_dep">
                    <label class="label" for="">Other deduction</label>
                   <div class="col-md-12" style="display: inline-flex;padding: 0px;" >
                                    <div class="col-md-10" > 
                                        <div class="form-group">
                               
                                            <label for="proposalTitle3">
                                            
                                            </label>
                                            <input type="number" class="form-control required" id="proposalTitle3" name="other_dep[]">
                                        </div>
                                        
                                    </div>


                                 
                                     
                                     <a  id="add_dep1_button"   class=' btn-plus btn btn-outline-primary btn-sm  btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-plus'></i></a>
                                 </div>
                               </div> -->




                             </div>




                             <div class="col-md-2 year_two_show">
                              <h6 class="card-title" style="text-align: center;">Year 2</h6>

                            <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    <label class="label" for="">Date of ITR</label>
                                    <input class="form-control self_itr_year_two" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div> -->
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_gross_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_agriculture_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_other_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_depreciation_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>


                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_total_gross_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>


                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_tax_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_other_ded_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_total_deduction_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                            </div>




                            <div class="col-md-2 year_three_show">
                              <h6 class="card-title" style="text-align: center;">Latest Year</h6>

                            <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    <label class="label" for="">Date of ITR</label>
                                    <input class="form-control self_itr_year_three" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div> -->
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_gross_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_agriculture_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_other_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_depreciation_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                  
                                    <input class="form-control self_total_gross_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>


                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_tax_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_other_ded_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                  
                                    <input class="form-control self_total_deduction_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                            </div>


                            <div class="col-md-2">
                              <h6 class="card-title" style="text-align: center;">Avg Income(Latest)</h6>

                             <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}" style="visibility: hidden;">
                                <div class="form-group">
                                  <div class="controls">
                                    <label class="label" for="">Date of ITR</label>
                                    <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="-------" readonly="" disabled="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div> -->
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_latest_monthly_average_gross" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_latest_monthly_average_agriculture" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                  
                                    <input class="form-control self_latest_monthly_average_other_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_latest_monthly_average_depreciation" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_total_year_three_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>


                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_latest_monthly_average_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Tax" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_latest_monthly_average_ded" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                  
                                    <input class="form-control self_total_deduction_year_three_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                            </div>

                            <div class="col-md-2">
                              <h6 class="card-title" style="text-align: center;">Avg Income(All)</h6>

                           <!--    <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}" style="visibility: hidden;">
                                <div class="form-group">
                                  <div class="controls">
                                    <label class="label" for="">Date of ITR</label>
                                    <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="-------" readonly="" disabled="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div> -->
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_all_monthly_average_gross" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                  
                                    <input class="form-control self_all_monthly_average_agriculture" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_all_monthly_average_other_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_all_monthly_average_depreciation" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                   
                                    <input class="form-control self_total_year_all_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>


                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                    
                                    <input class="form-control self_all_monthly_average_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Tax" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                                 
                                    <input class="form-control self_all_monthly_average_ded" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                              <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <div class="form-group">
                                  <div class="controls">
                 
                                    <input class="form-control self_total_deduction_year_all_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                                    @if ($errors->has('bank_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('bank_name') }}</strong>
                                    </span>
                                  @endif</div>
                                </div>
                              </div>

                            </div>




               <!--  <div class="row">
                  <div class="col-lg-12">
                    <div class="form-submit mt-10 mb-30 text-center">

                     <button type="submit" class="btn btn-primary">Calculate</button>
                   </div>
                 </div>
               </div> -->
             </div><br>



             <div class="col-md-12">
              <label class="label" for="existing"><input type="checkbox" value="1" class="existing_loan_check" name="existing_loan_check"> &nbsp; <b style="font-size: 16px;">Co Borrower</b> </label>
            </div>


            <div class="card-header existing_loan hidden">
              <h6 class="card-title">Co-Borrower</h6>
            </div><br>

                <div class="col-md-12 business existing_loan hidden" style="padding-top: 20px;padding-bottom: 20px;">
               <span><b>Year 1 </b><input type="checkbox" class="co_year_one_check" name="year_one" checked=""></span>&nbsp;&nbsp;
               <span> <b>Year 2</b> <input type="checkbox" class="co_year_two_check" name="year_two" checked=""></span>&nbsp;&nbsp;
               <span><b>Latest Year</b> <input type="checkbox" class="co_year_three_check" name="year_three" checked=""></span>
             </div>

            <br> <div class="row existing_loan hidden">

                                    <div class="col-md-2">
                        <h6 class="card-title" style="text-align: center; visibility: hidden;">Year 1</h6>


                <!--           <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label" for="">Date of ITR</label>
                                <input class="form-control self_itr_year_one" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                              @endif</div>
                            </div>
                          </div> -->
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Gross Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Agriculture Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Other Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Depreciation</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Total Gross Income</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Tax</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                                </div>
                            </div>
                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Other Deduction</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                              </div>
                            </div>
                          </div>


                          <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <div class="controls">
                                <label class="label main-label" for="">Total Deduction</label>
                                <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                               </div>
                            </div>
                          </div>

                  <!--  <div class="col-lg-12 {{ $errors->has('bank_name') ? ' has-error' : '' }}" id="input_fields_wrap_dep">
                    <label class="label" for="">Other deduction</label>
                   <div class="col-md-12" style="display: inline-flex;padding: 0px;" >
                                    <div class="col-md-10" > 
                                        <div class="form-group">
                               
                                            <label for="proposalTitle3">
                                            
                                            </label>
                                            <input type="number" class="form-control required" id="proposalTitle3" name="other_dep[]">
                                        </div>
                                        
                                    </div>


                                 
                                     
                                     <a  id="add_dep1_button"   class=' btn-plus btn btn-outline-primary btn-sm  btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-plus'></i></a>
                                 </div>
                               </div> -->




                             </div>

              <div class="col-md-2 co_year_one_show">
                <h6 class="card-title" style="text-align: center;">Year 1</h6>


               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control co_self_itr_year_one" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_gross_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_agriculture_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_other_income_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_depreciation_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_gross_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_tax_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_other_ded_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_total_deduction_year_one" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>



              </div>




              <div class="col-md-2 co_year_two_show">
                <h6 class="card-title" style="text-align: center;">Year 2</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control co_self_itr_year_two" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_gross_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_agriculture_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_other_income_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_depreciation_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_total_gross_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_tax_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_other_ded_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_deduction_year_two" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>




              <div class="col-md-2 co_year_three_show">
                <h6 class="card-title" style="text-align: center;">Latest Year</h6>


               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control co_self_itr_year_three" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_gross_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_agriculture_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_other_income_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_depreciation_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_gross_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_tax_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                      <input class="form-control co_self_other_ded_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_total_deduction_year_three" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


              </div>


              <div class="col-md-2">
                <h6 class="card-title" style="text-align: center;">Avg Income (Latest)</h6>

              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}" style="visibility: hidden;">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="-------" readonly="" disabled="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_latest_monthly_average_gross" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_latest_monthly_average_agriculture" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_latest_monthly_average_other_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_latest_monthly_average_depreciation" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_year_three_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_latest_monthly_average_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Tax" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_latest_monthly_average_ded" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_deduction_year_three_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>

              <div class="col-md-2">
                <h6 class="card-title" style="text-align: center;">Avg Income(All)</h6>

              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}" style="visibility: hidden;">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="-------" readonly="" disabled="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_all_monthly_average_gross" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_all_monthly_average_agriculture" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Agriculture Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_all_monthly_average_other_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_all_monthly_average_depreciation" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_year_all_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_self_all_monthly_average_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Tax" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_all_monthly_average_ded" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_self_total_deduction_year_all_average" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Total Deduction" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>


              <br>

              
            </div>                          
          </form>
        </div>
      </div>
    </div>

    <div class="card-content working hidden">
      <div class="card-body">

        <form class="form-horizontal working" role="form" method="POST" action="#" enctype="multipart/form-data" novalidate="">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                        
          <div class="contact-form">
            <div class="row">
             
             <div class="col-md-2">
            <h6 class="card-title" style="text-align: center;visibility: hidden;">Average</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Gross Income</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                     </div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Tax</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                      </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Other Deduction</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                     </div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Net Monthly Income</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                      </div>
                  </div>
                </div>
                
              </div>

             <div class="col-md-8">
               <div class="row">
                <div class="col-md-2 month_one_show">
                  <h6 class="card-title" style="text-align: center;">Month 1</h6>


              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control one_salary_gross_income" id="demo" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control one_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control one_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control one_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>



                
              </div>




              <div class="col-md-2 month_two_show">
                <h6 class="card-title" style="text-align: center;">Month 2</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control two_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control two_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control two_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control two_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                

              </div>

              <div class="col-md-2 month_three_show">
                <h6 class="card-title" style="text-align: center;">Month 3</h6>

              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control three_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control three_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control three_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control three_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>

              <div class="col-md-2 month_four_show">
                <h6 class="card-title" style="text-align: center;">Month 4</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control four_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control four_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control four_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control four_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>

              <div class="col-md-2 month_five_show">
                <h6 class="card-title" style="text-align: center;">Month 5</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control five_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control five_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                      <input class="form-control five_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control five_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>



              <div class="col-md-2 month_six_show">
                <h6 class="card-title" style="text-align: center;">Latest Month</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control six_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control six_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control six_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control six_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
              </div>

            </div>





          </div>


          <div class="col-md-2">
            <h6 class="card-title" style="text-align: center;">Average Monthly</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control average_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control average_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control average_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control average_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
              </div>






             <!--  <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Calculate</button>
                 </div>
               </div>
             </div> -->
           </div><br>



           <div class="col-md-12">
            <label class="label" for="existing"><input type="checkbox" value="1" class="existing_loan_co" name="existing_loan_check"> &nbsp; <b style="font-size: 16px;">Co Borrower</b> </label>
          </div>


          <div class="card-header existing_loan_co_check hidden">
            <h6 class="card-title">Co-Borrower</h6>
          </div><br>


               <div class="col-md-12  existing_loan_co_check hidden" style="padding-top: 20px;padding-bottom: 20px;">
                <span><b>Month 1 </b><input type="checkbox" class="co_month_one_check" name="year_one" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 2</b> <input type="checkbox" class="co_month_two_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 3</b> <input type="checkbox" class="co_month_three_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 4</b> <input type="checkbox" class="co_month_four_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Month 5</b> <input type="checkbox" class="co_month_five_check" name="year_two" checked=""></span>&nbsp;&nbsp;
                 <span> <b>Latest Month</b> <input type="checkbox" class="co_month_six_check" name="year_two" checked=""></span>


               </div>

          <br> <div class="row existing_loan_co_check hidden">



            <div class="row">

               <div class="col-md-2" style="padding-left: 15px !important;padding-right: 15px !important;">
            <h6 class="card-title" style="text-align: center;visibility: hidden;">Average</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Gross Income</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                     </div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Tax</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                      </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Other Deduction</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                     </div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label main-label" for="">Net Monthly Income</label>
                      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
                      </div>
                  </div>
                </div>
                
              </div>

             <div class="col-md-8">
               <div class="row">
                <div class="col-md-2 co_month_one_show">
                  <h6 class="card-title" style="text-align: center;">Month 1</h6>


              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_one_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_one_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_one_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_one_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>



                
              </div>




              <div class="col-md-2 co_month_two_show">
                <h6 class="card-title" style="text-align: center;">Month 2</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_two_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_two_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_two_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_two_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                

              </div>

              <div class="col-md-2 co_month_three_show">
                <h6 class="card-title" style="text-align: center;">Month 3</h6>

              <!--   <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_three_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_three_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
              
                      <input class="form-control co_three_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_three_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>

              <div class="col-md-2 co_month_four_show">
                <h6 class="card-title" style="text-align: center;">Month 4</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_four_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_four_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_four_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_four_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>

              <div class="col-md-2 co_month_five_show">
                <h6 class="card-title" style="text-align: center;">Month 5</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_five_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_five_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_five_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_five_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

              </div>



              <div class="col-md-2 co_month_six_show">
                <h6 class="card-title" style="text-align: center;">Latest Month</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      
                      <input class="form-control co_six_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                   
                      <input class="form-control co_six_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                      <input class="form-control co_six_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                    
                      <input class="form-control co_six_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
              </div>

            </div>





          </div>


          <div class="col-md-2" style="padding-right: 15px !important;">
            <h6 class="card-title" style="text-align: center;">Average Monthly</h6>

               <!--  <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                      <label class="label" for="">Date of ITR</label>
                      <input class="form-control" required="" data-validation-required-message="This field is required" type="date" name="" value="" placeholder="Bank Name">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_average_salary_gross_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Gross Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                   
                      <input class="form-control co_average_salary_tax" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Other Income" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                   
                      <input class="form-control co_average_salary_deduction" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                  <div class="form-group">
                    <div class="controls">
                     
                      <input class="form-control co_average_net_montly_income" required="" data-validation-required-message="This field is required" type="number" name="" value="0" placeholder="Depreciation" readonly="">
                      @if ($errors->has('bank_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('bank_name') }}</strong>
                      </span>
                    @endif</div>
                  </div>
                </div>
                
              </div>




             <!--  <div class="row">
                <div class="col-lg-12">
                  <div class="form-submit mt-10 mb-30 text-center">

                   <button type="submit" class="btn btn-primary">Calculate</button>
                 </div>
               </div>
             </div> -->
           </div><br>






         </div> 





       </form>
     </div>
   </div>






 </div>

<div class="col-lg-12">
 <div class="col-lg-12 col-md-12 col-sm-6">
  <h5>Future Rental</h5>
  <div class="row" >



    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Rent
       </label>
       <input type="number" class="form-control required future_rent" id="future_rent" value="0" name="future_rent">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Eligible Rental Income
      </label>
      <input type="number" class="form-control required eligilble_rental_income" value="0" id="eligilble_rental_income" name="eligilble_rental_income" readonly="">
    </div>

  </div>  

</div>

</div>

<div class="col-lg-12 col-md-12 col-sm-6">
  <h5>Other Monthly</h5>
  <div class="row" >



    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         other Monthly
       </label>
       <input type="number" class="form-control required other_monthy" value="0" id="other_monthy" name="other_monthy">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Eligible Other Income
      </label>
      <input type="number" class="form-control required eligilble_other_income" value="0" id="eligilble_rental_income" name="eligilble_other_income" readonly="">
    </div>

  </div>  

</div>

</div>
<div class="col-lg-12 col-md-12 col-sm-6">
  <h5>Running EMI</h5>
  <div class="row" id="input_fields_wrap">
    <div class="col-md-12" style="display: inline-flex;padding: 0px;">
               <div class="col-md-2" > 
        <div class="form-group">

          <label for="proposalTitle3">
            Bank Name
          </label>
          <input type="text" class="form-control required bank_name" value="0" id="proposalTitle3" name="bank_name[]">
        </div>

      </div>
             <div class="col-md-2" > 
        <div class="form-group">

          <label for="proposalTitle3">
           Sanction Date
          </label>
          <input type="text" class="form-control required sanction_date" value="0" id="proposalTitle3" name="sanction_date[]">
        </div>

      </div>
        <div class="col-md-2" > 
        <div class="form-group">

          <label for="proposalTitle3">
            Loan Amount
          </label>
          <input type="number" class="form-control required loan_amount" value="0" id="loan_amount" name="loan_amount[]">
        </div>

      </div>
            <div class="col-md-2" > 
        <div class="form-group">

          <label for="proposalTitle3">
           O/S Balance
          </label>
          <input type="number" class="form-control required o_s_balance" value="0" id="o_s_balance" name="o_s_balance[]">
        </div>

      </div>
      <div class="col-md-2" > 
        <div class="form-group">

          <label for="proposalTitle3">
            EMI
          </label>
          <input type="number" class="form-control required running_emi" value="0" id="proposalTitle3" name="emi[]">
        </div>

      </div>




      <a  id="add_field_button"   class=' btn-plus btn btn-outline-primary btn-sm  btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-plus'></i></a>
    </div>

  </div>





</div>

<div class="col-lg-12 col-md-12 col-sm-6">
  <h5>Total EMI</h5>
  <div class="row" id="input_fields_wrap">
    <div class="col-md-12" style="display: inline-flex;padding: 0px;">
      <div class="col-md-10" > 
        <div class="form-group">

          <label for="proposalTitle3">

          </label>
          <input type="number" class="form-control required total_emi_value" value="0" id="proposalTitle3" name="emi[]" readonly="">
        </div>

      </div>





    </div>

  </div>





</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 30px">
  <h5 class="move-right">Disposal Income Calculation </h5>
  <br>
  <div class="row" >
    <div class="col-sm-3">
     <h5 class="move-right" style="visibility: hidden;">As per</h5>
     <div class="col-md-12" > 
      <div class="form-group">

        <label for="proposalTitle3" class="main-label-itr">
         Total Monthly Gross Income
       </label>
       <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
      
     </div>

   </div>
   <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
        Deduction
      </label>
      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
      
    </div>

  </div>  
  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
        Net Income After Tax
      </label>
      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
     
    </div>

  </div> 

  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
        Other EMI
      </label>
     <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
        Net Income after all deduction
      </label>
     <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
       Gross Income
      </label>
      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3" class="main-label-itr">
        Disposable Income 
      </label>
      <input class="form-control label-input" readonly="" value="0" style="visibility: hidden;">
    </div>

  </div> 
  
  <div class="col-lg-12 col-md-12 col-sm-6">
  <h5 class="move-right">EMI Calculator </h5>
  <div class="row move-right" >


    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Loan Amount (Rs.)
       </label>
       <input type="number" class="form-control loan_amount_rs" id="loan_amount_rs" value="0" name="loan_amount_rs">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Interest (%)
      </label>
      <input type="number" class="form-control required interest" id="interest" value="0" name="interest">
    </div>

  </div>  
  <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Time Period (Months)
      </label>
      <input type="number" class="form-control required time_period" value="0" id="number_of_month time_period" name="time_period">
    </div>

  </div>  

  <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        EMI
      </label>
      <input type="number" class="form-control required final_emi" value="0" id="final_emi time_period" name="final_emi" readonly="">
    </div>

  </div> 


</div>


</div>

</div>

    <div class="col-sm-4">
     <h5 class="move-right" style="font-size: 1rem !important;">As per latest ITR & salary </h5>
     <div class="col-md-12" > 
      <div class="form-group">

        
       <input type="number" class="form-control total_monthly_gross_income" id="total_monthly_gross_income" value="0" name="total_monthly_gross_income" readonly="">
     </div>

   </div>
   <div class="col-md-12" > 
    <div class="form-group">

     
      <input type="number" class="form-control required new_deduction" id="new_deduction" value="0" name="new_deduction" readonly="">
    </div>

  </div>  
  <div class="col-md-12" > 
    <div class="form-group">

     
      <input type="number" class="form-control required net_income_after_tax" value="0" id="net_income_after_tax" name="time_period" readonly="">
    </div>

  </div> 

  <div class="col-md-12" > 
    <div class="form-group">

      <input type="number" class="form-control required other_emi" value="0" id="other_emi" name="other_emi" readonly="">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

     
      <input type="number" class="form-control required net_income_deduction" value="0" id="net_income_deduction" name="net_income_deduction" readonly="">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

      <input type="number" class="form-control required 40_gross_income" value="0" id="40_gross_income" name="time_period" readonly="">
    </div>

  </div> 
  <div class="col-md-12" > 
    <div class="form-group">

      
      <input type="number" class="form-control required total_disposal_income" value="0" id="total_disposal_income time_period" name="time_period" readonly="">
    </div>

  </div> 

</div>

<div class="col-sm-4">
  <h5 class="move-right" style="font-size: 1rem !important;"><input type="checkbox" class="average_itr" name="average_itr"> average of Three ITR & 6 Month salary </h5>
  <div class="col-md-12 average_itr_hidden" > 
    <div class="form-group">

      
     <input type="number" class="form-control total_monthly_gross_income_two" id="total_monthly_gross_income" value="0" name="total_monthly_gross_income" readonly="">
   </div>

 </div>
 <div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

   
    <input type="number" class="form-control required new_deduction_two" id="deduction" value="0" name="deduction" readonly="">
  </div>

</div>  
<div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

   
    <input type="number" class="form-control required net_income_after_tax_two" value="0" id="net_income_after_tax" name="time_period" readonly="">
  </div>

</div> 

<div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

   
    <input type="number" class="form-control required other_emi_two" value="0" id="other_emi" name="other_emi" readonly="">
  </div>

</div> 
<div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

   
    <input type="number" class="form-control required net_income_deduction_two" value="0" id="net_income_deduction" name="net_income_deduction" readonly="">
  </div>

</div> 
<div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

    <input type="number" class="form-control required 40_gross_income_two" value="0" id="40_gross_income" name="time_period" readonly="">
  </div>

</div> 
<div class="col-md-12 average_itr_hidden" > 
  <div class="form-group">

    <input type="number" class="form-control required total_disposal_income_two" value="0" id="total_disposal_income time_period" name="time_period" readonly="">
  </div>

</div> 

</div>




</div>


</div>

<div class="col-lg-12">

  <div class="row">



   <div class="col-lg-6">
    <h5 class="move-right"><input type="checkbox" class="max_quantum_check" name="max_quantum_check"> Maximum Quantam Eligibility</h5>
    <div class="row max_qua hidden" >

 <div class="col-md-12" > 

      <div class="col-md-12" > 
        <div class="form-group">

          <label for="proposalTitle3">
           Quantam for applicant
         </label>
         <input type="number" class="form-control required quantam_applicant" value="0" id="quantam_applicant" name="quantam_applicant" readonly="">
       </div>

     </div>
     <div class="col-md-12" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Quantam for co-applicant-1
       </label>
       <input type="number" class="form-control required quantam_applicant_one" value="0" id="quantam_applicant_one" name="quantam_applicant_one" readonly="">
     </div>

   </div>  

   <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3">
       Quantam for co-applicant-2
     </label>
     <input type="number" class="form-control required quantam_applicant_two" value="0" id="quantam_applicant_two" name="quantam_applicant_two" readonly="">
   </div>

 </div>  

 <div class="col-md-12" > 
  <div class="form-group">

    <label for="proposalTitle3">
     Quantam for co-applicant-3
   </label>
   <input type="number" class="form-control required quantam_applicant_three" value="0" id="quantam_applicant_three" name="quantam_applicant_three" readonly="">
 </div>

</div>  

<div class="col-md-12" > 
  <div class="form-group">

    <label for="proposalTitle3">
     Maximum Quantam for Home Loan
   </label>
   <input type="number" class="form-control required max_quantom_loan_home" value="0" id="max_quantom_loan_home" name="max_quantom_loan_home" readonly="">
 </div>

</div> 

</div>

</div>

</div>


<div class="col-lg-6">
  <h5 class="move-right"><input type="checkbox" class="max_term_check" name="max_term_check"> Maximum Term Eligibility</h5>
  <div class="row max_ter hidden" >

 <div class="col-md-12" > 

    <div class="col-md-12" > 
      <div class="form-group">

        <label for="proposalTitle3">
          Maximum Age In Months
        </label>
        <input type="number" class="form-control required maximum_age_month" value="0" id="maximum_age_month" name="maximum_age_month" readonly="">
      </div>

    </div>
    <div class="col-md-12" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Remaning age in month
       </label>
       <input type="number" class="form-control required remaining_age" value="0" id="remaining_age" name="remaining_age" readonly="">
     </div>

   </div>  

   <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3">
        MAXIMUM ELIGIBLE TERM IN MONTH
      </label>
      <input type="number" class="form-control required max_eligibile_term_month" value="0" id="max_eligibile_term_month" name="max_eligibile_term_month" readonly="">
    </div>

  </div>  

  <div class="col-md-12" > 
    <div class="form-group">

      <label for="proposalTitle3">
        MAX ELIGIBILE TERM WITH RELEX
      </label>
      <input type="number" class="form-control required max_eligibile_term_relax" value="0" id="max_eligibile_term_relax" name="max_eligibile_term_relax" readonly="">
    </div>

  </div>  
</div>

</div>

</div>
</div>

</div>






<div class="col-lg-12 col-md-12 col-sm-6">
  <h5 class="move-right">Eligibility as per repayment capacity</h5>
  <div class="row move-right" >



    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Interest Rate
       </label>
       <input type="number" class="form-control required interest_rate" value="0" id="interest_rate" name="interest_rate">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
       No. of Months
     </label>
     <input type="number" class="form-control required number_of_month" value="0" id="number_of_month" name="number_of_month">
   </div>

 </div>  


 <div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
      EMI Per Lakhs
    </label>
    <input type="number" class="form-control required emi_per_lakh" value="0" id="emi_per_lakh" name="emi_per_lakh" readonly="">
  </div>

</div>  

<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
      Eligible as per average income
    </label>
    <input type="number" class="form-control required eligilble_as_per_average_income" value="0" id="eligilble_as_per_average_income" name="eligilble_as_per_average_income" readonly="">
  </div>

</div> 

<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
      Eligible as per latest income
    </label>
    <input type="number" class="form-control required eligilble_as_per_latest" value="0" id="number_of_month" name="eligilble_as_per_latest" readonly="">
  </div>

</div>   

</div>

</div>

<!-- <div class="col-lg-12 col-md-12 col-sm-6">
  <h5>LTV Eligiblity</h5>
  <div class="row" >


    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         MKT Value of property
       </label>
       <input type="number" class="form-control required mkt_property" value="0" id="mkt_property" name="mkt_property">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
       Cost of Project (Agreement + GST)
     </label>
     <input type="number" class="form-control required cost_of_project" value="0" id="cost_of_project" name="cost_of_project">
   </div>

 </div>  
 <div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
     Loan Amount Applied
   </label>
   <input type="number" class="form-control required loan_amount_applied" value="0" id="loan_amount_applied" name="loan_amount_applied">
 </div>

</div>  
<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
     In Case of Takeover - BAL O/S
   </label>
   <input type="number" class="form-control required in_case_take" value="0" id="in_case_take" name="in_case_take">
 </div>

</div>  
</div>


</div> -->

<div class="col-lg-12 col-md-12 col-sm-6">
 <h5 class="move-right">LTV Eligiblity</h5>
 <div class="row move-right" >


  <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
       MKT Value of property
     </label>
     <input type="number" class="form-control required ltv_mkt_property" value="0" id="ltv_mkt_property" name="ltv_mkt_property">
   </div>

 </div>
 <div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
     Cost of Project (Agreement + GST)
   </label>
   <input type="number" class="form-control required ltv_cost_of_project" id="ltv_cost_of_project" value="0" name="ltv_cost_of_project">
 </div>

</div>  
<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
     Loan Amount Applied
   </label>
   <input type="number" class="form-control required ltv_loan_amount_applied" value="0" id="ltv_loan_amount_applied" name="ltv_loan_amount_applied">
 </div>

</div>  
<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
      Value to be consider
    </label>
    <input type="number" class="form-control required value_to_be_consider" value="0" id="value_to_be_consider" name="value_to_be_consider" readonly="">
  </div>

</div> 
<div class="col-md-6" > 
  <div class="form-group">

    <label for="proposalTitle3">
     In Case of Takeover - BAL O/S
   </label>
   <input type="number" class="form-control required ltv_takeover" id="ltv_takeover" value="0" name="ltv_takeover">
 </div>

</div>  
</div>

</div>


<div class="col-lg-12 col-md-12 col-sm-6">
  <h5 class="move-right">Eligible LTV</h5>
  <div class="row move-right" >


    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">

        </label>
        <input type="number" class="form-control required value_to_be_consider_two" value="0" id="property_value" name="value_to_be_consider_two" readonly="">
      </div>

    </div>
    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
          In Case of Takeover - BAL O/S
        </label>
        <input type="number" class="form-control required ltv_takeover_two" value="0" id="balance_home_loan_account" name="ltv_takeover_two" readonly="">
      </div>

    </div>  


  </div>


</div>

<div class="col-lg-12 col-md-12 col-sm-6">
  <h5 class="move-right">Eligible Home Loan Amount</h5>
  <div class="row move-right" >


    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
          MAXIMUM ELIGIBLE HOME LOAN AMOUNT (AVERAGE INCOME)
        </label>
        <input type="number" class="form-control required maximum_eligible_loan_average" value="0" id="maximum_eligible_loan_average" name="maximum_eligible_loan_average" readonly="">
      </div>

    </div>
    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         MAXIMUM ELIGIBLE HOME LOAN AMOUNT (LATEST YEAR/MONTH INCOME)
       </label>
       <input type="number" class="form-control required maximum_eligible_loan_year_month" value="0" id="maximum_eligible_loan_year_month" name="maximum_eligible_loan_year_month" readonly="">
     </div>

   </div>  


 </div>


</div>
<!--<div class="col-lg-12 col-md-12 col-sm-6">-->
<!-- <h5 class="move-right">Maximum Term HOME LOAN PLUS </h5>-->
<!-- <div class="row move-right" >-->


<!--  <div class="col-md-6" > -->
<!--    <div class="form-group">-->

<!--      <label for="proposalTitle3">-->
<!--        Loan Applied-->
<!--      </label>-->
<!--      <input type="number" class="form-control required loan_applied" value="0" id="loan_applied" name="loan_applied">-->
<!--    </div>-->

<!--  </div>-->
<!--  <div class="col-md-6" > -->
<!--    <div class="form-group">-->

<!--      <label for="proposalTitle3">-->
<!--       Balance in Home Loan Account-->
<!--     </label>-->
<!--     <input type="number" class="form-control required balance_home_loan_account_one" value="0" id="balance_home_loan_account_one" name="balance_home_loan_account_one">-->
<!--   </div>-->

<!-- </div>  -->


<!--</div>-->


<!--</div>-->


<div class="col-lg-12 col-md-12 col-sm-6">
  <h5 class="move-right">EMI Calculator </h5>
  <div class="row move-right" >


    <div class="col-md-6" > 
      <div class="form-group">

        <label for="proposalTitle3">
         Loan Amount (Rs.)
       </label>
       <input type="number" class="form-control loan_amount_rs" id="loan_amount_rs" value="0" name="loan_amount_rs">
     </div>

   </div>
   <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Interest (%)
      </label>
      <input type="number" class="form-control required interest" id="interest" value="0" name="interest">
    </div>

  </div>  
  <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        Time Period (Months)
      </label>
      <input type="number" class="form-control required time_period" value="0" id="number_of_month time_period" name="time_period">
    </div>

  </div>  

  <div class="col-md-6" > 
    <div class="form-group">

      <label for="proposalTitle3">
        EMI
      </label>
      <input type="number" class="form-control required final_emi" value="0" id="final_emi time_period" name="final_emi" readonly="">
    </div>

  </div> 


</div>


</div>








<div class="row" style="display: inline-flex !important;">

  <div class="col-lg-5">

  </div>
<!--   <div class="col-lg-2">
    <div class="form-submit mt-10 mb-30 text-center">

     <button type="button" class="btn btn-primary calculate">Calculate</button>
   </div>
 </div> -->
 <div class="col-lg-2">
  <div class="form-submit mt-10 mb-30 text-center">
   <button type="button" onclick="window.print();" class="btn btn-success waves-effect waves-light no-print">Print
   </button>
 </div>
</div>
<br>
</div>




<br>

</div>

</div>


</section>
</div>
</div>

<script type="text/javascript">


  /*start of code for add and delete step 3*/

  $(document).ready(function() {
    var max_fields = 10; 

    var x = 1; 
    $("#add_field_button").click(function(e){ 

      e.preventDefault();

      if(x < max_fields){ 
        x++;


        $("#input_fields_wrap").append("<div class='col-md-12' style='display: inline-flex;padding: 0px;'> <div class='col-md-2' ><div class='form-group'><input type='text' class='form-control required bank_name' value='0' id='proposalTitle3' name='bank_name[]''></div></div><div class='col-md-2' ><div class='form-group'><input type='text' class='form-control required sanction_date' value='0' id='proposalTitle3' name='sanction_date[]'> </div></div><div class='col-md-2' > <div class='form-group'><input type='number' class='form-control required loan_amount' value='0' id='loan_amount' name='loan_amount[]'></div></div><div class='col-md-2' > <div class='form-group'> <input type='number' class='form-control required o_s_balance' value='0' id='o_s_balance' name='o_s_balance[]'></div></div><div class='col-md-2' ><div class='form-group'><input type='number' class='form-control required running_emi' value='0' id='proposalTitle3' name='emi[]'></div></div><br><a class='btn btn btn-outline-primary btn-sm dlt btn-align' style='height:40px;margin-top:0.1%;'><i class='fa fa-minus'></i></a></div>");
      }

    });
    
    $("#input_fields_wrap").on("click",".dlt", function(e){ //user click on remove text


      e.preventDefault(); $(this).parent('div').remove(); x--;
    });
  });

  /*end of code for add and delete step 3*/


  $(document).ready(function() {
    var max_fields = 20; 

    var x = 1; 
    $("#add_dep1_button").click(function(e){ 

      e.preventDefault();

      if(x < max_fields){ 
        x++;


        $("#input_fields_wrap_dep").append("<div class='col-md-12' style='display: inline-flex;padding: 0px;'><div class='col-md-10' ><div class='form-group'><label for='proposalTitle3'></label><input type='text' class='form-control required' id='proposalTitle3' name='other_dep[]'></div></div><br><a class='btn btn btn-outline-primary btn-sm dlt btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-minus'></i></a></div>");
      }

    });
    
    $("#input_fields_wrap_dep").on("click",".dlt", function(e){ //user click on remove text


      e.preventDefault(); $(this).parent('div').remove(); x--;
    });
  });





</script>
<script>
 function show1() {
  var radioButton = document.getElementById("salariedTab");
  radioButton.checked = false;

  $('.working').addClass('hidden');
  $('.business').removeClass('hidden');


}
function show2() {


  $('.business').addClass('hidden');
  $('.working').removeClass('hidden');
  var radioButton = document.getElementById("selfTab");
  radioButton.checked = false;


}


$(".date_of_birth").on("change",function(){
  var selected = $(this).val();
  if(selected != ''){
    var str=selected.split('-');    
    var firstdate=new Date(str[0],str[1],str[2]);


    var today = new Date();        
    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);

    // alert(dayDiff);
    var age = parseInt(dayDiff);
    $('.age').val(Math.round(age));
  }
});

$('input').keyup(function(){
    
//     jQuery.fn.abacus=function(options){var options=jQuery.extend({error:!1,comment:!1,calculatewrapper:!1,calculate:!1,oncalculate:!1,onendcalculate:!1,onready:!1,onfocus:!1,onblur:!1,onerror:!1,onenter:!1,onescape:!1,oninput:!1,ifnull:"",sign:!0},options),convert=function(e,n){var a="0",o="",t="00";if(2!=(n=n||(n=2))){t="";for(var l=0;l<n;l++)t+=String("0")}if(!isNaN(parseFloat(e))){o=(a=parseFloat(Math.abs(e)).toFixed(n).toString()).substr(a.indexOf(".")+1,n).toString(),a=parseInt(a).toString();for(var u=/(\d+)(\d{3})/;u.test(a);)a=a.replace(u,"$1 $2");if(o!=t){var r=/[0]*$/g;a+="."+o.replace(r,"")}e<0&&(a="−"+a)}return a};return this.each(function(){var nchars=new RegExp(/[\!\@\#\№\$\%\^\&\=\[\]\\\'\;\{\}\|\"\:\<\>\?~\`\_A-ZА-Яa-zа-я]/),chars="1234567890+-/*,. ",errTimer=void 0,focusObj=this,valueBack=0,valueYng=0,metic=new RegExp(/[\+\-\*\/]/),meticI=new RegExp(/^[\+\-\*\/]/),toValueBack=!1;jQuery(this).blur(function(){if(toValueBack&&(valueYng=valueBack),toValueBack=!1,options.sign)e=valueYng<0?"-":"";else var e="";0!=(valueYng=Math.abs(valueYng))?($(focusObj).val(e+convert(valueYng)),options.onblur&&options.onblur(focusObj,e+convert(valueYng))):($(focusObj).val(options.ifnull),options.onblur&&options.onblur(focusObj,options.ifnull))}),jQuery(this).keypress(function(e){var n;if(e.charCode?(n=String.fromCharCode(e.charCode),c=e.charCode):(n=String.fromCharCode(e.which),c=e.which),37==c||39==c)return!0;e.ctrlKey||nchars.test(n)||13==e.keyCode&&(options.onenter&&setTimeout(function(){options.onenter(focusObj,valueYng)},100),focusObj.blur())}),jQuery(this).keyup(function(e){if(valueYng=String(focusObj.value).replace(/ /g,"").replace(/,/g,"."),27==e.keyCode)return toValueBack=!0,options.onescape&&options.onescape(focusObj,valueBack),void focusObj.blur();var comp=metic.test(valueYng);if(comp){if(comp=meticI.test(valueYng)){var tStr=String(valueBack)+String(valueYng);try{valueYng=parseFloat(eval(tStr),10),valueYng=isNaN(valueYng)?0:valueYng,valueYng=isFinite(valueYng)?valueYng:0,jQuery(options.calculate).html(convert(valueYng))}catch(e){valueYng=0,jQuery(options.calculate).html(valueYng)}}else{var tStr=String(valueYng);try{valueYng=parseFloat(eval(tStr),10),valueYng=isNaN(valueYng)?0:valueYng,valueYng=isFinite(valueYng)?valueYng:0,jQuery(options.calculate).html(convert(valueYng))}catch(e){valueYng=0,jQuery(options.calculate).html(valueYng)}}options.oncalculate&&options.oncalculate(valueYng)}else isNaN(parseFloat(valueYng,10))?(valueYng=0,jQuery(options.calculate).html(valueYng)):jQuery(options.calculate).html(convert(parseFloat(valueYng,10))),options.onendcalculate&&options.onendcalculate(valueYng);options.oninput&&options.oninput(this,e.keyCode)}),options.onready&&options.onready(this)})};
//   $('input').abacus();

if($('.year_one_check').is(':checked')){
    
    year_one_check=12;
}else{
    year_one_check=0;
}


if($('.year_two_check').is(':checked')){
    
    year_two_check=12;
}else{
    year_two_check=0;
}

if($('.year_three_check').is(':checked')){
    
    year_three_check=12;
}else{
    year_three_check=0;
}

var total_year_month=parseFloat(year_one_check)+parseFloat(year_two_check)+parseFloat(year_three_check);

if($('.co_year_one_check').is(':checked')){
    
    co_year_one_check=12;
}else{
    co_year_one_check=0;
}


if($('.co_year_two_check').is(':checked')){
    
    co_year_two_check=12;
}else{
    co_year_two_check=0;
}

if($('.co_year_three_check').is(':checked')){
    
    co_year_three_check=12;
}else{
    co_year_three_check=0;
}

var co_total_co_year_month=parseFloat(co_year_one_check)+parseFloat(co_year_two_check)+parseFloat(co_year_three_check);





if($('.month_one_check').is(':checked')){
    
    month_one_check=1;
}else{
    month_one_check=0;
}


if($('.month_two_check').is(':checked')){
    
    month_two_check=1;
}else{
    month_two_check=0;
}



if($('.month_three_check').is(':checked')){
    
    month_three_check=1;
}else{
    month_three_check=0;
}


if($('.month_four_check').is(':checked')){
    
    month_four_check=1;
}else{
    month_four_check=0;
}


if($('.month_five_check').is(':checked')){
    
    month_five_check=1;
}else{
    month_five_check=0;
}


if($('.month_six_check').is(':checked')){
    
    month_six_check=1;
}else{
    month_six_check=0;
}


var month_check=parseFloat(month_one_check)+parseFloat(month_two_check)+parseFloat(month_three_check)+parseFloat(month_four_check)+parseFloat(month_five_check)+parseFloat(month_six_check)


if($('.co_month_one_check').is(':checked')){
    
    co_month_one_check=1;
}else{
    co_month_one_check=0;
}



if($('.year_two_check').is(':checked')){
    
    co_month_two_check=1;
}else{
    co_month_two_check=0;
}


if($('.co_month_three_check').is(':checked')){
    
    co_month_three_check=1;
}else{
    co_month_three_check=0;
}

if($('.co_month_four_check').is(':checked')){
    
    co_month_four_check=1;
}else{
    co_month_four_check=0;
}


if($('.co_month_five_check').is(':checked')){
    
    co_month_five_check=1;
}else{
    co_month_five_check=0;
}

if($('.co_month_six_check').is(':checked')){
    
    co_month_six_check=1;
}else{
    co_month_six_check=0;
}


var co_month_check=parseFloat(co_month_one_check)+parseFloat(co_month_two_check)+parseFloat(co_month_three_check)+parseFloat(co_month_four_check)+parseFloat(co_month_five_check)+parseFloat(co_month_six_check)



    
    

  var profession_type = $("input[name='profession_type']:checked").val();


  var future_rental=$('.future_rent').val();
  var other_monthy=$('.other_monthy').val();
  var running_emi=$('.running_emi').val();
  if (running_emi==undefined || running_emi==null || running_emi=="") {
   var running_emi=0;
 }
 var running_emi_one=$('.running_emi2').val();
 if (running_emi_one==undefined || running_emi_one==null || running_emi_one=="") {
   var running_emi_one=0;
 }
 var running_emi_two=$('.running_emi3').val();
 if (running_emi_two==undefined || running_emi_two==null || running_emi_two=="") {
   var running_emi_two=0;
 }
 var running_emi_three=$('.running_emi4').val();
 if (running_emi_three==undefined || running_emi_three==null || running_emi_three=="") {
   var running_emi_three=0;
 }
 var running_emi_four=$('.running_emi5').val();
 if (running_emi_four==undefined || running_emi_four==null || running_emi_four=="") {
   var running_emi_four=0;
 }
 var running_emi_five=$('.running_emi6').val();
 if (running_emi_five==undefined || running_emi_five==null || running_emi_five=="") {
   var running_emi_five=0;
 }
 var running_emi_six=$('.running_emi7').val();
 if (running_emi_six==undefined || running_emi_six==null || running_emi_six=="") {
   var running_emi_six=0;
 }
 var running_emi_seven=$('.running_emi8').val();
 if (running_emi_seven==undefined || running_emi_seven==null || running_emi_seven=="") {
   var running_emi_seven=0;
 }
 var running_emi_eight=$('.running_emi9').val();
 if (running_emi_eight==undefined || running_emi_eight==null || running_emi_eight=="") {
   var running_emi_eight=0;
 }
 var running_emi_nine=$('.running_emi10').val();
 if (running_emi_nine==undefined || running_emi_nine==null || running_emi_nine=="") {
   var running_emi_nine=0;
 }
 var running_emi_ten=$('.running_emi11').val();
 if (running_emi_ten==undefined || running_emi_ten==null || running_emi_ten=="") {
   var running_emi_ten=0;
 }
 var running_emi_eleven=$('.running_emi12').val();
 if (running_emi_eleven==undefined || running_emi_eleven==null || running_emi_eleven=="") {
   var running_emi_eleven=0;
 }
 var running_emi_twelve=$('.running_emi13').val();
 if (running_emi_twelve==undefined || running_emi_twelve==null || running_emi_twelve=="") {
   var running_emi_twelve=0;
 }
 var running_emi_thirteen=$('.running_emi14').val();
 if (running_emi_thirteen==undefined || running_emi_thirteen==null || running_emi_thirteen=="") {
   var running_emi_thirteen=0;
 }
 var running_emi_fourteen=$('.running_emi15').val();
 if (running_emi_fourteen==undefined || running_emi_fourteen==null || running_emi_fourteen=="") {
   var running_emi_fourteen=0;
 }
 var running_emi_fifteen=$('.running_emi16').val();
 if (running_emi_fifteen==undefined || running_emi_fifteen==null || running_emi_fifteen=="") {
   var running_emi_fifteen=0;
 }
 var running_emi_sixteen=$('.running_emi17').val();
 if (running_emi_sixteen==undefined || running_emi_sixteen==null || running_emi_sixteen=="") {
   var running_emi_sixteen=0;
 }
 var running_emi_seventeen=$('.running_emi18').val();
 if (running_emi_seventeen==undefined || running_emi_seventeen==null || running_emi_seventeen=="") {
   var running_emi_seventeen=0;
 }
 var running_emi_eighteen=$('.running_emi19').val();
 if (running_emi_eighteen==undefined || running_emi_eighteen==null || running_emi_eighteen=="") {
   var running_emi_eighteen=0;
 }
 var running_emi_nineteen=$('.running_emi20').val();
 if (running_emi_nineteen==undefined || running_emi_nineteen==null || running_emi_nineteen=="") {
   var running_emi_nineteen=0;
 }
 var running_emi_twenty=$('.running_emi21').val();
 if (running_emi_twenty==undefined || running_emi_twenty==null || running_emi_twenty=="") {
   var running_emi_twenty=0;
 }


 var total_emi=parseFloat(running_emi)+parseFloat(running_emi_one)+parseFloat(running_emi_two)+parseFloat(running_emi_three)+parseFloat(running_emi_four)+parseFloat(running_emi_five)+parseFloat(running_emi_six)+parseFloat(running_emi_seven)+parseFloat(running_emi_eight)+parseFloat(running_emi_nine)+parseFloat(running_emi_ten)+parseFloat(running_emi_twelve)+parseFloat(running_emi_thirteen)+parseFloat(running_emi_fourteen)+parseFloat(running_emi_fifteen)+parseFloat(running_emi_sixteen)+parseFloat(running_emi_seventeen)+parseFloat(running_emi_eighteen)+parseFloat(running_emi_nineteen)+parseFloat(running_emi_twenty);

 $('.total_emi_value').val(total_emi);

 var master_rental_margin=$('.master_rental_margin').val();

 var eligilble_rental_income=parseFloat(future_rental)*parseFloat(master_rental_margin)/100;

 var eligilble_other_income=other_monthy;

 $('.eligilble_rental_income').val(eligilble_rental_income);
 $('.eligilble_other_income').val(eligilble_other_income);



    // var future_rental=$('.future_rent').val();
    // var other_monthy=$('.other_monthy').val();

    // if (profession_type=="self") {


      // Salaried Start

      // Month1 Borrower

      var one_salary_gross_income=$(".one_salary_gross_income").val();
      var one_salary_tax=$(".one_salary_tax").val();
      var one_salary_deduction=$(".one_salary_deduction").val();

      var one_net_montly_income=parseFloat(one_salary_gross_income)-parseFloat(one_salary_tax)-parseFloat(one_salary_deduction);
      
      $('.one_net_montly_income').val(one_net_montly_income);




      // Month2 Borrower

      var two_salary_gross_income=$(".two_salary_gross_income").val();
      var two_salary_tax=$(".two_salary_tax").val();
      var two_salary_deduction=$(".two_salary_deduction").val();

      var two_net_montly_income=parseFloat(two_salary_gross_income)-parseFloat(two_salary_tax)-parseFloat(two_salary_deduction);
       
      $('.two_net_montly_income').val(two_net_montly_income);




      // Month3 Borrower
      

      var three_salary_gross_income=$(".three_salary_gross_income").val();
      var three_salary_tax=$(".three_salary_tax").val();
      var three_salary_deduction=$(".three_salary_deduction").val();

      var three_net_montly_income=parseFloat(three_salary_gross_income)-parseFloat(three_salary_tax)-parseFloat(three_salary_deduction);
       
      $('.three_net_montly_income').val(three_net_montly_income);



      // Month4 Borrower


      var four_salary_gross_income=$(".four_salary_gross_income").val();
      var four_salary_tax=$(".four_salary_tax").val();
      var four_salary_deduction=$(".four_salary_deduction").val();

      var four_net_montly_income=parseFloat(four_salary_gross_income)-parseFloat(four_salary_tax)-parseFloat(four_salary_deduction);

      $('.four_net_montly_income').val(four_net_montly_income);



      // Month5 Borrower

      var five_salary_gross_income=$(".five_salary_gross_income").val();
      var five_salary_tax=$(".five_salary_tax").val();
      var five_salary_deduction=$(".five_salary_deduction").val();

      var five_net_montly_income=parseFloat(five_salary_gross_income)-parseFloat(five_salary_tax)-parseFloat(five_salary_deduction);

       $('.five_net_montly_income').val(five_net_montly_income);


      // Month6 Borrower


      var six_salary_gross_income=$(".six_salary_gross_income").val();
      var six_salary_tax=$(".six_salary_tax").val();
      var six_salary_deduction=$(".six_salary_deduction").val();

      var six_net_montly_income=parseFloat(six_salary_gross_income)-parseFloat(six_salary_tax)-parseFloat(six_salary_deduction);

      $('.six_net_montly_income').val(six_net_montly_income);

     // Month1 CoBorrower

     var co_one_salary_gross_income=$(".co_one_salary_gross_income").val();
     var co_one_salary_tax=$(".co_one_salary_tax").val();
     var co_one_salary_deduction=$(".co_one_salary_deduction").val();

     var co_one_net_montly_income=parseFloat(co_one_salary_gross_income)-parseFloat(co_one_salary_tax)-parseFloat(co_one_salary_deduction);

     $('.co_one_net_montly_income').val(co_one_net_montly_income);



      // Month2 CoBorrower

      var co_two_salary_gross_income=$(".co_two_salary_gross_income").val();
      var co_two_salary_tax=$(".co_two_salary_tax").val();
      var co_two_salary_deduction=$(".co_two_salary_deduction").val();

      var co_two_net_montly_income=parseFloat(co_two_salary_gross_income)-parseFloat(co_two_salary_tax)-parseFloat(co_two_salary_deduction);

      $('.co_two_net_montly_income').val(co_two_net_montly_income);




      // Month3 CoBorrower
      

      var co_three_salary_gross_income=$(".co_three_salary_gross_income").val();
      var co_three_salary_tax=$(".co_three_salary_tax").val();
      var co_three_salary_deduction=$(".co_three_salary_deduction").val();

      var co_three_net_montly_income=parseFloat(co_three_salary_gross_income)-parseFloat(co_three_salary_tax)-parseFloat(co_three_salary_deduction);

       $('.co_three_net_montly_income').val(co_three_net_montly_income);


      // Month4 CoBorrower


      var co_four_salary_gross_income=$(".co_four_salary_gross_income").val();
      var co_four_salary_tax=$(".co_four_salary_tax").val();
      var co_four_salary_deduction=$(".co_four_salary_deduction").val();

      var co_four_net_montly_income=parseFloat(co_four_salary_gross_income)-parseFloat(co_four_salary_tax)-parseFloat(co_four_salary_deduction);

        $('.co_four_net_montly_income').val(co_four_net_montly_income);



      // Month5 CoBorrower

      var co_five_salary_gross_income=$(".co_five_salary_gross_income").val();
      var co_five_salary_tax=$(".co_five_salary_tax").val();
      var co_five_salary_deduction=$(".co_five_salary_deduction").val();

      var co_five_net_montly_income=parseFloat(co_five_salary_gross_income)-parseFloat(co_five_salary_tax)-parseFloat(co_five_salary_deduction);

      $('.co_five_net_montly_income').val(co_five_net_montly_income);


      // Month6 CoBorrower


      var co_six_salary_gross_income=$(".co_six_salary_gross_income").val();
      var co_six_salary_tax=$(".co_six_salary_tax").val();
      var co_six_salary_deduction=$(".co_six_salary_deduction").val();

      var co_six_net_montly_income=parseFloat(co_six_salary_gross_income)-parseFloat(co_six_salary_tax)-parseFloat(co_six_salary_deduction);
       
         $('.co_six_net_montly_income').val(co_six_net_montly_income);


      // Average Borower

      var average_salary_gross_income=(parseFloat(one_salary_gross_income)+parseFloat(two_salary_gross_income)+parseFloat(three_salary_gross_income)+parseFloat(four_salary_gross_income)+parseFloat(five_salary_gross_income)+parseFloat(six_salary_gross_income))/parseFloat(month_check);
      
      var average_salary_tax=(parseFloat(one_salary_tax)+parseFloat(two_salary_tax)+parseFloat(three_salary_tax)+parseFloat(four_salary_tax)+parseFloat(five_salary_tax)+parseFloat(six_salary_tax))/parseFloat(month_check);

      var average_salary_deduction=(parseFloat(one_salary_deduction)+parseFloat(two_salary_deduction)+parseFloat(three_salary_deduction)+parseFloat(four_salary_deduction)+parseFloat(five_salary_deduction)+parseFloat(six_salary_deduction))/parseFloat(month_check);


      var average_net_montly_income=(parseFloat(one_net_montly_income)+parseFloat(two_net_montly_income)+parseFloat(three_net_montly_income)+parseFloat(four_net_montly_income)+parseFloat(five_net_montly_income)+parseFloat(six_net_montly_income))/parseFloat(month_check);


      $('.average_salary_gross_income').val(Math.round(average_salary_gross_income));
      $('.average_salary_tax').val(Math.round(average_salary_tax));
      $('.average_salary_deduction').val(Math.round(average_salary_deduction));
      $('.average_net_montly_income').val(Math.round(average_net_montly_income));


      // Average CoBorower

      var co_average_salary_gross_income=(parseFloat(co_one_salary_gross_income)+parseFloat(co_two_salary_gross_income)+parseFloat(co_three_salary_gross_income)+parseFloat(co_four_salary_gross_income)+parseFloat(co_five_salary_gross_income)+parseFloat(co_six_salary_gross_income))/parseFloat(co_month_check);
      
      var co_average_salary_tax=(parseFloat(co_one_salary_tax)+parseFloat(co_two_salary_tax)+parseFloat(co_three_salary_tax)+parseFloat(co_four_salary_tax)+parseFloat(co_five_salary_tax)+parseFloat(co_six_salary_tax))/parseFloat(co_month_check);
      var co_average_salary_deduction=(parseFloat(co_one_salary_deduction)+parseFloat(co_two_salary_deduction)+parseFloat(co_three_salary_deduction)+parseFloat(co_four_salary_deduction)+parseFloat(co_five_salary_deduction)+parseFloat(co_six_salary_deduction))/parseFloat(co_month_check);


      var co_average_net_montly_income=(parseFloat(co_one_net_montly_income)+parseFloat(co_two_net_montly_income)+parseFloat(co_three_net_montly_income)+parseFloat(co_four_net_montly_income)+parseFloat(co_five_net_montly_income)+parseFloat(co_six_net_montly_income))/parseFloat(co_month_check);
      

      $('.co_average_salary_gross_income').val(Math.round(co_average_salary_gross_income));
      $('.co_average_salary_tax').val(Math.round(co_average_salary_tax));
      $('.co_average_salary_deduction').val(Math.round(co_average_salary_deduction));
      $('.co_average_net_montly_income').val(Math.round(co_average_net_montly_income));






// Self or profession start

      // Brower Start


      // Year1

      var self_itr_year_one=$(".self_itr_year_one").val();
      var self_gross_income_year_one=$(".self_gross_income_year_one").val();
      var self_agriculture_income_year_one=$(".self_agriculture_income_year_one").val();
      var self_other_income_year_one=$(".self_other_income_year_one").val();
      var self_depreciation_year_one=$(".self_depreciation_year_one").val();
      var self_tax_year_one=$(".self_tax_year_one").val();
      var self_other_ded_year_one=$(".self_other_ded_year_one").val();

// Year2

var self_itr_year_two=$(".self_itr_year_two").val();
var self_gross_income_year_two=$(".self_gross_income_year_two").val();
var self_agriculture_income_year_two=$(".self_agriculture_income_year_two").val();
var self_other_income_year_two=$(".self_other_income_year_two").val();
var self_depreciation_year_two=$(".self_depreciation_year_two").val();
var self_tax_year_two=$(".self_tax_year_two").val();
var self_other_ded_year_two=$(".self_other_ded_year_two").val();

// Year3

var self_itr_year_three=$(".self_itr_year_three").val();
var self_gross_income_year_three=$(".self_gross_income_year_three").val();
var self_agriculture_income_year_three=$(".self_agriculture_income_year_three").val();
var self_other_income_year_three=$(".self_other_income_year_three").val();
var self_depreciation_year_three=$(".self_depreciation_year_three").val();
var self_tax_year_three=$(".self_tax_year_three").val();
var self_other_ded_year_three=$(".self_other_ded_year_three").val();




  // borrower latest year monthly average
  var self_latest_monthly_average_gross=parseFloat(self_gross_income_year_three)/12;
  console.log(self_latest_monthly_average_gross);
  var self_latest_monthly_average_agriculture=parseFloat(self_agriculture_income_year_three)/12;
  var self_latest_monthly_average_other_income=parseFloat(self_other_income_year_three)/12;
  var self_latest_monthly_average_depreciation=parseFloat(self_depreciation_year_three)/12;

  var self_latest_monthly_average_tax=parseFloat(self_tax_year_three)/12;
  var self_latest_monthly_average_ded=parseFloat(self_other_ded_year_three)/12;

   // borrower All year monthly Average

   var self_all_monthly_average_gross=(parseFloat(self_gross_income_year_one)+parseFloat(self_gross_income_year_two)+parseFloat(self_gross_income_year_three))/parseFloat(total_year_month);

   console.log(self_all_monthly_average_gross+ " " +total_year_month);
   var self_all_monthly_average_agriculture=(parseFloat(self_agriculture_income_year_one)+parseFloat(self_agriculture_income_year_two)+parseFloat(self_agriculture_income_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_other_income=(parseFloat(self_other_income_year_one)+parseFloat(self_other_income_year_two)+parseFloat(self_other_income_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_depreciation=(parseFloat(self_depreciation_year_one)+parseFloat(self_depreciation_year_two)+parseFloat(self_depreciation_year_three))/parseFloat(total_year_month);

   var self_all_monthly_average_tax=(parseFloat(self_tax_year_one)+parseFloat(self_tax_year_two)+parseFloat(self_tax_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_ded=(parseFloat(self_other_ded_year_one)+parseFloat(self_other_ded_year_two)+parseFloat(self_other_ded_year_three))/parseFloat(total_year_month);



// borrower Total Gross
var self_total_gross_year_one=parseFloat(self_gross_income_year_one)+parseFloat(self_agriculture_income_year_one)+parseFloat(self_other_income_year_one)+parseFloat(self_depreciation_year_one);
var self_total_gross_year_two=parseFloat(self_gross_income_year_two)+parseFloat(self_agriculture_income_year_two)+parseFloat(self_other_income_year_two)+parseFloat(self_depreciation_year_two);
var self_total_gross_year_three=parseFloat(self_gross_income_year_three)+parseFloat(self_agriculture_income_year_three)+parseFloat(self_other_income_year_three)+parseFloat(self_depreciation_year_three);
// borrower latest year average_total_income
var self_total_year_three_average=parseFloat(self_latest_monthly_average_gross)+parseFloat(self_latest_monthly_average_agriculture)+parseFloat(self_latest_monthly_average_other_income)+parseFloat(self_latest_monthly_average_depreciation);

  // borrower all average_total_income
  var self_total_year_all_average=parseFloat(self_all_monthly_average_gross)+parseFloat(self_all_monthly_average_agriculture)+parseFloat(self_all_monthly_average_other_income)+parseFloat(self_all_monthly_average_depreciation);




// borrower Total Deduction
var self_total_deduction_year_one=parseFloat(self_tax_year_one)+parseFloat(self_other_ded_year_one);
var self_total_deduction_year_two=parseFloat(self_tax_year_two)+parseFloat(self_other_ded_year_two);
var self_total_deduction_year_three=parseFloat(self_tax_year_three)+parseFloat(self_other_ded_year_three);
// borrower average_total_deduction
var self_total_deduction_year_three_average=parseFloat(self_latest_monthly_average_tax)+parseFloat(self_latest_monthly_average_ded);

  // borrower all average_total_deduction
  var self_total_deduction_year_all_average=parseFloat(self_all_monthly_average_tax)+parseFloat(self_latest_monthly_average_ded);


  // gross push && deduct push
  $('.self_total_gross_year_one').val(Math.round(self_total_gross_year_one));
  $('.self_total_gross_year_two').val(Math.round(self_total_gross_year_two));
  $('.self_total_gross_year_three').val(Math.round(self_total_gross_year_three));
  $('.self_total_deduction_year_one').val(Math.round(self_total_deduction_year_one));
  $('.self_total_deduction_year_two').val(Math.round(self_total_deduction_year_two));
  $('.self_total_deduction_year_three').val(Math.round(self_total_deduction_year_three));

    // latest average push
    $('.self_latest_monthly_average_gross').val(Math.round(self_latest_monthly_average_gross));
    $('.self_latest_monthly_average_agriculture').val(Math.round(self_latest_monthly_average_agriculture));
    $('.self_latest_monthly_average_other_income').val(Math.round(self_latest_monthly_average_other_income));
    $('.self_latest_monthly_average_depreciation').val(Math.round(self_latest_monthly_average_depreciation));
    $('.self_latest_monthly_average_tax').val(Math.round(self_latest_monthly_average_tax));
    $('.self_latest_monthly_average_ded').val(Math.round(self_latest_monthly_average_ded));

    // all average push
    $('.self_all_monthly_average_gross').val(Math.round(self_all_monthly_average_gross));
    $('.self_all_monthly_average_agriculture').val(Math.round(self_all_monthly_average_agriculture));
    $('.self_all_monthly_average_other_income').val(Math.round(self_all_monthly_average_other_income));
    $('.self_all_monthly_average_depreciation').val(Math.round(self_all_monthly_average_depreciation));
    $('.self_all_monthly_average_tax').val(Math.round(self_all_monthly_average_tax));
    $('.self_all_monthly_average_ded').val(Math.round(self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.self_total_deduction_year_three_average').val(Math.round(self_total_deduction_year_three_average));
    $('.self_total_deduction_year_all_average').val(Math.round(self_total_deduction_year_all_average));
    $('.self_total_year_three_average').val(Math.round(self_total_year_three_average));
    $('.self_total_year_all_average').val(Math.round(self_total_year_all_average));



    // Brower End


    // Co Brower


    // Cobrower

      // Year1

// var co_self_itr_year_one=$(".co_self_itr_year_one").val();
// var co_self_gross_income_year_one=$(".co_self_gross_income_year_one").val();
// var co_self_agriculture_income_year_one=$(".co_self_agriculture_income_year_one").val();
// var co_self_other_income_year_one=$(".co_self_other_income_year_one").val();
// var co_self_depreciation_year_one=$(".co_self_depreciation_year_one").val();
// var co_self_tax_year_one=$(".co_self_tax_year_one").val();
// var co_self_other_ded_year_one=$(".co_self_other_ded_year_one").val();

// Year2

// var co_self_itr_year_two=$(".co_self_itr_year_two").val();
// var co_self_gross_income_year_two=$(".co_self_gross_income_year_two").val();
// var co_self_agriculture_income_year_two=$(".co_self_agriculture_income_year_two").val();
// var co_self_other_income_year_two=$(".co_self_other_income_year_two").val();
// var co_self_depreciation_year_two=$(".co_self_depreciation_year_two").val();
// var co_self_tax_year_two=$(".co_self_tax_year_two").val();
// var co_self_other_ded_year_two=$(".co_self_other_ded_year_two").val();

// Year3

// var co_self_itr_year_three=$(".co_self_itr_year_three").val();
// var co_self_gross_income_year_three=$(".co_self_gross_income_year_three").val();
// var co_self_agriculture_income_year_three=$(".co_self_agriculture_income_year_three").val();
// var co_self_other_income_year_three=$(".co_self_other_income_year_three").val();
// var co_self_depreciation_year_three=$(".co_self_depreciation_year_three").val();
// var co_self_tax_year_three=$(".co_self_tax_year_three").val();
// var co_self_other_ded_year_three=$(".co_self_other_ded_year_three").val();


      // Year1

      var co_self_itr_year_one=$(".co_self_itr_year_one").val();
      var co_self_gross_income_year_one=$(".co_self_gross_income_year_one").val();
      var co_self_agriculture_income_year_one=$(".co_self_agriculture_income_year_one").val();
      var co_self_other_income_year_one=$(".co_self_other_income_year_one").val();
      var co_self_depreciation_year_one=$(".co_self_depreciation_year_one").val();
      var co_self_tax_year_one=$(".co_self_tax_year_one").val();
      var co_self_other_ded_year_one=$(".co_self_other_ded_year_one").val();

// Year2

var co_self_itr_year_two=$(".co_self_itr_year_two").val();
var co_self_gross_income_year_two=$(".co_self_gross_income_year_two").val();
var co_self_agriculture_income_year_two=$(".co_self_agriculture_income_year_two").val();
var co_self_other_income_year_two=$(".co_self_other_income_year_two").val();
var co_self_depreciation_year_two=$(".co_self_depreciation_year_two").val();
var co_self_tax_year_two=$(".co_self_tax_year_two").val();
var co_self_other_ded_year_two=$(".co_self_other_ded_year_two").val();

// Year3

var co_self_itr_year_three=$(".co_self_itr_year_three").val();
var co_self_gross_income_year_three=$(".co_self_gross_income_year_three").val();
var co_self_agriculture_income_year_three=$(".co_self_agriculture_income_year_three").val();
var co_self_other_income_year_three=$(".co_self_other_income_year_three").val();
var co_self_depreciation_year_three=$(".co_self_depreciation_year_three").val();
var co_self_tax_year_three=$(".co_self_tax_year_three").val();
var co_self_other_ded_year_three=$(".co_self_other_ded_year_three").val();




  // borrower latest year monthly average
  var co_self_latest_monthly_average_gross=parseFloat(co_self_gross_income_year_three)/12;
  console.log(co_self_latest_monthly_average_gross);
  var co_self_latest_monthly_average_agriculture=parseFloat(co_self_agriculture_income_year_three)/12;
  var co_self_latest_monthly_average_other_income=parseFloat(co_self_other_income_year_three)/12;
  var co_self_latest_monthly_average_depreciation=parseFloat(co_self_depreciation_year_three)/12;

  var co_self_latest_monthly_average_tax=parseFloat(co_self_tax_year_three)/12;
  var co_self_latest_monthly_average_ded=parseFloat(co_self_other_ded_year_three)/12;

   // borrower All year monthly Average

   var co_self_all_monthly_average_gross=(parseFloat(co_self_gross_income_year_one)+parseFloat(co_self_gross_income_year_two)+parseFloat(co_self_gross_income_year_three))/parseFloat(co_total_co_year_month);

   console.log(co_self_all_monthly_average_gross);
   var co_self_all_monthly_average_agriculture=(parseFloat(co_self_agriculture_income_year_one)+parseFloat(co_self_agriculture_income_year_two)+parseFloat(co_self_agriculture_income_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_other_income=(parseFloat(co_self_other_income_year_one)+parseFloat(co_self_other_income_year_two)+parseFloat(co_self_other_income_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_depreciation=(parseFloat(co_self_depreciation_year_one)+parseFloat(co_self_depreciation_year_two)+parseFloat(co_self_depreciation_year_three))/parseFloat(co_total_co_year_month);

   var co_self_all_monthly_average_tax=(parseFloat(co_self_tax_year_one)+parseFloat(co_self_tax_year_two)+parseFloat(co_self_tax_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_ded=(parseFloat(co_self_other_ded_year_one)+parseFloat(co_self_other_ded_year_two)+parseFloat(co_self_other_ded_year_three))/parseFloat(co_total_co_year_month);



// borrower Total Gross
var co_self_total_gross_year_one=parseFloat(co_self_gross_income_year_one)+parseFloat(co_self_agriculture_income_year_one)+parseFloat(co_self_other_income_year_one)+parseFloat(co_self_depreciation_year_one);
var co_self_total_gross_year_two=parseFloat(co_self_gross_income_year_two)+parseFloat(co_self_agriculture_income_year_two)+parseFloat(co_self_other_income_year_two)+parseFloat(co_self_depreciation_year_two);
var co_self_total_gross_year_three=parseFloat(co_self_gross_income_year_three)+parseFloat(co_self_agriculture_income_year_three)+parseFloat(co_self_other_income_year_three)+parseFloat(co_self_depreciation_year_three);
// borrower latest year average_total_income
var co_self_total_year_three_average=parseFloat(co_self_latest_monthly_average_gross)+parseFloat(co_self_latest_monthly_average_agriculture)+parseFloat(co_self_latest_monthly_average_other_income)+parseFloat(co_self_latest_monthly_average_depreciation);

  // borrower all average_total_income
  var co_self_total_year_all_average=parseFloat(co_self_all_monthly_average_gross)+parseFloat(co_self_all_monthly_average_agriculture)+parseFloat(co_self_all_monthly_average_other_income)+parseFloat(co_self_all_monthly_average_depreciation);




// borrower Total Deduction
var co_self_total_deduction_year_one=parseFloat(co_self_tax_year_one)+parseFloat(co_self_other_ded_year_one);
var co_self_total_deduction_year_two=parseFloat(co_self_tax_year_two)+parseFloat(co_self_other_ded_year_two);
var co_self_total_deduction_year_three=parseFloat(co_self_tax_year_three)+parseFloat(co_self_other_ded_year_three);
// borrower average_total_deduction
var co_self_total_deduction_year_three_average=parseFloat(co_self_latest_monthly_average_tax)+parseFloat(co_self_latest_monthly_average_ded);

  // borrower all average_total_deduction
  var co_self_total_deduction_year_all_average=parseFloat(co_self_all_monthly_average_tax)+parseFloat(co_self_latest_monthly_average_ded);




  // gross push && deduct push
  $('.co_self_total_gross_year_one').val(Math.round(co_self_total_gross_year_one));
  $('.co_self_total_gross_year_two').val(Math.round(co_self_total_gross_year_two));
  $('.co_self_total_gross_year_three').val(Math.round(co_self_total_gross_year_three));
  $('.co_self_total_deduction_year_one').val(Math.round(co_self_total_deduction_year_one));
  $('.co_self_total_deduction_year_two').val(Math.round(co_self_total_deduction_year_two));
  $('.co_self_total_deduction_year_three').val(Math.round(co_self_total_deduction_year_three));

    // latest average push
    $('.co_self_latest_monthly_average_gross').val(Math.round(co_self_latest_monthly_average_gross));
    $('.co_self_latest_monthly_average_agriculture').val(Math.round(co_self_latest_monthly_average_agriculture));
    $('.co_self_latest_monthly_average_other_income').val(Math.round(co_self_latest_monthly_average_other_income));
    $('.co_self_latest_monthly_average_depreciation').val(Math.round(co_self_latest_monthly_average_depreciation));
    $('.co_self_latest_monthly_average_tax').val(Math.round(co_self_latest_monthly_average_tax));
    $('.co_self_latest_monthly_average_ded').val(Math.round(co_self_latest_monthly_average_ded));

    // all average push
    $('.co_self_all_monthly_average_gross').val(Math.round(co_self_all_monthly_average_gross));
    $('.co_self_all_monthly_average_agriculture').val(Math.round(co_self_all_monthly_average_agriculture));
    $('.co_self_all_monthly_average_other_income').val(Math.round(co_self_all_monthly_average_other_income));
    $('.co_self_all_monthly_average_depreciation').val(Math.round(co_self_all_monthly_average_depreciation));
    $('.co_self_all_monthly_average_tax').val(Math.round(co_self_all_monthly_average_tax));
    $('.co_self_all_monthly_average_ded').val(Math.round(co_self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.co_self_total_deduction_year_three_average').val(Math.round(co_self_total_deduction_year_three_average));
    $('.co_self_total_deduction_year_all_average').val(Math.round(co_self_total_deduction_year_all_average));
    $('.co_self_total_year_three_average').val(Math.round(co_self_total_year_three_average));
    $('.co_self_total_year_all_average').val(Math.round(co_self_total_year_all_average));




    // Co Brower End




  // gross_income disposal

  var total_monthly_gross_income=parseFloat(self_total_year_three_average)+parseFloat(co_self_total_year_three_average)+parseFloat(eligilble_rental_income)+
  parseFloat(eligilble_other_income)+parseFloat(six_salary_gross_income)+parseFloat(co_six_salary_gross_income);

  var total_monthly_gross_income_two=parseFloat(self_total_year_all_average)+parseFloat(co_self_total_year_all_average)+parseFloat(eligilble_rental_income)+
  parseFloat(eligilble_other_income)+parseFloat(average_salary_gross_income)+parseFloat(co_average_salary_gross_income);


  var new_deduction=parseFloat(self_total_deduction_year_three_average)+parseFloat(co_self_total_deduction_year_three_average)+parseFloat(six_salary_deduction)+parseFloat(co_six_salary_deduction);

  var new_deduction_two=parseFloat(self_total_deduction_year_all_average)+parseFloat(co_self_total_deduction_year_all_average)+parseFloat(average_salary_deduction)+parseFloat(co_average_salary_deduction);

  var net_income_after_tax=parseFloat(total_monthly_gross_income)-parseFloat(new_deduction);

  var net_income_after_tax_two=parseFloat(total_monthly_gross_income_two)-parseFloat(new_deduction_two);

  var net_income_deduction=parseFloat(net_income_after_tax)-parseFloat(total_emi);

  var net_income_deduction_two=parseFloat(net_income_after_tax_two)-parseFloat(total_emi);

  var amount_condition=125000;

var master_income_margin=$('.master_income_margin').val();

  if (parseFloat(total_monthly_gross_income)<parseFloat(amount_condition)) {
    var gross_income_fourty=parseFloat(total_monthly_gross_income)*parseFloat(master_income_margin)/100;
  }else{
    var gross_income_fourty=50000;
  }

  if (parseFloat(total_monthly_gross_income)>=parseFloat(amount_condition)) {
    var gross_income_fourty=50000;
  }

  if (parseFloat(total_monthly_gross_income_two)<parseFloat(amount_condition)) {
    var gross_income_fourty_two=parseFloat(total_monthly_gross_income_two)*parseFloat(master_income_margin)/100;
  }else{
   var gross_income_fourty_two=50000;
 }

 if (parseFloat(total_monthly_gross_income_two)>=parseFloat(amount_condition)) {
  var gross_income_fourty_two=50000;
}

var total_disposal_income=parseFloat(net_income_deduction)-parseFloat(gross_income_fourty);

var total_disposal_income_two=parseFloat(net_income_deduction_two)-parseFloat(gross_income_fourty_two);


// alert(total_monthly_gross_income);

$('.total_monthly_gross_income').val(Math.round(total_monthly_gross_income));
$('.total_monthly_gross_income_two').val(Math.round(total_monthly_gross_income_two));

$('.new_deduction').val(Math.round(new_deduction));
$('.new_deduction_two').val(Math.round(new_deduction_two));

$('.net_income_after_tax').val(Math.round(net_income_after_tax));
$('.net_income_after_tax_two').val(Math.round(net_income_after_tax_two));


$('.other_emi').val(Math.round(total_emi));
$('.other_emi_two').val(Math.round(total_emi));

$('.net_income_deduction').val(Math.round(net_income_deduction));
$('.net_income_deduction_two').val(Math.round(net_income_deduction_two));

$('.net_income_deduction').val(Math.round(net_income_deduction));
$('.net_income_deduction_two').val(Math.round(net_income_deduction_two));

$('.40_gross_income').val(Math.round(gross_income_fourty));
$('.40_gross_income_two').val(Math.round(gross_income_fourty_two));

$('.total_disposal_income').val(Math.round(total_disposal_income));
$('.total_disposal_income_two').val(Math.round(total_disposal_income_two));

var dob=$('.age').val();
var dob_month=parseFloat(dob)*12;

var remaining_age=(70*12)-dob_month;



if (remaining_age<=360) {
  var max_eligibile_term_month=remaining_age;
}

if (remaining_age>360) {
  var max_eligibile_term_month=360;
}

var add_max_eligibile_term_month=parseFloat(max_eligibile_term_month)+60;

if (add_max_eligibile_term_month<=360) {

 var max_eligibile_term_relax=add_max_eligibile_term_month;
}

if (add_max_eligibile_term_month>360) {

  var max_eligibile_term_relax=360;
}



if (dob<45) {

  var quantam_applicant=parseFloat(self_total_year_all_average)*72;
  var quantam_applicant_one=parseFloat(co_self_total_year_all_average)*72;

}

if (dob>=45) {
  var quantam_applicant=parseFloat(self_total_year_all_average)*60;
  var quantam_applicant_one=parseFloat(co_self_total_year_all_average)*60;
}

max_quantom_loan_home=parseFloat(quantam_applicant)+parseFloat(quantam_applicant_one);

$('.quantam_applicant').val(Math.round(quantam_applicant));
$('.quantam_applicant_one').val(Math.round(quantam_applicant_one));
$('.max_quantom_loan_home').val(Math.round(max_quantom_loan_home));

$('.maximum_age_month').val(dob_month);

$('.remaining_age').val(remaining_age);

$('.max_eligibile_term_month').val(Math.round(max_eligibile_term_month));

$('.max_eligibile_term_relax').val(Math.round(max_eligibile_term_relax));


var interest_rate=$('.interest_rate').val();
var number_of_month=$('.number_of_month').val();

var interestRate = parseFloat(interest_rate)/1200; // or (5/100) this rate is annual
var presentValue = 100000; //this is loan 

function PMT(ir,np, pv, fv = 0){ 
 var presentValueInterstFector = Math.pow((1 + ir), np);
 var pmt = ir * pv  * (presentValueInterstFector + fv)/(presentValueInterstFector-1); 
 return pmt;
}

var pmt_value = PMT(parseFloat(interestRate), parseFloat(number_of_month), parseFloat(presentValue)) - 1; //output
$('.emi_per_lakh').val(Math.round(pmt_value));

var eligilble_as_per_average_income=(parseFloat(total_disposal_income_two)/parseFloat(pmt_value))*100000;
var eligilble_as_per_latest=(parseFloat(total_disposal_income)/parseFloat(pmt_value))*100000;

$('.eligilble_as_per_average_income').val(Math.round(eligilble_as_per_average_income));

$('.eligilble_as_per_latest').val(Math.round(eligilble_as_per_latest));

var ltv_mkt_property=$('.ltv_mkt_property').val();
var ltv_cost_of_project=$('.ltv_cost_of_project').val();

var ltv_loan_amount_applied=$('.ltv_loan_amount_applied').val();
var ltv_takeover=$('.ltv_takeover').val();

var value_to_be_consider=Math.min(parseFloat(ltv_mkt_property),parseFloat(ltv_cost_of_project));

// alert(value_to_be_consider);

if (value_to_be_consider!=undefined && value_to_be_consider!=null && value_to_be_consider!="" && value_to_be_consider!=NaN) {

  $('.value_to_be_consider').val(value_to_be_consider);
}else{
  var value_to_be_consider=0;
  $('.value_to_be_consider').val(value_to_be_consider);
}

var master_ltv_margin_one=$('.master_ltv_margin_one').val();
var master_ltv_margin_two=$('.master_ltv_margin_two').val();
var master_ltv_margin_three=$('.master_ltv_margin_three').val();


if (value_to_be_consider<=3333333) {

  var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_one)/100);

}else if(value_to_be_consider>333333 && value_to_be_consider<10000000){

  var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_two)/100);

}else if(value_to_be_consider>=10000000){

 var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_three)/100); 

}else{
  var value_to_be_consider_two=0; 
}

$('.value_to_be_consider_two').val(value_to_be_consider_two);

$('.ltv_takeover_two').val(ltv_takeover);


var maximum_eligible_loan = Math.min(parseFloat(ltv_loan_amount_applied),parseFloat(eligilble_as_per_average_income),Math.max(parseFloat(value_to_be_consider_two),parseFloat(ltv_takeover)),parseFloat(max_quantom_loan_home));

$('.maximum_eligible_loan_average').val(maximum_eligible_loan);

var maximum_eligible_loan_latest = Math.min(parseFloat(ltv_loan_amount_applied),parseFloat(eligilble_as_per_latest),Math.max(parseFloat(value_to_be_consider_two),parseFloat(ltv_takeover)),parseFloat(max_quantom_loan_home));


$('.maximum_eligible_loan_year_month').val(maximum_eligible_loan_latest);


var loan_amount_rs=$('.loan_amount_rs').val();
var interest=$('.interest').val();
var time_period=$('.time_period').val();

var interest=parseFloat(interest)/1200;

var loan_final_emil = PMT(parseFloat(interest), parseFloat(time_period), parseFloat(loan_amount_rs)) - 1;


$('.final_emi').val(Math.round(loan_final_emil));

// }else{


// }




});



$('.max_term_check').change(function(){

    if($(this).is(':checked')){
     $('.max_ter').removeClass('hidden');
   }
   else
   {
    $('.max_ter').addClass('hidden');
  }    

});



$('.max_quantum_check').change(function(){

    if($(this).is(':checked')){
     $('.max_qua').removeClass('hidden');
   }
   else
   {
    $('.max_qua').addClass('hidden');
  }    

});




    $('.year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.year_one_show').removeClass('hidden');
   }
   else
   {
    $('.year_one_show').addClass('hidden');
  }    

});

    $('.average_itr').change(function(){

    if($(this).is(':checked')){
     $('.average_itr_hidden').addClass('hidden');
   }
   else
   {
    $('.average_itr_hidden').removeClass('hidden');
  }    

});



        $('.year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.year_two_show').removeClass('hidden');
   }
   else
   {
    $('.year_two_show').addClass('hidden');
  }    

});

                $('.year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.year_three_show').removeClass('hidden');
   }
   else
   {
    $('.year_three_show').addClass('hidden');
  }    

});



    $('.month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.month_one_show').removeClass('hidden');
   }
   else
   {
    $('.month_one_show').addClass('hidden');
  }    

});

  $('.month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.month_two_show').removeClass('hidden');
   }
   else
   {
    $('.month_two_show').addClass('hidden');
  }    

});

  $('.month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.month_three_show').removeClass('hidden');
   }
   else
   {
    $('.month_three_show').addClass('hidden');
  }    

});


  $('.month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.month_four_show').removeClass('hidden');
   }
   else
   {
    $('.month_four_show').addClass('hidden');
  }    

});


  $('.month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.month_five_show').removeClass('hidden');
   }
   else
   {
    $('.month_five_show').addClass('hidden');
  }    

});

  $('.month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.month_six_show').removeClass('hidden');
   }
   else
   {
    $('.month_six_show').addClass('hidden');
  }    

});


  $('.co_year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_one_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_one_show').addClass('hidden');
  }    

});

        $('.co_year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_two_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_two_show').addClass('hidden');
  }    

});

                $('.co_year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_three_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_three_show').addClass('hidden');
  }    

});



    $('.co_month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_one_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_one_show').addClass('hidden');
  }    

});

  $('.co_month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_two_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_two_show').addClass('hidden');
  }    

});

  $('.co_month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_three_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_three_show').addClass('hidden');
  }    

});


  $('.co_month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_four_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_four_show').addClass('hidden');
  }    

});


  $('.co_month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_five_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_five_show').addClass('hidden');
  }    

});

  $('.co_month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_six_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_six_show').addClass('hidden');
  }    

});



  $('.existing_loan_check').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan').removeClass('hidden');
   }
   else
   {
    $('.existing_loan').addClass('hidden');
  }    

});

  $('.existing_loan_co').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan_co_check').removeClass('hidden');
   }
   else
   {
    $('.existing_loan_co_check').addClass('hidden');
  }    

});

    $('.master_parameter').change(function(){

    if($(this).is(':checked')){
     $('.master_paramete_div').removeClass('hidden');
   }
   else
   {
    $('.master_paramete_div').addClass('hidden');
  }    

});

$('input').abacus();
  


  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch(type){
    case 'info':
    toastr.info("{{ Session::get('message') }}");
    break;

    case 'warning':
    toastr.warning("{{ Session::get('message') }}");
    break;
    case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
    case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
  }
  @endif


</script>


@endsection
