<?php $__env->startSection('title','Payment Setup'); ?>

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
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment.png')); ?>" alt="public">
                        </div>
                        <span>
                            Payment <?php echo e(__('messages.methods')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row pb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <h5 class="text-uppercase mb-3"><?php echo e(__('messages.payment')); ?> <?php echo e(__('messages.method')); ?></h5>
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('cash_on_delivery')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method-update',['cash_on_delivery'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>

                                <div class="form-group mb-2">
                                    <label class="form-label text--title">
                                        <strong><?php echo e(__('messages.cash_on_delivery')); ?></strong>
                                    </label>
                                </div>
                                <div class="d-flex flex-wrap p-0">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                        <span class="form-check-label text--title pl-2">
                                            <?php echo e(__('messages.active')); ?>

                                        </span>
                                    </label>
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="0" <?php echo e($config?($config['status']==0?'checked':''):''); ?>>
                                        <span class="form-check-label text--title pl-2">
                                            <?php echo e(__('messages.inactive')); ?>

                                        </span>
                                    </label>
                                </div>
                                <div class="text-right mt-4 pt-2 mr-2">
                                    <button type="submit" class="btn h--36px btn--primary"><?php echo e(__('messages.submit')); ?></button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <h5 class="text-uppercase mb-3"><?php echo e(__('messages.payment')); ?> <?php echo e(__('messages.method')); ?></h5>
                        <?php ($digital_payment=\App\CentralLogics\Helpers::get_business_settings('digital_payment')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method-update',['digital_payment'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                                <div class="form-group mb-2">
                                    <label class="form-label text-capitalize text--title">
                                        <strong><?php echo e(__('messages.digital')); ?> <?php echo e(__('messages.payment')); ?></strong>
                                    </label>
                                </div>

                                <div class="d-flex flex-wrap p-0">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                    <input type="radio" class="form-check-input digital_payment" name="status" value="1" <?php echo e($digital_payment?($digital_payment['status']==1?'checked':''):''); ?>>
                                        <span class="form-check-label text--title pl-2">
                                            <?php echo e(__('messages.active')); ?>

                                        </span>
                                    </label>
                                    <label class="form-check form--check mr-2 mr-md-4">
                                    <input type="radio" class="form-check-input digital_payment" name="status" value="0" <?php echo e($digital_payment?($digital_payment['status']==0?'checked':''):''); ?>>
                                        <span class="form-check-label text--title pl-2">
                                            <?php echo e(__('messages.inactive')); ?>

                                        </span>
                                    </label>
                                </div>
                                <div class="text-right mt-4 pt-2 mr-2">
                                    <button type="submit" class="btn h--36px btn--primary"><?php echo e(__('messages.submit')); ?></button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row digital_payment_methods gy-2 pb-3">
            <!-- This Design Will Implement On All Digital Payment Method Its an Static Design Card Start -->
            <?php ($config=\App\CentralLogics\Helpers::get_business_settings('ssl_commerz_payment')); ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <form
                        action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['ssl_commerz_payment']):'javascript:'); ?>"
                        method="post">
                        <?php echo csrf_field(); ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.sslcommerz')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" name="status" value="1" class="toggle-switch-input" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/sslcommerz.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" name="store_id" placeholder="Store ID" value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['store_id']:''):''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" name="store_password" placeholder="Store Password" value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['store_password']:''):''); ?>">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paypal')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['paypal']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.paypal')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/paypal.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Paypal Client Id" name="paypal_client_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['paypal_client_id']:''):''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Paypal Secret" name="paypal_secret"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paypal_secret']??'':''); ?>">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('razor_pay')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['razor_pay']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.razorpay')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/razorpay.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Razor Key" name="razor_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['razor_key']:''):''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Razor Secret" name="razor_secret"
                                           value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['razor_secret']:''):''); ?>">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('stripe')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['stripe']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.stripe')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/stripe.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Publish Key" name="published_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['published_key']:''):''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Api Key" name="api_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?($config?$config['api_key']:''):''); ?>">
                            </div>
                            <div class="text-right">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paystack')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['paystack']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.paystack')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <span class="badge badge-soft-danger"><?php echo e(__('messages.paystack_callback_warning')); ?></span>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/paystack.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Public Key" name="publicKey"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['publicKey']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Secret Key" name="secretKey"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secretKey']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Payment Url" name="paymentUrl"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paymentUrl']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Merchant Email" name="merchantEmail"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['merchantEmail']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="button" class="btn h--37px btn-success"onclick="copy_text('<?php echo e(url('/')); ?>/paystack-callback')"><?php echo e(__('messages.copy_callback')); ?></button>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('senang_pay')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['senang_pay']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.senang')); ?> <?php echo e(__('messages.pay')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/senang-pay.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Secret Key" name="secret_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secret_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Merchant Key" name="merchant_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['merchant_id']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('flutterwave')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['flutterwave']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.flutterwave')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/flutterwave.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Public Key" name="public_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['public_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Secret Key" name="secret_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secret_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Hash" name="hash"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['hash']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('mercadopago')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['mercadopago']):'javascript:'); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.mercadopago')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/mercador-pago.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Public Key" name="public_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['public_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Access Token" name="access_token"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['access_token']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paymob_accept')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['paymob_accept']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.paymob_accept')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/paymob.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <label class="<?php echo e(Session::get('direction') === 'rtl' ? 'pr-3' : 'pl-3'); ?>"><?php echo e(__('messages.callback')); ?></label>
                                <span class="btn btn-secondary btn-sm m-2"
                                    onclick="copyToClipboard('#id_paymob_accept')"><i class="tio-copy"></i> <?php echo e(__('messages.copy_callback')); ?></span>
                                
                                <p class="form-control" id="id_paymob_accept"><?php echo e(url('/')); ?>/paymob-callback</p>
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Api Key" name="api_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Iframe Id" name="iframe_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['iframe_id']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Integration Id" name="integration_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['integration_id']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="HMAC" name="hmac"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['hmac']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('bkash')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['bkash']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.bkash')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/bkash.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Api Key" name="api_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Api Secret" name="api_secret"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_secret']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Username" name="username"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['username']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Password" name="password"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['password']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paytabs')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['paytabs']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.paytabs')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/paytabs.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Profile Id" name="profile_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['profile_id']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Server Key" name="server_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['server_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Base Url by Region" name="base_url"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['base_url']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paytm')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['paytm']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.paytm')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/paytm.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Paytm Merchant Key" name="paytm_merchant_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paytm_merchant_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Paytm Merchant Mid" name="paytm_merchant_mid"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paytm_merchant_mid']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Merchant Website" name="paytm_merchant_website"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paytm_merchant_website']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-30px">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('liqpay')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update',['liqpay']):'javascript:'); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                        <h5 class="d-flex flex-wrap justify-content-between">
                            <strong><?php echo e(__('messages.liqpay')); ?></strong>
                            <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                <span class="mr-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                <span class="mr-2 switch--custom-label-text off text-uppercase">Off</span>
                                <input type="checkbox" class="toggle-switch-input" name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </h5>
                        <div class="payment--gateway-img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/payment/liqpay.png')); ?>" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Public Key" name="public_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['public_key']:''); ?>">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" placeholder="Private Key" name="private_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['private_key']:''); ?>">
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn h--37px btn--primary"><?php echo e(__('messages.save')); ?></button>
                            </div>
                            <?php else: ?>
                            <button type="submit"
                                    class="btn btn--primary mb-2"><?php echo e(__('messages.configure')); ?></button>



                        <?php endif; ?>

                    </form>
                    </div>
                </div>
            </div>
            <!-- This Design Will Implement On All Digital Payment Method Its an Static Design Card End -->


            <!-- All Payment Gateway Commented Start Here  -->
            <!-- Required payment gateway images are inside of public/admin/img/payment/ folder  -->

            

            <!-- All Payment Gateway Commented End Here -->

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    <?php if(!isset($digital_payment) || $digital_payment['status']==0): ?>
        $('.digital_payment_methods').addClass('blurry');
    <?php endif; ?>
    $(document).ready(function () {
        $('.digital_payment').on('click', function(){
            if($(this).val()=='0')
            {
                $('.digital_payment_methods').addClass('blurry');
            }
            else
            {
                $('.digital_payment_methods').removeClass('blurry');
            }
        })
    });
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();

        toastr.success("<?php echo e(__('messages.text_copied')); ?>");
    }

    function checkedFunc() {
        $('.switch--custom-label .toggle-switch-input').each( function() {
            if(this.checked) {
                $(this).closest('.switch--custom-label').addClass('checked')
            }else {
                $(this).closest('.switch--custom-label').removeClass('checked')
            }
        })
    }
    checkedFunc()
    $('.switch--custom-label .toggle-switch-input').on('change', checkedFunc)

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/payment-index.blade.php ENDPATH**/ ?>