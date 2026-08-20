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
</style>

<div class="admin-content-wrapper">
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Menu Click Report</a></li>
                        </ol>
                    </div>
                </div>

    <!--<h4 class="mb-4">Menu Click Report</h4>-->

    <div class="card">
        <div class="card-body">
<div class="d-flex justify-content-between mb-3">
    <h4 class="mb-0">Menu Click Report</h4>

    <a href="{{ route('menu.clicks.export') }}"
       class="btn btn-success btn-sm">
        Download Excel
    </a>
</div>

            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Menu Type</th>
                        <th>Item</th>
                        <th>Click Count</th>
                        <th>IP Address</th>
                        <th>Last Clicked</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clicks as $click)
                    <tr>
                        <td>{{ ($clicks->currentPage() - 1) * $clicks->perPage() + $loop->iteration }}</td>
                        <td>{{ $click->customer->customer_name ?? 'Guest' }}</td>
                        <td>{{ $click->customer->email ?? '-' }}</td>
                        <td>{{ $click->customer->phone ?? '-' }}</td>
                        <td>{{ ucfirst($click->menu_type) }}</td>
                        <td>{{ str_replace('_', ' ', $click->item) }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $click->click_count }}
                            </span>
                        </td>
                        <td>{{ $click->ip_address }}</td>
                        <td>{{ $click->updated_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            No menu click data found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $clicks->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
