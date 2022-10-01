<?php $__env->startSection('title', 'Update product'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php ($opening_time = ''); ?>
    <?php ($closing_time = ''); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title"><i class="tio-edit"></i>
                <?php echo e(__('messages.food')); ?> <?php echo e(__('messages.update')); ?>

            </h1>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="javascript:" method="post" id="product_form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php ($default_lang = 'bn'); ?>
                    <div class="row g-2">
                        <?php if($language): ?>
                        <div class="col-lg-12">
                            <?php ($default_lang = json_decode($language)[0]); ?>
                            <ul class="nav nav-tabs mb-4">
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link <?php echo e($lang == $default_lang ? 'active' : ''); ?>" href="#"
                                            id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-fastfood"></i>
                                        </span>
                                        <span><?php echo e(translate('Food Info')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if($language): ?>
                                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            if (count($product['translations'])) {
                                                $translate = [];
                                                foreach ($product['translations'] as $t) {
                                                    if ($t->locale == $lang && $t->key == 'name') {
                                                        $translate[$lang]['name'] = $t->value;
                                                    }
                                                    if ($t->locale == $lang && $t->key == 'description') {
                                                        $translate[$lang]['description'] = $t->value;
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="<?php echo e($lang != $default_lang ? 'd-none' : ''); ?> lang_form"
                                                id="<?php echo e($lang); ?>-form">
                                                <div class="form-group">
                                                    <label class="input-label"
                                                        for="<?php echo e($lang); ?>_name"><?php echo e(__('messages.name')); ?>

                                                        (<?php echo e(strtoupper($lang)); ?>)
                                                    </label>
                                                    <input type="text" name="name[]" id="<?php echo e($lang); ?>_name" class="form-control"
                                                        placeholder="<?php echo e(__('messages.new_food')); ?>"
                                                        value="<?php echo e($translate[$lang]['name'] ?? $product['name']); ?>"
                                                        <?php echo e($lang == $default_lang ? 'required' : ''); ?>

                                                        oninvalid="document.getElementById('en-link').click()">
                                                </div>
                                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                                <div class="form-group mb-0">
                                                    <label class="input-label"
                                                        for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?>

                                                        <?php echo e(__('messages.description')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                                    <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"><?php echo $translate[$lang]['description'] ?? $product['description']; ?></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div id="<?php echo e($default_lang); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.name')); ?>

                                                    (EN)</label>
                                                <input type="text" name="name[]" class="form-control"
                                                    placeholder="<?php echo e(__('messages.new_food')); ?>" value="<?php echo e($product['name']); ?>"
                                                    required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="en">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?>

                                                    <?php echo e(__('messages.description')); ?></label>
                                                <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"><?php echo $product['description']; ?></textarea>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon"><i class="tio-image"></i></span>
                                        <span>Food Image <small class="text-danger">(Ratio 200x200)</small></span>
                                    </h5>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <?php if(isset($product['image'])): ?>
                                        <center id="image-viewer-section" class="my-auto py-3">
                                            <img class="initial-52" id="viewer"
                                                src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($product['image']); ?>"
                                                onerror="this.src='<?php echo e(asset('/public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                alt="product image" />
                                        </center>
                                    <?php else: ?>
                                        <center id="image-viewer-section" class="my-auto py-3">
                                            <img class="initial-52" id="viewer"
                                                src="<?php echo e(asset('public/assets/admin/img/400x400/img2.jpg')); ?>" alt="banner image" />
                                        </center>
                                    <?php endif; ?>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?>

                                            <?php echo e(__('messages.file')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-dashboard-outlined"></i>
                                        </span>
                                        <span> <?php echo e(translate('Food Details')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlSelect1"><?php echo e(__('messages.restaurant')); ?><span
                                                        class="input-label-secondary"></span></label>
                                                <select name="restaurant_id"
                                                    data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.restaurant')); ?>"
                                                    class="js-data-example-ajax form-control"
                                                    onchange="getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?data[]=0&restaurant_id=', this.value,'add_on')"
                                                    title="Select Restaurant" required
                                                    oninvalid="this.setCustomValidity('<?php echo e(__('messages.please_select_restaurant')); ?>')">
                                                    <?php if(isset($product->restaurant)): ?>
                                                        <option value="<?php echo e($product->restaurant_id); ?>" selected="selected">
                                                            <?php echo e($product->restaurant->name); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlSelect1"><?php echo e(__('messages.category')); ?><span
                                                        class="input-label-secondary">*</span></label>
                                                <select name="category_id" id="category-id" class="form-control js-select2-custom"
                                                    onchange="getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id='+this.value,'sub-categories')">
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category['id']); ?>"
                                                            <?php echo e($category->id == $product_category[0]->id ? 'selected' : ''); ?>>
                                                            <?php echo e($category['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlSelect1"><?php echo e(__('messages.sub_category')); ?><span
                                                        class="input-label-secondary"
                                                        data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(__('messages.category_required_warning')); ?>"><img
                                                            src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                            alt="<?php echo e(__('messages.category_required_warning')); ?>"></span></label>
                                                <select name="sub_category_id" id="sub-categories"
                                                    data-id="<?php echo e(count($product_category) >= 2 ? $product_category[1]->id : ''); ?>"
                                                    class="form-control js-select2-custom">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.item_type')); ?></label>
                                                <select name="veg" class="form-control js-select2-custom">
                                                    <option value="0" <?php echo e($product['veg'] == 0 ? 'selected' : ''); ?>>
                                                        <?php echo e(__('messages.non_veg')); ?>

                                                    </option>
                                                    <option value="1" <?php echo e($product['veg'] == 1 ? 'selected' : ''); ?>>
                                                        <?php echo e(__('messages.veg')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlSelect1"><?php echo e(__('messages.addon')); ?><span
                                                        class="input-label-secondary"
                                                        data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(__('messages.restaurant_required_warning')); ?>"><img
                                                            src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                            alt="<?php echo e(__('messages.restaurant_required_warning')); ?>"></span></label>
                                                <select name="addon_ids[]" class="form-control border js-select2-custom" multiple="multiple"
                                                    id="add_on">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon"><i class="tio-dollar-outlined"></i></span>
                                        <span><?php echo e(translate('Amount')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.price')); ?></label>
                                                <input type="number" value="<?php echo e($product['price']); ?>" min="0" max="999999999999.99"
                                                    name="price" class="form-control" step="0.01" placeholder="Ex : 100" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.discount')); ?>

                                                    <?php echo e(__('messages.type')); ?></label>
                                                <select name="discount_type" class="form-control js-select2-custom">
                                                    <option value="percent"
                                                        <?php echo e($product['discount_type'] == 'percent' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('messages.percent')); ?>

                                                    </option>
                                                    <option value="amount" <?php echo e($product['discount_type'] == 'amount' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('messages.amount')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.discount')); ?></label>
                                                <input type="number" min="0" value="<?php echo e($product['discount']); ?>" max="100000"
                                                    name="discount" class="form-control" placeholder="Ex : 100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-canvas-text"></i>
                                        </span>
                                        <span> <?php echo e(translate('Add Attribute')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlSelect1"><?php echo e(__('messages.attribute')); ?><span
                                                        class="input-label-secondary"></span></label>
                                                <select name="attribute_id[]" id="choice_attributes" class="form-control border js-select2-custom"
                                                    multiple="multiple">
                                                    <?php $__currentLoopData = \App\Models\Attribute::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($attribute['id']); ?>"
                                                            <?php echo e(in_array($attribute->id, json_decode($product['attributes'], true)) ? 'selected' : ''); ?>>
                                                            <?php echo e($attribute['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="customer_choice_options" id="customer_choice_options">
                                                <?php echo $__env->make(
                                                    'admin-views.product.partials._choices',
                                                    [
                                                        'choice_no' => json_decode($product['attributes']),
                                                        'choice_options' => json_decode($product['choice_options'], true),
                                                    ]
                                                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="variant_combination" id="variant_combination">
                                                <?php echo $__env->make(
                                                    'admin-views.product.partials._edit-combinations',
                                                    [
                                                        'combinations' => json_decode(
                                                            $product['variations'],
                                                            true
                                                        ),
                                                    ]
                                                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon"><i class="tio-date-range"></i></span>
                                        <span><?php echo e(translate('Time Schedule')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.available')); ?>

                                                    <?php echo e(__('messages.time')); ?> <?php echo e(__('messages.starts')); ?></label>
                                                <input type="time" value="<?php echo e($product['available_time_starts']); ?>"
                                                    name="available_time_starts" class="form-control" id="available_time_starts"
                                                    placeholder="Ex : 10:30 am" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(__('messages.available')); ?>

                                                    <?php echo e(__('messages.time')); ?> <?php echo e(__('messages.ends')); ?></label>
                                                <input type="time" value="<?php echo e($product['available_time_ends']); ?>"
                                                    name="available_time_ends" class="form-control" id="available_time_ends"
                                                    placeholder="5:45 pm" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.update')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        function getRestaurantData(route, restaurant_id, id) {
            $.get({
                url: route + restaurant_id,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
            $('#image-viewer-section').show(1000)
        });

        $(document).ready(function() {
            setTimeout(function() {
                let category = $("#category-id").val();
                let sub_category = '<?php echo e(count($product_category) >= 2 ? $product_category[1]->id : ''); ?>';
                let sub_sub_category = '<?php echo e(count($product_category) >= 3 ? $product_category[2]->id : ''); ?>';
                getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id=' + category +
                    '&sub_category=' + sub_category, 'sub-categories');
                getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id=' + sub_category +
                    '&sub_category=' + sub_sub_category, 'sub-sub-categories');

            }, 1000)

            <?php if(count(json_decode($product['add_ons'], true))>0): ?>
            getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?<?php $__currentLoopData = json_decode($product['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>data[]=<?php echo e($addon); ?>& <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> restaurant_id=','<?php echo e($product['restaurant_id']); ?>','add_on');
            <?php else: ?>
            getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?data[]=0&restaurant_id=','<?php echo e($product['restaurant_id']); ?>','add_on');
            <?php endif; ?>
        });
    </script>

    <script>
        $(document).on('ready', function() {
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '<?php echo e(url('/')); ?>/admin/vendor/get-restaurants',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                __port: function(params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });
    </script>

    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/tags-input.min.js"></script>

    <script>
        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            combination_update();
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name;
            $('#customer_choice_options').append(
                '<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i +
                '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="Choice Title" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="combination_update()"></div></div>'
                );
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        setTimeout(function() {
            $('.call-update-sku').on('change', function() {
                combination_update();
            });
        }, 2000)

        $('#colors-selector').on('change', function() {
            combination_update();
        });

        $('input[name="unit_price"]').on('keyup', function() {
            combination_update();
        });

        function combination_update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '<?php echo e(route('admin.food.variant-combination')); ?>',
                data: $('#product_form').serialize(),
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#loading').hide();
                    $('#variant_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

    <!-- submit form -->
    <script>
        $('#product_form').on('submit', function() {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.food.update', [$product['id']])); ?>',
                data: $('#product_form').serialize(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#loading').hide();
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('product updated successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function() {
                            location.href =
                                '<?php echo e(\Request::server('HTTP_REFERER') ?? route('admin.food.list')); ?>';
                        }, 2000);
                    }
                }
            });
        });
    </script>
    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == 'en') {
                $("#from_part_2").removeClass('d-none');
            } else {
                $("#from_part_2").addClass('d-none');
            }
        })

        $('#reset_btn').click(function(){
            location.reload(true);
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/product/edit.blade.php ENDPATH**/ ?>