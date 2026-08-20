@extends('layouts.admin-app')

@section('content')
    <style>
        .table-scroll {
            max-height: 420px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .table-scroll thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
            white-space: nowrap;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }

        /* THEAD (table header) */
        .table thead th {
            background-color: #eef2f7;
            /* light bluish-grey */
            color: #1f2937;
            /* dark readable text */
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }

        /* TABLE BODY */
        .table tbody td {
            color: #374151;
            /* dark grey (very readable) */
            background-color: #ffffff;
        }

        /* Alternate row color for readability */
        .table tbody tr:nth-child(even) td {
            background-color: #f9fafb;
            /* very light grey */
        }

        /* Hover effect */
        .table-hover tbody tr:hover td {
            background-color: #eef6ff;
            /* subtle blue hover */
        }
    </style>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                        @if(Auth::user()->role_id == 2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Credit Card Leads</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="mb-0">Credit Card Leads</h4>

                                <a href="{{ route('credit.card.leads.export') }}" class="btn btn-success btn-sm">
                                    Download Excel
                                </a>
                            </div>

                            <div class="table-scroll table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>National ID</th>
                                            <th>DOB</th>
                                            <th>Profession Type</th>
                                            <th>Annual income</th>
                                            <th>Applied On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leads as $lead)
                                            <tr>
                                                <td>{{ $loop->iteration + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                                                <td>{{ $lead->name }}</td>
                                                <td>{{ $lead->mobile }}</td>
                                                <td>{{ $lead->pan }}</td>
                                                <td>{{ $lead->dob }}</td>
                                                <td>{{ $lead->profession_type }}</td>
                                                <td>{{ $lead->annual_income }}</td>
                                                <td>{{ $lead->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    No Credit Card Leads Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-3 d-flex justify-content-end">
                                {{ $leads->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection