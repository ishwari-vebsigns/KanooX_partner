<?php $__env->startSection('content'); ?>


   
<link href="<?php echo e($base_url); ?>/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Custom Stylesheet -->
<link href="<?php echo e($base_url); ?>/css/style.css" rel="stylesheet">

<!-- Daterange picker -->
<link href="<?php echo e($base_url); ?>/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Clockpicker -->
<link href="<?php echo e($base_url); ?>/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
<!-- asColorpicker -->
<link href="<?php echo e($base_url); ?>/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
<!-- Material color picker -->
<link href="<?php echo e($base_url); ?>/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- Pick date -->
<link rel="stylesheet" href="<?php echo e($base_url); ?>/vendor/pickadate/themes/default.css">
<link rel="stylesheet" href="<?php echo e($base_url); ?>/vendor/pickadate/themes/default.date.css">

<style>
.dataTables_wrapper .dataTables_paginate {
    margin-top: 15px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-block;
    padding: 6px 14px;
    margin: 0 3px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    color: #9D3895 !important;
    background: #fff;
    cursor: pointer;
    text-decoration: none !important;
    transition: all .15s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3d9f0 !important;
    border-color: #f3d9f0;
    color: #9D3895 !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #9D3895 !important;
    border-color: #392367;
    color: #fff !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    color: #bbb !important;
    cursor: not-allowed;
    background: #fafafa;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: #fafafa !important;
    color: #bbb !important;
    border-color: #e0e0e0;
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
                            
                            <li class="breadcrumb-item active"><a href="<?php echo e($base_url); ?>/admin/bank/all">Banks</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                 <P></P>              <h4 class="card-title">
                    <?php if($my_permissions->contains('BANK_ADD')): ?>
                    <a href="add" style="color:white;" class="btn btn-secondary">Add Bank</a>
                    <?php endif; ?>
                    <button class="btn btn-primary" id="downloadButton">Download</button></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Bank Image</th>
                                                <th>Bank Name</th>
                                                
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           
                                           
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="<?php echo e($base_url); ?>/vendor/toastr/css/toastr.min.css">
        <script src="<?php echo e($base_url); ?>/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="<?php echo e($base_url); ?>/js/plugins-init/toastr-init.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
 <script>
    $(document).ready(function() {
   
  
    var table = $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        columns: [
            { data: "bank_id" },
            {
                data: "bank_image",
                render: function(data, type, row) {
                    if(data!=null){
                        return '<div class="product-div" style="height:50px;width:50px"><center><img class="img-fluid" id="product_img" src="<?php echo e($base_url); ?>/storage/app/'+data+'" style="max-height:50px;max-width:45px;"></center></div>';
                    }
                    else{
                        return '<div class="product-div" style="height:50px;width:50px"><center><img class="img-fluid" id="product_img" src=<?php echo e($base_url); ?>/web-assets/images/resources/product.png style="max-height:50px;max-width:45px;"></center></div>';

                    }
                   
                }
            },
            { data: "bank_name" },
           
            {
                "mData": "updated_at",
                "mRender": function(data, type, row) {
                var string=row.updated_at;
                var date = new Date(string);
                return date.toLocaleString();
                }
            },
            {
                data: "is_active",
                render: function(data, type, row) {
                    if(data==0){
                        return '<span class="badge badge-danger">Inactive</span>';

                    }
                    if(data==1){
                        return '<span class="badge badge-success">Active</span>';

                    }
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    <?php if($my_permissions->contains('SERVICE_DETAILS')): ?>
                    return '<div class="btn-group" role="group"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Actions</button><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);"><a class="dropdown-item" href="' + data.bank_id + '">Details</a><a class="dropdown-item" href="' + data.bank_id + '/delete/all" >Delete</a></div></div>'
                    <?php endif; ?>
                }
            },
           
        ]
    });
           
    // Fetch data using AJAX
			

    $.ajax({
        url: 'allData',
        method: 'GET',
        success: function(response) {
            var newData = response.data;
            table.rows.add(newData).draw();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });

    // Convert table data to Excel format
    function convertToExcel() {
        var workbook = XLSX.utils.table_to_book(document.getElementById('example'), { sheet: 'Sheet 1' });
        var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
        return excelData;
    }

    // Generate and download the Excel file
    function downloadExcel() {
        var excelData = convertToExcel();
        var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'data.xlsx';
        a.click();
        URL.revokeObjectURL(url);
    }

    // Attach event listener to download button
    $('#downloadButton').on('click', downloadExcel);

   
		});


 </script>
    
    
    <!-- Required vendors -->
     <script src="<?php echo e($base_url); ?>/vendor/datatables/js/jquery.dataTables.min.js"></script>
    
        <script src="<?php echo e($base_url); ?>/vendor/moment/moment.min.js"></script>
        <script src="<?php echo e($base_url); ?>/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- clockpicker -->
        <script src="<?php echo e($base_url); ?>/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!-- asColorPicker -->
        <script src="<?php echo e($base_url); ?>/vendor/jquery-asColor/jquery-asColor.min.js"></script>
        <script src="<?php echo e($base_url); ?>/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
        <script src="<?php echo e($base_url); ?>/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
        <!-- Material color picker -->
        <script src="<?php echo e($base_url); ?>/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- pickdate -->
        <script src="<?php echo e($base_url); ?>/vendor/pickadate/picker.js"></script>
        <script src="<?php echo e($base_url); ?>/vendor/pickadate/picker.time.js"></script>
        <script src="<?php echo e($base_url); ?>/vendor/pickadate/picker.date.js"></script>
    
    
    
        <!-- Daterangepicker -->
        <script src="<?php echo e($base_url); ?>/js/plugins-init/bs-daterange-picker-init.js"></script>
        <!-- Clockpicker init -->
        <script src="<?php echo e($base_url); ?>/js/plugins-init/clock-picker-init.js"></script>
        <!-- asColorPicker init -->
        <script src="<?php echo e($base_url); ?>/js/plugins-init/jquery-asColorPicker.init.js"></script>
        <!-- Material color picker init -->
        <script src="<?php echo e($base_url); ?>/js/plugins-init/material-date-picker-init.js"></script>
        <!-- Pickdate -->
        <script src="<?php echo e($base_url); ?>/js/plugins-init/pickadate-init.js"></script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/bank/all.blade.php ENDPATH**/ ?>