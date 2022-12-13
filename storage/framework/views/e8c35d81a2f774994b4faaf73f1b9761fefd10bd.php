<?php $__env->startSection('title', __('messages.food_wise_report')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
    $from = session('from_date');
    $to = session('to_date');
    ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-filter-list"></i> <?php echo e(__('messages.food_wise_report')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <div class="report-card-inner">
                    <form action="<?php echo e(route('admin.report.set-date')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex mb-2 flex-wrap justify-content-between align-items-center">
                            <div class="mx-1 mb-1">
                                <h4 class="form-label">
                                    <?php echo e(__('messages.show')); ?>

                                    <?php echo e(__('messages.data')); ?> by <?php echo e(__('messages.date')); ?>

                                    <?php echo e(__('messages.range')); ?>

                                </h4>
                            </div>
                            <div class="mx-1 mb-1">
                                <button type="submit" class="btn btn--primary btn-block"><?php echo e(__('messages.show')); ?> <?php echo e(__('messages.data')); ?></button>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm-6">
                                <select name="zone_id" class="form-control js-select2-custom h--45px"
                                    onchange="set_zone_filter('<?php echo e(url()->full()); ?>',this.value)" id="zone_id">
                                    <option value="all"><?php echo e(translate('All Zones')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($z['id']); ?>" <?php echo e(isset($zone) && $zone->id == $z['id'] ? 'selected' : ''); ?>>
                                            <?php echo e($z['name']); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select name="restaurant_id" onchange="set_restaurant_filter('<?php echo e(url()->full()); ?>',this.value)"
                                    data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.restaurant')); ?>"
                                    class="js-data-example-ajax form-control h--45px">
                                    <?php if(isset($restaurant)): ?>
                                        <option value="<?php echo e($restaurant->id); ?>" selected><?php echo e($restaurant->name); ?></option>
                                    <?php else: ?>
                                        <option value="all" selected><?php echo e(__('messages.all')); ?> <?php echo e(__('messages.restaurants')); ?>

                                        </option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="floating-label" for="from_date"><?php echo e(translate('start_date')); ?></label>
                                    <input type="date" name="from" id="from_date"
                                        <?php echo e(session()->has('from_date') ? 'value=' . session('from_date') : ''); ?>

                                        class="form-control h--45px" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="floating-label" for="to_date"><?php echo e(translate('end_date')); ?></label>
                                    <input type="date" name="to" id="to_date"
                                        <?php echo e(session()->has('to_date') ? 'value=' . session('to_date') : ''); ?> class="form-control h--45px"
                                        required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Stats -->
        <!-- Card -->
        <div class="card mt-4">
            <!-- Header -->
            <div class="card-header py-2 border-0">
                <div class="search--button-wrapper">
                <h3 class="card-title">
                    <?php echo e(translate('Food Wise Report Table')); ?>

                    <span class="badge badge-soft-dark"><?php echo e($foods ? count($foods) : 0); ?></span>
                </h3>
                <form id="search-form">
                    <?php echo csrf_field(); ?>
                    <!-- Search -->
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch" name="search" type="search" class="form-control"
                            placeholder="Search by name or restaurant..."
                            aria-label="<?php echo e(__('messages.search_here')); ?>">
                        <button type="submit" class="btn btn--secondary">
                            <i class="tio-search"></i>
                        </button>
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
                        
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.report.food-wise-report-export', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                            <?php echo e(__('messages.excel')); ?>

                        </a>

                        <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.report.food-wise-report-export', ['type'=>'csv'])); ?>">
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

            <!-- Table -->
            <div class="table-responsive datatable-custom" id="table-div">
                <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap card-table"
                    data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [],
                                "width": "5%",
                                "orderable": false
                            }],
                            "order": [],
                            "info": {
                            "totalQty": "#datatableWithPaginationInfoTotalQty"
                            },

                            "entries": "#datatableEntries",

                            "isResponsive": false,
                            "isShowPaging": false,
                            "paging":false
                        }'>
                    <thead class="thead-light">
                        <tr>
                            <th>SL</th>
                            <th><?php echo e(__('messages.name')); ?></th>
                            <th><?php echo e(__('messages.restaurant')); ?></th>
                            <th><?php echo e(__('messages.zone')); ?></th>
                            <th><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.count')); ?></th>
                        </tr>
                    </thead>

                    <tbody id="set-rows">
                        

                        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <tr>
                                <td><?php echo e($key + $foods->firstItem()); ?></td>
                                <td>
                                    <a class="table-rest-info"
                                        href="<?php echo e(route('admin.food.view', [$food['id']])); ?>">
                                        <img src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($food['image']); ?>"
                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img2.jpg')); ?>'"
                                            alt="<?php echo e($food->name); ?> image">
                                        <div class="info">
                                            <span class="d-block text-body">
                                                <?php echo e($food['name']); ?><br/>
                                                <!-- Rating -->
                                                <span class="rating">
                                                    <i class="tio-star"></i> <?php echo e($food->avg_rating); ?>

                                                </span>
                                                <!-- Rating -->
                                            </span>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <?php if($food->restaurant): ?>
                                        <a href="#0" class="text--title text-hover-primary">
                                            <?php echo e(Str::limit($food->restaurant->name, 25, '...')); ?>

                                        </a>
                                    <?php else: ?>
                                        <?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.deleted')); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($food->restaurant): ?>
                                            <?php echo e($food->restaurant->zone->name); ?>

                                    <?php else: ?>
                                        <?php echo e(__('messages.not_found')); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($food->orders_count); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(count($foods) === 0): ?>
            <div class="empty--data">
                <img src="<?php echo e(asset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                <h5>
                    <?php echo e(translate('no_data_found')); ?>

                </h5>
            </div>
            <?php endif; ?>
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                                        
                    <div>
                        <?php echo $foods->links(); ?>

                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/hs.chartjs-matrix.js"></script>

    <script>
        $(document).on('ready', function() {

            // INITIALIZATION OF FLATPICKR
            // =======================================================
            $('.js-flatpickr').each(function() {
                $.HSCore.components.HSFlatpickr.init($(this));
            });


            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function() {
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
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CHARTJS
            // =======================================================
            $('.js-chart').each(function() {
                $.HSCore.components.HSChartJS.init($(this));
            });

            var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

            // Call when tab is clicked
            $('[data-toggle="chart"]').click(function(e) {
                let keyDataset = $(e.currentTarget).attr('data-datasets')

                // Update datasets for chart
                updatingChart.data.datasets.forEach(function(dataset, key) {
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
                        width: function(ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.right - a.left) / 70;
                        },
                        height: function(ctx) {
                            var a = ctx.chart.chartArea;
                            return (a.bottom - a.top) / 10;
                        }
                    }]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            title: function() {
                                return '';
                            },
                            label: function(item, data) {
                                var v = data.datasets[item.datasetIndex].data[item.index];

                                if (v.v.toFixed() > 0) {
                                    return '<span class="font-weight-bold">' + v.v.toFixed() +
                                        ' hours</span> on ' + v.d;
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
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });


            // INITIALIZATION OF CIRCLES
            // =======================================================
            $('.js-circle').each(function() {
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
        });
    </script>

    <script>
        $('#from_date,#to_date').change(function() {
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

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.report.food-wise-report-search')); ?>',
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/report/food-wise-report.blade.php ENDPATH**/ ?>