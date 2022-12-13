<?php $__env->startSection('title',__('messages.custom_role')); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(asset('/public/assets/admin/img/role.png')); ?>" alt="public">
            </div>
            <span>
                <?php echo e(__('messages.employee')); ?> <?php echo e(__('messages.Role')); ?>

            </span>
        </h1>
    </div>
    <!-- Content Row -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(route('admin.custom-role.create')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label input-label qcont" for="name"><?php echo e(translate('Role Name')); ?></label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                                    placeholder="Role Name" required value="<?php echo e(old('name')); ?>">
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <h5 class="input-label m-0 text-capitalize"><?php echo e(__('messages.module_permission')); ?> : </h5>
                    <div class="check-item pb-0 w-auto">
                        <div class="form-group form-check form--check m-0 ml-2">
                            <input type="checkbox" name="modules[]" value="account" class="form-check-input"
                                    id="select-all">
                            <label class="form-check-label ml-2" for="select-all"><?php echo e(translate('Select All')); ?></label>
                        </div>
                    </div>
                </div>
                <div class="check--item-wrapper">
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="account" class="form-check-input"
                                    id="account">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="account"><?php echo e(__('messages.collect')); ?> <?php echo e(__('messages.cash')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="addon" class="form-check-input"
                                    id="addon">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="addon"><?php echo e(__('messages.addon')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="attribute" class="form-check-input"
                                    id="attribute">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="attribute"><?php echo e(__('messages.attribute')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="banner" class="form-check-input"
                                    id="banner">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="banner"><?php echo e(__('messages.banner')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="campaign" class="form-check-input"
                                    id="campaign">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="campaign"><?php echo e(__('messages.campaign')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="category" class="form-check-input"
                                    id="category">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="category"><?php echo e(__('messages.category')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="coupon" class="form-check-input"
                                    id="coupon">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="coupon"><?php echo e(__('messages.coupon')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="custom_role" class="form-check-input"
                                    id="custom_role">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="custom_role"><?php echo e(__('messages.custom_role')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="customerList" class="form-check-input"
                                    id="customerList">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="customerList"><?php echo e(__('messages.customers')); ?> <?php echo e(__('messages.section')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="deliveryman" class="form-check-input"
                                    id="deliveryman">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="deliveryman"><?php echo e(__('messages.deliveryman')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="provide_dm_earning" class="form-check-input"
                                    id="provide_dm_earning">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="provide_dm_earning"><?php echo e(__('messages.deliverymen_earning_provide')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="employee" class="form-check-input"
                                    id="employee">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="employee"><?php echo e(__('messages.Employee')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="food" class="form-check-input"
                                    id="food">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="food"><?php echo e(__('messages.food')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="notification" class="form-check-input"
                                    id="notification">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="notification"><?php echo e(__('messages.push')); ?> <?php echo e(__('messages.notification')); ?> </label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="order" class="form-check-input"
                                    id="order">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="order"><?php echo e(__('messages.order')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="restaurant" class="form-check-input"
                                    id="restaurant">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="restaurant"><?php echo e(__('messages.restaurants')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="report" class="form-check-input"
                                    id="report">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="report"><?php echo e(__('messages.report')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="settings" class="form-check-input"
                                    id="settings">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="settings"><?php echo e(__('messages.business')); ?> <?php echo e(__('messages.settings')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="withdraw_list" class="form-check-input"
                                    id="withdraw_list">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="withdraw_list"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.withdraws')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="pos" class="form-check-input"
                                    id="pos">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="pos"><?php echo e(__('messages.pos_system')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="zone" class="form-check-input"
                                    id="zone">
                            <label class="form-check-label ml-2 ml-sm-3 qcont text-dark" for="zone"><?php echo e(__('messages.zone')); ?></label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pb-3">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset">
                            <?php echo e(__('messages.reset')); ?>

                        </button>
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header py-2 border-0">
            <div class="search--button-wrapper">
                <h5 class="card-title"><?php echo e(__('messages.roles_table')); ?> <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($rl->total()); ?></span></h5>
                <form action="javascript:" id="search-form">
                    <?php echo csrf_field(); ?>
                    <!-- Search -->
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="Search by Name" aria-label="Search">
                        <button type="submit" class="btn btn--secondary">
                            <i class="tio-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>

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
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.custom-role.export-employee-role', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                            <?php echo e(__('messages.excel')); ?>

                        </a>
                        <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.custom-role.export-employee-role', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                            .<?php echo e(__('messages.csv')); ?>

                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-align-middle card-table"
                        data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging":false
                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="w-50px">SL</th>
                        <th scope="col" class="w-50px"><?php echo e(translate('Employee Role List')); ?></th>
                        <th scope="col" class="w-200px"><?php echo e(__('messages.modules')); ?></th>
                        <th scope="col" class="w-50px"><?php echo e(__('messages.created_at')); ?></th>
                        
                        <th scope="col" class="text-center w-50px"><?php echo e(__('messages.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody  id="set-rows">
                    <?php $__currentLoopData = $rl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row"><?php echo e($k+$rl->firstItem()); ?></td>
                            <td><?php echo e(Str::limit($r['name'],25,'...')); ?></td>
                            <td class="text-capitalize">
                                <?php if($r['modules']!=null): ?>
                                    <?php $__currentLoopData = (array)json_decode($r['modules']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(str_replace('_',' ',$m)); ?>,
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(date('d-M-y',strtotime($r['created_at']))); ?></td>
                            
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn--primary btn-outline-primary action-btn"
                                        href="<?php echo e(route('admin.custom-role.edit',[$r['id']])); ?>" title="<?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.role')); ?>"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn--danger btn-outline-danger action-btn" href="javascript:"
                                        onclick="form_alert('role-<?php echo e($r['id']); ?>','<?php echo e(__('messages.Want_to_delete_this_role')); ?>')" title="<?php echo e(__('messages.delete')); ?> <?php echo e(__('messages.role')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.custom-role.delete',[$r['id']])); ?>"
                                        method="post" id="role-<?php echo e($r['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($rl) === 0): ?>
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
                <?php echo $rl->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
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
                url: '<?php echo e(route('admin.custom-role.search')); ?>',
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
        $(document).ready(function() {
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));
        });

        $('#reset_btn').click(function(){
            location.reload(true);
        })
    </script>

<script>
    $('#select-all').on('change', function(){
        if(this.checked === true) {
            $('.check--item-wrapper .check-item .form-check-input').attr('checked', true)
        } else {
            $('.check--item-wrapper .check-item .form-check-input').attr('checked', false)
        }
    })

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/custom-role/create.blade.php ENDPATH**/ ?>