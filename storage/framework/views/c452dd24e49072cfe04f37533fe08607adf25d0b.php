<div class="card-body">
    <div class="row mb-3">
        <div class="col-12">
            <?php ($params=session('dash_params')); ?>
            <?php if($params['zone_id']!='all'): ?>
                <?php ($zone_name=\App\Models\Zone::where('id',$params['zone_id'])->first()->name); ?>
            <?php else: ?>
                <?php ($zone_name='All'); ?>
            <?php endif; ?>
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <span class="h5 m-0 mr-3 fz--11 d-flex align-items-center mb-2 mb-md-0">
                    <span class="legend-indicator bg-7ECAFF"></span>
                    <?php echo e(__('messages.admin_commission')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency(array_sum($commission))); ?>

                </span>
                <span class="h5 m-0 fz--11 d-flex align-items-center mb-2 mb-md-0">
                    <span class="legend-indicator bg-0661CB"></span>
                    <?php echo e(__('messages.total_sell')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency(array_sum($total_sell))); ?>

                </span>

            </div>
          </div>
          <div class="col-12">
              <div class="text-right mt--xl--10"><span class="badge badge-soft--info">Zone : <?php echo e($zone_name); ?></span>
              </div>
          </div>
    </div>
    <!-- End Row -->

    <!-- Bar Chart -->
    <div class="d-flex align-items-center">
      <div class="chart--extension">
        <?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>(<?php echo e(translate('messages.currency')); ?>)
      </div>
      <div class="chartjs-custom w-75 flex-grow-1">
          <canvas id="updatingData" class="h-20rem"
                  data-hs-chartjs-options='{
                    "type": "bar",
                    "data": {
                      "labels": ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                      "datasets": [{
                        "data": [<?php echo e($commission[1]); ?>,<?php echo e($commission[2]); ?>,<?php echo e($commission[3]); ?>,<?php echo e($commission[4]); ?>,<?php echo e($commission[5]); ?>,<?php echo e($commission[6]); ?>,<?php echo e($commission[7]); ?>,<?php echo e($commission[8]); ?>,<?php echo e($commission[9]); ?>,<?php echo e($commission[10]); ?>,<?php echo e($commission[11]); ?>,<?php echo e($commission[12]); ?>],
                        "backgroundColor": "#7ECAFF",
                        "hoverBackgroundColor": "#7ECAFF",
                        "borderColor": "#7ECAFF"
                      },
                      {
                        "data": [<?php echo e($total_sell[1]); ?>,<?php echo e($total_sell[2]); ?>,<?php echo e($total_sell[3]); ?>,<?php echo e($total_sell[4]); ?>,<?php echo e($total_sell[5]); ?>,<?php echo e($total_sell[6]); ?>,<?php echo e($total_sell[7]); ?>,<?php echo e($total_sell[8]); ?>,<?php echo e($total_sell[9]); ?>,<?php echo e($total_sell[10]); ?>,<?php echo e($total_sell[11]); ?>,<?php echo e($total_sell[12]); ?>],
                        "backgroundColor": "#0661CB",
                        "borderColor": "#0661CB"
                      }]
                    },
                    "options": {
                      "scales": {
                        "yAxes": [{
                          "gridLines": {
                            "color": "#e7eaf3",
                            "drawBorder": false,
                            "zeroLineColor": "#e7eaf3"
                          },
                          "ticks": {
                            "beginAtZero": true,
                            "stepSize": <?php echo e(ceil((array_sum($total_sell)/10000))*2000); ?>,
                            "fontSize": 12,
                            "fontColor": "#373D3F",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 10
                          }
                        }],
                        "xAxes": [{
                          "gridLines": {
                            "display": false,
                            "drawBorder": false
                          },
                          "ticks": {
                            "fontSize": 12,
                            "fontColor": "#373D3F",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 5
                          },
                          "categoryPercentage": 0.3,
                          "maxBarThickness": "10"
                        }]
                      },
                      "cornerRadius": 5,
                      "tooltips": {
                        "prefix": " ",
                        "hasIndicator": true,
                        "mode": "index",
                        "intersect": false
                      },
                      "hover": {
                        "mode": "nearest",
                        "intersect": true
                      }
                    }
                  }'>
          </canvas>
      </div>
    </div>
    <!-- End Bar Chart -->
</div>

<script>
    // INITIALIZATION OF CHARTJS
    // =======================================================
    Chart.plugins.unregister(ChartDataLabels);

    $('.js-chart').each(function () {
        $.HSCore.components.HSChartJS.init($(this));
    });

    var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/partials/_monthly-earning-graph.blade.php ENDPATH**/ ?>