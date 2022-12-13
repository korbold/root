<?php $__env->startSection('title',__('messages.account_transaction')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(asset('/public/assets/admin/img/collect-cash.png')); ?>" class="w-20px" alt="public">
            </div>
            <span>
                <?php echo e(translate('Cash Collection Transaction')); ?>

            </span>
        </h1>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(route('admin.account-transaction.store')); ?>" method='post' id="add_transaction">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="input-label" for="type"><?php echo e(__('messages.type')); ?><span class="input-label-secondary"></span></label>
                            <select name="type" id="type" class="form-control h--48px">
                                <option value="deliveryman"><?php echo e(__('messages.deliveryman')); ?></option>
                                <option value="restaurant"><?php echo e(__('messages.restaurant')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="restaurant"><?php echo e(__('messages.restaurant')); ?><span class="input-label-secondary"></span></label>
                            <select id="restaurant" name="restaurant_id" data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.restaurant')); ?>" onchange="getAccountData('<?php echo e(url('/')); ?>/admin/vendor/get-account-data/',this.value,'restaurant')" class="form-control h--48px" title="Select Restaurant" disabled>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="deliveryman"><?php echo e(__('messages.deliveryman')); ?><span class="input-label-secondary"></span></label>
                            <select id="deliveryman" name="deliveryman_id" data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.deliveryman')); ?>" onchange="getAccountData('<?php echo e(url('/')); ?>/admin/delivery-man/get-account-data/',this.value,'deliveryman')" class="form-control h--48px" title="Select deliveryman">

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="method"><?php echo e(__('messages.method')); ?><span class="input-label-secondary"></span></label>
                            <input class="form-control h--48px" type="text" name="method" id="method" required maxlength="191" placeholder="Ex : Cash">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="ref"><?php echo e(__('messages.reference')); ?><span class="input-label-secondary"></span></label>
                            <input  class="form-control h--48px" type="text" name="ref" id="ref" maxlength="191" placeholder="Ex : Collect Cash">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="input-label" for="amount"><?php echo e(__('messages.amount')); ?><span class="input-label-secondary" id="account_info"></span></label>
                            <input class="form-control h--48px" type="number" min=".01" step="0.01" name="amount" id="amount" max="999999999999.99" placeholder="Ex : 100">
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end">
                    <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                    <button type="submit" class="btn btn--primary"><?php echo e(__('messages.collect')); ?> <?php echo e(__('messages.cash')); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header py-2 border-0">
            <div class="search--button-wrapper">
                <h3 class="card-title">
                    <span><?php echo e(__('messages.transaction')); ?> <?php echo e(__('messages.table')); ?></span>
                    <span class="badge badge-soft-secondary" id="itemCount" ><?php echo e($account_transaction->total()); ?></span>
                </h3>
                <!-- Static Search Form -->
                <form action="javascript:" id="search-form" class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                        <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="Search by Reference" aria-label="Search" required="">
                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                    </div>
                    <!-- End Search -->
                </form>
                <!-- Static Search Form -->
                <!-- Static Export Button -->
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
                        
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.export-account-transaction', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                            <?php echo e(__('messages.excel')); ?>

                        </a>

                        
                        <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.export-account-transaction', ['type'=>'csv'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                            .<?php echo e(__('messages.csv')); ?>

                        </a>
                        
                    </div>
                </div>
                <!-- Static Export Button -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="datatable"
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>SL</th>
                            <th><?php echo e(__('messages.received_from')); ?></th>
                            <th><?php echo e(__('messages.type')); ?></th>
                            <th><?php echo e(__('messages.received_at')); ?></th>
                            <th><?php echo e(__('messages.amount')); ?></th>
                            <th><?php echo e(__('messages.reference')); ?></th>
                            <th class="text-center w-120px"><?php echo e(__('messages.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody id="set-rows">
                    <?php $__currentLoopData = $account_transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row"><?php echo e($k+$account_transaction->firstItem()); ?></td>
                            <td>
                                <?php if($at->restaurant): ?>
                                <a href="<?php echo e(route('admin.vendor.view',[$at->restaurant['id']])); ?>"><?php echo e(Str::limit($at->restaurant->name, 20, '...')); ?></a>
                                <?php elseif($at->deliveryman): ?>
                                <a href="<?php echo e(route('admin.delivery-man.preview',[$at->deliveryman->id])); ?>"><?php echo e($at->deliveryman->f_name); ?> <?php echo e($at->deliveryman->l_name); ?></a>
                                <?php else: ?>
                                    <?php echo e(__('messages.not_found')); ?>

                                <?php endif; ?>
                            </td>
                            <td><label class="text-uppercase"><?php echo e($at['from_type']); ?></label></td>
                            <td><?php echo e($at->created_at->format('Y-m-d '.config('timeformat'))); ?></td>
                            <td><?php echo e($at['amount']); ?></td>
                            <td><?php echo e($at['ref']); ?></td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a href="<?php echo e(route('admin.account-transaction.show',[$at['id']])); ?>"
                                    class="btn btn-sm btn--warning btn-outline-warning action-btn"><i class="tio-invisible"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($account_transaction) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer border-0 pt-0">
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                                        
                    <div>
                        <?php echo e($account_transaction->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        $('#type').on('change', function() {
            if($('#type').val() == 'restaurant')
            {
                $('#restaurant').removeAttr("disabled");
                $('#deliveryman').val("").trigger( "change" );
                $('#deliveryman').attr("disabled","true");
            }
            else if($('#type').val() == 'deliveryman')
            {
                $('#deliveryman').removeAttr("disabled");
                $('#restaurant').val("").trigger( "change" );
                $('#restaurant').attr("disabled","true");
            }
        });
    });
    $('#restaurant').select2({
        ajax: {
            url: '<?php echo e(url('/')); ?>/admin/vendor/get-restaurants',
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    $('#deliveryman').select2({
        ajax: {
            url: '<?php echo e(url('/')); ?>/admin/delivery-man/get-deliverymen',
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    function getAccountData(route, data_id, type)
    {
        $.get({
                url: route+data_id,
                dataType: 'json',
                success: function (data) {
                    $('#account_info').html('(<?php echo e(__('messages.cash_in_hand')); ?>: '+data.cash_in_hand+' <?php echo e(__('messages.earning_balance')); ?>: '+data.earning_balance+')');
                },
            });
    }
</script>
<script>
    $('#add_transaction').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('admin.account-transaction.store')); ?>',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('<?php echo e(__('messages.transaction_saved')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.href = '<?php echo e(route('admin.account-transaction.index')); ?>';
                    }, 2000);
                }
            }
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
            url: '<?php echo e(route('admin.search-account-transaction')); ?>',
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

    $('#reset_btn').click(function(){
            $('#restaurant').val(null).trigger('change');
            $('#deliveryman').val(null).trigger('change');
        })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/account/index.blade.php ENDPATH**/ ?>