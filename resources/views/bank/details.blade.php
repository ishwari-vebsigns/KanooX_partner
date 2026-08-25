@extends('layouts.admin-app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<style>
.bank-details-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.bank-details-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.bank-details-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.bank-details-page .kx-title-icon {
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

.bank-details-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.bank-details-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.bank-details-page .kx-breadcrumb {
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

.bank-details-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.bank-details-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.bank-details-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- Card ---------- */
.bank-details-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
    margin-bottom: 22px;
}

.bank-details-page .kx-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    padding: 22px 26px;
    border-bottom: 1px solid var(--kx-border);
}

.bank-details-page .kx-card-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.bank-details-page .kx-card-icon {
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

.bank-details-page .kx-card-title {
    margin: 0;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.bank-details-page .kx-card-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

/* status badge in header */
.bank-details-page .kx-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.bank-details-page .kx-status .kx-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.bank-details-page .kx-status-active {
    background: #EAF8EF;
    color: #238B45;
}
.bank-details-page .kx-status-active .kx-dot { background: #238B45; }

.bank-details-page .kx-status-inactive {
    background: #FDECEC;
    color: #D64545;
}
.bank-details-page .kx-status-inactive .kx-dot { background: #D64545; }

/* ---------- Form body ---------- */
.bank-details-page .kx-form-body {
    padding: 30px 26px 32px;
}

.bank-details-page .kx-image-preview-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--kx-border);
    border-radius: 12px;
    padding: 10px;
    background: var(--kx-page-bg);
    margin-bottom: 22px;
}

.bank-details-page .kx-image-preview-box img {
    max-height: 140px;
    max-width: 140px;
    border-radius: 8px;
    object-fit: contain;
}

.bank-details-page .kx-field {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 4px 24px;
    margin-bottom: 22px;
}

.bank-details-page .kx-field:last-of-type {
    margin-bottom: 0;
}

.bank-details-page .kx-field-label {
    flex: 0 0 200px;
    max-width: 200px;
    padding-top: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--kx-text);
}

.bank-details-page .kx-field-label .text-danger {
    color: #D64545;
}

.bank-details-page .kx-field-control {
    flex: 1 1 320px;
    max-width: 420px;
}

.bank-details-page .kx-input,
.bank-details-page select.kx-input,
.bank-details-page textarea.kx-input {
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

.bank-details-page .kx-input {
    height: 44px;
}

.bank-details-page select.kx-input {
    height: 44px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%23747080' viewBox='0 0 16 16'%3E%3Cpath d='M8 11 3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 34px;
}

.bank-details-page textarea.kx-input {
    height: auto;
    padding: 12px 14px;
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.bank-details-page .kx-input:focus,
.bank-details-page select.kx-input:focus,
.bank-details-page textarea.kx-input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.bank-details-page .kx-help-block {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #D64545;
    font-weight: 600;
}

.bank-details-page .kx-error-list {
    background: #FDECEC;
    border: 1px solid #F6C9C9;
    color: #B93A3A;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: 13px;
}

.bank-details-page .kx-error-list ul {
    margin: 0;
    padding-left: 18px;
}

/* file input */
.bank-details-page .kx-file-input {
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

.bank-details-page .kx-file-input:hover {
    border-color: var(--kx-primary);
    background: #fff;
}

/* radio toggle */
.bank-details-page .radio-inputs {
  position: relative;
  display: inline-flex;
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

.bank-details-page .radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.bank-details-page .radio-inputs .radio input {
  display: none;
}

.bank-details-page .radio-inputs .radio .name {
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

.bank-details-page .radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
  color: var(--kx-primary-dark);
}

.bank-details-page .hidden{
  visibility: hidden;
}

/* ---------- Buttons ---------- */
.bank-details-page .kx-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 6px;
}

.bank-details-page .kx-btn {
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

.bank-details-page .kx-btn:hover {
    transform: translateY(-1px);
}

.bank-details-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.bank-details-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.bank-details-page .kx-btn-success {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.bank-details-page .kx-btn-success:hover {
    background: #238B45;
    color: #fff;
    box-shadow: 0 8px 18px rgba(35, 139, 69, 0.22);
}

.bank-details-page .kx-btn-danger {
    background: #FDECEC;
    color: #D64545;
    border-color: #F6C9C9;
}

.bank-details-page .kx-btn-danger:hover {
    background: #D64545;
    color: #fff;
    box-shadow: 0 8px 18px rgba(214, 69, 69, 0.22);
}

/* ---------- Table ---------- */
.bank-details-page .kx-table-wrap {
    padding: 10px 26px 26px;
}

.bank-details-page table.dataTable {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

.bank-details-page table.dataTable thead {
    border-bottom: none !important;
}

.bank-details-page table.dataTable thead th {
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 16px !important;
    border-bottom: none !important;
    white-space: nowrap;
}

.bank-details-page table.dataTable thead th:first-child { border-radius: 10px 0 0 10px; }
.bank-details-page table.dataTable thead th:last-child { border-radius: 0 10px 10px 0; }

.bank-details-page table.dataTable tbody tr {
    transition: background 0.15s ease, box-shadow 0.15s ease;
}

.bank-details-page table.dataTable tbody td {
    padding: 26px 16px !important;
    font-size: 13.5px !important;
    line-height: 1.4 !important;
    color: var(--kx-text) !important;
    border-top: none !important;
    border-bottom: 10px solid #fff !important;
    box-shadow: 0 1px 0 0 var(--kx-border) !important;
    border-left: none !important;
    border-right: none !important;
    vertical-align: middle !important;
    background: #fff !important;
}

.bank-details-page table.dataTable tbody td:first-child,
.bank-details-page table.dataTable tbody td:last-child {
    border-radius: 0 !important;
}

.bank-details-page table.dataTable tbody tr:last-child td {
    border-bottom: none !important;
    box-shadow: none !important;
}

.bank-details-page table.dataTable tbody tr:hover td {
    background: #FCF6FC !important;
}

.bank-details-page .kx-id-pill {
    display: inline-block;
    padding: 4px 12px;
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-radius: 999px;
    font-weight: 700;
    font-size: 12.5px;
}

.bank-details-page .kx-btn-details {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    font-size: 12.5px;
    font-weight: 600;
    border-radius: 8px;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    border: 1px solid var(--kx-soft);
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.2s ease;
}

.bank-details-page .kx-btn-details:hover {
    background: var(--kx-primary-dark);
    border-color: var(--kx-primary-dark);
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 8px 16px rgba(57, 35, 103, 0.2);
}

/* DataTables controls (if initialised via datatables.init.js) */
.bank-details-page .dataTables_wrapper .dataTables_length select,
.bank-details-page .dataTables_wrapper .dataTables_filter input {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    height: 40px;
    padding: 0 12px;
    font-size: 13px;
    color: var(--kx-text);
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.bank-details-page .dataTables_wrapper .dataTables_filter input {
    min-width: 220px;
}

.bank-details-page .dataTables_wrapper .dataTables_filter input:focus,
.bank-details-page .dataTables_wrapper .dataTables_length select:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.bank-details-page .dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-block;
    padding: 6px 14px;
    margin: 0 3px;
    border-radius: 8px;
    border: 1px solid var(--kx-border);
    color: var(--kx-primary-dark) !important;
    background: #fff;
    text-decoration: none !important;
    transition: all .2s ease;
}

.bank-details-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark)) !important;
    border-color: var(--kx-primary-dark);
    color: #fff !important;
}

@media (max-width: 767px) {
    .bank-details-page .kx-page-head {
        flex-direction: column;
    }
    .bank-details-page .kx-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .bank-details-page .kx-field-label {
        flex: 0 0 100%;
        max-width: 100%;
        padding-top: 0;
    }
    .bank-details-page .kx-field-control {
        max-width: 100%;
    }
}
</style>

<div class="content-body bank-details-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-university"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome {{Auth::user()->name}}!</h4>
                    <p class="kx-page-subtitle">
                        Update bank details and manage its services.
                        @if(Auth::user()->role_id==2)
                            &nbsp;&middot;&nbsp;Agent ID: {{Auth::user()->new_id}}
                        @endif
                    </p>
                </div>
            </div>
            <nav class="kx-breadcrumb">
                <a href="{{$base_url}}/admin/bank/all">Banks</a> / <span class="kx-crumb-current">Bank Details</span>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <!-- Edit Bank Details -->
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-left">
                            <div class="kx-card-icon"><i class="fa fa-pencil"></i></div>
                            <div>
                                <h4 class="kx-card-title">Edit Bank Details</h4>
                                <p class="kx-card-subtitle">Update the logo, name, and terms for this bank</p>
                            </div>
                        </div>
                        @if($bank->is_active==0)
                        <span class="kx-status kx-status-inactive"><span class="kx-dot"></span>Inactive</span>
                        @else
                        <span class="kx-status kx-status-active"><span class="kx-dot"></span>Active</span>
                        @endif
                    </div>

                    <div class="kx-form-body">
                        <div class="kx-image-preview-box">
                            <img src="{{$base_url}}/storage\app/{{$bank->bank_image}}" id="current_product_image" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">
                        </div>

                        <form class="" action="{{$bank->bank_id}}" method="post" enctype='multipart/form-data'>
                            @csrf

                            <div class="kx-field">
                                <label class="kx-field-label" for="sub_service_image">Bank Image/Logo <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                    <input type="file" class="kx-file-input" id="sub_service_image" name="logo">
                                    @if ($errors->has('sub_service_image'))
                                    <span class="kx-help-block">{{ $errors->first('sub_service_image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" id="bank_name" name="bank_name" value="{{old('bank_name)', $bank->bank_name)}}" placeholder="Bank Name">
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
                                           value="{{ old('effective_interest_range', $bank->effective_interest_range) }}"
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
                                           value="{{ old('age_limit', $bank->age_limit) }}"
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
                                           value="{{ old('processing_fee', $bank->processing_fee) }}"
                                           placeholder="2% of loan amount"
                                           required>
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="val-suggestions">Description <span class="text-danger">*</span></label>
                                <div class="kx-field-control">
                                    <textarea name="desc" class="kx-input" id="val-suggestions" rows="5" placeholder="What would you like to see?">{{$bank->description}}</textarea>
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label">Know More Description</label>
                                <div class="kx-field-control">
                                    <textarea
                                        name="know_more_description"
                                        class="kx-input"
                                        rows="6"
                                    >{{ old('know_more_description', $bank->know_more_description) }}</textarea>
                                </div>
                            </div>

                            <div class="kx-field">
                                <div class="kx-field-label"></div>
                                <div class="kx-field-control kx-actions">
                                    <button name="save" type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    @if($bank->is_active ==0)
                                    <button name="active" class="kx-btn kx-btn-success"><i class="fa fa-toggle-on"></i> Active</button>
                                    @endif
                                    @if($bank->is_active ==1)
                                    <button name="inactive" class="kx-btn kx-btn-danger"><i class="fa fa-toggle-off"></i> In-Active</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Add Sub-Service -->
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-left">
                            <div class="kx-card-icon"><i class="fa fa-plus"></i></div>
                            <div>
                                <h4 class="kx-card-title">Add Sub-Service for {{$bank->bank_name}}</h4>
                                <p class="kx-card-subtitle">Link this bank to a service, via API or URL</p>
                            </div>
                        </div>
                    </div>

                    <div class="kx-form-body">
                        <form class="" action="{{$bank->bank_id}}" method="post" enctype='multipart/form-data'>
                            @csrf

                            <div class="kx-field">
                                <label class="kx-field-label" for="val-skill">Select Service <span class="text-danger">*</span></label>
                                <div class="kx-field-control">
                                    <select class="kx-input" name="sub_service_id" id="service_id">
                                        <option value="">Please select</option>
                                        @foreach($services as $service)
                                        <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="kx-field">
                                <div class="kx-field-label">Connection Type</div>
                                <div class="kx-field-control">
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
                            </div>

                            <div class="kx-field hidden" id="url_show">
                                <label class="kx-field-label" for="bank_url">Bank URL <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('bank_url') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" id="bank_url" value="{{old('bank_url')}}" name="bank_url" placeholder="Bank URL">
                                    @if ($errors->has('bank_url'))
                                    <span class="kx-help-block">{{ $errors->first('bank_url') }}</span>
                                    @endif
                                </div>
                            </div>

                            @if($errors->any())
                            <div class="kx-error-list">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="kx-field">
                                <div class="kx-field-label"></div>
                                <div class="kx-field-control kx-actions">
                                    <button name="add-service" type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Services table -->
        <div class="row">
            <div class="col-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-left">
                            <div class="kx-card-icon"><i class="fa fa-th-large"></i></div>
                            <div>
                                <h4 class="kx-card-title">{{$bank->bank_name}} Services</h4>
                                <p class="kx-card-subtitle">Services currently linked to this bank</p>
                            </div>
                        </div>
                    </div>

                    <div class="kx-table-wrap">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Service</th>
                                        <th>Bank Name</th>
                                        <th>Updated At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banks as $bank)
                                    <tr>
                                        <td><span class="kx-id-pill">{{$bank->bank_subservice_id}}</span></td>
                                        <td>{{$bank->service->service_name}}</td>
                                        <td>{{$bank->bank->bank_name}}</td>
                                        @php
                                        $newdate=date_format($bank->service->updated_at,"d-m-Y");
                                        @endphp
                                        <td>{{$newdate}}</td>
                                        @if($bank->status_id==1)
                                        <td><span class="kx-status kx-status-active"><span class="kx-dot"></span>Active</span></td>
                                        @else
                                        <td><span class="kx-status kx-status-inactive"><span class="kx-dot"></span>Inactive</span></td>
                                        @endif
                                        <td><a type="button" href="{{$bank->bank_id}}/{{$bank->bank_subservice_id}}" class="kx-btn-details"><i class="fa fa-arrow-right"></i> Details</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">
<script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
<script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>

<script>
   $( document ).ready(function() {
    @if(session('success'))
    toastr.success("{{Session::get('success')}}", "Success!", {
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
    @endif
    @php
    session()->forget('success');
    @endphp
});
</script>
<script class="">
  // alert();
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
</script>

<link href="{{$base_url}}/css/style.css" rel="stylesheet">
<script src="{{$base_url}}/js/quixnav-init.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>
<link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection