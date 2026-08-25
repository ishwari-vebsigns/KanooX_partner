@extends('layouts.admin-app')

@section('content')
<style>
.cibil-reports-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ── Page header ── */
.cibil-reports-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.cibil-reports-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.cibil-reports-page .kx-title-icon {
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

.cibil-reports-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.cibil-reports-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.cibil-reports-page .kx-breadcrumb {
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

.cibil-reports-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.cibil-reports-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.cibil-reports-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ── Toolbar (filter) ── */
.cibil-reports-page .kx-toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 12px;
    margin-bottom: 22px;
    background: #fff;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    border: 1px solid var(--kx-border);
}

.cibil-reports-page .kx-toolbar-group {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 12px;
    flex: 1;
}

.cibil-reports-page .kx-toolbar-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cibil-reports-page .kx-toolbar-field label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--kx-muted);
}

.cibil-reports-page .kx-toolbar-field input[type="date"],
.cibil-reports-page .kx-toolbar-field input[type="text"] {
    height: 42px;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    padding: 0 14px;
    font-size: 13px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    min-width: 150px;
}

.cibil-reports-page .kx-toolbar-field input[type="text"] {
    min-width: 220px;
}

.cibil-reports-page .kx-toolbar-field input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.cibil-reports-page .kx-toolbar-field input::placeholder {
    color: #A6A2B3;
}

/* ── Buttons ── */
.cibil-reports-page .kx-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
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

.cibil-reports-page .kx-btn:hover {
    transform: translateY(-1px);
}

.cibil-reports-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.cibil-reports-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.cibil-reports-page .kx-btn-secondary {
    background: #fff;
    color: var(--kx-muted);
    border-color: var(--kx-border);
}

.cibil-reports-page .kx-btn-secondary:hover {
    background: var(--kx-page-bg);
    color: var(--kx-text);
}

.cibil-reports-page .kx-btn-export {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.cibil-reports-page .kx-btn-export:hover {
    background: #238B45;
    color: #fff;
}

.cibil-reports-page .kx-btn-details {
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-color: var(--kx-soft);
    padding: 0 14px;
    height: 34px;
    font-size: 12.5px;
}

.cibil-reports-page .kx-btn-details:hover {
    background: var(--kx-primary);
    color: #fff;
}

.cibil-reports-page .kx-btn-pdf {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
    padding: 0 14px;
    height: 34px;
    font-size: 12.5px;
}

.cibil-reports-page .kx-btn-pdf:hover {
    background: #238B45;
    color: #fff;
}

.cibil-reports-page .kx-actions-group {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* ── Card ── */
.cibil-reports-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.cibil-reports-page .kx-card-body {
    padding: 24px;
}

.cibil-reports-page .kx-title-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid var(--kx-border);
}

.cibil-reports-page .kx-title-row h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
    color: var(--kx-text);
}

@media (max-width: 575px) {
    .cibil-reports-page .kx-title-row {
        flex-direction: column;
        align-items: stretch;
    }
    .cibil-reports-page .kx-title-row .kx-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ── Table ── */
.cibil-reports-page .kx-table-wrap {
    max-height: 460px;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 12px;
    border: 1px solid var(--kx-border);
}

.cibil-reports-page .kx-table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}

.cibil-reports-page .kx-table th,
.cibil-reports-page .kx-table td {
    white-space: nowrap;
    vertical-align: middle;
}

.cibil-reports-page .kx-table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 13px 16px;
    border-bottom: 1px solid var(--kx-border);
}

.cibil-reports-page .kx-table tbody td {
    padding: 14px 16px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    border-bottom: 1px solid var(--kx-border);
}

.cibil-reports-page .kx-table tbody tr:last-child td {
    border-bottom: none;
}

.cibil-reports-page .kx-table tbody tr:hover td {
    background: #FCF6FC;
    transition: background .15s;
}

.cibil-reports-page .kx-cust-name {
    font-weight: 700;
    color: var(--kx-text);
}

.cibil-reports-page .kx-empty td {
    padding: 60px 0 !important;
    text-align: center;
    color: var(--kx-muted);
    font-size: 15px;
    background: #fff !important;
}

/* ── Score badge ── */
.cibil-reports-page .kx-score-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 52px;
    padding: 6px 14px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 12.5px;
    color: #fff;
}

.cibil-reports-page .kx-score-good { background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark)); }
.cibil-reports-page .kx-score-mid  { background: #B98900; }
.cibil-reports-page .kx-score-low  { background: #D64545; }
.cibil-reports-page .kx-score-na   { background: #9aa4b2; }

/* ── Pagination ── */
.cibil-reports-page .kx-pagination {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

/* ── Scrollbar ── */
.cibil-reports-page .kx-table-wrap::-webkit-scrollbar { height: 6px; width: 6px; }
.cibil-reports-page .kx-table-wrap::-webkit-scrollbar-track { background: var(--kx-page-bg); border-radius: 10px; }
.cibil-reports-page .kx-table-wrap::-webkit-scrollbar-thumb { background: var(--kx-soft); border-radius: 10px; }
.cibil-reports-page .kx-table-wrap::-webkit-scrollbar-thumb:hover { background: var(--kx-primary); }

@media (max-width: 767px) {
    .cibil-reports-page .kx-page-head {
        flex-direction: column;
    }
    .cibil-reports-page .kx-card-body {
        padding: 18px;
    }
    .cibil-reports-page .kx-toolbar {
        padding: 16px;
    }
}
</style>

<div class="content-body cibil-reports-page">
<div class="container-fluid">

    <div class="kx-page-head">
        <div class="kx-title-wrap">
            <div class="kx-title-icon"><i class="fa fa-line-chart"></i></div>
            <div>
                <h4 class="kx-page-title">Hi, welcome {{ Auth::user()->name }}!</h4>
                <p class="kx-page-subtitle">View and manage all CIBIL credit score reports</p>
            </div>
        </div>
        <ol class="kx-breadcrumb">
            <li><a href="javascript:void(0)">Reports</a></li>
            <li>/</li>
            <li class="kx-crumb-current"><a href="javascript:void(0)">CIBIL Reports</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">

            {{-- Filter Toolbar --}}
            <div class="kx-toolbar">
                <form method="GET" action="{{ route('admin.cibil.reports') }}" style="display:contents;">
                    <div class="kx-toolbar-group">
                        <div class="kx-toolbar-field">
                            <label>From Date</label>
                            <input type="date" name="from_date" value="{{ request('from_date') }}">
                        </div>
                        <div class="kx-toolbar-field">
                            <label>To Date</label>
                            <input type="date" name="to_date" value="{{ request('to_date') }}">
                        </div>
                        <div class="kx-toolbar-field">
                            <label>Search</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Name, Mobile, PAN, Score...">
                        </div>
                        <button type="submit" class="kx-btn kx-btn-primary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.cibil.reports') }}" class="kx-btn kx-btn-secondary">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            {{-- Table Card --}}
            <div class="kx-card">
                <div class="kx-card-body">

                    <div class="kx-title-row">
                        <h4>CIBIL Reports</h4>

                        <a href="{{ route('admin.cibil.export', request()->all()) }}" class="kx-btn kx-btn-export">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                            Export Excel
                        </a>
                    </div>

                    <div class="kx-table-wrap table-responsive">
                        <table class="kx-table mb-0">
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
                                        <td><span class="kx-cust-name">{{ $r->name }}</span></td>
                                        <td>{{ $r->pan }}</td>
                                        <td>{{ $r->mobile }}</td>

                                        {{-- SCORE --}}
                                        <td>
                                            @php
                                                $score = $r->credit_score;

                                                if (!$score)
                                                    $class = 'kx-score-na';
                                                elseif ($score >= 750)
                                                    $class = 'kx-score-good';
                                                elseif ($score >= 650)
                                                    $class = 'kx-score-mid';
                                                else
                                                    $class = 'kx-score-low';
                                            @endphp

                                            <span class="kx-score-badge {{ $class }}">
                                                {{ $score ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y, h:i A') }}
                                        </td>

                                        {{-- ACTION --}}
                                        <td class="text-center">
                                            <div class="kx-actions-group">
                                                <a href="{{ route('admin.cibil.details', $r->id) }}" class="kx-btn kx-btn-details">
                                                    Details
                                                </a>

                                                @if($r->pdf_link)
                                                    <a href="{{ $r->pdf_link }}" target="_blank" class="kx-btn kx-btn-pdf">
                                                        PDF
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="kx-empty">
                                        <td colspan="7">No CIBIL Reports Found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    <div class="kx-pagination">
                        {{ $reports->appends(request()->only('search'))->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
</div>

@endsection