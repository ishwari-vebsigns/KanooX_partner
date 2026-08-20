
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Loan Sarovar</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($base_url); ?>/images/favicon.png">
    <link href="<?php echo e($base_url); ?>/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center">
                        <h1 class="error-text font-weight-bold">419</h1>
                            <h4 class="mt-4"><i class="fa fa-times-circle text-danger"></i> Page Expired</h4>
                            <p>You do not have permission to view this resource</p>
                        <div class="mb-5">
                            <?php if(Auth::user()!=null): ?>
                            <a class="btn btn-primary" href="<?php echo e($base_url); ?>/admin/dashboard">Back to Home</a>
                            <?php else: ?>
                            <a class="btn btn-primary" href="<?php echo e($base_url); ?>/login">Back to Home</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/errors/419.blade.php ENDPATH**/ ?>