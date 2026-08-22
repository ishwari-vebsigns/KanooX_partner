<?php $__env->startSection('content'); ?>
<style>
  .default{
    visibility:hidden;
  }
    .navpaddingone{
        padding-left:20px;
    }
    .nav-pills>li.active>a.navpaddingone {
    color: #fff;
    background-color: #542f6d;
    padding: 10px;
    border-radius: 5px;
    margin-left: 10px;
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
                            <li class="breadcrumb-item"><a href="<?php echo e($base_url); ?>/admin/sub-services/all">Services</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit <?php echo e($services->service_name); ?></a></li>
                        </ol>
                    </div>
                </div>
 
<?php if(Auth::user()->kyc_status==0 && Auth::user()->role_id==2): ?>
  <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
<?php endif; ?>   

                    
  
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit <?php echo e($services->service_name); ?></h4>
                               
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form class="" action="<?php echo e($services->service_id); ?>" method="post" enctype='multipart/form-data'>
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-xl-10">
                                            <div class="col-md-6 p-0 product-div">
                                                      <img class="img-fluid" src="<?php echo e($base_url); ?>/storage\app/<?php echo e($servicehierarchy->sub_service_image); ?>" id="current_product_image" style=" margin:auto;max-height:200px;max-width:200px;" onerror="this.src='<?php echo e($base_url); ?>/web-assets/images/resources/product.png';">
                                                    </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Sub Service Image/Logo <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                   
                                                    <div class="col-lg-6 <?php echo e($errors->has('sub_service_image') ? ' has-error' : ''); ?>">
                                                    
                                                        <input type="file" class="form-control" id="sub_service_image" name="sub_service_image">
                                                        <?php if($errors->has('sub_service_image')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('sub_service_image')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php if($servicehierarchy->sub_service_image_2): ?>
<div class="col-md-6 p-0 product-div">
    <img class="img-fluid"
         src="<?php echo e($base_url); ?>/storage/app/<?php echo e($servicehierarchy->sub_service_image_2); ?>"
         style="max-height:200px;">
</div>
<?php endif; ?>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">
        Sub Service Image 2
    </label>
    <div class="col-lg-6">
        <input type="file" class="form-control" name="sub_service_image_2">
    </div>
</div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Select Service
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select name="service_id" id="main_service" class="form-control" id="val-skill" name="gender" required>
                                                            <option value="">Please select</option>
                                                            <?php $__currentLoopData = $main_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($service->service_id); ?>"><?php echo e($service->service_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Sub Service Name <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('sub_service') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="sub_service_name" value="<?php echo e(old('sub_service',$services->service_name)); ?>" name="sub_service" placeholder="Service Name ">
                                                        <?php if($errors->has('sub_service')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('sub_service')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Service URL
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('sub_service_url') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="sub_service_url" value="<?php echo e(old('sub_service_url',$services->service_url)); ?>" name="sub_service_url" placeholder="Service URL" required>
                                                        <?php if($errors->has('sub_service_url')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('sub_service_url')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Description <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" id="val-suggestions" name="description" rows="5" placeholder="What would you like to see?" required><?php echo e(old('description',$servicehierarchy->description)); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        <?php if($services->status_id ==0): ?>
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        <?php endif; ?>
                                                        <?php if($services->status_id ==1): ?>
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
    $("#main_service option[value=<?php echo e($servicehierarchy->parent_service->service_id); ?>]").prop('selected',true);

     $("#sub_service_name").keyup(function(){
    var Text = $(this).val();
        $("#sub_service_url").val(Text);        
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


<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/sub-services/details.blade.php ENDPATH**/ ?>