<?php $__env->startSection('title','Customer Details'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-auto mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(__('messages.customer')); ?> <?php echo e(__('messages.id')); ?> #<?php echo e($customer['id']); ?></h1>
                    <span class="d-block">
                        <i class="tio-date-range"></i> <?php echo e(__('messages.joined_at')); ?> : <?php echo e(date('d M Y '.config('timeformat'),strtotime($customer['created_at']))); ?>

                    </span>
                </div>

                <div class="col-auto ml-auto">
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle mr-1"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']-1])); ?>"
                       data-toggle="tooltip" data-placement="top" title="Previous customer">
                        <i class="tio-arrow-backward"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']+1])); ?>" data-toggle="tooltip"
                       data-placement="top" title="Next customer">
                        <i class="tio-arrow-forward"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row mb-2 g-2">
            <!-- Collected Cash Card Example -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--2">
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/1.png')); ?>" alt="dashboard">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(__('messages.wallet')); ?> <?php echo e(__('messages.balance')); ?></div>
                    <div class="for-card-count"><?php echo e($customer->wallet_balance??0); ?></div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--3">
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/dashboard/3.png')); ?>" alt="dashboard">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(__('messages.loyalty_point')); ?> <?php echo e(__('messages.balance')); ?></div>
                    <div class="for-card-count"><?php echo e($customer->loyalty_point??0); ?></div>
                </div>
            </div>
        </div>

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-title">Order List <span class="badge badge-soft-secondary"><?php echo e(count($orders)); ?></span></h5>
                        <div>
                            <div class="input--group input-group">
                                <input type="text" id="column1_search" class="form-control form-control-sm"
                                            placeholder="Ex: Search Here by ID...">
                                <button type="button" class="btn btn--secondary">
                                    <i class="tio-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th class="text-center w-50p"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.id')); ?></th>
                                    <th class="w-50p"><?php echo e(__('messages.total')); ?> <?php echo e(__('messages.amount')); ?></th>
                                    <th class="text-center w-100px"><?php echo e(__('messages.action')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$orders->firstItem()); ?></td>
                                    <td class="table-column-pl-0 text-center">
                                        <a href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($order['order_amount'])); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                        <a class="btn btn-sm btn--warning btn-outline-warning action-btn"
                                                    href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>" title="<?php echo e(__('messages.view')); ?>"><i
                                                            class="tio-visible-outlined"></i></a>
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn" target="_blank"
                                                    href="<?php echo e(route('admin.order.generate-invoice',[$order['id']])); ?>" title="<?php echo e(__('messages.invoice')); ?>"><i
                                                            class="tio-print"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($orders) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                        <!-- Pagination -->
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                
                                <div>
                                    <?php echo $orders->links(); ?>

                                </div>
                            </div>
                        </div>
                        <!-- Pagination -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php if($customer): ?>
                                    <?php echo e($customer['f_name'].' '.$customer['l_name']); ?>

                                    <?php else: ?>
                                    Customer
                                <?php endif; ?>
                            </span>
                        </h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <?php if($customer): ?>
                        <div class="card-body">
                            <div class="media align-items-center customer--information-single" href="javascript:">
                                <div class="avatar avatar-circle">
                                    <img
                                        class="avatar-img"
                                        onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                        src="<?php echo e(asset('storage/app/public/profile/'.$customer->image)); ?>"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <ul class="list-unstyled m-0">
                                        <li class="pb-1">
                                            <i class="tio-email mr-2"></i>
                                            <?php echo e($customer['email']); ?>

                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <?php echo e($customer['phone']); ?>

                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-shopping-basket-outlined mr-2"></i>
                                            <?php echo e($customer->order_count); ?> <?php echo e(__('messages.orders')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5><?php echo e(__('messages.contact')); ?> <?php echo e(__('messages.info')); ?></h5>
                            </div>
                            <?php $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul class="list-unstyled list-unstyled-py-2">
                                    <?php if($address['contact_person_umber']): ?>
                                        <li>
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <?php echo e($address['contact_person_umber']); ?>

                                        </li>
                                    <?php endif; ?>
                                    <li class="quick--address-bar">
                                        <div class="quick-icon badge-soft-secondary">
                                            <i class="tio-home"></i>
                                        </div>
                                        <div class="info">
                                            <h6><?php echo e($address['address_type']); ?></h6>
                                            <a target="_blank" href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>" class="text--title">
                                                <?php echo e($address['address']); ?>

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                <?php endif; ?>
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/customer/customer-view.blade.php ENDPATH**/ ?>