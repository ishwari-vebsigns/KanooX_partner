@extends('layouts.admin-app')
@section('content')
    <style>
        /* ===== New colorful stat card design ===== */
        .stat-widget-one.card-body {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 22px 20px;
        }

        .card {
            border: none;
            border-radius: 36px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
        }

        .stat-widget-one .stat-icon {
            width: 56px !important;
            height: 56px !important;
            min-width: 56px !important;
            border-radius: 14px !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 22px !important;
            box-shadow: none !important;
        }

        .stat-widget-one .stat-icon i {
            font-size: 22px;
        }

        .stat-content {
            display: flex;
            flex-direction: column;
        }

        .stat-text {
            font-size: 13px;
            color: #8a8a99;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-digit {
            font-size: 26px;
            font-weight: 700;
            color: #1e1e2d;
            line-height: 1;
        }

        /* Color variants per card */
        .stat-widget-one .icon-purple { background: #efe6fd !important; color: #7b3fe4 !important; }
        .stat-widget-one .icon-blue   { background: #e3f0ff !important; color: #2f7ff0 !important; }
        .stat-widget-one .icon-orange { background: #ffe9d9 !important; color: #f28c1f !important; }
        .stat-widget-one .icon-green  { background: #e1f8ec !important; color: #16b364 !important; }
        .stat-widget-one .icon-teal   { background: #dcf6f4 !important; color: #0fb8ab !important; }
        .stat-widget-one .icon-pink   { background: #ffe3ee !important; color: #ef4d8b !important; }
    </style>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
                        @if (Auth::user()->role_id == 2)
                            <p class="mb-0">Agent ID: {{ Auth::user()->new_id }}</p>

                        @endif
                    </div>

                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        @if (Auth::user()->role_id == 1)
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                        @else
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Agent</a></li>
                        @endif
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                  <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">

                            @if(Auth::user()->role_id == 1)
                            <div class="stat-icon icon-purple d-inline-block">
                                <i class="fa-solid fa-users-viewfinder"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Registered Users</div>
                                <div class="stat-digit">{{ $user_count }}</div>
                            </div>
                            @endif
                            @if(Auth::user()->role_id == 2 || Auth::user()->role_id==3)
                            <div class="stat-icon icon-blue d-inline-block">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Login Loans</div>
                                <div class="stat-digit">{{ $loan_registered_count }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                            @if(Auth::user()->role_id == 1)
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Disburse Loans</div>
                                <div class="stat-digit">{{ $loan_disbursed_count }}</div>
                            </div>
                            @endif
                            @if(Auth::user()->role_id == 2 || Auth::user()->role_id==3)
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Disburse Loans</div>
                                <div class="stat-digit">{{ $loan_disbursed_count }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> -->

                @if(Auth::user()->role_id == 1)
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon icon-orange d-inline-block">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Loan Leads</div>
                                <div class="stat-digit">{{ $loan_leads_count ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon icon-pink d-inline-block">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Credit Card Leads</div>
                                <div class="stat-digit">{{ $credit_card_leads_count ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon icon-green d-inline-block">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Contact Us Submissions</div>
                                <div class="stat-digit">{{ $contact_us_count ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon icon-teal d-inline-block">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Credit Reports</div>
                                <div class="stat-digit">{{ $credit_reports_count ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Loan Approval and Non-Approval Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="ct-bar-chart mt-5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
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