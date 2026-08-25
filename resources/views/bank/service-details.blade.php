@extends('layouts.admin-app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<style>
.bank-service-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

.bank-service-page .kx-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
}

.bank-service-page .kx-welcome {
    display: flex;
    align-items: center;
    gap: 14px;
}

.bank-service-page .kx-welcome-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: var(--kx-soft);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.bank-service-page .kx-welcome h4 {
    margin: 0;
    font-weight: 700;
    color: var(--kx-text);
    font-size: 20px;
}

.bank-service-page .kx-welcome p {
    margin: 2px 0 0;
    color: var(--kx-muted);
    font-size: 13px;
}

.bank-service-page .kx-breadcrumb {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    padding: 8px 16px;
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    font-size: 13px;
}

.bank-service-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.bank-service-page .kx-breadcrumb .active {
    color: var(--kx-primary);
    font-weight: 600;
}

.bank-service-page .kx-kyc-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: #FDECEC;
    border: 1px solid #F5C2C2;
    border-radius: 12px;
    padding: 14px 16px;
    margin-bottom: 20px;
    color: #8A2020;
    font-size: 14px;
}

.bank-service-page .kx-kyc-alert i {
    font-size: 18px;
    margin-top: 1px;
    color: #C0392B;
}

.bank-service-page .kx-kyc-alert a {
    color: #8A2020;
    font-weight: 600;
    text-decoration: underline;
}

.bank-service-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(157, 56, 149, 0.08);
    overflow: hidden;
}

.bank-service-page .kx-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 28px;
    border-bottom: 1px solid var(--kx-border);
}

.bank-service-page .kx-card-header-icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    background: linear-gradient(135deg, #9D3895, #392367);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}

.bank-service-page .kx-card-header h4 {
    margin: 0;
    font-weight: 700;
    color: var(--kx-text);
    font-size: 17px;
}

.bank-service-page .kx-card-header p {
    margin: 2px 0 0;
    color: var(--kx-muted);
    font-size: 13px;
}

.bank-service-page .kx-card-body {
    padding: 28px;
}

.bank-service-page .kx-form-wrap {
    max-width: 760px;
}

.bank-service-page .kx-field {
    margin-bottom: 20px;
}

.bank-service-page .kx-label {
    display: block;
    font-weight: 600;
    font-size: 13.5px;
    color: var(--kx-text);
    margin-bottom: 8px;
}

.bank-service-page .kx-label .text-danger {
    margin-left: 2px;
}

.bank-service-page .kx-input,
.bank-service-page select.kx-input {
    width: 100%;
    height: 44px;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    padding: 0 14px;
    font-size: 14px;
    color: var(--kx-text);
    background: #fff;
    transition: all 0.2s ease-in-out;
}

.bank-service-page .kx-input::placeholder {
    color: #A6A2B0;
}

.bank-service-page .kx-input:focus,
.bank-service-page select.kx-input:focus {
    outline: none;
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.15);
}

.bank-service-page .kx-help-block {
    display: block;
    color: #E24C4C;
    font-size: 12.5px;
    margin-top: 6px;
}

.bank-service-page .kx-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 8px;
    padding-top: 8px;
}

.bank-service-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 44px;
    padding: 0 22px;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.bank-service-page .kx-btn-primary {
    background: linear-gradient(135deg, #9D3895, #392367);
    color: #fff;
    box-shadow: 0 4px 12px rgba(157, 56, 149, 0.28);
}

.bank-service-page .kx-btn-primary:hover {
    filter: brightness(1.05);
    color: #fff;
}

.bank-service-page .kx-btn-success {
    background: #E8F8EF;
    color: #1E8A4C;
    border-color: #BEE8CF;
}

.bank-service-page .kx-btn-success:hover {
    background: #DAF3E5;
    color: #1E8A4C;
}

.bank-service-page .kx-btn-danger {
    background: #FDECEC;
    color: #C0392B;
    border-color: #F5C2C2;
}

.bank-service-page .kx-btn-danger:hover {
    background: #FBDFDF;
    color: #C0392B;
}

.bank-service-page .kx-hidden {
    visibility: hidden;
}

@media (max-width: 767px) {
    .bank-service-page .kx-page-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .bank-service-page .kx-breadcrumb {
        width: 100%;
        justify-content: flex-start;
    }
    .bank-service-page .kx-card-body {
        padding: 18px;
    }
    .bank-service-page .kx-card-header {
        padding: 18px;
    }
    .bank-service-page .kx-actions {
        flex-direction: column;
    }
    .bank-service-page .kx-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="content-body bank-service-page">
    <div class="container-fluid">

        <div class="kx-page-header">
            <div class="kx-welcome">
                <div class="kx-welcome-icon"><i class="fa fa-university"></i></div>
                <div>
                    <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                    @if(Auth::user()->role_id==2)
                    <p>Agent ID: {{Auth::user()->new_id}}</p>
                    @endif
                </div>
            </div>
            <ol class="kx-breadcrumb">
                <li><a href="javascript:void(0)">Bank</a></li>
                <li>/</li>
                <li class="active"><a href="javascript:void(0)">Add Bank</a></li>
            </ol>
        </div>

        @if(Auth::user()->kyc_status==0)
        <div class="kx-kyc-alert">
            <i class="fa fa-exclamation-triangle"></i>
            <div>Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-icon"><i class="fa fa-plus"></i></div>
                        <div>
                            <h4>Add Bank</h4>
                            <p>Configure the service and bank URL for this connection</p>
                        </div>
                    </div>
                    <div class="kx-card-body">
                        <div class="kx-form-wrap">
                            <form action="{{$bankservices->bank_subservice_id}}" method="post" enctype='multipart/form-data'>
                                @csrf

                                <div class="kx-field">
                                    <label class="kx-label" for="sub_service_id">Select Service <span class="text-danger">*</span></label>
                                    <select class="kx-input" id="sub_service_id" name="form_sub_service_id" required>
                                        <option value="">Please select</option>
                                        @foreach($services as $service)
                                        <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="kx-field" id="url_show">
                                    <label class="kx-label" for="bank_url">Bank URL <span class="text-danger">*</span></label>
                                    <input type="text" class="kx-input" value="{{old('bank_url)', $bankservices->bank_url)}}" id="bank_url" name="bank_url" placeholder="Bank URL">
                                    @if ($errors->has('form_sub_service_id'))
                                    <span class="kx-help-block">
                                        <strong>{{ $errors->first('form_sub_service_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="kx-actions">
                                    <button name="save" type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    @if($bankservices->status_id ==0)
                                    <button name="active" class="kx-btn kx-btn-success"><i class="fa fa-toggle-on"></i> Active</button>
                                    @elseif($bankservices->status_id ==1)
                                    <button name="inactive" class="kx-btn kx-btn-danger"><i class="fa fa-toggle-off"></i> In-Active</button>
                                    @endif
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
    @if($bankservices->bank_url!="")
    $("#url_show").removeClass("hidden");
    @endif
    $("#sub_service_id option[value={{$bankservices->sub_service_id}}]").prop('selected',true);
    $( document ).ready(function() {
        <?php if(session()->has('success')){ ?>

        toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
    });
    $("#url_name").click(function(){
        document.getElementById("url_show").style.visibility = "visible";
    });
    $("#api_name").click(function(){
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