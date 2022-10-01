<?php $__env->startSection('title','Campaign List'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-notice"></i> <?php echo e(__('messages.basic')); ?> <?php echo e(__('messages.campaign')); ?> <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($campaigns->total()); ?></span></h1>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn--primary" href="<?php echo e(route('admin.campaign.add-new', 'basic')); ?>">
                        <i class="tio-add"></i> <?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?> <?php echo e(__('messages.campaign')); ?>

                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"></h5>
                            <form id="search-form">
                                <?php echo csrf_field(); ?>
                                <!-- Search -->
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch" type="search" name="search" class="form-control" placeholder="Ex: Search by name..." aria-label="Search here">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="font-size-sm table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th ><?php echo e(__('messages.title')); ?></th>
                                <th ><?php echo e(__('messages.date')); ?> <?php echo e(__('messages.duration')); ?></th>
                                <th ><?php echo e(__('messages.time')); ?> <?php echo e(__('messages.duration')); ?></th>
                                <th><?php echo e(__('messages.status')); ?></th>
                                <th class="text-center"><?php echo e(__('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$campaigns->firstItem()); ?></td>
                                    <td>
                                        <span class="d-block text-body"><a href="<?php echo e(route('admin.campaign.view',['basic',$campaign->id])); ?>"><?php echo e(Str::limit($campaign['title'],25, '...')); ?></a>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="bg-gradient-light text-dark"><?php echo e($campaign->start_date?$campaign->start_date->format('d M, Y'). ' - ' .$campaign->end_date->format('d M, Y'): 'N/A'); ?></span>
                                    </td>
                                    <td>
                                        <span class="bg-gradient-light text-dark"><?php echo e($campaign->start_time?date(config('timeformat'),strtotime($campaign->start_time)). ' - ' .date(config('timeformat'),strtotime($campaign->end_time)): 'N/A'); ?></span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($campaign->id); ?>">
                                            <input type="checkbox" onclick="location.href='<?php echo e(route('admin.campaign.status',['basic',$campaign['id'],$campaign->status?0:1])); ?>'"class="toggle-switch-input" id="stocksCheckbox<?php echo e($campaign->id); ?>" <?php echo e($campaign->status?'checked':''); ?>>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="<?php echo e(route('admin.campaign.edit',['basic',$campaign['id']])); ?>" title="<?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.campaign')); ?>"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:"
                                                onclick="form_alert('campaign-<?php echo e($campaign['id']); ?>','<?php echo e(__('messages.Want_to_delete_this_item')); ?>')" title="<?php echo e(__('messages.delete')); ?> <?php echo e(__('messages.campaign')); ?>"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.campaign.delete',[$campaign['id']])); ?>"
                                                        method="post" id="campaign-<?php echo e($campaign['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($campaigns) === 0): ?>
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
                                    <?php echo $campaigns->links(); ?>

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
                url: '<?php echo e(route('admin.campaign.searchBasic')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('.page-area').hide();
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.count);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/campaign/basic/list.blade.php ENDPATH**/ ?>