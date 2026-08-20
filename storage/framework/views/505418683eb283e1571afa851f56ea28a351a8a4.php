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
                            
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
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
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form method="POST" action="<?php echo e(route('password.update')); ?>">
                                        <?php echo csrf_field(); ?>
            
                                        <div class="form-group row">
                                            <label for="current_password" class="col-md-4 col-form-label text-md-right">Current Password</label>
            
                                            <div class="col-md-6">
                                                <input id="current_password" type="password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="current_password" required autofocus>
            
                                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
            
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
            
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required>
            
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
            
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
            
                                            <div class="col-md-6">
                                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>
            
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
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
    $('#main_service_id').on('change',function(e){
    var ob=$(this).val();
    $.ajax({
                url:"<?php echo e($base_url); ?>/select1",
                type:"post",
                data:{
                "_token": "<?php echo e(csrf_token()); ?>","service_id":ob,
                },
                success: function(data){
                    $('#bank_id').empty();
               $('#bank_id').append("<option hidden='' disabled='disabled' selected='selected' value=''>Select Bank</option>");
                $.each(data,function(index,item){
                    $.each(item,function(index1,item1){
                // console.log(item1);
               $('#bank_id').append("<option value="+item1.bank_id+">"+item1.bank_name+"</option>");
            });
                });
                }
                
            });
    });
     $("#sub_service").keyup(function(){
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


<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/auth/passwords/change.blade.php ENDPATH**/ ?>