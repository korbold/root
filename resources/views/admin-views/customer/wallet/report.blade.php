@extends('layouts.admin.app')

@section('title',__('messages.customer_wallet').' '.__('messages.report'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="{{asset('/public/assets/admin/img/payment.png')}}" alt="public">
                </div>
                <span>
                    {{__('messages.customer_wallet')}} {{__('messages.report')}}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-header text-capitalize">
                <h5 class="card-title">
                    <span class="card-header-icon">
                        <i class="tio-filter-outlined"></i>
                    </span>
                    <span>{{__('messages.filter')}} {{__('messages.options')}}</span>
                </h5>
            </div>
            <div class="card-body">
                <form action="{{route('admin.customer.wallet.report')}}" method="get">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <input type="date" name="from" id="from_date" value="{{request()->get('from')}}" class="form-control h--45px" title="{{__('messages.from')}} {{__('messages.date')}}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <input type="date" name="to" id="to_date" value="{{request()->get('to')}}" class="form-control h--45px" title="{{ucfirst(__('messages.to'))}} {{__('messages.date')}}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                @php
                                $transaction_status=request()->get('transaction_type');
                                @endphp
                                <select name="transaction_type" id="" class="form-control h--45px" title="{{__('messages.select')}} {{__('messages.transaction_type')}}">
                                    <option value="">{{__('messages.all')}}</option>
                                    <option value="add_fund_by_admin" {{isset($transaction_status) && $transaction_status=='add_fund_by_admin'?'selected':''}} >{{__('messages.add_fund_by_admin')}}</option>
                                    <!-- <option value="add_fund" {{isset($transaction_status) && $transaction_status=='add_fund'?'selected':''}}>{{__('messages.add_fund_by_customer')}}</option> -->
                                    <option value="order_refund" {{isset($transaction_status) && $transaction_status=='order_refund'?'selected':''}}>{{__('messages.refund_order')}}</option>
                                    <option value="loyalty_point" {{isset($transaction_status) && $transaction_status=='loyalty_point'?'selected':''}}>{{__('messages.customer_loyalty_point')}}</option>
                                    <option value="order_place" {{isset($transaction_status) && $transaction_status=='order_place'?'selected':''}}>{{__('messages.order_place')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <select id='customer' name="customer_id" data-placeholder="{{__('messages.select_customer')}}" class="js-data-example-ajax form-control h--45px" title="{{__('messages.select_customer')}}">
                                    @if (request()->get('customer_id') && $customer_info = \App\Models\User::find(request()->get('customer_id')))
                                        <option value="{{$customer_info->id}}" selected>{{$customer_info->f_name.' '.$customer_info->l_name}}({{$customer_info->phone}})</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset">
                            {{__('messages.reset')}}
                        </button>
                        <button type="submit" class="btn btn--primary">
                            <i class="tio-filter-list mr-1"></i>{{__('messages.filter')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-2">
            @php
                $credit = $data[0]->total_credit;
                $debit = $data[0]->total_debit;
                $balance = $credit - $debit;
            @endphp
            <!--Debit earned-->
            <div class="col-sm-4">
                <!-- Card -->
                <div class="resturant-card dashboard--card bg--2">
                    <h4 class="title">{{__('messages.debit')}}</h4>
                    <span class="subtitle">
                        {{\App\CentralLogics\Helpers::format_currency($debit)}}
                    </span>
                    <img class="resturant-icon" src="{{asset('/public/assets/admin/img/dashboard/3.png')}}" alt="dashboard">
                </div>
                <!-- End Card -->
            </div>
            <!--Debit earned End-->
            <!--credit earned-->
            <div class="col-sm-4">
                <!-- Card -->
                <div class="resturant-card dashboard--card bg--3">
                    <h4 class="title">{{__('messages.credit')}}</h4>
                    <span class="subtitle">
                        {{\App\CentralLogics\Helpers::format_currency($credit)}}
                    </span>
                    <img class="resturant-icon" src="{{asset('/public/assets/admin/img/dashboard/4.png')}}" alt="dashboard">
                </div>
                <!-- End Card -->
            </div>
            <!--credit earned end-->
            <!--balance earned-->
            <div class="col-sm-4">
                <!-- Card -->
                <div class="resturant-card dashboard--card bg--1">
                    <h4 class="title">{{__('messages.balance')}}</h4>
                    <span class="subtitle">
                        {{\App\CentralLogics\Helpers::format_currency($balance)}}
                    </span>
                    <img class="resturant-icon" src="{{asset('/public/assets/admin/img/dashboard/1.png')}}" alt="dashboard">
                </div>
                <!-- End Card -->
            </div>
            <!--balance earned end-->
        </div>

        <!-- End Stats -->
        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header text-capitalize border-0">
                <h4 class="card-title">
                    <span class="card-header-icon"><i class="tio-money"></i></span>
                    <span>{{__('messages.transactions')}}</span>
                </h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-thead-bordered table-align-middle card-table table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>{{__('messages.transaction')}} {{__('messages.id')}}</th>
                                <th>{{__('messages.customer')}}</th>
                                <th>{{__('messages.credit')}}</th>
                                <th>{{__('messages.debit')}}</th>
                                <th>{{__('messages.balance')}}</th>
                                <th>{{__('messages.transaction_type')}}</th>
                                <th>{{__('messages.reference')}}</th>
                                <!-- <th>{{__('messages.admin_bonus')}}</th> -->
                                <th>{{__('messages.created_at')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $k=>$wt)
                            <tr scope="row">
                                <td >{{$k+$transactions->firstItem()}}</td>
                                <td>{{$wt->transaction_id}}</td>
                                <td><a href="{{route('admin.customer.view',['user_id'=>$wt->user_id])}}">{{Str::limit($wt->user?$wt->user->f_name.' '.$wt->user->l_name:__('messages.not_found'),20,'...')}}</a></td>
                                <td>{{$wt->credit}}</td>
                                <td>{{$wt->debit}}</td>
                                <td>{{$wt->balance}}</td>
                                <td>
                                    <span class="badge badge-soft-{{$wt->transaction_type=='order_refund'
                                        ?'danger'
                                        :($wt->transaction_type=='loyalty_point'?'warning'
                                            :($wt->transaction_type=='order_place'
                                                ?'info'
                                                :'success'))
                                        }}">
                                        {{ translate('messages.'.$wt->transaction_type)}}
                                    </span>
                                </td>
                                <td>{{$wt->reference}}</td>
                                <!-- <td>{{$wt->admin_bonus}}</td> -->
                                <td>{{date('Y/m/d '.config('timeformat'), strtotime($wt->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(!$transactions)
                    <div class="empty--data">
                        <img src="{{asset('/public/assets/admin/img/empty.png')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        {{-- <div>
                            1-15 of 380
                        </div> --}}
                        <div>
                            {!! $transactions->links() !!}
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
            </div>
    </div>
@endsection

@push('script')

@endpush

@push('script_2')

    <script src="{{asset('public/assets/admin')}}/vendor/chart.js/dist/Chart.min.js"></script>
    <script
        src="{{asset('public/assets/admin')}}/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="{{asset('public/assets/admin')}}/js/hs.chartjs-matrix.js"></script>

    <script>
        $(document).on('ready', function () {
            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '{{route('admin.customer.select-list')}}',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            all:true,
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                        results: data
                        };
                    },
                    __port: function (params, success, failure) {
                        var $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
            });

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

        $('#reset_btn').click(function(){
            $('#customer').val(null).trigger('change');
        })
    </script>
@endpush
