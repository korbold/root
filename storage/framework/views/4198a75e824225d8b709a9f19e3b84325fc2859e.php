<?php $__env->startSection('title','Update Branch'); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title text-capitalize"><i class="tio-edit"></i> <?php echo e(__('messages.zone')); ?> <?php echo e(__('messages.update')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="<?php echo e(route('admin.zone.update', $zone->id)); ?>" method="post"  class="shadow--card">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="zone-setup-instructions">
                                <div class="zone-setup-top">
                                    <h6 class="subtitle"><?php echo e(translate('messages.instructions')); ?></h6>
                                    <p>
                                        <?php echo e(translate('messages.create_zone_by_click_on_map_and_connect_the_dots_together')); ?>

                                    </p>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-hand-draw"></i>
                                    </div>
                                    <div class="info">
                                        <?php echo e(translate('messages.use_this_drag_map_to_find_proper_area')); ?>

                                    </div>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-voice-line"></i>
                                    </div>
                                    <div class="info">
                                        <?php echo e(translate('messages.click_this_icon_to_start_pin_points_in_the_map_and_connect_them_to_draw_a_zone._minimum_3_points_required')); ?>

                                    </div>
                                </div>
                                <div class="instructions-image mt-4">
                                    <img src=<?php echo e(asset('public/assets/admin/img/instructions.gif')); ?> alt="instructions">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-7 zone-setup">
                            <div class="form-group mb-3">
                                <label class="input-label"
                                       for="exampleFormControlInput1"><?php echo e(__('messages.zone')); ?> <?php echo e(__('messages.name')); ?></label>
                                <input id="zone_name" type="text" name="name" class="form-control" placeholder="<?php echo e(__('messages.new_zone')); ?>" value="<?php echo e($zone->name); ?>" required>
                            </div>
                            <div class="form-group mb-3" style="display: none">
                                <label class="input-label"
                                       for="exampleFormControlInput1"><?php echo e(translate('messages.Coordinates')); ?><span
                                        class="input-label-secondary" title="<?php echo e(__('messages.draw_your_zone_on_the_map')); ?>"><?php echo e(__('messages.draw_your_zone_on_the_map')); ?></span></label>
                                       <textarea  type="text" name="coordinates"  id="coordinates" class="form-control"><?php $__currentLoopData = $zone->coordinates[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coords): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(count($zone->coordinates[0]) != $key+1) {if($key != 0) echo(','); ?>(<?php echo e($coords->getLat()); ?>, <?php echo e($coords->getLng()); ?>)<?php } ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">
                                            <?php echo e(translate('messages.minimum_delivery_charge')); ?>  (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)
                                        </label>
                                        <input id="min_delivery_charge" name="minimum_delivery_charge" type="number" class="form-control h--45px"  min="0" step=".01" placeholder="Ex: 10" value="<?php echo e($zone->minimum_shipping_charge); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">
                                            <?php echo e(translate('messages.delivery_charge_per_km')); ?> (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)
                                        </label>
                                        <input id="delivery_charge_per_km" min="0" step=".01" name="per_km_delivery_charge" type="number" class="form-control h--45px" placeholder="Ex: 10" value="<?php echo e($zone->per_km_shipping_charge); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 300px;overflow: hidden;border-radius:5px">
                                <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="<?php echo e(__('messages.search_your_location_here')); ?>" type="text" placeholder="<?php echo e(__('messages.search_here')); ?>"/>
                                <div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
                            </div>
                            <div class="btn--container mt-3 justify-content-end">
                                <button id="reset_btn" type="reset" class="btn btn--reset"><?php echo e(__('messages.reset')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(__('messages.update')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.45.8&key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&libraries=drawing,places"></script>
<script>
    auto_grow();
    function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>

<script>
    var map; // Global declaration of the map
    var lat_longs = new Array();
    var drawingManager;
    var lastpolygon = null;
    var bounds = new google.maps.LatLngBounds();
    var polygons = [];


    function resetMap(controlDiv) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Reset map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "10px";
        controlText.style.lineHeight = "16px";
        controlText.style.paddingLeft = "2px";
        controlText.style.paddingRight = "2px";
        controlText.innerHTML = "X";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            lastpolygon.setMap(null);
            $('#coordinates').val('');

        });
    }

    function initialize() {
        var myLatlng = new google.maps.LatLng(<?php echo e(trim(explode(' ',$zone->center)[1], 'POINT()')); ?>, <?php echo e(trim(explode(' ',$zone->center)[0], 'POINT()')); ?>);
        var myOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        const polygonCoords = [

            <?php $__currentLoopData = $zone->coordinates[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coords): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            { lat: <?php echo e($coords->getLat()); ?>, lng: <?php echo e($coords->getLng()); ?> },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        var zonePolygon = new google.maps.Polygon({
            paths: polygonCoords,
            strokeColor: "#050df2",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillOpacity: 0,
        });

        zonePolygon.setMap(map);

        zonePolygon.getPaths().forEach(function(path) {
            path.forEach(function(latlng) {
                bounds.extend(latlng);
                map.fitBounds(bounds);
            });
        });


        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
            editable: true
            }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            var newShape = event.overlay;
            newShape.type = event.type;
        });

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
        });
        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
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
    google.maps.event.addDomListener(window, 'load', initialize);

    function set_all_zones()
    {
        $.get({
            url: '<?php echo e(route('admin.zone.zoneCoordinates')); ?>/<?php echo e($zone->id); ?>',
            dataType: 'json',
            success: function (data) {

                console.log(data);
                for(var i=0; i<data.length;i++)
                {
                    polygons.push(new google.maps.Polygon({
                        paths: data[i],
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.1,
                    }));
                    polygons[i].setMap(map);
                }

            },
        });
    }
    $(document).on('ready', function(){
        set_all_zones();
    });


    $('#reset_btn').click(function(){
        // $('#zone_name').val('');
        // $('#coordinates').val('');
        // $('#min_delivery_charge').val('');
        // $('#delivery_charge_per_km').val('');
        location.reload(true);
    })

</script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/root/resources/views/admin-views/zone/edit.blade.php ENDPATH**/ ?>