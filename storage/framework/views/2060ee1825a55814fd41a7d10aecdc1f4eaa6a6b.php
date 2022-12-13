<?php $__env->startSection('title',__('messages.deliverymen')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-12 mb-2">
                    <h1 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/delivery-man.png')); ?>" alt="public">
                        </div>
                        <span>
                            <?php echo e(translate('Deliveryman List')); ?>

                        </span>
                    </h1>
                </div>
                
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header py-2">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"><?php echo e(__('messages.deliveryman')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($delivery_men->total()); ?></span></h5>
                            <form action="javascript:" id="search-form" >
                                            <!-- Search -->
                                <?php echo csrf_field(); ?>
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="Search by name or restaurant..." aria-label="Search" required>
                                    <button type="submit" class="btn btn--secondary">
                                        <i class="tio-search"></i>
                                    </button>

                                </div>
                                <!-- End Search -->
                            </form>

                            <!-- Unfold -->
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
                                    <a id="export-excel" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                             alt="Image Description">
                                        <?php echo e(__('messages.excel')); ?>

                                    </a>
                                    <a id="export-csv" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                             alt="Image Description">
                                        .<?php echo e(__('messages.csv')); ?>

                                    </a>
                                    
                                </div>
                            </div>
                            <!-- Unfold -->
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom fz--14px">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th class="text-capitalize">SL</th>
                                <th class="text-capitalize w-20p"><?php echo e(__('messages.name')); ?></th>
                                <th class="text-capitalize">Contact Info</th>
                                <th class="text-capitalize"><?php echo e(__('messages.zone')); ?></th>
                                <th class="text-capitalize text-center">Total Orders</th>
                                <th class="text-capitalize"><?php echo e(__('messages.availability')); ?> <?php echo e(__('messages.status')); ?></th>
                                <th class="text-capitalize text-center w-110px"><?php echo e(__('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $delivery_men; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$delivery_men->firstItem()); ?></td>
                                    <td>
                                        <a class="table-rest-info" href="<?php echo e(route('admin.delivery-man.preview',[$dm['id']])); ?>">
                                            <img onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                                    src="<?php echo e(asset('storage/app/public/delivery-man')); ?>/<?php echo e($dm['image']); ?>" alt="<?php echo e($dm['f_name']); ?> <?php echo e($dm['l_name']); ?>">
                                            <div class="info">
                                                <h5 class="text-hover-primary mb-0"><?php echo e($dm['f_name'].' '.$dm['l_name']); ?></h5>
                                                <span class="d-block text-body">
                                                    <!-- Rating -->
                                                    <span class="rating">
                                                        <i class="tio-star"></i> <?php echo e(count($dm->rating)>0?number_format($dm->rating[0]->average, 1, '.', ' '):0); ?>

                                                    </span>
                                                    <!-- Rating -->
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="deco-none" href="tel:<?php echo e($dm['phone']); ?>"><?php echo e($dm['phone']); ?></a>
                                    </td>
                                    <td>
                                        <?php if($dm->zone): ?>
                                        <span><?php echo e($dm->zone->name); ?></span>
                                        <?php else: ?>
                                        <span><?php echo e(__('messages.zone').' '.__('messages.deleted')); ?></span>
                                        <?php endif; ?>
                                        
                                    </td>
                                    <!-- Static Data -->
                                    <td class="text-center">
                                        <div class="pr-3">
                                            <?php echo e($dm->orders ? count($dm->orders):0); ?>

                                        </div>
                                    </td>
                                    <!-- Static Data -->
                                    <td>
                                        <div>
                                            <!-- Status -->
                                            Currenty Assigned Orders : <?php echo e($dm->current_orders); ?>

                                            <!-- Status -->
                                        </div>
                                        <?php if($dm->application_status == 'approved'): ?>
                                            <?php if($dm->active): ?>
                                            <div>
                                                Active Status : <strong class="text-primary text-capitalize"><?php echo e(__('messages.online')); ?></strong>
                                            </div>
                                            <?php else: ?>
                                            <div>
                                                Active Status : <strong class="text-secondary text-capitalize"><?php echo e(__('messages.offline')); ?></strong>
                                            </div>
                                            <?php endif; ?>
                                        <?php elseif($dm->application_status == 'denied'): ?>
                                            <div>
                                                Active Status : <strong class="text-danger text-capitalize"><?php echo e(__('messages.denied')); ?></strong>
                                            </div>
                                        <?php else: ?>
                                            <div>
                                                Active Status : <strong class="text-info text-capitalize"><?php echo e(__('messages.pending')); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn" href="<?php echo e(route('admin.delivery-man.edit',[$dm['id']])); ?>" title="<?php echo e(__('messages.edit')); ?>"><i class="tio-edit"></i></a>
                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:" onclick="form_alert('delivery-man-<?php echo e($dm['id']); ?>','Want to remove this deliveryman ?')" title="<?php echo e(__('messages.delete')); ?>"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.delivery-man.delete',[$dm['id']])); ?>" method="post" id="delivery-man-<?php echo e($dm['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <?php if(count($delivery_men) === 0): ?>
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
                                        <?php echo $delivery_men->links(); ?>

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
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.delivery-man.search')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.count);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/list.blade.php ENDPATH**/ ?>