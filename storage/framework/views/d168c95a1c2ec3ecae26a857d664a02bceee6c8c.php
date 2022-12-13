<?php
$theme_value = \App\Models\BusinessSetting::where('key', 'theme')->first()->value;
?>

<?php $__env->startSection('title', translate('themes')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/radio-image.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('/public/assets/admin/img/theme.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(translate('messages.change_theme_for_user_app')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.business-settings.theme-settings-update')); ?>" method="post"
                    enctype="multipart/form-data" class="pt-md-5">
                    <?php echo csrf_field(); ?>
                    <div class="form-group" id="user_app_theme">
                        
                        <div class="row">
                            <div class='col-md-3 col-sm-6 col-12 text-center'>
                                <input type="radio" name="theme" require id="img1" class="d-none imgbgchk" value="1"
                                    <?php echo e($theme_value == 1 ? 'checked' : ''); ?>>

                                <label for="img1">
                                    <img class="img-thumbnail rounded"
                                        src="<?php echo e(asset('public/assets/admin/img/Theme-1.png')); ?>" alt="Image 1">
                                </label>
                            </div>
                            <div class='col-md-3 col-sm-6 col-12 text-center'>
                                <input type="radio" name="theme" require id="img2" class="d-none imgbgchk" value="2" <?php echo e($theme_value == 2 ? 'checked' : ''); ?>>
                                <label for="img2">
                                    <img class="img-thumbnail rounded"
                                        src="<?php echo e(asset('public/assets/admin/img/Theme-2.png')); ?>" alt="Image 2">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <div class="btn--container justify-content-end">
                            <button type="submit" class="btn btn--primary"><?php echo e(__('messages.apply')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script_2'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/theme-settings.blade.php ENDPATH**/ ?>