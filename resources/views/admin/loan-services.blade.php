@extends('layouts.admin-app')

@section('content')
<style>
.loan-services-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.loan-services-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.loan-services-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.loan-services-page .kx-title-icon {
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

.loan-services-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.loan-services-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.loan-services-page .kx-breadcrumb {
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
    list-style: none;
}

.loan-services-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.loan-services-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.loan-services-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- Card ---------- */
.loan-services-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
    margin-bottom: 22px;
}

.loan-services-page .kx-card-body {
    padding: 26px;
}

.loan-services-page .kx-services-title-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 22px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--kx-border);
}

.loan-services-page .kx-services-title-row h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
    color: var(--kx-text);
}

@media (max-width: 575px) {
    .loan-services-page .kx-services-title-row {
        flex-direction: column;
        align-items: stretch;
    }
    .loan-services-page .kx-services-title-row .kx-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ---------- Service sub-card ---------- */
.loan-services-page .kx-service-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 14px;
    margin-bottom: 20px;
    overflow: hidden;
}

.loan-services-page .kx-service-card:last-child {
    margin-bottom: 0;
}

.loan-services-page .kx-service-card-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 16px 20px;
    background: var(--kx-page-bg);
    border-bottom: 1px solid var(--kx-border);
}

.loan-services-page .kx-service-card-header .kx-service-name {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 700;
    color: var(--kx-text);
}

.loan-services-page .kx-service-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.loan-services-page .kx-service-header-right {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

@media (max-width: 575px) {
    .loan-services-page .kx-service-card-header {
        flex-direction: column;
        align-items: stretch;
    }
    .loan-services-page .kx-service-header-left,
    .loan-services-page .kx-service-header-right {
        width: 100%;
        justify-content: space-between;
    }
    .loan-services-page .kx-service-card-header .kx-btn {
        justify-content: center;
    }
}

.loan-services-page .kx-service-card-body {
    padding: 18px 20px 20px;
}

.loan-services-page .kx-empty-note {
    margin: 0;
    color: var(--kx-muted);
    font-size: 13.5px;
}

/* ---------- Status badges ---------- */
.loan-services-page .kx-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 13px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    border: none;
    cursor: pointer;
}

.loan-services-page .kx-badge .kx-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.loan-services-page .kx-badge-active {
    background: #EAF8EF;
    color: #238B45;
}
.loan-services-page .kx-badge-active .kx-dot { background: #238B45; }

.loan-services-page .kx-badge-inactive {
    background: #FDECEC;
    color: #D64545;
}
.loan-services-page .kx-badge-inactive .kx-dot { background: #D64545; }

/* ---------- Buttons ---------- */
.loan-services-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 9px;
    border: 1px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
    line-height: 1.2;
    white-space: nowrap;
}

.loan-services-page .kx-btn:hover {
    transform: translateY(-1px);
}

.loan-services-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.loan-services-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.loan-services-page .kx-btn-outline {
    background: #fff;
    color: var(--kx-primary-dark);
    border-color: var(--kx-primary);
}

.loan-services-page .kx-btn-outline:hover {
    background: var(--kx-primary);
    color: #fff;
}

.loan-services-page .kx-btn-success-soft {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
    padding: 6px 14px;
    font-size: 12.5px;
}

.loan-services-page .kx-btn-success-soft:hover {
    background: #238B45;
    color: #fff;
}

.loan-services-page .kx-btn-danger-soft {
    background: #FDECEC;
    color: #D64545;
    border-color: #F6C9C9;
    padding: 6px 14px;
    font-size: 12.5px;
}

.loan-services-page .kx-btn-danger-soft:hover {
    background: #D64545;
    color: #fff;
}

.loan-services-page .kx-btn-secondary {
    background: #fff;
    color: var(--kx-muted);
    border-color: var(--kx-border);
}

.loan-services-page .kx-btn-secondary:hover {
    background: var(--kx-page-bg);
    color: var(--kx-text);
}

/* ---------- Icon action buttons (edit/delete) ---------- */
.loan-services-page .kx-icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid var(--kx-border);
    background: #fff;
    color: var(--kx-muted);
    cursor: pointer;
    font-size: 13px;
    transition: all 0.2s ease;
    padding: 0;
}

.loan-services-page .kx-icon-btn:hover {
    transform: translateY(-1px);
}

.loan-services-page .kx-icon-btn-edit:hover {
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-color: var(--kx-primary);
}

.loan-services-page .kx-icon-btn-delete:hover {
    background: #FDECEC;
    color: #D64545;
    border-color: #F6C9C9;
}

.loan-services-page .kx-actions-group {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* ---------- Table ---------- */
.loan-services-page .table-scroll {
    max-height: 420px;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    border: 1px solid var(--kx-border);
    border-radius: 12px;
}

.loan-services-page .kx-fields-table {
    width: 100%;
    border-collapse: collapse;
    white-space: nowrap;
}

.loan-services-page .kx-fields-table th,
.loan-services-page .kx-fields-table td {
    white-space: nowrap;
}

.loan-services-page .kx-fields-table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--kx-border);
}

.loan-services-page .kx-fields-table tbody td {
    padding: 14px 16px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    border-bottom: 1px solid var(--kx-border);
    vertical-align: middle;
}

.loan-services-page .kx-fields-table tbody tr:last-child td {
    border-bottom: none;
}

.loan-services-page .kx-fields-table tbody tr:hover td {
    background: #FCF6FC;
}

/* ---------- Modal ---------- */
.loan-services-page .modal-dialog {
    margin: 1rem;
}

@media (min-width: 576px) {
    .loan-services-page .modal-dialog {
        margin: 1.75rem auto;
    }
}

.loan-services-page .modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(57, 35, 103, 0.2);
}

.loan-services-page .modal-header {
    background: var(--kx-page-bg);
    border-bottom: 1px solid var(--kx-border);
    padding: 18px 22px;
}

.loan-services-page .modal-header .modal-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--kx-text);
}

.loan-services-page .modal-header .close {
    color: var(--kx-muted);
    opacity: 1;
    text-shadow: none;
}

.loan-services-page .modal-body {
    padding: 22px;
}

.loan-services-page .modal-footer {
    padding: 16px 22px;
    border-top: 1px solid var(--kx-border);
}

.loan-services-page .kx-form-group {
    margin-bottom: 18px;
}

.loan-services-page .kx-form-group:last-child {
    margin-bottom: 0;
}

.loan-services-page .kx-form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--kx-text);
    margin-bottom: 7px;
}

.loan-services-page .kx-form-group .text-danger {
    color: #D64545;
}

.loan-services-page .kx-form-group small {
    font-weight: 400;
    color: var(--kx-muted);
}

.loan-services-page .kx-input,
.loan-services-page select.kx-input,
.loan-services-page textarea.kx-input {
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

.loan-services-page .kx-input {
    height: 44px;
}

.loan-services-page select.kx-input {
    height: 44px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%23747080' viewBox='0 0 16 16'%3E%3Cpath d='M8 11 3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 34px;
}

.loan-services-page textarea.kx-input {
    height: auto;
    padding: 12px 14px;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.loan-services-page .kx-input:focus,
.loan-services-page select.kx-input:focus,
.loan-services-page textarea.kx-input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

@media (max-width: 767px) {
    .loan-services-page .kx-page-head {
        flex-direction: column;
    }
    .loan-services-page .kx-card-body {
        padding: 18px;
    }
}
</style>

<div class="content-body loan-services-page">
<div class="container-fluid">

    <div class="kx-page-head">
        <div class="kx-title-wrap">
            <div class="kx-title-icon"><i class="fa fa-sliders"></i></div>
            <div>
                <h4 class="kx-page-title">Hi, welcome {{ Auth::user()->name }}!</h4>
                <p class="kx-page-subtitle">Manage loan services and their custom fields</p>
            </div>
        </div>
        <ol class="kx-breadcrumb">
            <li><a href="javascript:void(0)">Settings</a></li>
            <li>/</li>
            <li class="kx-crumb-current"><a href="javascript:void(0)">Loan Services</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">

            {{-- Page Card --}}
            <div class="kx-card">
                <div class="kx-card-body">

                    <div class="kx-services-title-row">
                        <h4>Loan Services & Fields</h4>

                        <div>
                            <button class="kx-btn kx-btn-primary" data-toggle="modal" data-target="#addServiceModal">
                                <i class="fa fa-plus"></i> Add Service
                            </button>
                        </div>
                    </div>

                    @foreach($services as $service)
                    <div class="kx-service-card">
                        <div class="kx-service-card-header">

                            <div class="kx-service-header-left">
                                <div class="kx-service-name">{{ $service->name }}</div>

                                <form method="POST"
                                      action="{{ route('admin.loan.services.toggle', $service->id) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="kx-badge {{ $service->is_active ? 'kx-badge-active' : 'kx-badge-inactive' }}">
                                        <span class="kx-dot"></span>
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </div>

                            <div class="kx-service-header-right">
                                <button class="kx-btn kx-btn-outline"
                                        data-toggle="modal"
                                        data-target="#addFieldModal{{ $service->id }}">
                                    <i class="fa fa-plus"></i> Add Field
                                </button>

                                <div class="kx-actions-group">
                                    <button type="button"
                                            class="kx-icon-btn kx-icon-btn-edit"
                                            title="Edit Service"
                                            data-toggle="modal"
                                            data-target="#editServiceModal{{ $service->id }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>

                                    <form method="POST"
                                          action="{{ route('admin.loan.services.destroy', $service->id) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this service and all its fields? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="kx-icon-btn kx-icon-btn-delete" title="Delete Service">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Add Field Modal --}}
                            <div class="modal fade" id="addFieldModal{{ $service->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST"
                                          action="{{ route('admin.loan.services.field.store') }}">
                                        @csrf

                                        <input type="hidden"
                                               name="loan_service_id"
                                               value="{{ $service->id }}">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Add Field – {{ $service->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="kx-form-group">
                                                    <label>Field Label</label>
                                                    <input type="text"
                                                           name="field_label"
                                                           class="kx-input"
                                                           placeholder="e.g. Annual Income"
                                                           required>
                                                </div>

                                                <div class="kx-form-group">
                                                    <label>Field Name (DB)</label>
                                                    <input type="text"
                                                           name="field_name"
                                                           class="kx-input"
                                                           placeholder="e.g. annual_income"
                                                           required>
                                                </div>

                                                <div class="kx-form-group">
                                                    <label>Field Type</label>
                                                    <select name="field_type" class="kx-input">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="select">Select</option>
                                                    </select>
                                                </div>
                                                <div class="kx-form-group d-none option-box">
                                                    <label>
                                                        Select Options
                                                        <small class="text-muted">(one option per line)</small>
                                                    </label>
                                                    <textarea
                                                        name="options"
                                                        class="kx-input"
                                                        rows="4"
                                                        placeholder="Salaried
                                                        Self Employed
                                                        Business Owner
                                                        Freelancer"></textarea>
                                                </div>


                                                <div class="kx-form-group">
                                                    <label>Required</label>
                                                    <select name="is_required" class="kx-input">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="kx-btn kx-btn-primary">
                                                    <i class="fa fa-check"></i> Save Field
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Edit Service Modal --}}
                            <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST"
                                          action="{{ route('admin.loan.services.update', $service->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Loan Service</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="kx-form-group">
                                                    <label>Service Name <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                           name="name"
                                                           class="kx-input"
                                                           value="{{ $service->name }}"
                                                           required>
                                                </div>

                                                <div class="kx-form-group">
                                                    <label>Select Child Service</label>
                                                    <select name="service_child_id" class="kx-input" required>
                                                        <option value="">Select Service</option>
                                                        @foreach($childServices as $child)
                                                            <option value="{{ $child->child_service_id }}"
                                                                {{ $service->service_child_id == $child->child_service_id ? 'selected' : '' }}>
                                                                {{ $child->sub_service_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="kx-form-group">
                                                    <label>Status</label>
                                                    <select name="is_active" class="kx-input">
                                                        <option value="1" {{ $service->is_active ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="kx-btn kx-btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="kx-btn kx-btn-primary">
                                                    <i class="fa fa-check"></i> Update Service
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="kx-service-card-body">
                            @if($service->fields->count())
                                <div class="table-scroll table-responsive">
                                    <table class="kx-fields-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Field Label</th>
                                                <th>Field Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>Required</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($service->fields as $field)
                                            <tr>
                                                <td>{{ $field->field_label }}</td>
                                                <td>{{ $field->field_name }}</td>
                                                <td>{{ $field->field_type }}</td>
                                                <td>
                                                    <span class="kx-badge {{ $field->is_active ? 'kx-badge-active' : 'kx-badge-inactive' }}">
                                                        <span class="kx-dot"></span>
                                                        {{ $field->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="POST"
                                                          action="{{ route('admin.loan.services.field.toggle', $field->id) }}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button class="kx-btn {{ $field->is_active ? 'kx-btn-danger-soft' : 'kx-btn-success-soft' }}">
                                                            {{ $field->is_active ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                </td>

                                                <td>{{ $field->is_required ? 'Yes' : 'No' }}</td>

                                                <td>
                                                    <div class="kx-actions-group">
                                                        <button type="button"
                                                                class="kx-icon-btn kx-icon-btn-edit"
                                                                title="Edit Field"
                                                                data-toggle="modal"
                                                                data-target="#editFieldModal{{ $field->id }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>

                                                        <form method="POST"
                                                              action="{{ route('admin.loan.services.field.destroy', $field->id) }}"
                                                              class="d-inline"
                                                              onsubmit="return confirm('Delete this field?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="kx-icon-btn kx-icon-btn-delete" title="Delete Field">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    {{-- Edit Field Modal --}}
                                                    <div class="modal fade" id="editFieldModal{{ $field->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <form method="POST"
                                                                  action="{{ route('admin.loan.services.field.update', $field->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Edit Field – {{ $service->name }}
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            &times;
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <div class="kx-form-group">
                                                                            <label>Field Label</label>
                                                                            <input type="text"
                                                                                   name="field_label"
                                                                                   class="kx-input"
                                                                                   value="{{ $field->field_label }}"
                                                                                   required>
                                                                        </div>

                                                                        <div class="kx-form-group">
                                                                            <label>Field Name (DB)</label>
                                                                            <input type="text"
                                                                                   name="field_name"
                                                                                   class="kx-input"
                                                                                   value="{{ $field->field_name }}"
                                                                                   required>
                                                                        </div>

                                                                        <div class="kx-form-group">
                                                                            <label>Field Type</label>
                                                                            <select name="field_type" class="kx-input edit-field-type-select">
                                                                                <option value="text" {{ $field->field_type == 'text' ? 'selected' : '' }}>Text</option>
                                                                                <option value="number" {{ $field->field_type == 'number' ? 'selected' : '' }}>Number</option>
                                                                                <option value="select" {{ $field->field_type == 'select' ? 'selected' : '' }}>Select</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="kx-form-group option-box {{ $field->field_type == 'select' ? '' : 'd-none' }}">
                                                                            <label>
                                                                                Select Options
                                                                                <small class="text-muted">(one option per line)</small>
                                                                            </label>
                                                                            @php
                                                                                $optionsValue = $field->options;
                                                                                if (is_array($optionsValue)) {
                                                                                    $optionsValue = implode("\n", array_map(function ($opt) {
                                                                                        return is_array($opt) ? json_encode($opt) : (string) $opt;
                                                                                    }, $optionsValue));
                                                                                }
                                                                            @endphp
                                                                            <textarea
                                                                                name="options"
                                                                                class="kx-input"
                                                                                rows="4">{{ $optionsValue }}</textarea>
                                                                        </div>

                                                                        <div class="kx-form-group">
                                                                            <label>Required</label>
                                                                            <select name="is_required" class="kx-input">
                                                                                <option value="1" {{ $field->is_required ? 'selected' : '' }}>Yes</option>
                                                                                <option value="0" {{ !$field->is_required ? 'selected' : '' }}>No</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="kx-btn kx-btn-secondary" data-dismiss="modal">
                                                                            Cancel
                                                                        </button>
                                                                        <button type="submit" class="kx-btn kx-btn-primary">
                                                                            <i class="fa fa-check"></i> Update Field
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="kx-empty-note">No fields added yet.</p>
                            @endif

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</div>
</div>

<!-- Add Service Modal -->
<div class="modal fade loan-services-page" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.loan.services.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Loan Service</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="kx-form-group">
                        <label>Service Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               class="kx-input"
                               placeholder="e.g. Personal Loan"
                               required>
                    </div>
                    <div class="kx-form-group">
                        <label>Select Child Service</label>

                        <select name="service_child_id" class="kx-input" required>

                            <option value="">Select Service</option>

                            @foreach($childServices as $child)
                                <option value="{{ $child->child_service_id }}">
                                    {{ $child->sub_service_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="kx-form-group">
                        <label>Status</label>
                        <select name="is_active" class="kx-input">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="kx-btn kx-btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="kx-btn kx-btn-primary">
                        <i class="fa fa-check"></i> Save Service
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('change', function (e) {
    if (e.target.name === 'field_type') {
        const modal = e.target.closest('.modal');
        const optionBox = modal.querySelector('.option-box');

        if (e.target.value === 'select') {
            optionBox.classList.remove('d-none');
        } else {
            optionBox.classList.add('d-none');
        }
    }
});
</script>

@endsection