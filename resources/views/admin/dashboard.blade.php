@extends('layouts.admin-app')
@section('content')
<style>
.dashboard-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.dashboard-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 24px;
}

.dashboard-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.dashboard-page .kx-title-icon {
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

.dashboard-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.dashboard-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.dashboard-page .kx-breadcrumb {
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

.dashboard-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.dashboard-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.dashboard-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- Stat cards ---------- */
.dashboard-page .kx-stat-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    padding: 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard-page .kx-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 34px rgba(57, 35, 103, 0.14);
}

.dashboard-page .kx-stat-icon {
    flex: 0 0 auto;
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    color: #fff;
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    box-shadow: 0 8px 18px rgba(157, 56, 149, 0.28);
}

.dashboard-page .kx-stat-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    min-width: 0;
}

.dashboard-page .kx-stat-text {
    font-size: 13px;
    font-weight: 600;
    color: var(--kx-muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dashboard-page .kx-stat-digit {
    font-size: 26px;
    font-weight: 800;
    color: var(--kx-text);
    line-height: 1.1;
}

.dashboard-page .row.kx-stats-row {
    row-gap: 20px;
}

/* ---------- Generic chart cards ---------- */
.dashboard-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
    height: 100%;
}

.dashboard-page .kx-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid var(--kx-border);
}

.dashboard-page .kx-card-header-icon {
    flex: 0 0 auto;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.dashboard-page .kx-card-header h4 {
    margin: 0;
    font-size: 15.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.dashboard-page .kx-card-body {
    padding: 24px;
}

/* ---------- Premium chart cards (KanooX) ---------- */
.dashboard-page .kx-chart-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard-page .kx-chart-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 34px rgba(57, 35, 103, 0.14);
}

.dashboard-page .kx-chart-card-body {
    padding: 24px 26px;
}

.dashboard-page .kx-chart-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.dashboard-page .kx-chart-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.dashboard-page .kx-chart-header-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: var(--kx-soft);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.dashboard-page .kx-chart-title {
    margin: 0;
    font-size: 15.5px;
    font-weight: 700;
    color: var(--kx-text);
    line-height: 1.3;
}

.dashboard-page .kx-chart-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

/* ---------- Compact premium select ---------- */
.dashboard-page .kx-status-filter {
    width: auto;
    height: auto;
    font-size: 12.5px;
    padding: 6px 30px 6px 12px;
    background-color: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    color: var(--kx-text);
    box-shadow: none;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

.dashboard-page .kx-status-filter:focus {
    border-color: var(--kx-primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}



/* ---------- Leads by Category - donut style ---------- */
.dashboard-page .kx-leads-donut-wrap {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.dashboard-page .kx-leads-donut-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    pointer-events: none;
}

.dashboard-page .kx-leads-donut-total {
    font-size: 30px;
    font-weight: 800;
    color: var(--kx-text);
    line-height: 1;
}

.dashboard-page .kx-leads-donut-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--kx-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 4px;
}

.dashboard-page .kx-leads-legend {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.dashboard-page .kx-leads-legend-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 16px;
    border-radius: 12px;
    background: var(--kx-page-bg);
    border: 1px solid var(--kx-border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard-page .kx-leads-legend-item:hover {
    transform: translateX(3px);
    box-shadow: 0 6px 16px rgba(57, 35, 103, 0.08);
}

.dashboard-page .kx-leads-legend-dot {
    flex: 0 0 auto;
    width: 12px;
    height: 12px;
    border-radius: 4px;
}

.dashboard-page .kx-leads-legend-info {
    flex: 1;
    min-width: 0;
}

.dashboard-page .kx-leads-legend-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--kx-text);
}

.dashboard-page .kx-leads-legend-track {
    height: 5px;
    border-radius: 4px;
    background: #fff;
    margin-top: 7px;
    overflow: hidden;
}

.dashboard-page .kx-leads-legend-fill {
    height: 100%;
    border-radius: 4px;
}

.dashboard-page .kx-leads-legend-count {
    font-size: 18px;
    font-weight: 800;
    color: var(--kx-text);
    min-width: 34px;
    text-align: right;
}


/* ---------- Leads by category rows ---------- */
.dashboard-page .kx-cat-row {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.dashboard-page .kx-cat-row-top {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-size: 13px;
}

.dashboard-page .kx-cat-label {
    color: var(--kx-muted);
    font-weight: 500;
}

.dashboard-page .kx-cat-count {
    font-weight: 700;
    color: var(--kx-text);
}

.dashboard-page .kx-cat-percent {
    color: var(--kx-muted);
    font-weight: 500;
}

.dashboard-page .kx-progress-track {
    height: 6px;
    border-radius: 6px;
    background: var(--kx-page-bg);
    overflow: hidden;
}

.dashboard-page .kx-progress-fill {
    height: 100%;
    border-radius: 6px;
}

/* ---------- Conversion rate strip ---------- */
.dashboard-page .kx-conversion-strip {
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid var(--kx-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.dashboard-page .kx-conversion-label {
    font-size: 13px;
    color: var(--kx-muted);
    font-weight: 600;
    margin-bottom: 2px;
}

.dashboard-page .kx-conversion-sub {
    font-size: 11.5px;
    color: var(--kx-muted);
    opacity: 0.85;
}

.dashboard-page .kx-conversion-rate {
    font-size: 28px;
    font-weight: 800;
    color: #16b364;
}

@media (max-width: 767px) {
    .dashboard-page .kx-page-head {
        flex-direction: column;
    }
    .dashboard-page .kx-stat-card {
        padding: 18px;
    }
    .dashboard-page .kx-card-body {
        padding: 18px;
    }
    .dashboard-page .kx-chart-card-body {
        padding: 18px;
    }
    .dashboard-page .kx-chart-header {
        align-items: flex-start;
    }
}
</style>
    <div class="content-body dashboard-page">
        <div class="container-fluid">

            <div class="kx-page-head">
                <div class="kx-title-wrap">
                    <div class="kx-title-icon"><i class="fa-solid fa-chart-pie"></i></div>
                    <div>
                        <h4 class="kx-page-title">Hi, welcome {{ Auth::user()->name }}!</h4>
                        <p class="kx-page-subtitle">
                            Here's an overview of your platform activity
                            @if (Auth::user()->role_id == 2)
                                &nbsp;&middot;&nbsp;Agent ID: {{ Auth::user()->new_id }}
                            @endif
                        </p>
                    </div>
                </div>
                <ol class="kx-breadcrumb">
                    @if (Auth::user()->role_id == 1)
                        <li><a href="javascript:void(0)">Admin</a></li>
                    @else
                        <li><a href="javascript:void(0)">Agent</a></li>
                    @endif
                    <li>/</li>
                    <li class="kx-crumb-current"><a href="javascript:void(0)">Dashboard</a></li>
                </ol>
            </div>

            <div class="row kx-stats-row">
                <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">

                        @if(Auth::user()->role_id == 1)
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-users-viewfinder"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text"> Users</div>
                            <div class="kx-stat-digit">{{ $user_count }}</div>
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 2 || Auth::user()->role_id==3)
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Total Login Loans</div>
                            <div class="kx-stat-digit">{{ $loan_registered_count }}</div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                        @if(Auth::user()->role_id == 1)
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Total Disburse Loans</div>
                            <div class="kx-stat-digit">{{ $loan_disbursed_count }}</div>
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 2 || Auth::user()->role_id==3)
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Total Disburse Loans</div>
                            <div class="kx-stat-digit">{{ $loan_disbursed_count }}</div>
                        </div>
                        @endif
                    </div>
                </div> -->

                @if(Auth::user()->role_id == 1)
                <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Loan Leads</div>
                            <div class="kx-stat-digit">{{ $loan_leads_count ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-cogs"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">No Of Services</div>
                            <div class="kx-stat-digit">{{ $total_services ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">No Of Sub-Services</div>
                            <div class="kx-stat-digit">{{ $total_sub_services ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Contact Us Submissions</div>
                            <div class="kx-stat-digit">{{ $contact_us_count ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                     <a href="https://partner.kanoox.vebsigns.com/admin/bank/all" style="text-decoration:none; color:inherit; display:block;">
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Total Banks</div>
                            <div class="kx-stat-digit">{{ $total_banks ?? 0 }}</div>
                        </div>
                    </div>
                     </a>
                </div>
                @endif
            </div>

            <div class="row mt-4"  >
                <!-- NAYA COLUMN — Loan Status Overview -->
                <div class="col-lg-4">
                    <div class="kx-chart-card">
                        <div class="kx-chart-card-body">
                            <div class="kx-chart-header">
                                <div class="kx-chart-header-left">
                                    <div class="kx-chart-header-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                    <div>
                                        <h4 class="kx-chart-title">Loan Status Overview</h4>
                                        <p class="kx-chart-subtitle">Track loan applications by their current status</p>
                                    </div>
                                </div>
                                <select id="statusFilter" class="form-control kx-status-filter">
                                    <option value="today">Today</option>
                                    <option value="week" selected>This Week</option>
                                    <option value="month">This Month</option>
                                    <!-- <option value="custom">Custom Range</option> -->
                                </select>
                                <!-- <input type="date" id="customStartDate" style="display:none; font-size:12px;">
                                <input type="date" id="customEndDate" style="display:none; font-size:12px;"> -->
                            </div>
                            <div style="position:relative; height:280px;">
                                <canvas id="statusBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="kx-chart-card">
                        <div class="kx-chart-card-body">
                            <div class="kx-chart-header">
                                <div class="kx-chart-header-left">
                                    <div class="kx-chart-header-icon"><i class="fa-solid fa-chart-pie"></i></div>
                                    <div>
                                        <h4 class="kx-chart-title">Leads by Category</h4>
                                        <p class="kx-chart-subtitle">See how your incoming leads are distributed</p>
                                    </div>
                                </div>
                            </div>
                            <div style="display:grid; grid-template-columns:220px 1fr; gap:32px; align-items:center;">
    <div class="kx-leads-donut-wrap">
        <canvas id="leadsDonut" width="200" height="200"></canvas>
        <div class="kx-leads-donut-center">
            <div class="kx-leads-donut-total" id="kxLeadsDonutTotal">0</div>
            <div class="kx-leads-donut-label">Total Leads</div>
        </div>
    </div>

    <div class="kx-leads-legend">
        @foreach($lead_categories ?? [] as $cat)
        <div class="kx-leads-legend-item">
            <span class="kx-leads-legend-dot" style="background:{{ $cat['color'] }};"></span>
            <div class="kx-leads-legend-info">
                <div class="kx-leads-legend-name">{{ $cat['label'] }}</div>
                <div class="kx-leads-legend-track">
                    <div class="kx-leads-legend-fill" style="width:{{ $cat['percent'] }}%; background:{{ $cat['color'] }};"></div>
                </div>
            </div>
            <div class="kx-leads-legend-count">{{ $cat['count'] }}</div>
        </div>
        @endforeach
    </div>
</div>
                            <!-- NAYA — Conversion Rate strip -->
                            <div class="kx-conversion-strip">
                                <div>
                                    <div class="kx-conversion-label">Loan Conversion Rate</div>
                                    <div class="kx-conversion-sub">{{ $loans_disbursed ?? 0 }} Completed of {{ $total_loan_leads ?? 0 }} leads</div>
                                </div>
                                <div class="kx-conversion-rate">{{ $conversion_rate ?? 0 }}%</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <!-- <div class="row">
                <div class="col-lg-6">
                    <div class="kx-card">
                        <div class="kx-card-header">
                            <div class="kx-card-header-icon"><i class="fa fa-chart-bar"></i></div>
                            <h4>Loan Approval and Non-Approval Report</h4>
                        </div>
                        <div class="kx-card-body">
                            <div class="ct-bar-chart mt-5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="kx-card">
                        <div class="kx-card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

     <!--<link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
        <!-- Removed duplicate jQuery 3.6.0 include: it's already loaded once in
             layouts.admin-app. Loading it twice re-registers jQuery and detaches
             any plugin (like pignoseCalendar) that had already bound itself to
             the first jQuery instance -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css">
        <script src="https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

        <!-- IMPORTANT: chartist and pignose-calendar must be loaded BEFORE the
             inline <script> blocks further down that call Chartist.Bar(...) and
             .pignoseCalendar(...). Script tags execute top-to-bottom, so these
             were previously placed after their usage and threw
             "is not a function" / "Graph container element not found" errors. -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pg-calendar/dist/css/pignose.calendar.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pg-calendar/dist/js/pignose.calendar.min.js"></script>

    <script>
        $(document).ready(function() {
            @if(session('success'))
            toastr.success("{{Session::get('success')}}", "Success!", {
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
            @endif
            @php
            session()->forget('success');
            @endphp
        });
    </script>

<script>
    $(document).ready(function() {
        var leadsData = @json($lead_categories ?? []);
var leadsTotal = leadsData.reduce(function(sum, c) { return sum + c.count; }, 0);
document.getElementById('kxLeadsDonutTotal').textContent = leadsTotal;

new Chart(document.getElementById('leadsDonut'), {
    type: 'doughnut',
    data: {
        labels: leadsData.map(c => c.label),
        datasets: [{
            data: leadsData.map(c => c.count),
            backgroundColor: leadsData.map(c => c.color),
            borderWidth: 3,
            borderColor: '#ffffff',
            hoverOffset: 8
        }]
    },
    options: {
        cutoutPercentage: 72,
        responsive: true,
        maintainAspectRatio: false,
         layout: {
            padding: 22
        },
        legend: { display: false },
        tooltips: {
            backgroundColor: '#25213A',
             xAlign: 'center',
            titleFontSize: 12,
            bodyFontSize: 12,
            cornerRadius: 8,
            padding: 10
        }
    }
});

        var statusData = {!! $loan_status_counts_json !!};
        var statusChart = new Chart(document.getElementById('statusBarChart'), {
            type: 'bar',
            data: {
                labels: ['Pending', 'Under Review', 'Completed'],
                datasets: [{
                    data: [statusData.pending, statusData.under_review, statusData.completed],
                    backgroundColor: ['#f3d9f0', '#9D3895','#392367'],
                    borderRadius: 4,
                    borderWidth: 0,

                    // barThickness: 5,
                    maxBarThickness: 55,
                    categoryPercentage: 0.6,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,   // ← ye line add karo
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            fontColor: '#747080',
                            fontSize: 12
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#F1EDF3',
                            drawBorder: false,
                            zeroLineColor: '#F1EDF3'
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            fontColor: '#747080',
                            fontSize: 12
                        }
                    }]
                },
                onClick: function(event, elements) {
        if (elements.length > 0) {
            window.location.href = 'https://partner.kanoox.vebsigns.com/admin/loan-leads';
        }
    }
            }
        });

        // ↓↓↓ IS PURANE BLOCK KO REPLACE KARO ↓↓↓
        $('#statusFilter').on('change', function() {
            var period = $(this).val();
            if (period === 'custom') {
                $('#customStartDate, #customEndDate').show();
                return;
            } else {
                $('#customStartDate, #customEndDate').hide();
            }
            $.get('{{ route("admin.loan-status-counts") }}', { period: period }, function(res) {
                statusChart.data.datasets[0].data = [res.pending, res.under_review, res.completed];
                statusChart.update();
            });
        });
        // ↑↑↑ YAHAN TAK ↑↑↑

            var healthData = {!! $services_health_json !!};
            new Chart(document.getElementById('healthChart'), {
                type: 'bar',
                data: {
                     labels: ['Banks', 'Services', 'Sub-Services'],
                     datasets: [
                { label: 'Active', data: [healthData.banks[0], healthData.services[0], healthData.sub_services[0]], backgroundColor: '#16b364', borderRadius: 4 },
                { label: 'Inactive', data: [healthData.banks[1], healthData.services[1], healthData.sub_services[1]], backgroundColor: '#ef4444', borderRadius: 4 }
                ]
                },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,   // ← ye line add karo
                    legend: {
                        position: 'bottom',
                        labels: {
                            fontColor: '#747080',
                            fontSize: 12,
                            boxWidth: 12
                        }
                    },
                    scales: {
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            fontColor: '#747080',
                            fontSize: 12
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            color: '#F1EDF3',
                            drawBorder: false,
                            zeroLineColor: '#F1EDF3'
                        },
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#747080',
                            fontSize: 12
                        }
                    }]
               },
               onClick: function(event, elements) {
            if (elements.length > 0) {
                var index = elements[0]._index; // 0 = Banks, 1 = Services, 2 = Sub-Services
                var urls = [
                    '{{ url("admin/bank/all") }}',
                    '{{ url("admin/service/all") }}',
                    '{{ url("admin/sub-services/all") }}'
                ];
                window.location.href = urls[index];
            }
           }    
            }
           });
    });
</script>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ $base_url }}/images/favicon.png">
    <link href="{{ $base_url }}/css/style.css" rel="stylesheet">
    <script src="{{ $base_url }}/js/quixnav-init.js"></script>

@endsection