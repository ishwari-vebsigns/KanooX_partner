

<?php $__env->startSection('content'); ?>
<style>
    /* THEAD */
    .table thead th {
        background-color: #eef2f7;
        color: #1f2937;
        font-weight: 600;
        border-bottom: 2px solid #d1d5db;
        white-space: nowrap;
    }

    /* BODY */
    .table tbody td {
        color: #374151;
        background-color: #ffffff;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* Allow message to wrap */
    .table tbody td.message-col {
        white-space: normal;
        max-width: 400px;
    }

    /* Alternate rows */
    .table tbody tr:nth-child(even) td {
        background-color: #f9fafb;
    }

    /* Hover */
    .table-hover tbody tr:hover td {
        background-color: #eef6ff;
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
                    <?php if(Auth::user()->role_id==2): ?>
                    <p class="mb-0">Agent ID: <?php echo e(Auth::user()->new_id); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Contact Us Submissions</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="mb-0">Contact Us Submissions</h4>

                            <a href="<?php echo e(route('user.contacts.export')); ?>"
                               class="btn btn-success btn-sm">
                                Download Excel
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration + ($contacts->currentPage()-1)*$contacts->perPage()); ?></td>
                                        <td><?php echo e($contact->name); ?></td>
                                        <td><?php echo e($contact->email); ?></td>
                                        <td><?php echo e($contact->phone); ?></td>
                                        <td class="message-col">
                                            <?php echo e($contact->message); ?>

                                        </td>
                                        <td><?php echo e($contact->created_at->format('d M Y')); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            No Contact Submissions Found
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3 d-flex justify-content-end">
                            <?php echo e($contacts->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/user-contacts/index.blade.php ENDPATH**/ ?>