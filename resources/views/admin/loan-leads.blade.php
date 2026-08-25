@extends('layouts.admin-app')

@section('content')
<style>
.loan-leads-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ── Page header ── */
.loan-leads-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.loan-leads-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.loan-leads-page .kx-title-icon {
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

.loan-leads-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.loan-leads-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.loan-leads-page .kx-breadcrumb {
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

.loan-leads-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.loan-leads-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.loan-leads-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ── Card ── */
.loan-leads-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.loan-leads-page .kx-card-body {
    padding: 24px;
}

.loan-leads-page .kx-title-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid var(--kx-border);
}

.loan-leads-page .kx-title-row h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
    color: var(--kx-text);
}

@media (max-width: 575px) {
    .loan-leads-page .kx-title-row {
        flex-direction: column;
        align-items: stretch;
    }
    .loan-leads-page .kx-title-row .kx-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ── Search box ── */
.loan-leads-page .kx-search-wrap {
    position: relative;
    margin-bottom: 18px;
}

.loan-leads-page .kx-search-wrap svg {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--kx-muted);
    pointer-events: none;
}

.loan-leads-page #tableSearch {
    width: 100%;
    height: 44px;
    border: 1px solid var(--kx-border);
    border-radius: 10px;
    padding: 0 16px 0 42px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.loan-leads-page #tableSearch:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.loan-leads-page #tableSearch::placeholder {
    color: #A6A2B3;
}

/* ── Buttons ── */
.loan-leads-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0 18px;
    height: 40px;
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

.loan-leads-page .kx-btn:hover {
    transform: translateY(-1px);
}

.loan-leads-page .kx-btn-export {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.loan-leads-page .kx-btn-export:hover {
    background: #238B45;
    color: #fff;
}

.loan-leads-page .kx-btn-view {
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-color: var(--kx-soft);
    padding: 0 14px;
    height: 34px;
    font-size: 12.5px;
}

.loan-leads-page .kx-btn-view:hover {
    background: var(--kx-primary);
    color: #fff;
}

/* ── Table ── */
.loan-leads-page .kx-table-wrap {
    max-height: 460px;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 12px;
    border: 1px solid var(--kx-border);
}

.loan-leads-page .kx-table {
    width: 100%;
    border-collapse: collapse;
}

.loan-leads-page .kx-table th,
.loan-leads-page .kx-table td {
    white-space: nowrap;
}

.loan-leads-page .kx-table thead th {
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

.loan-leads-page .kx-table tbody td {
    padding: 14px 16px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    border-bottom: 1px solid var(--kx-border);
    vertical-align: middle;
}

.loan-leads-page .kx-table tbody tr:last-child td {
    border-bottom: none;
}

.loan-leads-page .kx-table tbody tr:hover td {
    background: #FCF6FC;
    transition: background .15s;
}

.loan-leads-page .kx-cust-name {
    font-weight: 700;
    color: var(--kx-text);
}

.loan-leads-page .kx-detail-list {
    list-style: none;
    margin: 0;
    padding: 0;
    max-width: 260px;
    white-space: normal;
}

.loan-leads-page .kx-detail-list li {
    font-size: 12.5px;
    color: var(--kx-muted);
    margin-bottom: 3px;
    line-height: 1.4;
}

.loan-leads-page .kx-detail-list li:last-child {
    margin-bottom: 0;
}

.loan-leads-page .kx-detail-list li strong {
    color: var(--kx-text);
    font-weight: 600;
}

.loan-leads-page .kx-muted-dash {
    color: #B8B4C4;
}

/* ── Status select ── */
.loan-leads-page .kx-status-select {
    height: 38px;
    width: 150px;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    padding: 0 30px 0 12px;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%23747080' viewBox='0 0 16 16'%3E%3Cpath d='M8 11 3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.loan-leads-page .kx-status-select:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

/* ── Modal ── */
.loan-leads-page .modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(57, 35, 103, 0.2);
}

.loan-leads-page .modal-header {
    background: var(--kx-page-bg);
    border-bottom: 1px solid var(--kx-border);
    padding: 18px 22px;
}

.loan-leads-page .modal-header .modal-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--kx-text);
}

.loan-leads-page .modal-header .close {
    color: var(--kx-muted);
    opacity: 1;
    text-shadow: none;
}

.loan-leads-page .modal-body {
    padding: 22px;
}

.loan-leads-page .kx-doc-label {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--kx-primary-dark);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

.loan-leads-page .kx-doc-img {
    border: 1px solid var(--kx-border);
    border-radius: 10px;
    max-height: 300px;
}

.loan-leads-page .kx-doc-empty {
    color: var(--kx-muted);
    font-size: 13px;
}

/* ── Pagination ── */
.loan-leads-page .kx-pagination {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

/* ── Scrollbar ── */
.loan-leads-page .kx-table-wrap::-webkit-scrollbar { height: 6px; width: 6px; }
.loan-leads-page .kx-table-wrap::-webkit-scrollbar-track { background: var(--kx-page-bg); border-radius: 10px; }
.loan-leads-page .kx-table-wrap::-webkit-scrollbar-thumb { background: var(--kx-soft); border-radius: 10px; }
.loan-leads-page .kx-table-wrap::-webkit-scrollbar-thumb:hover { background: var(--kx-primary); }

@media (max-width: 767px) {
    .loan-leads-page .kx-page-head {
        flex-direction: column;
    }
    .loan-leads-page .kx-card-body {
        padding: 18px;
    }
}
</style>

<div class="content-body loan-leads-page">
<div class="container-fluid">

    <div class="kx-page-head">
        <div class="kx-title-wrap">
            <div class="kx-title-icon"><i class="fa fa-file-text-o"></i></div>
            <div>
                <h4 class="kx-page-title">Hi, welcome {{ Auth::user()->name }}!</h4>
                @if(Auth::user()->role_id == 2)
                    <p class="kx-page-subtitle">Agent ID: {{ Auth::user()->new_id }}</p>
                @else
                    <p class="kx-page-subtitle">Track and manage incoming loan lead submissions</p>
                @endif
            </div>
        </div>
        <ol class="kx-breadcrumb">
            <li><a href="javascript:void(0)">Reports</a></li>
            <li>/</li>
            <li class="kx-crumb-current"><a href="javascript:void(0)">Loan Lead Report</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="kx-card">
                <div class="kx-card-body">

                    <div class="kx-title-row">
                        <h4>Loan Leads</h4>

                        <a href="{{ route('loan.leads.export') }}" class="kx-btn kx-btn-export">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                            Download Excel
                        </a>
                    </div>

                    <div class="kx-search-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" id="tableSearch" placeholder="Search customer, mobile...">
                    </div>

                    <div class="kx-table-wrap table-responsive">
                        <table class="kx-table mb-0">
                            <thead>
                                <tr>
                                    <th>Sr. no</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Pincode</th>
                                    <th>Loan Type</th>
                                    <th>Loan Details</th>
                                    <th>Documents</th>
                                    <th>Status</th>
                                    <th>User ID</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>{{ $loop->iteration + ($leads->currentPage() - 1) * $leads->perPage() }}</td>

                                        <td><span class="kx-cust-name">{{ $lead->customer_name }}</span></td>

                                        <td>{{ $lead->contact_no }}</td>

                                        <td>{{ $lead->pincode }}</td>

                                        <td>{{ optional($lead->service)->name ?? '-' }}</td>

                                        <td style="max-width:260px; white-space:normal;">
                                            @if(!empty($lead->dynamic_fields) && is_array($lead->dynamic_fields))
                                                <ul class="kx-detail-list">
                                                    @foreach(collect($lead->dynamic_fields)->except(['loan_amount_min', 'income_min']) as $key => $value)
                                                        <li>
                                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                                            {{ $value ?? '-' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{-- fallback for old records --}}
                                                @php
                                                    $fallback = [];
                                                    if ($lead->company_name)
                                                        $fallback['Company'] = $lead->company_name;
                                                    if ($lead->salary)
                                                        $fallback['Salary'] = number_format($lead->salary, 2);
                                                    if ($lead->loan_amount)
                                                        $fallback['Loan Amount'] = number_format($lead->loan_amount, 2);
                                                @endphp

                                                @if(count($fallback))
                                                    <ul class="kx-detail-list">
                                                        @foreach($fallback as $k => $v)
                                                            <li><strong>{{ $k }}:</strong> {{ $v }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="kx-muted-dash">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($lead->document_front_image || $lead->document_back_image)
                                                <button type="button" class="kx-btn kx-btn-view" data-toggle="modal"
                                                    data-target="#docModal{{ $lead->id }}">
                                                    View Docs
                                                </button>
                                                <div class="modal fade loan-leads-page" id="docModal{{ $lead->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Documents —
                                                                    {{ $lead->customer_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6 text-center mb-3">
                                                                        <p class="kx-doc-label">Front</p>
                                                                        @if($lead->document_front_image)
                                                                            <a href="{{ $lead->document_front_image }}"
                                                                                target="_blank">
                                                                                <img src="{{ $lead->document_front_image }}"
                                                                                    class="img-fluid kx-doc-img">
                                                                            </a>
                                                                        @else
                                                                            <p class="kx-doc-empty">Not uploaded</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6 text-center mb-3">
                                                                        <p class="kx-doc-label">Back</p>
                                                                        @if($lead->document_back_image)
                                                                            <a href="{{ $lead->document_back_image }}"
                                                                                target="_blank">
                                                                                <img src="{{ $lead->document_back_image }}"
                                                                                    class="img-fluid kx-doc-img">
                                                                            </a>
                                                                        @else
                                                                            <p class="kx-doc-empty">Not uploaded</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="kx-muted-dash">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('loan.leads.updateStatus', $lead->id) }}"
                                                method="POST" class="d-flex align-items-center gap-1">
                                                @csrf
                                                <select name="status" class="kx-status-select status-select"
                                                    onchange="this.form.submit()">
                                                    <option value="pending" {{ $lead->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="under_review" {{ $lead->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                                    <option value="completed" {{ $lead->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $lead->user_id ?? '-' }}</td>

                                        <td>{{ $lead->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="kx-pagination">
                        {{ $leads->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>
    document.getElementById('tableSearch').addEventListener('keyup', function () {

        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('.loan-leads-page tbody tr');

        rows.forEach(function (row) {

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