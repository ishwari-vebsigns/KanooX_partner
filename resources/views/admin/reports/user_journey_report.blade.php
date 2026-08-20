@extends('layouts.admin-app')

@section('content')

<style>
    /* ── Header ── */
    .journey-header { margin-bottom: 20px; }
    .journey-header h3 { font-size: 24px; font-weight: 700; color: #344767; margin: 0 0 4px; }
    .journey-header p  { color: #6c757d; margin: 0; font-size: 13px; }

    /* ── Toolbar (filter + export) ── */
    .journey-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 12px;
        margin-bottom: 20px;
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
        border: 1px solid #edf2f7;
    }
    .toolbar-group {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 10px;
        flex: 1;
    }
    .toolbar-field {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .toolbar-field label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6c757d;
    }
    .toolbar-field input[type="date"] {
        padding: 8px 12px;
        border: 1.5px solid #dee2e6;
        border-radius: 8px;
        font-size: 13px;
        color: #344767;
        background: #f8fafc;
        outline: none;
        transition: border-color .2s;
        min-width: 140px;
    }
    .toolbar-field input[type="date"]:focus {
        border-color: #4f8ef7;
        background: #fff;
    }

    /* Filter button */
    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        background: #9D3895;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-filter:hover { background: #1e2d45; color: #fff; }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        background: #f1f3f8;
        color: #6c757d;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-reset:hover { background: #e2e6ea; color: #344767; }

    /* Export buttons */
    .export-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .export-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #9aa4b2;
        margin-right: 2px;
    }
    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: opacity .2s, transform .1s;
        white-space: nowrap;
    }
    .btn-export:hover { opacity: .85; transform: translateY(-1px); }
    .btn-export:active { transform: translateY(0); }

    .btn-csv     { background: #28a745; color: #fff; }
    .btn-excel   { background: #392367; color: #fff; }
    .btn-pdf     { background: #dc3545; color: #fff; }
    .btn-print   { background: #6c757d; color: #fff; }
    .btn-copy    { background: #17a2b8; color: #fff; }

    /* Result count */
    .result-meta {
        font-size: 12px;
        color: #9aa4b2;
        margin-bottom: 10px;
        padding: 0 2px;
    }
    .result-meta strong { color: #344767; }

    /* ── Card ── */
    .journey-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,.07);
        border: 1px solid #edf2f7;
        width: 100%;
        box-sizing: border-box;
    }
    .journey-card-body { padding: 20px; }

    /* ── Table wrap ── */
    .journey-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        display: block;
    }

    /* ── Table ── */
    .journey-table {
        width: max-content;
        min-width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .journey-table thead th {
        background: #f5f7fb;
        color: #344767;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 13px 14px;
        border-bottom: 2px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        white-space: nowrap;
        vertical-align: middle;
    }
    .journey-table thead th:last-child { border-right: none; }
    .journey-table tbody td {
        padding: 12px 14px;
        font-size: 13px;
        color: #495057;
        vertical-align: middle;
        border-bottom: 1px solid #edf2f7;
        border-right: 1px solid #edf2f7;
        white-space: nowrap;
        background: #fff;
    }
    .journey-table tbody td:last-child    { border-right: none; }
    .journey-table tbody tr:last-child td { border-bottom: none; }
    .journey-table tbody tr:nth-child(even) td { background: #fafbfd; }
    .journey-table tbody tr:hover td { background: #eef4ff !important; transition: background .15s; }

    /* ── Badges ── */
    .jbadge {
        display: inline-block; padding: 4px 13px; border-radius: 30px;
        font-size: 11.5px; font-weight: 700; min-width: 48px;
        text-align: center; line-height: 1.5;
    }
    .jbadge-yes          { background: #28a745; color: #fff; }
    .jbadge-no           { background: #dc3545; color: #fff; }
    .jbadge-score-good   { background: #d4edda; color: #155724; }
    .jbadge-score-medium { background: #fff3cd; color: #856404; }
    .jbadge-score-low    { background: #f8d7da; color: #721c24; }
    .jbadge-high         { background: #28a745; color: #fff; }
    .jbadge-medium       { background: #ffc107; color: #212529; }
    .jbadge-low          { background: #dc3545; color: #fff; }
    .jbadge-none         { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; background: #f1f3f8; color: #9aa4b2; font-weight: 600; }

    .chip-menu { display:inline-block; background:#e8f0fe; color:#3b5bdb; font-size:11px; font-weight:600; border-radius:4px; padding:2px 7px; margin:2px 2px 2px 0; }
    .chip-bank { display:inline-block; background:#fff3cd; color:#856404; font-size:11px; font-weight:600; border-radius:4px; padding:2px 7px; margin:2px 2px 2px 0; }

    /* ── Empty / Pagination ── */
    .journey-empty td { padding: 60px 0 !important; text-align: center; color: #adb5bd; font-size: 15px; }
    .journey-pagination { margin-top: 16px; display: flex; justify-content: flex-end; }

    /* ── Scrollbar ── */
    .journey-table-wrap::-webkit-scrollbar       { height: 5px; }
    .journey-table-wrap::-webkit-scrollbar-track { background: #f1f3f8; border-radius: 10px; }
    .journey-table-wrap::-webkit-scrollbar-thumb { background: #b8c8e8; border-radius: 10px; }
    .journey-table-wrap::-webkit-scrollbar-thumb:hover { background: #8aaad4; }

    /* ── Print styles ── */
    @media print {
        .journey-toolbar, .journey-pagination { display: none !important; }
        .journey-table-wrap { overflow: visible; border: none; }
        .journey-table { min-width: unset; width: 100%; }
    }
</style>

<div class="content-body">
    <div class="container-fluid">

        {{-- Header (same structure as Bank list page-titles row) --}}
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text journey-header">
                    <h3>User Journey Report</h3>
                    <p>Complete user funnel tracking and engagement analytics</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">User Journey</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                {{-- Toolbar: Date Filter + Export --}}
                <div class="journey-toolbar">

                    {{-- Date Filter Form --}}
                    <form method="GET" action="{{ route('admin.user.journey.report') }}" style="display:contents;">
                        <div class="toolbar-group">
                            <div class="toolbar-field">
                                <label>From Date</label>
                                <input type="date" name="from_date" value="{{ request('from_date') }}">
                            </div>
                            <div class="toolbar-field">
                                <label>To Date</label>
                                <input type="date" name="to_date" value="{{ request('to_date') }}" max="{{ date('Y-m-d') }}">
                            </div>

                            <div class="toolbar-field">
                                <label>Last Active From</label>
                                <input type="date" name="active_from" value="{{ request('active_from') }}">
                            </div>
                            <div class="toolbar-field">
                                <label>Last Active To</label>
                                <input type="date" name="active_to" value="{{ request('active_to') }}" max="{{ date('Y-m-d') }}">
                            </div>
                          <div class="toolbar-field">
                                <label>Search</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Name, phone, PAN..."
                                    style="padding:8px 12px; border:1.5px solid #dee2e6; border-radius:8px;
                                        font-size:13px; color:#344767; background:#f8fafc; outline:none;
                                        min-width:200px;">
                            </div>
                            <button type="submit" class="btn-filter">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                Filter
                            </button>
                            @if(request('from_date') || request('to_date') || request('search') || request('active_from') || request('active_to'))
                            <a href="{{ route('admin.user.journey.report') }}" class="btn-reset">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                Clear
                            </a>
                            @endif
                        </div>
                    </form>

                    {{-- Export Buttons --}}
                   <div class="export-group">

                        <a href="{{ route('admin.reports.user-journey.export') }}?{{ http_build_query(request()->only('from_date', 'to_date', 'search', 'active_from', 'active_to')) }}"
                           class="btn-export btn-excel">

                            <svg width="13" height="13" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">

                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>

                            </svg>

                            Export Excel

                        </a>

                    </div>
                </div>

                {{-- Result count --}}
                <div class="result-meta">
                    Showing <strong>{{ $reports->count() }}</strong> of <strong>{{ $users->total() }}</strong> records
                    @if(request('from_date') || request('to_date'))
                        &nbsp;·&nbsp; Filtered:
                        {{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->format('d M Y') : 'Start' }}
                        &rarr;
                        {{ request('to_date') ? \Carbon\Carbon::parse(request('to_date'))->format('d M Y') : 'Today' }}
                    @endif
                </div>

                {{-- Table Card --}}
                <div class="journey-card">
                    <div class="journey-card-body">

                        <div class="journey-table-wrap">
                            <table class="journey-table" id="journeyTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Verified</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Registered</th>
                                        <th>Last Activity</th>
                                        <th>Pincode</th>
                                        <th>Menus Browsed</th>
                                        <th>Menu Clicks</th>
                                        <th>Loan Form</th>
                                        <th>credit card Leads</th>
                                        <th>ENTRY SOURCE</th>
                                        <th>Profession</th>
                                        <th>Loan Amount</th>
                                        <th>Income</th>
                                        <th>Banks Clicked</th>
                                        <th>Credit Score</th>
                                        <th>PAN</th>
                                        <th>Journey %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reports as $report)
                                    <tr>
                                        <td><strong>#{{ $report->user_id }}</strong></td>
                                        <td>{{ $report->name ?: '-' }}</td>
                                        <td>
                                            @if($report->otp_verified)
                                                <span class="badge" style="background:#dcfce7; color:#16a34a; border:1px solid #bbf7d0; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:600;">
                                                    ✓ Verified
                                                </span>
                                            @else
                                                <span class="badge" style="background:#fff7ed; color:#ea580c; border:1px solid #fed7aa; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:600;">
                                                    ✗ Unverified
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $report->phone ?: '-' }}</td>
                                        <td style="max-width:180px; overflow:hidden; text-overflow:ellipsis;">{{ $report->email ?: '-' }}</td>
                                        <td>{{ $report->registered }}</td>
                                        <td>
                                            @if($report->last_activity_at)
                                                <span style="font-size:12px; color:#344767; font-weight:600;">
                                                    {{ $report->last_activity_at }}
                                                </span>
                                            @else
                                                <span class="jbadge-none">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $report->pincode ?: '-' }}</td>

                                        <td style="min-width:150px; max-width:240px; white-space:normal; word-break:break-word;">
                                            @if($report->menus_browsed)
                                                @foreach(explode(', ', $report->menus_browsed) as $menu)
                                                    <span class="chip-menu">{{ trim($menu) }}</span>
                                                @endforeach
                                            @else
                                                <span class="jbadge-none">None</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->menu_clicks > 0)
                                                <strong style="color:#3b5bdb;">{{ $report->menu_clicks }}</strong>
                                            @else
                                                <span class="jbadge-none">0</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->basic_info == 'Yes')
                                                <span class="jbadge jbadge-yes">Yes</span>
                                            @else
                                                <span class="jbadge jbadge-no">No</span>
                                            @endif
                                        </td>

                                         <td class="text-center">
                                             @if($report->credit_card_lead == 'Yes')
                                                <span class="jbadge jbadge-yes">Yes</span>
                                            @else
                                                <span class="jbadge jbadge-no">No</span>
                                            @endif
                                            </td>

                                        <td>
                                            @if($report->entry_source)
                                                <span class="text-sm">{{ $report->entry_source }}</span>
                                            @else
                                                <span class="jbadge-none">-</span>
                                            @endif
                                        </td>


                                        <td>{{ $report->profession ?: '-' }}</td>

                                        <td>
                                            @if($report->loan_amount)
                                                ₹{{ number_format($report->loan_amount) }}
                                            @else -
                                            @endif
                                        </td>

                                        <td>
                                            @if($report->income)
                                                ₹{{ number_format($report->income) }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td style="min-width:150px; max-width:240px; white-space:normal; word-break:break-word;">
                                            @if($report->banks_clicked)
                                                @foreach(explode(', ', $report->banks_clicked) as $bank)
                                                    <span class="chip-bank">{{ trim($bank) }}</span>
                                                @endforeach
                                            @else
                                                <span class="jbadge-none">None</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->credit_score)
                                                @if($report->credit_score >= 750)
                                                    <span class="jbadge jbadge-score-good">{{ $report->credit_score }}</span>
                                                @elseif($report->credit_score >= 650)
                                                    <span class="jbadge jbadge-score-medium">{{ $report->credit_score }}</span>
                                                @else
                                                    <span class="jbadge jbadge-score-low">{{ $report->credit_score }}</span>
                                                @endif
                                            @else -
                                            @endif
                                        </td>

                                        <td>{{ $report->pan ?: '-' }}</td>

                                        <td class="text-center">
                                            @if($report->journey_percentage >= 80)
                                                <span class="jbadge jbadge-high">{{ $report->journey_percentage }}%</span>
                                            @elseif($report->journey_percentage >= 60)
                                                <span class="jbadge jbadge-medium">{{ $report->journey_percentage }}%</span>
                                            @else
                                                <span class="jbadge jbadge-low">{{ $report->journey_percentage }}%</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="journey-empty">
                                        <td colspan="20">No Records Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="journey-pagination">
                            {{ $users->appends(request()->only('from_date','to_date','search','active_from','active_to'))->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    // ── Print ──
    function printTable() {
        window.print();
    }

    // ── Copy to clipboard (tab-separated, pastes into Excel/Sheets) ──
    function copyTable() {
        const table = document.getElementById('journeyTable');
        let text = '';
        for (const row of table.rows) {
            const cells = [];
            for (const cell of row.cells) {
                cells.push(cell.innerText.trim().replace(/\n+/g, ' '));
            }
            text += cells.join('\t') + '\n';
        }
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('copyBtn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
            btn.style.background = '#28a745';
            setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; }, 2000);
        });
    }
</script>

@endsection