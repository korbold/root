<?php $__env->startSection('title', translate('DB_clean')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('/public/assets/admin/img/clean-database.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(translate('Clean database')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="alert alert--danger alert-danger mb-2" role="alert">
            <span class="alert--icon"><i class="tio-info"></i></span> <strong>NOTE: </strong><?php echo e(translate('This_page_contains_sensitive_information.Please_make_sure_before_click_the_button.')); ?>

        </div>
        <div class="card">
            <div class="card-body pt-2">
                <form action="<?php echo e(route('admin.business-settings.clean-db')); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="check--item-wrapper clean--database-checkgroup">
                        <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="check-item">
                                <div class="form-group form-check form--check">
                                    <input type="checkbox" name="tables[]" value="<?php echo e($table); ?>"
                                    class="form-check-input" id="<?php echo e($table); ?>">
                                    <label class="form-check-label text-dark pl-2 flex-grow-1 <?php echo e(Session::get('direction') === 'rtl' ? 'mr-4' : ''); ?>"
                                    for="<?php echo e($table); ?>"><?php echo e(Str::limit($table, 20)); ?> <span class="badge-pill badge-secondary mx-2"><?php echo e($rows[$key]); ?></span></label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-right mt-3">
                        <button type="<?php echo e(env('APP_MODE') != 'demo' ? 'submit' : 'button'); ?>"
                        onclick="<?php echo e(env('APP_MODE') != 'demo' ? '' : 'call_demo()'); ?>"
                        class="btn btn--primary" id="submitForm"><?php echo e(translate('Clear')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    var restaurant_dependent = ['restaurants','restaurant_schedule', 'discounts'];
    var order_dependent = ['order_delivery_histories','d_m_reviews', 'delivery_histories', 'track_deliverymen', 'order_details', 'reviews'];
    var zone_dependent = ['restaurants','vendors', 'orders'];
    var user_info_dependent = ['conversations', 'messages'];    
    $(document).ready(function () {
        $('.form-check-input').on('change', function(event){
            if($(this).is(':checked')){
                if(event.target.id == 'zones' || event.target.id == 'restaurants' || event.target.id == 'vendors') {
                    checked_restaurants(true);
                }

                if(event.target.id == 'zones' || event.target.id == 'orders') {
                    checked_orders(true);
                }

                if(event.target.id == 'user_infos'){
                    checked_conversations(true);
                }
            } else {
                if(restaurant_dependent.includes(event.target.id)) {
                    if(check_restaurant() || check_zone()){
                        $(this).prop('checked', true);
                    }
                } else if(order_dependent.includes(event.target.id)) {
                    if(check_orders() || check_zone()){
                        $(this).prop('checked', true);
                    }
                } else if(zone_dependent.includes(event.target.id)) {
                    if(check_zone()){
                        $(this).prop('checked', true);
                    }
                } else if(event.target.id == 'user_infos') {
                    if(check_conversations() || check_messages()){
                        $(this).prop('checked', true);
                    }
                } else if(event.target.id == 'conversations') {
                    if( check_messages()){
                        $(this).prop('checked', true);
                    }
                }
            }

        });

        $("#purchase_code_div").click(function () {
            var type = $('#purchase_code').get(0).type;
            if (type === 'password') {
                $('#purchase_code').get(0).type = 'text';
            } else if (type === 'text') {
                $('#purchase_code').get(0).type = 'password';
            }
        });
    })

    function checked_restaurants(status) {
        restaurant_dependent.forEach(function(value){
            $('#'+value).prop('checked', status);
        });
        $('#vendors').prop('checked', status);
        
    }

    function checked_orders(status) {
        order_dependent.forEach(function(value){
            $('#'+value).prop('checked', status);
        });
        $('#orders').prop('checked', status);
    }

    function checked_conversations(status) {
        user_info_dependent.forEach(function(value){
            $('#'+value).prop('checked', status);
        });
        $('#user_infos').prop('checked', status);
    }



    function check_zone() {
        if($('#zones').is(':checked')) {
            toastr.warning("<?php echo e(translate('messages.table_unchecked_warning',['table'=>'zones'])); ?>");
            return true;
        }
        return false;
    }

    function check_orders() {
        if($('#orders').is(':checked')) {
            toastr.warning("<?php echo e(translate('messages.table_unchecked_warning',['table'=>'orders'])); ?>");
            return true;
        }
        return false;
    }

    function check_restaurant() {
        if($('#restaurants').is(':checked') || $('#vendors').is(':checked')) {
            toastr.warning("<?php echo e(translate('messages.table_unchecked_warning',['table'=>'restaurants/vendors'])); ?>");
            return true;
        }
        return false;
    }

    function check_conversations() {
        if($('#conversations').is(':checked')) {
            toastr.warning("<?php echo e(translate('messages.table_unchecked_warning',['table'=>'conversations'])); ?>");
            return true;
        }
        return false;
    }

    function check_messages() {
        if($('#messages').is(':checked')) {
            toastr.warning("<?php echo e(translate('messages.table_unchecked_warning',['table'=>'messages'])); ?>");
            return true;
        }
        return false;
    }
    </script>
    <script>
        $("form").on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(translate('Are you sure?')); ?>',
                text: "<?php echo e(translate('Sensitive_data! Make_sure_before_changing.')); ?>",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    this.submit();
                } else {
                    e.preventDefault();
                    toastr.success("<?php echo e(translate('Cancelled')); ?>");
                    location.reload();
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/db-index.blade.php ENDPATH**/ ?>