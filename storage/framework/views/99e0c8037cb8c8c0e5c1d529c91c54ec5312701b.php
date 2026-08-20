

<?php $__env->startSection('title', 'Manage Blogs'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e($base_url); ?>/vendor/toastr/css/toastr.min.css">

<style>
    .table-scroll{
        max-height:420px;
        overflow:auto;
    }
    .table th,.table td{
        white-space:nowrap;
    }
    /* Sticky header */
    .table thead th{
        position:sticky;
        top:0;
        z-index:2;
        background-color:#eef2f7;
        color:#1f2937;
        font-weight:600;
        border-bottom:2px solid #d1d5db;
    }
    /* Body */
    .table tbody td{
        color:#374151;
        background:#ffffff;
    }
    .table tbody tr:nth-child(even) td{
        background:#f9fafb;
    }
    .table-hover tbody tr:hover td{
        background:#eef6ff;
    }
</style>

<div class="content-body">
    <div class="container-fluid">

        <!-- PAGE HEADER (same structure as Bank list page-titles row) -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Blogs</h4>
                    <p class="mb-0">Create, edit &amp; publish blog articles</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary btn-sm" style="color:#fff;">
                            + Add New Blog
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-scroll table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Published At</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>

                                        <td>
                                            <strong><?php echo e($blog->title); ?></strong>
                                            <?php if($blog->excerpt): ?>
                                                <div class="text-muted small" style="max-width:260px">
                                                    <?php echo e(Str::limit($blog->excerpt, 80)); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-muted">
                                            <?php echo e($blog->slug); ?>

                                        </td>

                                        <td>
                                            <?php if($blog->status): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Draft</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e(optional($blog->published_at)->format('d M Y') ?? '-'); ?>

                                        </td>

                                        <td class="text-end">

                                            <a href="<?php echo e(route('admin.blogs.edit', $blog->id)); ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>

                                            <form action="<?php echo e(route('admin.blogs.destroy', $blog->id)); ?>"
                                                  method="POST"
                                                  class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this blog? This action cannot be undone.')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            No blogs found.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>

                            </table>
                        </div>

                        <!-- PAGINATION (if you use paginate later) -->
                        <?php if(method_exists($blogs, 'links')): ?>
                            <div class="mt-3 d-flex justify-content-end">
                                <?php echo e($blogs->links()); ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo e($base_url); ?>/vendordashboard/toastr/js/toastr.min.js"></script>
<script src="<?php echo e($base_url); ?>/js/plugins-init/toastr-init.js"></script>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/blogs/index.blade.php ENDPATH**/ ?>