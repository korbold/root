<?php ($currency=\App\Models\BusinessSetting::where(['key'=>'currency'])->first()->value); ?>

    <!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <title>
        <?php echo $__env->yieldContent('title'); ?>
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Viewport-->
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Font -->
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/vendor/icon-set/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/custom.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/style.css">

    <style>
        .stripe-button-el {
            display: none !important;
        }

        .razorpay-payment-button {
            display: none !important;
        }
    </style>
    <script
        src="<?php echo e(asset('public/assets/admin')); ?>/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/toastr.css">
    
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    
</head>
<!-- Body-->
<body>
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <div class="col-md-12 mb-5 pt-5">
            <center class="">
                <h1>Payment method</h1>
            </center>
        </div>
        <?php ($order=\App\Models\Order::find(session('order_id'))); ?>
        <section class="col-lg-12">
            <div class="checkout_details mt-3">
                <div class="row">

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('ssl_commerz_payment')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card" onclick="$('#ssl-form').submit()">
                                <div class="card-body pt-2" style="height: 70px">
                                    <form action="<?php echo e(url('/pay-ssl')); ?>" method="POST" class="needs-validation" id="ssl-form">
                                        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token"/>
                                        <button class="btn btn-block click-if-alone" type="submit">
                                            <img width="100"
                                                 src="<?php echo e(asset('public/assets/admin/img/sslcomz.png')); ?>"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('razor_pay')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pt-1" style="height: 70px">
                                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('razor_pay')); ?>
                                    <?php ($order=\App\Models\Order::find(session('order_id'))); ?>
                                    <form action="<?php echo route('payment-razor',['order_id'=>$order['id']]); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <!-- Note that the amount is in paise = 50 INR -->
                                        <!--amount need to be in paisa-->
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="<?php echo e(Config::get('razor.razor_key')); ?>"
                                                data-amount="<?php echo e($order->order_amount*100); ?>"
                                                data-buttontext="Pay <?php echo e($order->order_amount); ?> <?php echo e(\App\CentralLogics\Helpers::currency_code()); ?>"
                                                data-name="<?php echo e(\App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value); ?>"
                                                data-description="<?php echo e($order['id']); ?>"
                                                data-image="<?php echo e(asset('storage/app/public/business/'.\App\Models\BusinessSetting::where(['key'=>'logo'])->first()->value)); ?>"
                                                data-prefill.name="<?php echo e($order->customer->f_name); ?>"
                                                data-prefill.email="<?php echo e($order->customer->email); ?>"
                                                data-theme.color="#ff7529">
                                        </script>
                                    </form>
                                    <button class="btn btn-block click-if-alone" type="button"
                                            onclick="<?php echo e(\App\CentralLogics\Helpers::currency_code()=='INR'?"$('.razorpay-payment-button').click()":"toastr.error('Your currency is not supported by Razor Pay.')"); ?>">
                                        <img width="100"
                                             src="<?php echo e(asset('public/assets/admin/img/razorpay.png')); ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paypal')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pb-0 pt-1" style="height: 70px">
                                    <form class="needs-validation" method="POST" id="payment-form"
                                          action="<?php echo e(route('pay-paypal')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <button class="btn btn-block click-if-alone" type="submit">
                                            <img width="100"
                                                 src="<?php echo e(asset('public/assets/admin/img/paypal.png')); ?>"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('stripe')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body py-0" style="height: 70px">
                                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('stripe')); ?>
                                    <button class="btn btn-block click-if-alone" type="button" id="checkout-button">
                                        <img width="100" src="<?php echo e(asset('public/assets/admin/img/stripe.png')); ?>"/>
                                    </button>

                                    <script type="text/javascript">
                                        // Create an instance of the Stripe object with your publishable API key
                                        var stripe = Stripe('<?php echo e($config['published_key']); ?>');
                                        var checkoutButton = document.getElementById("checkout-button");
                                        checkoutButton.addEventListener("click", function () {
                                            fetch("<?php echo e(route('pay-stripe')); ?>", {
                                                method: "GET",
                                            }).then(function (response) {
                                                console.log(response)
                                                return response.text();
                                            }).then(function (session) {
                                                console.log(JSON.parse(session).id)
                                                return stripe.redirectToCheckout({sessionId: JSON.parse(session).id});
                                            }).then(function (result) {
                                                if (result.error) {
                                                    alert(result.error.message);
                                                }
                                            }).catch(function (error) {
                                                console.error("Error:", error);
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paystack')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body py-0" style="height: 70px">
                                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paystack')); ?>
                                    <?php ($order=\App\Models\Order::find(session('order_id'))); ?>
                                    <form method="POST" action="<?php echo e(route('paystack-pay')); ?>" accept-charset="UTF-8"
                                          class="form-horizontal"
                                          role="form">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <input type="hidden" name="email"
                                                       value="<?php echo e($order->customer->email!=null?$order->customer->email:'required@email.com'); ?>"> 
                                                <input type="hidden" name="orderID" value="<?php echo e($order['id']); ?>">
                                                <input type="hidden" name="amount"
                                                       value="<?php echo e($order['order_amount']*100); ?>"> 
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="currency"
                                                       value="<?php echo e($currency); ?>">
                                                <input type="hidden" name="metadata"
                                                       value="<?php echo e(json_encode($array = ['key_name' => 'value',])); ?>"> 
                                                <input type="hidden" name="reference"
                                                       value="<?php echo e(Paystack::genTranxRef()); ?>"> 
                                                <p>
                                                    <button class="paystack-payment-button" style="display: none"
                                                            type="submit"
                                                            value="Pay Now!"></button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                    <button class="btn btn-block click-if-alone" type="button"
                                            onclick="$('.paystack-payment-button').click()">
                                        <img width="100"
                                             src="<?php echo e(asset('public/assets/admin/img/paystack.png')); ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('senang_pay')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pt-1" style="height: 70px">
                                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('senang_pay')); ?>
                                    <?php ($user=\App\Models\User::where(['id'=>$order['user_id']])->first()); ?>
                                    <?php ($secretkey = $config['secret_key']); ?>
                                    <?php ($data = new \stdClass()); ?>
                                    <?php ($data->merchantId = $config['merchant_id']); ?>
                                    <?php ($data->detail = 'payment'); ?>
                                    <?php ($data->order_id = $order->id); ?>
                                    <?php ($data->amount = $order->order_amount); ?>
                                    <?php ($data->name = $user->f_name.' '.$user->l_name); ?>
                                    <?php ($data->email = $user->email); ?>
                                    <?php ($data->phone = $user->phone); ?>
                                    <?php ($data->hashed_string = md5($secretkey . urldecode($data->detail) . urldecode($data->amount) . urldecode($data->order_id))); ?>

                                    <form name="order" method="post"
                                          action="https://<?php echo e(env('APP_MODE')=='live'?'app.senangpay.my':'sandbox.senangpay.my'); ?>/payment/<?php echo e($config['merchant_id']); ?>">
                                        <input type="hidden" name="detail" value="<?php echo e($data->detail); ?>">
                                        <input type="hidden" name="amount" value="<?php echo e($data->amount); ?>">
                                        <input type="hidden" name="order_id" value="<?php echo e($data->order_id); ?>">
                                        <input type="hidden" name="name" value="<?php echo e($data->name); ?>">
                                        <input type="hidden" name="email" value="<?php echo e($data->email); ?>">
                                        <input type="hidden" name="phone" value="<?php echo e($data->phone); ?>">
                                        <input type="hidden" name="hash" value="<?php echo e($data->hashed_string); ?>">
                                    </form>

                                    <button class="btn btn-block click-if-alone" type="button"
                                            onclick="<?php echo e(\App\CentralLogics\Helpers::currency_code()=='MYR'?"document.order.submit()":"toastr.error('Your currency is not supported by Senang Pay.')"); ?>">
                                        <img width="100"
                                             src="<?php echo e(asset('public/assets/admin/img/senangpay.png')); ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('flutterwave')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pt-2" style="height: 70px">
                                    <form method="POST" action="<?php echo e(route('flutterwave_pay')); ?>">
                                        <?php echo e(csrf_field()); ?>


                                        <button class="btn btn-block click-if-alone" type="submit">
                                            <img width="200"
                                                 src="<?php echo e(asset('public/assets/admin/img/fluterwave.png')); ?>"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('mercadopago')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pt-2" style="height: 70px">
                                    <a class="btn btn-block click-if-alone" href="<?php echo e(route('mercadopago.index')); ?>">
                                        <img width="150"
                                                src="<?php echo e(asset('public/assets/admin/img/MercadoPago_(Horizontal).svg')); ?>"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paymob_accept')); ?>
                    <?php if($config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body" style="height: 100px">
                                    <form class="needs-validation" method="POST" id="payment-form-paymob"
                                        action="<?php echo e(route('paymob-credit')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <button class="btn btn-block click-if-alone" type="submit">
                                            <img width="150"
                                                src="<?php echo e(asset('public/assets/admin/img/paymob.png')); ?>"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('bkash')); ?>
                    <?php if(isset($config)  && $config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body" style="height: 100px">
                                    <button class="btn btn-block click-if-alone" id="bKash_button" onclick="BkashPayment()">
                                        <img width="100" src="<?php echo e(asset('public/assets/admin/img/bkash.png')); ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paytabs')); ?>
                    <?php if(isset($config)  && $config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body" style="height: 100px">
                                    <button class="btn btn-block click-if-alone" onclick="location.href='<?php echo e(route('paytabs-payment')); ?>'" style="margin-top: -11px">
                                        <img width="150" src="<?php echo e(asset('public/assets/admin/img/paytabs.png')); ?>"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('paytm')); ?>
                    <?php if(isset($config) && $config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body" style="height: 100px">
                                    <a class="btn btn-block click-if-alone" href="<?php echo e(route('paytm-payment')); ?>">
                                        <img style="max-width: 150px; margin-top: -10px"
                                            src="<?php echo e(asset('public/assets/admin/img/paytm.png')); ?>"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php ($config=\App\CentralLogics\Helpers::get_business_settings('liqpay')); ?>
                    <?php if(isset($config) && $config['status']): ?>
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body" style="height: 100px">
                                    <a class="btn btn-block click-if-alone" href="<?php echo e(route('liqpay-payment')); ?>">
                                        <img style="max-width: 150px; margin-top: 0px"
                                            src="<?php echo e(asset('public/assets/admin/img/liqpay4.png')); ?>"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- JS Front -->
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/vendor.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/sweet_alert.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/toastr.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/bootstrap.min.js"></script>

<?php echo Toastr::message(); ?>




<script>
    setTimeout(function () {
        $('.stripe-button-el').hide();
        $('.razorpay-payment-button').hide();
    }, 10)
</script>

<?php if(env('APP_MODE')=='live'): ?>
    <script id="myScript"
            src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
<?php else: ?>
    <script id="myScript"
            src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
<?php endif; ?>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    function BkashPayment() {
        $('#loading').show();
        // get token
        $.ajax({
            url: "<?php echo e(route('bkash-get-token')); ?>",
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                $('#loading').hide();
                $('pay-with-bkash-button').trigger('click');
                if (data.hasOwnProperty('msg')) {
                    showErrorMessage(data) // unknown error
                }
            },
            error: function (err) {
                $('#loading').hide();
                showErrorMessage(err);
            }
        });
    }

    let paymentID = '';
    bKash.init({
        paymentMode: 'checkout',
        paymentRequest: {},
        createRequest: function (request) {
            setTimeout(function () {
                createPayment(request);
            }, 2000)
        },
        executeRequestOnAuthorization: function (request) {
            $.ajax({
                url: '<?php echo e(route('bkash-execute-payment')); ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    "paymentID": paymentID
                }),
                success: function (data) {
                    if (data) {
                        if (data.paymentID != null) {
                            BkashSuccess(data);
                        } else {
                            showErrorMessage(data);
                            bKash.execute().onError();
                        }
                    } else {
                        $.get('<?php echo e(route('bkash-query-payment')); ?>', {
                            payment_info: {
                                payment_id: paymentID
                            }
                        }, function (data) {
                            if (data.transactionStatus === 'Completed') {
                                BkashSuccess(data);
                            } else {
                                createPayment(request);
                            }
                        });
                    }
                },
                error: function (err) {
                    bKash.execute().onError();
                }
            });
        },
        onClose: function () {
            // for error handle after close bKash Popup
        }
    });

    function createPayment(request) {
        // because of createRequest function finds amount from this request
        request['amount'] = "<?php echo e(round($order->order_amount,2)); ?>"; // max two decimal points allowed
        $.ajax({
            url: '<?php echo e(route('bkash-create-payment')); ?>',
            data: JSON.stringify(request),
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                $('#loading').hide();
                if (data && data.paymentID != null) {
                    paymentID = data.paymentID;
                    bKash.create().onSuccess(data);
                } else {
                    bKash.create().onError();
                }
            },
            error: function (err) {
                $('#loading').hide();
                showErrorMessage(err.responseJSON);
                bKash.create().onError();
            }
        });
    }

    function BkashSuccess(data) {
        $.post('<?php echo e(route('bkash-success')); ?>', {
            payment_info: data
        }, function (res) {
            location.href = '<?php echo e(route('payment-success')); ?>';
        });
    }

    function showErrorMessage(response) {
        let message = 'Unknown Error';
        if (response.hasOwnProperty('errorMessage')) {
            let errorCode = parseInt(response.errorCode);
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
            ];
            if (bkashErrorCode.includes(errorCode)) {
                message = response.errorMessage
            }
        }
        Swal.fire("Payment Failed!", message, "error");
    }
</script>

<script>
    function click_if_alone() {
        let total = $('.checkout_details .click-if-alone').length;
        if (Number.parseInt(total) == 1) {
            $('.click-if-alone')[0].click()
            $('.checkout_details').html('<div class="text-center"><h1><?php echo e(translate('messages.Redirecting_to_the_payment_page')); ?>......</h1></div>');
        }
    }
    <?php if(!Session::has('toastr::messages')): ?>
        click_if_alone();
    <?php endif; ?>
</script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/payment-view.blade.php ENDPATH**/ ?>