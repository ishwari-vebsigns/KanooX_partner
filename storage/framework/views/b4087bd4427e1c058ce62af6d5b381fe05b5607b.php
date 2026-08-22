<?php $__env->startSection('content'); ?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<style>
.service-add-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.service-add-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.service-add-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.service-add-page .kx-title-icon {
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

.service-add-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.service-add-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.service-add-page .kx-breadcrumb {
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
}

.service-add-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.service-add-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.service-add-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- KYC alert ---------- */
.service-add-page .kx-kyc-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: #FDECEC;
    border: 1px solid #F6C9C9;
    color: #B93A3A;
    border-radius: 12px;
    font-size: 13.5px;
    margin-bottom: 20px;
}

.service-add-page .kx-kyc-alert i {
    font-size: 16px;
    flex: 0 0 auto;
}

.service-add-page .kx-kyc-alert a {
    color: #392367;
    font-weight: 700;
    text-decoration: underline;
}

/* ---------- Card ---------- */
.service-add-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.service-add-page .kx-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 26px;
    border-bottom: 1px solid var(--kx-border);
}

.service-add-page .kx-card-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.service-add-page .kx-card-title {
    margin: 0;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.service-add-page .kx-card-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

/* ---------- Form body ---------- */
.service-add-page .kx-form-body {
    padding: 30px 26px 32px;
}

.service-add-page .kx-field {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 4px 24px;
    margin-bottom: 22px;
}

.service-add-page .kx-field:last-of-type {
    margin-bottom: 0;
}

.service-add-page .kx-field-label {
    flex: 0 0 200px;
    max-width: 200px;
    padding-top: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--kx-text);
}

.service-add-page .kx-field-label .text-danger {
    color: #D64545;
}

.service-add-page .kx-field-control {
    flex: 1 1 320px;
    max-width: 420px;
}

.service-add-page .kx-input {
    width: 100%;
    height: 44px;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    padding: 0 14px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.service-add-page .kx-input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.service-add-page .kx-help-block {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #D64545;
    font-weight: 600;
}

/* ---------- Buttons ---------- */
.service-add-page .kx-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 6px;
}

.service-add-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 9px;
    border: 1px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
    line-height: 1.2;
}

.service-add-page .kx-btn:hover {
    transform: translateY(-1px);
}

.service-add-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.service-add-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

@media (max-width: 767px) {
    .service-add-page .kx-page-head {
        flex-direction: column;
    }
    .service-add-page .kx-field-label {
        flex: 0 0 100%;
        max-width: 100%;
        padding-top: 0;
    }
    .service-add-page .kx-field-control {
        max-width: 100%;
    }
}
</style>

<div class="content-body service-add-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-cubes"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
                    <p class="kx-page-subtitle">
                        Add a new service to the platform.
                        <?php if(Auth::user()->role_id==2): ?>
                            &nbsp;&middot;&nbsp;Agent ID: <?php echo e(Auth::user()->new_id); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <nav class="kx-breadcrumb">
                <a href="<?php echo e($base_url); ?>/admin/service/all">Services</a> / <span class="kx-crumb-current">Add Service</span>
            </nav>
        </div>

        <?php if(Auth::user()->kyc_status==0): ?>
        <div class="kx-kyc-alert">
            <i class="fa fa-exclamation-circle"></i>
            <span>Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</span>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-icon"><i class="fa fa-plus"></i></div>
                        <div>
                            <h4 class="kx-card-title">Apply</h4>
                            <p class="kx-card-subtitle">Enter the details for the new service</p>
                        </div>
                    </div>

                    <div class="kx-form-body">
                        <form action="add" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="kx-field">
                                <label class="kx-field-label" for="service_name">Service Name <span class="text-danger">*</span></label>
                                <div class="kx-field-control <?php echo e($errors->has('service_name') ? ' has-error' : ''); ?>">
                                    <input type="text" class="kx-input" id="service_name" name="service_name" placeholder="Service Name" required>
                                    <?php if($errors->has('service_name')): ?>
                                    <span class="kx-help-block"><?php echo e($errors->first('service_name')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="service_url">Service URL <span class="text-danger">*</span></label>
                                <div class="kx-field-control <?php echo e($errors->has('service_url') ? ' has-error' : ''); ?>">
                                    <input type="text" class="kx-input" id="service_url" name="service_url" placeholder="Service URL" required>
                                    <?php if($errors->has('service_url')): ?>
                                    <span class="kx-help-block"><?php echo e($errors->first('service_url')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="kx-field">
                                <div class="kx-field-label"></div>
                                <div class="kx-field-control kx-actions">
                                    <button type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script class="">
    $("#service_name").keyup(function(){
    var Text = $(this).val();
        $("#service_url").val(Text);
      });
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?>

         toastr.success("<?php echo e(Session::get('success')); ?>");
        <?php session()->forget('success'); ?>
        <?php }?>
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/services/add.blade.php ENDPATH**/ ?>