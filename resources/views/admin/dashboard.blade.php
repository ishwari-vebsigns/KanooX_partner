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

/* ---------- Chart cards ---------- */
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
                            <div class="kx-stat-text">Total Registered Users</div>
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
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Credit Card Leads</div>
                            <div class="kx-stat-digit">{{ $credit_card_leads_count ?? 0 }}</div>
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
                    <div class="kx-stat-card">
                        <div class="kx-stat-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="kx-stat-content">
                            <div class="kx-stat-text">Credit Reports</div>
                            <div class="kx-stat-digit">{{ $credit_reports_count ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                @endif
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
       $( document ).ready(function() {
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
   $( document ).ready(function() {

    var total_loan_approved_count = @json($total_loan_approved_count);
    var total_loan_nonapproved_count = @json($total_loan_nonapproved_count);
    console.log(total_loan_approved_count, total_loan_nonapproved_count);
    var xValues = ["Loan Non-Approved", "Loan Approved"];
    var yValues = [total_loan_nonapproved_count, total_loan_approved_count];
    var barColors = [
    "#38B3F6",
    "#0c0c3e",

    ];

    new Chart("myChart", {
    type: "pie",
    data: {
    labels: xValues,
    datasets: [{
     backgroundColor: barColors,
     data: yValues
    }]
    },

    });
});
    </script>
    <script>
          var new_mrw = @json($new_mrw);
          var new_mrw1 = @json($new_mrw1);

          console.log(new_mrw);
        $( document ).ready(function() {

    /*----------------------------------*/

    var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [

        new_mrw,
        new_mrw1,
        ]
    };

    var options = {
        seriesBarDistance: 10
    };

    var responsiveOptions = [
        ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
                labelInterpolationFnc: function(value) {
                    return value[0];
                }
            }
        }]
    ];

    // Guard: only initialize the chart if the container actually exists on
    // this page (prevents "Graph container element not found")
    if ($('.ct-bar-chart').length) {
        new Chartist.Bar('.ct-bar-chart', data, options, responsiveOptions);
    }

    // Guard: only initialize the calendar if the element exists on this page
    if ($('.year-calendar').length) {
        $('.year-calendar').pignoseCalendar({
            theme: 'blue' // light, dark, blue
        });
    }

        });

    </script>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ $base_url }}/images/favicon.png">
    <link href="{{ $base_url }}/css/style.css" rel="stylesheet">
    <script src="{{ $base_url }}/js/quixnav-init.js"></script>

@endsection