<?php $__env->startSection('title',translate('Delivery Man Preview')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="card mb-3">
            <div class="card-header border-0 pb-0">
                <h1 class="page-header-title">
                    <span class="page-header-icon">
                        <i class="tio-account-square-outlined"></i>
                    </span>
                    <span><?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.details')); ?></span>
                </h1>
            </div>
        <!-- End Page Header -->
            <div class="card-body pt-2">
                <div>
                    <div class="mb-4">
                        <?php if($dm->application_status == 'approved'): ?>
                        <div class="js-nav-scroller hs-nav-scroller-horizontal">
                            <!-- Nav -->
                            <ul class="nav nav-tabs page-header-tabs mt-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'info'])); ?>"  aria-disabled="true"><?php echo e(__('messages.info')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transaction')); ?></a>
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
                        <?php else: ?>
                        <div class="btn--container justify-content-end">
                            <a class="btn btn-primary text-capitalize font-weight-bold"
                            onclick="request_alert('<?php echo e(route('admin.delivery-man.application',[$dm['id'],'approved'])); ?>','<?php echo e(__('messages.you_want_to_approve_this_application')); ?>')"
                                href="javascript:"><?php echo e(__('messages.approve')); ?></a>
                            <?php if($dm->application_status !='denied'): ?>
                            <a class="btn btn-danger text-capitalize font-weight-bold"
                            onclick="request_alert('<?php echo e(route('admin.delivery-man.application',[$dm['id'],'denied'])); ?>','<?php echo e(__('messages.you_want_to_deny_this_application')); ?>')"
                                href="javascript:"><?php echo e(__('messages.deny')); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-sm-6 col-md-4">
                            <div class="resturant-card bg--2">
                                <h2 class="title">
                                    <?php echo e($dm->orders->count()); ?>

                                </h2>
                                <h5 class="subtitle">
                                    <?php echo e(__('messages.total')); ?> <?php echo e(__('messages.delivered')); ?> <?php echo e(__('messages.orders')); ?>

                                </h5>
                                <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/tick.png')); ?>" alt="img">
                            </div>
                        </div>

                        <!-- Collected Cash Card Example -->
                        <div class="col-sm-6 col-md-4">
                            <div class="resturant-card bg--3">
                                <h2 class="title">
                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($dm->wallet?$dm->wallet->collected_cash:0.0)); ?>

                                </h2>
                                <h5 class="subtitle">
                                    <?php echo e(__('messages.cash_in_hand')); ?>

                                </h5>
                                <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/withdraw-amount.png')); ?>" alt="transactions">
                            </div>
                        </div>

                        <!-- Total Earning Card Example -->
                        <div class="col-sm-6 col-md-4">
                            <div class="resturant-card bg--1">
                                <h2 class="title">
                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($dm->wallet?$dm->wallet->total_earning:0.00)); ?>

                                </h2>
                                <h5 class="subtitle">
                                    <?php echo e(__('messages.total_earning')); ?>

                                </h5>
                                <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/pending.png')); ?>" alt="transactions">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="search--button-wrapper">
                    <h5 class="page-header-title delivery--man-single-name align-items-center mr-auto">
                        <?php echo e($dm['f_name'].' '.$dm['l_name']); ?>


                        (<?php if($dm->zone): ?>
                            <?php echo e($dm->zone->name); ?>

                        <?php else: ?> <?php echo e(__('messages.zone').' '.__('messages.deleted')); ?>

                        <?php endif; ?> )
                        <?php if($dm->application_status=='approved'): ?>
                            <?php if($dm['status']): ?>
                                <?php if($dm['active']): ?>
                                    <label class="badge badge-soft-primary mb-0 ml-1"><?php echo e(__('messages.online')); ?></label>
                                <?php else: ?>
                                    <label class="badge badge-soft-danger mb-0 ml-1"><?php echo e(__('messages.offline')); ?></label>
                                <?php endif; ?>
                            <?php else: ?>
                            <span class="badge badge-danger"><?php echo e(__('messages.suspended')); ?></span>
                            <?php endif; ?>

                        <?php else: ?>
                        <label class="m-0 badge badge-soft-<?php echo e($dm->application_status=='pending'?'info':'danger'); ?>"><?php echo e(__('messages.'.$dm->application_status)); ?></label>
                        <?php endif; ?>
                    </h5>
                    <?php if($dm->application_status=='approved'): ?>
                    <div class="hs-unfold">
                        <a  href="javascript:"  onclick="request_alert('<?php echo e(route('admin.delivery-man.status',[$dm['id'],$dm->status?0:1])); ?>','<?php echo e($dm->status?__('messages.you_want_to_suspend_this_deliveryman'):__('messages.you_want_to_unsuspend_this_deliveryman')); ?>')" class="btn <?php echo e($dm->status?'btn--danger':'btn--primary'); ?> mr-2">
                                <?php echo e($dm->status?__('messages.suspend_this_delivery_man'):__('messages.unsuspend_this_delivery_man')); ?>

                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="hs-unfold">
                        <div class="dropdown">
                            <button class="btn btn--reset initial-21 dropdown-toggle w-100" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <?php echo e(__('messages.type')); ?> (<?php echo e($dm->earning?__('messages.freelancer'):__('messages.salary_based')); ?>)
                            </button>
                            <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item <?php echo e($dm->earning?'active':''); ?>"
                                onclick="request_alert('<?php echo e(route('admin.delivery-man.earning',[$dm['id'],1])); ?>','<?php echo e(__('messages.want_to_enable_earnings')); ?>')"
                                    href="javascript:"><?php echo e(__('messages.freelancer')); ?></a>
                                <a class="dropdown-item <?php echo e($dm->earning?'':'active'); ?>"
                                onclick="request_alert('<?php echo e(route('admin.delivery-man.earning',[$dm['id'],0])); ?>','<?php echo e(__('messages.want_to_disable_earnings')); ?>')"
                                    href="javascript:"><?php echo e(__('messages.salary_based')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Body -->
            <div class="card-body">
                <div class="row gy-3 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="avatar avatar-xxl avatar-4by3 mr-4 mw-120px initial-22"
                                 onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                 src="<?php echo e(asset('storage/app/public/delivery-man')); ?>/<?php echo e($dm['image']); ?>"
                                 alt="Image Description">
                            <div class="d-block">
                                <div class="rating--review">
                                    <h1 class="title"><?php echo e(count($dm->rating)>0?number_format($dm->rating[0]->average, 1):0); ?><span class="out-of">/5</span></h1>
                                    <?php if(count($dm->rating)>0): ?>
                                    <?php if($dm->rating[0]->average == 5): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 5 && $dm->rating[0]->average > 4.5): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-half"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 4.5 && $dm->rating[0]->average > 4): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 4 && $dm->rating[0]->average > 3): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 3 && $dm->rating[0]->average > 2): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 2 && $dm->rating[0]->average > 1): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average < 1 && $dm->rating[0]->average > 0): ?>
                                    <div class="rating">
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average == 1): ?>
                                    <div class="rating">
                                        <span><i class="tio-star"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php elseif($dm->rating[0]->average == 0): ?>
                                    <div class="rating">
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                        <span><i class="tio-star-outlined"></i></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="info">
                                        
                                        <span><?php echo e($dm->reviews->count()); ?> <?php echo e(__('messages.reviews')); ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled list-unstyled-py-2 mb-0 rating--review-right py-3">

                        <?php ($total=$dm->reviews->count()); ?>
                        <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($five=\App\CentralLogics\Helpers::dm_rating_count($dm['id'],5)); ?>
                                <span class="progress-name mr-3">Excellent</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($five/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($five/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3"><?php echo e($five); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($four=\App\CentralLogics\Helpers::dm_rating_count($dm['id'],4)); ?>
                                <span class="progress-name mr-3">Good</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($four/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($four/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3"><?php echo e($four); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($three=\App\CentralLogics\Helpers::dm_rating_count($dm['id'],3)); ?>
                                <span class="progress-name mr-3">Average</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($three/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($three/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3"><?php echo e($three); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($two=\App\CentralLogics\Helpers::dm_rating_count($dm['id'],2)); ?>
                                <span class="progress-name mr-3">Below Average</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($two/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($two/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3"><?php echo e($two); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($one=\App\CentralLogics\Helpers::dm_rating_count($dm['id'],1)); ?>
                                <span class="progress-name mr-3">Poor</span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($one/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($one/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ml-3"><?php echo e($one); ?></span>
                            </li>
                            <!-- End Review Ratings -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="card">
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap card-table"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0, 3, 6],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(__('messages.reviewer')); ?></th>
                        <th>Order ID</th>
                        <th><?php echo e(__('messages.review')); ?></th>
                        <th><?php echo e(__('messages.date')); ?></th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <tr>
                            <td>
                                <?php if($review->customer): ?>
                                <a class="d-flex align-items-center"
                                   href="<?php echo e(route('admin.customer.view',[$review['user_id']])); ?>">
                                    <div class="avatar rounded">
                                        <img class="avatar-img" width="75" height="75"
                                             onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                             src="<?php echo e(asset('storage/app/public/profile/'.$review->customer->image)); ?>"
                                             alt="Image Description">
                                    </div>
                                    <div class="ml-3">
                                    <span class="d-block h5 text-hover-primary mb-0"><?php echo e($review->customer['f_name']." ".$review->customer['l_name']); ?> <i
                                            class="tio-verified text-primary" data-toggle="tooltip" data-placement="top"
                                            title="Verified Customer"></i></span>
                                        <span class="d-block font-size-sm text-body"><?php echo e($review->customer->email); ?></span>
                                    </div>
                                </a>
                                <?php else: ?>
                                <?php echo e(translate('messages.customer_not_found')); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.order.details',['id'=>$review->order_id])); ?>"><?php echo e($review->order_id); ?></a>
                            </td>
                            <td>
                                <div class="text-wrap initial-23">
                                    <label class="rating m-0">
                                        <?php echo e($review->rating); ?> <i class="tio-star"></i>
                                    </label>
                                    <p class="mb-0">
                                        <?php echo e($review['comment']); ?>

                                    </p>
                                </div>
                            </td>
                            
                            <td>
                                <?php echo e(date('d M Y',strtotime($review->created_at))); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($reviews) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            </div>
            <!-- End Table -->

            <!-- Footer -->
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        
                        <div>
                            <?php echo $reviews->links(); ?>

                        </div>
                    </div>
                </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    function request_alert(url, message) {
        Swal.fire({
            title: '<?php echo e(__('messages.are_you_sure')); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '<?php echo e(__('messages.no')); ?>',
            confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/view/info.blade.php ENDPATH**/ ?>