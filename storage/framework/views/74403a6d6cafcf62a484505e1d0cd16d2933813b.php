<?php $__env->startSection('title',translate('Accoutn transaction information')); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Heading -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <h2 class="page-header-title text-capitalize m-0">
            <?php echo e(__('messages.account_transaction')); ?> <?php echo e(__('messages.information')); ?>

        </h2>
    </div>
    <div class="row g-2">
        
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-header-icon">
                            <i class="tio-user"></i>
                        </span>
                        <span><?php echo e($account_transaction->restaurant?__('messages.restaurant'):__('messages.deliveryman')); ?> <?php echo e(__('messages.info')); ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="col-md-8 mt-2">
                        <?php if($account_transaction->restaurant || $account_transaction->deliveryman): ?>
                            <h4><?php echo e(__('messages.name')); ?>: <?php echo e($account_transaction->restaurant ? $account_transaction->restaurant->name : $account_transaction->deliveryman->f_name.' '.$account_transaction->deliveryman->l_name); ?></h4>
                            <h6><?php echo e(__('messages.phone')); ?>  : <?php echo e($account_transaction->restaurant ? $account_transaction->restaurant->phone : $account_transaction->deliveryman->phone); ?></h6>
                            <h6><?php echo e(__('messages.collected_cash')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency($account_transaction->restaurant ? $account_transaction->restaurant->vendor->wallet->collected_cash : $account_transaction->deliveryman->wallet->collected_cash)); ?></h6>                        
                        <?php else: ?>
                            <h4 class="text-center"><?php echo e($account_transaction->from_type == 'restaurant' ? translate('messages.Restaurant deleted!') : translate('messages.deliveryman_deleted!')); ?></h4>
                        <?php endif; ?>
                       
                    </div>
                </div>
            </div>
        </div>
     
        <div class="col-md-6">
            
           
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-header-icon">
                            <i class="tio-user"></i>
                        </span>
                        <span><?php echo e(__('messages.transaction')); ?> <?php echo e(__('messages.information')); ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <h6><?php echo e(__('messages.amount')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency($account_transaction->amount)); ?></h6>
                    <h6 class="text-capitalize"><?php echo e(__('messages.time')); ?> : <?php echo e($account_transaction->created_at->format('Y-m-d '.config('timeformat'))); ?></h6>
                    <h6><?php echo e(__('messages.method')); ?> : <?php echo e($account_transaction->method); ?></h6>
                    <h6><?php echo e(__('messages.reference')); ?> : <?php echo e($account_transaction->ref); ?></h6>
                </div>
            </div>
          
       
       
        </div>
    
     

    </div>
 
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/account/view.blade.php ENDPATH**/ ?>