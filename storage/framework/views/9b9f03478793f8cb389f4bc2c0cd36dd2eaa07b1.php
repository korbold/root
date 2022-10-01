<?php ($params = session('dash_params')); ?>
<?php if($params['zone_id'] != 'all'): ?>
    <?php ($zone_name = \App\Models\Zone::where('id', $params['zone_id'])->first()->name); ?>
<?php else: ?>
    <?php ($zone_name = 'All'); ?>
<?php endif; ?>
<div class="chartjs-custom mx-auto">
    <canvas id="user-overview" class="mt-2"></canvas>
</div>
<div class="total--users">
    <span><?php echo e(translate('messages.total_users')); ?></span>
    <h3><?php echo e($data['customer'] + $data['restaurants'] + $data['delivery_man']); ?></h3>
</div>


<script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>


<script>
    var ctx = document.getElementById('user-overview');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'User',
                data: ['<?php echo e($data['customer']); ?>', '<?php echo e($data['restaurants']); ?>',
                    '<?php echo e($data['delivery_man']); ?>'
                ],
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
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/partials/_user-overview-chart.blade.php ENDPATH**/ ?>