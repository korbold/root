<?php $__env->startSection('title','Vendor List'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title"><i class="tio-filter-list"></i> <?php echo e(__('messages.restaurants')); ?> <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($restaurants->total()); ?></span></h1>
            <div class="page-header-select-wrapper">
                <?php if($toggle_veg_non_veg): ?>
                <div class="select-item">
                <!-- Veg/NonVeg filter -->
                    <select name="category_id" onchange="set_filter('<?php echo e(url()->full()); ?>',this.value, 'type')" data-placeholder="<?php echo e(__('messages.all')); ?>" class="form-control w--sm-unset ml-auto">
                        <option value="all" <?php echo e($type=='all'?'selected':''); ?>><?php echo e(__('messages.all')); ?></option>
                        <option value="veg" <?php echo e($type=='veg'?'selected':''); ?>><?php echo e(__('messages.veg')); ?></option>
                        <option value="non_veg" <?php echo e($type=='non_veg'?'selected':''); ?>><?php echo e(__('messages.non_veg')); ?></option>
                    </select>
                <!-- End Veg/NonVeg filter -->
                </div>
                <?php endif; ?>
                <?php if(!isset(auth('admin')->user()->zone_id)): ?>
                    <div class="select-item">
                        <select name="zone_id" class="form-control js-select2-custom"
                                onchange="set_zone_filter('<?php echo e(route('admin.vendor.list')); ?>',this.value)">
                            <option selected disabled><?php echo e(translate('messages.select_zone')); ?></option>
                            <option value="all"><?php echo e(translate('messages.all_zones')); ?></option>
                            <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($z['id']); ?>" <?php echo e(isset($zone) && $zone->id == $z['id']?'selected':''); ?>>
                                    <?php echo e($z['name']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Resturent Card Wrapper -->
        <div class="row g-3 mb-3">
            <div class="col-xl-3 col-sm-6">
                <div class="resturant-card bg--1">
                    <?php ($total_retaurants = \App\Models\Restaurant::count()); ?>
                    <?php ($total_retaurants = isset($total_retaurants) ? $total_retaurants : 0); ?>
                    <h4 class="title"><?php echo e($total_retaurants); ?></h4>
                    <span class="subtitle"><?php echo e(translate('messages.total_restaurants')); ?></span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/resturant/map-pin.png')); ?>" alt="resturant">
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="resturant-card bg--2">
                    <?php ($active_restaurants = \App\Models\Restaurant::where(['status'=>1])->count()); ?>
                    <?php ($active_restaurants = isset($active_restaurants) ? $active_restaurants : 0); ?>
                    <h4 class="title"><?php echo e($active_restaurants); ?></h4>
                    <span class="subtitle"><?php echo e(translate('messages.active_restaurants')); ?></span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/resturant/active-rest.png')); ?>" alt="resturant">
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="resturant-card bg--3">
                    <?php ($inactive_restaurants = \App\Models\Restaurant::where(['status'=>0])->count()); ?>
                    <?php ($inactive_restaurants = isset($inactive_restaurants) ? $inactive_restaurants : 0); ?>
                    <h4 class="title"><?php echo e($inactive_restaurants); ?></h4>
                    <span class="subtitle"><?php echo e(translate('messages.inactive_restaurants')); ?></span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/resturant/inactive-rest.png')); ?>" alt="resturant">
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="resturant-card bg--4">
                    <?php ($data = \App\Models\Restaurant::where('created_at', '<=', now()->subDays(30)->toDateTimeString())->count()); ?>
                    <h4 class="title"><?php echo e($data); ?></h4>
                    <span class="subtitle"><?php echo e(translate('messages.newly_joined_restaurants')); ?></span>
                    <img class="resturant-icon" src="<?php echo e(asset('/public/assets/admin/img/resturant/new-rest.png')); ?>" alt="resturant">
                </div>
            </div>
        </div>
        <!-- Resturent Card Wrapper -->
        <!-- Transaction Information -->
        <ul class="transaction--information text-uppercase">
            <li class="text--info">
                <i class="tio-document-text-outlined"></i>
                <div>
                    <?php ($total_transaction = \App\Models\OrderTransaction::count()); ?>
                    <?php ($total_transaction = isset($total_transaction) ? $total_transaction : 0); ?>
                    <span><?php echo e(translate('messages.total_transactions')); ?></span> <strong><?php echo e($total_transaction); ?></strong>
                </div>
            </li>
            <li class="seperator"></li>
            <li class="text--success">
                <i class="tio-checkmark-circle-outlined success--icon"></i>
                <div>
                    <?php ($comission_earned = \App\Models\AdminWallet::sum('total_commission_earning')); ?>
                    <?php ($comission_earned = isset($comission_earned) ? $comission_earned : 0); ?>
                    <span><?php echo e(translate('messages.commission_earned')); ?></span> <strong><?php echo e(\App\CentralLogics\Helpers::format_currency($comission_earned)); ?></strong>
                </div>
            </li>
            <li class="seperator"></li>
            <li class="text--danger">
                <i class="tio-atm"></i>
                <div>
                    <?php ($restaurant_withdraws = \App\Models\WithdrawRequest::where(['approved'=>1])->sum('amount')); ?>
                    <?php ($restaurant_withdraws = isset($restaurant_withdraws) ? $restaurant_withdraws : 0); ?>
                    <span><?php echo e(translate('messages.total_restaurant_withdraws')); ?></span> <strong><?php echo e(\App\CentralLogics\Helpers::format_currency($restaurant_withdraws)); ?></strong>
                </div>
            </li>
        </ul>
        <!-- Transaction Information -->
        <!-- Resturent List -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Card Header -->

                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h3 class="card-title"><?php echo e(__('messages.restaurants')); ?> <?php echo e(__('messages.list')); ?></h3>
                            <form action="javascript:" id="search-form" class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                                <!-- Search -->
                                <?php echo csrf_field(); ?>
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="Ex : <?php echo e(__('messages.search')); ?> by Restaurant name of Phone number" aria-label="<?php echo e(__('messages.search')); ?>" required>
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                                </div>
                                <!-- End Search -->
                            </form>

                            <!-- Export Button Static -->
                            <div class="hs-unfold ml-3">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                                    data-hs-unfold-options='{
                                        "target": "#usersExportDropdown",
                                        "type": "css-animation"
                                    }'>
                                    <i class="tio-download-to mr-1"></i> <?php echo e(__('messages.export')); ?>

                                </a>

                                <div id="usersExportDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    
                                    <span class="dropdown-header"><?php echo e(__('messages.download')); ?> <?php echo e(__('messages.options')); ?></span>
                                    <a target="__blank" id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.vendor.restaurants-export', ['type'=>'excel'])); ?>">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                        <?php echo e(__('messages.excel')); ?>

                                    </a>

                                    <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.vendor.restaurants-export', ['type'=>'csv'])); ?>">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                                    alt="Image Description">
                                                    <?php echo e(__('messages.csv')); ?>

                                    </a>



                                    
                                </div>
                            </div>
                            <!-- Export Button Static -->
                        </div>
                    </div>
                    <!-- Card Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom resturant-list-table">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false

                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 90px;" class="text-uppercase"><?php echo e(__('messages.sl')); ?></th>
                                <th style="width: 155px;max-width:220px"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.info')); ?></th>
                                <th style="width: 230px;" class="text-center"><?php echo e(__('messages.owner')); ?> <?php echo e(__('messages.info')); ?> </th>
                                <th style="width: 130px;"><?php echo e(__('messages.zone')); ?></th>
                                <th style="width: 100px;"><?php echo e(__('messages.status')); ?></th>
                                <th style="width: 87px;text-align:center"><?php echo e(__('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$restaurants->firstItem()); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.vendor.view', $dm->id)); ?>" alt="view restaurant" class="table-rest-info">
                                        <img
                                                onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                src="<?php echo e(asset('storage/app/public/restaurant')); ?>/<?php echo e($dm['logo']); ?>">
                                            <div class="info">
                                                <span class="d-block text-body">
                                                    <?php echo e(Str::limit($dm->name,20,'...')); ?><br>
                                                    <!-- Rating -->
                                                    <span class="rating">
                                                        <?php ($restaurant_rating = $dm['rating']==null ? 0 : (array_sum($dm['rating']))/5 ); ?>
                                                        <i class="tio-star"></i> <?php echo e($restaurant_rating); ?>

                                                    </span>
                                                    <!-- Rating -->
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="d-block owner--name text-center">
                                            <?php echo e($dm->vendor->f_name.' '.$dm->vendor->l_name); ?>

                                        </span>
                                        <span class="d-block font-size-sm text-center">
                                            <?php echo e($dm['phone']); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php echo e($dm->zone?$dm->zone->name:__('messages.zone').' '.__('messages.deleted')); ?>

                                        
                                    </td>
                                    <td>
                                        <?php if(isset($dm->vendor->status)): ?>
                                            <?php if($dm->vendor->status): ?>
                                            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($dm->id); ?>">
                                                <input type="checkbox" onclick="status_change_alert('<?php echo e(route('admin.vendor.status',[$dm->id,$dm->status?0:1])); ?>', '<?php echo e(__('messages.you_want_to_change_this_restaurant_status')); ?>', event)" class="toggle-switch-input" id="stocksCheckbox<?php echo e($dm->id); ?>" <?php echo e($dm->status?'checked':''); ?>>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <?php else: ?>
                                            <span class="badge badge-soft-danger"><?php echo e(__('messages.denied')); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge badge-soft-danger"><?php echo e(__('messages.pending')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="<?php echo e(route('admin.vendor.edit',[$dm['id']])); ?>" title="<?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.restaurant')); ?>"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn--warning btn-outline-warning action-btn"
                                                href="<?php echo e(route('admin.vendor.view',[$dm['id']])); ?>" title="<?php echo e(__('messages.view')); ?> <?php echo e(__('messages.restaurant')); ?>"><i class="tio-invisible"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($restaurants) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div>
                                    <?php echo $restaurants->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- Resturent List -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
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
                    location.href=url;
                }
            })
        }
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

            $('#column3_search').on('keyup', function () {
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
    </script>

    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.vendor.search')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.total);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/vendor/list.blade.php ENDPATH**/ ?>