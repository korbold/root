<?php $__env->startSection('title','Update campaign'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> <?php echo e(__('messages.update')); ?> <?php echo e(__('messages.campaign')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="javascript:" method="post" id="campaign_form"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php ($default_lang = 'bn'); ?>
                    <div class="row g-2">
                        <?php if($language): ?>
                        <div class="col-md-12">
                            <?php ($default_lang = json_decode($language)[0]); ?>
                            <ul class="nav nav-tabs mb-4">
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link <?php echo e($lang == $default_lang? 'active':''); ?>" href="#" id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-fastfood"></i>
                                        </span>
                                        <span><?php echo e(translate('food_info')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if($language): ?>
                                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                if(count($campaign['translations'])){
                                                    $translate = [];
                                                    foreach($campaign['translations'] as $t)
                                                    {
                                                        if($t->locale == $lang && $t->key=="title"){
                                                            $translate[$lang]['title'] = $t->value;
                                                        }
                                                        if($t->locale == $lang && $t->key=="description"){
                                                            $translate[$lang]['description'] = $t->value;
                                                        }
                                                    }
                                                }
                                            ?>
                                            <div class="<?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form" id="<?php echo e($lang); ?>-form">
                                                <div class="form-group">
                                                    <label class="input-label" for="<?php echo e($lang); ?>_title"><?php echo e(__('messages.title')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                                    <input type="text" <?php echo e($lang == $default_lang? 'required':''); ?> name="title[]" id="<?php echo e($lang); ?>_title" class="form-control" placeholder="<?php echo e(__('messages.new_campaign')); ?>" value="<?php echo e($translate[$lang]['title']??$campaign['title']); ?>" oninvalid="document.getElementById('en-link').click()">
                                                </div>
                                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                                <div class="form-group mb-0">
                                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                                    <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"><?php echo $translate[$lang]['description']??$campaign['description']; ?></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div id="<?php echo e($default_lang); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.title')); ?> (<?php echo e(translate('en')); ?>)</label>
                                                <input type="text" name="title[]" class="form-control" placeholder="<?php echo e(__('messages.new_campaign')); ?>" value="<?php echo e($campaign['title']); ?>" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="en">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?></label>
                                                <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"><?php echo $campaign['description']; ?></textarea>
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
                                        <span><?php echo e(translate('food_image')); ?> <small class="text-danger">(Ratio 200x200)</small></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-0 h-100 d-flex flex-column">

                                        <center id="image-viewer-section" class="my-auto">
                                            <img class="initial-14" id="viewer"
                                            src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($campaign->image); ?>"
                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/2.png')); ?>'" alt="campaign image"/>
                                        </center>

                                        <div class="form-group mt-3 mb-0">
                                            <div class="custom-file">
                                                <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?> <?php echo e(__('messages.file')); ?></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-dashboard-outlined"></i>
                                        </span>
                                        <span><?php echo e(translate('food_details')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="title"><?php echo e(__('messages.zone')); ?></label>
                                                <select name="zone_id" id="zone" class="form-control js-select2-custom">
                                                    <option disabled selected>---<?php echo e(__('messages.select')); ?>---</option>
                                                    <?php ($zones=\App\Models\Zone::all()); ?>
                                                    <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                                            <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                                <option value="<?php echo e($zone->id); ?>" <?php echo e($campaign->restaurant->zone_id == $zone->id? 'selected': ''); ?>><?php echo e($zone->name); ?></option>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($zone->id); ?>" <?php echo e($campaign->restaurant->zone_id == $zone->id? 'selected': ''); ?>><?php echo e($zone->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.restaurant')); ?><span
                                                        class="input-label-secondary"></span></label>
                                                <select name="restaurant_id" class="js-data-example-ajax form-control" onchange="getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?data[]=0&restaurant_id='+this.value,'add_on')"  title="Select Restaurant" required>
                                                    <?php if($campaign->restaurant): ?>
                                                    <option value="<?php echo e($campaign->restaurant->id); ?>" selected><?php echo e($campaign->restaurant->name); ?></option>
                                                    <?php else: ?>
                                                    <option selected><?php echo e(translate('select_restaurant')); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.category')); ?><span
                                                        class="input-label-secondary">*</span></label>
                                                <select name="category_id" id="category-id" class="form-control js-select2-custom"
                                                        onchange="getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id='+this.value,'sub-categories')">
                                                    <option value="">---<?php echo e(__('messages.select')); ?>---</option>
                                                    <?php ($categories=\App\Models\Category::where(['position' => 0])->get()); ?>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category['id']); ?>" <?php echo e($category->id==json_decode($campaign->category_ids)[0]->id ? 'selected' : ''); ?> ><?php echo e($category['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.sub_category')); ?><span
                                                        class="input-label-secondary" title="<?php echo e(__('messages.category_required_warning')); ?>"><img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(__('messages.category_required_warning')); ?>"></span></label>
                                                <?php ($product_category = json_decode($campaign->category_ids)); ?>
                                                <select name="sub_category_id" id="sub-categories" data-id="<?php echo e(count($product_category)>=2?$product_category[1]->id:''); ?>" class="form-control js-select2-custom"
                                                        onchange="getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id='+this.value,'sub-sub-categories')">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.item_type')); ?></label>
                                                <select name="veg" class="form-control js-select2-custom">
                                                    <option value="0" <?php echo e($campaign['veg']==0?'selected':''); ?>><?php echo e(__('messages.non_veg')); ?></option>
                                                    <option value="1" <?php echo e($campaign['veg']==1?'selected':''); ?>><?php echo e(__('messages.veg')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.addon')); ?><span
                                                        class="input-label-secondary" title="<?php echo e(__('messages.restaurant_required_warning')); ?>"><img src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(__('messages.restaurant_required_warning')); ?>"></span></label>
                                                <select name="addon_ids[]" id="add_on" class="form-control js-select2-custom" multiple="multiple">
                                                    <?php $__currentLoopData = \App\Models\AddOn::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($addon['id']); ?>" <?php echo e(in_array($addon->id,json_decode($campaign['add_ons'],true))?'selected':''); ?>><?php echo e($addon['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon"><i class="tio-dollar-outlined"></i></span>
                                        <span><?php echo e(translate('amount')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.price')); ?></label>
                                                <input type="number" min="1" max="100000" step="0.01" value="<?php echo e($campaign->price); ?>" name="price" class="form-control"
                                                    placeholder="Ex : 100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.discount')); ?></label>
                                                <input type="number" min="0" max="100000" value="<?php echo e($campaign->discount); ?>" name="discount" class="form-control"
                                                    placeholder="Ex : 100" >
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.discount')); ?> <?php echo e(__('messages.type')); ?></label>
                                                <select name="discount_type" class="form-control js-select2-custom">
                                                    <option value="percent" <?php echo e($campaign->discount_type == 'percent'?'selected':''); ?>><?php echo e(__('messages.percent')); ?></option>
                                                    <option value="amount" <?php echo e($campaign->discount_type == 'amount'?'selected':''); ?>><?php echo e(__('messages.amount')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon">
                                            <i class="tio-canvas-text"></i>
                                        </span>
                                        <span><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.attribute')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="exampleFormControlSelect1"><?php echo e(__('messages.attribute')); ?><span
                                                        class="input-label-secondary"></span></label>
                                                <select name="attribute_id[]" id="choice_attributes"
                                                        class="form-control js-select2-custom"
                                                        multiple="multiple">
                                                        <?php $__currentLoopData = \App\Models\Attribute::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($attribute['id']); ?>" <?php echo e(in_array($attribute->id,json_decode($campaign['attributes'],true))?'selected':''); ?>><?php echo e($attribute['name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="customer_choice_options" id="customer_choice_options">
                                                <?php echo $__env->make('admin-views.product.partials._choices',['choice_no'=>json_decode($campaign['attributes']),'choice_options'=>json_decode($campaign['choice_options'],true)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="variant_combination" id="variant_combination">
                                                <?php echo $__env->make('admin-views.product.partials._edit-combinations',['combinations'=>json_decode($campaign['variations'],true)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <span class="card-header-icon"><i class="tio-date-range"></i></span>
                                        <span><?php echo e(translate('time_schedule')); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="title"><?php echo e(__('messages.start')); ?> <?php echo e(__('messages.date')); ?></label>
                                                <input type="date" id="date_from" class="form-control" required="" name="start_date" value="<?php echo e($campaign->start_date->format('Y-m-d')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="title"><?php echo e(__('messages.end')); ?> <?php echo e(__('messages.date')); ?></label>
                                                <input type="date" id="date_to" class="form-control" required="" name="end_date" value="<?php echo e($campaign->end_date->format('Y-m-d')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="title"><?php echo e(__('messages.start')); ?> <?php echo e(__('messages.time')); ?></label>
                                                <input type="time" id="start_time" class="form-control" name="start_time" value="<?php echo e($campaign->start_time->format('H:i')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="input-label" for="title"><?php echo e(__('messages.end')); ?> <?php echo e(__('messages.time')); ?></label>
                                                <input type="time" id="end_time" class="form-control" name="end_time" value="<?php echo e($campaign->end_time->format('H:i')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        function getRestaurantData(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
            $.get({
                url:'<?php echo e(url('/')); ?>/api/v1/restaurants/details/'+restaurant_id,
                dataType: 'json',
                success: function(data) {
                    if(data.available_time_starts != null && data.available_time_ends != null){
                        var opening_time = data.available_time_starts;
                        var closeing_time = data.available_time_ends;
                        $('#available_time_ends').attr('min', opening_time);
                        $('#available_time_starts').attr('min', opening_time);
                        $('#available_time_ends').attr('max', closeing_time);
                        $('#available_time_starts').attr('max', closeing_time);
                        $('#available_time_starts').val(opening_time);
                        $('#available_time_ends').val(closeing_time);
                    }
                },
            });
        }
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
            $('#viewer').show(1000)
        });

        $(document).ready(function () {
            setTimeout(function () {
                let category = $("#category-id").val();
                let sub_category = '<?php echo e(count($product_category)>=2?$product_category[1]->id:''); ?>';
                getRequest('<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id=' + category + '&&sub_category=' + sub_category, 'sub-categories');
            }, 1000)

            <?php if(count(json_decode($campaign['add_ons'], true))>0): ?>
            getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?restaurant_id=<?php echo e($campaign['restaurant_id']); ?><?php $__currentLoopData = json_decode($campaign['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>&data[]=<?php echo e($addon); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>','add_on');
            <?php else: ?>
            getRestaurantData('<?php echo e(url('/')); ?>/admin/vendor/get-addons?data[]=0&restaurant_id=<?php echo e($campaign['restaurant_id']); ?>','add_on');
            <?php endif; ?>
        });
    </script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/tags-input.min.js"></script>

    <script>
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="Choice Title" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="<?php echo e(__('messages.enter_choice_values')); ?>" data-role="tagsinput" onchange="combination_update()"></div></div>');
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        function combination_update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '<?php echo e(route('admin.food.variant-combination')); ?>',
                data: $('#campaign_form').serialize(),
                success: function (data) {
                    console.log(data.view);
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

    <script>
        $("#date_from").on("change", function () {
            $('#date_to').attr('min',$(this).val());
        });

        $("#date_to").on("change", function () {
            $('#date_from').attr('max',$(this).val());
        });

        $(document).ready(function(){
            $('#date_to').attr('min',('<?php echo e($campaign->start_date->format('Y-m-d')); ?>'));
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
            var zone_id = [];
            $('#zone').on('change', function(){
                if($(this).val())
                {
                    zone_id = [$(this).val()];
                }
                else
                {
                    zone_id = [];
                }
            });


            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/vendor/get-restaurants',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            zone_ids: zone_id,
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
        });

        $('#campaign_form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.campaign.update-item', [$campaign->id])); ?>',
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
                        toastr.success('Campaign uploaded successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.campaign.list', 'item')); ?>';
                        }, 2000);
                    }
                }
            });
        });
    </script>
    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == 'en')
            {
                $("#from_part_2").removeClass('d-none');
            }
            else
            {
                $("#from_part_2").addClass('d-none');
            }
        })
    </script>
    <script>
        $('#reset_btn').click(function(){
            // $('#viewer').attr('src','<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($campaign['image']); ?>');
            // $('#zone').val("<?php echo e($zone->id); ?>").trigger('change');
            // $('#restaurant_id').val("<?php echo e($campaign->restaurant->id); ?>").trigger('change');
            // $('#category_id').val(null).trigger('change');
            // $('#sub-categories').val(null).trigger('change');
            // $('#item_type').val("<?php echo e($campaign['veg']); ?>").trigger('change');
            // $('#add_on').val(null).trigger('change');
            // $('#choice_attributes').val(null).trigger('change');
            // $('#customer_choice_options').val(null).trigger('change');
            // $('#variant_combination').val(null).trigger('change');
            location.reload(true);
        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/campaign/item/edit.blade.php ENDPATH**/ ?>