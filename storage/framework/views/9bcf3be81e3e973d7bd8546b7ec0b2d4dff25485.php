<div class="product-card cursor-pointer card" onclick="quickView('<?php echo e($product->id); ?>')">
    <div class="card-header inline_product clickable p-0 initial-50">
        <div class="d-flex align-items-center justify-content-center d-block">
            <img class="w-100 rounded" src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($product['image']); ?>"
                onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'">
        </div>
    </div>

    <div class="card-body inline_product text-center py-2 px-2 clickable">
        <div class="position-relative product-title1 text-dark font-weight-bold text-capitalize">
            <?php echo e(Str::limit($product['name'], 12, '...')); ?>

        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center">
                <span class="text-accent font-weight-bold text-yellow">
                    <?php echo e(\App\CentralLogics\Helpers::format_currency($product['price'] - \App\CentralLogics\Helpers::product_discount_calculate($product, $product['price'], $restaurant_data))); ?>

                </span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/pos/_single_product.blade.php ENDPATH**/ ?>