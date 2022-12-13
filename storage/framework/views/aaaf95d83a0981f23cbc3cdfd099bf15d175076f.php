<?php $__env->startSection('title',__('messages.day_wise_report')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <i class="tio-filter-list"></i> <?php echo e(__('messages.day_wise_report')); ?>

            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-12 pt-sm-3">
                        <div class="report-card-inner mb-4 pt-3 mw-100">
                            <form action="<?php echo e(route('admin.report.set-date')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-md-0 mb-3">
                                    <div class="mx-1">
                                        <h5 class="form-label mb-0">
                                            <?php echo e(__('messages.show_data_by_date_range')); ?>

                                        </h5>
                                    </div>
                                </div>
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-3">
                                        <select name="zone_id" class="form-control js-select2-custom h--45px"
                                            onchange="set_zone_filter('<?php echo e(url()->full()); ?>',this.value)" id="zone_id">
                                            <option value="all"><?php echo e('All Zones'); ?></option>
                                            <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($z['id']); ?>" <?php echo e(isset($zone) && $zone->id == $z['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($z['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div>
                                            <label class="floating-label" for="from_date"><?php echo e(translate('start_date')); ?></label>
                                            <input type="date" class="form-control h--45px" name="from" id="from_date" <?php echo e(session()->has('from_date')?'value='.session('from_date'):''); ?>

                                            required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label class="floating-label" for="to_date"><?php echo e(translate('end_date')); ?></label>
                                            <input type="date" class="form-control h--45px" name="to" id="to_date" <?php echo e(session()->has('to_date')?'value='.session('to_date'):''); ?>

                                            required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn--primary h--45px btn-block"><?php echo e(__('messages.show')); ?> Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                        $from = session('from_date').' 00:00:00';
                        $to = session('to_date').' 23:59:59';
                        $total=\App\Models\Order::when(isset($zone), function($query)use($zone){
                            return $query->whereHas('restaurant', function($q)use($zone){
                                return $q->where('zone_id', $zone->id);
                            });
                        })->whereBetween('created_at', [$from, $to])->Notpos()->count();
                        if($total==0){
                        $total=.01;
                        }
                    ?>
                    <!--Admin earned-->
                    <div class="col-sm-6 col-xl-3">
                    <?php
                        $admin_earned=$order_transactions->sum('admin_commission');
                        $restaurant_earned=$order_transactions->sum('restaurant_amount');
                        $deliveryman_earned=$order_transactions->sum('delivery_charge');
                        $total_sell=$order_transactions->sum('order_amount');
                    ?>
                        <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--6">
                            <h4 class="title"><?php echo e(\App\CentralLogics\Helpers::format_currency($admin_earned)); ?></h4>
                            <span class="subtitle"><?php echo e(__('messages.admin')); ?> <?php echo e(__('messages.earned')); ?>

                                <span  data-toggle="tooltip" data-placement="right" data-original-title='<?php echo e(translate("messages.including_food_delivery_fee_commission")); ?>' class="input-label-secondary">
                                    <i class="tio-info-outined"></i>
                                </span>
                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/earned.png')); ?>" alt="order-report">
                        </div>
                        <!-- End Card -->
                    </div>
                    <!--Admin earned End-->
                    <!--restaurant earned-->
                    <div class="col-sm-6 col-xl-3">
                    <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--7">
                            <h4 class="title">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($restaurant_earned)); ?>

                            </h4>
                            <span class="subtitle"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.earned')); ?></span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/res-earned.png')); ?>" alt="order-report">
                        </div>
                    <!-- End Card -->
                    </div>
                    <!--restaurant earned end-->
                    <!--Deliveryman earned-->
                    <div class="col-sm-6 col-xl-3">
                    <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--8">
                            <h4 class="title">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($deliveryman_earned)); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.delivery_fee_earned')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/delivery-fee.png')); ?>" alt="order-report">
                        </div>
                    <!-- End Card -->
                    </div>
                    <!--Deliveryman earned end-->
                    <!--Total sell-->
                    <div class="col-sm-6 col-xl-3">
                    <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--9">
                            <h4 class="title">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($total_sell)); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.total_sell')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/sell.png')); ?>" alt="order-report">
                        </div>
                    <!-- End Card -->
                    </div>
                    <!--total sell end-->

                    <!--In progress-->
                    <div class="col-sm-6 col-xl-3 mb-3">
                    <?php
                        $returned=\App\Models\Order::when(isset($zone), function($query)use($zone){
                            return $query->whereHas('restaurant', function($q)use($zone){
                                return $q->where('zone_id', $zone->id);
                            });
                        })->whereIn('order_status',['pending','accepted', 'confirmed', 'processing','handover','picked_up'])->whereBetween('created_at', [$from, $to])->Notpos()->count()
                    ?>
                        <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--10">
                            <h4 class="title">
                                <?php echo e($returned); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.in_progress')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/progress.png')); ?>" alt="order-report">
                        </div>
                        <!-- End Card -->
                    </div>
                    <!--In progress End-->
                    <!--In Delivered -->
                    <div class="col-sm-6 col-xl-3 mb-3">
                    <?php
                        $delivered=\App\Models\Order::when(isset($zone), function($query)use($zone){
                            return $query->whereHas('restaurant', function($q)use($zone){
                                return $q->where('zone_id', $zone->id);
                            });
                        })->where(['order_status'=>'delivered'])->whereBetween('created_at', [$from, $to])->Notpos()->count()
                    ?>
                        <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--11">
                            <h4 class="title">
                                <?php echo e($delivered); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.delivered')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/delivered.png')); ?>" alt="order-report">
                        </div>
                        <!-- End Card -->
                    </div>
                    <!--Delivered End-->
                    <!--Failed-->
                    <div class="col-sm-6 col-xl-3 mb-3">
                    <?php
                        $failed=\App\Models\Order::when(isset($zone), function($query)use($zone){
                            return $query->whereHas('restaurant', function($q)use($zone){
                                return $q->where('zone_id', $zone->id);
                            });
                        })->where(['order_status'=>'failed'])->whereBetween('created_at', [$from, $to])->Notpos()->count()
                    ?>
                    <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--12">
                            <h4 class="title">
                                <?php echo e($failed); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.failed')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/failed.png')); ?>" alt="order-report">
                        </div>
                    <!-- End Card -->
                    </div>
                    <!--Failed End-->
                    <!--Canceled-->
                    <div class="col-sm-6 col-xl-3 mb-3">
                    <?php
                        $canceled=\App\Models\Order::when(isset($zone), function($query)use($zone){
                            return $query->whereHas('restaurant', function($q)use($zone){
                                return $q->where('zone_id', $zone->id);
                            });
                        })->where(['order_status'=>'canceled'])->whereBetween('created_at', [$from, $to])->Notpos()->count()
                    ?>
                    <!-- Card -->
                        <div class="resturant-card resturant-card-2 bg--13">
                            <h4 class="title">
                                <?php echo e($canceled); ?>

                            </h4>
                            <span class="subtitle">
                                <?php echo e(__('messages.canceled')); ?>

                            </span>
                            <img class="resturant-icon" src="<?php echo e(asset('public/assets/admin/img/order-report/canceled.png')); ?>" alt="order-report">
                        </div>
                        <!-- End Card -->
                    </div>
                    <!--canceled End-->

                </div>
            </div>
        </div>

        <!-- End Stats -->
        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header py-2 border-0">
                <div class="search--button-wrapper">
                    <h3 class="card-title">
                        <?php echo e('Day Wise Transaction Table'); ?> <span class="badge badge-soft-secondary"><?php echo e(count($order_transactions_list)); ?></span>
                    </h3>
                    <form action="javascript:" id="search-form" class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input class="form-control" placeholder="Search by Order ID">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>
                    <!-- Static Export Button -->
                    <div class="hs-unfold ml-3">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                            data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(__('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            
                            <span class="dropdown-header"><?php echo e(__('messages.download')); ?> <?php echo e(__('messages.options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.report.day-wise-report-export', ['type'=>'excel'])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                <?php echo e(__('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.report.day-wise-report-export', ['type'=>'csv'])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                .<?php echo e(__('messages.csv')); ?>

                            </a>
                            
                        </div>
                    </div>
                    <!-- Static Export Button -->
                </div>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-thead-bordered table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.id')); ?></th>
                                <th><?php echo e(__('messages.total_order_amount')); ?></th>
                                <th><?php echo e(__('messages.restaurant_commission')); ?></th>
                                <th><?php echo e(__('messages.admin_commission')); ?></th>
                                <th><?php echo e(translate('messages.delivery_fee')); ?></th>
                                <th><?php echo e(translate('messages.commission_on_delivery_fee')); ?></th>
                                <th><?php echo e(__('messages.vat/tax')); ?></th>
                                <th><?php echo e(translate('messages.amount_received_by')); ?></th>
                                <th><?php echo e(__('messages.created_at')); ?></th>
                            </tr>
                        </thead>
                        <tbody id="set-rows">
                        <?php $__currentLoopData = $order_transactions_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$ot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr scope="row">
                                <td ><?php echo e($k+$order_transactions_list->firstItem()); ?></td>
                                <td><a href="<?php echo e(route('admin.order.details',$ot->order_id)); ?>"><?php echo e($ot->order_id); ?></a></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->order_amount)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->restaurant_amount - $ot->tax)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->admin_commission)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->delivery_charge)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->delivery_fee_comission)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($ot->tax)); ?></td>
                                <td class="text-capitalize"><?php echo e($ot->received_by); ?></td>
                                <td><?php echo e($ot->created_at->format('Y/m/d '.config('timeformat'))); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(count($order_transactions_list) === 0): ?>
                    <div class="empty--data">
                        <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Body -->
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                                        
                    <div>
                        <?php echo $order_transactions_list->links(); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>

    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script
        src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/hs.chartjs-matrix.js"></script>

    <script>
        $(document).on('ready', function () {

            // INITIALIZATION OF FLATPICKR
            // =======================================================
            $('.js-flatpickr').each(function () {
                $.HSCore.components.HSFlatpickr.init($(this));
            });


            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CHARTJS
            // =======================================================
            $('.js-chart').each(function () {
                $.HSCore.components.HSChartJS.init($(this));
            });

            var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

            // Call when tab is clicked
            $('[data-toggle="chart"]').click(function (e) {
                let keyDataset = $(e.currentTarget).attr('data-datasets')

                // Update datasets for chart
                updatingChart.data.datasets.forEach(function (dataset, key) {
                    dataset.data = updatingChartDatasets[keyDataset][key];
                });
                updatingChart.update();
            })


            // INITIALIZATION OF MATRIX CHARTJS WITH CHARTJS MATRIX PLUGIN
            // =======================================================
            function generateHoursData() {
                var data = [];
                var dt = moment().subtract(365, 'days').startOf('day');
                var end = moment().startOf('day');
                while (dt <= end) {
                    data.push({
                        x: dt.format('YYYY-MM-DD'),
                        y: dt.format('e'),
                        d: dt.format('YYYY-MM-DD'),
                        v: Math.random() * 24
                    });
                    dt = dt.add(1, 'day');
                }
                return data;
            }

            $.HSCore.components.HSChartMatrixJS.init($('.js-chart-matrix'), {
                data: {
                    datasets: [{
                        label: 'Commits',
                        data: generateHoursData(),
                        width: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.right - a.left) / 70;
                        },
                        height: function (ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.bottom - a.top) / 10;
                        }
                    }]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            title: function () {
                                return '';
                            },
                            label: function (item, data) {
                                var v = data.datasets[item.datasetIndex].data[item.index];

                                if (v.v.toFixed() > 0) {
                                    return '<span class="font-weight-bold">' + v.v.toFixed() + ' hours</span> on ' + v.d;
                                } else {
                                    return '<span class="font-weight-bold">No time</span> on ' + v.d;
                                }
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            position: 'bottom',
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'week',
                                round: 'week',
                                displayFormats: {
                                    week: 'MMM'
                                }
                            },
                            ticks: {
                                "labelOffset": 20,
                                "maxRotation": 0,
                                "minRotation": 0,
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 12,
                            },
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            type: 'time',
                            offset: true,
                            time: {
                                unit: 'day',
                                parser: 'e',
                                displayFormats: {
                                    day: 'ddd'
                                }
                            },
                            ticks: {
                                "fontSize": 12,
                                "fontColor": "rgba(22, 52, 90, 0.5)",
                                "maxTicksLimit": 2,
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            });


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function () {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });


            // INITIALIZATION OF CIRCLES
            // =======================================================
            $('.js-circle').each(function () {
                var circle = $.HSCore.components.HSCircles.init($(this));
            });

            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/vendor/get-restaurants',
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            // all:true,
                            <?php if(isset($zone)): ?>
                                zone_ids: [<?php echo e($zone->id); ?>],
                            <?php endif; ?>
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    __port: function(params, success, failure) {
                        var $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
            });

            $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.report.day-wise-report-search')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        });
        });
    </script>

    <script>
        $('#from_date,#to_date').change(function () {
            let fr = $('#from_date').val();
            let to = $('#to_date').val();
            if (fr != '' && to != '') {
                if (fr > to) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    toastr.error('Invalid date range!', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/report/day-wise-report.blade.php ENDPATH**/ ?>