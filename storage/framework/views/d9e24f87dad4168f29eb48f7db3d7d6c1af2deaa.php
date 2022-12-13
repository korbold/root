<?php $__env->startSection('title','Employee Add'); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Heading -->

    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(asset('/public/assets/admin/img/employee.png')); ?>" alt="public">
            </div>
            <span>
                Add New <?php echo e(__('messages.Employee')); ?>

            </span>
        </h1>
    </div>


    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo e(route('admin.employee.add-new')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php echo e(translate('Genaral Information')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label qcont" for="fname"><?php echo e(__('messages.first')); ?> <?php echo e(__('messages.name')); ?></label>
                                            <input type="text" name="f_name" class="form-control h--45px" id="fname"
                                                    placeholder="Ex: John" value="<?php echo e(old('f_name')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label qcont" for="lname"><?php echo e(__('messages.last')); ?> <?php echo e(__('messages.name')); ?></label>
                                            <input type="text" name="l_name" class="form-control h--45px" id="lname" value="<?php echo e(old('l_name')); ?>"
                                                    placeholder="Ex: Doe" value="<?php echo e(old('name')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label" for="title"><?php echo e(__('messages.zone')); ?></label>
                                            <select name="zone_id" id="zone_id" class="form-control h--45px js-select2-custom">
                                                <?php if(!isset(auth('admin')->user()->zone_id)): ?>
                                                <option value="" <?php echo e(!isset($e->zone_id)?'selected':''); ?>><?php echo e(__('messages.all')); ?></option>
                                                <?php endif; ?>
                                                <?php ($zones=\App\Models\Zone::all()); ?>
                                                <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($zone['id']); ?>"><?php echo e($zone['name']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label qcont" for="role_id"><?php echo e(__('messages.Role')); ?></label>
                                            <select class="w-100 form-control h--45px js-select2-custom" name="role_id" id="role_id"  required>
                                                <option value="" selected disabled><?php echo e(__('messages.select')); ?> <?php echo e(__('messages.Role')); ?></option>
                                                <?php $__currentLoopData = $rls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($r->id); ?>"><?php echo e($r->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label qcont" for="phone"><?php echo e(__('messages.phone')); ?></label>
                                            <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control h--45px" id="phone"
                                                placeholder="Ex : +88017********" required>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="h-100 d-flex flex-column justify-content-center">
                                    <label class="form-label d-block text-center mt-auto mb-3">
                                        <?php echo e(translate('Employee Image')); ?> <span class="text-danger">(Ratio 1:1)</span>
                                    </label>
                                    <center class="mt-auto mb-auto">
                                        <img class="initial-24" id="viewer"
                                        src="<?php echo e(asset('public/assets/admin/img/100x100/user.png')); ?>" alt="Employee thumbnail"/>
                                    </center>
                                    <div class="form-group mt-3">
                                        <div class="custom-file">
                                            <input type="file" name="image" id="customFileUpload" class="custom-file-input h--45px"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                            <label class="custom-file-label  h--45px" for="customFileUpload"><?php echo e(__('messages.choose')); ?> <?php echo e(__('messages.file')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php echo e(__('messages.account')); ?> <?php echo e(__('messages.info')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label qcont" for="email"><?php echo e(__('messages.email')); ?></label>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control h--45px" id="email"
                                    placeholder="Ex : ex@gmail.com" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label qcont" for="password"><?php echo e(__('messages.password')); ?></label>
                                    <div class="input-group input-group-merge">
                                    <input type="text" name="password" class="form-control h--45px" id="password" value="<?php echo e(old('password')); ?>"
                                        placeholder="<?php echo e(__('messages.password_length_placeholder',['length'=>'6+'])); ?>" required>
                                    <div class="js-toggle-password-target-1 input-group-append">
                                        <a class="input-group-text" href="javascript:;">
                                            <i class="js-toggle-passowrd-show-icon-1 tio-visible-outlined"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label qcont" for="password"><?php echo e(__('messages.password')); ?></label>
                                    <div class="input-group input-group-merge">
                                    <input type="text" name="password" class="form-control h--45px" id="password" value="<?php echo e(old('password')); ?>"
                                        placeholder="<?php echo e(__('messages.password_length_placeholder',['length'=>'6+'])); ?>" required>
                                    <div class="js-toggle-password-target-1 input-group-append">
                                        <a class="input-group-text" href="javascript:;">
                                            <i class="js-toggle-passowrd-show-icon-1 tio-visible-outlined"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end">
                    <!-- Static Button -->
                    <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                    <!-- Static Button -->
                    <button type="submit" class="btn btn--primary"><?php echo e(__('messages.submit')); ?></button>
                </div>
            </form>
        </div>
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

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

    </script>

    <script>
        $('#reset_btn').click(function(){
            location.reload(true);
            $('#zone_id').val(null).trigger('change');
            $('#role_id').val(null).trigger('change');
            $('#viewer').attr('src','<?php echo e(asset('public\assets\admin\img\100x100\user.png')); ?>');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/employee/add-new.blade.php ENDPATH**/ ?>