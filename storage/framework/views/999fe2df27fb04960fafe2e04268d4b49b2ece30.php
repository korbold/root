<?php $__env->startSection('title','Delivery Man Preview'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <i class="tio-user"></i>
                </span>
                <span><?php echo e($dm['f_name'].' '.$dm['l_name']); ?></span>
            </h1>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'info'])); ?>"  aria-disabled="true"><?php echo e(__('messages.info')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(__('messages.transaction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'timelog'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.timelog')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.delivery-man.preview', ['id'=>$dm->id, 'tab'=> 'conversation'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.conversations')); ?></a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
        </div>
        <!-- End Page Header -->

        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-header-title"><?php echo e(__('messages.conversation')); ?> <?php echo e(__('messages.list')); ?></h1>
            </div>
            <!-- End Page Header -->

            <div class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="input-group input---group">
                                <div class="input-group-prepend border-right-0">
                                    <span class="input-group-text border-right-0" id="basic-addon1"><i class="tio-search"></i></span>
                                </div>
                                <input type="text" class="form-control border-left-0 pl-1" id="serach" placeholder="Search" aria-label="Username"
                                    aria-describedby="basic-addon1" autocomplete="off">
                            </div>
                        </div>
                        <!-- Body -->
                        <div class="card-body p-0 initial-19" id="dm-conversation-list">
                            <div class="border-bottom"></div>
                            <?php echo $__env->make('admin-views.delivery-man.partials._conversation_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-8 col-nd-6" id="dm-view-conversation">
                    <center class="mt-2">
                        <h4 class="initial-20"><?php echo e(__('messages.view')); ?> <?php echo e(__('messages.conversation')); ?>

                        </h4>
                    </center>
                    
                </div>
            </div>
            <!-- End Row -->
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    function viewConvs(url, id_to_active) {
        $('.customer-list').removeClass('conv-active');
        $('#' + id_to_active).addClass('conv-active');
        $.get({
            url: url,
            success: function(data) {
                $('#dm-view-conversation').html(data.view);
            }
        });
    }

    var page = 1;
    var user_id =  $('#deliver_man').val();
    $('#dm-conversation-list').scroll(function() {
        if ($('#dm-conversation-list').scrollTop() + $('#dm-conversation-list').height() >= $('#dm-conversation-list')
            .height()) {
            page++;
            loadMoreData(page);
        }
    });

    function loadMoreData(page) {
        $.ajax({
                url: "<?php echo e(route('admin.delivery-man.message-list-search')); ?>" + '?page=' + page,
                type: "get",
                data:{"user_id":user_id},
                beforeSend: function() {

                }
            })
            .done(function(data) {
                if (data.html == " ") {
                    return;
                }
                $("#dm-conversation-list").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    };

    function fetch_data(page, query) {
            $.ajax({
                url: "<?php echo e(route('admin.delivery-man.message-list-search')); ?>" + '?page=' + page + "&key=" + query,
                type: "get",
                data:{"user_id":user_id},
                success: function(data) {
                    $('#dm-conversation-list').empty();
                    $("#dm-conversation-list").append(data.html);
                }
            })
        };

        $(document).on('keyup', '#serach', function() {
            var query = $('#serach').val();
            fetch_data(page, query);
        });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/delivery-man/view/conversations.blade.php ENDPATH**/ ?>