@extends('layouts.admin-app')

@section('content')
<style>
.table-scroll{
    max-height:420px;
    overflow:auto;
    -webkit-overflow-scrolling: touch;
}
.table th,.table td{white-space:nowrap}
.table thead th{
    position:sticky;
    top:0;
    background:#f8f9fa;
    z-index:2;
}
/* THEAD */
.table thead th {
    background-color: #eef2f7;
    color: #1f2937;
    font-weight: 600;
    border-bottom: 2px solid #d1d5db;
}
/* BODY */
.table tbody td {
    color: #374151;
    background-color: #ffffff;
}
.table tbody tr:nth-child(even) td {
    background-color: #f9fafb;
}
.table-hover tbody tr:hover td {
    background-color: #eef6ff;
}

/* Loan Services & Fields title row */
.services-title-row{
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    gap:10px;
}
@media(max-width:575px){
    .services-title-row{
        flex-direction:column;
        align-items:stretch;
    }
    .services-title-row .btn{
        width:100%;
    }
}

/* Per-service card header */
.service-card-header{
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    gap:10px;
}
@media(max-width:575px){
    .service-card-header{
        flex-direction:column;
        align-items:stretch;
    }
    .service-card-header .btn{
        width:100%;
        order:2;
    }
    .service-card-header strong,
    .service-card-header form{
        order:1;
    }
}

/* Modal responsiveness */
.modal-dialog{
    margin:1rem;
}
@media(min-width:576px){
    .modal-dialog{
        margin:1.75rem auto;
    }
}
</style>

<div class="content-body">
<div class="container-fluid">

    {{-- Header (same structure as Bank list page-titles row) --}}
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-0">Hi, welcome {{ Auth::user()->name }}!</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Loan Services</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            {{-- Page Card --}}
            <div class="card">
                <div class="card-body">

                    <div class="services-title-row mb-3">
                        <h4 class="mb-0">Loan Services & Fields</h4>

                        <div>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addServiceModal">
                                + Add Service
                            </button>
                        </div>
                    </div>

                    @foreach($services as $service)
                    <div class="card mb-4 border">
                        <div class="card-header service-card-header">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-toggle="modal"
                                    data-target="#addFieldModal{{ $service->id }}">
                                + Add Field
                            </button>

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

                                                <div class="form-group">
                                                    <label>Field Label</label>
                                                    <input type="text"
                                                           name="field_label"
                                                           class="form-control"
                                                           placeholder="e.g. Annual Income"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Field Name (DB)</label>
                                                    <input type="text"
                                                           name="field_name"
                                                           class="form-control"
                                                           placeholder="e.g. annual_income"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Field Type</label>
                                                    <select name="field_type" class="form-control">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="select">Select</option>
                                                    </select>
                                                </div>
                                                <div class="form-group d-none option-box">
                                                    <label>
                                                        Select Options
                                                        <small class="text-muted">(one option per line)</small>
                                                    </label>
                                                    <textarea
                                                        name="options"
                                                        class="form-control"
                                                        rows="4"
                                                        placeholder="Salaried
                                                        Self Employed
                                                        Business Owner
                                                        Freelancer"></textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label>Required</label>
                                                    <select name="is_required" class="form-control">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    Save Field
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <strong>{{ $service->name }}</strong>

                            <form method="POST"
                                  action="{{ route('admin.loan.services.toggle', $service->id) }}"
                                  class="d-inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="badge border-0
                                    {{ $service->is_active ? 'badge-success' : 'badge-danger' }}"
                                    style="cursor:pointer;">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>

                        </div>

                        <div class="card-body">
                            @if($service->fields->count())
                                <div class="table-scroll table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Field Label</th>
                                                <th>Field Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>Required</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($service->fields as $field)
                                            <tr>
                                                <td>{{ $field->field_label }}</td>
                                                <td>{{ $field->field_name }}</td>
                                                <td>{{ $field->field_type }}</td>
                                                <td>
                                                    <span class="badge {{ $field->is_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $field->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="POST"
                                                          action="{{ route('admin.loan.services.field.toggle', $field->id) }}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button class="btn btn-sm {{ $field->is_active ? 'btn-danger' : 'btn-success' }}">
                                                            {{ $field->is_active ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                </td>

                                                <td>{{ $field->is_required ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted mb-0">No fields added yet.</p>
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
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.loan.services.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Loan Service</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Service Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="e.g. Personal Loan"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Select Child Service</label>

                        <select name="service_child_id" class="form-control" required>

                            <option value="">Select Service</option>

                            @foreach($childServices as $child)
                                <option value="{{ $child->child_service_id }}">
                                    {{ $child->sub_service_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Service
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