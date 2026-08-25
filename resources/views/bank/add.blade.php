@extends('layouts.admin-app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<style>
.bank-add-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.bank-add-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.bank-add-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.bank-add-page .kx-title-icon {
    flex: 0 0 auto;
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: var(--kx-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--kx-primary-dark);
    font-size: 20px;
}

.bank-add-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.bank-add-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.bank-add-page .kx-breadcrumb {
    margin: 0;
    padding: 8px 14px;
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    font-size: 13px;
    color: var(--kx-muted);
    align-self: center;
    display: flex;
    align-items: center;
    gap: 6px;
}

.bank-add-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.bank-add-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.bank-add-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- KYC alert ---------- */
.bank-add-page .kx-kyc-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: #FDECEC;
    border: 1px solid #F6C9C9;
    color: #B93A3A;
    border-radius: 12px;
    font-size: 13.5px;
    margin-bottom: 20px;
}

.bank-add-page .kx-kyc-alert i {
    font-size: 16px;
    flex: 0 0 auto;
}

.bank-add-page .kx-kyc-alert a {
    color: #392367;
    font-weight: 700;
    text-decoration: underline;
}

/* ---------- Card ---------- */
.bank-add-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.bank-add-page .kx-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 26px;
    border-bottom: 1px solid var(--kx-border);
}

.bank-add-page .kx-card-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.bank-add-page .kx-card-title {
    margin: 0;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.bank-add-page .kx-card-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

/* ---------- Form body ---------- */
.bank-add-page .kx-form-body {
    padding: 30px 26px 32px;
}

.bank-add-page .kx-field {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 4px 24px;
    margin-bottom: 22px;
}

.bank-add-page .kx-field:last-of-type {
    margin-bottom: 0;
}

.bank-add-page .kx-field-label {
    flex: 0 0 200px;
    max-width: 200px;
    padding-top: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--kx-text);
}

.bank-add-page .kx-field-label .text-danger {
    color: #D64545;
}

.bank-add-page .kx-field-control {
    flex: 1 1 320px;
    max-width: 420px;
}

.bank-add-page .kx-input,
.bank-add-page textarea.kx-input {
    width: 100%;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    padding: 0 14px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.bank-add-page .kx-input {
    height: 44px;
}

.bank-add-page textarea.kx-input {
    height: auto;
    padding: 12px 14px;
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.bank-add-page .kx-input:focus,
.bank-add-page textarea.kx-input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.bank-add-page .kx-help-block {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #D64545;
    font-weight: 600;
}

/* file input */
.bank-add-page .kx-file-input {
    width: 100%;
    border: 1px dashed var(--kx-border);
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    color: var(--kx-muted);
    background: var(--kx-page-bg);
    cursor: pointer;
    transition: border-color 0.2s ease, background 0.2s ease;
}

.bank-add-page .kx-file-input:hover {
    border-color: var(--kx-primary);
    background: #fff;
}

/* radio toggle (kept for future use, matches original .radio-inputs pattern) */
.bank-add-page .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: var(--kx-page-bg);
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(57, 35, 103, 0.08);
  padding: 0.25rem;
  width: 170px;
  height: 50px;
  font-size: 14px;
}

.bank-add-page .radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.bank-add-page .radio-inputs .radio input {
  display: none;
}

.bank-add-page .radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: var(--kx-text);
  transition: all .15s ease-in-out;
}

.bank-add-page .radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
  color: var(--kx-primary-dark);
}

.bank-add-page .hidden{
  visibility: hidden;
}

/* ---------- Buttons ---------- */
.bank-add-page .kx-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 6px;
}

.bank-add-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 9px;
    border: 1px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
    line-height: 1.2;
}

.bank-add-page .kx-btn:hover {
    transform: translateY(-1px);
}

.bank-add-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.bank-add-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

@media (max-width: 767px) {
    .bank-add-page .kx-page-head {
        flex-direction: column;
    }
    .bank-add-page .kx-field-label {
        flex: 0 0 100%;
        max-width: 100%;
        padding-top: 0;
    }
    .bank-add-page .kx-field-control {
        max-width: 100%;
    }
}
</style>

<div class="content-body bank-add-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-university"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome {{Auth::user()->name}}!</h4>
                    <p class="kx-page-subtitle">
                        Add a new partner bank to the platform.
                        @if(Auth::user()->role_id==2)
                            &nbsp;&middot;&nbsp;Agent ID: {{Auth::user()->new_id}}
                        @endif
                    </p>
                </div>
            </div>
            <nav class="kx-breadcrumb">
                <a href="{{$base_url}}/admin/bank/all">Banks</a> / <span class="kx-crumb-current">Add Bank</span>
            </nav>
        </div>

        @if(Auth::user()->kyc_status==0)
        <div class="kx-kyc-alert">
            <i class="fa fa-exclamation-circle"></i>
            <span>Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</span>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-icon"><i class="fa fa-plus"></i></div>
                        <div>
                            <h4 class="kx-card-title">Add Bank</h4>
                            <p class="kx-card-subtitle">Enter the details for the new bank</p>
                        </div>
                    </div>

                    <div class="kx-form-body">
                        <form class="" action="add" method="post" enctype='multipart/form-data'>
                            @csrf

                            <div class="kx-field">
                                <label class="kx-field-label" for="sub_service_image">Bank Image/Logo <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                    <input type="file" class="kx-file-input" id="sub_service_image" name="sub_service_image" required>
                                    @if ($errors->has('sub_service_image'))
                                    <span class="kx-help-block">{{ $errors->first('sub_service_image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" value="{{old('bank_name')}}" id="bank_name" name="bank_name" placeholder="Bank Name" required>
                                    @if ($errors->has('bank_name'))
                                    <span class="kx-help-block">{{ $errors->first('bank_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Effective Interest -->
                            <div class="kx-field">
                                <label class="kx-field-label">Effective Interest *</label>
                                <div class="kx-field-control">
                                    <input type="text"
                                           class="kx-input"
                                           name="effective_interest_range"
                                           value="{{ old('effective_interest_range') }}"
                                           placeholder="6.90 - 24.40 %"
                                           required>
                                </div>
                            </div>

                            <!-- Age Limit -->
                            <div class="kx-field">
                                <label class="kx-field-label">Age Limit *</label>
                                <div class="kx-field-control">
                                    <input type="text"
                                           class="kx-input"
                                           name="age_limit"
                                           value="{{ old('age_limit') }}"
                                           placeholder="25 years"
                                           required>
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label">Processing Fee *</label>
                                <div class="kx-field-control">
                                    <input type="text"
                                           class="kx-input"
                                           name="processing_fee"
                                           value="{{ old('processing_fee') }}"
                                           placeholder="2% of loan amount"
                                           required>
                                </div>
                            </div>

                            {{-- <div class="kx-field">
                                <label class="kx-field-label" for="val-skill">Select Service
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="kx-field-control">
                                    <select class="kx-input" id="val-skill" name="sub_service_id" required>
                                        <option value="">Please select</option>
                                        @foreach($services as $service)
                                        <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="kx-field">
                                <label class="kx-field-label" for="val-suggestions">Description <span class="text-danger">*</span></label>
                                <div class="kx-field-control">
                                    <textarea class="kx-input" id="val-suggestions" name="desc" rows="5" placeholder="What would you like to see?">{{old('desc')}}</textarea>
                                    @if ($errors->has('desc'))
                                    <span class="kx-help-block">{{ $errors->first('desc') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label">Know More Description</label>
                                <div class="kx-field-control">
                                    <textarea
                                        name="know_more_description"
                                        class="kx-input"
                                        rows="6"
                                    >{{ old('know_more_description') }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="kx-field">
                            <div class="radio-inputs">
                                <label for=""></label>
                                <label class="radio">
                                    <input type="radio" name="radio" checked="">
                                    <span id="api_name" class="name">API</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio">
                                    <span id="url_name" class="name">URL</span>
                                </label>

                                </div>
                            </div>
                            <div class="kx-field hidden" id="url_show">
                            <label class="kx-field-label" for="val-skill">Bank URL
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="kx-field-control {{ $errors->has('bank_url') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" id="bank_url" name="bank_url" placeholder="Bank URL">
                                    @if ($errors->has('bank_url'))
                                    <span class="kx-help-block">{{ $errors->first('bank_url') }}</span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="kx-field">
                                <div class="kx-field-label"></div>
                                <div class="kx-field-control kx-actions">
                                    <button type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script class="">
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?>

         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
$("#url_name").click(function(){
    // alert("yes");
    document.getElementById("url_show").style.visibility = "visible";


});
$("#api_name").click(function(){
    // alert("yes");
    $("#bank_url").val("");
    document.getElementById("url_show").style.visibility = "hidden";

});
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");

});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection