<?php $__env->startSection('title', __('messages.reCaptcha Setup')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(__('messages.reCaptcha')); ?> <?php echo e(__('messages.credentials')); ?> <?php echo e(__('messages.setup')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row pb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <div class="flex-between">
                            <h3>
                                <img src="<?php echo e(asset('/public/assets/admin/img/recapcha.png')); ?>" alt="">
                                <?php echo e(__('messages.google')); ?> <?php echo e(__('messages.reCaptcha')); ?>

                            </h3>
                            <div class="btn-sm btn-dark p-2 initial-hidden" data-toggle="modal" data-target="#recaptcha-modal">
                                <i class="tio-info-outined"></i> <?php echo e(__('messages.Credentials SetUp')); ?>

                            </div>
                        </div>
                        <div class="mt-4">
                            <?php ($config=\App\CentralLogics\Helpers::get_business_settings('recaptcha')); ?>
                            <form
                                action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.recaptcha_update',['recaptcha']):'javascript:'); ?>"
                                method="post">
                                <?php echo csrf_field(); ?>

                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status"
                                            value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(__('messages.active')); ?></span>
                                    </label>
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" name="status"
                                            value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                        <span class="form-check-label text--title pl-2"><?php echo e(__('messages.inactive')); ?> </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="form-label text-capitalize"><?php echo e(__('messages.Site Key')); ?></label>
                                    <input type="text" class="form-control h--45px" name="site_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['site_key']??"":''); ?>" placeholder="6LdRxZMeAAAAAE9PRJOgJqCGDy9O2o-abXmZvtpw">
                                </div>

                                <div class="form-group">
                                    <label class="form-label text-capitalize"><?php echo e(__('messages.Secret Key')); ?></label>
                                    <input type="text" class="form-control h--45px" name="secret_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secret_key']??"":''); ?>" placeholder="6LdRxZMeAAAAAE9PRJOgJqCGDy9O2o-abXmZvtpw">
                                </div>

                                <div class="text-right">
                                    <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn btn--primary min-120px">
                                        <?php echo e(__('messages.save')); ?>

                                    </button>
                                </div>
                            </form>
                            
                            <div class="modal fade" id="recaptcha-modal" data-backdrop="static" data-keyboard="false"
                                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content <?php echo e(Session::get('direction') === 'rtl' ? 'text-right' : 'text-left'); ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="staticBackdropLabel"><?php echo e(__('messages.reCaptcha credential Set up Instructions')); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ol>
                                                <li><?php echo e(__('messages.Go to the Credentials page')); ?>

                                                    (<?php echo e(__('messages.Click')); ?> <a
                                                        href="https://www.google.com/recaptcha/admin/create"
                                                        target="_blank"><?php echo e(__('messages.here')); ?></a>)
                                                </li>
                                                <li><?php echo e(__('messages.Add a ')); ?>

                                                    <b><?php echo e(__('messages.label')); ?></b> <?php echo e(__('messages.(Ex: Test Label)')); ?>

                                                </li>
                                                <li>
                                                    <?php echo e(__('messages.Select reCAPTCHA v2 as ')); ?>

                                                    <b><?php echo e(__('messages.reCAPTCHA Type')); ?></b>
                                                    (<?php echo e(__("Sub type: I'm not a robot Checkbox")); ?>

                                                    )
                                                </li>
                                                <li>
                                                    <?php echo e(__('messages.Add')); ?>

                                                    <b><?php echo e(__('messages.domain')); ?></b>
                                                    <?php echo e(__('messages.(For ex: demo.6amtech.com)')); ?>

                                                </li>
                                                <li>
                                                    <?php echo e(__('messages.Check in ')); ?>

                                                    <b><?php echo e(__('messages.Accept the reCAPTCHA Terms of Service')); ?></b>
                                                </li>
                                                <li>
                                                    <?php echo e(__('messages.Press')); ?>

                                                    <b><?php echo e(__('messages.Submit')); ?></b>
                                                </li>
                                                <li><?php echo e(__('messages.Copy')); ?> <b>Site
                                                        Key</b> <?php echo e(__('messages.and')); ?> <b>Secret
                                                        Key</b>, <?php echo e(__('messages.paste in the input filed below and')); ?>

                                                    <b>Save</b>.
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn--primary"
                                                    data-dismiss="modal"><?php echo e(__('messages.Close')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/recaptcha-index.blade.php ENDPATH**/ ?>