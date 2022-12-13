<?php $__env->startSection('title','Order List'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
// dd(str_replace('_',' ',$status))
?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pt-0 pb-2">
            <div class="d-flex flex-wrap justify-content-between">
                <h2 class="page-header-title align-items-center text-capitalize py-2 mr-2">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <?php if(str_replace('_',' ',$status) == 'All'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Pending'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/pending.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Confirmed'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/confirm.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Cooking'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/cooking.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Ready for delivery'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Food on the way'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Delivered'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Refunded'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public" style="max-width:24px">
                        <?php elseif(str_replace('_',' ',$status) == 'Scheduled'): ?>
                            <img src="<?php echo e(asset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public" style="max-width:24px">
                        <?php endif; ?>
                    </div>
                    <span>
                        <?php echo e(str_replace('_',' ',$status)); ?> <?php echo e(__('messages.orders')); ?> <span class="badge badge-soft-dark ml-2"><?php echo e($orders->total()); ?></span>
                    </span>
                </h2>
            </div>
        </div>
        <!-- End Page Header -->


        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-end max-sm-flex-100">
                    <form action="javascript:" id="search-form">
                        <?php echo csrf_field(); ?>
                        <!-- Search -->
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="Ex : Search by Order Id" aria-label="<?php echo e(__('messages.search')); ?>" required>
                            <button type="submit" class="btn btn--secondary">
                                <i class="tio-search"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="d-sm-flex justify-content-sm-end align-items-sm-center" style="margin:0 !important">

                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-download-to mr-1"></i> <?php echo e(__('messages.export')); ?>

                            </a>

                            <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header"><?php echo e(__('messages.options')); ?></span>
                                <a id="export-copy" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/copy.svg"
                                            alt="Image Description">
                                    <?php echo e(__('messages.copy')); ?>

                                </a>
                                <a id="export-print" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/print.svg"
                                            alt="Image Description">
                                    <?php echo e(__('messages.print')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                                <span
                                    class="dropdown-header"><?php echo e(__('messages.download')); ?> <?php echo e(__('messages.options')); ?></span>
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
                                <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/pdf.svg"
                                            alt="Image Description">
                                    <?php echo e(__('messages.pdf')); ?>

                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->

                        <!-- Unfold -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#showHideDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-table mr-1"></i> <?php echo e(__('messages.column')); ?> <span
                                    class="badge badge-soft-dark rounded-circle ml-1"></span>
                            </a>

                            <div id="showHideDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card"
                                    style="width: 15rem;">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2">
                                                <?php echo e(__('messages.order')); ?>

                                                ID
                                            </span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_order">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_order" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(__('messages.date')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_date">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_date" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(__('messages.customer')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm"
                                                    for="toggleColumn_customer">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_customer" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(__('messages.total')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_total">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_total" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.status')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_order_status">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_order_status" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="mr-2"><?php echo e(__('messages.actions')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm"
                                                    for="toggleColumn_actions">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_actions" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%"
                       data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                    <thead class="thead-light">
                    <tr>
                        <th style="width:60px">
                            SL
                        </th>
                        <th style="width:90px" class="table-column-pl-0"><?php echo e(__('messages.order')); ?> ID</th>
                        <th style="width:140px"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.date')); ?></th>
                        <th style="width:140px"><?php echo e(__('messages.customer')); ?> Info</th>
                        <th style="width:100px"><?php echo e(__('messages.total')); ?> <?php echo e(__('messages.amount')); ?></th>
                        <th style="width:100px" class="text-center"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.status')); ?></th>
                        <th style="width:100px" class="text-center"><?php echo e(__('messages.actions')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                            <td class="">
                                <?php echo e($key+$orders->firstItem()); ?>

                            </td>
                            <td class="table-column-pl-0">
                                <a href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>" class="text-hover"><?php echo e($order['id']); ?></a>
                            </td>
                            <td>
                                <span class="d-block">
                                    <?php echo e(date('d M Y',strtotime($order['created_at']))); ?>

                                </span>
                                <span class="d-block text-uppercase">
                                    <?php echo e(date(config('timeformat'),strtotime($order['created_at']))); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($order->customer): ?>
                                    <a class="text-body text-capitalize"
                                       href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>">
                                       <span class="d-block font-semibold">
                                            <?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?>

                                       </span>
                                       <span class="d-block">
                                            <?php echo e($order->customer['phone']); ?>

                                       </span>
                                    </a>
                                <?php else: ?>
                                    <label
                                        class="badge badge-danger"><?php echo e(__('messages.invalid')); ?> <?php echo e(__('messages.customer')); ?> <?php echo e(__('messages.data')); ?></label>
                                <?php endif; ?>
                            </td>
                            <td>


                                <div class="text-right" style="max-width:85px">
                                    <div>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($order['order_amount'])); ?>

                                    </div>
                                    <?php if($order->payment_status=='paid'): ?>
                                    <strong class="text-success">
                                        <?php echo e(__('messages.paid')); ?>

                                    </strong>
                                    <?php else: ?>
                                        <strong class="text-danger">
                                            <?php echo e(__('messages.unpaid')); ?>

                                        </strong>
                                    <?php endif; ?>
                                </div>

                            </td>
                            <td class="text-capitalize text-center">
                                <?php if($order['order_status']=='pending'): ?>
                                    <span class="badge badge-soft-info mb-1">
                                        <?php echo e(__('messages.pending')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='confirmed'): ?>
                                    <span class="badge badge-soft-info mb-1">
                                      <?php echo e(__('messages.confirmed')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='processing'): ?>
                                    <span class="badge badge-soft-warning mb-1">
                                      <?php echo e(__('messages.processing')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='picked_up'): ?>
                                    <span class="badge badge-soft-warning mb-1">
                                      <?php echo e(__('messages.out_for_delivery')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='delivered'): ?>
                                    <span class="badge badge-soft-success mb-1">
                                      <?php echo e(__('messages.delivered')); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger mb-1">
                                        <?php echo e(str_replace('_',' ',$order['order_status'])); ?>

                                    </span>
                                <?php endif; ?>

                                <div class="text-capitalze" style="opacity:.7">
                                    <?php if($order['order_type']=='take_away'): ?>
                                        <span>
                                            <?php echo e(__('messages.take_away')); ?>

                                        </span>
                                        <?php else: ?>
                                        <span>
                                            <?php echo e(__('messages.delivery')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--warning btn-outline-warning" href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>"><i class="tio-visible-outlined"></i></a>
                                    <a class="btn action-btn btn--primary btn-outline-primary" target="_blank" href="<?php echo e(route('vendor.order.generate-invoice',[$order['id']])); ?>"><i class="tio-print"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(count($orders) === 0): ?>
            <div class="empty--data">
                <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                <h5>
                    <?php echo e(translate('no_data_found')); ?>

                </h5>
            </div>
            <?php endif; ?>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    

                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <?php echo $orders->links(); ?>

                            
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="<?php echo e(asset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">No data to show</p>' +
                        '</div>'
                }
            });

            $('#export-copy').click(function () {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function () {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function () {
                datatable.button('.buttons-csv').trigger()
            });

            $('#export-pdf').click(function () {
                datatable.button('.buttons-pdf').trigger()
            });

            $('#export-print').click(function () {
                datatable.button('.buttons-print').trigger()
            });

            $('#toggleColumn_order').change(function (e) {
                datatable.columns(1).visible(e.target.checked)
            })

            $('#toggleColumn_date').change(function (e) {
                datatable.columns(2).visible(e.target.checked)
            })

            $('#toggleColumn_customer').change(function (e) {
                datatable.columns(3).visible(e.target.checked)
            })

            $('#toggleColumn_order_status').change(function (e) {
                datatable.columns(5).visible(e.target.checked)
            })


            $('#toggleColumn_total').change(function (e) {
                datatable.columns(4).visible(e.target.checked)
            })

            $('#toggleColumn_actions').change(function (e) {
                datatable.columns(6).visible(e.target.checked)
            })


            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                var tagify = $.HSCore.components.HSTagify.init($(this));
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
                url: '<?php echo e(route('vendor.order.search')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.card-footer').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/vendor-views/order/list.blade.php ENDPATH**/ ?>