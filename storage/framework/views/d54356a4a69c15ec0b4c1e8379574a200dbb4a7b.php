<?php $__env->startSection('title','FCM Settings'); ?>

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
                            <img src="<?php echo e(asset('/public/assets/admin/img/bell.png')); ?>" alt="public">
                        </div>
                        <span>
                            <?php echo e(__('messages.notification')); ?> <?php echo e(__('messages.setting')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">

            <div class="card-body">
                <h2 class="mb-3 pb-3"><?php echo e(translate('messages.firebase_credentials')); ?></h2>
                <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.update-fcm'):'javascript:'); ?>" method="post"
                        enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php ($key=\App\Models\BusinessSetting::where('key','push_notification_key')->first()); ?>
                    <div class="form-group">
                        <label class="input-label form-label"
                                for="exampleFormControlInput1"><?php echo e(__('messages.server')); ?> <?php echo e(__('messages.key')); ?></label>
                                <div class="d-flex">
                            <input type="text" name="push_notification_key" class="form-control w-50 flex-grow-1 h--45px" placeholder="Ex : AAAA9Gb8H_I:APA91bHgVLGopGJibQIPZHcLT" required value="<?php echo e(env('APP_MODE')!='demo'?$key->value??'':''); ?>">
                        </div>
                    </div>

                    <?php ($project_id=\App\Models\BusinessSetting::where('key','fcm_project_id')->first()); ?>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('FCM Project ID')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e($project_id->value??''); ?>"
                                name="projectId" class="form-control" placeholder="Ex : Project Id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.api_key')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['apiKey'])?$fcm_credentials['apiKey']:''); ?>"
                                name="apiKey" class="form-control" placeholder="Ex : Api key">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.auth_domain')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['authDomain'])?$fcm_credentials['authDomain']:''); ?>"
                                name="authDomain" class="form-control" placeholder="Ex : Auth domain">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.storage_bucket')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['storageBucket'])?$fcm_credentials['storageBucket']:''); ?>"
                                name="storageBucket" class="form-control" placeholder="Ex : Storeage bucket">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.messaging_sender_id')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['messagingSenderId'])?$fcm_credentials['messagingSenderId']:''); ?>"
                                name="messagingSenderId" class="form-control" placeholder="Ex : Messaging sender id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.app_id')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['appId'])?$fcm_credentials['appId']:''); ?>"
                                name="appId" class="form-control" placeholder="Ex : App Id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.measurement_id')); ?></label>
                        <div class="d-flex">
                            <input type="text" value="<?php echo e(isset($fcm_credentials['measurementId'])?$fcm_credentials['measurementId']:''); ?>"
                                name="measurementId" class="form-control" placeholder="Ex : Measurement Id">
                        </div>
                    </div>



                    <div class="text-right">
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3 pb-3"><?php echo e(__('messages.push')); ?> <?php echo e(__('messages.notification')); ?> <?php echo e(__('messages.messages')); ?></h2>
                <form action="<?php echo e(route('admin.business-settings.update-fcm-messages')); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <?php ($opm=\App\Models\BusinessSetting::where('key','order_pending_message')->first()); ?>
                        <?php ($data=$opm?json_decode($opm->value,true):null); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.pending')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="pending_status">
                                    <input type="checkbox" name="pending_status" class="toggle-switch-input"
                                        value="1" id="pending_status" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="pending_message"
                                        class="form-control" placeholder="Ex : Your order is successfully placed"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($ocm=\App\Models\BusinessSetting::where('key','order_confirmation_msg')->first()); ?>
                        <?php ($data=$ocm?json_decode($ocm->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.confirmation')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="confirm_status">
                                        <input type="checkbox" name="confirm_status" class="toggle-switch-input"
                                            value="1" id="confirm_status" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="confirm_message" class="form-control" placeholder="Ex : Your order is confirmed"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($oprm=\App\Models\BusinessSetting::where('key','order_processing_message')->first()); ?>
                        <?php ($data=$oprm?json_decode($oprm->value,true):null); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.processing')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="processing_status">
                                    <input type="checkbox" name="processing_status"
                                        class="toggle-switch-input"
                                        value="1" id="processing_status" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="processing_message"
                                        class="form-control" placeholder="Ex : Your order is started for cooking"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($dbs=\App\Models\BusinessSetting::where('key','order_handover_message')->first()); ?>
                        <?php ($data=$dbs?json_decode($dbs->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.handover')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_handover_message_status">
                                    <input type="checkbox" name="order_handover_message_status"
                                        class="toggle-switch-input"
                                        value="1"
                                        id="order_handover_message_status" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="order_handover_message"
                                        class="form-control" placeholder="Ex : Delivery man is on the way"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($ofdm=\App\Models\BusinessSetting::where('key','out_for_delivery_message')->first()); ?>
                        <?php ($data=$ofdm?json_decode($ofdm->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.out_for_delivery')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="out_for_delivery">
                                    <input type="checkbox" name="out_for_delivery_status"
                                        class="toggle-switch-input"
                                        value="1" id="out_for_delivery" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="out_for_delivery_message"
                                        class="form-control" placeholder="Ex : Your food is ready for delivery"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($odm=\App\Models\BusinessSetting::where('key','order_delivered_message')->first()); ?>
                        <?php ($data=$odm?json_decode($odm->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.delivered')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivered_status">
                                    <input type="checkbox" name="delivered_status"
                                        class="toggle-switch-input"
                                        value="1" id="delivered_status" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="delivered_message"
                                        class="form-control" placeholder="Ex : Your order is delivered"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($dba=\App\Models\BusinessSetting::where('key','delivery_boy_assign_message')->first()); ?>
                        <?php ($data=$dba?json_decode($dba->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.assign')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivery_boy_assign">
                                    <input type="checkbox" name="delivery_boy_assign_status"
                                        class="toggle-switch-input"
                                        value="1"
                                        id="delivery_boy_assign" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="delivery_boy_assign_message"
                                        class="form-control" placeholder="Your order has been assigned to a delivery man"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        
                        
                        <?php ($dbc=\App\Models\BusinessSetting::where('key','delivery_boy_delivered_message')->first()); ?>
                        <?php ($data=$dbc?json_decode($dbc->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                
                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.delivered')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivery_boy_delivered">
                                    <input type="checkbox" name="delivery_boy_delivered_status"
                                        class="toggle-switch-input"
                                        value="1"
                                        id="delivery_boy_delivered" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>

                                <textarea name="delivery_boy_delivered_message"
                                        class="form-control" placeholder="Ex : Order delivered successfully"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($dbc=\App\Models\BusinessSetting::where('key','order_cancled_message')->first()); ?>
                        <?php ($data=$dbc?json_decode($dbc->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">

                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.canceled')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_cancled_message">
                                    <input type="checkbox" name="order_cancled_message_status"
                                        class="toggle-switch-input"
                                        value="1"
                                        id="order_cancled_message" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>
                                <textarea name="order_cancled_message"
                                        class="form-control" placeholder="Ex :  Order is canceled by your request"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>

                        <?php ($orm=\App\Models\BusinessSetting::where('key','order_refunded_message')->first()); ?>
                        <?php ($data=$orm?json_decode($orm->value,true):''); ?>
                        <div class="col-md-6 col-12">
                            <div class="form-group">

                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                    <span class="d-block text--semititle">
                                        <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.refunded')); ?> <?php echo e(__('messages.message')); ?>

                                    </span>
                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_refunded_message">
                                    <input type="checkbox" name="order_refunded_message_status"
                                        class="toggle-switch-input"
                                        value="1"
                                        id="order_refunded_message" <?php echo e($data?($data['status']==1?'checked':''):''); ?>>
                                        <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase">On</span>
                                        <span class="pl-2 switch--custom-label-text off text-uppercase">Off</span>
                                    </label>
                                </div>
                                <textarea name="order_refunded_message"
                                        class="form-control" placeholder="Ex : Thank you for your refund request"><?php echo e($data['message']??''); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset">Reset</button>
                        <button type="submit" class="btn btn--primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/fcm-index.blade.php ENDPATH**/ ?>