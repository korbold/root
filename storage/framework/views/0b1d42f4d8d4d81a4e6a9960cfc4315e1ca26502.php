<?php $__env->startSection('title',translate('Withdraw Request')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <h2 class="page-header-title text-capitalize m-0">
            <?php echo e(translate('Restaurant Withdraw Transaction')); ?>

        </h2>
    </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"><?php echo e(__('messages.withdraw')); ?> <?php echo e(__('messages.request')); ?> <?php echo e(__('messages.table')); ?> <span id="itemCount"
                                    class="badge badge-soft-dark ml-2"><?php echo e($withdraw_req->total()); ?></span></h5>

                            <form action="javascript:" id="search-form" class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                                <!-- Search -->
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="Ex : Search by Restaurant name of Phone number" aria-label="Search" required="">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                                <!-- End Search -->
                            </form>

                            <div class="mr-sm-3 max--sm-100">
                                <select name="withdraw_status_filter" onchange="status_filter(this.value)"
                                    class="custom-select">
                                <option
                                    value="all" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all'?'selected':''); ?>>
                                    <?php echo e(__('messages.all')); ?>

                                </option>
                                <option
                                    value="approved" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved'?'selected':''); ?>>
                                    <?php echo e(__('messages.approved')); ?>

                                </option>
                                <option
                                    value="denied" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied'?'selected':''); ?>>
                                    <?php echo e(__('messages.denied')); ?>

                                </option>
                                <option
                                    value="pending" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending'?'selected':''); ?>>
                                    <?php echo e(__('messages.pending')); ?>

                                </option>

                            </select>
                            </div>

                            <!-- Export Button Static -->
                            <div class="hs-unfold ml-3 max--sm-100">
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
                                    
                                    <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.vendor.withdraw-list-export', ['type'=>'excel'])); ?>">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                                alt="Image Description">
                                        <?php echo e(__('messages.excel')); ?>

                                    </a>

                                    
                                    <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.vendor.withdraw-list-export', ['type'=>'csv'])); ?>">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                                alt="Image Description">
                                        .<?php echo e(__('messages.csv')); ?>

                                    </a>
                                    
                                </div>
                            </div>
                            <!-- Export Button Static -->
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th><?php echo e(__('messages.amount')); ?></th>
                                    
                                    <th><?php echo e(__('messages.restaurant')); ?></th>
                                    <th><?php echo e(__('messages.request_time')); ?></th>
                                    <th><?php echo e(__('messages.status')); ?></th>
                                    <th class="text-center"><?php echo e(__('messages.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody id="set-rows">
                                <?php $__currentLoopData = $withdraw_req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$wr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($k+$withdraw_req->firstItem()); ?></td>
                                        <td><?php echo e($wr['amount']); ?></td>
                                        
                                        <td>
                                            <?php if($wr->vendor && isset($wr->vendor->restaurants[0])): ?>
                                            <a class="deco-none"
                                               href="<?php echo e(route('admin.vendor.view',[$wr->vendor['id']])); ?>"><?php echo e(Str::limit($wr->vendor?$wr->vendor->restaurants[0]->name:translate('messages.Restaurant deleted!'), 20, '...')); ?></a>
                                            <?php else: ?>
                                            <?php echo e(translate('messages.Restaurant deleted!')); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(date('Y-m-d '.config('timeformat'),strtotime($wr->created_at))); ?></td>
                                        <td>
                                            <div>
                                                <?php if($wr->approved==0): ?>
                                                    <label class="badge badge-soft-primary"><?php echo e(translate('Pending')); ?></label>
                                                <?php elseif($wr->approved==1): ?>
                                                    <label class="badge badge-soft-success"><?php echo e(translate('Approved')); ?></label>
                                                <?php else: ?>
                                                    <label class="badge badge-soft-danger"><?php echo e(translate('Denied')); ?></label>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <?php if($wr->vendor): ?>
                                                <a href="<?php echo e(route('admin.vendor.withdraw_view',[$wr['id'],$wr->vendor['id']])); ?>"
                                                class="btn btn-sm btn--primary btn-outline-primary action-btn"><i class="tio-invisible"></i>
                                                </a>
                                                <?php else: ?>
                                                <?php echo e(__('messages.restaurant').' '.__('messages.deleted')); ?>

                                                <?php endif; ?>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($withdraw_req) === 0): ?>
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
                        <?php echo e($withdraw_req->links()); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
            $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.vendor.withdraw_list_search')); ?>',
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

        function status_filter(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.vendor.status-filter')); ?>',
                data: {
                    withdraw_status_filter: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    console.log(data)
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/wallet/withdraw.blade.php ENDPATH**/ ?>