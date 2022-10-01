<?php $__env->startSection('title',__('messages.update').' '.__('messages.notification')); ?>

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
                            <?php echo e(__('messages.notification')); ?> <?php echo e(__('messages.update')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.notification.update',[$notification['id']])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.title')); ?></label>
                                <input id="notification_title" type="text" value="<?php echo e($notification['title']); ?>" name="notification_title" class="form-control" placeholder="<?php echo e(__('messages.new_notification')); ?>" required maxlength="191">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.zone')); ?></label>
                                <select id="zone" name="zone" class="form-control js-select2-custom" >
                                    <option value="all" <?php echo e(isset($notification->zone_id)?'':'selected'); ?>><?php echo e(__('messages.all')); ?> <?php echo e(__('messages.zone')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($z['id']); ?>"  <?php echo e($notification->zone_id==$z['id']?'selected':''); ?>><?php echo e($z['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="input-label" for="tergat"><?php echo e(__('messages.send')); ?> <?php echo e(__('messages.to')); ?></label>
                        
                                <select id="tergat" name="tergat" class="form-control" id="tergat" data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.tergat')); ?>" required>
                                    <option value="customer" <?php echo e($notification->tergat=='customer'?'selected':''); ?>><?php echo e(__('messages.customer')); ?></option>
                                    <option value="deliveryman" <?php echo e($notification->tergat=='deliveryman'?'selected':''); ?>><?php echo e(__('messages.deliveryman')); ?></option>
                                    <option value="restaurant" <?php echo e($notification->tergat=='restaurant'?'selected':''); ?>><?php echo e(__('messages.restaurant')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">&nbsp;</label>
                                <center class="mb-3">
                                    <img  class="initial-30" id="viewer"
                                        src="<?php echo e(asset('storage/app/public/notification')); ?>/<?php echo e($notification['image']); ?>"  onerror="src='<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>'" alt="image"/>
                                </center>
                                <label><?php echo e(__('messages.notification')); ?> <?php echo e(__('messages.banner')); ?></label><small class="text-danger">* ( <?php echo e(__('messages.ratio')); ?> 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?> <?php echo e(__('messages.file')); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(__('messages.description')); ?></label>
                            <textarea id="description" name="description" class="form-control h--md-200px" required><?php echo e($notification['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mb-0">
                        <button id="reset_btn" type="button" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(translate('send_again')); ?></button>
                    </div>
                </form>
            </div>
            <!-- End Table -->
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
    </script>
    <script>
        $('#reset_btn').click(function(){
            $('#notification_title').val("<?php echo e($notification['title']); ?>");
            $('#zone').val("<?php echo e($notification->zone_id); ?>").trigger('change');
            $('#tergat').val("<?php echo e($notification->tergat); ?>").trigger('change');
            $('#viewer').attr('src', "<?php echo e(asset('storage/app/public/notification')); ?>/<?php echo e($notification['image']); ?>");
            $('#customFileEg1').val(null);
            $('#description').val("<?php echo e($notification['description']); ?>");
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/notification/edit.blade.php ENDPATH**/ ?>