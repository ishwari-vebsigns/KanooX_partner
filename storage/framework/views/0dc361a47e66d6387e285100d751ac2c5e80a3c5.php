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
                            <?php if(Auth::user()!=null): ?>
                            <h4>Hi, welcome <?php echo e(Auth::user()->name); ?>!</h4>
                            <?php if(Auth::user()->role_id==2): ?>
                            <p class="mb-0">Agent ID: <?php echo e(Auth::user()->new_id); ?></p>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </div>  
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="alert alert-dark notification" style="text-align: center;">
                                        <p class="notificaiton-title" style="text-align: center; font-size:20px;"><strong>Sorry! </strong> You dont have access for this page.
                                        </p>
                                        <p></p>
                                        <button class="btn btn-dark btn-sm rounded-0">Confirm</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  


  
   
        
</div>
</div>
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


<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/unauthorized.blade.php ENDPATH**/ ?>