<?php $__env->startSection('title', translate('messages.pos')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

        <!-- Content -->
<div class="initial-51">
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y-sm bg-default mt-1">
        <div class="container-fluid content">
            <div class="d-flex flex-wrap">
                <div class="order--pos-left">
                    <div class="card padding-y-sm card h-100">
                        <div class="card-header bg-light border-0">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-fastfood"></i>
                                </span>
                                <span>
                                    <?php echo e(translate('food_section')); ?>

                                </span>
                            </h5>
                        </div>
                        <div class="card-header border-0 pt-4">
                            <div class="w-100">
                                <div class="row g-3 justify-content-around">
                                    <div class="col-sm-6">
                                        <select name="zone_id" class="form-control js-select2-custom h--45x"
                                            onchange="set_zone_filter('<?php echo e(url()->full()); ?>',this.value,'zone_id')"
                                            id="zone_id">
                                            <option value="" selected disabled><?php echo e(translate('Select Zone')); ?> <span>*</span></option>
                                            <?php $__currentLoopData = \App\Models\Zone::active()->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($z['id']); ?>"
                                                    <?php echo e(isset($zone) && $zone->id == $z['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($z['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="restaurant_id" onchange="set_restaurant_filter('<?php echo e(url()->full()); ?>',this.value,'restaurant_id')" data-placeholder="<?php echo e(translate('messages.select')); ?> <?php echo e(translate('messages.restaurant')); ?>" class="form-control js-select2-custom h--45x" id="restaurant_id" disabled>

                                            <option value=""><?php echo e(translate('Select a restaurant')); ?></option>
                                            <?php $__currentLoopData = \App\Models\Restaurant::active()->orderBy('name')->where('zone_id',request('zone_id'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($restaurant['id']); ?>" <?php echo e(request('restaurant_id') && request('restaurant_id')==$restaurant->id? 'selected':''); ?>>
                                                    <?php echo e($restaurant->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="category" id="category" class="form-control js-select2-custom mx-1 h--45x"
                                            title="<?php echo e(translate('Select')); ?> <?php echo e(translate('Category')); ?>"
                                            onchange="set_category_filter(this.value)" disabled>
                                            <option value="" selected><?php echo e(translate('Select Categories')); ?></option>
                                            <option value=""><?php echo e(translate('All Categories')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"
                                                    <?php echo e($category == $item->id ? 'selected' : ''); ?>>
                                                    <?php echo e(Str::limit($item->name, 20, '...')); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <form id="search-form" class="mw-100">
                                            <!-- Search -->
                                            <div class="input-group input-group-merge input-group-flush w-100">
                                                <div class="input-group-prepend pl-2">
                                                    <div class="input-group-text">
                                                        <i class="tio-search"></i>
                                                    </div>
                                                </div>
                                                <input id="datatableSearch" type="search"
                                                    value="<?php echo e($keyword ? $keyword : ''); ?>" name="search"
                                                    class="form-control flex-grow-1 pl-5 border rounded h--45x"
                                                    placeholder="Ex : Search Food Name"
                                                    aria-label="<?php echo e(translate('messages.search_here')); ?>" disabled>
                                            </div>
                                            <!-- End Search -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center" id="items">
                            <!-- Please Make a condition that if no data then row also disapear -->
                            <?php if(!$products->isEmpty()): ?>
                            <div class="row g-3 mb-auto">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="order--item-box item-box col-auto">
                                        <?php echo $__env->make('admin-views.pos._single_product', [
                                            'product' => $product,
                                            'restaurant_data ' => $restaurant_data,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php else: ?>
                            <!-- Static -->
                            <div class="my-auto">
                                <div class="search--no-found">
                                    <img src="<?php echo e(asset('/public/assets/admin/img/search-icon.png')); ?>" alt="img">
                                    <p>
                                        <?php echo e(translate('messages.food_search_text_pos')); ?>

                                    </p>
                                </div>
                            </div>
                            <!-- Static -->
                        <?php endif; ?>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <?php echo $products->withQueryString()->links(); ?>

                        </div>
                    </div>
                </div>
                <div class="order--pos-right">
                    <div class="card">
                        <div class="card-header bg-light border-0 m-1">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-money-vs"></i>
                                </span>
                                <span>
                                    <?php echo e(translate('messages.billing_section')); ?>

                                </span>
                            </h5>
                        </div>
                        <div class="w-100">
                            <div class="d-flex flex-wrap flex-row p-2 add--customer-btn">
                                <select id="customer" name="customer_id"
                                        data-placeholder="<?php echo e(translate('messages.select_customer')); ?>"
                                        class="js-data-example-ajax form-control">
                                    </select>
                                <button class="btn btn--primary rounded font-regular" id="add_new_customer"
                                    type="button" data-toggle="modal" data-target="#add-customer"
                                    title="Add Customer">
                                    <?php echo e(translate('Add new customer')); ?>

                                </button>
                            </div>
                        </div>
                        <div class="pos--delivery-options">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">
                                    <span class="card-title-icon">
                                        <i class="tio-user"></i>
                                    </span>
                                    <span><?php echo e(translate('Delivery Infomation')); ?> <small>(<?php echo e(translate('Home Delivery')); ?>)</small></span>
                                </h5>
                                <span class="delivery--edit-icon text-primary" id="delivery_address" data-toggle="modal" data-target="#paymentModal"><i class="tio-edit"></i></span>
                            </div>
                                <div class="pos--delivery-options-info d-flex flex-wrap" id="del-add">
                                    <?php echo $__env->make('admin-views.pos._address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                        </div>
                        <div class='w-100' id="cart">
                            <?php echo $__env->make('admin-views.pos._cart', ['restaurant_data ' => $restaurant_data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- container //  -->
    </section>

    <!-- End Content -->
    <div class="modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-view-modal">
            </div>
        </div>
    </div>

    <?php ($order = \App\Models\Order::with(['details', 'restaurant' => function ($query) {
        return $query->withCount('orders');
    }, 'customer' => function ($query) {
        return $query->withCount('orders');
    }, 'details.food' => function ($query) {
        return $query->withoutGlobalScope(\App\Scopes\RestaurantScope::class);
    }])->find(session('last_order'))); ?>
    <?php if($order): ?>
        <?php (session(['last_order' => false])); ?>
        <div class="modal fade" id="print-invoice" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(translate('messages.print')); ?> <?php echo e(translate('messages.invoice')); ?>

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row ff-emoji">
                        <div class="col-md-12">
                            <center>
                                <input type="button" class="btn text-white btn--primary non-printable"
                                    onclick="printDiv('printableArea')"
                                    value="Proceed, If thermal printer is ready." />
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable">Back</a>
                            </center>
                            <hr class="non-printable">
                        </div>
                        <div class="row m-auto" id="printableArea">
                            <?php echo $__env->make('admin-views.pos.order.invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="modal fade" id="add-customer" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light py-3">
                    <h4 class="modal-title"><?php echo e(translate('add_new_customer')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.pos.customer-store')); ?>" method="post" id="product_form">
                        <?php echo csrf_field(); ?>
                        <div class="row pl-2">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(translate('first_name')); ?> <span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" name="f_name" class="form-control"
                                        value="<?php echo e(old('f_name')); ?>"
                                        placeholder="<?php echo e(translate('first_name')); ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(translate('last_name')); ?> <span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" name="l_name" class="form-control"
                                        value="<?php echo e(old('l_name')); ?>" placeholder="<?php echo e(translate('last_name')); ?>"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-2">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(translate('email')); ?><span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo e(old('email')); ?>"
                                        placeholder="<?php echo e(translate('Ex_:_ex@example.com')); ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(translate('phone')); ?>

                                        (<?php echo e(translate('with_country_code')); ?>)<span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control"
                                        value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(translate('phone')); ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Static -->
                        
                        <!-- Static -->

                        <div class="btn--container justify-content-end">
                            <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                            <button type="submit" id="submit_new_customer" class="btn btn--primary"><?php echo e(translate('save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&libraries=places&callback=initMap&v=3.49">
    </script>
    <script>
        function initMap() {
            let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: {
                    lat: <?php echo e($restaurant_data ? $restaurant_data['latitude'] : '23.757989'); ?>,
                    lng: <?php echo e($restaurant_data ? $restaurant_data['longitude'] : '90.360587'); ?>

                }
            });

            let zonePolygon = null;

            //get current location block
            let infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        myLatlng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        infoWindow.setPosition(myLatlng);
                        infoWindow.setContent("Location found.");
                        infoWindow.open(map);
                        map.setCenter(myLatlng);
                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            //-----end block------
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            let markers = [];
            const bounds = new google.maps.LatLngBounds();
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    console.log(place.geometry.location);
                    if(!google.maps.geometry.poly.containsLocation(
                        place.geometry.location,
                        zonePolygon
                    )){
                        toastr.error('<?php echo e(translate('messages.out_of_coverage')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        return false;
                    }

                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
            <?php if($restaurant_data): ?>
                $.get({
                    url: '<?php echo e(url('/')); ?>/admin/zone/get-coordinates/<?php echo e($restaurant_data->zone_id); ?>',
                    dataType: 'json',
                    success: function(data) {
                        zonePolygon = new google.maps.Polygon({
                            paths: data.coordinates,
                            strokeColor: "#FF0000",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: 'white',
                            fillOpacity: 0,
                        });
                        zonePolygon.setMap(map);
                        zonePolygon.getPaths().forEach(function(path) {
                            path.forEach(function(latlng) {
                                bounds.extend(latlng);
                                map.fitBounds(bounds);
                            });
                        });
                        map.setCenter(data.center);
                        google.maps.event.addListener(zonePolygon, 'click', function(mapsMouseEvent) {
                            infoWindow.close();
                            // Create a new InfoWindow.
                            infoWindow = new google.maps.InfoWindow({
                                position: mapsMouseEvent.latLng,
                                content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                                    2),
                            });
                            var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                            var coordinates = JSON.parse(coordinates);

                            document.getElementById('latitude').value = coordinates['lat'];
                            document.getElementById('longitude').value = coordinates['lng'];
                            infoWindow.open(map);

                            var geocoder = geocoder = new google.maps.Geocoder();
                            var latlng = new google.maps.LatLng( coordinates['lat'], coordinates['lng'] ) ;

                            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (results[1]) {
                                        var address = results[1].formatted_address;
                                        // initialize services
                                        const geocoder = new google.maps.Geocoder();
                                        const service = new google.maps.DistanceMatrixService();
                                        // build request
                                        const origin1 = { lat: <?php echo e($restaurant_data['latitude']); ?>, lng: <?php echo e($restaurant_data['longitude']); ?> };
                                        const origin2 = "<?php echo e($restaurant_data->address); ?>";
                                        const destinationA = address;
                                        const destinationB = { lat: coordinates['lat'], lng: coordinates['lng'] };
                                        const request = {
                                            origins: [origin1, origin2],
                                            destinations: [destinationA, destinationB],
                                            travelMode: google.maps.TravelMode.DRIVING,
                                            unitSystem: google.maps.UnitSystem.METRIC,
                                            avoidHighways: false,
                                            avoidTolls: false,
                                        };

                                        // get distance matrix response
                                        service.getDistanceMatrix(request).then((response) => {
                                            // put response
                                            var distancMeter = response.rows[0].elements[0].distance['value'];
                                            console.log(distancMeter);
                                            var distanceMile = distancMeter/1000;
                                            var distancMileResult = Math.round((distanceMile + Number.EPSILON) * 100) / 100;
                                            console.log(distancMileResult);
                                            <?php
                                            $per_km_shipping_charge = (float)\App\Models\BusinessSetting::where(['key' => 'per_km_shipping_charge'])->first()->value;
                                            $minimum_shipping_charge = (float)\App\Models\BusinessSetting::where(['key' => 'minimum_shipping_charge'])->first()->value;
                                            // $original_delivery_charge = ($request->distance * $per_km_shipping_charge > $minimum_shipping_charge) ? $request->distance * $per_km_shipping_charge : $minimum_shipping_charge;

                                            ?>

                                            var original_delivery_charge = (distancMileResult * <?php echo e($per_km_shipping_charge); ?> > <?php echo e($minimum_shipping_charge); ?>) ? distancMileResult * <?php echo e($per_km_shipping_charge); ?> : <?php echo e($minimum_shipping_charge); ?>;
                                            var delivery_charge =Math.round((original_delivery_charge + Number.EPSILON) * 100) / 100;
                                            document.getElementById('delivery_fee').value = delivery_charge;
                                            $('#delivery_fee').siblings('strong').html(delivery_charge + '<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>');

                                            console.log(Math.round((original_delivery_charge + Number.EPSILON) * 100) / 100);
                                        });

                                    }
                                }
                            });
                        });
                    },
                });
            <?php endif; ?>

        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: <?php echo e(translate('The Geolocation service failed')); ?>." :
                "Error: <?php echo e(translate("Your browser doesn't support geolocation")); ?>."
            );
            infoWindow.open(map);
        }

        $("#order_place").on('keydown', function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        })
    </script>

    <script>
        $(document).on('ready', function() {
            <?php if($order): ?>
                $('#print-invoice').modal('show');
            <?php endif; ?>
        });

        function set_zone_filter(url, id) {
            var nurl = new URL(url);
            nurl.searchParams.set('zone_id', id);
            location.href = nurl;
        }

        function set_restaurant_filter(url, id) {
            var nurl = new URL(url);
            nurl.searchParams.set('restaurant_id', id);
            location.href = nurl;
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

        function set_category_filter(id) {
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('category_id', id);
            location.href = nurl;
        }
        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        }
        function checkZone() {
            var zone = getUrlParameter('zone_id');
            if(zone){
                $('#restaurant_id').prop("disabled", false);
            }
        }

        checkZone();
        function checkRestZone() {
            var zone = getUrlParameter('zone_id');
            var restaurant_id = getUrlParameter('restaurant_id');
            if(zone && restaurant_id){
                $('#category').prop("disabled", false);
                $('#datatableSearch').prop("disabled", false);
            }
        }

        checkRestZone();

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var keyword = $('#datatableSearch').val();
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('keyword', keyword);
            location.href = nurl;
        });

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

        function set_filter(url, id, filter_by) {
            var nurl = new URL(url);
            nurl.searchParams.set(filter_by, id);
            location.href = nurl;
        }

        function quickView(product_id) {
            $.get({
                url: '<?php echo e(route('admin.pos.quick-view')); ?>',
                dataType: 'json',
                data: {
                    product_id: product_id
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    //console.log("success...")
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function quickViewCartItem(product_id, item_key) {
            $.get({
                url: '<?php echo e(route('admin.pos.quick-view-cart-item')); ?>',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    item_key: item_key
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

        function checkAddToCartValidity() {
            var names = {};
            $('#add-to-cart-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if ($('#add-to-cart-form input:radio:checked').length == count) {
                return true;
            }
            return false;
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
            if ($('#add-to-cart-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('admin.pos.variant_price')); ?>',
                    data: $('#add-to-cart-form').serializeArray(),
                    success: function(data) {
                        $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                        $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                    }
                });
            }
        }

        function addToCart(form_id = 'add-to-cart-form') {
            if (checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.post({
                    url: '<?php echo e(route('admin.pos.add-to-cart')); ?>',
                    data: $('#' + form_id).serializeArray(),
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        if (data.data == 1) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Cart',
                                text: "<?php echo e(translate('messages.product_already_added_in_cart')); ?>"
                            });
                            return false;
                        } else if (data.data == 2) {
                            updateCart();
                            Swal.fire({
                                icon: 'info',
                                title: 'Cart',
                                text: "<?php echo e(translate('messages.product_has_been_updated_in_cart')); ?>"
                            });

                            return false;
                        } else if (data.data == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cart',
                                text: 'Sorry, product out of stock.'
                            });
                            return false;
                        }
                        $('.call-when-done').click();

                        toastr.success('<?php echo e(translate('messages.product_has_been_added_in_cart')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });

                        updateCart();
                    },
                    complete: function() {
                        $('#loading').hide();
                    }
                });
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'Cart',
                    text: 'Please choose all the options'
                });
            }
        }
        function deliveryAdressStore(form_id = 'delivery_address_store') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.pos.add-delivery-address')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        $('#del-add').empty().html(data.view);
                    }
                    updateCart();
                    $('.call-when-done').click();
                },
                complete: function() {
                    $('#loading').hide();
                    $('#paymentModal').modal('hide');
                }
            });
        }
        function payableAmount(form_id = 'payable_store_amount') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.pos.paid')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    // if (data.data) {
                    //     $('#del-add').empty().html(data.view);
                    // }
                    updateCart();
                    $('.call-when-done').click();
                },
                complete: function() {
                    $('#loading').hide();
                    $('#insertPayableAmount').modal('hide');
                }
            });
        }

        function removeFromCart(key) {
            $.post('<?php echo e(route('admin.pos.remove-from-cart')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                key: key
            }, function(data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    updateCart();
                    toastr.info('<?php echo e(translate('messages.item_has_been_removed_from_cart')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }

            });
        }

        function emptyCart() {
            $.post('<?php echo e(route('admin.pos.emptyCart')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>'
            }, function(data) {
                $('#del-add').empty();
                updateCart();
                toastr.info('Item has been removed from cart', {
                    CloseButton: true,
                    ProgressBar: true
                });
            });
        }

        function updateCart() {
            $.post('<?php echo e(route('admin.pos.cart_items')); ?>?restaurant_id=<?php echo e(request('restaurant_id')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>'
            }, function(data) {
                $('#cart').empty().html(data);
            });
        }

        $(function() {
            $(document).on('click', 'input[type=number]', function() {
                this.select();
            });
        });


        function updateQuantity(e) {
            var element = $(e.target);
            var minValue = parseInt(element.attr('min'));
            // maxValue = parseInt(element.attr('max'));
            var valueCurrent = parseInt(element.val());

            var key = element.data('key');
            if (valueCurrent >= minValue) {
                $.post('<?php echo e(route('admin.pos.updateQuantity')); ?>', {
                    _token: '<?php echo e(csrf_token()); ?>',
                    key: key,
                    quantity: valueCurrent
                }, function(data) {
                    updateCart();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cart',
                    text: 'Sorry, the minimum value was reached'
                });
                element.val(element.data('oldValue'));
            }

            // Allow: backspace, delete, tab, escape, enter and .
            if (e.type == 'keydown') {
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
            }

        };

        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function() {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        $('#customer').select2({
            ajax: {
                url: '<?php echo e(route('admin.pos.customers')); ?>',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                __port: function(params, success, failure) {
                    var $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                }
            }
        });

        $("#customer").change(function() {
            if ($(this).val()) {
                $('#customer_id').val($(this).val());
            }
        });



        $('#delivery_address').on('click', function() {
            console.log('delivery_address clicked');
            initMap();
        });
        initMap();
    </script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/pos/index.blade.php ENDPATH**/ ?>