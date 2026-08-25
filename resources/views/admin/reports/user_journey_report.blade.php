@extends('layouts.admin-app')

@section('content')

<style>
.journey-report-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ── Page header ── */
.journey-report-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.journey-report-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.journey-report-page .kx-title-icon {
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

.journey-report-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.journey-report-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.journey-report-page .kx-breadcrumb {
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

.journey-report-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.journey-report-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.journey-report-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ── Toolbar (filter + export) ── */
.journey-report-page .kx-toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 12px;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    border: 1px solid var(--kx-border);
}

.journey-report-page .kx-toolbar-group {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 12px;
    flex: 1;
}

.journey-report-page .kx-toolbar-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.journey-report-page .kx-toolbar-field label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--kx-muted);
}

.journey-report-page .kx-toolbar-field input[type="date"],
.journey-report-page .kx-toolbar-field input[type="text"] {
    padding: 0 14px;
    height: 42px;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    font-size: 13px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    min-width: 150px;
}

.journey-report-page .kx-toolbar-field input[type="text"] {
    min-width: 200px;
}

.journey-report-page .kx-toolbar-field input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
    background: #fff;
}

/* ── Buttons ── */
.journey-report-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 0 18px;
    height: 42px;
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

.journey-report-page .kx-btn:hover {
    transform: translateY(-1px);
}

.journey-report-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.journey-report-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.journey-report-page .kx-btn-secondary {
    background: #fff;
    color: var(--kx-muted);
    border-color: var(--kx-border);
}

.journey-report-page .kx-btn-secondary:hover {
    background: var(--kx-page-bg);
    color: var(--kx-text);
}

.journey-report-page .kx-btn-export {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
    padding: 0 16px;
    height: 40px;
    font-size: 12.5px;
}

.journey-report-page .kx-btn-export:hover {
    background: #238B45;
    color: #fff;
}

.journey-report-page .kx-export-group {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.journey-report-page .kx-export-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--kx-muted);
    margin-right: 2px;
}

/* ── Result meta ── */
.journey-report-page .kx-result-meta {
    font-size: 12.5px;
    color: var(--kx-muted);
    margin-bottom: 12px;
    padding: 0 4px;
}

.journey-report-page .kx-result-meta strong {
    color: var(--kx-text);
}

/* ── Card ── */
.journey-report-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.journey-report-page .kx-card-body {
    padding: 22px;
}

/* ── Table wrap ── */
.journey-report-page .kx-table-wrap {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 12px;
    border: 1px solid var(--kx-border);
    display: block;
}

/* ── Table ── */
.journey-report-page .kx-table {
    width: max-content;
    min-width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.journey-report-page .kx-table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 13px 16px;
    border-bottom: 1px solid var(--kx-border);
    white-space: nowrap;
    vertical-align: middle;
}

.journey-report-page .kx-table tbody td {
    padding: 13px 16px;
    font-size: 13px;
    color: var(--kx-text);
    vertical-align: middle;
    border-bottom: 1px solid var(--kx-border);
    white-space: nowrap;
    background: #fff;
}

.journey-report-page .kx-table tbody tr:last-child td {
    border-bottom: none;
}

.journey-report-page .kx-table tbody tr:hover td {
    background: #FCF6FC;
    transition: background .15s;
}

/* ── Badges ── */
.journey-report-page .kx-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 13px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    border: none;
    min-width: 48px;
    justify-content: center;
    text-align: center;
    line-height: 1.5;
}

.journey-report-page .kx-badge .kx-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.journey-report-page .kx-badge-active,
.journey-report-page .kx-badge-yes {
    background: #EAF8EF;
    color: #238B45;
}
.journey-report-page .kx-badge-active .kx-dot,
.journey-report-page .kx-badge-yes .kx-dot { background: #238B45; }

.journey-report-page .kx-badge-inactive,
.journey-report-page .kx-badge-no {
    background: #FDECEC;
    color: #D64545;
}
.journey-report-page .kx-badge-inactive .kx-dot,
.journey-report-page .kx-badge-no .kx-dot { background: #D64545; }

.journey-report-page .kx-badge-score-good,
.journey-report-page .kx-badge-high {
    background: #EAF8EF;
    color: #238B45;
}

.journey-report-page .kx-badge-score-medium,
.journey-report-page .kx-badge-medium {
    background: #FFF6E0;
    color: #B98900;
}

.journey-report-page .kx-badge-score-low,
.journey-report-page .kx-badge-low {
    background: #FDECEC;
    color: #D64545;
}

.journey-report-page .kx-badge-none {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11px;
    background: var(--kx-page-bg);
    color: var(--kx-muted);
    font-weight: 600;
}

.journey-report-page .kx-chip-menu {
    display: inline-block;
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    font-size: 11px;
    font-weight: 600;
    border-radius: 6px;
    padding: 3px 9px;
    margin: 2px 3px 2px 0;
}

.journey-report-page .kx-chip-bank {
    display: inline-block;
    background: #FFF6E0;
    color: #B98900;
    font-size: 11px;
    font-weight: 600;
    border-radius: 6px;
    padding: 3px 9px;
    margin: 2px 3px 2px 0;
}

/* ── Empty / Pagination ── */
.journey-report-page .kx-empty td {
    padding: 60px 0 !important;
    text-align: center;
    color: var(--kx-muted);
    font-size: 15px;
    background: #fff !important;
}

.journey-report-page .kx-pagination {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

/* ── Scrollbar ── */
.journey-report-page .kx-table-wrap::-webkit-scrollbar { height: 6px; }
.journey-report-page .kx-table-wrap::-webkit-scrollbar-track { background: var(--kx-page-bg); border-radius: 10px; }
.journey-report-page .kx-table-wrap::-webkit-scrollbar-thumb { background: var(--kx-soft); border-radius: 10px; }
.journey-report-page .kx-table-wrap::-webkit-scrollbar-thumb:hover { background: var(--kx-primary); }

@media (max-width: 767px) {
    .journey-report-page .kx-page-head {
        flex-direction: column;
    }
    .journey-report-page .kx-card-body {
        padding: 16px;
    }
    .journey-report-page .kx-toolbar {
        padding: 16px;
    }
}

/* ── Print styles ── */
@media print {
    .journey-report-page .kx-toolbar,
    .journey-report-page .kx-pagination { display: none !important; }
    .journey-report-page .kx-table-wrap { overflow: visible; border: none; }
    .journey-report-page .kx-table { min-width: unset; width: 100%; }
}
</style>

<div class="content-body journey-report-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-route"></i></div>
                <div>
                    <h4 class="kx-page-title">User Journey Report</h4>
                    <p class="kx-page-subtitle">Complete user funnel tracking and engagement analytics</p>
                </div>
            </div>
            <ol class="kx-breadcrumb">
                <li><a href="javascript:void(0)">Reports</a></li>
                <li>/</li>
                <li class="kx-crumb-current"><a href="javascript:void(0)">User Journey</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">

                {{-- Toolbar: Date Filter + Export --}}
                <div class="kx-toolbar">

                    {{-- Date Filter Form --}}
                    <form method="GET" action="{{ route('admin.user.journey.report') }}" style="display:contents;">
                        <div class="kx-toolbar-group">
                            <div class="kx-toolbar-field">
                                <label>From Date</label>
                                <input type="date" name="from_date" value="{{ request('from_date') }}">
                            </div>
                            <div class="kx-toolbar-field">
                                <label>To Date</label>
                                <input type="date" name="to_date" value="{{ request('to_date') }}" max="{{ date('Y-m-d') }}">
                            </div>

                            <div class="kx-toolbar-field">
                                <label>Last Active From</label>
                                <input type="date" name="active_from" value="{{ request('active_from') }}">
                            </div>
                            <div class="kx-toolbar-field">
                                <label>Last Active To</label>
                                <input type="date" name="active_to" value="{{ request('active_to') }}" max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="kx-toolbar-field">
                                <label>Search</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Name, phone, PAN...">
                            </div>
                            <button type="submit" class="kx-btn kx-btn-primary">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                Filter
                            </button>
                            @if(request('from_date') || request('to_date') || request('search') || request('active_from') || request('active_to'))
                            <a href="{{ route('admin.user.journey.report') }}" class="kx-btn kx-btn-secondary">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                Clear
                            </a>
                            @endif
                        </div>
                    </form>

                    {{-- Export Buttons --}}
                    <div class="kx-export-group">
                        <a href="{{ route('admin.reports.user-journey.export') }}?{{ http_build_query(request()->only('from_date', 'to_date', 'search', 'active_from', 'active_to')) }}"
                           class="kx-btn kx-btn-export">

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
                <div class="kx-result-meta">
                    Showing <strong>{{ $reports->count() }}</strong> of <strong>{{ $users->total() }}</strong> records
                    @if(request('from_date') || request('to_date'))
                        &nbsp;·&nbsp; Filtered:
                        {{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->format('d M Y') : 'Start' }}
                        &rarr;
                        {{ request('to_date') ? \Carbon\Carbon::parse(request('to_date'))->format('d M Y') : 'Today' }}
                    @endif
                </div>

                {{-- Table Card --}}
                <div class="kx-card">
                    <div class="kx-card-body">

                        <div class="kx-table-wrap">
                            <table class="kx-table" id="journeyTable">
                                <thead>
                                    <tr>
                                        <th>Sr. NO</th>
                                        <th>Name</th>
                                        <th>Verified</th>
                                        <th>Phone</th>
                                        <!-- <th>Email</th> -->
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
                                                <span class="kx-badge kx-badge-active"><span class="kx-dot"></span>Verified</span>
                                            @else
                                                <span class="kx-badge kx-badge-inactive"><span class="kx-dot"></span>Unverified</span>
                                            @endif
                                        </td>
                                        <td>{{ $report->phone ?: '-' }}</td>
                                        <!-- <td style="max-width:180px; overflow:hidden; text-overflow:ellipsis;">{{ $report->email ?: '-' }}</td> -->
                                        <td>{{ $report->registered }}</td>
                                        <td>
                                            @if($report->last_activity_at)
                                                <span style="font-size:12px; color:var(--kx-text); font-weight:600;">
                                                    {{ $report->last_activity_at }}
                                                </span>
                                            @else
                                                <span class="kx-badge-none">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $report->pincode ?: '-' }}</td>

                                        <td style="min-width:150px; max-width:240px; white-space:normal; word-break:break-word;">
                                            @if($report->menus_browsed)
                                                @foreach(explode(', ', $report->menus_browsed) as $menu)
                                                    <span class="kx-chip-menu">{{ trim($menu) }}</span>
                                                @endforeach
                                            @else
                                                <span class="kx-badge-none">None</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->menu_clicks > 0)
                                                <strong style="color:var(--kx-primary-dark);">{{ $report->menu_clicks }}</strong>
                                            @else
                                                <span class="kx-badge-none">0</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->basic_info == 'Yes')
                                                <span class="kx-badge kx-badge-yes"><span class="kx-dot"></span>Yes</span>
                                            @else
                                                <span class="kx-badge kx-badge-no"><span class="kx-dot"></span>No</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->credit_card_lead == 'Yes')
                                                <span class="kx-badge kx-badge-yes"><span class="kx-dot"></span>Yes</span>
                                            @else
                                                <span class="kx-badge kx-badge-no"><span class="kx-dot"></span>No</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($report->entry_source)
                                                <span class="text-sm">{{ $report->entry_source }}</span>
                                            @else
                                                <span class="kx-badge-none">-</span>
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
                                                    <span class="kx-chip-bank">{{ trim($bank) }}</span>
                                                @endforeach
                                            @else
                                                <span class="kx-badge-none">None</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($report->credit_score)
                                                @if($report->credit_score >= 750)
                                                    <span class="kx-badge kx-badge-score-good">{{ $report->credit_score }}</span>
                                                @elseif($report->credit_score >= 650)
                                                    <span class="kx-badge kx-badge-score-medium">{{ $report->credit_score }}</span>
                                                @else
                                                    <span class="kx-badge kx-badge-score-low">{{ $report->credit_score }}</span>
                                                @endif
                                            @else -
                                            @endif
                                        </td>

                                        <td>{{ $report->pan ?: '-' }}</td>

                                        <td class="text-center">
                                            @if($report->journey_percentage >= 80)
                                                <span class="kx-badge kx-badge-high">{{ $report->journey_percentage }}%</span>
                                            @elseif($report->journey_percentage >= 60)
                                                <span class="kx-badge kx-badge-medium">{{ $report->journey_percentage }}%</span>
                                            @else
                                                <span class="kx-badge kx-badge-low">{{ $report->journey_percentage }}%</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="kx-empty">
                                        <td colspan="20">No Records Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="kx-pagination">
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
            if (!btn) return;
            const orig = btn.innerHTML;
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
            btn.style.background = '#28a745';
            setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; }, 2000);
        });
    }
</script>

@endsection