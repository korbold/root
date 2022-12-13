<?php $__env->startSection('title','SMS Module Setup'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/sms.png')); ?>" alt="public">
                        </div>
                        <span>
                            <?php echo e(__('messages.sms')); ?> <?php echo e(__('messages.gateway')); ?> <?php echo e(__('messages.setup')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row gy-3">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body p-30px">
                        <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                            <span><?php echo e(__('messages.twilio_sms')); ?></span>
                            <div class="pl-2">
                                <img src="<?php echo e(asset('/public/assets/admin/img/twilio.png')); ?>" alt="public">
                            </div>
                        </h5>
                        <span class="badge badge-soft-info mb-3 white--space">NB : #OTP# will be replace with otp</span>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('twilio_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['twilio_sms']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex flex-wrap mb-4">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2">
                                        <?php echo e(__('messages.active')); ?>

                                    </span>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2">
                                        <?php echo e(__('messages.inactive')); ?>

                                    </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label">
                                    <?php echo e(__('messages.sid')); ?>

                                </label>
                                <input type="text" class="form-control h--45px text--subbody" name="sid"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['sid']??"":''); ?>" placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label">
                                    <?php echo e(__('messages.messaging_service_id')); ?>

                                </label>
                                <input type="text" class="form-control h--45px text--subbody" name="messaging_service_id"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['messaging_service_id']??"":''); ?>" placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label">
                                    <?php echo e(__('messages.token')); ?>

                                </label>
                                <input type="text" class="form-control h--45px text--subbody" name="token"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['token']??"":''); ?>" placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.from')); ?></label>
                                <input type="text" class="form-control h--45px text--subbody" name="from"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['from']??"":''); ?>" placeholder="Ex: +91-46482373636">
                            </div>

                            <div class="form-group">
                                <label class="form-label text-capitalize">
                                    <?php echo e(__('messages.otp_template')); ?>

                                </label>
                                <input type="text" class="form-control h--45px text--subbody" name="otp_template"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['otp_template']??"":''); ?>" placeholder="Ex : Your OTP is #otp#">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body p-30px">
                        <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                            <span><?php echo e(__('messages.nexmo_sms')); ?></span>
                            <div class="pl-2">
                                <img src="<?php echo e(asset('/public/assets/admin/img/nexmo.png')); ?>" alt="public">
                            </div>
                        </h5>
                        <span class="badge badge-soft-info mb-3 white--space">NB : #OTP# will be replace with otp</span>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('nexmo_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['nexmo_sms']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex flex-wrap mb-4">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2"><?php echo e(__('messages.active')); ?></span>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2"><?php echo e(__('messages.inactive')); ?> </span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.api_key')); ?></label>
                                <input type="text" class="form-control h--45px text--subbody" name="api_key"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']??"":''); ?>" placeholder="Ex :5923ec0959">
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.api_secret')); ?></label>
                                <input type="text" class="form-control h--45px text--subbody" name="api_secret"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_secret']??"":''); ?>" placeholder="Ex : RYysbkdscnUIizx">
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.from')); ?></label><br>
                                <input type="text" class="form-control h--45px text--subbody" name="from"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['from']??"":''); ?>" placeholder="Ex : +91-37384748392">
                            </div>

                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.otp_template')); ?></label><br>
                                <input type="text" class="form-control h--45px text--subbody" name="otp_template"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['otp_template']??"":''); ?>" placeholder="Ex : Your OTP is #otp#">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                class="btn btn--primary">
                                    <?php echo e(__('messages.save')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body p-30px">
                        <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                            <span><?php echo e(__('messages.2factor_sms')); ?></span>
                            <div class="pl-2">
                                <img src="<?php echo e(asset('/public/assets/admin/img/twilio.png')); ?>" alt="public">
                            </div>
                        </h5>
                        <span class="badge badge-soft-info mb-1 white--space">EX of SMS provider's template : your OTP is XXXX here, please check.</span><br>
                        <span class="badge badge-soft-info mb-3 white--space">NB : XXXX will be replace with otp</span>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('2factor_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['2factor_sms']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="d-flex flex-wrap mb-4">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                    <label class="form-check-label text--title pl-2"><?php echo e(__('messages.active')); ?></label>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?> >
                                    <label class="form-check-label text--title pl-2"><?php echo e(__('messages.inactive')); ?> </label>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.api_key')); ?></label>
                                <input type="text" class="form-control" name="api_key"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']??"":''); ?>" placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164 ">
                            </div>

                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn--primary"><?php echo e(__('messages.save')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body p-30px">
                        <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                            <span><?php echo e(__('messages.msg91_sms')); ?></span>
                            <div class="pl-2">
                                <img src="<?php echo e(asset('/public/assets/admin/img/nexmo.png')); ?>" alt="public">
                            </div>
                        </h5>
                        <span class="badge badge-soft-info mb-3 white--space">NB : Keep an OTP variable in your SMS providers OTP Template.</span><br>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('msg91_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['msg91_sms']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex flex-wrap mb-4">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2"><?php echo e(__('messages.active')); ?></span>
                                </label>
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                    <span class="form-check-label text--title pl-2"><?php echo e(__('messages.inactive')); ?> </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.template_id')); ?></label>
                                <input type="text" class="form-control h--45px text--subbody" name="template_id"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['template_id']??"":''); ?>"  placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164 ">
                            </div>
                            <div class="form-group">
                                <label class="text-capitalize form-label"><?php echo e(__('messages.authkey')); ?></label>
                                <input type="text" class="form-control h--45px text--subbody" name="authkey"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['authkey']??"":''); ?>"  placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164 ">
                            </div>

                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/sms-index.blade.php ENDPATH**/ ?>