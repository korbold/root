<?php $__env->startSection('title','Delivery Man Preview'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <i class="tio-user"></i>
                </span>
                <span><?php echo e($dm['f_name'].' '.$dm['l_name']); ?></span>
            </h1>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'info'])); ?>"  aria-disabled="true"><?php echo e(__('messages.info')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transaction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'timelog'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.timelog')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'conversation'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.conversations')); ?></a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5 mt-2">
            <div class="card-header flex-wrap border-0">
                <h5 class="card-header-title"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.transactions')); ?></h5>
                <div>
                    <input type="date" class="form-control" onchange="set_filter('<?php echo e(route('admin.delivery-man.preview',['id'=>$dm->id, 'tab'=> 'transaction'])); ?>',this.value, 'date')" value="<?php echo e($date); ?>">
                </div>
            </div>
            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap justify-content-between table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.id')); ?></th>
                                <th><?php echo e(__('messages.delivery_fee')); ?> <?php echo e(__('messages.earned')); ?></th>
                                <th><?php echo e(__('messages.date')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php ($digital_transaction = \App\Models\OrderTransaction::where('delivery_man_id', $dm->id)
                        ->when($date, function($query)use($date){
                            return $query->whereDate('created_at', $date);
                        })->paginate(25)); ?>
                        <?php $__currentLoopData = $digital_transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($k+$digital_transaction->firstItem()); ?></td>
                                <td><a href="<?php echo e(route('admin.order.details',$dt->order_id)); ?>"><?php echo e($dt->order_id); ?></a></td>
                                <td><?php echo e($dt->original_delivery_charge); ?></td>
                                <td><?php echo e($dt->created_at->format('Y-m-d')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(!$digital_transaction): ?>
                    <div class="empty--data">
                        <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Body -->
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                                        
                    <div>
                        <?php echo $digital_transaction->links(); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    function request_alert(url, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/view/transaction.blade.php ENDPATH**/ ?>