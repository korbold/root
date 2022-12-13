<?php
$max_processing_time = explode('-', $order['restaurant']['delivery_time'])[0];
?>


<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
    <?php $campaign_order = $order->details[0]->campaign ? true : false; ?>
    <div class="content container-fluid item-box-page">

    <div class="page-header d-print-none">

            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(asset('public/assets/admin/img/orders.png')); ?>" alt="public">
                </div>
                <span>
                    Order Details
                </span>
                <div class="d-flex ml-auto">
                    <a class="btn btn-icon btn-sm btn-soft-primary rounded-circle mr-1"
                        href="<?php echo e(route('vendor.order.details', [$order['id'] - 1])); ?>" data-toggle="tooltip"
                        data-placement="top" title="Previous order">
                        <i class="tio-chevron-left m-0"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-soft-primary rounded-circle"
                        href="<?php echo e(route('vendor.order.details', [$order['id'] + 1])); ?>" data-toggle="tooltip"
                        data-placement="top" title="Next order">
                        <i class="tio-chevron-right m-0"></i>
                    </a>
                </div>
            </h1>
        </div>


        <div class="row g-1" id="printableArea">
            <div class="col-lg-8 order-print-area-left">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header border-0 align-items-start flex-wrap">
                        <div class="order-invoice-left">
                            <h1 class="page-header-title mt-2">
                                <span>
                                    <?php echo e(__('messages.order')); ?> #<?php echo e($order['id']); ?>

                                </span>

                                
                                <?php if($order->edited): ?>
                                    <span class="badge badge-soft-danger text-capitalize px-2 ml-2">
                                        <?php echo e(__('messages.edited')); ?>

                                    </span>
                                <?php endif; ?>
                                <a class="btn btn--primary m-2 print--btn d-sm-none ml-auto" href="<?php echo e(route('vendor.order.generate-invoice', [$order['id']])); ?>">
                                    <i class="tio-print mr-1"></i>
                                </a>
                            </h1>
                            <span class="mt-2 d-block">
                                <i class="tio-date-range"></i>
                                <?php echo e(date('d M Y ' . config('timeformat'), strtotime($order['created_at']))); ?>

                            </span>
                            <?php if($order->schedule_at && $order->scheduled): ?>
                                <span class="text-capitalize d-block mt-1">
                                    <?php echo e(__('messages.scheduled_at')); ?>

                                    : <label  class="fz-10px badge badge-soft-primary"><?php echo e(date('d M Y ' . config('timeformat'), strtotime($order['schedule_at']))); ?></label>
                                </span>
                            <?php endif; ?>
                            <?php if($campaign_order): ?>
                            <span class="badge mt-2 badge-soft-primary">
                                <?php echo e(__('messages.campaign_order')); ?>

                            </span>
                            <?php endif; ?>
                            <?php if($order['order_note']): ?>
                            <h6>
                                <?php echo e(__('messages.order')); ?> <?php echo e(__('messages.note')); ?> :
                                <?php echo e($order['order_note']); ?>

                            </h6>
                            <?php endif; ?>
                        </div>
                        <div class="order-invoice-right">
                            <div class="d-none d-sm-flex flex-wrap ml-auto align-items-center justify-content-end m-n-5rem">
                                <a class="btn btn--primary m-2 print--btn" href="<?php echo e(route('vendor.order.generate-invoice', [$order['id']])); ?>">
                                    <i class="tio-print mr-1"></i> <?php echo e(__('messages.print')); ?> <?php echo e(__('messages.invoice')); ?>

                                </a>
                            </div>
                            <div class="text-right mt-3 order-invoice-right-contents text-capitalize">
                                <h6>
                                    <span>Status :</span>
                                    <?php if($order['order_status'] == 'pending'): ?>
                                        <span class="badge badge-soft-info ml-2 ml-sm-3">
                                            <?php echo e(__('messages.pending')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'confirmed'): ?>
                                        <span class="badge badge-soft-info ml-2 ml-sm-3">
                                            <?php echo e(__('messages.confirmed')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'processing'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                            <?php echo e(__('messages.cooking')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'picked_up'): ?>
                                        <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                            <?php echo e(__('messages.out_for_delivery')); ?>

                                        </span>
                                    <?php elseif($order['order_status'] == 'delivered'): ?>
                                        <span class="badge badge-soft-success ml-2 ml-sm-3">
                                            <?php echo e(__('messages.delivered')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                            <?php echo e(str_replace('_', ' ', $order['order_status'])); ?>

                                        </span>
                                    <?php endif; ?>
                                </h6>
                                <h6>
                                    <span>
                                    <?php echo e(__('messages.payment')); ?> <?php echo e(__('messages.method')); ?> :</span>
                                    <strong>
                                    <?php echo e(str_replace('_', ' ', $order['payment_method'])); ?></strong>
                                </h6>
                                <h6>
                                    <span>Order Type :</span>
                                    <strong class="text--title"><?php echo e(str_replace('_', ' ', $order['order_type'])); ?></strong>
                                </h6>
                                <h6>
                                    <span>Payment Status :</span>
                                    <?php if($order['payment_status'] == 'paid'): ?>
                                        <strong class="text-success">
                                            <?php echo e(__('messages.paid')); ?>

                                        </strong>
                                    <?php else: ?>
                                        <strong class="text-danger">
                                            <?php echo e(__('messages.unpaid')); ?>

                                        </strong>
                                    <?php endif; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body p-0">
                        <?php
                        $total_addon_price = 0;
                        $product_price = 0;
                        $restaurant_discount_amount = 0;
                        $product_price = 0;
                        $total_addon_price = 0;
                        ?>
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered table-nowrap card-table dataTable no-footer mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(translate('Item Details')); ?></th>
                                        <th><?php echo e(translate('Addons')); ?></th>
                                        <th class="text-right"><?php echo e(translate('Price')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($detail->food_id)): ?>
                                        <?php ($detail->food = json_decode($detail->food_details, true)); ?>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <a class="avatar mr-3 cursor-pointer initial-80"
                                                                href="<?php echo e(route('vendor.food.view', $detail->food['id'])); ?>">
                                                                <img class="img-fluid rounded initial-80" src="<?php echo e(asset('storage/app/public/product')); ?>/<?php echo e($detail->food['image']); ?>" onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/1.png')); ?>'"
                                                                    alt="Image Description">
                                                            </a>
                                                            <div class="media-body">
                                                                <div>
                                                                    <strong> <?php echo e(Str::limit($detail->food['name'], 25, '...')); ?></strong><br>

                                                                    <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                                                                        <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <span class="font-size-sm text-body text-capitalize">
                                                                                <span><?php echo e($key1); ?> : </span>
                                                                                <span
                                                                                    class="font-weight-bold"><?php echo e(Str::limit($variation, 20, '...')); ?></span>
                                                                            </span>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>

                                                                    <div>
                                                                        <strong>Price :</strong>
                                                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($detail['price'])); ?>

                                                                    </div>
                                                                    <div>
                                                                        <strong>Qty :</strong> <?php echo e($detail['quantity']); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php $__currentLoopData = json_decode($detail['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="font-size-sm text-body">
                                                                <span><?php echo e(Str::limit($addon['name'], 25, '...')); ?> : </span>
                                                                <span class="font-weight-bold">
                                                                    <?php echo e($addon['quantity']); ?> x
                                                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                                                </span>
                                                            </div>
                                                            <?php ($total_addon_price += $addon['price'] * $addon['quantity']); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                                            <h5>
                                                                <?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?>

                                                            </h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php ($product_price += $amount); ?>
                                        <?php ($restaurant_discount_amount += $detail['discount_on_food'] * $detail['quantity']); ?>
                                    <?php elseif(isset($detail->item_campaign_id)): ?>
                                        <?php ($detail->campaign = json_decode($detail->food_details, true)); ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="avatar avatar-xl mr-3">
                                                        <img class="img-fluid rounded initial-80"
                                                            src="<?php echo e(asset('storage/app/public/campaign')); ?>/<?php echo e($detail->campaign['image']); ?>"
                                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/1.png')); ?>'"
                                                            alt="Image Description">
                                                    </div>
                                                    <div class="media-body">
                                                        <div>
                                                            <strong>
                                                                <?php echo e(Str::limit($detail->campaign['name'], 25, '...')); ?></strong><br>
                                                            <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                                                                <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="font-size-sm text-body">
                                                                        <span><?php echo e($key1); ?> : </span>
                                                                        <span
                                                                            class="font-weight-bold"><?php echo e(Str::limit($variation, 25, '...')); ?></span>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            <div>
                                                                <strong>Price : </strong>
                                                                <span><?php echo e(\App\CentralLogics\Helpers::format_currency($detail['price'])); ?></span>
                                                            </div>
                                                            <div>
                                                                <strong>Qty : </strong>
                                                                <span>
                                                                    <?php echo e($detail['quantity']); ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
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
                                            </td>
                                            <td>
                                                <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                                <h5 class="text-right"><?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?></h5>
                                            </td>
                                        </tr>
                                        <?php ($product_price += $amount); ?>
                                        <?php ($restaurant_discount_amount += $detail['discount_on_food'] * $detail['quantity']); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php

                        $coupon_discount_amount = $order['coupon_discount_amount'];

                        $total_price = $product_price + $total_addon_price - $restaurant_discount_amount - $coupon_discount_amount;

                        $total_tax_amount = $order['total_tax_amount'];

                        $restaurant_discount_amount = $order['restaurant_discount_amount'];

                        ?>
                        <div class="px-4">
                            <div class="row justify-content-md-end mb-3">
                                <div class="col-md-9 col-lg-8">
                                    <dl class="row text-sm-right">
                                        <dt class="col-sm-6"><?php echo e(__('messages.items')); ?> <?php echo e(__('messages.price')); ?>:
                                        </dt>
                                        <dd class="col-sm-6">
                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price)); ?></dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.addon')); ?> <?php echo e(__('messages.cost')); ?>:
                                        </dt>
                                        <dd class="col-sm-6">
                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($total_addon_price)); ?>

                                            <hr>
                                        </dd>

                                        <dt class="col-sm-6"><?php echo e(__('messages.subtotal')); ?>:</dt>
                                        <dd class="col-sm-6">
                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price + $total_addon_price)); ?>

                                        </dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.discount')); ?>:</dt>
                                        <dd class="col-sm-6">
                                            - <?php echo e(\App\CentralLogics\Helpers::format_currency($restaurant_discount_amount)); ?>

                                        </dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.coupon')); ?>

                                            <?php echo e(__('messages.discount')); ?>:
                                        </dt>
                                        <dd class="col-sm-6">
                                            - <?php echo e(\App\CentralLogics\Helpers::format_currency($coupon_discount_amount)); ?></dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.vat/tax')); ?>:</dt>
                                        <dd class="col-sm-6">
                                            + <?php echo e(\App\CentralLogics\Helpers::format_currency($total_tax_amount)); ?></dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.delivery_man_tips')); ?>


                                        </dt>
                                        <dd class="col-sm-6">
                                            <?php ($dm_tips = $order['dm_tips']); ?>
                                            + <?php echo e(\App\CentralLogics\Helpers::format_currency($dm_tips)); ?>


                                        </dd>
                                        <dt class="col-sm-6"><?php echo e(__('messages.delivery')); ?>

                                            <?php echo e(__('messages.fee')); ?>:
                                        </dt>
                                        <dd class="col-sm-6">
                                            <?php ($del_c = $order['delivery_charge']); ?>
                                            + <?php echo e(\App\CentralLogics\Helpers::format_currency($del_c)); ?>

                                            <hr>
                                        </dd>

                                        <dt class="col-sm-6"><?php echo e(__('messages.total')); ?>:</dt>
                                        <dd class="col-sm-6">
                                            <?php echo e(\App\CentralLogics\Helpers::format_currency($product_price + $del_c + $total_tax_amount + $total_addon_price + $dm_tips - $coupon_discount_amount - $restaurant_discount_amount)); ?>

                                        </dd>
                                    </dl>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4 order-print-area-right">
                <!-- Card -->
                <?php if($order['order_status'] != 'delivered'): ?>
                <div class="card mb-2">
                    <!-- Header -->
                    <div class="card-header border-0 py-0">
                        <h4 class="card-header-title border-bottom py-3 m-0  w-100 text-center"><?php echo e(translate('Order Setup')); ?></h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->

                    <div class="card-body">
                        <!-- Unfold -->
                        <?php ($order_delivery_verification = (bool) \App\Models\BusinessSetting::where(['key' => 'order_delivery_verification'])->first()->value); ?>
                        <div class="order-btn-wraper">
                            <?php if($order['order_status'] == 'pending'): ?>
                                <a class="btn w-100 mb-3 btn-sm btn--primary"
                                    onclick="order_status_change_alert('<?php echo e(route('vendor.order.status', ['id' => $order['id'], 'order_status' => 'confirmed'])); ?>','Change status to confirmed ?')"
                                    href="javascript:">
                                    <?php echo e(translate('Confirm Order')); ?>

                                </a>
                                <?php if(config('canceled_by_restaurant')): ?>
                                    <a class="btn w-100 mb-3 btn-sm btn-outline-danger btn--danger mt-3"
                                        onclick="order_status_change_alert('<?php echo e(route('vendor.order.status', ['id' => $order['id'], 'order_status' => 'canceled'])); ?>', '<?php echo e(__('messages.order_canceled_confirmation')); ?>')"
                                        href="javascript:"><?php echo e(translate('Cancel Order')); ?></a>
                                <?php endif; ?>
                            <?php elseif($order['order_status'] == 'confirmed' || $order['order_status'] == 'accepted'): ?>
                                <a class="btn btn-sm btn--primary w-100 mb-3"
                                    onclick="order_status_change_alert('<?php echo e(route('vendor.order.status', ['id' => $order['id'], 'order_status' => 'processing'])); ?>','Change status to cooking ?', verification = false, <?php echo e($max_processing_time); ?>)"
                                    href="javascript:"><?php echo e(__('messages.Proceed_for_cooking')); ?></a>
                            <?php elseif($order['order_status'] == 'processing'): ?>
                                <a class="btn btn-sm btn--primary w-100 mb-3"
                                    onclick="order_status_change_alert('<?php echo e(route('vendor.order.status', ['id' => $order['id'], 'order_status' => 'handover'])); ?>','Change status to ready for handover ?')"
                                    href="javascript:"><?php echo e(__('messages.make_ready_for_handover')); ?></a>
                            <?php elseif($order['order_status'] == 'handover' && ($order['order_type'] == 'take_away' || \App\CentralLogics\Helpers::get_restaurant_data()->self_delivery_system)): ?>
                                <a class="btn btn-sm btn--primary w-100 mb-3"
                                    onclick="order_status_change_alert('<?php echo e(route('vendor.order.status', ['id' => $order['id'], 'order_status' => 'delivered'])); ?>','Change status to delivered (payment status will be paid if not) ?', <?php echo e($order_delivery_verification ? 'true' : 'false'); ?>)"
                                    href="javascript:"><?php echo e(__('messages.maek_delivered')); ?></a>
                            <?php endif; ?>
                        </div>
                        <!-- End Unfold -->
                        <?php if($order['order_type'] != 'take_away'): ?>
                            <?php if($order->delivery_man): ?>
                                <h5 class="card-title mb-3">
                                    <span class="card-header-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                    <span>
                                        <?php echo e(translate('Delivery Man Information')); ?>

                                    </span>
                                </h5>
                                <div class="media align-items-center deco-none customer--information-single" href="javascript:">
                                    <div class="avatar avatar-circle">
                                        <img class="avatar-img  initial-81" onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img3.png')); ?>'"
                                            src="<?php echo e(asset('storage/app/public/delivery-man/' . $order->delivery_man->image)); ?>"
                                            alt="Image Description">
                                    </div>
                                    <div class="media-body">
                                        <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                            <?php echo e($order->delivery_man['f_name'] . ' ' . $order->delivery_man['l_name']); ?>

                                        </span>
                                        <span class="d-block">
                                            <strong class="text--title font-semibold">
                                                <?php echo e($order->delivery_man->orders_count); ?>

                                            </strong>
                                            <?php echo e(__('messages.orders')); ?>

                                        </span>
                                        <span class="d-block">
                                            <a class="text--title font-semibold" href="tel:<?php echo e($order->delivery_man['phone']); ?>">
                                                <strong>
                                                    <?php echo e($order->delivery_man['email']); ?>

                                                </strong>
                                            </a>
                                        </span>
                                        <span class="d-block">
                                            <strong class="text--title font-semibold">
                                            </strong>
                                            <?php echo e($order->delivery_man['phone']); ?>

                                        </span>
                                    </div>
                                </div>

                                <?php if($order['order_type'] != 'take_away'): ?>
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
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="py-3 w-100 text-center mt-3">
                                    <span class="d-block text-capitalize qcont">
                                        <i class="tio-security-warning"></i> <?php echo e(__('messages.deliveryman') . ' ' . __('messages.not_found')); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php echo e(__('messages.customer')); ?> <?php echo e(__('messages.info')); ?>

                            </span>
                        </h5>
                        <?php if($order->customer): ?>
                            <div class="media align-items-center deco-none customer--information-single" href="javascript:">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img  initial-81"
                                        onerror="this.src='<?php echo e(asset('public/assets/admin/img/resturant-panel/customer.png')); ?>'"
                                        src="<?php echo e(asset('storage/app/public/profile/' . $order->customer->image)); ?>"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span class="fz--14px text--title font-semibold text-hover-primary d-block">
                                        <?php echo e($order->customer['f_name'] . ' ' . $order->customer['l_name']); ?>

                                    </span>
                                    <span class="d-block">
                                        <strong class="text--title font-semibold">
                                        <?php echo e($order->customer->orders_count); ?>

                                        </strong>
                                        <?php echo e(translate('Orders')); ?>

                                    </span>
                                    <span class="d-block">
                                        <a class="text--title font-semibold" href="tel:<?php echo e($order->customer['phone']); ?>">
                                            <strong>
                                                <?php echo e($order->customer['phone']); ?>

                                            </strong>
                                        </a>
                                    </span>
                                    <span class="d-block">
                                        <strong class="text--title font-semibold">
                                        </strong>
                                        <?php echo e($order->customer['email']); ?>

                                    </span>
                                </div>
                            </div>
                        <?php else: ?>
                        <?php echo e(translate('messages.customer_not_found')); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <?php if($order->delivery_address): ?>
                    <div class="card mt-2">
                        <div class="card-body">
                            <?php ($address = json_decode($order->delivery_address, true)); ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">
                                    <span class="card-header-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                    <span>
                                        <?php echo e(__('messages.delivery')); ?> <?php echo e(__('messages.info')); ?>

                                    </span>
                                </h5>
                                <?php if(isset($address)): ?>
                                    <a class="link" data-toggle="modal" data-target="#shipping-address-modal"
                                        href="javascript:"><i class="tio-edit"></i></a>
                                <?php endif; ?>
                            </div>
                            <?php if(isset($address)): ?>
                            <span class="delivery--information-single mt-3">
                                <span class="name"><?php echo e(__('messages.name')); ?>:</span>
                                <span class="info"><?php echo e($address['contact_person_name']); ?></span>
                                <span class="name"><?php echo e(__('messages.contact')); ?>:</span>
                                <a class="info" href="tel:<?php echo e($address['contact_person_number']); ?>">
                                    <?php echo e($address['contact_person_number']); ?>

                                </a>
                                <span class="name"><?php echo e(translate('Road')); ?>:</span>
                                <span class="info"><?php echo e(isset($address['road']) ? $address['road'] : ''); ?></span>
                                <span class="name"><?php echo e(translate('House')); ?>:</span>
                                <span class="info"><?php echo e(isset($address['house']) ? $address['house'] : ''); ?></span>
                                <span class="name"><?php echo e(translate('Floor')); ?>:</span>
                                <span class="info"><?php echo e(isset($address['floor']) ? $address['floor'] : ''); ?></span>
                                <span class="mt-2 d-flex w-100">
                                    <span><i class="tio-poi text--title"></i></span>
                                    <?php if($order['order_type'] != 'take_away' && isset($address['address'])): ?>
                                        <?php if(isset($address['latitude']) && isset($address['longitude'])): ?>
                                            <a target="_blank"
                                            class="info pl-2"
                                                href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>">
                                                <?php echo e($address['address']); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="info pl-2">
                                                <?php echo e($address['address']); ?>

                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Row -->
    </div>

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

                <?php ($address = \App\Models\CustomerAddress::find($order['delivery_address_id'])); ?>
                <?php if(isset($address)): ?>
                    <form action="<?php echo e(route('vendor.order.update-shipping', [$order['delivery_address_id']])); ?>"
                        method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.type')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control h--45px" name="address_type"
                                        value="<?php echo e($address['address_type']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.contact')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control h--45px" name="contact_person_number"
                                        value="<?php echo e($address['contact_person_number']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.name')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control h--45px" name="contact_person_name"
                                        value="<?php echo e($address['contact_person_name']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.address')); ?>

                                </label>
                                <div class="col-md-10 js-form-message">
                                    <input type="text" class="form-control h--45px" name="address"
                                        value="<?php echo e($address['address']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.latitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control h--45px" name="latitude"
                                        value="<?php echo e($address['latitude']); ?>" required>
                                </div>
                                <label for="requiredLabel" class="col-md-2 col-form-label input-label text-md-right">
                                    <?php echo e(__('messages.longitude')); ?>

                                </label>
                                <div class="col-md-4 js-form-message">
                                    <input type="text" class="form-control h--45px" name="longitude"
                                        value="<?php echo e($address['longitude']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--reset"
                                data-dismiss="modal"><?php echo e(__('messages.close')); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo e(__('messages.save')); ?>

                                <?php echo e(__('messages.changes')); ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- End Content -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script_2'); ?>
    <script>
        function order_status_change_alert(route, message, verification, processing = false) {
            if (verification) {
                Swal.fire({
                    title: 'Enter order verification code',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    preConfirm: (otp) => {
                        location.href = route + '&otp=' + otp;
                        // .then(response => {
                        //     if (!response.ok) {
                        //     throw new Error(response.statusText)
                        //     }
                        //     return response.json()
                        // })
                        // .catch(error => {
                        //     Swal.showValidationMessage(
                        //     `Request failed: ${error}`
                        //     )
                        // })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                // .then((result) => {
                // if (result.isConfirmed) {
                //     Swal.fire({
                //     title: `${result.value.login}'s avatar`,
                //     imageUrl: result.value.avatar_url
                //     })
                // }
                // })
            } else if (processing) {
                Swal.fire({
                    //text: message,
                    title: '<?php echo e(translate('Are you sure ?')); ?>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: '<?php echo e(translate('Are you sure ?')); ?>Cancel',
                    confirmButtonText: 'Submit',
                    inputPlaceholder: "Enter processing time",
                    input: 'text',
                    html: message + '<br/>'+'<label>Enter Processing time in minutes</label>',
                    inputValue: processing,
                    preConfirm: (processing_time) => {
                        location.href = route + '&processing_time=' + processing_time;
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        location.href = route;
                    }
                })
            }
        }

        function last_location_view() {
            toastr.warning('Only available when order is out for delivery!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/vendor-views/order/order-view.blade.php ENDPATH**/ ?>