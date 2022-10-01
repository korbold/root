<?php
$max_processing_time = $order->restaurant?explode('-', $order->restaurant['delivery_time'])[0]:0;
?>


<?php $__env->startSection('title', translate('Order Details')); ?>

<?php $__env->startSection('content'); ?>
    <?php $campaign_order = isset($order->details[0]->campaign) ? true : false; ?>
    <div class="content container-fluid initial-39">
        <!-- Page Header -->
        <div class="page-header d-print-none">

            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('/public/assets/admin/img/orders.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.details')); ?>

                </span>
                <div class="d-flex ml-auto">
                    <a class="btn btn-icon btn-sm badge-soft-primary rounded-circle justify-content-center mr-1"
                        href="<?php echo e(route('admin.order.details', [$order['id'] - 1])); ?>" data-toggle="tooltip"
                        data-placement="top" title="Previous order">
                        <i class="tio-chevron-left m-0"></i>
                    </a>
                    <a class="btn btn-icon btn-sm badge-soft-primary rounded-circle justify-content-center"
                        href="<?php echo e(route('admin.order.details', [$order['id'] + 1])); ?>" data-toggle="tooltip"
                        data-placement="top" title="Next order">
                        <i class="tio-chevron-right m-0"></i>
                    </a>
                </div>
            </h1>

            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="mt-2">
                        <?php
                            $refund_amount = $order->order_amount;
                            if ($order->order_status == 'delivered') {
                                $refund_amount = $order->order_amount - $order->delivery_charge;
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row g-1" id="printableArea">
            <div class="col-lg-8 order-print-area-left">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header border-0 align-items-start flex-wrap">
                        <div class="order-invoice-left">
                            <h1 class="page-header-title mt-2">
                                <span class="font--max-sm"><?php echo e(__('messages.order')); ?> <?php echo e(translate('id')); ?> <?php echo e(translate('#')); ?><?php echo e($order['id']); ?></span>
                                <!-- Static -->
                                
                                <?php if($order->edited): ?>
                                <span class="badge badge-soft-danger text-capitalize my-2 ml-2">
                                    <?php echo e(__('messages.edited')); ?>

                                </span>
                                <?php endif; ?>
                                <!-- Static -->
                                <div class="d-sm-none d-flex flex-wrap ml-auto align-items-center justify-content-end initial-39-2">
                                <?php if(!$editing && in_array($order->order_status, ['pending', 'confirmed', 'processing', 'accepted'])): ?>
                                    <?php if($order->restaurant): ?>
                                        <button class="btn bn--primary btn-outline-primary m-1 print--btn" type="button" onclick="edit_order()">
                                            <i class="tio-edit"></i> <span><?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.order')); ?></span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a class="btn btn--primary m-1 print--btn" href=<?php echo e(route('admin.order.generate-invoice', [$order['id']])); ?>>
                                    <i class="tio-print mr-1"></i> <span><?php echo e(__('messages.print')); ?> <?php echo e(__('messages.invoice')); ?></span>
                                </a>
                            </div>
                            </h1>
                            <span class="mt-2 d-block">
                                <i class="tio-date-range"></i>
                                <?php echo e(date('d M Y ' . config('timeformat'), strtotime($order['created_at']))); ?>


                            </span>
                            <?php if($order->schedule_at && $order->scheduled): ?>
                                <span>
                                    <span><?php echo e(__('messages.scheduled_at')); ?> :</span>
                                    <strong class="text-warning"><?php echo e(date('d M Y ' . config('timeformat'), strtotime($order['schedule_at']))); ?></strong>
                                </span>
                            <?php endif; ?>
                            <h6 class="mt-2 pt-1 mb-2">
                                <i class="tio-shop"></i>
                                <?php echo e(__('messages.restaurant')); ?> : <label
                                    class="badge badge-soft-info font-regular m-0"><?php echo e(Str::limit($order->restaurant ? $order->restaurant->name : __('messages.Restaurant deleted!'), 25, '...')); ?></label>
                            </h6>
                            <h6 class="m-0">
                            <?php if($campaign_order): ?>
                                    <span class="badge badge-soft-primary ml-sm-3">
                                        <?php echo e(__('messages.campaign_order')); ?>

                                    </span>
                                <?php endif; ?>
                            </h6>
                            <div class="hs-unfold mt-2">
                                <button class="btn order--details-btn-sm btn--primary btn-outline-primary btn--sm" data-toggle="modal" data-target="#locationModal"><i
                                        class="tio-poi-outlined"></i> <span class="ml-1"><?php echo e(__('messages.show_locations_on_map')); ?></span> </button>
                                <?php if($order->payment_method != 'cash_on_delivery' && $order->payment_status == 'paid' && $order->order_status != 'refunded' && isset($order->restaurant)): ?>
                                    <button class="btn order--details-btn-sm btn--warning btn-outline-warning btn--sm mt-2"
                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'refunded'])); ?>','<?php echo e(__('messages.you_want_to_refund_this_order', ['amount' => $refund_amount . ' ' . \App\CentralLogics\Helpers::currency_code()])); ?>', '<?php echo e(__('messages.are_you_sure_want_to_refund')); ?>')"><i
                                            class="tio-money"></i> <span class="ml-1"><?php echo e(__('messages.refund_this_order')); ?></span> </button>
                                <?php endif; ?>
                            </div>
                            <div class="order--note mt-3">
                                <?php if($order['order_note'] != null): ?>
                                    <strong class="text--title"><?php echo e(__('messages.note')); ?> :</strong>
                                    <span><?php echo e($order['order_note']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="order-invoice-right">
                            <div class="d-none d-sm-flex flex-wrap ml-auto align-items-center justify-content-end initial-39-1">
                                <?php if(!$editing && in_array($order->order_status, ['pending', 'confirmed', 'processing', 'accepted'])): ?>
                                    <?php if($order->restaurant): ?>
                                        <button class="btn bn--primary btn-outline-primary m-2 print--btn" type="button" onclick="edit_order()">
                                            <i class="tio-edit"></i> <span><?php echo e(__('messages.edit')); ?> <?php echo e(__('messages.order')); ?></span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a class="btn btn--primary m-2 print--btn" href=<?php echo e(route('admin.order.generate-invoice', [$order['id']])); ?>>
                                    <i class="tio-print mr-1"></i> <span><?php echo e(__('messages.print')); ?> <?php echo e(__('messages.invoice')); ?></span>
                                </a>
                            </div>
                            <div class="text-right mt-3 order-invoice-right-contents text-capitalize">
                                <h6>
                                    <span><?php echo e(__('messages.status')); ?> :</span>
                                    <?php if($order['order_status'] == 'pending'): ?>
                                        <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.pending')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'confirmed'): ?>
                                        <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.confirmed')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'processing'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.processing')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'picked_up'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.out_for_delivery')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'delivered'): ?>
                                        <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.delivered')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'failed'): ?>
                                        <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(__('messages.payment')); ?>

                                            <?php echo e(__('messages.failed')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize font-medium">
                                            <?php echo e(str_replace('_', ' ', $order['order_status'])); ?>

                                        </span>
                                    <?php endif; ?>
                                </h6>
                                <h6>
                                    <span><?php echo e(__('messages.payment')); ?> <?php echo e(__('messages.method')); ?> :</span>
                                    <strong><?php echo e(str_replace('_', ' ', $order['payment_method'])); ?></strong>
                                </h6>
                                <h6>
                                    <?php if($order['transaction_reference'] == null): ?>
                                        <span><?php echo e(__('messages.reference')); ?> <?php echo e(__('messages.code')); ?> :</span>
                                        <?php if(isset($order->restaurant)): ?>
                                            <button class="btn btn-outline-primary btn--primary btn-sm add--referal" data-toggle="modal"
                                                data-target=".bd-example-modal-sm">
                                                <?php echo e(__('messages.add')); ?>

                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span><?php echo e(__('messages.reference')); ?> <?php echo e(__('messages.code')); ?> :</span>
                                        <strong><?php echo e($order['transaction_reference']); ?></strong>
                                    <?php endif; ?>
                                </h6>
                                <h6>
                                    <span><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.type')); ?> :</span>
                                    <strong><?php echo e(str_replace('_', ' ', $order['order_type'])); ?></strong>
                                </h6>
                                <?php if($order->coupon): ?>
                                    <h6>
                                        <span><?php echo e(__('messages.coupon')); ?></span>
                                        <label class="text-info"><?php echo e($order->coupon_code); ?>

                                            (<?php echo e(__('messages.' . $order->coupon->coupon_type)); ?>)</label>
                                    </h6>
                                <?php endif; ?>

                                <h6>
                                    <span><?php echo e(__('messages.payment')); ?> <?php echo e(__('messages.status')); ?> :</span>
                                    <?php if($order['payment_status'] == 'paid'): ?>
                                        <strong class="text-success"><?php echo e(__('messages.paid')); ?></strong>
                                    <?php else: ?>
                                        <strong class="text-danger"><?php echo e(__('messages.unpaid')); ?></strong>
                                    <?php endif; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- food cart -->
                        <?php if($editing && !$campaign_order): ?>
                            <div class="mx-3 border-top">
                                <div class="my-3">
                                    <div class="search--button-wrapper">
                                        <div class="card-title"></div>
                                        <form id="search-form" class="search-form header-item min-240px">
                                            <!-- Search -->
                                            <div class="input--group input-group input-group-merge input-group-flush">
                                                <input id="datatableSearch" type="search"
                                                    value="<?php echo e($keyword ? $keyword : ''); ?>" name="search"
                                                    class="form-control" placeholder="Ex : Search Products" aria-label="Search here">
                                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                            </div>
                                            <!-- End Search -->
                                        </form>
                                        <div>
                                            <div class="input-group header-item">
                                                <select name="category" id="category" class="form-control js-select2-custom mx-1"
                                                    title="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.category')); ?>"
                                                    onchange="set_category_filter(this.value)">
                                                    <option value=""><?php echo e(__('messages.all')); ?> <?php echo e(__('messages.categories')); ?>

                                                    </option>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"
                                                            <?php echo e($category == $item->id ? 'selected' : ''); ?>><?php echo e($item->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row g-3" id="items">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="order--item-box item-box col-auto">
                                            <?php echo $__env->make('admin-views.order.partials._single_product', [
                                                'product' => $product,
                                                'restaurant_data' => $order->restaurant,
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <br>
                                <?php echo $products->withQueryString()->links(); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body px-0">
                        <?php
                        $coupon = null;
                        $total_addon_price = 0;
                        $product_price = 0;
                        $restaurant_discount_amount = 0;
                        $del_c = $order['delivery_charge'];
                        if ($editing) {
                            $del_c = $order['original_delivery_charge'];
                        }
                        if ($order->coupon_code) {
                            $coupon = \App\Models\Coupon::where(['code' => $order['coupon_code']])->first();
                            if ($editing && $coupon->coupon_type == 'free_delivery') {
                                $del_c = 0;
                                $coupon = null;
                            }
                        }
                        $details = $order->details;
                        if ($editing) {
                            $details = session('order_cart');
                        } else {
                            foreach ($details as $key => $item) {
                                $details[$key]->status = true;
                            }
                        }
                        ?>
                    <div class="table-responsive">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer mb-0">
                            <thead class="thead-light">
                                <th><?php echo e(translate('sl')); ?></th>
                                <th><?php echo e(translate('item_details')); ?></th>
                                <th><?php echo e(translate('addons')); ?></th>
                                <th class="text-right"><?php echo e(translate('price')); ?></th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($detail->food_id) && $detail->status): ?>
                                    <?php
                                    if (!$editing) {
                                        $detail->food = json_decode($detail->food_details, true);
                                    }
                                    ?>
                                    <!-- Media -->
                                    <tr>
                                        <td>
                                            <!-- Static Count Number -->
                                            <div>
                                                <?php echo e($key+1); ?>

                                            </div>
                                            <!-- Static Count Number -->
                                        </td>
                                        <td>
                                            <div class="media media--sm">
                                                <?php if($editing): ?>
                                                    <div class="avatar avatar-xl mr-3 cursor-pointer"
                                                        onclick="quick_view_cart_item(<?php echo e($key); ?>)"
                                                        title="<?php echo e(__('messages.click_to_edit_this_item')); ?>">
                                                        <span class="avatar-status avatar-lg-status avatar-status-dark"><i
                                                                class="tio-edit"></i></span>
                                                        <img class="img-fluid rounded"
                                                            src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($detail->food['image']); ?>"
                                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                            alt="Image Description">
                                                    </div>
                                                <?php else: ?>
                                                    <a class="avatar avatar-xl mr-3"
                                                        href="<?php echo e(route('admin.food.view', $detail->food['id'])); ?>">
                                                        <img class="img-fluid rounded"
                                                            src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($detail->food['image']); ?>"
                                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                            alt="Image Description">
                                                    </a>
                                                <?php endif; ?>
                                                <div class="media-body">
                                                    <div>
                                                        <strong class="line--limit-1"> <?php echo e($detail->food['name']); ?></strong>

                                                        <?php if(count(json_decode($detail['variation'], true)) > 0): ?>

                                                            <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="font-size-sm text-body text-capitalize">
                                                                    <span><?php echo e($key1); ?> : </span>
                                                                    <span
                                                                        class="font-weight-bold"><?php echo e(Str::limit($variation, 15, '...')); ?></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        <h6>
                                                            <?php echo e(translate('qty')); ?> : <?php echo e($detail['quantity']); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php $__currentLoopData = json_decode($detail['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="font-size-sm text-body">
                                                        <span><?php echo e(Str::limit($addon['name'], 20, '...')); ?> : </span>
                                                        <span class="font-weight-bold">
                                                            <?php echo e($addon['quantity']); ?> x
                                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                                        </span>

                                                    </div>
                                                    <?php ($total_addon_price += $addon['price'] * $addon['quantity']); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div>
                                                <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                                <h5><?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?></h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php ($product_price += $amount); ?>
                                    <?php ($restaurant_discount_amount += $detail['discount_on_food'] * $detail['quantity']); ?>
                                    <!-- End Media -->
                                <?php elseif(isset($detail->item_campaign_id) && $detail->status): ?>
                                    <?php
                                    if (!$editing) {
                                        $detail->campaign = json_decode($detail->food_details, true);
                                    }
                                    ?>
                                    <!-- Media -->

                                    <tr>
                                        <td>
                                            <!-- Static Count Number -->
                                            <div>
                                                <?php echo e($key+1); ?>

                                            </div>
                                            <!-- Static Count Number -->
                                        </td>
                                        <td>
                                            <div class="media media--sm">
                                                <?php if($editing): ?>
                                                    <div class="avatar avatar-xl mr-3  cursor-pointer"
                                                        onclick="quick_view_cart_item(<?php echo e($key); ?>)"
                                                        title="<?php echo e(__('messages.click_to_edit_this_item')); ?>">
                                                        <span class="avatar-status avatar-lg-status avatar-status-dark"><i
                                                                class="tio-edit"></i></span>
                                                        <img class="img-fluid"
                                                            src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($detail->campaign['image']); ?>"
                                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                            alt="Image Description">
                                                    </div>
                                                <?php else: ?>
                                                    <a class="avatar avatar-xl mr-3"
                                                        href="<?php echo e(route('admin.campaign.view', ['item', $detail->campaign['id']])); ?>">
                                                        <img class="img-fluid"
                                                            src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($detail->campaign['image']); ?>"
                                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/food-default-image.png')); ?>'"
                                                            alt="Image Description">
                                                    </a>
                                                <?php endif; ?>


                                                <div class="media-body">
                                                    <div>
                                                        <strong class="line--limit-1">
                                                            <?php echo e($detail->campaign['name']); ?>

                                                        </strong>

                                                        <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                                                            <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="font-size-sm text-body text-capitalize">
                                                                    <span><?php echo e($key1); ?> : </span>
                                                                    <span
                                                                        class="font-weight-bold"><?php echo e(Str::limit($variation, 20, '...')); ?></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        <h6>
                                                            <?php echo e($detail['quantity']); ?> x <?php echo e(\App\CentralLogics\Helpers::format_currency($detail['price'])); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php $__currentLoopData = json_decode($detail['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key2 == 0): ?>
                                                        <strong><u><?php echo e(__('messages.addons')); ?> : </u></strong>
                                                    <?php endif; ?>
                                                    <div class="font-size-sm text-body">
                                                        <span class="font-weight-bold">
                                                            <?php echo e($addon['quantity']); ?> x
                                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                                        </span>
                                                        <span><?php echo e(Str::limit($addon['name'], 20, '...')); ?> : </span>
                                                    </div>
                                                    <?php ($total_addon_price += $addon['price'] * $addon['quantity']); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                                <h5><?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?></h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php ($product_price += $amount); ?>
                                    <?php ($restaurant_discount_amount += $detail['discount_on_food'] * $detail['quantity']); ?>
                                    <!-- End Media -->
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        </div>
                        <hr class="mt-0">

                        <?php
                        $coupon_discount_amount = $order['coupon_discount_amount'];

                        $total_price = $product_price + $total_addon_price - $restaurant_discount_amount - $coupon_discount_amount;

                        $total_tax_amount = $order['total_tax_amount'];
                        $deliverman_tips = $order['dm_tips'];

                        if ($editing) {
                            $restaurant_discount = \App\CentralLogics\Helpers::get_restaurant_discount($order->restaurant);
                            if (isset($restaurant_discount)) {
                                if ($product_price + $total_addon_price < $restaurant_discount['min_purchase']) {
                                    $restaurant_discount_amount = 0;
                                }

                                if ($restaurant_discount_amount > $restaurant_discount['max_discount']) {
                                    $restaurant_discount_amount = $restaurant_discount['max_discount'];
                                }
                            }
                            $coupon_discount_amount = $coupon ? \App\CentralLogics\CouponLogic::get_discount($coupon, $product_price + $total_addon_price - $restaurant_discount_amount) : $order['coupon_discount_amount'];
                            $tax = $order->restaurant->tax;

                            $total_price = $product_price + $total_addon_price - $restaurant_discount_amount - $coupon_discount_amount;

                            $total_tax_amount = $tax > 0 ? ($total_price * $tax) / 100 : 0;

                            $total_tax_amount = round($total_tax_amount, 2);

                            $restaurant_discount_amount = round($restaurant_discount_amount, 2);

                            if ($order->restaurant->free_delivery) {
                                $del_c = 0;
                            }

                            $free_delivery_over = \App\Models\BusinessSetting::where('key', 'free_delivery_over')->first()->value;
                            if (isset($free_delivery_over)) {
                                if ($free_delivery_over <= $product_price + $total_addon_price - $coupon_discount_amount - $restaurant_discount_amount) {
                                    $del_c = 0;
                                }
                            }
                        } else {
                            $restaurant_discount_amount = $order['restaurant_discount_amount'];
                        }

                        ?>

                        <div class="row justify-content-end mb-3 px-4">
                            <div class="col-md-9 col-lg-8 initial-39-3">
                                <dl class="row text-sm-right">
                                    <dt class="col-6 text-capitalize"><?php echo e(__('messages.items')); ?>

                                        <?php echo e(__('messages.price')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price)); ?></dd>
                                    <dt class="col-6"><?php echo e(__('messages.addon')); ?>

                                        <?php echo e(__('messages.cost')); ?>:
                                    </dt>
                                    <dd class="col-6 text-right">
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($total_addon_price)); ?>

                                        <hr>
                                    </dd>

                                    <dt class="col-6"><?php echo e(__('messages.subtotal')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price + $total_addon_price)); ?>

                                    </dd>
                                    <dt class="col-6"><?php echo e(__('messages.discount')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        - <?php echo e(\App\CentralLogics\Helpers::format_currency($restaurant_discount_amount)); ?>

                                    </dd>
                                    <dt class="col-6"><?php echo e(__('messages.coupon')); ?>

                                        <?php echo e(__('messages.discount')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        - <?php echo e(\App\CentralLogics\Helpers::format_currency($coupon_discount_amount)); ?>

                                    </dd>
                                    <dt class="col-6"><?php echo e(__('messages.vat/tax')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        + <?php echo e(\App\CentralLogics\Helpers::format_currency($total_tax_amount)); ?></dd>
                                    <dt class="col-6"><?php echo e(translate('DM Tips')); ?></dt>
                                    <dd class="col-6 text-right">
                                        + <?php echo e(\App\CentralLogics\Helpers::format_currency($deliverman_tips)); ?></dd>
                                    <dt class="col-6"><?php echo e(translate('Delivery Fee')); ?></dt>
                                    <dd class="col-6 text-right">
                                        + <?php echo e(\App\CentralLogics\Helpers::format_currency($del_c)); ?></dd>
                                    <dt class="col-6"><?php echo e(__('messages.total')); ?>:</dt>
                                    <dd class="col-6 text-right">
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price + $del_c + $total_tax_amount + $total_addon_price + $deliverman_tips - $coupon_discount_amount - $restaurant_discount_amount)); ?>

                                    </dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                            <?php if($editing): ?>
                            <div class="col-12 mt-3">
                                <div class="btn--container justify-content-end">
                                    <button class="btn btn-sm btn--danger" type="button"
                                        onclick="cancle_editing_order()"><?php echo e(__('messages.cancel')); ?></button>
                                    <button class="btn btn-sm btn--primary" type="button"
                                        onclick="update_order()"><?php echo e(__('messages.submit')); ?></button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4 order-print-area-right">
                <div class="row g-1">

                        <div class="col-12">
                            <!-- Card -->
                            <div class="card">
                                <!-- Header -->
                                <div class="card-header border-0 justify-content-center pt-4 pb-0">
                                    <h4 class="card-header-title"><?php echo e(translate('order_setup')); ?></h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->

                                <div class="card-body">
                                    <!-- Static -->
                                    <label class="form-label"><?php echo e(translate('change_order_status')); ?></label>

                                    <!-- Unfold -->
                                    <?php if($order->order_status != 'refunded'): ?>
                                        <div>
                                            <div class="dropdown">
                                                <?php if(isset($order->restaurant)): ?>
                                                    <button class="form-control h--45px dropdown-toggle d-flex justify-content-between align-items-center" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <?php echo e(__('messages.status')); ?>

                                                    </button>
                                                <?php endif; ?>
                                                <?php ($order_delivery_verification = (bool) \App\Models\BusinessSetting::where(['key' => 'order_delivery_verification'])->first()->value); ?>
                                                <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'pending' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'pending'])); ?>','Change status to pending ?')"
                                                        href="javascript:"><?php echo e(__('messages.pending')); ?></a>
                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'confirmed' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'confirmed'])); ?>','Change status to confirmed ?')"
                                                        href="javascript:"><?php echo e(__('messages.confirmed')); ?></a>

                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'processing' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'processing'])); ?>', 'Change status to processing ?','Are you sure?', '<?php echo e($max_processing_time); ?>')"
                                                        href="javascript:">
                                                        <?php echo e(__('messages.processing')); ?></a>

                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'handover' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'handover'])); ?>','Change status to handover ?')"
                                                        href="javascript:"><?php echo e(__('messages.handover')); ?></a>
                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'picked_up' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'picked_up'])); ?>','Change status to out for delivery ?')"
                                                        href="javascript:"><?php echo e(__('messages.out_for_delivery')); ?></a>
                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'delivered' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'delivered'])); ?>','Change status to delivered (payment status will be paid if not)?')"
                                                        href="javascript:"><?php echo e(__('messages.delivered')); ?></a>
                                                    <a class="dropdown-item <?php echo e($order['order_status'] == 'canceled' ? 'active' : ''); ?>"
                                                        onclick="route_alert('<?php echo e(route('admin.order.status', ['id' => $order['id'], 'order_status' => 'canceled'])); ?>','Change status to canceled ?')"
                                                        href="javascript:"><?php echo e(__('messages.canceled')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- End Unfold -->
                                    <!-- Static -->
                                    <?php if(isset($order->restaurant) && $order['order_type'] != 'take_away' && !$order->restaurant->self_delivery_system): ?>
                                    <?php if(!$order->delivery_man): ?>
                                        <div class="w-100 text-center mt-4">
                                            <button type="button" class="btn w-100 btn--primary font-regular" data-toggle="modal"
                                                data-target="#myModal" data-lat='21.03' data-lng='105.85'>
                                                <i class="tio-bike"></i> <?php echo e(__('messages.assign_delivery_mam_manually')); ?>

                                            </button>
                                        </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- End Body -->
                            </div>
                            <!-- End Card -->
                        </div>
                        <?php if($order->delivery_man && $order->delivery_man->type == 'zone_wise'): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body pt-2">
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">
                                                <span class="card-header-icon">
                                                    <i class="tio-user"></i>
                                                </span>
                                                <span>
                                                    <?php echo e(translate('deliveryman')); ?>

                                                </span>
                                            </h5>
                                            <?php if($order->delivery_man && !isset($order->delivered) && !$order->restaurant->self_delivery_system): ?>
                                                <span class="ml-auto text--primary position-relative p-2 cursor-pointer" data-toggle="modal" data-target="#myModal">
                                                    <?php echo e(__('messages.change')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="w-100 text-right initial-39-4">
                                        </div>
                                        <a class="media align-items-center  deco-none customer--information-single"
                                            href="<?php echo e(route('admin.delivery-man.preview', [$order->delivery_man['id']])); ?>">
                                            <div class="avatar avatar-circle">
                                                <img class="avatar-img w-75px" onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img3.png')); ?>'"
                                                    src="<?php echo e(asset('storage/app/public/delivery-man/' . $order->delivery_man->image)); ?>"
                                                    alt="Image Description">
                                            </div>
                                            <div class="media-body">
                                                <strong class="d-block text--title">
                                                    <?php echo e($order->delivery_man['f_name'] . ' ' . $order->delivery_man['l_name']); ?>

                                                </strong>
                                                <span>
                                                    <strong class="text--title font-semibold">
                                                        <?php echo e($order->delivery_man->orders_count); ?>

                                                    </strong>
                                                    <?php echo e(__('messages.orders_delivered')); ?>

                                                </span>
                                                <span class="text--title font-semibold d-block">
                                                    <i class="tio-call-talking-quiet"></i> <?php echo e($order->delivery_man['phone']); ?>

                                                </span>
                                                <span class="text--title text-lowercase">
                                                    <i class="tio-email"></i> <?php echo e($order->delivery_man['email']); ?>

                                                </span>
                                            </div>
                                        </a>
                                        <hr>
                                        <?php ($address = $order->dm_last_location); ?>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5><?php echo e(__('messages.last')); ?> <?php echo e(__('messages.location')); ?></h5>
                                        </div>
                                        <?php if(isset($address)): ?>
                                            <span class="d-block">
                                                <a target="_blank"
                                                    href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>">
                                                    <i class="tio-poi"></i> <?php echo e($address['location']); ?><br>
                                                </a>
                                            </span>
                                        <?php else: ?>
                                            <span class="d-block text-lowercase qcont">
                                                <?php echo e(__('messages.location') . ' ' . __('messages.not_found')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <div class="col-12">
                        <!-- Customer Card -->
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Header -->
                                <h5 class="card-title mb-3">
                                    <span class="card-header-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                    <span><?php echo e(__('messages.customer')); ?> <?php echo e(__('messages.info')); ?></span>
                                </h5>
                                <!-- End Header -->
                                    <?php if($order->customer): ?>
                                        <a class="media align-items-center deco-none customer--information-single"
                                            href="<?php echo e(route('admin.customer.view', [$order->customer['id']])); ?>">
                                            <div class="avatar avatar-circle">
                                                <img class="avatar-img"
                                                    onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.png')); ?>'"
                                                    src="<?php echo e(asset('storage/app/public/profile/' . $order->customer->image)); ?>"
                                                    alt="Image Description">

                                            </div>
                                            <div class="media-body">
                                                <span
                                                    class="fz--14px text--title font-semibold text-hover-primary d-block">
                                                    <?php echo e($order->customer['f_name'] . ' ' . $order->customer['l_name']); ?>

                                                </span>
                                                <span>
                                                    <strong class="text--title font-semibold"><?php echo e($order->customer->orders_count); ?></strong>
                                                    <?php echo e(__('messages.orders')); ?>

                                                </span>
                                                <span class="text--title font-semibold d-block">
                                                    <i class="tio-call-talking-quiet"></i> <?php echo e($order->customer['phone']); ?>

                                                </span>
                                                <span class="text--title">
                                                    <i class="tio-email"></i> <?php echo e($order->customer['email']); ?>

                                                </span>
                                            </div>

                                        </a>
                                    <?php else: ?>
                                        <?php echo e(translate('messages.customer_not_found')); ?>

                                    <?php endif; ?>
                                    <?php if($order->delivery_address): ?>
                                    <div class="pt-2"></div>
                                        <hr>
                                        <?php ($address = json_decode($order->delivery_address, true)); ?>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">
                                                <span class="card-header-icon">
                                                    <i class="tio-user"></i>
                                                </span>
                                                <span><?php echo e(translate('delivery')); ?> <?php echo e(__('messages.info')); ?></span>
                                            </h5>
                                            <?php if(isset($address) && isset($order->restaurant)): ?>
                                                <a class="link" data-toggle="modal" data-target="#shipping-address-modal" href="javascript:"><i class="tio-edit"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(isset($address)): ?>
                                            <span class="delivery--information-single mt-3">
                                                <span class="name"><?php echo e(translate('name')); ?></span>
                                                <span class="info"><?php echo e($address['contact_person_name']); ?></span>
                                                <span class="name"><?php echo e(translate('contact')); ?></span>
                                                <a class="deco-none info" href="tel:<?php echo e($address['contact_person_number']); ?>">
                                                    <i class="tio-call-talking-quiet"></i>
                                                    <?php echo e($address['contact_person_number']); ?></a>

                                                <span class="name"><?php echo e(translate('Road')); ?> #</span>
                                                <span class="info"><?php echo e(isset($address['road']) ? $address['road'] : ''); ?></span>
                                                <span class="name"><?php echo e(translate('House')); ?> #</span>
                                                <span class="info">
                                                    <?php echo e(isset($address['house']) ? $address['house'] : ''); ?>

                                                </span>
                                                <span class="name"><?php echo e(translate('Floor')); ?></span>
                                                <span class="info"><?php echo e(isset($address['floor']) ? $address['floor'] : ''); ?></span>

                                                <?php if(isset($address['address'])): ?>
                                                    <?php if(empty($address['longitude']) && empty($address['latitude']) && isset($address['latitude']) && isset($address['longitude'])): ?>
                                                        <div class="mt-2 d-flex w-100">
                                                            <a target="_blank"
                                                                href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>">
                                                                <span><i class="tio-poi text--title"></i></span>
                                                                <span class="info pl-2"><?php echo e($address['address']); ?></span>
                                                            </a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="mt-2 d-flex w-100">
                                                            <span><i class="tio-poi text--title"></i></span>
                                                            <span class="info pl-2"><?php echo e($address['address']); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <!-- End Body -->
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- End Card -->
                        <?php if($order->restaurant): ?>
                            <!-- Restaurant Card -->
                            <div class="card">
                                <!-- Body -->
                                <div class="card-body">
                                    <!-- Header -->
                                    <h5 class="card-title mb-3">
                                        <span class="card-header-icon">
                                            <i class="tio-shop"></i>
                                        </span>
                                        <span><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.info')); ?></span>
                                    </h5>
                                    <!-- End Header -->
                                    <a class="media align-items-center deco-none resturant--information-single"
                                        href="<?php echo e(route('admin.vendor.view', [$order->restaurant['id']])); ?>">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img w-75px"
                                                onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/restaurant-default-image.png')); ?>'"
                                                src="<?php echo e(asset('storage/app/public/restaurant/' . $order->restaurant->logo)); ?>"
                                                alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            <span class="text-body text-hover-primary text-break"></span>
                                            <span></span>


                                            <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                                <?php echo e($order->restaurant->name); ?>

                                            </span>
                                            <span>
                                                <strong class="text--title font-semibold">
                                                    <?php echo e($order->restaurant->orders_count); ?>

                                                </strong>
                                                <?php echo e(__('messages.orders_served')); ?>

                                            </span>
                                            <span class="text--title font-semibold d-block">
                                                <i class="tio-call-talking-quiet"></i> <?php echo e($order->restaurant['phone']); ?>

                                            </span>
                                            <span class="text--title">
                                                <i class="tio-poi"></i> <?php echo e($order->restaurant['address']); ?>

                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <!-- End Body -->
                            </div>
                        <?php endif; ?>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="mySmallModalLabel"><?php echo e(__('messages.reference')); ?>

                        <?php echo e(__('messages.code')); ?> <?php echo e(__('messages.add')); ?></h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>

                <form action="<?php echo e(route('admin.order.add-payment-ref-code', [$order['id']])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <!-- Input Group -->
                        <div class="form-group">
                            <input type="text" name="transaction_reference" class="form-control"
                                placeholder="EX : Code123" required>
                        </div>
                        <!-- End Input Group -->
                        <button class="btn btn-primary"><?php echo e(__('messages.submit')); ?></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal -->
    <div id="shipping-address-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-top-cover bg-dark text-center">
                    <figure class="position-absolute right-0 bottom-0 left-0 mb-n-1">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="0 0 1920 100.1">
                            <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z" />
                        </svg>
                    </figure>

                    <div class="modal-close">
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal"
                            aria-label="Close">
                            <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- End Header -->

                <div class="modal-top-cover-icon">
                    <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                        <i class="tio-location-search"></i>
                    </span>
                </div>

                <?php if(isset($address)): ?>
                    <form action="<?php echo e(route('admin.order.update-shipping', [$order['id']])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.type')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="address_type"
                                        value="<?php echo e($address['address_type']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.contact')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="contact_person_number"
                                        value="<?php echo e($address['contact_person_number']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.name')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="<?php echo e($address['contact_person_name']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('House')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="house"
                                        value="<?php echo e(isset($address['house']) ? $address['house'] : ''); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('Floor')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="floor"
                                        value="<?php echo e(isset($address['floor']) ? $address['floor'] : ''); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('Road')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="road"
                                        value="<?php echo e(isset($address['road']) ? $address['road'] : ''); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('address')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control" name="address"
                                        value="<?php echo e($address['address']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(translate('latitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="latitude"
                                        value="<?php echo e($address['latitude']); ?>">
                                </div>
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.longitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control" name="longitude"
                                        value="<?php echo e($address['longitude']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white"
                                data-dismiss="modal"><?php echo e(__('messages.close')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('messages.save')); ?>

                                <?php echo e(__('messages.changes')); ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Dm assign Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo e(__('messages.assign')); ?>

                        <?php echo e(__('messages.deliveryman')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 my-2">
                            <ul class="list-group overflow-auto max-height-400">
                                <?php $__currentLoopData = $deliveryMen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <span class="dm_list" role='button' data-id="<?php echo e($dm['id']); ?>">
                                            <img class="avatar avatar-sm avatar-circle mr-1"
                                                onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>'"
                                                src="<?php echo e(asset('storage/app/public/delivery-man')); ?>/<?php echo e($dm['image']); ?>"
                                                alt="<?php echo e($dm['name']); ?>">
                                            <?php echo e($dm['name']); ?>

                                        </span>

                                        <a class="btn btn-primary btn-xs float-right"
                                            onclick="addDeliveryMan(<?php echo e($dm['id']); ?>)"><?php echo e(__('messages.assign')); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="col-md-7 modal_body_map">
                            <div class="location-map" id="dmassign-map">
                                <div id="map_canvas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Show locations on map Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="locationModalLabel"><?php echo e(__('messages.location')); ?>

                        <?php echo e(__('messages.data')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="location-map" id="location-map">
                                <div id="location_map_canvas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <div class="modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-view-modal">

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var keyword = $('#datatableSearch').val();
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('keyword', keyword);
            location.href = nurl;
        });

        function set_category_filter(id) {
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('category_id', id);
            location.href = nurl;
        }

        function addon_quantity_input_toggle(e) {
            var cb = $(e.target);
            if (cb.is(":checked")) {
                cb.siblings('.addon-quantity-input').css({
                    'visibility': 'visible'
                });
            } else {
                cb.siblings('.addon-quantity-input').css({
                    'visibility': 'hidden'
                });
            }
        }

        function quick_view_cart_item(key) {
            $.get({
                url: '<?php echo e(route('admin.order.quick-view-cart-item')); ?>',
                dataType: 'json',
                data: {
                    key: key,
                    order_id: '<?php echo e($order->id); ?>',
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function quickView(product_id) {
            $.get({
                url: '<?php echo e(route('admin.order.quick-view')); ?>',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    order_id: '<?php echo e($order->id); ?>',
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    console.log("success...")
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                var name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: 'Sorry, the minimum value was reached'
                    });
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: 'Sorry, stock limit exceeded.'
                    });
                    $(this).val($(this).data('oldValue'));
                }
            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function getVariantPrice() {
            if ($('#add-to-cart-form input[name=quantity]').val() > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('admin.food.variant-price')); ?>',
                    data: $('#add-to-cart-form').serializeArray(),
                    success: function(data) {
                        $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                        $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                    }
                });
            }
        }

        function update_order_item(form_id = 'add-to-cart-form') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.order.add-to-cart')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    if (data.data == 1) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            text: "<?php echo e(__('messages.product_already_added_in_cart')); ?>"
                        });
                        return false;
                    } else if (data.data == 0) {
                        toastr.success('<?php echo e(__('messages.product_has_been_added_in_cart')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        location.reload();
                        return false;
                    }
                    $('.call-when-done').click();

                    toastr.success('<?php echo e(__('messages.order_updated_successfully')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    location.reload();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }

        function removeFromCart(key) {
            Swal.fire({
                title: '<?php echo e(__('messages.are_you_sure')); ?>',
                text: '<?php echo e(__('messages.you_want_to_remove_this_order_item')); ?>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(__('messages.no')); ?>',
                confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.post('<?php echo e(route('admin.order.remove-from-cart')); ?>', {
                        _token: '<?php echo e(csrf_token()); ?>',
                        key: key,
                        order_id: '<?php echo e($order->id); ?>'
                    }, function(data) {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            toastr.success('<?php echo e(__('messages.item_has_been_removed_from_cart')); ?>', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            location.reload();
                        }

                    });
                }
            })

        }
        <?php if($order->restaurant): ?>
            function edit_order() {
                Swal.fire({
                    title: '<?php echo e(__('messages.are_you_sure')); ?>',
                    text: '<?php echo e(__('messages.you_want_to_edit_this_order')); ?>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: '<?php echo e(__('messages.no')); ?>',
                    confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        location.href = '<?php echo e(route('admin.order.edit', $order->id)); ?>';
                    }
                })
            }
        <?php endif; ?>

        function cancle_editing_order() {
            Swal.fire({
                title: '<?php echo e(__('messages.are_you_sure')); ?>',
                text: '<?php echo e(__('messages.you_want_to_cancel_editing')); ?>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(__('messages.no')); ?>',
                confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = '<?php echo e(route('admin.order.edit', $order->id)); ?>?cancle=true';
                }
            })
        }

        function update_order() {
            Swal.fire({
                title: '<?php echo e(__('messages.are_you_sure')); ?>',
                text: '<?php echo e(__('messages.you_want_to_submit_all_changes_for_this_order')); ?>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(__('messages.no')); ?>',
                confirmButtonText: '<?php echo e(__('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = '<?php echo e(route('admin.order.update', $order->id)); ?>';
                }
            })
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&v=3.45.8">
    </script>
    <script>
        function addDeliveryMan(id) {
            $.ajax({
                type: "GET",
                url: '<?php echo e(url('/')); ?>/admin/order/add-delivery-man/<?php echo e($order['id']); ?>/' + id,
                success: function(data) {
                    location.reload();
                    console.log(data)
                    toastr.success('Successfully added', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                error: function(response) {
                    console.log(response);
                    toastr.error(response.responseJSON.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        }

        function last_location_view() {
            toastr.warning('Only available when order is out for delivery!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
    <script>
        var deliveryMan = <?php echo json_encode($deliveryMen); ?>;
        var map = null;

        var myLatlng = new google.maps.LatLng(<?php echo e(isset($order->restaurant) ? $order->restaurant->latitude : 0); ?>,
            <?php echo e(isset($order->restaurant) ? $order->restaurant->longitude : 0); ?>);
        var dmbounds = new google.maps.LatLngBounds(null);
        var locationbounds = new google.maps.LatLngBounds(null);
        var dmMarkers = [];
        dmbounds.extend(myLatlng);
        locationbounds.extend(myLatlng);
        var myOptions = {
            center: myLatlng,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,

            panControl: true,
            mapTypeControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        };

        function initializeGMap() {

            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            var infowindow = new google.maps.InfoWindow();

            <?php if($order->restaurant): ?>
                var Restaurantmarker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        <?php echo e(isset($order->restaurant) ? $order->restaurant->latitude : 0); ?>,
                        <?php echo e(isset($order->restaurant) ? $order->restaurant->longitude : 0); ?>),
                    map: map,
                    title: "<?php echo e(isset($order->restaurant) ? Str::limit($order->restaurant->name, 15, '...') : ''); ?>",
                    icon: "<?php echo e(asset('public/assets/admin/img/restaurant_map.png')); ?>"
                });

                google.maps.event.addListener(Restaurantmarker, 'click', (function(Restaurantmarker) {
                    return function() {
                        infowindow.setContent(
                            "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/restaurant/' . $order->restaurant->logo)); ?>'></div><div class='text-break' style='float:right; padding: 10px;'><b><?php echo e(Str::limit($order->restaurant->name, 15, '...')); ?></b><br/> <?php echo e($order->restaurant->address); ?></div>"
                        );
                        infowindow.open(map, Restaurantmarker);
                    }
                })(Restaurantmarker));
            <?php endif; ?>
            map.fitBounds(dmbounds);
            for (var i = 0; i < deliveryMan.length; i++) {
                if (deliveryMan[i].lat) {
                    // var contentString = "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/delivery-man')); ?>/"+deliveryMan[i].image+"'></div><div style='float:right; padding: 10px;'><b>"+deliveryMan[i].name+"</b><br/> "+deliveryMan[i].location+"</div>";
                    var point = new google.maps.LatLng(deliveryMan[i].lat, deliveryMan[i].lng);
                    dmbounds.extend(point);
                    map.fitBounds(dmbounds);
                    var marker = new google.maps.Marker({
                        position: point,
                        map: map,
                        title: deliveryMan[i].location,
                        icon: "<?php echo e(asset('public/assets/admin/img/delivery_boy_map.png')); ?>"
                    });
                    dmMarkers[deliveryMan[i].id] = marker;
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(
                                "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/delivery-man')); ?>/" +
                                deliveryMan[i].image +
                                "'></div><div style='float:right; padding: 10px;'><b>" + deliveryMan[i]
                                .name + "</b><br/> " + deliveryMan[i].location + "</div>");
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }

            };
        }
        $(document).ready(function() {

            // Re-init map before show modal
            $('#myModal').on('shown.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $("#dmassign-map").css("width", "100%");
                $("#map_canvas").css("width", "100%");
            });

            // Trigger map resize event after modal shown
            $('#myModal').on('shown.bs.modal', function() {
                initializeGMap();
                google.maps.event.trigger(map, "resize");
                map.setCenter(myLatlng);
            });


            function initializegLocationMap() {
                map = new google.maps.Map(document.getElementById("location_map_canvas"), myOptions);

                var infowindow = new google.maps.InfoWindow();

                <?php if($order->customer && isset($address)): ?>
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo e($address['latitude']); ?>,
                            <?php echo e($address['longitude']); ?>),
                        map: map,
                        title: "<?php echo e($order->customer->f_name); ?> <?php echo e($order->customer->l_name); ?>",
                        icon: "<?php echo e(asset('public/assets/admin/img/customer_location.png')); ?>"
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker) {
                        return function() {
                            infowindow.setContent(
                                "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/profile/' . $order->customer->image)); ?>'></div><div style='float:right; padding: 10px;'><b><?php echo e($order->customer->f_name); ?> <?php echo e($order->customer->l_name); ?></b><br/><?php echo e($address['address']); ?></div>"
                            );
                            infowindow.open(map, marker);
                        }
                    })(marker));
                    locationbounds.extend(marker.getPosition());
                <?php endif; ?>
                <?php if($order->delivery_man && $order->dm_last_location): ?>
                    var dmmarker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo e($order->dm_last_location['latitude']); ?>,
                            <?php echo e($order->dm_last_location['longitude']); ?>),
                        map: map,
                        title: "<?php echo e($order->delivery_man->f_name); ?>  <?php echo e($order->delivery_man->l_name); ?>",
                        icon: "<?php echo e(asset('public/assets/admin/img/delivery_boy_map.png')); ?>"
                    });

                    google.maps.event.addListener(dmmarker, 'click', (function(dmmarker) {
                        return function() {
                            infowindow.setContent(
                                "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/delivery-man/' . $order->delivery_man->image)); ?>'></div><div style='float:right; padding: 10px;'><b><?php echo e($order->delivery_man->f_name); ?>  <?php echo e($order->delivery_man->l_name); ?></b><br/> <?php echo e($order->dm_last_location['location']); ?></div>"
                            );
                            infowindow.open(map, dmmarker);
                        }
                    })(dmmarker));
                    locationbounds.extend(dmmarker.getPosition());
                <?php endif; ?>

                <?php if($order->restaurant): ?>
                    var Retaurantmarker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo e($order->restaurant->latitude); ?>,
                            <?php echo e($order->restaurant->longitude); ?>),
                        map: map,
                        title: "<?php echo e(Str::limit($order->restaurant->name, 15, '...')); ?>",
                        icon: "<?php echo e(asset('public/assets/admin/img/restaurant_map.png')); ?>"
                    });

                    google.maps.event.addListener(Retaurantmarker, 'click', (function(Retaurantmarker) {
                        return function() {
                            infowindow.setContent(
                                "<div style='float:left'><img style='max-height:40px;wide:auto;' src='<?php echo e(asset('storage/app/public/restaurant/' . $order->restaurant->logo)); ?>'></div><div style='float:right; padding: 10px;'><b><?php echo e(Str::limit($order->restaurant->name, 15, '...')); ?></b><br/> <?php echo e($order->restaurant->address); ?></div>"
                            );
                            infowindow.open(map, Retaurantmarker);
                        }
                    })(Retaurantmarker));
                    locationbounds.extend(Retaurantmarker.getPosition());
                <?php endif; ?>

                google.maps.event.addListenerOnce(map, 'idle', function() {
                    map.fitBounds(locationbounds);
                });
            }

            // Re-init map before show modal
            $('#locationModal').on('shown.bs.modal', function(event) {
                initializegLocationMap();
            });


            $('.dm_list').on('click', function() {
                var id = $(this).data('id');
                map.panTo(dmMarkers[id].getPosition());
                map.setZoom(13);
                dmMarkers[id].setAnimation(google.maps.Animation.BOUNCE);
                window.setTimeout(() => {
                    dmMarkers[id].setAnimation(null);
                }, 3);
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/order/order-view.blade.php ENDPATH**/ ?>