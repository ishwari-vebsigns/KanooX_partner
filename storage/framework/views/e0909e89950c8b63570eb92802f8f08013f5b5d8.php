

<?php $__env->startSection('content'); ?>
    <style>
        .table-scroll {
            max-height: 420px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .table-scroll thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
            white-space: nowrap;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }

        /* THEAD (table header) */
        .table thead th {
            background-color: #eef2f7;
            /* light bluish-grey */
            color: #1f2937;
            /* dark readable text */
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }

        /* TABLE BODY */
        .table tbody td {
            color: #374151;
            /* dark grey (very readable) */
            background-color: #ffffff;
        }

        /* Alternate row color for readability */
        .table tbody tr:nth-child(even) td {
            background-color: #f9fafb;
            /* very light grey */
        }

        /* Hover effect */
        .table-hover tbody tr:hover td {
            background-color: #eef6ff;
            /* subtle blue hover */
        }
    </style>

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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Credit Card Leads</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="mb-0">Credit Card Leads</h4>

                                <a href="<?php echo e(route('credit.card.leads.export')); ?>" class="btn btn-success btn-sm">
                                    Download Excel
                                </a>
                            </div>

                            <div class="table-scroll table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>National ID</th>
                                            <th>DOB</th>
                                            <th>Profession Type</th>
                                            <th>Annual income</th>
                                            <th>Applied On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration + ($leads->currentPage() - 1) * $leads->perPage()); ?></td>
                                                <td><?php echo e($lead->name); ?></td>
                                                <td><?php echo e($lead->mobile); ?></td>
                                                <td><?php echo e($lead->pan); ?></td>
                                                <td><?php echo e($lead->dob); ?></td>
                                                <td><?php echo e($lead->profession_type); ?></td>
                                                <td><?php echo e($lead->annual_income); ?></td>
                                                <td><?php echo e($lead->created_at->format('d M Y')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">
                                                    No Credit Card Leads Found
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-3 d-flex justify-content-end">
                                <?php echo e($leads->links()); ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/credit-card-leads.blade.php ENDPATH**/ ?>