<?php $__env->startSection('title',__('messages.deliverymen_earning_provide')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <!-- <h4 class=" mb-0 text-black-50"><?php echo e(__('messages.account_transaction')); ?></h4> -->
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <san class="card-header-icon">
                    <i class="tio-money"></i>
                </san>
                <span>
                    <?php echo e(__('messages.provide')); ?> <?php echo e(__('messages.deliverymen')); ?> <?php echo e(__('messages.earning')); ?>

                </span>
            </h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.provide-deliveryman-earnings.store')); ?>" method='post' id="add_transaction">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="deliveryman"><?php echo e(__('messages.deliveryman')); ?><span class="input-label-secondary"></span></label>
                            <select id="deliveryman" name="deliveryman_id" data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.deliveryman')); ?>" onchange="getAccountData('<?php echo e(url('/')); ?>/admin/delivery-man/get-account-data/',this.value,'deliveryman')" class="form-control h--45px" title="Select deliveryman">

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="amount"><?php echo e(__('messages.amount')); ?><span class="input-label-secondary" id="account_info"></span></label>
                            <input class="form-control h--45px" type="number" min="1" step="0.01" name="amount" id="amount" max="999999999999.99" placeholder="Ex : 100">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="method"><?php echo e(__('messages.method')); ?><span class="input-label-secondary"></span></label>
                            <input class="form-control h--45px" type="text" name="method" id="method" required maxlength="191" placeholder="Ex : Cash">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="ref"><?php echo e(__('messages.reference')); ?><span class="input-label-secondary"></span></label>
                            <input  class="form-control h--45px" type="text" name="ref" id="ref" maxlength="191" placeholder="Ex : Collect Cash">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="btn--container justify-content-end">
                        <button class="btn btn--reset" type="reset"><?php echo e(__('messages.reset')); ?></button>
                        <button class="btn btn--primary" type="submit"><?php echo e(__('messages.save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 py-2">
                    <div class="search--button-wrapper">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-file-text-outlined"></i>
                            </span>
                            <span><?php echo e(__('messages.deliverymen_earning_provide')); ?> <?php echo e(__('messages.table')); ?></span>
                        </h5>
                        <!-- Static Search Form -->
                        <form id="search-form" action="javascript:">
                            <div class="input--group input-group">
                                <input type="text" name="search" class="form-control" placeholder="Ex: Search here by Name...">
                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                            </div>
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
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.export-deliveryman-earning', ['type'=>'excel'])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                            alt="Image Description">
                                    <?php echo e(__('messages.excel')); ?>

                                </a>
                                <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.export-deliveryman-earning', ['type'=>'csv'])); ?>">
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
                                    <th><?php echo e(__('messages.name')); ?></th>
                                    <th><?php echo e(__('messages.received_at')); ?></th>
                                    <th><?php echo e(__('messages.amount')); ?></th>
                                    <th><?php echo e(__('messages.method')); ?></th>
                                    <th><?php echo e(__('messages.reference')); ?></th>
                                </tr>
                            </thead>
                            <tbody id="set-rows">
                            <?php $__currentLoopData = $provide_dm_earning; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td scope="row"><?php echo e($k+$provide_dm_earning->firstItem()); ?></td>
                                    <td><?php if($at->delivery_man): ?><a href="<?php echo e(route('admin.delivery-man.preview', $at->delivery_man_id)); ?>"><?php echo e($at->delivery_man->f_name.' '.$at->delivery_man->l_name); ?></a> <?php else: ?> <label class="text-capitalize text-danger"><?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.deleted')); ?></label> <?php endif; ?> </td>
                                    <td><?php echo e($at->created_at->format('Y-m-d '.config('timeformat'))); ?></td>
                                    <td><?php echo e($at['amount']); ?></td>
                                    <td><?php echo e($at['method']); ?></td>
                                    <td><?php echo e($at['ref']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($provide_dm_earning) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($provide_dm_earning->links()); ?>

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

    $('#deliveryman').select2({
        ajax: {
            url: '<?php echo e(url('/')); ?>/admin/delivery-man/get-deliverymen',
            data: function (params) {
                return {
                    q: params.term, // search term
                    earning: true,
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
        $('#search-form').on('submit', function () {
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('admin.search-deliveryman-earning')); ?>',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#set-rows').html(data.view);
                // $('#itemCount').html(data.total);
                $('.page-area').hide();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    });
    $('#add_transaction').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('admin.provide-deliveryman-earnings.store')); ?>',
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
                        location.href = '<?php echo e(route('admin.provide-deliveryman-earnings.index')); ?>';
                    }, 2000);
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/deliveryman-earning-provide/index.blade.php ENDPATH**/ ?>