<?php $__env->startSection('title',$restaurant->name."'s Settings"); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/admin/css/croppie.css')); ?>" rel="stylesheet">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h1 class="page-header-title text-break">
                <i class="tio-museum"></i> <span><?php echo e($restaurant->name); ?></span>
            </h1>
        </div>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
                </a>
            </span>

            <span class="hs-nav-scroller-arrow-next" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', $restaurant->id)); ?>"><?php echo e(__('messages.overview')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'order'])); ?>"  aria-disabled="true"><?php echo e(__('messages.orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'product'])); ?>"  aria-disabled="true"><?php echo e(__('messages.foods')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'reviews'])); ?>"  aria-disabled="true"><?php echo e(__('messages.reviews')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'discount'])); ?>"  aria-disabled="true"><?php echo e(__('discounts')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transactions')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'settings'])); ?>"  aria-disabled="true"><?php echo e(__('messages.settings')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('admin.vendor.view', ['restaurant'=>$restaurant->id, 'tab'=> 'conversations'])); ?>"  aria-disabled="true"><?php echo e(__('messages.conversations')); ?></a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
        <!-- End Page Header -->
    <!-- Page Heading -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                <span class="card-header-icon"><i class="tio-fastfood"></i></span>
                <span><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.settings')); ?></span>
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 form-control" for="food_section">
                            <span class="pr-2 d-flex">
                                <span><?php echo e(translate('messages.manage_food_setup')); ?></span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title='<?php echo e(translate("By disabling this field, the restaurant can't manage foods, which means
the restaurant web panel/ app won't get the access for managing foods.
")); ?>' class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->food_section?0:1, 'food_section'])); ?>'" name="food_section" id="food_section" <?php echo e($restaurant->food_section?'checked':''); ?>>
                            <span class="toggle-switch-label text">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="reviews_section">
                        <span class="pr-2 d-flex">
                            <span class="line--limit-1">
                                <?php echo e(translate('messages.show_reviews_in_restaurant_panel')); ?>

                            </span>
                            <span  data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If this field is active, the restaurant panel & restaurant app can see the customer’s review.')); ?>" class="input-label-secondary">
                                <i class="tio-info-outined"></i>
                            </span>
                        </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->reviews_section?0:1, 'reviews_section'])); ?>'" name="reviews_section" id="reviews_section" <?php echo e($restaurant->reviews_section?'checked':''); ?>>
                            <span class="toggle-switch-label text">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="pos_system">
                            <span class="pr-2 d-flex">
                                <span class="line--limit-1">
                                    <?php echo e(translate('messages.include_pos_in_restaurant_panel')); ?>

                                </span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If this option is turned on, the restaurant panel will get the Point of Sale (POS) option.')); ?>" class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->pos_system?0:1, 'pos_system'])); ?>'" id="pos_system" <?php echo e($restaurant->pos_system?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="schedule_order">
                            <span class="pr-2 d-flex">
                                <span class="line--limit-1">
                                    <?php echo e(__('messages.scheduled')); ?> <?php echo e(__('messages.order')); ?> <?php echo e(translate('messages.option')); ?>

                                </span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate(' If this status is turned on, the customer is able to place a scheduled order for this restaurant.')); ?>" class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->schedule_order?0:1, 'schedule_order'])); ?>'" id="schedule_order" <?php echo e($restaurant->schedule_order?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="self_delivery_system">
                            <span class="pr-2 d-flex">
                                <span class="line--limit-1">
                                    <?php echo e(translate('messages.self_delivery')); ?>

                                </span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('When this option is enabled, restaurants need to deliver orders by themselves or by their own delivery man. Restaurants will also get an option for adding their own delivery man from the restaurant panel.')); ?>" class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->self_delivery_system?0:1, 'self_delivery_system'])); ?>'" id="self_delivery_system" <?php echo e($restaurant->self_delivery_system?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                


                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="delivery">
                            <span class="pr-2 d-flex">
                                <span class="line--limit-1">
                                    <?php echo e(translate('messages.home_delivery')); ?>

                                </span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If this option is active, customers can place orders for home delivery.')); ?>" class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" name="delivery" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->delivery?0:1, 'delivery'])); ?>'" id="delivery" <?php echo e($restaurant->delivery?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="form-group mb-0">
                        <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border  rounded px-3 form-control" for="take_away">
                            <span class="pr-2 d-flex">
                                <span class="line--limit-1">
                                    <?php echo e(__('messages.take_away')); ?>:
                                </span>
                                <span  data-toggle="tooltip" data-placement="right" data-original-title='<?php echo e(translate("By disabling this option, customers can't place self-pickup / take-away orders.")); ?>' class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <input type="checkbox" class="toggle-switch-input" onclick="location.href='<?php echo e(route('admin.vendor.toggle-settings',[$restaurant->id,$restaurant->take_away?0:1, 'take_away'])); ?>'" id="take_away" <?php echo e($restaurant->take_away?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </div>
                </div>
                
            </div>

            <form action="<?php echo e(route('admin.vendor.update-settings',[$restaurant['id']])); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row g-2 mt-4">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="input-label text-capitalize">Restaurant Type</label>
                            <?php ($restaurant_type = \App\Models\Restaurant::where(['id'=>$restaurant->id])->select('veg','non_veg')->first()); ?>
                            <div class="resturant-type-group border">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <?php ($checked = ($restaurant_type->veg == 1 && $restaurant_type->non_veg == 0) ? 'checked' : ''); ?>
                                    <input class="form-check-input" type="radio" name="menu" id="check-veg" <?php echo e($checked); ?> value="veg">
                                    <span class="form-check-label">
                                        <?php echo e(translate('messages.veg')); ?>

                                    </span>
                                </label>
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <?php ($checked = ($restaurant_type->veg == 0 && $restaurant_type->non_veg == 1) ? 'checked' : ''); ?>
                                    <input class="form-check-input" type="radio" name="menu" id="check-non-veg" <?php echo e($checked); ?> value="non-veg">
                                    <span class="form-check-label">
                                        <?php echo e(translate('messages.non_veg')); ?>

                                    </span>
                                </label>
                                <label class="form-check form--check">
                                    <?php ($checked = ($restaurant_type->veg == 1 && $restaurant_type->non_veg == 1) ? 'checked' : ''); ?>
                                    <input class="form-check-input" type="radio" name="menu" id="check-both" <?php echo e($checked); ?> value="both">
                                    <span class="form-check-label">
                                        <?php echo e(translate('messages.both')); ?>

                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label class="input-label text-capitalize" for="title"><?php echo e(__('messages.minimum')); ?> <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.amount')); ?></label>
                            <input type="number" name="minimum_order" step="0.01" min="0" max="100000" class="form-control" placeholder="Ex: 5" value="<?php echo e($restaurant->minimum_order??'0'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label class="d-flex justify-content-between switch toggle-switch-sm text-dark" for="tax">
                                <span><?php echo e(__('messages.vat/tax')); ?>(%)</span>
                            </label>
                            <input type="number" id="tax" min="0" max="10000" step="0.01" name="tax" class="form-control" placeholder="Ex: 5" required value="<?php echo e($restaurant->tax??'0'); ?>" <?php echo e(isset($restaurant->tax)?'':'readonly'); ?>>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label class="input-label" for="minimum_delivery_time"><?php echo e(__('messages.minimum_delivery_time')); ?></label>
                            <input type="text" name="minimum_delivery_time" id="minimum_delivery_time" class="form-control" placeholder="Ex: 5" pattern="^[0-9]{2}$" required value="<?php echo e(explode('-',$restaurant->delivery_time)[0]); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label class="input-label" for="maximum_delivery_time"><?php echo e(__('messages.maximum_delivery_time')); ?></label>
                            <input type="text" name="maximum_delivery_time" id="maximum_delivery_time" class="form-control" placeholder="Ex: 5" pattern="[0-9]{2}" required value="<?php echo e(explode('-',$restaurant->delivery_time)[1]); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between input-label mb-1" for="comission_status">
                                <span class="form-check-label">
                                    <?php echo e(__('messages.admin_commission')); ?>(%)
                                </span>
                                <input type="checkbox" class="toggle-switch-input" name="comission_status" id="comission_status" value="1" <?php echo e(isset($restaurant->comission)?'checked':''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                            <input type="number" id="comission" min="0" max="10000" step="0.01" name="comission" class="form-control" required value="<?php echo e($restaurant->comission??'0'); ?>" <?php echo e(isset($restaurant->comission)?'':'readonly'); ?>>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn--primary"><?php echo e(__('messages.save')); ?> <?php echo e(__('messages.changes')); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                <span class="card-header-icon">
                    <i class="tio-clock"></i>
                </span>
                <span><?php echo e(__('messages.Daily time schedule')); ?></span>
            </h5>
        </div>
        <div class="card-body" id="schedule">
            <?php echo $__env->make('admin-views.vendor.view.partials._schedule', $restaurant, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<!-- Create schedule modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('messages.Create Schedule')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:" method="post" id="add-schedule">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="day" id="day_id_input">
                    <input type="hidden" name="restaurant_id" value="<?php echo e($restaurant->id); ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><?php echo e(__('messages.Start time')); ?>:</label>
                        <input type="time" class="form-control" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"><?php echo e(__('messages.End time')); ?>:</label>
                        <input type="time" class="form-control" name="end_time" required>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.Submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <!-- Page level plugins -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();

            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var day_name = button.data('day');
                var day_id = button.data('dayid');
                var modal = $(this);
                modal.find('.modal-title').text('<?php echo e(__('messages.Create Schedule For ')); ?> ' + day_name);
                modal.find('.modal-body input[name=day]').val(day_id);
            })
        });
    </script>
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
            $("#comission_status").on('change', function(){
                if($("#comission_status").is(':checked')){
                    $('#comission').removeAttr('readonly');
                } else {
                    $('#comission').attr('readonly', true);
                    $('#comission').val('0');
                }
            });

        });

        function delete_schedule(route) {
            Swal.fire({
                title: '<?php echo e(__('messages.are_you_sure')); ?>',
                text: '<?php echo e(__('messages.You want to remove this schedule')); ?>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: '<?php echo e(__('messages.no')); ?>',
                confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.get({
                        url: route,
                        beforeSend: function () {
                            $('#loading').show();
                        },
                        success: function (data) {
                            if (data.errors) {
                                for (var i = 0; i < data.errors.length; i++) {
                                    toastr.error(data.errors[i].message, {
                                        CloseButton: true,
                                        ProgressBar: true
                                    });
                                }
                            } else {
                                $('#schedule').empty().html(data.view);
                                toastr.success('<?php echo e(__('messages.Schedule removed successfully')); ?>', {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error('<?php echo e(__('messages.Schedule not found')); ?>', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        },
                        complete: function () {
                            $('#loading').hide();
                        },
                    });
                }
            })
        };

        $('#add-schedule').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.vendor.add-schedule')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        $('#schedule').empty().html(data.view);
                        $('#exampleModal').modal('hide');
                        toastr.success('<?php echo e(__('messages.Schedule added successfully')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toastr.error(XMLHttpRequest.responseText, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/vendor/view/settings.blade.php ENDPATH**/ ?>