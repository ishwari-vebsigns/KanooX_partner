@extends('layouts.admin-app')

@section('content')

    <style>
        /* ===== CARD ===== */
        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        /* ===== TABLE SCROLL ===== */
        .table-scroll {
            position: relative;
            max-height: 420px;
            overflow-y: auto;
            overflow-x: auto;
        }

        /* ===== STICKY HEADER FIX ===== */
        .table-scroll thead th {
            position: sticky;
            top: 0;
            background: #eef2f7;
            z-index: 5;
            /* below navbar, above rows */
        }

        /* ===== TABLE STRUCTURE ===== */
        .table {
            width: 100%;
            min-width: 900px;
        }

        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        /* ===== HEADER STYLE ===== */
        .table thead th {
            color: #1f2937;
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }

        /* ===== BODY ===== */
        .table tbody td {
            color: #374151;
            background-color: #ffffff;
        }

        /* ===== ROW STRIPES ===== */
        .table tbody tr:nth-child(even) td {
            background-color: #f9fafb;
        }

        /* ===== HOVER ===== */
        .table-hover tbody tr:hover td {
            background-color: #eef6ff;
        }

        /* ===== SCORE BADGE ===== */
        .score-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            color: #fff;
        }

        .score-good {
            background-color: #392367;
        }

        .score-mid {
            background-color: #f59e0b;
        }

        .score-low {
            background-color: #ef4444;
        }

        .score-na {
            background-color: #6b7280;
        }

        /* ===== BUTTONS ===== */
        .btn-details {
            background-color: #9D3895;
            color: #fff;
            border-radius: 6px;
            padding: 5px 12px;
            font-size: 12px;
            margin-right: 4px;
        }

        .btn-details:hover {
            background-color: #000;
            color: #fff;
        }

        .btn-pdf {
            background-color: #22c55e;
            color: #fff;
            border-radius: 6px;
            padding: 5px 12px;
            font-size: 12px;
        }

        .btn-pdf:hover {
            background-color: #16a34a;
            color: #fff;
        }

        /* ===== SCROLLBAR (optional clean) ===== */
        .table-scroll::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .form-label {
            font-size: 11px;
            color: #67748e;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }

        .form-control {
            height: 42px;
            border-radius: 10px;
        }

        .btn {
            height: 42px;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>

    <div class="content-body">
        <div class="container-fluid">

            <!-- HEADER (same structure as Bank list page-titles row) -->
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">CIBIL Reports</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">

                            <form method="GET" action="{{ route('admin.cibil.reports') }}">

                                <div class="row align-items-end g-3">

                                    <div class="col-md-2">
                                        <label class="form-label text-uppercase fw-bold small">
                                            From Date
                                        </label>
                                        <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label text-uppercase fw-bold small">
                                            To Date
                                        </label>
                                        <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label text-uppercase fw-bold small">
                                            Search
                                        </label>
                                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                            placeholder="Name, Mobile, PAN, Score...">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100" style="background-color: #9D3895;">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ route('admin.cibil.reports') }}" class="btn btn-secondary w-100" style="background-color: #9D3895;">
                                            Clear
                                        </a>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="mb-0">CIBIL Reports</h4>

                                <a href="{{ route('admin.cibil.export', request()->all()) }}" class="btn btn-success">
                                    Export Excel
                                </a>
                            </div>

                            <div class="table-scroll table-responsive">
                                <table class="table table-bordered table-hover mb-0">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>National ID</th>
                                            <th>Mobile</th>
                                            <th>Score</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($reports as $r)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $r->name }}</td>
                                                <td>{{ $r->pan }}</td>
                                                <td>{{ $r->mobile }}</td>

                                                <!-- SCORE -->
                                                <td>
                                                    @php
                                                        $score = $r->credit_score;

                                                        if (!$score)
                                                            $class = 'score-na';
                                                        elseif ($score >= 750)
                                                            $class = 'score-good';
                                                        elseif ($score >= 650)
                                                            $class = 'score-mid';
                                                        else
                                                            $class = 'score-low';
                                                    @endphp

                                                    <span class="score-badge {{ $class }}">
                                                        {{ $score ?? 'N/A' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y, h:i A') }}
                                                </td>

                                                <!-- ACTION -->
                                                <td class="text-center">
                                                    <a href="{{ route('admin.cibil.details', $r->id) }}" class="btn btn-details">
                                                        Details
                                                    </a>

                                                    @if($r->pdf_link)
                                                        <a href="{{ $r->pdf_link }}" target="_blank" class="btn btn-pdf">
                                                            PDF
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    No CIBIL Reports Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $reports->appends(request()->only('search'))->links() }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection