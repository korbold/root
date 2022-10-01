<?php $__env->startSection('title',__('messages.Update campaign')); ?>

<?php $__env->startPush('css_or_js'); ?>

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
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.campaign.update-basic',[$campaign['id']])); ?>" method="post" id=campaign-form
                      enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"><?php echo $translate[$lang]['description']??$campaign['description']; ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div id="<?php echo e($default_lang); ?>-form">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.title')); ?> (<?php echo e(translate('en')); ?>)</label>
                            <input type="text" name="title[]" class="form-control" placeholder="<?php echo e(__('messages.new_campaign')); ?>" value="<?php echo e($campaign['title']); ?>" maxlength="100" required>
                        </div>
                        <input type="hidden" name="lang[]" value="en">
                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.short')); ?> <?php echo e(__('messages.description')); ?></label>
                            <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px" maxlength="255"><?php echo $campaign['description']; ?></textarea>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label" for="title"><?php echo e(__('messages.start')); ?> <?php echo e(__('messages.date')); ?></label>
                                        <input type="date" id="date_from" class="form-control" required name="start_date" value="<?php echo e($campaign->start_date->format('Y-m-d')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-label" for="title"><?php echo e(__('messages.end')); ?> <?php echo e(__('messages.date')); ?></label>
                                    <input type="date" id="date_to" class="form-control" required="" name="end_date" value="<?php echo e($campaign->end_date->format('Y-m-d')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label text-capitalize" for="title"><?php echo e(__('messages.daily')); ?> <?php echo e(__('messages.start')); ?> <?php echo e(__('messages.time')); ?></label>
                                        <input type="time" id="start_time" class="form-control" name="start_time" value="<?php echo e($campaign->start_time); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-label text-capitalize" for="title"><?php echo e(__('messages.daily')); ?> <?php echo e(__('messages.end')); ?> <?php echo e(__('messages.time')); ?></label>
                                    <input type="time" id="end_time" class="form-control" name="end_time" value="<?php echo e($campaign->end_time); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-0 h-100 d-flex flex-column">
                                <label class="d-block text-center mb-3">
                                    <?php echo e(__('messages.campaign')); ?> <?php echo e(__('messages.image')); ?> <small class="text-danger">* ( <?php echo e(__('messages.ratio')); ?> 900x300 )</small>
                                </label>
                                <center class="mt-auto mb-auto">
                                    <img class="initial-11" id="viewer"
                                         src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($campaign->image); ?>"
                                         onerror="this.src='<?php echo e(asset('public/assets/admin/img/900x400/img1.png')); ?>'"
                                         alt="campaign image"/>
                                </center>
                                <div class="form-group">
                                    <div class="custom-file mt-3">
                                        <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?> <?php echo e(__('messages.file')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.update')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $("#date_from").on("change", function () {
            $('#date_to').attr('min',$(this).val());
        });

        $("#date_to").on("change", function () {
            $('#date_from').attr('max',$(this).val());
        });
        $(document).ready(function(){
            $('#date_from').attr('max','<?php echo e($campaign->end_date->format("Y-m-d")); ?>');
            $('#date_to').attr('min','<?php echo e($campaign->start_date->format("Y-m-d")); ?>');
        });
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

        $('#campaign-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.campaign.update-basic',[$campaign['id']])); ?>',
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
                        toastr.success('Campaign updated successfully!', {
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
                $('#viewer').attr('src','<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($campaign->image); ?>');
            })

        </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/campaign/basic/edit.blade.php ENDPATH**/ ?>