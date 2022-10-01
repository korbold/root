<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
        $app_name = \App\CentralLogics\Helpers::get_business_settings('business_name', false);
        $icon = \App\CentralLogics\Helpers::get_business_settings('icon', false);
    ?>
    <!-- Title -->
    <title><?php echo e(__('messages.admin')); ?>  <?php echo e(__('messages.login')); ?> | <?php echo e($app_name??'STACKFOOD'); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset($icon ? 'storage/app/public/business/'.$icon : 'public/favicon.ico')); ?>">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/toastr.css">
</head>

<body>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main auth-bg">
    <!-- Content -->
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="auth-content">
            <div class="content">
                <h2 class="title text-uppercase"><?php echo e(translate('messages.welcome_to_app',['app_name'=>$app_name??'STACKFOOD'])); ?></h2>
                <p>
                    <?php echo e(translate('Manage your app & website easily')); ?>

                </p>
            </div>
        </div>
        <div class="auth-wrapper">
            <div class="auth-wrapper-body auth-form-appear">
                <?php ($systemlogo=\App\Models\BusinessSetting::where(['key'=>'logo'])->first()->value); ?>
                <a class="auth-logo mb-5" href="javascript:">
                    <img class="z-index-2" src="<?php echo e(asset('/public/assets/admin/img/zatu.png')); ?>">
                </a>
                <div class="text-center">
                    <div class="auth-header mb-5">
                        <h2 class="signin-txt"><?php echo e(__('messages.admin')); ?> <?php echo e(__('messages.signin')); ?></h2>
                        <p class="text-capitalize"><?php echo e(__('messages.want')); ?> <?php echo e(__('messages.to')); ?> <?php echo e(__('messages.login')); ?> <?php echo e(__('messages.your')); ?> <?php echo e(__('messages.vendors')); ?>?
                            <a href="<?php echo e(route('vendor.auth.login')); ?>" class="text-yellow">
                                <?php echo e(__('messages.vendor')); ?> <?php echo e(__('messages.login')); ?>

                            </a>
                        </p>
                        
                    </div>
                </div>
                <!-- Content -->
                <label class="badge badge-soft-success float-right initial-1">
                    <?php echo e(__('messages.software_version')); ?> : <?php echo e(env('SOFTWARE_VERSION')); ?>

                </label>
                <!-- Form -->
                <form class="login_form" action="<?php echo e(route('admin.auth.login')); ?>" method="post" id="form-id">
                    <?php echo csrf_field(); ?>
                    <!-- Form Group -->
                    <div class="js-form-message form-group mb-2">
                        <label class="form-label text-capitalize" for="signinSrEmail"><?php echo e(__('messages.your')); ?> <?php echo e(__('messages.email')); ?></label>
                        <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                            tabindex="1" aria-label="email@address.com"
                            required data-msg="Please enter a valid email address.">
                        <div class="focus-effects"></div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label text-capitalize" for="signupSrPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                            <?php echo e(__('messages.password')); ?>

                            </span>
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                name="password" id="signupSrPassword"
                                aria-label="<?php echo e(__('messages.password_length_placeholder',['length'=>'6+'])); ?>" required
                                data-msg="<?php echo e(__('messages.invalid_password_warning')); ?>"
                                data-hs-toggle-password-options='{
                                            "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>

                            <div class="focus-effects"></div>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->
                        <div class="mb-2"></div>
                    <!-- Checkbox -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                name="remember">
                            <label class="custom-control-label text-muted" for="termsCheckbox">
                                <?php echo e(__('messages.remember_me')); ?>

                            </label>
                        </div>
                    </div>
                    <!-- End Checkbox -->

                    
                    <?php ($recaptcha = \App\CentralLogics\Helpers::get_business_settings('recaptcha')); ?>
                    <?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
                        <div id="recaptcha_element" class="w-100" data-type="image"></div>
                        <br/>
                    <?php else: ?>
                        <div class="row py-2">
                            <div class="col-6 pr-0">
                                <input type="text" class="form-control form-control-lg form-recapcha" name="custome_recaptcha"
                                    id="custome_recaptcha" required placeholder="<?php echo e(\__('Enter recaptcha value')); ?>" autocomplete="off" value="<?php echo e(env('APP_DEBUG')?session('six_captcha'):''); ?>">
                            </div>
                            <div class="col-6">
                                <div class="capcha--img bg-white rounded">
                                    <img src="<?php echo $custome_recaptcha->inline(); ?>" class="form-control form-control-lg p-0 border-0"/>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-lg btn-block btn-primary"><?php echo e(__('messages.sign_in')); ?></button>
                </form>
                <!-- End Form -->

                <!-- End Content -->
            </div>
            <?php if(env('APP_MODE')=='demo'): ?>
                <div class="auto-fill-data-copy">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <span class="d-block"><strong>Email</strong> : admin@admin.com</span>
                            <span class="d-block"><strong>Password</strong> : 12345678</span>
                        </div>
                        <div>
                            <button class="btn btn-primary m-0" onclick="copy_cred()"><i class="tio-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


<!-- JS Implementing Plugins -->
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/vendor.min.js"></script>

<!-- JS Front -->
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/toastr.js"></script>
<?php echo Toastr::message(); ?>


<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>


<?php if(isset($recaptcha) && $recaptcha['status'] == 1): ?>
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '<?php echo e(\App\CentralLogics\Helpers::get_business_settings('recaptcha')['site_key']); ?>'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#form-id").on('submit',function(e) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                e.preventDefault();
                toastr.error("<?php echo e(__('messages.Please check the recaptcha')); ?>");
            }
        });
    </script>
<?php endif; ?>




<?php if(env('APP_MODE')=='demo'): ?>
    <script>
        function copy_cred() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
<?php endif; ?>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="<?php echo e(asset('public//assets/admin')); ?>/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/auth/login.blade.php ENDPATH**/ ?>