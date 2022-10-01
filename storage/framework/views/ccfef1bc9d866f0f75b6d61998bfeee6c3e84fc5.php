<?php $__env->startSection('title','Add new campaign'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="tio-add-circle-outlined"></i></div>
                        <?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?> <?php echo e(__('messages.campaign')); ?>

                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.campaign.store-basic')); ?>" method="post" enctype="multipart/form-data" id="campaign-form">
                    <?php echo csrf_field(); ?>
                    <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php ($default_lang = 'bn'); ?>
                    <?php if($language): ?>
                        <?php ($default_lang = json_decode($language)[0]); ?>
                        <ul class="nav nav-tabs mb-4">
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link <?php echo e($lang == $default_lang? 'active':''); ?>" href="#" id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-1 <?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form" id="<?php echo e($lang); ?>-form">
                                <div class="form-group">
                                    <label class="input-label" for="<?php echo e($lang); ?>_title"><?php echo e(__('messages.title')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input type="text" <?php echo e($lang == $default_lang? 'required':''); ?> name="title[]" id="<?php echo e($lang); ?>_title" class="form-control h--45px" placeholder="Ex: <?php echo e(__('messages.new_campaign')); ?>" oninvalid="document.getElementById('en-link').click()">
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <div class="form-group mb-0">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <textarea type="text" name="description[]" class="form-control ckeditor"></textarea>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div class="mb-1" id="<?php echo e($default_lang); ?>-form">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.title')); ?> (<?php echo e(translate('en')); ?>)</label>
                            <input type="text" name="title[]" class="form-control h--45px" placeholder="Ex: <?php echo e(__('messages.new_food')); ?>" required>
                        </div>
                        <input type="hidden" name="lang[]" value="en">
                        <div class="form-group mb-0">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?></label>
                            <textarea type="text" name="description[]" class="form-control ckeditor"></textarea>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="title"><?php echo e(__('messages.start')); ?> <?php echo e(__('messages.date')); ?></label>
                                        <input type="date" id="date_from" class="form-control h--45px" required="" name="start_date">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-label" for="title"><?php echo e(__('messages.end')); ?> <?php echo e(__('messages.date')); ?></label>
                                    <input type="date" id="date_to" class="form-control h--45px" required="" name="end_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label text-capitalize" for="title"><?php echo e(__('messages.daily')); ?> <?php echo e(__('messages.start')); ?> <?php echo e(__('messages.time')); ?></label>
                                        <input type="time" id="start_time" class="form-control h--45px" name="start_time">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-label text-capitalize" for="title"><?php echo e(__('messages.daily')); ?> <?php echo e(__('messages.end')); ?> <?php echo e(__('messages.time')); ?></label>
                                    <input type="time" id="end_time" class="form-control h--45px" name="end_time">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group m-0 h-100 d-flex flex-column">
                                <label class="d-block text-center mb-0">
                                    <?php echo e(__('messages.campaign')); ?> <?php echo e(__('messages.image')); ?>

                                    <small class="text-danger">* ( <?php echo e(__('messages.ratio')); ?> 300x100 )</small>
                                </label>
                                <center class="mt-auto mb-auto">
                                    <img class="initial-12" id="viewer"
                                         src="<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>" alt="campaign image"/>
                                </center>
                                <div class="form-group">
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


        function show_item(type) {
            if (type === 'product') {
                $("#type-product").show();
                $("#type-category").hide();
            } else {
                $("#type-product").hide();
                $("#type-category").show();
            }
        }

        $("#date_from").on("change", function () {
            $('#date_to').attr('min',$(this).val());
        });

        $("#date_to").on("change", function () {
            $('#date_from').attr('max',$(this).val());
        });
        $(document).ready(function(){
            $('#date_from').attr('min',(new Date()).toISOString().split('T')[0]);
            $('#date_to').attr('min',(new Date()).toISOString().split('T')[0]);
        });

        $('#campaign-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.campaign.store-basic')); ?>',
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
                        toastr.success('Campaign created successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.campaign.list', 'basic')); ?>';
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
            if(lang == '<?php echo e($default_lang); ?>')
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
                $('#choice_item').val(null).trigger('change');
                $('#viewer').attr('src','<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>');
            })
        </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/campaign/basic/index.blade.php ENDPATH**/ ?>