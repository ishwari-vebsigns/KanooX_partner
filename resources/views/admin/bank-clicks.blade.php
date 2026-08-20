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

    .table thead th {
        background-color: #eef2f7;
        color: #1f2937;
        font-weight: 600;
        border-bottom: 2px solid #d1d5db;
    }

    .table tbody td {
        background: #fff;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(even) td {
        background: #f9fafb;
    }
    
    .table tbody td strong {
        color: #111827;
    }
    
    .table tbody td small {
        color: #374151 !important;
    }

    .table-hover tbody tr:hover td {
        background: #eef6ff;
    }

    .bank-badge {
        background: #34d399;
        color: #064e3b;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="admin-content-wrapper">

    <!-- HEADER -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6">
            <div class="welcome-text">
                <h4>Bank Click Tracking</h4>
                <p class="mb-0">User activity for bank visits</p>
            </div>
        </div>

        <div class="col-sm-6 d-flex justify-content-sm-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Reports</li>
                <li class="breadcrumb-item active">Bank Clicks</li>
            </ol>
        </div>
    </div>

    <!-- CARD -->
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h4 class="mb-0">All Clicks</h4>
                
                <a href="{{ route('admin.bank-clicks.export') }}"
                   class="btn btn-success">
                    Export Excel
                </a>
            </div>
            
            <div class="mb-3">
                <input type="text"
                       id="tableSearch"
                       class="form-control"
                       placeholder="Search customer, bank, mobile...">
            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Visit</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($clicks as $click)
                            <tr>
                                <td class="text-dark">{{ $click->id }}</td>

                                <td>
                                    <strong>{{ $click->customer_name }}</strong><br>
                                    <small class="text-muted">
                                        ID: {{ $click->loan_signin_id }}
                                    </small>
                                </td>

                                <td>
                                    <span class="bank-badge">
                                        {{ $click->bank_name }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ $click->bank_url }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        Visit
                                    </a>
                                </td>

                                <td class="text-dark">
                                    {{ \Carbon\Carbon::parse($click->created_at)->format('d M Y, h:i A') }}
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<script>
document.getElementById('tableSearch').addEventListener('keyup', function () {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');

    rows.forEach(function(row) {

        let text = row.innerText.toLowerCase();

        if (text.includes(value)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });
});
</script>

@endsection





