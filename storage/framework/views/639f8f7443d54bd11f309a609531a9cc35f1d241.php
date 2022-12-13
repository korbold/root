<?php $__env->startSection('title',__('messages.landing_page_settings')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/admin/css/croppie.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <!-- Page Header -->
        <h1 class="page-header-title text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(asset('/public/assets/admin/img/landing-page.png')); ?>" class="mw-26px" alt="public">
            </div>
            <span>
                <?php echo e(__('messages.landing_page_settings')); ?>

            </span>
        </h1>
        <!-- End Page Header -->
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'index')); ?>"><?php echo e(__('messages.text')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'links')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.button_links')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'speciality')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.speciality')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'testimonial')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.testimonial')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'feature')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.feature')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'image')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.image')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo e(route('admin.business-settings.landing-page-settings', 'backgroundChange')); ?>"
                        aria-disabled="true"><?php echo e(__('messages.header_footer_bg')); ?></a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->
    <!-- Page Heading -->
    <div class="card my-2">
        <div class="card-body">
            <form action="<?php echo e(route('admin.business-settings.landing-page-settings', 'text')); ?>" method="POST">
                <?php ($landing_page_text = \App\Models\BusinessSetting::where(['key' => 'landing_page_text'])->first()); ?>
                <?php ($landing_page_text = isset($landing_page_text->value) ? json_decode($landing_page_text->value, true) : null); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label" for="header_title_1">Top Header Title</label>
                    <input type="text" id="header_title_1" name="header_title_1" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_1'] : ''); ?>" placehlder="Ex: Stackfood App">
                </div>
                <div class="form-group">
                    <label class="form-label" for="header_title_3">Sub Title 1</label>
                    <input type="text" id="header_title_3" name="header_title_3" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_3'] : ''); ?>" placeholder="Ex: 10% off !">
                </div>
                <div class="form-group">
                    <label class="form-label" for="header_title_2">Sub Title 2</label>
                    <input type="text" id="header_title_2" name="header_title_2" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_2'] : ''); ?>" placeholder="Ex: Why stay hungry when you can order from StackFood">
                </div>
                <div class="form-group">
                    <label class="form-label" for="about_title">About Section Title</label>
                    <input type="text" id="about_title" name="about_title" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['about_title'] : ''); ?>" placeholder="Ex: StackFood is Best Delivery Service Near You">
                </div>
                <div class="form-group">
                    <label class="form-label" for="feature_section_title"><?php echo e(__('messages.feature_section_title')); ?></label>
                    <input type="text" id="feature_section_title" name="feature_section_title" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text['feature_section_title']) ? $landing_page_text['feature_section_title'] : ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="feature_section_description"><?php echo e(__('messages.feature_section_description')); ?></label>
                    <textarea id="feature_section_description" name="feature_section_description" class="form-control" cols="30" rows="5"
                        placeholder="Feature section description">
                        <?php echo e(isset($landing_page_text['feature_section_description']) ? $landing_page_text['feature_section_description'] : ''); ?>

                    </textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="mobile_app_section_heading">Mobile App Section Title</label>
                    <input type="text" id="mobile_app_section_heading" name="mobile_app_section_heading" class="form-control h--45px"
                    value="<?php echo e(isset($landing_page_text['mobile_app_section_heading']) ? $landing_page_text['mobile_app_section_heading'] : ''); ?>">

                </div>
                <div class="form-group">
                    <label class="form-label" for="mobile_app_section_text">Mobile App Section Short Description</label>
                    <input type="text" id="mobile_app_section_text" name="mobile_app_section_text" class="form-control h--45px"
                    value="<?php echo e(isset($landing_page_text['mobile_app_section_text']) ? $landing_page_text['mobile_app_section_text'] : ''); ?>" placeholder="Mobile App Section Text">
                </div>
                <div class="form-group">
                    <label class="form-label" for="why_choose_us">Why Choose Us Section Title</label>
                    <input type="text" id="why_choose_us" name="why_choose_us" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['why_choose_us'] : ''); ?>" placeholder="Ex: Why choose us">
                </div>
                <div class="form-group">
                    <label class="form-label" for="why_choose_us_title">Why Choose Us Short Description</label>
                    <input type="text" id="why_choose_us_title" name="why_choose_us_title" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['why_choose_us_title'] : ''); ?>" placeholder="Ex: description">
                </div>
                <div class="form-group">
                    <label class="form-label" for="testimonial_title">Testimonial Section Title</label>
                    <input type="text" id="testimonial_title" name="testimonial_title" class="form-control h--45px"
                        value="<?php echo e(isset($landing_page_text) ? $landing_page_text['testimonial_title'] : ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="footer_article"><?php echo e(__('messages.footer_article')); ?></label>
                    <textarea type="text" id="footer_article" name="footer_article"
                        class="form-control"><?php echo e(isset($landing_page_text) ? $landing_page_text['footer_article'] : ''); ?></textarea>
                </div>
                <div class="form-group mb-0">
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script_2'); ?>
<script>
    $('document').ready(function() {
        $('textarea').each(function() {
            $(this).val($(this).val().trim());
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/landing-page-settings/index.blade.php ENDPATH**/ ?>