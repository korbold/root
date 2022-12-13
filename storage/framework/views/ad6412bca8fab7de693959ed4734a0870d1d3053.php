<?php $__env->startSection('title','Employee List'); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(asset('/public/assets/admin/img/employee-list.png')); ?>" alt="public">
            </div>
            <span>
                <?php echo e(trans('messages.Employee')); ?> <?php echo e(trans('messages.list')); ?>

            </span>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <div class="search--button-wrapper justify-content-end">
                        <form action="javascript:" id="search-form" class="search-form">
                            <?php echo csrf_field(); ?>
                            <!-- Search -->
                            <div class="input--group input-group input-group-merge input-group-flush">
                                <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(__('messages.search')); ?> by name & email" aria-label="Search">
                                <button type="submit" class="btn btn--secondary">
                                    <i class="tio-search"></i>
                                </button>
                            </div>
                            <!-- End Search -->
                        </form>


                    <!-- Unfold -->
                    <div class="hs-unfold">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn export--btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                            data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(__('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            
                            <span class="dropdown-header"><?php echo e(__('messages.download')); ?> <?php echo e(__('messages.options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.employee.export-employee', ['type'=>'excel'])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                <?php echo e(__('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.employee.export-employee', ['type'=>'csv'])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                .<?php echo e(__('messages.csv')); ?>

                            </a>
                            
                        </div>
                    </div>
                    <!-- End Unfold -->
                    <!-- Unfold -->
                    
                    <!-- End Unfold -->
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Employee <?php echo e(trans('messages.name')); ?></th>
                                <th><?php echo e(trans('messages.phone')); ?></th>
                                <th><?php echo e(trans('messages.email')); ?></th>
                                <th>
                                    <div class="pl-2">
                                            <?php echo e(translate('Created At')); ?>

                                        </div>
                                    </th>
                                <th class="text-center w-120px"><?php echo e(trans('messages.action')); ?></th>
                            </tr>
                            </thead>
                            <tbody id="set-rows">
                            <?php $__currentLoopData = $em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($k+$em->firstItem()); ?></th>
                                    <td class="text-capitalize"><?php echo e($e['f_name']); ?> <?php echo e($e['l_name']); ?></td>
                                    <td><?php echo e($e['phone']); ?></td>
                                    <td >
                                      <?php echo e($e['email']); ?>

                                    </td>
                                    <td>
                                        <?php echo e($e['created_at']->format('d M, Y')); ?>

                                    </td>
                                    <td>
                                        <div class="btn--container">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="<?php echo e(route('admin.employee.edit',[$e['id']])); ?>" title="<?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.Employee')); ?>"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:"
                                                onclick="form_alert('employee-<?php echo e($e['id']); ?>','<?php echo e(__('messages.Want_to_delete_this_role')); ?>')" title="<?php echo e(__('messages.delete')); ?> <?php echo e(__('messages.Employee')); ?>"><i class="tio-delete-outlined"></i>
                                            </a>
                                        </div>
                                        <form action="<?php echo e(route('admin.employee.delete',[$e['id']])); ?>"
                                                method="post" id="employee-<?php echo e($e['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($em) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer pt-0 border-0">
                    <div class="page-area px-4 pb-3">
                        <div class="d-flex align-items-center justify-content-end">
                            
                            <div>
                                <?php echo $em->links(); ?>

                            </div>
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
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.employee.search')); ?>',
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/employee/list.blade.php ENDPATH**/ ?>