<?php $__env->startSection('title',\App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value??'Dashboard'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            position: absolute;
            font-size: 10px;
            background: #865439;
            color: #ffffff;
            width: 60px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <?php if(auth('admin')->user()->role_id == 1): ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="page--header-title">
                    <h1 class="page-header-title"><?php echo e(__('messages.welcome')); ?>, <?php echo e(auth('admin')->user()->f_name); ?>.</h1>
                    <p class="page-header-text"><?php echo e(__('messages.welcome_message')); ?></p>
                </div>

                <div class="page--header-select">
                    <select name="zone_id" class="form-control js-select2-custom"
                            onchange="fetch_data_zone_wise(this.value)">
                        <option value="all"><?php echo e(translate('all_zones')); ?></option>
                        <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($zone['id']); ?>" <?php echo e($params['zone_id'] == $zone['id']?'selected':''); ?>>
                                <?php echo e($zone['name']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- End Page Header -->


        <!-- Stats -->
        <div class="card mb-3">
            <div class="card-body pt-0">
                <div id="order_stats_top">
                    <?php echo $__env->make('admin-views.partials._order-statics',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="row g-2 mt-2" id="order_stats">
                    <?php echo $__env->make('admin-views.partials._dashboard-order-stats',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>

        <!-- End Stats -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Card -->
                <div class="card h-100" id="monthly-earning-graph">
                    <!-- Body -->
                <?php echo $__env->make('admin-views.partials._monthly-earning-graph',['total_sell'=>$total_sell,'commission'=>$commission], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->

        <div class="row g-2 mt-2">
            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header align-items-center">
                        <h5 class="card-title">
                            <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/statistics.png')); ?>" alt="dashboard" class="card-header-icon">
                            <span><?php echo e(translate('user_statistics')); ?></span>
                        </h5>
                        <div id="stat_zone">
                            <?php echo $__env->make('admin-views.partials._zone-change',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-sm-6 col-md-4">
                                <div class="ml-auto mb-2 pb-xl-5">
                                <select class="custom-select" name="user_overview"
                                        onchange="user_overview_stats_update(this.value)">
                                    <option
                                        value="this_month" <?php echo e($params['user_overview'] == 'this_month'?'selected':''); ?>>
                                        <?php echo e(__('This month')); ?>

                                    </option>
                                    <option
                                        value="overall" <?php echo e($params['user_overview'] == 'overall'?'selected':''); ?>>
                                        <?php echo e(__('messages.Overall')); ?>

                                    </option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="position-relative" >
                            <div id="user-overview-board">
                                <?php echo $__env->make('admin-views.partials._user-overview-chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center mt-4 pt-xl-5">
                            <div class="chart--label">
                                <span class="indicator" style="background: #FFC960"></span>
                                <span class="info">
                                    <?php echo e(__('messages.customer')); ?>

                                </span>
                            </div>
                            <div class="chart--label">
                                <span class="indicator" style="background: #0661CB"></span>
                                <span class="info">
                                    <?php echo e(__('messages.restaurant')); ?>

                                </span>
                            </div>
                            <div class="chart--label">
                                <span class="indicator" style="background: #7ECAFF"></span>
                                <span class="info">
                                    <?php echo e(translate('messages.delivery_man')); ?>

                                </span>
                            </div>
                        </div>
                        <!-- End Chart -->
                    </div>
                    <!-- End Body -->
                </div>
            </div>


            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="popular-restaurants-view">
                    <?php echo $__env->make('admin-views.partials._popular-restaurants',['popular'=>$data['popular']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-deliveryman-view">
                    <?php echo $__env->make('admin-views.partials._top-deliveryman',['top_deliveryman'=>$data['top_deliveryman']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-restaurants-view">
                    <?php echo $__env->make('admin-views.partials._top-restaurants',['top_restaurants'=>$data['top_restaurants']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-rated-foods-view">
                    <?php echo $__env->make('admin-views.partials._top-rated-foods',['top_rated_foods'=>$data['top_rated_foods']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>


            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-selling-foods-view">
                    <?php echo $__env->make('admin-views.partials._top-selling-foods',['top_sell'=>$data['top_sell']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <?php else: ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(__('messages.welcome')); ?>, <?php echo e(auth('admin')->user()->f_name); ?>.</h1>
                    <p class="page-header-text"><?php echo e(__('messages.employee_welcome_message')); ?></p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js.extensions/chartjs-extensions.js"></script> -->
    <script
        src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script_2'); ?>
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function () {
            $.HSCore.components.HSChartJS.init($(this));
        });

        var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));
    </script>

    <!-- <script>
        var ctx = document.getElementById('user-overview');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'User',
                    data: ['<?php echo e($data['customer']); ?>', '<?php echo e($data['restaurants']); ?>', '<?php echo e($data['delivery_man']); ?>'],
                    backgroundColor: [
                        '#FFC960',
                        '#0661CB',
                        '#7ECAFF'
                    ],
                    hoverOffset: 3
                }],
                labels: [
                    '<?php echo e(__('messages.customer')); ?>',
                    '<?php echo e(__('messages.restaurant')); ?>',
                    '<?php echo e(translate('messages.delivery_man')); ?>'
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    display: false,
                    position: 'chartArea',
                }
            }
        });
    </script> -->

    <script>
        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.order')); ?>',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('statistics_type',type);
                    $('#order_stats').html(data.view)
                    $('#order_stats_top').html(data.order_stats_top)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function fetch_data_zone_wise(zone_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.zone')); ?>',
                data: {
                    zone_id: zone_id
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('zone_id', zone_id);
                    $('#order_stats_top').html(data.order_stats_top);
                    $('#order_stats').html(data.order_stats);
                    $('#stat_zone').html(data.stat_zone);
                    $('#user-overview-board').html(data.user_overview);
                    $('#monthly-earning-graph').html(data.monthly_graph);
                    $('#popular-restaurants-view').html(data.popular_restaurants);
                    $('#top-deliveryman-view').html(data.top_deliveryman);
                    $('#top-rated-foods-view').html(data.top_rated_foods);
                    $('#top-restaurants-view').html(data.top_restaurants);
                    $('#top-selling-foods-view').html(data.top_selling_foods);
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function user_overview_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.user-overview')); ?>',
                data: {
                    user_overview: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('user_overview',type);
                    $('#user-overview-board').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }
    </script>

    <script>
        function insert_param(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);
            // kvp looks like ['key1=value1', 'key2=value2', ...]
            var kvp = document.location.search.substr(1).split('&');
            let i = 0;

            for (; i < kvp.length; i++) {
                if (kvp[i].startsWith(key + '=')) {
                    let pair = kvp[i].split('=');
                    pair[1] = value;
                    kvp[i] = pair.join('=');
                    break;
                }
            }
            if (i >= kvp.length) {
                kvp[kvp.length] = [key, value].join('=');
            }
            // can return this or...
            let params = kvp.join('&');
            // change url page with new params
            window.history.pushState('page2', 'Title', '<?php echo e(url()->current()); ?>?' + params);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/dashboard.blade.php ENDPATH**/ ?>