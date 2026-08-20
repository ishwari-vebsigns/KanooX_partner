

<?php $__env->startSection('content'); ?>

<style>
.admin-content-wrapper {
    padding-top: 100px;
    padding-left: 300px;
    padding-right: 24px;
}

@media (max-width: 991px) {
    .admin-content-wrapper {
        padding-left: 15px;
    }
}

.card {
    border-radius: 10px;
    margin-bottom: 20px;
}

.section-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #1f2937;
}

.label {
    font-weight: 600;
    color: #374151;
}

.value {
    color: #111827;
}

.score-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    color: #fff;
}

.score-good { background: #22c55e; }
.score-mid { background: #f59e0b; }
.score-low { background: #ef4444; }
.score-na { background: #6b7280; }

.info-box {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 10px;
    background: #f9fafb;
}
</style>

<div class="admin-content-wrapper">

    <div class="row page-titles mx-0 mb-2">
        <div class="col-sm-6">
            <h4>CIBIL Report Details</h4>
        </div>
    </div>

    <!-- BASIC -->
    <div class="card p-3">
        <div class="section-title">Basic Information</div>

        <div class="row">
            <div class="col-md-3">
                <p class="label">Name</p>
                <p><?php echo e($report->name); ?></p>
            </div>

            <div class="col-md-3">
                <p class="label">National ID</p>
                <p><?php echo e($report->pan); ?></p>
            </div>

            <div class="col-md-3">
                <p class="label">Mobile</p>
                <p><?php echo e($report->mobile); ?></p>
            </div>

            <div class="col-md-3">
                <p class="label">Score</p>

                <?php
                    $score = $report->credit_score;
                    if(!$score) $class = 'score-na';
                    elseif($score >= 750) $class = 'score-good';
                    elseif($score >= 650) $class = 'score-mid';
                    else $class = 'score-low';
                ?>

                <span class="score-badge <?php echo e($class); ?>">
                    <?php echo e($score ?? 'N/A'); ?>

                </span>
            </div>
        </div>

        <?php if($report->pdf_link): ?>
            <div class="mt-3">
                <a href="<?php echo e($report->pdf_link); ?>" target="_blank" class="btn btn-success btn-sm">
                    View PDF
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- SCORE -->
    <div class="card p-3">
        <div class="section-title">Score Details</div>

        <p>
            <?php echo e($credit['SCORE']['FCIREXScore'] ?? 'N/A'); ?>

        </p>
    </div>

    <!-- ACCOUNTS -->
    <div class="card p-3">
    <div class="section-title">Account Details</div>

    <?php $__empty_1 = true; $__currentLoopData = $credit['CAIS_Account']['CAIS_Account_DETAILS'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="info-box">

            <div class="row">

                <div class="col-md-3">
                    <p class="label">Bank</p>
                    <p><?php echo e($acc['Subscriber_Name'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Account No</p>
                    <p><?php echo e($acc['Account_Number'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Loan Amount</p>
                    <p>₹ <?php echo e($acc['Highest_Credit_or_Original_Loan_Amount'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Current Balance</p>
                    <p>₹ <?php echo e($acc['Current_Balance'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Account Status</p>
                    <p><?php echo e($acc['Account_Status'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Open Date</p>
                    <p><?php echo e($acc['Open_Date'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Close Date</p>
                    <p><?php echo e($acc['Date_Closed'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Last Payment</p>
                    <p><?php echo e($acc['Date_of_Last_Payment'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Interest</p>
                    <p><?php echo e($acc['Rate_of_Interest'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Tenure</p>
                    <p><?php echo e($acc['Repayment_Tenure'] ?? '-'); ?></p>
                </div>

                <div class="col-md-3">
                    <p class="label">Past Due</p>
                    <p>₹ <?php echo e($acc['Amount_Past_Due'] ?? '-'); ?></p>
                </div>

            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">No Account Data</p>
    <?php endif; ?>
</div>

    <!-- ENQUIRIES -->
    <div class="card p-3">
        <div class="section-title">Loan Enquiries</div>

        <?php $__empty_1 = true; $__currentLoopData = $credit['CAPS']['CAPS_Application_Details'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="info-box">
                <div class="row">
                    <div class="col-md-4">
                        <p class="label">Date</p>
                        <p><?php echo e($cap['Date_of_Request'] ?? '-'); ?></p>
                    </div>

                    <div class="col-md-4">
                        <p class="label">Amount</p>
                        <p><?php echo e($cap['Amount_Financed'] ?? '-'); ?></p>
                    </div>

                    <div class="col-md-4">
                        <p class="label">Duration</p>
                        <p><?php echo e($cap['Duration_Of_Agreement'] ?? '-'); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted">No Enquiries Found</p>
        <?php endif; ?>
    </div>
    <!--Summary section-->
    <div class="card p-3">
    <div class="section-title">Summary</div>

    <?php
        $summary = $credit['CAIS_Account']['CAIS_Summary']['Credit_Account'] ?? [];
    ?>

    <div class="row">
        <div class="col-md-3">
            <p class="label">Total Accounts</p>
            <p><?php echo e($summary['CreditAccountTotal'] ?? 0); ?></p>
        </div>

        <div class="col-md-3">
            <p class="label">Active</p>
            <p><?php echo e($summary['CreditAccountActive'] ?? 0); ?></p>
        </div>

        <div class="col-md-3">
            <p class="label">Closed</p>
            <p><?php echo e($summary['CreditAccountClosed'] ?? 0); ?></p>
        </div>

        <div class="col-md-3">
            <p class="label">Defaults</p>
            <p><?php echo e($summary['CreditAccountDefault'] ?? 0); ?></p>
        </div>
    </div>
</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\kanoo_partner\resources\views/admin/cibil/details.blade.php ENDPATH**/ ?>