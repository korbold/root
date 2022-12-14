<?php $__env->startSection('title', 'Update restaurant info'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        #map {
            height: 350px;
        }

        @media  only screen and (max-width: 768px) {

            /* For mobile phones: */
            #map {
                height: 200px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title"><div class="card-header-icon"><i class="tio-edit"></i></div> <?php echo e(__('messages.update')); ?>

                        <?php echo e(__('messages.restaurant')); ?></h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div id="vendor_form" class="form-container">
                    <form action="<?php echo e(route('admin.vendor.update', [$restaurant['id']])); ?>" method="post"
                        class="js-validate" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="card-header-icon">
                                    <i class="tio-museum"></i> <?php echo e(__('messages.restaurant')); ?>

                                                <?php echo e(__('messages.info')); ?>

                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="name"><?php echo e(__('messages.restaurant')); ?>

                                            <?php echo e(__('messages.name')); ?></label>
                                        <input id="name" type="text" name="name" class="form-control h--45px"
                                            placeholder="<?php echo e(__('messages.first')); ?> <?php echo e(__('messages.name')); ?>" required
                                            value="<?php echo e($restaurant->name); ?>">
                                    </div>

                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="address"><?php echo e(__('messages.vat/tax')); ?> (%)</label>
                                        <input id="tax" type="number" name="tax" class="form-control h--45px"
                                            placeholder="<?php echo e(__('messages.vat/tax')); ?>" min="0" step=".01" required
                                            value="<?php echo e($restaurant->tax); ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label" for="address"><?php echo e(__('messages.restaurant')); ?>

                                            <?php echo e(__('messages.address')); ?></label>
                                        <input id="address" type="text"  name="address" class="form-control" placeholder="<?php echo e(__('messages.restaurant')); ?> <?php echo e(__('messages.address')); ?>" value="<?php echo e($restaurant->address); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="minimum_delivery_time"><?php echo e(__('messages.minimum_delivery_time')); ?></label>
                                        <input id="minimum_delivery_time" type="number" name="minimum_delivery_time" class="form-control h--45px" placeholder="30"
                                            pattern="^[0-9]{2}$" required
                                            value="<?php echo e(explode('-', $restaurant->delivery_time)[0]); ?>">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="maximum_delivery_time"><?php echo e(__('messages.maximum_delivery_time')); ?></label>
                                        <input id="maximum_delivery_time" type="number" name="maximum_delivery_time" class="form-control h--45px" placeholder="40"
                                            pattern="[0-9]{2}" required
                                            value="<?php echo e(explode('-', $restaurant->delivery_time)[1]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 pt-lg-3">
                                <div class="col-md-6 col-lg-4 col-12">
                                    <center>
                                        <img style="max-width: 100%;border: 1px solid #f4f4f4; border-radius: 10px; max-height:100px;margin-bottom:10px;"
                                            id="viewer"
                                            onerror="this.src='<?php echo e(asset('public/assets/admin/img/100x100/restaurant-default-image.png')); ?>'"
                                            src="<?php echo e(asset('storage/app/public/restaurant/' . $restaurant->logo)); ?>"
                                            alt="Product thumbnail" />
                                    </center>

                                    <div class="form-group">
                                        <label class="input-label"><?php echo e(__('messages.restaurant')); ?>

                                            <?php echo e(__('messages.logo')); ?><small style="color: red"> (
                                                <?php echo e(__('messages.ratio')); ?> <?php echo e(translate('messages.1:1')); ?>

                                                )</small></label>
                                        <div class="custom-file">
                                            <input type="file" name="logo" id="customFileEg1" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label" for="customFileEg1"><?php echo e(__('messages.choose')); ?>

                                                <?php echo e(__('messages.file')); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-12">
                                    <div class="cover-photo">
                                        <center>
                                            <img style="max-width: 100%;border: 1px solid #f4f4f4; border-radius: 10px; max-height:100px;margin-bottom:10px;"
                                                id="coverImageViewer"
                                                onerror="this.src='<?php echo e(asset('public/assets/admin/img/300x100/restaurant-default-image.png')); ?>'"
                                                src="<?php echo e(asset('storage/app/public/restaurant/cover/' . $restaurant->cover_photo)); ?>"
                                                alt="Product thumbnail" />
                                        </center>

                                        <div class="form-group">
                                            <label for="name"><?php echo e(__('messages.upload')); ?> <?php echo e(__('messages.cover')); ?>

                                                <?php echo e(__('messages.photo')); ?> <span
                                                    class="text-danger">(<?php echo e(__('messages.ratio')); ?>

                                                    <?php echo e(translate('messages.2:1')); ?>)</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="cover_photo" id="coverImageUpload"
                                                    class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                <label class="custom-file-label"
                                                    for="customFileUpload"><?php echo e(__('messages.choose')); ?>

                                                    <?php echo e(__('messages.file')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label" for="choice_zones"><?php echo e(__('messages.zone')); ?><span
                                                class="input-label-secondary"
                                                title="<?php echo e(__('messages.select_zone_for_map')); ?>"><img
                                                    src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                    alt="<?php echo e(__('messages.select_zone_for_map')); ?>"></span></label>
                                        <select name="zone_id" id="choice_zones" onchange="get_zone_data(this.value)"
                                            data-placeholder="<?php echo e(__('messages.select')); ?> <?php echo e(__('messages.zone')); ?>"
                                            class="form-control h--45px js-select2-custom">
                                            <?php $__currentLoopData = \App\Models\Zone::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                                    <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                        <option value="<?php echo e($zone->id); ?>"
                                                            <?php echo e($restaurant->zone_id == $zone->id ? 'selected' : ''); ?>>
                                                            <?php echo e($zone->name); ?></option>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($zone->id); ?>"
                                                        <?php echo e($restaurant->zone_id == $zone->id ? 'selected' : ''); ?>>
                                                        <?php echo e($zone->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(__('messages.latitude')); ?><span
                                                class="input-label-secondary"
                                                title="<?php echo e(__('messages.restaurant_lat_lng_warning')); ?>"><img
                                                    src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                    alt="<?php echo e(__('messages.restaurant_lat_lng_warning')); ?>"></span></label>
                                        <input type="text" name="latitude" class="form-control h--45px" id="latitude"
                                            placeholder="Ex : -94.22213" value="<?php echo e($restaurant->latitude); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(__('messages.longitude')); ?><span
                                                class="input-label-secondary"
                                                title="<?php echo e(__('messages.restaurant_lat_lng_warning')); ?>"><img
                                                    src="<?php echo e(asset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                    alt="<?php echo e(__('messages.restaurant_lat_lng_warning')); ?>"></span></label>
                                        <input type="text" name="longitude" class="form-control h--45px" id="longitude"
                                            placeholder="Ex : 103.344322" value="<?php echo e($restaurant->longitude); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="<?php echo e(__('messages.search_your_location_here')); ?>" type="text" placeholder="<?php echo e(__('messages.search_here')); ?>"/>
                                    <div id="map"></div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="card-header-icon">
                                    <i class="tio-user"></i> <?php echo e(__('messages.vendor')); ?>

                            <?php echo e(__('messages.info')); ?>

                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(__('messages.first')); ?>

                                                <?php echo e(__('messages.name')); ?></label>
                                            <input id="f_name" type="text" name="f_name" class="form-control h--45px"
                                                placeholder="<?php echo e(__('messages.first')); ?> <?php echo e(__('messages.name')); ?>"
                                                value="<?php echo e($restaurant->vendor->f_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(__('messages.last')); ?>

                                                <?php echo e(__('messages.name')); ?></label>
                                            <input id="l_name" type="text" name="l_name" class="form-control h--45px"
                                                placeholder="<?php echo e(__('messages.last')); ?> <?php echo e(__('messages.name')); ?>"
                                                value="<?php echo e($restaurant->vendor->l_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(__('messages.phone')); ?></label>
                                            <input id="phone" type="tel" name="phone" class="form-control h--45px" placeholder="Ex : 017********"
                                                value="<?php echo e($restaurant->phone); ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="card-header-icon">
                                    <i class="tio-user"></i> <?php echo e(__('messages.login')); ?>

                            <?php echo e(__('messages.info')); ?>

                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(__('messages.email')); ?></label>
                                        <input id="email" type="email" name="email" class="form-control h--45px"
                                            placeholder="Ex : ex@example.com" value="<?php echo e($restaurant->email); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="js-form-message form-group">
                                        <label class="input-label" for="signupSrPassword"><?php echo e(translate('messages.password')); ?></label>

                                        <div class="input-group input-group-merge">
                                            <input type="password" class="js-toggle-password form-control h--45px" name="password"
                                                id="signupSrPassword"
                                                placeholder="<?php echo e(__('messages.password_length_placeholder', ['length' => '6+'])); ?>"
                                                aria-label="6+ characters required"
                                                data-msg="Your password is invalid. Please try again."
                                                data-hs-toggle-password-options='{
                                                                "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                                                "defaultClass": "tio-hidden-outlined",
                                                                "showClass": "tio-visible-outlined",
                                                                "classChangeTarget": ".js-toggle-passowrd-show-icon-1"
                                                                }'>
                                            <div class="js-toggle-password-target-1 input-group-append">
                                                <a class="input-group-text" href="javascript:;">
                                                    <i class="js-toggle-passowrd-show-icon-1 tio-visible-outlined"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="js-form-message form-group">
                                        <label class="input-label" for="signupSrConfirmPassword"><?php echo e(translate('messages.confirm_password')); ?></label>

                                        <div class="input-group input-group-merge">
                                            <input type="password" class="js-toggle-password form-control h--45px"
                                                name="confirmPassword" id="signupSrConfirmPassword"
                                                placeholder="<?php echo e(__('messages.password_length_placeholder', ['length' => '6+'])); ?>"
                                                aria-label="6+ characters required"
                                                data-msg="Password does not match the confirm password."
                                                data-hs-toggle-password-options='{
                                                                    "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                                                    "defaultClass": "tio-hidden-outlined",
                                                                    "showClass": "tio-visible-outlined",
                                                                    "classChangeTarget": ".js-toggle-passowrd-show-icon-2"
                                                                    }'>
                                            <div class="js-toggle-password-target-2 input-group-append">
                                                <a class="input-group-text" href="javascript:;">
                                                    <i class="js-toggle-passowrd-show-icon-2 tio-visible-outlined"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="btn--container justify-content-end">
                            <button id="reset_btn" type="button" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                            <button type="submit" class="btn btn--primary"><i class="tio-save-outlined"></i> <?php echo e(__('messages.save')); ?> <?php echo e(__('messages.info')); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#customFileEg1").change(function() {
            readURL(this, 'viewer');
        });

        $("#coverImageUpload").change(function() {
            readURL(this, 'coverImageViewer');
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&callback=initMap&v=3.45.8">
    </script>
    <script>
        let myLatlng = {
            lat: <?php echo e($restaurant->latitude); ?>,
            lng: <?php echo e($restaurant->longitude); ?>

        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatlng,
        });
        var zonePolygon = null;
        let infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
            position: myLatlng,
        });
        var bounds = new google.maps.LatLngBounds();

        function initMap() {
            // Create the initial InfoWindow.
            new google.maps.Marker({
                position: {
                    lat: <?php echo e($restaurant->latitude); ?>,
                    lng: <?php echo e($restaurant->longitude); ?>

                },
                map,
                title: "<?php echo e($restaurant->name); ?>",
            });
            infoWindow.open(map);
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            //console.log(input);
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            let markers = [];
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
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
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
        }
        initMap();

        function get_zone_data(id) {
            $.get({
                url: '<?php echo e(url('/')); ?>/admin/zone/get-coordinates/' + id,
                dataType: 'json',
                success: function(data) {
                    if (zonePolygon) {
                        zonePolygon.setMap(null);
                    }
                    zonePolygon = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    zonePolygon.setMap(map);
                    map.setCenter(data.center);
                    google.maps.event.addListener(zonePolygon, 'click', function(mapsMouseEvent) {
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                        });
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                        var coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);
                    });
                },
            });
        }
        $(document).on('ready', function() {
            var id = $('#choice_zones').val();
            $.get({
                url: '<?php echo e(url('/')); ?>/admin/zone/get-coordinates/' + id,
                dataType: 'json',
                success: function(data) {
                    if (zonePolygon) {
                        zonePolygon.setMap(null);
                    }
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
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(),
                                null, 2),
                        });
                        var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                            2);
                        var coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);
                    });
                },
            });
        });
    </script>
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });


            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this), {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupSrPassword'
                        }
                    }
                });
            });

            get_zone_data(<?php echo e($restaurant->zone_id); ?>);
        });
		$("#vendor_form").on('keydown', function(e){
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        })

    </script>
    <script>
        $('#reset_btn').click(function(){
            $('#name').val("<?php echo e($restaurant->name); ?>");
            $('#tax').val("<?php echo e($restaurant->tax); ?>");
            $('#address').val("<?php echo e($restaurant->address); ?>");
            $('#minimum_delivery_time').val("<?php echo e(explode('-', $restaurant->delivery_time)[0]); ?>");
            $('#maximum_delivery_time').val("<?php echo e(explode('-', $restaurant->delivery_time)[1]); ?>");
            $('#viewer').attr('src', "<?php echo e(asset('storage/app/public/restaurant/' . $restaurant->logo)); ?>");
            $('#customFileEg1').val(null);
            $('#coverImageViewer').attr('src', "<?php echo e(asset('storage/app/public/restaurant/cover/' . $restaurant->cover_photo)); ?>");
            $('#coverImageUpload').val(null);
            $('#choice_zones').val(<?php echo e($restaurant->zone_id); ?>).trigger('change');
            $('#f_name').val("<?php echo e($restaurant->vendor->f_name); ?>");
            $('#l_name').val("<?php echo e($restaurant->vendor->l_name); ?>");
            $('#phone').val("<?php echo e($restaurant->phone); ?>");
            $('#email').val("<?php echo e($restaurant->email); ?>");


        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/vendor/edit.blade.php ENDPATH**/ ?>