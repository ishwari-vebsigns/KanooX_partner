@extends('layouts.admin-app')

@section('content')
<style>
    .admin-content-wrapper {
        margin-left: 260px;
        padding-top: 120px;
        padding-left: 24px;
        padding-right: 24px;
    }

    @media (max-width: 991px) {
        .admin-content-wrapper {
            margin-left: 0;
        }
    }

    /* THEAD */
    .table thead th {
        background-color: #eef2f7;
        color: #1f2937;
        font-weight: 600;
        border-bottom: 2px solid #d1d5db;
        white-space: nowrap;
    }

    /* BODY */
    .table tbody td {
        color: #374151;
        background-color: #ffffff;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* Alternate rows */
    .table tbody tr:nth-child(even) td {
        background-color: #f9fafb;
    }

    /* Hover */
    .table-hover tbody tr:hover td {
        background-color: #eef6ff;
    }
    .status-badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
    }
    
    .pending{
        background:#fef3c7;
        color:#b45309;
    }
    
    .uploaded{
        background:#dbeafe;
        color:#1d4ed8;
    }
    
    .approved{
        background:#dcfce7;
        color:#15803d;
    }
    
    .rejected{
        background:#fee2e2;
        color:#b91c1c;
    }
    
    .status-badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
}

.pending{
    background:#fef3c7;
    color:#b45309;
}

.uploaded{
    background:#dbeafe;
    color:#1d4ed8;
}

.approved{
    background:#dcfce7;
    color:#15803d;
}

.rejected{
    background:#fee2e2;
    color:#b91c1c;
}
</style>

<div class="admin-content-wrapper">

    {{-- Header --}}
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
                @if(Auth::user()->role_id == 2)
                    <p class="mb-0">Agent ID: {{ Auth::user()->new_id }}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Reports</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Loan Applications</a>
                </li>
            </ol>
        </div>
    </div>

    {{-- Card --}}
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h4 class="mb-0">Loan Applications</h4>

                <a href="{{ route('loan.applications.export') }}"
                   class="btn btn-success btn-sm">
                    Download Excel
                </a>
            </div>
<div class="table-responsive table-scroll">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <table class="table table-bordered table-hover mb-0">

            
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>PAN</th>
                        <th>Loan Type</th>
                        <th>Amount</th>
                        <th>Term</th>
                        <th>Profession</th>
                        <th>Upload Documents</th>
                        <th>Status</th>
                        <th>Approval</th>
                        <th>Applied On</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>{{ $loop->iteration + ($applications->currentPage()-1)*$applications->perPage() }}</td>
                        <td>{{ $app->full_name }}</td>
                        <td>{{ $app->mobile }}</td>
                        <td>{{ $app->email }}</td>
                        <td>{{ $app->pan_card }}</td>
                        <td>
                            {{ $app->loanType->sub_service_name ?? 'N/A' }}
                        </td>
                        <td>₹ {{ number_format($app->loan_amount, 2) }}</td>
                        <td>{{ $app->loan_term }} months</td>
                        <td>{{ $app->profession_type }}</td>
                        <td>
                            <a href="{{ route('loan-applications.documents', $app->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                Upload
                            </a>
                            
                        </td>
                        
                        <td>
                            @php
                                $docsUploaded =
                                    $app->aadhaar_document &&
                                    $app->pan_document &&
                                    $app->income_certificate;
                            @endphp
                        
                            {{-- Approved --}}
                            @if($app->status == 2)
                                <span class="status-badge approved">✔ Approved</span>
                                <br>
                                <small class="text-muted">
                                    by {{ optional($app->approvedByUser)->name ?? 'System' }}
                                </small>
                            
                            {{-- Rejected --}}
                            @elseif($app->status == 3)
                                <span class="status-badge rejected">✖ Rejected</span>
                                <br>
                                <small class="text-muted">
                                    by {{ optional($app->approvedByUser)->name ?? 'System' }}
                                </small>
                            
                            {{-- Documents Pending --}}
                            @elseif(!$docsUploaded)
                                <span class="status-badge pending">Documents Pending</span>
                                <br>
                                <small class="text-muted">
                                    Upload all documents to approve
                                </small>
                                
                        
                            {{-- Show buttons --}}
                            @else
                                {{-- Approve --}}
                                <form method="POST"
                                      action="{{ route('loan-applications.toggle-approval', $app->id) }}"
                                      style="display:inline;">
                                    @csrf
                                    <!--<button type="submit" class="btn btn-sm btn-outline-success">-->
                                    <!--    Approve-->
                                    <!--</button>-->
                                    <button type="submit" class="btn btn-sm btn-outline-success action-btn">
                                        Approve
                                    </button>
                                </form>
                        
                                {{-- Reject --}}
                                <form method="POST"
                                      action="{{ route('loan-applications.reject', $app->id) }}"
                                      style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger action-btn"
                                            onclick="return confirm('Are you sure?')">
                                        Reject
                                    </button>
                                </form>
                            @endif
                        </td>

                        <td>
                            @if($app->status == 0)
                                <span class="status-badge pending">Pending</span>
                            
                            @elseif($app->status == 1)
                                <span class="status-badge uploaded">Documents Uploaded</span>
                            
                            @elseif($app->status == 2)
                                <span class="status-badge approved">Approved</span>
                            
                            @elseif($app->status == 3)
                                <span class="status-badge rejected">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $app->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">
                            No Loan Applications Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $applications->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
