<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered">
        <div class="navbar-vertical-container">
            <div class="navbar-brand-wrapper justify-content-between">
                <!-- Logo -->
                <div class="sidebar-logo-container">
                    <?php ($restaurant_data=\App\CentralLogics\Helpers::get_restaurant_data()); ?>
                    <a class="navbar-brand pt-0 pb-0" href="<?php echo e(route('vendor.dashboard')); ?>" aria-label="Front">
                        <img class="navbar-brand-logo"
                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img2.jpg')); ?>'"
                            src="<?php echo e(asset('storage/app/public/restaurant/'.$restaurant_data->logo)); ?>"
                            alt="Logo">
                        <img class="navbar-brand-logo-mini"
                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/160x160/img2.jpg')); ?>'"
                            src="<?php echo e(asset('storage/app/public/restaurant/'.$restaurant_data->logo)); ?>" alt="Logo">
                        <div class="ps-2">
                            <h6>
                                <?php echo e(\Illuminate\Support\Str::limit($restaurant_data->name,15)); ?>

                            </h6>
                        </div>
                    </a>
                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>
                <div class="navbar-nav-wrap-content-left ml-auto d-none d-xl-block">
                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                        data-placement="right" title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                        data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

            </div>

            <!-- Content -->
            <div class="navbar-vertical-content text-capitalize bg-334257">
                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <!-- Dashboards -->
                    <li class="pt-4"></li>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.dashboard')); ?>" title="<?php echo e(__('messages.dashboard')); ?>">
                            <i class="tio-home-vs-1-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.dashboard')); ?>

                            </span>
                        </a>
                    </li>
                    <!-- End Dashboards -->

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('pos')): ?>
                    <!-- POS -->
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/pos')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="<?php echo e(route('vendor.pos.index')); ?>" title="<?php echo e(translate('POS')); ?>"
                        >
                            <i class="tio-shopping nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.pos')); ?></span>
                        </a>
                    </li>
                    <!-- End POS -->
                    <?php endif; ?>

                    <li class="nav-item">
                        <small
                            class="nav-subtitle">Promotions</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <!-- Campaign -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('campaign')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/campaign*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="<?php echo e(translate('Campaign')); ?>">
                            <i class="tio-image nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.campaign')); ?></span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub <?php echo e(Request::is('vendor-panel/campaign*')?'d-block':'initial-hidden'); ?>">
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/campaign/list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.campaign.list')); ?>" title="<?php echo e(translate('messages.basic_campaign')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.basic_campaign')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/campaign/item/list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.campaign.itemlist')); ?>" title="<?php echo e(translate('messages.food_campaign')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(translate('food_campaign')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <!-- End Campaign -->

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('order')): ?>
                    <li class="nav-item">
                        <small class="nav-subtitle" title="<?php echo e(__('messages.order')); ?> <?php echo e(__('messages.section')); ?>"><?php echo e(__('messages.order')); ?> <?php echo e(__('messages.management')); ?></small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <!-- Order -->
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/order*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                            title="<?php echo e(__('messages.orders')); ?>">
                            <i class="tio-shopping-cart nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.orders')); ?>

                            </span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub <?php echo e(Request::is('vendor-panel/order*')?'d-block':'initial-hidden'); ?>">
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/all')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('vendor.order.list',['all'])); ?>" title="<?php echo e(__('messages.all')); ?> <?php echo e(__('messages.order')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.all')); ?>

                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where('restaurant_id', \App\CentralLogics\Helpers::get_restaurant_id())
                                                ->where(function($query){
                                                    return $query->whereNotIn('order_status',(config('order_confirmation_model') == 'restaurant'|| \App\CentralLogics\Helpers::get_restaurant_data()->self_delivery_system)?['failed','canceled', 'refund_requested', 'refunded']:['pending','failed','canceled', 'refund_requested', 'refunded'])
                                                    ->orWhere(function($query){
                                                        return $query->where('order_status','pending')->where('order_type', 'take_away');
                                                    });
                                            })->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/pending')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.order.list',['pending'])); ?>" title="<?php echo e(__('messages.pending')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.pending')); ?> <?php echo e((config('order_confirmation_model') == 'restaurant' || \App\CentralLogics\Helpers::get_restaurant_data()->self_delivery_system)?'':__('messages.take_away')); ?>

                                            <span class="badge badge-soft-success badge-pill ml-1">
                                            <?php if(config('order_confirmation_model') == 'restaurant' || \App\CentralLogics\Helpers::get_restaurant_data()->self_delivery_system): ?>
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'pending','restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->OrderScheduledIn(30)->count()); ?>

                                            <?php else: ?>
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'pending','restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id(), 'order_type'=>'take_away'])->Notpos()->OrderScheduledIn(30)->count()); ?>

                                            <?php endif; ?>
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/confirmed')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.order.list',['confirmed'])); ?>" title="<?php echo e(__('messages.confirmed')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.confirmed')); ?>

                                            <span class="badge badge-soft-success badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::whereIn('order_status',['confirmed', 'accepted'])->Notpos()->whereNotNull('confirmed')->where('restaurant_id', \App\CentralLogics\Helpers::get_restaurant_id())->OrderScheduledIn(30)->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/cooking')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('vendor.order.list',['cooking'])); ?>" title="<?php echo e(__('messages.cooking')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.cooking')); ?>

                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'processing', 'restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/ready_for_delivery')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('vendor.order.list',['ready_for_delivery'])); ?>" title="<?php echo e(translate('Ready For Delivery')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.ready_for_delivery')); ?>

                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'handover', 'restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/food_on_the_way')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('vendor.order.list',['food_on_the_way'])); ?>" title="<?php echo e(translate('Food On The Way')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.food_on_the_way')); ?>

                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'picked_up', 'restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/delivered')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.order.list',['delivered'])); ?>"  title="<?php echo e(translate('Delivered')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.delivered')); ?>

                                            <span class="badge badge-soft-success badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where(['order_status'=>'delivered','restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/refunded')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.order.list',['refunded'])); ?>"  title="<?php echo e(translate('Refunded')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.refunded')); ?>

                                            <span class="badge badge-soft-danger bg-light badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::Refunded()->where(['restaurant_id'=>\App\CentralLogics\Helpers::get_restaurant_id()])->Notpos()->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/order/list/scheduled')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('vendor.order.list',['scheduled'])); ?>" title="<?php echo e(__('messages.scheduled')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate sidebar--badge-container">
                                        <?php echo e(__('messages.scheduled')); ?>

                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            <?php echo e(\App\Models\Order::where('restaurant_id',\App\CentralLogics\Helpers::get_restaurant_id())->Notpos()->Scheduled()->where(function($q){
                                                if(config('order_confirmation_model') == 'restaurant' || \App\CentralLogics\Helpers::get_restaurant_data()->self_delivery_system)
                                                {
                                                    $q->whereNotIn('order_status',['failed','canceled', 'refund_requested', 'refunded']);
                                                }
                                                else
                                                {
                                                    $q->whereNotIn('order_status',['pending','failed','canceled', 'refund_requested', 'refunded'])->orWhere(function($query){
                                                        $query->where('order_status','pending')->where('order_type', 'take_away');
                                                    });
                                                }

                                            })->count()); ?>

                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- End Order -->
                    <?php endif; ?>
                    <li class="nav-item">
                        <small
                            class="nav-subtitle"><?php echo e(__('messages.food')); ?> <?php echo e(__('messages.management')); ?></small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>
                    <!-- End AddOn -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('food')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/category*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                            href="javascript:" title="<?php echo e(__('messages.categories')); ?>"
                        >
                            <i class="tio-category nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.categories')); ?></span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub <?php echo e(Request::is('vendor-panel/category*')?'d-block':'initial-hidden'); ?>">
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/category/list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.category.add')); ?>"
                                    title="<?php echo e(__('messages.category')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.category')); ?></span>
                                </a>
                            </li>

                            <li class="nav-item <?php echo e(Request::is('vendor-panel/category/sub-category-list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.category.add-sub-category')); ?>"
                                    title="<?php echo e(__('messages.sub_category')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.sub_category')); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Food -->
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/food*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="<?php echo e(translate('Food')); ?>"
                        >
                            <i class="tio-premium-outlined nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.foods')); ?></span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub <?php echo e(Request::is('vendor-panel/food*')?'d-block':'initial-hidden'); ?>">
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/food/add-new')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.food.add-new')); ?>"
                                     title="<?php echo e(translate('Add New Food')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span
                                        class="text-truncate"><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/food/list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.food.list')); ?>"  title="<?php echo e(translate('Food List')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.list')); ?></span>
                                </a>
                            </li>
                            <?php if(\App\CentralLogics\Helpers::get_restaurant_data()->food_section): ?>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/food/bulk-import')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.food.bulk-import')); ?>"
                                     title="<?php echo e(translate('Bulk Import')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate text-capitalize"><?php echo e(__('messages.bulk_import')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/food/bulk-export')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.food.bulk-export-index')); ?>"
                                     title="<?php echo e(translate('Bulk Export')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate text-capitalize"><?php echo e(__('messages.bulk_export')); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <!-- End Food -->
                    <?php endif; ?>
                    <!-- AddOn -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('addon')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/addon*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.addon.add-new')); ?>" title="<?php echo e(__('messages.addons')); ?>"
                        >
                            <i class="tio-add-circle-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.addons')); ?>

                            </span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- DeliveryMan -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('deliveryman')): ?>
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                   title="<?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.section')); ?>"><?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.management')); ?></small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/delivery-man/add')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('vendor.delivery-man.add')); ?>"
                               title="<?php echo e(__('messages.add_delivery_man')); ?>"
                            >
                                <i class="tio-running nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(__('messages.add_delivery_man')); ?>

                                </span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/delivery-man/list')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('vendor.delivery-man.list')); ?>"
                               title="<?php echo e(__('messages.deliveryman')); ?> <?php echo e(__('messages.list')); ?>"
                            >
                                <i class="tio-filter-list nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(__('messages.deliverymen')); ?> <?php echo e(__('messages.list')); ?>

                                </span>
                            </a>
                        </li>

                        
                    <?php endif; ?>
                <!-- End DeliveryMan -->


                    <!-- Business Section-->
                    <li class="nav-item">
                        <small class="nav-subtitle"
                                title="<?php echo e(__('messages.business')); ?> <?php echo e(__('messages.section')); ?>"><?php echo e(__('messages.business')); ?> <?php echo e(__('messages.management')); ?></small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('restaurant_setup')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/business-settings/restaurant-setup')?'active':''); ?>">
                        <a class="nav-link " href="<?php echo e(route('vendor.business-settings.restaurant-setup')); ?>" title="<?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.config')); ?>"
                        >
                            <span class="tio-settings nav-icon"></span>
                            <span
                                class="text-truncate"><?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.config')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('my_shop')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/restaurant/view')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.shop.view')); ?>"
                            title="<?php echo e(translate('My Resturant')); ?>">
                            <i class="tio-home nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.my_shop')); ?>

                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('bank_info')): ?>
                    <!-- Business Settings -->
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/profile*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.profile.bankView')); ?>"
                            title="<?php echo e(__('messages.my')); ?> <?php echo e(__('messages.bank_info')); ?>">
                            <i class="tio-shop nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.my')); ?> <?php echo e(__('messages.bank_info')); ?>

                            </span>
                        </a>
                    </li>
                    <?php endif; ?>


                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('wallet')): ?>
                    <!-- RestaurantWallet -->
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/wallet*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="<?php echo e(route('vendor.wallet.index')); ?>" title="<?php echo e(__('messages.my')); ?> <?php echo e(__('messages.wallet')); ?>"
                        >
                            <i class="tio-table nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.my')); ?> <?php echo e(__('messages.wallet')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End RestaurantWallet -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('reviews')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/reviews')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.reviews')); ?>" title="<?php echo e(__('messages.reviews')); ?>"
                        >
                            <i class="tio-star-outlined nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.reviews')); ?>

                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End RestaurantWallet -->
                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('my_shop')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/message*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link"
                            href="<?php echo e(route('vendor.message.list')); ?>" title="<?php echo e(__('messages.chat')); ?>"
                        >
                            <i class="tio-chat nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                <?php echo e(__('messages.chat')); ?>

                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- End Business Settings -->

                    <!-- Employee-->
                    <li class="nav-item">
                        <small class="nav-subtitle" title="<?php echo e(__('messages.employee')); ?> <?php echo e(__('messages.section')); ?>"><?php echo e(__('messages.employee')); ?> <?php echo e(__('messages.section')); ?></small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('custom_role')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/custom-role*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="<?php echo e(route('vendor.custom-role.create')); ?>"
                        title="<?php echo e(__('messages.employee')); ?> <?php echo e(__('messages.Role')); ?>">
                            <i class="tio-incognito nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.employee')); ?> <?php echo e(__('messages.Role')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(\App\CentralLogics\Helpers::employee_module_permission_check('employee')): ?>
                    <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('vendor-panel/employee*')?'active':''); ?>">
                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        title="<?php echo e(__('messages.employees')); ?>">
                            <i class="tio-user nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(__('messages.employees')); ?></span>
                        </a>
                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub <?php echo e(Request::is('vendor-panel/employee*')?'d-block':'initial-hidden'); ?>">
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/employee/add-new')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.employee.add-new')); ?>" title="<?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?> <?php echo e(__('messages.Employee')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.add')); ?> <?php echo e(__('messages.new')); ?> <?php echo e(__('messages.employee')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(Request::is('vendor-panel/employee/list')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('vendor.employee.list')); ?>" title="<?php echo e(__('messages.Employee')); ?> <?php echo e(__('messages.list')); ?>">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"><?php echo e(__('messages.list')); ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>
                    <!-- End Employee -->

                    <li class="nav-item pt-100px">

                    </li>
                </ul>
            </div>
            <!-- End Content -->
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>




<?php $__env->startPush('script_2'); ?>
<script>
    $(window).on('load' , function() {
        if($(".navbar-vertical-content li.active").length) {
            $('.navbar-vertical-content').animate({
                scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
            }, 100);
        }
        });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/layouts/vendor/partials/_sidebar.blade.php ENDPATH**/ ?>