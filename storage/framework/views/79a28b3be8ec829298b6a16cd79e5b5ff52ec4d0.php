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
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transaction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'timelog'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.timelog')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'conversation'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.conversations')); ?></a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
        </div>
        <!-- End Page Header -->
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5 mt-2">
            <div class="card-header py-2">
`               <form class="search--button-wrapper" action="<?php echo e(url()->current()); ?>">
                    <h5 class="card-title"><?php echo e(translate('messages.order')); ?> <?php echo e(translate('messages.transactions')); ?></h5>
                    <div>
                        <input type="date" name="from" id="from" <?php echo e(request('from')?'value='.request('from'):''); ?>

                                class="form-control" required>
                    </div>
                    <div>
                        <input type="date" name="to" id="to" <?php echo e(request('to')?'value='.request('to'):''); ?>

                                class="form-control" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('messages.show')); ?></button>
                    </div>
                </form>
            </div>
            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap justify-content-between table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('sl')); ?></th>
                                <th><?php echo e(translate('messages.date')); ?></th>
                                <th><?php echo e(translate('messages.active_time')); ?> (<?php echo e(translate('H:M')); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $timelogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$timelog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($key+$timelogs->firstItem()); ?></td>
                                <td><?php echo e($timelog->date); ?></td>
                                <td><?php echo e(str_pad((int)($timelog->working_hour/60), 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad((int)($timelog->working_hour % 60), 2, '0', STR_PAD_LEFT)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(count($timelogs) === 0): ?>
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
            <div class="card-footer">
                <?php echo $timelogs->links(); ?>

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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/view/timelog.blade.php ENDPATH**/ ?>