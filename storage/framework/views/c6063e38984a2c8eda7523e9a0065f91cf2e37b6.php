<?php $__env->startSection('content'); ?>
<style>
  .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
                            <li class="breadcrumb-item"><a href="<?php echo e($base_url); ?>/admin/service/all">Services</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Service Details</a></li>
                        </ol>
                    </div>
                </div>
 
<?php if(Auth::user()->kyc_status==0): ?>
  <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
<?php endif; ?>   
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                           <h4 class="card-title">Edit Service</h4>

                                <h4 class="card-title">
                                <?php if($service->status_id==0): ?>
                                <!-- <button type="button" class="btn btn-success">Active</button> -->
                                <?php else: ?>
                                <!-- <button type="button" class="btn btn-danger">Inactive</button> -->
                                <?php endif; ?>
                                </h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="<?php echo e($service->service_id); ?>" action="<?php echo e($service->service_id); ?>" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-xl-10">
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Service Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('service_name') ? ' has-error' : ''); ?>">
                                                        <input type="text"  value="<?php echo e(old('service_name',$service->service_name)); ?>" class="form-control" id="service_name" name="service_name" placeholder="Service Name ">
                                                        <?php if($errors->has('service_name')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('service_name')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Service URL
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('service_url') ? ' has-error' : ''); ?>">
                                                        <input type="text"  value="<?php echo e(old('service_url',$service->service_url)); ?>" class="form-control" id="service_url" name="service_url" placeholder="Service URL" required>
                                                        <?php if($errors->has('service_url')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('service_url')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
        <label class="col-lg-4 col-form-label">Service Image</label>
        <div class="col-lg-6">
            <?php if($service->service_image): ?>
    <div class="mb-2">
        <img src="<?php echo e(asset('storage/app/' . $service->service_image)); ?>" style="height:60px;border-radius:6px;">
    </div>
<?php endif; ?>
            <input type="file" class="form-control" name="service_image" accept="image/*">
        </div>
    </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        <?php if($service->status_id ==0): ?>
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        <?php elseif($service->status_id ==1): ?>
                                                        <button name="inactive" class="btn btn-danger">In-Active</button>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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


<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/services/details.blade.php ENDPATH**/ ?>