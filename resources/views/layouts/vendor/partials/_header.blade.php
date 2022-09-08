<div id="headerMain" class="d-none">
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo Div-->
                @php($restaurant_logo=\App\CentralLogics\Helpers::get_restaurant_data()->logo)
                <a class="navbar-brand" href="{{route('vendor.dashboard')}}" aria-label="">
                    <img class="navbar-brand-logo"
                         style="border-radius: 50%;height: 47px;width: 47px!important; border: 5px solid #80808012"
                         onerror="this.src='{{asset('assets/admin/img/160x160/img1.jpg')}}'"
                         src="{{asset('storage/app/restaurant/'.$restaurant_logo)}}" alt="Logo">
                    <img class="navbar-brand-logo-mini"
                         style="border-radius: 50%;height: 47px;width: 47px!important; border: 5px solid #80808012"
                         onerror="this.src='{{asset('assets/admin/img/160x160/img1.jpg')}}'"
                         src="{{asset('storage/app/restaurant/'.$restaurant_logo)}}"
                         alt="Logo">
                </a>
                <!-- End Logo -->
            </div>
            <div class="navbar-nav-wrap-content-left ml-auto d--xl-none">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                    data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                    data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
            </div>


            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right flex-grow-1">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row justify-content-end">
                    <li class="nav-item d-none d-sm-inline-block mr-4">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-soft-secondary rounded-circle"
                               href="{{route('vendor.message.list')}}">
                                <i class="tio-messages-outlined"></i>
                                @php($message=\App\Models\Conversation::whereUser(\App\CentralLogics\Helpers::get_loggedin_user()->id)->where('unread_message_count','>','0')->count())
                                @if($message!=0)
                                    <span class="btn-status btn-sm-status btn-status-danger"></span>
                                @endif
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>
                    <li class="nav-item">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon navbar--cart btn-soft-secondary rounded-circle"
                               href="{{route('vendor.order.list',['status'=>'pending'])}}">
                                <i class="tio-shopping-basket-outlined"></i>
                                {{--<span class="btn-status btn-sm-status btn-status-danger"></span>--}}
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                    <li class="nav-item nav--item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper p-0" href="javascript:;"
                               data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>

                                <div class="cmn--media right-dropdown-icon d-flex align-items-center">
                                    <div class="media-body pl-0 pr-2">
                                        <span class="card-title h5 text-right pr-2">
                                            {{\App\CentralLogics\Helpers::get_loggedin_user()->f_name}}
                                        </span>
                                        <span class="card-text card--text">{{\App\CentralLogics\Helpers::get_loggedin_user()->email}}</span>
                                    </div>
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" onerror="this.src='{{asset('assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/vendor')}}/{{\App\CentralLogics\Helpers::get_loggedin_user()->image}}"
                                        alt="Image Description">
                                        <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                    </div>
                                </div>

                            </a>

                            <div id="accountNavbarDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                                 style="width: 16rem;">
                                <div class="dropdown-item-text">
                                    <div class="media cmn--media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                 onerror="this.src='{{asset('assets/admin/img/160x160/img1.jpg')}}'"
                                                 src="{{asset('storage/app/vendor')}}/{{\App\CentralLogics\Helpers::get_loggedin_user()->image}}"
                                                 alt="Owner image">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{\App\CentralLogics\Helpers::get_loggedin_user()->f_name}}</span>
                                            <span class="card-text">{{\App\CentralLogics\Helpers::get_loggedin_user()->email}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{route('vendor.profile.view')}}">
                                    <span class="text-truncate pr-2" title="Settings">{{__('messages.settings')}}</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: 'Do you want to logout?',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#FC6A57',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `Yes`,
                                    denyButtonText: `Don't Logout`,
                                    }).then((result) => {
                                    if (result.value) {
                                        @if(auth('vendor')->check())
                                        location.href='{{route('vendor.auth.logout')}}';
                                        @elseif (auth('vendor_employee')->check())
                                        location.href='{{route('vendor.auth.employee.logout')}}';
                                        @endif
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">{{__('messages.sign_out')}}</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
