@extends('layouts.admin-app')

@section('content')
<style>
/* ===== ADMIN CONTENT OFFSET FIX ===== */
.admin-content-wrapper {
    margin-left: 260px;   /* sidebar width */
    padding-top: 120px;    /* header height */
    padding-right: 24px;
    padding-left: 24px;
}

/* Mobile */
@media (max-width: 991px) {
    .admin-content-wrapper {
        margin-left: 0;
        padding-top: 80px;
    }
}

/* ===== TABLE SCROLL ===== */
.table-scroll {
    max-height: 420px;
    overflow-y: auto;
    overflow-x: auto;
}

/* Sticky header */
.table-scroll thead th {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    z-index: 2;
    white-space: nowrap;
}

/* Prevent wrapping */
.table td, .table th {
    white-space: nowrap;
}
/* THEAD (table header) */
.table thead th {
    background-color: #eef2f7;   /* light bluish-grey */
    color: #1f2937;              /* dark readable text */
    font-weight: 600;
    border-bottom: 2px solid #d1d5db;
}

/* TABLE BODY */
.table tbody td {
    color: #374151;              /* dark grey (very readable) */
    background-color: #ffffff;
}

/* Alternate row color for readability */
.table tbody tr:nth-child(even) td {
    background-color: #f9fafb;   /* very light grey */
}

/* Hover effect */
.table-hover tbody tr:hover td {
    background-color: #eef6ff;   /* subtle blue hover */
}

</style>

<div class="admin-content-wrapper">
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Insurance Leads</a></li>
                        </ol>
                    </div>
                </div>

        <!--<h4 class="mb-4">Insurance Leads</h4>-->

        <div class="card">
            <div class="card-body">
<div class="d-flex justify-content-between mb-3">
    <h5 class="mb-0">Insurance Leads</h5>

    <a href="{{ route('insurance.leads.export') }}"
       class="btn btn-success btn-sm">
        <i class="fa fa-file-excel"></i> Download Excel
    </a>
</div>

                <div class="table-scroll">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Mobile</th>
                                <th>User ID</th>
                                <th>Sub Service</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <td>{{ $loop->iteration + ($leads->currentPage()-1)*$leads->perPage() }}</td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ ucfirst($lead->gender) }}</td>
                                <td>{{ $lead->dob }}</td>
                                <td>{{ $lead->mobile }}</td>
                                <td>{{ $lead->user_id ?? '-' }}</td>
                                <td>{{ $lead->sub_service_id ?? '-' }}</td>
                                <td>{{ $lead->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $leads->links() }}
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
