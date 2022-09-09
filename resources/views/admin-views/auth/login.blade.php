<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
        $app_name = \App\CentralLogics\Helpers::get_business_settings('business_name', false);
        $icon = \App\CentralLogics\Helpers::get_business_settings('icon', false);
    @endphp
    <!-- Title -->
    <title>{{__('messages.admin')}}  {{__('messages.login')}} | {{$app_name??'STACKFOOD'}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset($icon ? 'storage/app/business/'.$icon : 'favicon.ico')}}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/toastr.css">
</head>

<body>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main auth-bg">
    <!-- Content -->
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="auth-content">
            <div class="content">
                <h2 class="title text-uppercase">{{translate('messages.welcome_to_app',['app_name'=>$app_name??'STACKFOOD'])}}</h2>
                <p>
                    {{translate('Manage your app & website easily')}}
                </p>
            </div>
        </div>
        <div class="auth-wrapper">
            <div class="auth-wrapper-body auth-form-appear">
                @php($systemlogo=\App\Models\BusinessSetting::where(['key'=>'logo'])->first()->value)
                <a class="auth-logo mb-5" href="javascript:">
                    <img class="z-index-2" src="{{asset('/assets/admin/img/zatu.png')}}">
                </a>
                <div class="text-center">
                    <div class="auth-header mb-5">
                        <h2 class="signin-txt">{{__('messages.admin')}} {{__('messages.signin')}}</h2>
                        <p class="text-capitalize">{{__('messages.want')}} {{__('messages.to')}} {{__('messages.login')}} {{__('messages.your')}} {{__('messages.vendors')}}?
                            <a href="{{route('vendor.auth.login')}}" class="text-yellow">
                                {{__('messages.vendor')}} {{__('messages.login')}}
                            </a>
                        </p>
                        {{--<a class="btn btn-lg btn-block btn-white mb-4" href="#">
                            <span class="d-flex justify-content-center align-items-center">
                            <img class="avatar avatar-xss mr-2"
                                src="{{asset('assets/admin')}}/svg/brands/google.svg" alt="Image Description">
                            Sign in with Google
                            </span>
                        </a>
                        <span class="divider text-muted mb-4">OR</span>--}}
                    </div>
                </div>
                <!-- Content -->
                <label class="badge badge-soft-success float-right initial-1">
                    {{__('messages.software_version')}} : {{env('SOFTWARE_VERSION')}}
                </label>
                <!-- Form -->
                <form class="login_form" action="{{route('admin.auth.login')}}" method="post" id="form-id">
                    @csrf
                    <!-- Form Group -->
                    <div class="js-form-message form-group mb-2">
                        <label class="form-label text-capitalize" for="signinSrEmail">{{__('messages.your')}} {{__('messages.email')}}</label>
                        <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                            tabindex="1" aria-label="email@address.com"
                            required data-msg="Please enter a valid email address.">
                        <div class="focus-effects"></div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label text-capitalize" for="signupSrPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                            {{__('messages.password')}}
                            </span>
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                name="password" id="signupSrPassword"
                                aria-label="{{__('messages.password_length_placeholder',['length'=>'6+'])}}" required
                                data-msg="{{__('messages.invalid_password_warning')}}"
                                data-hs-toggle-password-options='{
                                            "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>

                            <div class="focus-effects"></div>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Form Group -->
                        <div class="mb-2"></div>
                    <!-- Checkbox -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                name="remember">
                            <label class="custom-control-label text-muted" for="termsCheckbox">
                                {{__('messages.remember_me')}}
                            </label>
                        </div>
                    </div>
                    <!-- End Checkbox -->

                    {{-- recaptcha --}}
                    @php($recaptcha = \App\CentralLogics\Helpers::get_business_settings('recaptcha'))
                    @if(isset($recaptcha) && $recaptcha['status'] == 1)
                        <div id="recaptcha_element" class="w-100" data-type="image"></div>
                        <br/>
                    @else
                        <div class="row py-2">
                            <div class="col-6 pr-0">
                                <input type="text" class="form-control form-control-lg form-recapcha" name="custome_recaptcha"
                                    id="custome_recaptcha" required placeholder="{{\__('Enter recaptcha value')}}" autocomplete="off" value="{{env('APP_DEBUG')?session('six_captcha'):''}}">
                            </div>
                            <div class="col-6">
                                <div class="capcha--img bg-white rounded">
                                    <img src="<?php echo $custome_recaptcha->inline(); ?>" class="form-control form-control-lg p-0 border-0"/>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-lg btn-block btn-primary">{{__('messages.sign_in')}}</button>
                </form>
                <!-- End Form -->

                <!-- End Content -->
            </div>
            @if(env('APP_MODE')=='demo')
                <div class="auto-fill-data-copy">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <span class="d-block"><strong>Email</strong> : admin@admin.com</span>
                            <span class="d-block"><strong>Password</strong> : 12345678</span>
                        </div>
                        <div>
                            <button class="btn btn-primary m-0" onclick="copy_cred()"><i class="tio-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


<!-- JS Implementing Plugins -->
<script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>

<!-- JS Front -->
<script src="{{asset('assets/admin')}}/js/theme.min.js"></script>
<script src="{{asset('assets/admin')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>

{{-- recaptcha scripts start --}}
@if(isset($recaptcha) && $recaptcha['status'] == 1)
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '{{ \App\CentralLogics\Helpers::get_business_settings('recaptcha')['site_key'] }}'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#form-id").on('submit',function(e) {
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                e.preventDefault();
                toastr.error("{{__('messages.Please check the recaptcha')}}");
            }
        });
    </script>
@endif
{{-- recaptcha scripts end --}}



@if(env('APP_MODE')=='demo')
    <script>
        function copy_cred() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
@endif

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset('/assets/admin')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
