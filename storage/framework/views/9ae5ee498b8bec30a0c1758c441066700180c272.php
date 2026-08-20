<?php $__env->startSection('content'); ?>



    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
                            <?php if(Auth::user()->role_id==2 || Auth::user()->role_id==3): ?>
                            <p class="mb-0">Agent ID: <?php echo e(Auth::user()->new_id); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Details</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">My Details</a></li>
                        </ol>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="update-profile" method="post" enctype='multipart/form-data'>
                                      <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                                        <input type="text" value="<?php echo e(old('$user->name',$user->name)); ?>" class="form-control" id="val-username" name="name" placeholder="Enter a username..">
                                                        <?php if($errors->has('name')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                               
                                                <?php if($user->contact_number!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('phone_number') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-phoneus" name="phone_number" value="<?php echo e(old('$user->contact_number',$user->contact_number)); ?>" placeholder="2129990000" readonly required>
                                                        <?php if($errors->has('phone_number')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('phone_number') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-phoneus" name="phone_number" value="<?php echo e(old('$user->contact_number',$user->contact_number)); ?>" placeholder="2129990000">
                                                        <?php if($errors->has('phone_number')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($user->email!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo e(old('$user->email',$user->email)); ?>" placeholder="Your valid email.." required>
                                                        <?php if($errors->has('email')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo e(old('$user->email',$user->email)); ?>" placeholder="Your valid email..">
                                                        <?php if($errors->has('email')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($user->pincode!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('pincode') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-range" name="pincode" value="<?php echo e(old('$user->pincode',$user->pincode)); ?>" placeholder="Your 6 digit Pincode" required readonly>
                                                        <?php if($errors->has('pincode')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('pincode')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('pincode') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-range" name="pincode" value="" placeholder="Your 6 digit Pincode" required>
                                                        <?php if($errors->has('pincode')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('pincode')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->role_id==2 || Auth::user()->role_id==3): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Front
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('aadhar_front') ? ' has-error' : ''); ?>">
                                                    <?php if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1): ?>
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="<?php echo e($base_url); ?>/storage\app/<?php echo e($user->aadhar_front); ?>">
                                                            </iframe>
                                                          
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->aadhar_front==null): ?>
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_front">
                                                        <?php if($errors->has('aadhar_front')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('aadhar_front')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->role_id==2 || Auth::user()->role_id==3): ?>
                                                <?php if(Auth::user()->video_kyc==null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Upload KYC video(upload video with holding aadhar card or PAN card & Max. file size 5MB)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('pan_card') ? ' has-error' : ''); ?>">
                    
                                                    
                                                        <input type="file" class="form-control" id="val-range" name="video_kyc" required>
                                                        <?php if($errors->has('video_kyc')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('video_kyc')); ?></strong>
                                                        </span> 
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">KYC video
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <?php if(Auth::user()->kyc_status==0): ?>
                                                    <div class="col-lg-8 <?php echo e($errors->has('pan_card') ? ' has-error' : ''); ?>">
                                                        <!-- <label class="col-lg-4 col-form-label" for="val-range">KYC video Upload wait for the approval!
                                                        </label> -->
                                                         <iframe width="320" height="200" src="<?php echo e($base_url); ?>/storage\app/<?php echo e($user->video_kyc); ?>">
                                                            </iframe>
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="col-lg-8 <?php echo e($errors->has('pan_card') ? ' has-error' : ''); ?>">
                                                        <label class="col-lg-4 col-form-label" for="val-range">KYC approved!
                                                        </label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-xl-6">
                                                <?php if(Auth::user()->role_id==2 || Auth::user()->role_id==3): ?>
                                              <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Aadhar Back
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('aadhar_back') ? ' has-error' : ''); ?>">
                                                    <?php if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1): ?>
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="<?php echo e($base_url); ?>/storage\app/<?php echo e($user->aadhar_back); ?>">
                                                            </iframe>
                                                          
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->aadhar_back==null): ?>
                                                        <input type="file" class="form-control" id="val-range" name="aadhar_back">
                                                        <?php if($errors->has('aadhar_back')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('aadhar_back')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->role_id==2 || Auth::user()->role_id==3): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pan Card
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('pan_card') ? ' has-error' : ''); ?>">
                                                    <?php if(Auth::user()->kyc_status==0 || Auth::user()->kyc_status==1): ?>
                                                        <div class="col-md-12 p-0 product-div">
                                                            <iframe width="320" height="200" src="<?php echo e($base_url); ?>/storage\app/<?php echo e($user->pan_card); ?>">
                                                            </iframe>
                                                          
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->pan_card==null): ?>
                                                        <input type="file" class="form-control" id="val-range" name="pan_card">
                                                        <?php if($errors->has('pan_card')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('pan_card')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                 <?php if($bankdetails!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Account number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('account_number') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-username" name="account_number" value="<?php echo e(old('$bankdetails->bank_account_number',$bankdetails->bank_account_number)); ?>" placeholder="Enter account number..">
                                                        <?php if($errors->has('account_number')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('account_number')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Account number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('account_number') ? ' has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-username" name="account_number" value="" placeholder="Enter account number..">
                                                        <?php if($errors->has('account_number')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('account_number')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($bankdetails!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('ifsc') ? 'has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-website" name="ifsc" value="<?php echo e(old('$bankdetails->ifsc_code',$bankdetails->ifsc_code)); ?>" placeholder="IFSC Code">
                                                        <?php if($errors->has('ifsc')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('ifsc')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-website">IFSC Code
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('ifsc') ? 'has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-website" name="ifsc" value="" placeholder="IFSC Code">
                                                        <?php if($errors->has('ifsc')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('ifsc')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($bankdetails!=null): ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('bank_name') ? 'has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-range" name="bank_name" value="<?php echo e(old('$bankdetails->bank_name',$bankdetails->bank_name)); ?>" placeholder="Bank Name">
                                                        <?php if($errors->has('bank_name')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('bank_name')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Bank Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 <?php echo e($errors->has('bank_name') ? 'has-error' : ''); ?>">
                                                        <input type="text" class="form-control" id="val-range" name="bank_name" value="" placeholder="Bank Name">
                                                        <?php if($errors->has('bank_name')): ?>
                                                        <span class="help-block">
                                                        <strong><?php echo e($errors->first('bank_name')); ?></strong>
                                                        </span> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
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
    </div>


  
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitButton').click(function() {
            $(this).prop('disabled', true);
        });
    });
</script>
<script class="">
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?> 
         
         toastr.success("<?php echo e(Session::get('success')); ?>");
        <?php session()->forget('success'); ?>
        <?php }?>
});
  $(".bank-button").click(function(){
    $("#dashboard-analytics").hide();
    $("#removedefault").removeClass("default");
    
});
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/agent-profile.blade.php ENDPATH**/ ?>