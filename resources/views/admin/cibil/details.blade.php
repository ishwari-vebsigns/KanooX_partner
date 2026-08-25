@extends('layouts.admin-app')

@section('content')

<style>
.cibil-details-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ── Page header ── */
.cibil-details-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.cibil-details-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.cibil-details-page .kx-title-icon {
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

.cibil-details-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.cibil-details-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.cibil-details-page .kx-breadcrumb {
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

.cibil-details-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.cibil-details-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.cibil-details-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ── Card ── */
.cibil-details-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
    margin-bottom: 22px;
}

.cibil-details-page .kx-card-body {
    padding: 24px;
}

.cibil-details-page .kx-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 700;
    color: var(--kx-text);
    margin: 0 0 18px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--kx-border);
}

.cibil-details-page .kx-section-title .kx-section-icon {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex: 0 0 auto;
}

/* ── Field grid ── */
.cibil-details-page .kx-field {
    margin-bottom: 16px;
}

.cibil-details-page .kx-field-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--kx-muted);
    margin: 0 0 5px;
}

.cibil-details-page .kx-field-value {
    font-size: 14px;
    font-weight: 600;
    color: var(--kx-text);
    margin: 0;
}

/* ── Score badge ── */
.cibil-details-page .kx-score-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 56px;
    padding: 6px 16px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 13px;
    color: #fff;
}

.cibil-details-page .kx-score-good { background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark)); }
.cibil-details-page .kx-score-mid  { background: #B98900; }
.cibil-details-page .kx-score-low  { background: #D64545; }
.cibil-details-page .kx-score-na   { background: #9aa4b2; }

/* ── Buttons ── */
.cibil-details-page .kx-btn {
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

.cibil-details-page .kx-btn:hover {
    transform: translateY(-1px);
}

.cibil-details-page .kx-btn-export {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.cibil-details-page .kx-btn-export:hover {
    background: #238B45;
    color: #fff;
}

/* ── Info box (accounts / enquiries) ── */
.cibil-details-page .kx-info-box {
    border: 1px solid var(--kx-border);
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 14px;
    background: var(--kx-page-bg);
}

.cibil-details-page .kx-info-box:last-child {
    margin-bottom: 0;
}

.cibil-details-page .kx-info-box .kx-field {
    margin-bottom: 12px;
}

.cibil-details-page .kx-info-box .kx-field-value {
    font-size: 13.5px;
}

.cibil-details-page .kx-empty-note {
    margin: 0;
    color: var(--kx-muted);
    font-size: 13.5px;
}

/* ── Summary stat cards ── */
.cibil-details-page .kx-stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

@media (max-width: 767px) {
    .cibil-details-page .kx-stat-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.cibil-details-page .kx-stat-card {
    border: 1px solid var(--kx-border);
    border-radius: 12px;
    padding: 16px;
    background: var(--kx-page-bg);
    text-align: center;
}

.cibil-details-page .kx-stat-value {
    font-size: 24px;
    font-weight: 700;
    color: var(--kx-primary-dark);
    margin: 0 0 4px;
}

.cibil-details-page .kx-stat-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--kx-muted);
    margin: 0;
}

/* ── Score details value ── */
.cibil-details-page .kx-score-value {
    font-size: 20px;
    font-weight: 700;
    color: var(--kx-primary-dark);
    margin: 0;
}

@media (max-width: 767px) {
    .cibil-details-page .kx-page-head {
        flex-direction: column;
    }
    .cibil-details-page .kx-card-body {
        padding: 18px;
    }
}
</style>

<div class="content-body cibil-details-page">
<div class="container-fluid">

    <div class="kx-page-head">
        <div class="kx-title-wrap">
            <div class="kx-title-icon"><i class="fa fa-id-card-o"></i></div>
            <div>
                <h4 class="kx-page-title">CIBIL Report Details</h4>
                <p class="kx-page-subtitle">Full credit history and account breakdown</p>
            </div>
        </div>
        <ol class="kx-breadcrumb">
            <li><a href="javascript:void(0)">Reports</a></li>
            <li>/</li>
            <li><a href="{{ route('admin.cibil.reports') }}">CIBIL Reports</a></li>
            <li>/</li>
            <li class="kx-crumb-current"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>

    {{-- BASIC INFO --}}
    <div class="kx-card">
        <div class="kx-card-body">
            <h4 class="kx-section-title">
                <span class="kx-section-icon"><i class="fa fa-user"></i></span>
                Basic Information
            </h4>

            <div class="row">
                <div class="col-md-3 kx-field">
                    <p class="kx-field-label">Name</p>
                    <p class="kx-field-value">{{ $report->name }}</p>
                </div>

                <div class="col-md-3 kx-field">
                    <p class="kx-field-label">National ID</p>
                    <p class="kx-field-value">{{ $report->pan }}</p>
                </div>

                <div class="col-md-3 kx-field">
                    <p class="kx-field-label">Mobile</p>
                    <p class="kx-field-value">{{ $report->mobile }}</p>
                </div>

                <div class="col-md-3 kx-field">
                    <p class="kx-field-label">Score</p>

                    @php
                        $score = $report->credit_score;
                        if(!$score) $class = 'kx-score-na';
                        elseif($score >= 750) $class = 'kx-score-good';
                        elseif($score >= 650) $class = 'kx-score-mid';
                        else $class = 'kx-score-low';
                    @endphp

                    <span class="kx-score-badge {{ $class }}">
                        {{ $score ?? 'N/A' }}
                    </span>
                </div>
            </div>

            @if($report->pdf_link)
                <a href="{{ $report->pdf_link }}" target="_blank" class="kx-btn kx-btn-export">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    View PDF
                </a>
            @endif
        </div>
    </div>

    {{-- SCORE DETAILS --}}
    <div class="kx-card">
        <div class="kx-card-body">
            <h4 class="kx-section-title">
                <span class="kx-section-icon"><i class="fa fa-line-chart"></i></span>
                Score Details
            </h4>

            <p class="kx-score-value">
                {{ $credit['SCORE']['FCIREXScore'] ?? 'N/A' }}
            </p>
        </div>
    </div>

    {{-- ACCOUNTS --}}
    <div class="kx-card">
        <div class="kx-card-body">
            <h4 class="kx-section-title">
                <span class="kx-section-icon"><i class="fa fa-bank"></i></span>
                Account Details
            </h4>

            @forelse($credit['CAIS_Account']['CAIS_Account_DETAILS'] ?? [] as $acc)
                <div class="kx-info-box">
                    <div class="row">

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Bank</p>
                            <p class="kx-field-value">{{ $acc['Subscriber_Name'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Account No</p>
                            <p class="kx-field-value">{{ $acc['Account_Number'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Loan Amount</p>
                            <p class="kx-field-value">₹ {{ $acc['Highest_Credit_or_Original_Loan_Amount'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Current Balance</p>
                            <p class="kx-field-value">₹ {{ $acc['Current_Balance'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Account Status</p>
                            <p class="kx-field-value">{{ $acc['Account_Status'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Open Date</p>
                            <p class="kx-field-value">{{ $acc['Open_Date'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Close Date</p>
                            <p class="kx-field-value">{{ $acc['Date_Closed'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Last Payment</p>
                            <p class="kx-field-value">{{ $acc['Date_of_Last_Payment'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Interest</p>
                            <p class="kx-field-value">{{ $acc['Rate_of_Interest'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Tenure</p>
                            <p class="kx-field-value">{{ $acc['Repayment_Tenure'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-3 kx-field">
                            <p class="kx-field-label">Past Due</p>
                            <p class="kx-field-value">₹ {{ $acc['Amount_Past_Due'] ?? '-' }}</p>
                        </div>

                    </div>
                </div>
            @empty
                <p class="kx-empty-note">No Account Data</p>
            @endforelse
        </div>
    </div>

    {{-- ENQUIRIES --}}
    <div class="kx-card">
        <div class="kx-card-body">
            <h4 class="kx-section-title">
                <span class="kx-section-icon"><i class="fa fa-search"></i></span>
                Loan Enquiries
            </h4>

            @forelse($credit['CAPS']['CAPS_Application_Details'] ?? [] as $cap)
                <div class="kx-info-box">
                    <div class="row">
                        <div class="col-md-4 kx-field">
                            <p class="kx-field-label">Date</p>
                            <p class="kx-field-value">{{ $cap['Date_of_Request'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-4 kx-field">
                            <p class="kx-field-label">Amount</p>
                            <p class="kx-field-value">{{ $cap['Amount_Financed'] ?? '-' }}</p>
                        </div>

                        <div class="col-md-4 kx-field">
                            <p class="kx-field-label">Duration</p>
                            <p class="kx-field-value">{{ $cap['Duration_Of_Agreement'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="kx-empty-note">No Enquiries Found</p>
            @endforelse
        </div>
    </div>

    {{-- SUMMARY --}}
    <div class="kx-card">
        <div class="kx-card-body">
            <h4 class="kx-section-title">
                <span class="kx-section-icon"><i class="fa fa-pie-chart"></i></span>
                Summary
            </h4>

            @php
                $summary = $credit['CAIS_Account']['CAIS_Summary']['Credit_Account'] ?? [];
            @endphp

            <div class="kx-stat-grid">
                <div class="kx-stat-card">
                    <p class="kx-stat-value">{{ $summary['CreditAccountTotal'] ?? 0 }}</p>
                    <p class="kx-stat-label">Total Accounts</p>
                </div>

                <div class="kx-stat-card">
                    <p class="kx-stat-value">{{ $summary['CreditAccountActive'] ?? 0 }}</p>
                    <p class="kx-stat-label">Active</p>
                </div>

                <div class="kx-stat-card">
                    <p class="kx-stat-value">{{ $summary['CreditAccountClosed'] ?? 0 }}</p>
                    <p class="kx-stat-label">Closed</p>
                </div>

                <div class="kx-stat-card">
                    <p class="kx-stat-value">{{ $summary['CreditAccountDefault'] ?? 0 }}</p>
                    <p class="kx-stat-label">Defaults</p>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection