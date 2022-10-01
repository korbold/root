<?php $__env->startSection('title', 'Landing Page | ' . \App\Models\BusinessSetting::where(['key' => 'business_name'])->first()->value ??
    'Stackfood'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Basic Settings -->
    <?php ($front_end_url = \App\Models\BusinessSetting::where(['key' => 'front_end_url'])->first()); ?>
    <?php ($front_end_url = $front_end_url ? $front_end_url->value : null); ?>
    <?php ($landing_page_text = \App\Models\BusinessSetting::where(['key' => 'landing_page_text'])->first()); ?>
    <?php ($landing_page_text = isset($landing_page_text->value) ? json_decode($landing_page_text->value, true) : null); ?>
    <?php ($landing_page_links = \App\Models\BusinessSetting::where(['key' => 'landing_page_links'])->first()); ?>
    <?php ($landing_page_links = isset($landing_page_links->value) ? json_decode($landing_page_links->value, true) : null); ?>
    <?php ($landing_page_images = \App\Models\BusinessSetting::where(['key' => 'landing_page_images'])->first()); ?>
    <?php ($landing_page_images = isset($landing_page_images->value) ? json_decode($landing_page_images->value, true) : null); ?>
    <!-- Hero Section -->
    <section>
        <div class="container">
            <div class="row hero-content-main">
                <div class="col-lg-6 col-md-6 col-sm-12 hero-content responsive-ps ps-5 ">
                    <h3 class="animate__animated animate__backInRight hero-title-top">
                        <?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_3'] : ''); ?>

                    </h3>
                    <h1 class="animate__animated animate__backInLeft hero-title-main">
                        <?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_1'] : ''); ?>

                    </h1>
                    <h4 class="animate__animated animate__bounceIn animate__delay-1s hero-title-three">
                        <?php echo e(isset($landing_page_text) ? $landing_page_text['header_title_2'] : ''); ?>

                    </h4>
                    <div class="app-logo animate__animated animate__fadeInDown">
                        <?php if($landing_page_links['app_url_android_status']): ?>
                            <a href="<?php echo e($landing_page_links['app_url_android']); ?>">
                                <img class="img-fluid" src="<?php echo e(asset('public/assets/landing')); ?>/image/playstore.png"
                                    alt="Play store" />
                            </a>
                        <?php endif; ?>
                        <?php if($landing_page_links['app_url_ios_status']): ?>
                            <a href="<?php echo e($landing_page_links['app_url_ios']); ?>">
                                <img class="img-fluid"
                                    src="<?php echo e(asset('public/assets/landing')); ?>/image/apple_store.png" alt="iOS App">
                            </a>
                        <?php endif; ?>
                        <?php if($landing_page_links['web_app_url_status']): ?>
                            <a href="<?php echo e($landing_page_links['web_app_url']); ?>">
                                <img class="img-fluid" src="<?php echo e(asset('public/assets/landing')); ?>/image/browse.png">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e(isset($landing_page_images['top_content_image'])?$landing_page_images['top_content_image']:'double_screen_image.png'); ?>" alt="Image One"
                        class="img-fluid hero-content-image animate__animated animate__bounceInRight" />
                </div>
            </div>
        </div>
    </section>
    <!-- About us section -->
    <section class="about-section">
        <div class="container">
            <div class="row about-section-row">
                <div class="col-lg-6 col-md-6 col-sm-12 about-us-left justify-content-center">
                    <img class="img-fluid animate__animated animate__fadeInDown about-us-image w-100"
                        src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e(isset($landing_page_images['about_us_image']) ? $landing_page_images['about_us_image'] : 'about_us_image.png'); ?>"
                        alt="Image" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 about-us-right-column">
                    <div class="about-us__right animate__animated animate__backInRight">
                        <h3><?php echo e(__('messages.about_us')); ?></h3>
                        <h2><?php echo e(isset($landing_page_text) ? $landing_page_text['about_title'] : ''); ?></h2>
                        <p class="about-us-text">
                            <?php echo \Illuminate\Support\Str::limit(\App\CentralLogics\Helpers::get_settings('about_us'), 200); ?>

                        </p>
                        <a href="<?php echo e(route('about-us')); ?>"
                            class="btn btn-lg read-more mt-4"><?php echo e(__('messages.read_more')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Features -->
    <?php ($feature = \App\Models\BusinessSetting::where(['key' => 'feature'])->first()); ?>
    <?php ($feature = isset($feature->value) ? json_decode($feature->value, true) : null); ?>
    <?php if($feature && count($feature) > 0): ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-5 stuning-feature">
                        <div class="service-left animate__animated animate__backInLeft">
                            <h2 class="section-heading"><?php echo e(isset($landing_page_text['feature_section_title']) ? $landing_page_text['feature_section_title'] :__('messages.our_features')); ?></h2>
                            <p class="stuning-p">
                                <?php echo e(isset($landing_page_text['feature_section_description']) ? $landing_page_text['feature_section_description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ex odio,  turpis accumsan congue.'); ?>

                            </p>
                        </div>
                        <?php $__currentLoopData = $feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center feature">
                                <div class="flex-shrink-0">
                                    <img class="img-fluid feature-image animate__animated animate__fadeInDown"
                                        src="<?php echo e(asset('public/assets/landing/')); ?>/image/<?php echo e($feature_data['img']); ?>"
                                        alt="Image" />
                                </div>
                                <div class="flex-grow-1 ms-3 feature-service">
                                    <h4><?php echo e($feature_data['title']); ?></h4>
                                    <p>
                                        <?php echo e($feature_data['feature_description']); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 about-us-left">
                        <img class="img-fluid stuning-image w-100"
                            src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e(isset($landing_page_images['feature_section_image']) ? $landing_page_images['feature_section_image'] : 'about_us_image.png'); ?>" alt="About us" />
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Apps -->
    <?php if($landing_page_links['app_url_android_status'] !== null || $landing_page_links['app_url_ios_status'] !== null): ?>
        <section class="pt-lg-5 pb-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 about-us-left">
                        <img class="img-fluid our-app-image w-100"
                            src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e(isset($landing_page_images['mobile_app_section_image']) ? $landing_page_images['mobile_app_section_image'] : 'our_app_image.png'); ?>" alt="Image" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 our-app-text-box">
                        <div class="about-us-right align-center">
                            <h3><?php echo e(__('messages.our_mobile_applications')); ?></h3>
                            <h2><?php echo e(isset($landing_page_text['mobile_app_section_heading']) ? $landing_page_text['mobile_app_section_heading'] : 'Mobile app section heading'); ?>

                            </h2>
                            <p class="about-text">
                                <?php echo e(isset($landing_page_text['mobile_app_section_text']) ? $landing_page_text['mobile_app_section_text'] : 'Mobile App Section Paragraph'); ?>

                            </p>
                            <div class="app-section-logo animate__animated animate__fadeInDown">
                                <?php if($landing_page_links['app_url_android_status']): ?>
                                    <a href="<?php echo e($landing_page_links['app_url_android']); ?>" target="_blank">
                                        <img class="img-fluid w-100"
                                            src="<?php echo e(asset('public/assets/landing')); ?>/image/playstore.png"
                                            alt="Play store" />
                                    </a>&nbsp;
                                <?php endif; ?>
                                <?php if($landing_page_links['app_url_ios_status']): ?>
                                    <a href="<?php echo e($landing_page_links['app_url_ios']); ?>" target="_blank">
                                        <img class="img-fluid apple-store w-100"
                                            src="<?php echo e(asset('public/assets/landing')); ?>/image/apple_store.png"
                                            alt="iOS App" />
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Why Choose Us -->
    <?php ($speciality = \App\Models\BusinessSetting::where(['key' => 'speciality'])->first()); ?>
    <?php ($speciality = isset($speciality->value) ? json_decode($speciality->value, true) : null); ?>
    <?php if(isset($speciality) && count($speciality) > 0): ?>
        <section class="pt-lg-5 pb-lg-5">
            <div class="container why-choose-us">
                <div class="row text-center d-flex justify-content-center responsive-css">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h2 class="section-heading">
                            <?php echo e(isset($landing_page_text) ? $landing_page_text['why_choose_us'] : ''); ?></h2>
                        <p class="why-choose-text">
                            <?php echo e(isset($landing_page_text) ? $landing_page_text['why_choose_us_title'] : ''); ?></p>
                        <div class="main-heading-underline mx-auto"></div>
                    </div>
                    <?php $__currentLoopData = $speciality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-12 custom-card ">
                            <div class="card card-square shadow">
                                <img class="img-fluid mt-3"
                                    src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e($sp['img']); ?>" alt="Image" />
                                <div class="card-body my-card-body">
                                    <h4 class="box-card-heading"><?php echo e($sp['title']); ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="subscription">
        <div class="container">
            <div class="subscription">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h2 class="news-letter-heading"><?php echo e(__('messages.news_letter_signup')); ?></h2>
                        <p class="news-letter-text">

                            <?php echo e(__('messages.news_letter_signup_text')); ?>

                        </p>
                        <div class="news-heading-underline mx-auto"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <form id="newsLetterForm" method="post" action="<?php echo e(route('newsletter.subscribe')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="email" name="email" class="form-control newsletter--input"
                                    placeholder="Enter Valid Email" value="<?php echo e(old('email')); ?>" required> <br>
                                <button type="submit" class="btn btn-info subscribe-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php ($testimonial = \App\Models\BusinessSetting::where(['key' => 'testimonial'])->first()); ?>
    <?php ($testimonial = isset($testimonial->value) ? json_decode($testimonial->value, true) : null); ?>
    <?php if($testimonial && count($testimonial) > 0): ?>
        <section class="customer-testimonial">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h2 class="section-heading client-review-mt">
                            <?php echo e(isset($landing_page_text) ? $landing_page_text['testimonial_title'] : ''); ?>

                        </h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-center text-center">
                    <div class="owl-carousel mt-4">
                        <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col owl-item">
                                <div class="testimonial">
                                    <div class="pic">
                                        <img src="<?php echo e(asset('public/assets/landing')); ?>/image/<?php echo e($data['img']); ?>"
                                            alt="Image">
                                    </div>
                                    <div class="testimonial-content">
                                        <h3 class="testimonial-title">
                                            <?php echo e($data['name']); ?>

                                            <small class="post"><?php echo e($data['position']); ?></small>
                                        </h3>
                                        <p class="description">
                                            <?php echo e($data['detail']); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script_2'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/home.blade.php ENDPATH**/ ?>