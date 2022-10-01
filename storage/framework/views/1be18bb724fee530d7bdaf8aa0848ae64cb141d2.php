<?php $__env->startSection('title',$restaurant->name); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/admin/css/croppie.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h1 class="page-header-title text-break me-2">
                <i class="tio-shop"></i> <span><?php echo e($restaurant->name); ?></span>
            </h1>
            <?php if($restaurant->vendor->status): ?>
            <a href="<?php echo e(route('admin.vendor.edit',[$restaurant->id])); ?>" class="btn btn--primary my-2">
                <i class="tio-edit mr-2"></i> <?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.restaurant')); ?>

            </a>
            <?php else: ?>
                <div>
                    <?php if(!isset($restaurant->vendor->status)): ?>
                    <a class="btn btn--danger text-capitalize my-2"
                    onclick="request_alert('<?php echo e(route('admin.vendor.application',[$restaurant['id'],0])); ?>','<?php echo e(__('messages.you_want_to_deny_this_application')); ?>')"
                        href="javascript:"><?php echo e(__('messages.deny')); ?></a>
                    <?php endif; ?>
                    <a class="btn btn--primary text-capitalize my-2"
                    onclick="request_alert('<?php echo e(route('admin.vendor.application',[$restaurant['id'],1])); ?>','<?php echo e(__('messages.you_want_to_approve_this_application')); ?>')"
                        href="javascript:"><?php echo e(__('messages.approve')); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php if($restaurant->vendor->status): ?>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo e(route('admin.vendor.view', $restaurant->id)); ?>"><?php echo e(__('messages.overview')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'order'])); ?>"  aria-disabled="true"><?php echo e(__('messages.orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'product'])); ?>"  aria-disabled="true"><?php echo e(__('messages.foods')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'reviews'])); ?>"  aria-disabled="true"><?php echo e(__('messages.reviews')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'discount'])); ?>"  aria-disabled="true"><?php echo e(__('discounts')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transactions')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'settings'])); ?>"  aria-disabled="true"><?php echo e(__('messages.settings')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'conversations'])); ?>"  aria-disabled="true"><?php echo e(__('messages.conversations')); ?></a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
        <?php endif; ?>
    </div>
        <!-- End Page Header -->
    <!-- Page Heading -->
    <div class="row my-2 g-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="for-card col-md-4">
            <div class="card bg--1 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                    <div class="cash--subtitle">
                        <?php echo e(__('messages.collected_cash_by_restaurant')); ?>

                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <img class="cash-icon mr-3" src="<?php echo e(asset('/public/assets/admin/img/transactions/cash.png')); ?>" alt="transactions">
                        <h2

                            class="cash--title"><?php echo e(\App\CentralLogics\Helpers::format_currency($wallet->collected_cash)); ?>

                        </h2>
                    </div>
                </div>
                <div class="card-footer pt-0 bg-transparent">
                    <a class="btn btn-- bg--title h--45px w-100" href="<?php echo e(route('admin.account-transaction.index')); ?>" title="<?php echo e(__('messages.goto')); ?> <?php echo e(__('messages.account_transaction')); ?>"><?php echo e(__('messages.collect_cash_from_restaurant')); ?></a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row g-3">
                <!-- Panding Withdraw Card Example -->
                <div class="col-sm-6">
                    <div class="resturant-card  bg--2">
                        <h4 class="title"><?php echo e(\App\CentralLogics\Helpers::format_currency($wallet->pending_withdraw)); ?></h4>
                        <span class="subtitle"><?php echo e(__('messages.pending')); ?> <?php echo e(__('messages.withdraw')); ?></span>
                        <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/pending.png')); ?>" alt="transactions">
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-sm-6">
                    <div class="resturant-card  bg--3">
                        <h4 class="title"><?php echo e(\App\CentralLogics\Helpers::format_currency($wallet->total_withdrawn)); ?></h4>
                        <span class="subtitle"><?php echo e(__('messages.total')); ?> <?php echo e(__('messages.withdrawn')); ?> <?php echo e(__('messages.amount')); ?></span>
                        <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/withdraw-amount.png')); ?>" alt="transactions">
                    </div>
                </div>

                <!-- Collected Cash Card Example -->
                <div class="col-sm-6">
                    <div class="resturant-card  bg--5">
                        <h4 class="title"><?php echo e(\App\CentralLogics\Helpers::format_currency($wallet->balance)); ?></h4>
                        <span class="subtitle"><?php echo e(__('messages.withdraw_able_balance')); ?></span>
                        <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/withdraw-balance.png')); ?>" alt="transactions">
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-sm-6">
                    <div class="resturant-card  bg--1">
                        <h4 class="title"><?php echo e(\App\CentralLogics\Helpers::format_currency($wallet->total_earning)); ?></h4>
                        <span class="subtitle"><?php echo e(__('messages.total_earning')); ?></span>
                        <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/transactions/earning.png')); ?>" alt="transactions">
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="mt-4">
        <div id="restaurant_details" class="row g-3">
            <div class="col-lg-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h5 class="card-title m-0 d-flex align-items-center">
                            <span class="card-header-icon mr-2">
                                <i class="tio-shop-outlined"></i>
                            </span>
                            <span class="ml-1"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.info')); ?></span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            <div class="col-lg-6">
                                <div class="resturant--info-address">
                                    <div class="logo">
                                        <img onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/restaurant-default-image.png')); ?>'"
                                            src="<?php echo e(asset('storage/app/public/restaurant')); ?>/<?php echo e($restaurant->logo); ?>">
                                    </div>
                                    <ul class="address-info list-unstyled list-unstyled-py-3 text-dark">
                                        <li>
                                            <h5 class="name">
                                                <?php echo e($restaurant->name); ?>

                                            </h5>
                                        </li>
                                        <li>
                                            <i class="tio-city nav-icon"></i>
                                            <span class="pl-1">
                                                <?php echo e(__('messages.address')); ?> : <?php echo e($restaurant->address); ?>

                                            </span>
                                        </li>

                                        <li>
                                            <i class="tio-call-talking nav-icon"></i>
                                            <span class="pl-1">
                                                <?php echo e(__('messages.phone')); ?> : <?php echo e($restaurant->phone); ?>

                                            </span>
                                        </li>
                                        <li>
                                            <i class="tio-email nav-icon"></i>
                                            <span class="pl-1">
                                                <?php echo e(__('messages.email')); ?> : <?php echo e($restaurant->email); ?>

                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="map" class="single-page-map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title m-0 d-flex align-items-center">
                            <span class="card-header-icon mr-2">
                                <i class="tio-user"></i>
                            </span>
                            <span class="ml-1"><?php echo e(__('messages.owner')); ?> <?php echo e(__('messages.info')); ?></span>
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="resturant--info-address">
                            <div class="avatar avatar-xxl avatar-circle avatar-border-lg">
                                <img class="avatar-img" onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                            src="<?php echo e(asset('storage/app/public/vendor')); ?>/<?php echo e($restaurant->vendor->image); ?>" alt="Image Description">
                            </div>
                            <ul class="address-info address-info-2 list-unstyled list-unstyled-py-3 text-dark">
                                <li>
                                    <h5 class="name">
                                        <?php echo e($restaurant->vendor->f_name); ?> <?php echo e($restaurant->vendor->l_name); ?>

                                    </h5>
                                </li>
                                <li>
                                    <i class="tio-call-talking nav-icon"></i>
                                    <span class="pl-1">
                                        <?php echo e($restaurant->vendor->phone); ?>

                                    </span>
                                </li>
                                <li>
                                    <i class="tio-email nav-icon"></i>
                                    <span class="pl-1">
                                        <?php echo e($restaurant->vendor->email); ?>

                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title m-0 d-flex align-items-center">
                            <span class="card-header-icon mr-2">
                                <i class="tio-museum"></i>
                            </span>
                            <span class="ml-1"><?php echo e(__('messages.bank_info')); ?></span>
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <ul class="list-unstyled list-unstyled-py-3 text-dark">
                            <?php if($restaurant->vendor->bank_name): ?>
                            <li class="pb-1 pt-1">
                                <strong class="text--title"><?php echo e(__('messages.bank_name')); ?>:</strong> <?php echo e($restaurant->vendor->bank_name ? $restaurant->vendor->bank_name : 'No Data found'); ?>

                            </li>
                            <li class="pb-1 pt-1">
                                <strong class="text--title"><?php echo e(__('messages.branch')); ?>  :</strong> <?php echo e($restaurant->vendor->branch ? $restaurant->vendor->branch : 'No Data found'); ?>

                            </li>
                            <li class="pb-1 pt-1">
                                <strong class="text--title"><?php echo e(__('messages.holder_name')); ?> :</strong> <?php echo e($restaurant->vendor->holder_name ? $restaurant->vendor->holder_name : 'No Data found'); ?>

                            </li>
                            <li class="pb-1 pt-1">
                                <strong class="text--title"><?php echo e(__('messages.account_no')); ?>  :</strong> <?php echo e($restaurant->vendor->account_no ? $restaurant->vendor->account_no : 'No Data found'); ?>

                            </li>
                            <?php else: ?>
                            <li class="my-auto">
                                <center class="card-subtitle"><?php echo e(translate('messages.no_data_found')); ?></center>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <!-- Page level plugins -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&callback=initMap&v=3.45.8" ></script>
    <script>
        const myLatLng = { lat: <?php echo e($restaurant->latitude); ?>, lng: <?php echo e($restaurant->longitude); ?> };
        let map;
        initMap();
        function initMap() {
                 map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatLng,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "<?php echo e($restaurant->name); ?>",
            });
        }
    </script>
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

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    function request_alert(url, message) {
        Swal.fire({
            title: "<?php echo e(__('messages.are_you_sure')); ?>",
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: "<?php echo e(__('messages.no')); ?>",
            confirmButtonText: "<?php echo e(__('messages.yes')); ?>",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/vendor/view/index.blade.php ENDPATH**/ ?>