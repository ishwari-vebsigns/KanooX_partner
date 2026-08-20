<?php $__env->startSection('content'); ?>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
                        <?php if(Auth::user()->role_id == 2): ?>
                            <p class="mb-0">Agent ID: <?php echo e(Auth::user()->new_id); ?></p>

                        <?php endif; ?>
                    </div>

                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <?php if(Auth::user()->role_id == 1): ?>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                        <?php else: ?>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Agent</a></li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                  <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">

                            <?php if(Auth::user()->role_id == 1): ?>
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-users-viewfinder"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Registered Users</div>
                                <div class="stat-digit"><?php echo e($user_count); ?></div>
                            </div>
                            <?php endif; ?>
                            <?php if(Auth::user()->role_id == 2 || Auth::user()->role_id==3): ?>
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Login Loans</div>
                                <div class="stat-digit"><?php echo e($loan_registered_count); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                            <?php if(Auth::user()->role_id == 1): ?>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Disburse Loans</div>
                                <div class="stat-digit"><?php echo e($loan_disbursed_count); ?></div>
                            </div>
                            <?php endif; ?>
                            <?php if(Auth::user()->role_id == 2 || Auth::user()->role_id==3): ?>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Disburse Loans</div>
                                <div class="stat-digit"><?php echo e($loan_disbursed_count); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div> -->

                <?php if(Auth::user()->role_id == 1): ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Loan Leads</div>
                                <div class="stat-digit"><?php echo e($loan_leads_count ?? 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Credit Card Leads</div>
                                <div class="stat-digit"><?php echo e($credit_card_leads_count ?? 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Contact Us Submissions</div>
                                <div class="stat-digit"><?php echo e($contact_us_count ?? 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Credit Reports</div>
                                <div class="stat-digit"><?php echo e($credit_reports_count ?? 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
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

     <!--<link rel="stylesheet" href="<?php echo e($base_url); ?>/vendor/toastr/css/toastr.min.css">-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="<?php echo e($base_url); ?>/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="<?php echo e($base_url); ?>/js/plugins-init/toastr-init.js"></script>
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
        <?php if(session('success')): ?>
        toastr.success("<?php echo e(Session::get('success')); ?>", "Success!", {
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
        <?php endif; ?>
        <?php
        session()->forget('success');
        ?>
    });
    </script>
 <script>
   $( document ).ready(function() {

    var total_loan_approved_count = <?php echo json_encode($total_loan_approved_count, 15, 512) ?>;
    var total_loan_nonapproved_count = <?php echo json_encode($total_loan_nonapproved_count, 15, 512) ?>;
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
          var new_mrw = <?php echo json_encode($new_mrw, 15, 512) ?>;
          var new_mrw1 = <?php echo json_encode($new_mrw1, 15, 512) ?>;

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

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($base_url); ?>/images/favicon.png">
    <link href="<?php echo e($base_url); ?>/css/style.css" rel="stylesheet">
    <script src="<?php echo e($base_url); ?>/js/quixnav-init.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>