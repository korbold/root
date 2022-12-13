<div class="initial-49">
    <div class="modal-header p-0">
        <h4 class="modal-title product-title">
        </h4>
        <button class="close call-when-done" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="d-flex flex-row align-items-center">
            <?php if(config('toggle_veg_non_veg')): ?>
                <span
                    class="badge badge-<?php echo e($product->veg ? 'success' : 'danger'); ?> position-absolute"><?php echo e($product->veg ? translate('messages.veg') : translate('messages.non_veg')); ?></span>
            <?php endif; ?>
            <!-- Product gallery-->
            <div class="d-flex align-items-center justify-content-center active h-9rem">
                <img class="img-responsive mr-3 img--100"
                    src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($product['image']); ?>"
                    onerror="this.src='<?php echo e(asset('/public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                    data-zoom="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($product['image']); ?>" alt="Product image"
                    width="">
                <div class="cz-image-zoom-pane"></div>
            </div>
            <!-- Product details-->
            <div class="details pl-2">
                <a href="<?php echo e(route('admin.food.view', $product->id)); ?>"
                    class="h3 mb-2 product-title text-capitalize text-break"><?php echo e($product->name); ?></a>

                <div class="mb-3 text-dark">
                    <span class="h3 font-weight-normal text-accent mr-1">
                        <?php echo e(\App\CentralLogics\Helpers::get_price_range($product, true)); ?>

                    </span>
                    <?php if($product->discount > 0 || \App\CentralLogics\Helpers::get_restaurant_discount($product->restaurant)): ?>
                        <strike class="fz-12px">
                            <?php echo e(\App\CentralLogics\Helpers::get_price_range($product)); ?>

                        </strike>
                    <?php endif; ?>
                </div>

                <?php if($product->discount > 0): ?>
                    <div class="mb-3 text-dark">
                        <strong><?php echo e(translate('messages.discount')); ?> : </strong>
                        <strong
                            id="set-discount-amount"><?php echo e(\App\CentralLogics\Helpers::get_product_discount($product)); ?></strong>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="row pt-2">
            <div class="col-12">
                <?php
                $cart = false;
                if (session()->has('cart')) {
                    foreach (session()->get('cart') as $key => $cartItem) {
                        if (is_array($cartItem) && $cartItem['id'] == $product['id']) {
                            $cart = $cartItem;
                        }
                    }
                }

                ?>
                <h2><?php echo e(translate('messages.description')); ?></h2>
                <span class="d-block text-dark text-break">
                    <?php echo $product->description; ?>

                </span>
                <form id="add-to-cart-form" class="mb-2">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                    <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="h3 p-0 pt-2"><?php echo e($choice->title); ?>

                        </div>

                        <div class="d-flex justify-content-left flex-wrap">
                            <?php $__currentLoopData = $choice->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input class="btn-check" type="radio" id="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"
                                    name="<?php echo e($choice->name); ?>" value="<?php echo e($option); ?>"
                                    <?php if($key == 0): ?> checked <?php endif; ?> autocomplete="off">
                                <label class="btn btn-sm check-label mx-1 choice-input text-break"
                                    for="<?php echo e($choice->name); ?>-<?php echo e($option); ?>"><?php echo e(Str::limit($option, 20, '...')); ?></label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Quantity + Add to cart -->
                    <div class="d-flex justify-content-between">
                        <div class="product-description-label mt-2 text-dark h3"><?php echo e(translate('messages.quantity')); ?>:</div>
                        <div class="product-quantity d-flex align-items-center">
                            <div class="input-group input-group--style-2 pr-3"
                                    style="width: 160px;">
                                <span class="input-group-btn">
                                    <button class="btn btn-number text-dark" type="button"
                                            data-type="minus" data-field="quantity"
                                            disabled="disabled" style="padding: 10px">
                                            <i class="tio-remove  font-weight-bold"></i>
                                    </button>
                                </span>
                                <input type="text" name="quantity"
                                        class="form-control input-number text-center cart-qty-field"
                                        placeholder="1" value="1" min="1" max="100">
                                <span class="input-group-btn">
                                    <button class="btn btn-number text-dark" type="button" data-type="plus"
                                            data-field="quantity" style="padding: 10px">
                                            <i class="tio-add  font-weight-bold"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php ($add_ons = json_decode($product->add_ons)); ?>
                    <?php if(count($add_ons) > 0): ?>
                        <div class="h3 p-0 pt-2"><?php echo e(translate('messages.addon')); ?></div>

                        <div class="d-flex justify-content-left flex-wrap">
                            <?php $__currentLoopData = \App\Models\AddOn::whereIn('id', $add_ons)->active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $add_on): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex-column pb-2">
                                    <input type="hidden" name="addon-price<?php echo e($add_on->id); ?>"
                                        value="<?php echo e($add_on->price); ?>">
                                    <input class="btn-check addon-chek" type="checkbox" id="addon<?php echo e($key); ?>"
                                        onchange="addon_quantity_input_toggle(event)" name="addon_id[]"
                                        value="<?php echo e($add_on->id); ?>" autocomplete="off">
                                    <label
                                        class="d-flex align-items-center btn btn-sm check-label mx-1 addon-input text-break"
                                        for="addon<?php echo e($key); ?>"><?php echo e(Str::limit($add_on->name, 20, '...')); ?> <br>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($add_on->price)); ?></label>
                                    <label class="input-group addon-quantity-input mx-1 shadow bg-white rounded px-1"
                                        for="addon<?php echo e($key); ?>">
                                        <button class="btn btn-sm h-100 text-dark px-0" type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(), getVariantPrice()"><i
                                                class="tio-remove  font-weight-bold"></i></button>
                                        <input type="number" name="addon-quantity<?php echo e($add_on->id); ?>"
                                            class="form-control text-center border-0 h-100" placeholder="1" value="1"
                                            min="1" max="100" readonly>
                                        <button class="btn btn-sm h-100 text-dark px-0" type="button"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(), getVariantPrice()"><i
                                                class="tio-add  font-weight-bold"></i></button>
                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row no-gutters d-none mt-2 text-dark" id="chosen_price_div">
                        <div class="col-2">
                            <div class="product-description-label"><?php echo e(translate('messages.Total Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button class="btn btn--primary h--45px w-40p" onclick="addToCart()" type="button">
                            <i class="tio-shopping-cart"></i>
                            <?php echo e(trans('messages.add_to_cart')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    cartQuantityInitialize();
    getVariantPrice();
    $('#add-to-cart-form input').on('change', function() {
        getVariantPrice();
    });
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/pos/_quick-view-data.blade.php ENDPATH**/ ?>