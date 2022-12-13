<?php $__env->startSection('title', ''); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        #printableArea *{
            color: black !important;
        }
        @media  print {
            .non-printable {
                display: none;
            }

            .printable {
                display: block;
                font-family: emoji !important;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                /* Chrome, Safari */
                color-adjust: exact !important;
                font-family: emoji !important;
            }
        }

    </style>

    <style type="text/css" media="print">
        @page  {
            size: auto;
            /* auto is the initial value */
            margin: 2px;
            /* this affects the margin in the printer settings */
            font-family: emoji !important;
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <div class="row" id="printableArea" style="font-family: emoji;">
            <div class="col-md-12">
                <center>
                    <input type="button" class="btn btn-primary non-printable" onclick="printDiv('printableArea')"
                        value="Proceed, If thermal printer is ready." />
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable">Back</a>
                </center>
                <hr class="non-printable">
            </div>
            <div style="max-width:376px;margin:0 auto;padding-left:10px;padding-right:10px">
                <div class="pt-3">
                    <img src="<?php echo e(asset('/public/assets/admin/img/restaurant-invoice.png')); ?>" style="width:100%;height:70px;object-fit:contain;" alt="">
                </div>
                <div class="text-center pt-2 mb-3">
                    <h2 style="line-height: 1"><?php echo e($order->restaurant->name); ?></h2>
                    <h5 class="text-break" style="font-size: 16px;font-weight: lighter;line-height: 1">
                        <?php echo e($order->restaurant->address); ?>

                    </h5>
                    <h5 style="font-size: 16px;font-weight: lighter;line-height: 1">
                        <?php echo e(translate('phone')); ?> : <?php echo e($order->restaurant->phone); ?>

                    </h5>
                    <?php if($order->restaurant->gst_status): ?>
                        <h5 style="font-size: 12px;font-weight: lighter;line-height: 1">
                            <?php echo e(translate('Gst No')); ?> : <?php echo e($order->restaurant->gst_code); ?>

                        </h5>
                    <?php endif; ?>
                    
                </div>

                <span style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;white-space:nowrap">---------------------------------------------------------------------------------</span>
                <div class="row mt-3">
                    <div class="col-6">
                        <h5><?php echo e(translate('Order ID')); ?> :
                            <span style="font-weight:400"> <?php echo e($order['id']); ?> </span>
                        </h5>
                    </div>
                    <div class="col-6">
                        <h5 style="font-weight: lighter">
                            <?php echo e(date('d/M/Y ' . config('timeformat'), strtotime($order['created_at']))); ?>

                        </h5>
                    </div>
                    <div class="col-12">
                        <h5>
                            <?php echo e(translate('Customer Name')); ?> :
                            <span style="font-weight:400">
                                <?php echo e(isset($order->delivery_address) ? json_decode($order->delivery_address, true)['contact_person_name'] : ''); ?>

                            </span>
                        </h5>
                        <h5>
                            <?php echo e(translate('messages.phone')); ?> :
                            <span style="font-weight:400">
                                <?php echo e(isset($order->delivery_address) ? json_decode($order->delivery_address, true)['contact_person_number'] : ''); ?>

                            </span>
                        </h5>
                        <h5 class="text-break">
                            <?php echo e(translate('messages.address')); ?> :
                            <span style="font-weight:400">
                                <?php echo e(isset($order->delivery_address) ? json_decode($order->delivery_address, true)['address'] : ''); ?>

                            </span>
                        </h5>
                    </div>
                </div>
                <h5 class="text-uppercase"></h5>
                <span style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;white-space:nowrap">---------------------------------------------------------------------------------</span>
                <table class="table table-bordered mt-1 mb-1">
                    <thead>
                        <tr>
                            <th style="width: 10%;padding: 0.45rem 0.65rem;border-bottom:none"><?php echo e(translate('messages.qty')); ?></th>
                            <th class="" style="padding: 0.45rem 0.65rem;border-bottom:none"><?php echo e(translate('DESC')); ?></th>
                            <th class="" style="padding: 0.45rem 0.65rem;border-bottom:none"><?php echo e(translate('messages.price')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php ($sub_total = 0); ?>
                        <?php ($total_tax = 0); ?>
                        <?php ($total_dis_on_pro = 0); ?>
                        <?php ($add_ons_cost = 0); ?>
                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($detail->food_id): ?>
                                <tr>
                                    <td class="">
                                        <?php echo e($detail['quantity']); ?>

                                    </td>
                                    <td class="text-break">
                                    <?php echo e(json_decode($detail->food_details, true)['name']); ?> <br>
                                        <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                                            <strong><u>Variation : </u></strong>
                                            <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="font-size-sm text-body">
                                                    <span><?php echo e($key1); ?> : </span>
                                                    <span
                                                        class="font-weight-bold"><?php echo e($key1 == 'price' ? \App\CentralLogics\Helpers::format_currency($variation) : $variation); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="font-size-sm text-body">
                                                <span><?php echo e('Price'); ?> : </span>
                                                <span
                                                    class="font-weight-bold"><?php echo e(\App\CentralLogics\Helpers::format_currency($detail->price)); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php $__currentLoopData = json_decode($detail['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key2 == 0): ?>
                                                <strong><u>Addons : </u></strong>
                                            <?php endif; ?>
                                            <div class="font-size-sm text-body">
                                                <span class="text-break"><?php echo e($addon['name']); ?> : </span>
                                                <span class="font-weight-bold">
                                                    <?php echo e($addon['quantity']); ?> x
                                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                                </span>
                                            </div>
                                            <?php ($add_ons_cost += $addon['price'] * $addon['quantity']); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td style="width: 28%">
                                        <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?>

                                    </td>
                                </tr>
                                <?php ($sub_total += $amount); ?>
                                <?php ($total_tax += $detail['tax_amount'] * $detail['quantity']); ?>
                            <?php elseif($detail->campaign): ?>
                                <tr>
                                    <td class="">
                                        <?php echo e($detail['quantity']); ?>

                                    </td>
                                    <td class="">
                                        <?php echo e($detail->campaign['title']); ?> <br>
                                        <?php if(count(json_decode($detail['variation'], true)) > 0): ?>
                                            <strong><u><?php echo e(translate('messages.variation')); ?> : </u></strong>
                                            <?php $__currentLoopData = json_decode($detail['variation'], true)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="font-size-sm text-body">
                                                    <span><?php echo e($key1); ?> : </span>
                                                    <span
                                                        class="font-weight-bold"><?php echo e($key1 == 'price' ? \App\CentralLogics\Helpers::format_currency($variation) : $variation); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="font-size-sm text-body">
                                                <span><?php echo e(translate('messages.price')); ?> : </span>
                                                <span
                                                    class="font-weight-bold"><?php echo e(\App\CentralLogics\Helpers::format_currency($detail->price)); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php $__currentLoopData = json_decode($detail['add_ons'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key2 == 0): ?>
                                                <strong><u><?php echo e(translate('messages.addons')); ?> : </u></strong>
                                            <?php endif; ?>
                                            <div class="font-size-sm text-body">
                                                <span><?php echo e($addon['name']); ?> : </span>
                                                <span class="font-weight-bold">
                                                    <?php echo e($addon['quantity']); ?> x
                                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                                </span>
                                            </div>
                                            <?php ($add_ons_cost += $addon['price'] * $addon['quantity']); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td style="width: 28%">
                                        <?php ($amount = $detail['price'] * $detail['quantity']); ?>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($amount)); ?>

                                    </td>
                                </tr>
                                <?php ($sub_total += $amount); ?>
                                <?php ($total_tax += $detail['tax_amount'] * $detail['quantity']); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <span style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;white-space:nowrap">---------------------------------------------------------------------------------</span>
                <div class="mb-3" style="width: 98%; margin-left: auto;margin-right:auto">
                    <div class="px-3">
                        <dl class="row text-right">
                            <dt class="col-6 text-left"><?php echo e(translate('Items Price')); ?>:</dt>
                            <dd class="col-6"><?php echo e(\App\CentralLogics\Helpers::format_currency($sub_total)); ?></dd>
                            <dt class="col-6 text-left"><?php echo e(translate('Addon Cost')); ?>:</dt>
                            <dd class="col-6">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($add_ons_cost)); ?>

                                <hr>
                            </dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.subtotal')); ?>:</dt>
                            <dd class="col-6">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($sub_total + $add_ons_cost)); ?></dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.discount')); ?>:</dt>
                            <dd class="col-6">
                                - <?php echo e(\App\CentralLogics\Helpers::format_currency($order['restaurant_discount_amount'])); ?>

                            </dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.coupon_discount')); ?>:</dt>
                            <dd class="col-6">
                                - <?php echo e(\App\CentralLogics\Helpers::format_currency($order['coupon_discount_amount'])); ?></dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.vat/tax')); ?>:</dt>
                            <dd class="col-6">+
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($order['total_tax_amount'])); ?></dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.delivery_man_tips')); ?>:</dt>
                            <dd class="col-6">
                                <?php ($dm_tips = $order['dm_tips']); ?>
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($dm_tips)); ?>

                            </dd>
                            <dt class="col-6 text-left"><?php echo e(translate('messages.delivery_charge')); ?>:</dt>
                            <dd class="col-6">
                                <?php ($del_c = $order['delivery_charge']); ?>
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($del_c)); ?>

                                <hr>
                            </dd>

                            <dt class="col-6 text-left" style="font-size: 20px"><?php echo e(translate('messages.total')); ?>:</dt>
                            <dd class="col-6" style="font-size: 20px">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($sub_total + $del_c + $dm_tips + $order['total_tax_amount'] + $add_ons_cost - $order['coupon_discount_amount'] - $order['restaurant_discount_amount'])); ?>

                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-between border-top pt-3">
                    <span class="text-capitalize"><?php echo e(translate('Paid by')); ?>: <?php echo e(str_replace('_', ' ', $order['payment_method'])); ?></span>
                    <span><?php echo e(translate('messages.amount')); ?>: <?php echo e($order->order_amount + $order->adjusment); ?></span>
                    <span><?php echo e(translate('messages.change')); ?>: <?php echo e($order->adjusment); ?></span>
                </div>
                <span style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;white-space:nowrap">---------------------------------------------------------------------------------</span>
                <h5 class="text-center pt-1">
                    """<?php echo e(translate('THANK YOU')); ?>"""
                </h5>
                    
                <span style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;white-space:nowrap">---------------------------------------------------------------------------------</span>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/vendor-views/order/invoice.blade.php ENDPATH**/ ?>