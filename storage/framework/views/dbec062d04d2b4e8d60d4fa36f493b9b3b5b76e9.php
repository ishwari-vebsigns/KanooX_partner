

<?php $__env->startSection('content'); ?>
<style>
.table-scroll{
    max-height:420px;
    overflow:auto;
    -webkit-overflow-scrolling: touch;
}
.table th,.table td{white-space:nowrap}
.table thead th{
    position:sticky;
    top:0;
    background:#f8f9fa;
    z-index:2;
}
/* THEAD */
.table thead th {
    background-color: #eef2f7;
    color: #1f2937;
    font-weight: 600;
    border-bottom: 2px solid #d1d5db;
}
/* BODY */
.table tbody td {
    color: #374151;
    background-color: #ffffff;
}
.table tbody tr:nth-child(even) td {
    background-color: #f9fafb;
}
.table-hover tbody tr:hover td {
    background-color: #eef6ff;
}

/* Loan Services & Fields title row */
.services-title-row{
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    gap:10px;
}
@media(max-width:575px){
    .services-title-row{
        flex-direction:column;
        align-items:stretch;
    }
    .services-title-row .btn{
        width:100%;
    }
}

/* Per-service card header */
.service-card-header{
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    gap:10px;
}
@media(max-width:575px){
    .service-card-header{
        flex-direction:column;
        align-items:stretch;
    }
    .service-card-header .btn{
        width:100%;
        order:2;
    }
    .service-card-header strong,
    .service-card-header form{
        order:1;
    }
}

/* Modal responsiveness */
.modal-dialog{
    margin:1rem;
}
@media(min-width:576px){
    .modal-dialog{
        margin:1.75rem auto;
    }
}
</style>

<div class="content-body">
<div class="container-fluid">

    
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-0">Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Loan Services</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            
            <div class="card">
                <div class="card-body">

                    <div class="services-title-row mb-3">
                        <h4 class="mb-0">Loan Services & Fields</h4>

                        <div>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addServiceModal">
                                + Add Service
                            </button>
                        </div>
                    </div>

                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mb-4 border">
                        <div class="card-header service-card-header">
                            <button class="btn btn-sm btn-outline-primary"
                                    data-toggle="modal"
                                    data-target="#addFieldModal<?php echo e($service->id); ?>">
                                + Add Field
                            </button>

                            <div class="modal fade" id="addFieldModal<?php echo e($service->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST"
                                          action="<?php echo e(route('admin.loan.services.field.store')); ?>">
                                        <?php echo csrf_field(); ?>

                                        <input type="hidden"
                                               name="loan_service_id"
                                               value="<?php echo e($service->id); ?>">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Add Field – <?php echo e($service->name); ?>

                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Field Label</label>
                                                    <input type="text"
                                                           name="field_label"
                                                           class="form-control"
                                                           placeholder="e.g. Annual Income"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Field Name (DB)</label>
                                                    <input type="text"
                                                           name="field_name"
                                                           class="form-control"
                                                           placeholder="e.g. annual_income"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Field Type</label>
                                                    <select name="field_type" class="form-control">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="select">Select</option>
                                                    </select>
                                                </div>
                                                <div class="form-group d-none option-box">
                                                    <label>
                                                        Select Options
                                                        <small class="text-muted">(one option per line)</small>
                                                    </label>
                                                    <textarea
                                                        name="options"
                                                        class="form-control"
                                                        rows="4"
                                                        placeholder="Salaried
                                                        Self Employed
                                                        Business Owner
                                                        Freelancer"></textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label>Required</label>
                                                    <select name="is_required" class="form-control">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    Save Field
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <strong><?php echo e($service->name); ?></strong>

                            <form method="POST"
                                  action="<?php echo e(route('admin.loan.services.toggle', $service->id)); ?>"
                                  class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <button type="submit"
                                    class="badge border-0
                                    <?php echo e($service->is_active ? 'badge-success' : 'badge-danger'); ?>"
                                    style="cursor:pointer;">
                                    <?php echo e($service->is_active ? 'Active' : 'Inactive'); ?>

                                </button>
                            </form>

                        </div>

                        <div class="card-body">
                            <?php if($service->fields->count()): ?>
                                <div class="table-scroll table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Field Label</th>
                                                <th>Field Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>Required</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $service->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($field->field_label); ?></td>
                                                <td><?php echo e($field->field_name); ?></td>
                                                <td><?php echo e($field->field_type); ?></td>
                                                <td>
                                                    <span class="badge <?php echo e($field->is_active ? 'badge-success' : 'badge-danger'); ?>">
                                                    <?php echo e($field->is_active ? 'Active' : 'Inactive'); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="POST"
                                                          action="<?php echo e(route('admin.loan.services.field.toggle', $field->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>

                                                        <button class="btn btn-sm <?php echo e($field->is_active ? 'btn-danger' : 'btn-success'); ?>">
                                                            <?php echo e($field->is_active ? 'Deactivate' : 'Activate'); ?>

                                                        </button>
                                                    </form>
                                                </td>

                                                <td><?php echo e($field->is_required ? 'Yes' : 'No'); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No fields added yet.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

        </div>
    </div>

</div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('admin.loan.services.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Loan Service</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Service Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="e.g. Personal Loan"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Select Child Service</label>

                        <select name="service_child_id" class="form-control" required>

                            <option value="">Select Service</option>

                            <?php $__currentLoopData = $childServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($child->child_service_id); ?>">
                                    <?php echo e($child->sub_service_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Service
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('change', function (e) {
    if (e.target.name === 'field_type') {
        const modal = e.target.closest('.modal');
        const optionBox = modal.querySelector('.option-box');

        if (e.target.value === 'select') {
            optionBox.classList.remove('d-none');
        } else {
            optionBox.classList.add('d-none');
        }
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/loan-services.blade.php ENDPATH**/ ?>