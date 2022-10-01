<?php ($params = session('dash_params')); ?>
<?php if($params['zone_id']!='all'): ?>
<?php ($zone_name=\App\Models\Zone::where('id',$params['zone_id'])->first()->name); ?>
<?php else: ?>
<?php ($zone_name='All'); ?>
<?php endif; ?>
<span class="badge badge-soft--info text-capitalize"><?php echo e(translate('messages.zone')); ?> : <?php echo e($zone_name); ?></span>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/partials/_zone-change.blade.php ENDPATH**/ ?>