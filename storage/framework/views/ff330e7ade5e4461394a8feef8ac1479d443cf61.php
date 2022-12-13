<?php $__env->startSection('title','Campaign view'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-break"><?php echo e($campaign->title); ?></h1>
        </div>
        <!-- End Page Header -->
        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <!-- Body -->
            <div class="card-body">
                <div class="row align-items-md-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                            <img class="rounded initial-13" src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($campaign->image); ?>"
                                 onerror="this.src='<?php echo e(asset('/public/assets/admin/img/900x400/img1.png')); ?>'"
                                 alt="Image Description">
                    </div>
                    <div class="col-md-8">
                        <h4><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?> : </h4>
                        <p><?php echo e($campaign->description); ?></p>

                        <form action="<?php echo e(route('admin.campaign.addrestaurant',$campaign->id)); ?>" id="restaurant-add-form" method="POST">
                            <?php echo csrf_field(); ?>
                            <!-- Search -->
                            <div class="d-flex flex-wrap g-2">
                                <?php ($allrestaurants=App\Models\Restaurant::all()); ?>
                                <div class="flex-grow-1">
                                    <select name="restaurant_id" id="restaurant_id" class="form-control h--45px" required>
                                        <option value="" selected disabled>Select Restaurant</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $allrestaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php if(!in_array($restaurant->id, $restaurant_ids)): ?>
                                            <option value="<?php echo e($restaurant->id); ?>" ><?php echo e($restaurant->name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value=""><?php echo e(translate('no_data_found')); ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn--primary"><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.restaurant')); ?></button>
                                </div>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>

                </div>
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Table -->
                    <div class="card-header border-0 search--button-wrapper">
                        <h5 class="card-title"></h5>
                        <form action="javascript:" id="search-form">
                            <!-- Search -->
                            <div class="input--group input-group input-group-merge input-group-flush">
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="<?php echo e(__('messages.search')); ?>" aria-label="Search" required>
                                <button type="submit" class="btn btn--secondary">
                                    <i class="tio-search"></i>
                                </button>

                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                
                                <th class="w-15p"><?php echo e(__('messages.restaurant')); ?></th>
                                <th><?php echo e(__('messages.owner')); ?></th>
                                <th><?php echo e(__('messages.email')); ?></th>
                                <th><?php echo e(__('messages.phone')); ?></th>
                                <th><?php echo e(__('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
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
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/campaign/basic/view.blade.php ENDPATH**/ ?>