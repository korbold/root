<?php $__env->startSection('title', 'Add new delivery-man'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/public/assets/admin/css/intlTelInput.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('/public/assets/admin/img/delivery-man.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(translate('messages.add_new_deliveryman')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <form action="<?php echo e(route('admin.delivery-man.store')); ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-title-icon"><i class="tio-user"></i></span>
                        <span>
                            <?php echo e(translate('messages.general_info')); ?>

                        </span>
                    </h5>
                </div>
                <?php echo csrf_field(); ?>
                <div class="card-body pb-2">
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.first')); ?>

                                            <?php echo e(translate('messages.name')); ?></label>
                                        <input type="text" name="f_name" class="form-control h--45px"
                                            placeholder="Ex: Jhone" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.last')); ?>

                                            <?php echo e(translate('messages.name')); ?></label>
                                        <input type="text" name="l_name" class="form-control h--45px"
                                            placeholder="Ex: Joe" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.email')); ?></label>
                                        <input type="email" name="email" class="form-control h--45px"
                                            placeholder="Ex : ex@example.com" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.zone')); ?></label>
                                        <select name="zone_id" class="form-control h--45px" required
                                            data-placeholder="<?php echo e(translate('messages.select')); ?> <?php echo e(translate('messages.zone')); ?>">
                                            <option value="" readonly="true" hidden="true">Ex: XYZ Zone</option>
                                            <?php $__currentLoopData = \App\Models\Zone::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                                    <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                        <option value="<?php echo e($zone->id); ?>" selected><?php echo e($zone->name); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($zone->id); ?>"><?php echo e($zone->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.deliveryman')); ?>

                                            <?php echo e(translate('messages.type')); ?></label>
                                        <select name="earning" class="form-control h--45px">
                                            <option value="" readonly="true" hidden="true">Select Delivery Man Type</option>
                                            <option value="1"><?php echo e(translate('messages.freelancer')); ?></option>
                                            <option value="0"><?php echo e(translate('messages.salary_based')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group m-0">
                                <label class="d-block mb-lg-5 text-center"><?php echo e(translate('messages.delivery_man_image')); ?> <small class="text-danger">* ( <?php echo e(translate('messages.ratio')); ?> 100x100 )</small></label>
                                <center>
                                    <img class="initial-24" id="viewer"
                                        src="<?php echo e(asset('public/assets/admin/img/100x100/user.png')); ?>"
                                        alt="delivery-man image" />
                                </center>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input h--45px"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg1"><?php echo e(translate('messages.choose')); ?>

                                        <?php echo e(translate('messages.file')); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row g-3">
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.identity')); ?>

                                            <?php echo e(translate('messages.type')); ?></label>
                                        <select name="identity_type" class="form-control h--45px">
                                            <option value="passport"><?php echo e(translate('messages.passport')); ?></option>
                                            <option value="driving_license"><?php echo e(translate('messages.driving')); ?>

                                                <?php echo e(translate('messages.license')); ?></option>
                                            <option value="nid"><?php echo e(translate('messages.nid')); ?></option>
                                            <option value="restaurant_id"><?php echo e(translate('messages.restaurant')); ?>

                                                <?php echo e(translate('messages.id')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.identity')); ?>

                                            <?php echo e(translate('messages.number')); ?></label>
                                        <input type="text" name="identity_number" class="form-control h--45px"
                                            placeholder="Ex : DH-23434-LS" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group m-0">
                                <label class="input-label"
                                    for="exampleFormControlInput1"><?php echo e(translate('messages.identity')); ?>

                                    <?php echo e(translate('messages.image')); ?></label>
                                <div>
                                    <div class="row" id="coba"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-header-icon"><i class="tio-user"></i></span>
                        <span><?php echo e(translate('messages.account_info')); ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label" for="phone"><?php echo e(translate('messages.phone')); ?></label>
                                <div class="input-group">
                                    <input type="tel" name="phone" id="phone" placeholder="Ex : 017********"
                                        class="form-control h--45px" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label"
                                    for="exampleFormControlInput1"><?php echo e(translate('messages.password')); ?></label>
                                <input type="text" name="password" class="form-control h--45px" placeholder="Ex: 5+ Character"
                                    required>
                            </div>
                        </div>
                        <!-- This is Static -->
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label"
                                for="exampleFormControlInput1">Confirm <?php echo e(translate('messages.password')); ?></label>
                                <input type="text" name="password" class="form-control h--45px" placeholder="Ex: 5+ Character"
                                required>
                            </div>
                        </div>
                        <!-- This is Static -->
                    </div>
                </div>
            </div>
            <div class="btn--container mt-4 justify-content-end">
                <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                <button type="submit" class="btn btn--primary submitBtn"><?php echo e(translate('messages.submit')); ?></button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/intlTelInput.js')); ?>"></script>
    <script src="<?php echo e(asset('public/assets/admin/js/intlTelInput-jquery.min.js')); ?>"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });
        <?php
            $country = \App\Models\BusinessSetting::where('key', 'country')->first();
        ?>
        var phone = $("#phone").intlTelInput({
            utilsScript: "<?php echo e(asset('public/assets/admin/js/intlTellInput-util.min.js')); ?>",
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "phone",
            initialCountry: "<?php echo e($country ? $country->value : auto); ?>",
            placeholderNumberType: "MOBILE",
            separateDialCode: true
        });
        // $("#phone").on('change', function(){
        //     $(this).val(phone.getNumber());
        // })
    </script>

    <script src="<?php echo e(asset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script type="text/javascript">
        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'identity_image[]',
                maxCount: 5,
                rowHeight: '140px',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/admin/img/100x100/user2.png')); ?>',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error('<?php echo e(translate('messages.please_only_input_png_or_jpg_type_file')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('<?php echo e(translate('messages.file_size_too_big')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
    <script>
        $('#reset_btn').click(function(){
            $('#viewer').attr('src','<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>');
            $('#coba').attr('src','<?php echo e(asset('public/assets/admin/img/900x400/img1.jpg')); ?>');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/index.blade.php ENDPATH**/ ?>