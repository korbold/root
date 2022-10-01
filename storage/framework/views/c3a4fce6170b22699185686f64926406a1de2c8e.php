<?php $__env->startSection('title','Banner'); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> <?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?> <?php echo e(__('messages.banner')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.banner.store')); ?>" method="post" id="banner_form">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.title')); ?></label>
                                        <input type="text" name="title" class="form-control" placeholder="<?php echo e(__('messages.new_banner')); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label" for="title"><?php echo e(__('messages.zone')); ?></label>
                                        <select name="zone_id" id="zone" class="form-control js-select2-custom" onchange="getRequest('<?php echo e(url('/')); ?>/admin/food/get-foods?zone_id='+this.value,'choice_item')">
                                            <option disabled selected value="">---<?php echo e(__('messages.select')); ?>---</option>
                                            <?php ($zones=\App\Models\Zone::active()->get()); ?>
                                            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                                    <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                        <option value="<?php echo e($zone->id); ?>" selected><?php echo e($zone->name); ?></option>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($zone['id']); ?>"><?php echo e($zone['name']); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.banner')); ?> <?php echo e(__('messages.type')); ?></label>
                                        <select name="banner_type" id="banner_type" class="form-control" onchange="banner_type_change(this.value)">
                                            <option value="restaurant_wise"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.wise')); ?></option>
                                            <option value="item_wise"><?php echo e(__('messages.food')); ?> <?php echo e(__('messages.wise')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="restaurant_wise">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.restaurant')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="restaurant_id" class="js-data-example-ajax form-control"  title="Select Restaurant">
                                            <option selected disabled><?php echo e(translate('Select')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="item_wise">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.select')); ?> <?php echo e(__('messages.food')); ?></label>
                                        <select name="item_id" id="choice_item" class="form-control js-select2-custom" placeholder="<?php echo e(__('messages.select_food')); ?>">
                                            <option selected disabled><?php echo e(translate('Select Restaurant')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        <div class="form-group mt-auto">
                                            <label class="d-block text-center"><?php echo e(__('messages.campaign')); ?> <?php echo e(__('messages.image')); ?> <small class="text-danger">* ( <?php echo e(__('messages.ratio')); ?> 1000x300 )</small></label>
                                        </div>
                                        <div class="form-group mt-auto">
                                            <center>
                                                <img class="initial-2" id="viewer"
                                                    src="<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>" alt="campaign image"/>
                                            </center>
                                        </div>
                                        <div class="form-group mt-auto">
                                            <div class="custom-file">
                                                <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                                <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?> <?php echo e(__('messages.file')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn--container justify-content-end">
                                <button id="reset_btn" type="reset" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><?php echo e(__('messages.banner')); ?> <?php echo e(__('messages.list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($banners->count()); ?></span></h5>
                        <form id="search-form">
                            <?php echo csrf_field(); ?>
                            <!-- Search -->
                            <div class="input--group input-group input-group-merge input-group-flush">
                                <input id="datatableSearch" type="search" name="search" class="form-control" placeholder="Ex : Search by title ..." aria-label="<?php echo e(__('messages.search_here')); ?>">
                                <button type="submit" class="btn btn--secondary">
                                    <i class="tio-search"></i>
                                </button>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                "order": [],
                                "orderCellsTop": true,
                                "search": "#datatableSearch",
                                "entries": "#datatableEntries",
                                "isResponsive": false,
                                "isShowPaging": false,
                                "paging": false,
                               }'>
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th><?php echo e(__('messages.title')); ?></th>
                                    <th><?php echo e(__('messages.type')); ?></th>
                                    <th><?php echo e(__('messages.status')); ?></th>
                                    <th class="text-center"><?php echo e(__('messages.action')); ?></th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$banners->firstItem()); ?></td>
                                    <td>
                                        <span class="media align-items-center">
                                            <img class="avatar avatar-lg mr-3 avatar--3-1" src="<?php echo e(asset('storage/app/public/banner')); ?>/<?php echo e($banner['image']); ?>"
                                                 onerror="this.src='<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>'" alt="<?php echo e($banner->name); ?> image">
                                            <div class="media-body">
                                                <h5 class="text-hover-primary mb-0"><?php echo e(Str::limit($banner['title'], 25, '...')); ?></h5>
                                            </div>
                                        </span>
                                    <span class="d-block font-size-sm text-body">

                                    </span>
                                    </td>
                                    <td><?php echo e(__('messages.'.$banner['type'])); ?></td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="statusCheckbox<?php echo e($banner->id); ?>">
                                            <input type="checkbox" onclick="location.href='<?php echo e(route('admin.banner.status',[$banner['id'],$banner->status?0:1])); ?>'" class="toggle-switch-input" id="statusCheckbox<?php echo e($banner->id); ?>" <?php echo e($banner->status?'checked':''); ?>>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn" href="<?php echo e(route('admin.banner.edit',[$banner['id']])); ?>"title="<?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.banner')); ?>"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:" onclick="form_alert('banner-<?php echo e($banner['id']); ?>','Want to delete this banner ?')" title="<?php echo e(__('messages.delete')); ?> <?php echo e(__('messages.banner')); ?>"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.banner.delete',[$banner['id']])); ?>"
                                                        method="post" id="banner-<?php echo e($banner['id']); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($banners) === 0): ?>
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
                                    <?php echo $banners->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    function getRequest(route, id) {
        $.get({
            url: route,
            dataType: 'json',
            success: function (data) {
                $('#' + id).empty().append(data.options);
            },
        });
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function () {
        readURL(this);
    });
</script>
<script>
    $(document).on('ready', function () {
        var zone_id = [];
        var select_control = $('#banner_type, #restaurant_wise select, #item_wise select');
        $('#zone').on('change', function(){
            if($(this).val())
            {
                zone_id = $(this).val();
            }
            else
            {
                zone_id = [];
            }
            if($('#zone').val() == undefined) {
                select_control.attr('disabled', '')
            } else {
                select_control.removeAttr('disabled')
            }
        });
        if($('#zone').val() == undefined) {
            select_control.attr('disabled', '')
        } else {
            select_control.removeAttr('disabled')
        }

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '<?php echo e(url('/')); ?>/admin/vendor/get-restaurants',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        zone_ids: [zone_id],
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
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'), {
                select: {
                    style: 'multi',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                    '<img class="mb-3" src="<?php echo e(asset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description" style="width: 7rem;">' +
                    '<p class="mb-0">No data to show</p>' +
                    '</div>'
                }
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function(){
                    var newValue = $input.val();

                    if (newValue == ""){
                    // Gotcha
                    datatable.search('').draw();
                    }
                }, 1);
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
        $('#item_wise').hide();
        function banner_type_change(order_type) {
           if(order_type=='item_wise')
            {
                $('#restaurant_wise').hide();
                $('#item_wise').show();
            }
            else if(order_type=='restaurant_wise')
            {
                $('#restaurant_wise').show();
                $('#item_wise').hide();
            }
            else{
                $('#item_wise').hide();
                $('#restaurant_wise').hide();
            }
        }

        $('#banner_form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.banner.store')); ?>',
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
                        toastr.success('Banner uploaded successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.banner.add-new')); ?>';
                        }, 2000);
                    }
                }
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
                url: '<?php echo e(route('admin.banner.search')); ?>',
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
    <script>
        $('#reset_btn').click(function(){
            $('#zone').val(null).trigger('change');
            $('#choice_item').val(null).trigger('change');
            $('#viewer').attr('src','<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/banner/index.blade.php ENDPATH**/ ?>