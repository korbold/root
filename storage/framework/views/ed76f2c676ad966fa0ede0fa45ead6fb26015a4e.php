<?php $__env->startSection('title', __('messages.Social Media')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(asset('/public/assets/admin/img/social.png')); ?>" alt="public">
                        </div>
                        <span>
                            <?php echo e(translate('Social Media')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="text-left" action="javascript:">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label"><?php echo e(__('messages.name')); ?></label>
                                        <select class="form-control w-100" name="name" id="name">
                                            <option>---<?php echo e(__('messages.select')); ?> Social Media`---</option>
                                            <option value="instagram"><?php echo e(__('messages.Instagram')); ?></option>
                                            <option value="facebook"><?php echo e(__('messages.Facebook')); ?></option>
                                            <option value="twitter"><?php echo e(__('messages.Twitter')); ?></option>
                                            <option value="linkedin"><?php echo e(__('messages.LinkedIn')); ?></option>
                                            <option value="pinterest"><?php echo e(__('messages.Pinterest')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" id="id">
                                        <label for="link" class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : ''); ?>"><?php echo e(__('messages.social_media_link')); ?></label>
                                        <input type="text" name="link" class="form-control" id="link"
                                            placeholder="Ex: facebook.com/your-page-name" required>
                                    </div>
                                    <input type="hidden" id="id">
                                </div>
                                <div class="col-md-12">
                                    <div class="btn--container justify-content-end">
                                        <button type="reset" class="btn btn--reset text-white"><?php echo e(__('messages.reset')); ?></button>
                                        <a id="update" class="btn btn--primary initial-hidden" href="javascript:"><?php echo e(__('messages.update')); ?></a>
                                        <button id="add" class="btn btn--primary"><?php echo e(__('messages.save')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table <?php echo e(Session::get('direction') === 'rtl' ? 'text-right' : 'text-left'); ?>" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0" scope="col">
                                    <div class="pl-2">SL</div>
                                </th>
                                <th class="border-0" scope="col"><?php echo e(__('messages.name')); ?></th>
                                <th class="border-0" scope="col"><?php echo e(__('messages.social_media_link')); ?></th>
                                <th class="border-0" scope="col"><?php echo e(__('messages.status')); ?></th>
                                <th class="border-0 w-120px text-center" scope="col"><?php echo e(__('messages.action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        fetch_social_media();

        function fetch_social_media() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.social-media.fetch')); ?>",
                method: 'GET',
                success: function (data) {

                    if (data.length != 0) {
                        var html = '';
                        for (var count = 0; count < data.length; count++) {
                            html += '<tr>';
                            html += '<td class="column_name" data-column_name="sl" data-id="' + data[count].id + '">' + '<div class="pl-4">'+ (count + 1) +'</div>' + '</td>';
                            html += '<td class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                            html += '<td class="column_name" data-column_name="slug" data-id="' + data[count].id + '">' + data[count].link + '</td>';
                            html += `<td class="column_name" data-column_name="status" data-id="${data[count].id}">
                                <label class="toggle-switch toggle-switch-sm" for="${data[count].id}">
                                    <input type="checkbox" class="toggle-switch-input status" id="${data[count].id}" ${data[count].status == 1 ? "checked" : ""}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>`;
                            // html += '<td><a type="button" class="btn btn-primary btn-xs edit" id="' + data[count].id + '"><i class="fa fa-edit text-white"></i></a> <a type="button" class="btn btn-danger btn-xs delete" id="' + data[count].id + '"><i class="fa fa-trash text-white"></i></a></td></tr>';
                            html += '<td> <div class="btn--container justify-content-center"><a type="button" class="btn btn-outline-primary btn--primary action-btn edit" id="' + data[count].id + '"><i class="tio-edit"></i></a></div> </td></tr>';
                        }
                        $('tbody').html(html);
                    }
                }
            });
        }

        $('#add').on('click', function () {
            // $('#add').attr("disabled", true);
            var name = $('#name').val();
            var link = $('#link').val();
            if (name == "") {
                toastr.error('<?php echo e(__('messages.Social Name Is Requeired')); ?>.');
                return false;
            }
            if (link == "") {
                toastr.error('<?php echo e(__('messages.Social Link Is Requeired')); ?>.');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.social-media.store')); ?>",
                method: 'POST',
                data: {
                    name: name,
                    link: link
                },
                success: function (response) {
                    if (response.error == 1) {
                        toastr.error('<?php echo e(__('messages.Social Media Already taken')); ?>');
                    } else {
                        toastr.success('<?php echo e(__('messages.Social Media inserted Successfully')); ?>.');
                    }
                    $('#name').val('');
                    $('#link').val('');
                    fetch_social_media();
                }
            });
        });
        $('#update').on('click', function () {
            $('#update').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#name').val();
            var link = $('#link').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(url('admin/business-settings/social-media')); ?>/"+id,
                method: 'PUT',
                data: {
                    id: id,
                    name: name,
                    link: link,
                },
                success: function (data) {
                    $('#name').val('');
                    $('#link').val('');

                    toastr.success('<?php echo e(__('messages.Social info updated Successfully')); ?>.');
                    $('#update').hide();
                    $('#add').show();
                    fetch_social_media();

                }
            });
            $('#save').hide();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("<?php echo e(__('messages.Are you sure delete this social media')); ?>?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo e(url('admin/business-settings/social-media/destroy')); ?>/"+id,
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        fetch_social_media();
                        toastr.success('<?php echo e(__('messages.Social media deleted Successfully')); ?>.');
                    }
                });
            }
        });
        $(document).on('click', '.edit', function () {
            $('#update').show();
            $('#add').hide();
            var id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(url('admin/business-settings/social-media')); ?>/"+id,
                method: 'GET',
                success: function (data) {
                    $(window).scrollTop(0);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#link').val(data.link);
                    fetch_social_media()
                }
            });
        });
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.business-settings.social-media.status-update')); ?>",
                method: 'get',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('<?php echo e(__('messages.status_updated')); ?>');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/business-settings/social-media.blade.php ENDPATH**/ ?>