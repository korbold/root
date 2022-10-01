<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo e(__('messages.order_place')); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  /* @media  screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }

    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight:  650;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  } */
  @import  url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
   body{
    font-family: 'Roboto', sans-serif;
   }
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }

  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;

  }

  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }

  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  /**
   * Fix centering issues in Android 4.4.
   */
  /* div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  } */

  /* body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  } */

  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }

  a {
    color: #1a82e2;
  }

  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  
  </style>

</head>
<body style="background-color: #ececec;margin:0;padding:0">
  <?php 
    use App\Models\BusinessSetting;
    $company_phone =BusinessSetting::where('key', 'phone')->first()->value;
    $company_email =BusinessSetting::where('key', 'email_address')->first()->value;
    $company_name =BusinessSetting::where('key', 'business_name')->first()->value;
    $logo =BusinessSetting::where('key', 'logo')->first()->value;
    $company_address =BusinessSetting::where('key', 'address')->first()->value;
    $company_mobile_logo = $logo;
    $company_links = json_decode(BusinessSetting::where('key','landing_page_links')->first()->value, true);
?>
<div style="width:650px;margin:auto; background-color:#ececec;height:50px;">

</div>
<div style="width:650px;margin:auto; background-color:white;margin-top:100px; 
            padding-top:40px;padding-bottom:40px;border-radius: 3px;">
    <table style="background-color: rgb(255, 255, 255);width: 90%;margin:auto;height:72px; border-bottom:1px ridge;">
        <tbody>
            <tr>
                <td>
                    <h2 ><?php echo e(__('messages.thanks_for_the_order')); ?></h2>
                    <h3 style="color:green;"><?php echo e(__('messages.Your_order_ID')); ?> : <?php echo e($id); ?></h3>
                </td>
                <td>
                    <div style="text-align: right; margin-right:15px;">
                        <img style="max-width:250px;border:0;" src="<?php echo e(asset('/storage/app/public/business/'.$logo)); ?>" title=""
                            class="sitelogo" width="60%"  alt=""/>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <?php ($order = \App\Models\Order::find($id)); ?>
    <table style="background-color: rgb(255, 255, 255);width: 90%;margin:auto; padding-bottom:20px;">
        <tbody >
            <tr style="width: 100%;">
                <td style="width:50%;vertical-align: top; margin-top:5px;">
                    
                    <div style="text-align:left;margin-top:10px;">
                      <span style="color: #130505 !important;text-transform: capitalize;font-weight: bold;"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.info')); ?> </span><br>
                      
                      <?php if($order->restaurant): ?>
                    
                        <div style="display:flex; align-items:center;margin-top:10px;">
                            
                            <img style="border:0;border-radius:50%;" src="<?php echo e(asset('/storage/app/public/restaurant/'.$order->restaurant->logo)); ?>" title=""
                                    class="sitelogo" width="20%"  alt=""/>
                        
                            <span style="padding-left: 5px;"><?php echo e($order->restaurant->name); ?></span>
                        </div>
                    <?php endif; ?>
                  </div>
    
                </td>
                <td style="width:50%;vertical-align: top;">
                    <div style="text-align:right;margin-top:10px;">
                        <span style="color: #130505 !important;text-transform: capitalize;font-weight: bold;"><?php echo e(__('messages.payment_details')); ?>  </span><br>
                        <div style="margin-top: 10px;">
                          <span style="color: #414141 !important ; text-transform: capitalize;"><?php echo e(str_replace('_',' ',$order->payment_method)); ?></span><br> 
                        <span style="color: <?php echo e($order->payment_status=='paid'?'green':'red'); ?>;">
                            <?php echo e($order->payment_status); ?>

                        </span><br>
                        <span style="color: #414141 !important ; text-transform: capitalize;">
                            <?php echo e(date('d M Y '.config('timeformat'),strtotime($order['created_at']))); ?>

                        </span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
        
    </table>
    
    
    <?php
        $subtotal=0;
        $total=0;
        $sub_total=0;
        $total_shipping_cost=$order->delivery_charge;
        $total_discount_on_product=0;
        $extra_discount=0;
        $total_addon_price = 0;
    ?>
    <div style="background-color: rgb(248, 248, 248); width: 90%;margin:auto;margin-top:30px;">
        <div style="padding:20px;">
            <table style="width: 100%; ">
                <tbody style="">
                    
                        <tr style="border-bottom: 1px ridge;text-transform: capitalize;">
                            <th style="padding-bottom: 8px;width:10%;"><?php echo e(__('messages.sl')); ?></th>
                            <th style="padding-bottom: 8px;width:40%;"><?php echo e(__('messages.Ordered_Items')); ?></th>
                            <th style="padding-bottom: 8px;width:15%"><?php echo e(__('messages.Unit_price')); ?></th>
                            <th style="padding-bottom: 8px;width:15%;"><?php echo e(__('messages.qty')); ?></th>
                            <th style="padding-bottom: 8px;width:20%;"><?php echo e(__('messages.total')); ?></th>
                        </tr>
                        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $subtotal=($details['price'])*$details->quantity; 
                            $item_details = json_decode($details->food_details, true);
                        ?>
                            <tr style="text-align: center; border-bottom: 1px ridge;">
                                
                                <td style="padding:5px;"><?php echo e($key+1); ?></td>
                                <td style="padding:5px;">
                                  <span style="font-size: 14px;">
                                    <?php echo e(Str::limit($item_details['name'],55)); ?>

                                  </span>
                                    
                                <br>
                                <?php if(count(json_decode($details['variation'],true))>0): ?>
                                  <span style="font-size: 12px;">
                                    <?php echo e(__('messages.variation')); ?> : <?php echo e(json_decode($details['variation'], true)[0]['type']); ?>

                                  </span>
                                <?php endif; ?>
                                <?php $__currentLoopData = json_decode($details['add_ons'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 =>$addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key2==0): ?><br><span style="font-size: 12px;"><u><?php echo e(__('messages.addons')); ?>  </u></span><?php endif; ?>
                                    <div style="font-size: 12px;">
                                        <span><?php echo e(Str::limit($addon['name'],20, '...')); ?> :  </span>
                                        <span class="font-weight-bold">
                                            <?php echo e($addon['quantity']); ?> x <?php echo e(\App\CentralLogics\Helpers::format_currency($addon['price'])); ?>

                                        </span>
                                    </div>
                                    <?php ($total_addon_price+=$addon['price']*$addon['quantity']); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                                </td>
                                <td style="padding:5px;"><?php echo e(\App\CentralLogics\Helpers::format_currency($details['price'])); ?></td>
                                <td style="padding:5px;"><?php echo e($details->quantity); ?></td>
                                <td style="padding:5px;"><?php echo e(\App\CentralLogics\Helpers::format_currency($subtotal)); ?></td>
                            </tr>
                            <?php 
                                $sub_total+=$details['price']*$details['quantity'];
                                $total_discount_on_product+=$details['discount'];
                                $total+=$subtotal;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    
                </tbody>
            </table>
        </div>
    </div>

        <table style="background-color: rgb(255, 255, 255);width: 90%;margin:auto;margin-top:30px;">
            <tr>
                <th style="text-align: left; vertical-align: auto;">
                    
                </th>
    
                <td style="text-align: right">
                    <table style="width: 46%;margin-left:41%; display: inline;text-transform: capitalize; ">
                        <tbody>
    
                        <tr>
                            <th  ><b><?php echo e(__('messages.item')); ?> <?php echo e(__('messages.price')); ?> : </b></th>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($sub_total)); ?></td>
                        </tr>
                        <tr>
                            <th  ><b><?php echo e(__('messages.addon')); ?> <?php echo e(__('messages.cost')); ?> : </b></th>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($total_addon_price)); ?></td>
    
                        </tr>
                        <tr>
                            <th  ><b><?php echo e(__('messages.subtotal')); ?> : </b></th>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($sub_total + $total_addon_price)); ?></td>
    
                        </tr>
                        <tr>
                            <td><?php echo e(__('messages.tax')); ?>  : </td>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($order->total_tax_amount)); ?></td>
                        </tr>

                        <tr>
                            <td  ><?php echo e(__('messages.delivery_charge')); ?> : </td>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($order->delivery_charge)); ?></td>
                        </tr>

                        <tr>
                            <td  ><?php echo e(__('messages.DM Tips')); ?> : </td>
                            <td><?php echo e(\App\CentralLogics\Helpers::format_currency($order->dm_tips)); ?></td>
                        </tr>

                        <tr class="border-bottom">
                        <td  ><?php echo e(__('messages.discount')); ?> : </td>
                            <td>
                                - <?php echo e(\App\CentralLogics\Helpers::format_currency($order->restaurant_discount_amount)); ?></td>
                        </tr>

                        <tr>
                            <td  ><?php echo e(__('messages.coupon_discount')); ?> : </td>
                            <td>
                                - <?php echo e(\App\CentralLogics\Helpers::format_currency($order->coupon_discount_amount)); ?></td>
                        </tr>

                        <tr class="bg-primary">
                            <th class="text-left"><b class="text-white"><?php echo e(__('messages.total')); ?> : </b></th>
                            <td class="text-white">
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($order->order_amount)); ?>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>    
</div>

<div style="padding:5px;width:650px;margin:auto;margin-top:5px; margin-bottom:50px;">
    <table style="margin:auto;width:90%; color:#777777;">
        <tbody style="text-align: center;">
   
            <tr>
                <?php ($social_media = \App\Models\SocialMedia::active()->get()); ?>
                
                <?php if(isset($social_media)): ?>
                    <th style="width: 100%;">
                        <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div style="display:inline-block;">
                            <a href="<?php echo e($item->link); ?>" target=”_blank”>
                            <img src="<?php echo e(asset('public/assets/admin/img/'.$item->name.'.png')); ?>" alt="" style="height: 14px; width:14px; padding: 0px 3px 0px 5px;">
                            </a>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </th>
                <?php endif; ?>
            </tr>                 
            <tr>
                <th >
                    <div style="font-weight: 400;font-size: 11px;line-height: 22px;color: #242A30;"><span style="margin-right:5px;"> <a href="tel:<?php echo e($company_phone); ?>" style="text-decoration: none; color: inherit;"><?php echo e(__('messages.phone')); ?>: <?php echo e($company_phone); ?></a></span> <span><a href="mailto:<?php echo e($company_email); ?>" style="text-decoration: none; color: inherit;"><?php echo e(__('messages.email')); ?>: <?php echo e($company_email); ?></a></span></div>
                    <?php if($company_links['web_app_url_status']): ?>
                    <div style="font-weight: 400;font-size: 11px;line-height: 22px;color: #242A30;">
                        <a href="<?php echo e($company_links['web_app_url']); ?>" style="text-decoration: none; color: inherit;"><?php echo e($company_links['web_app_url']); ?></a></div>
                    <?php endif; ?> 
                    <div style="font-weight: 400;font-size: 11px;line-height: 22px;color: #242A30;"><?php echo e($company_address); ?></div>
                    <span style="font-weight: 400;font-size: 10px;line-height: 22px;color: #242A30;"><?php echo e(__('messages.All copy right reserved',['year'=>date('Y'),'title'=>$company_name])); ?></span>
                </th>
            </tr>

        </tbody>
    </table>
</div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/email-templates/order-placed.blade.php ENDPATH**/ ?>