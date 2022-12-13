<!-- Header -->
<div class="card-header">
    <h5 class="card-header-title align-items-center d-flex">
        <img src="<?php echo e(asset('/public/assets/admin/img/dashboard/top-selling.png')); ?>" alt="dashboard" class="card-header-icon mr-2 mb-1">
        <span><?php echo e(trans('messages.top_selling_foods')); ?></span>
    </h5>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="row g-2">
        <?php $__currentLoopData = $top_sell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-6">
                <div class="grid-card top-selling-food-card pt-0" onclick="location.href='<?php echo e(route('vendor.food.view',[$item['id']])); ?>'">
                    <div class="position-relative">
                        <span class="sold--count-badge">
                            <?php echo e(__('messages.sold')); ?> : <?php echo e($item['order_count']); ?>

                        </span>
                        <img class="rounded" style="width: 100%;height: 120px;object-fit:cover"
                            src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($item['image']); ?>"
                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food.png')); ?>'" alt="<?php echo e($item->name); ?> image">
                    </div>
                    <div class="text-center mt-2">
                        <span><?php echo e($item['name']); ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- End Body -->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/vendor-views/partials/_top-selling-foods.blade.php ENDPATH**/ ?>