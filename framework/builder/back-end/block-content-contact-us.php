<?php

/**
 * Block Name: Contact Us
 */

$background_image  = (get_field('background_image')) ? get_field('background_image')['url'] : '';
$map_icon = get_field('map_icon');
?>

<section
    class="contact-section"
    style="background-image: url('<?= $background_image ?>')">
    <div class="container bg-white p-4 p-md-5 rounded-24" style="box-shadow: 0px 0px 8px 0px #0000001A;">
        <div class="row g-md-4">
            <div class="col-md-5 map mb-4">
                <?php if (have_rows('contact_info')) : ?>
                    <div class="acf-map w-100 h-100 rounded-8" data-zoom="16" data-icon="<?= ($map_icon) ? $map_icon['url'] : 'noIcon' ?>">
                        <?php
                        while (have_rows('contact_info')) :
                            the_row();
                            // Load sub field values.
                            $location = get_sub_field('location');
                            $google_url = get_sub_field('google_url');
                        ?>
                            <div
                                class="marker opac"
                                data-add="<?= ($google_url) ? $google_url : '' ?>"
                                data-lat="<?= ($location) ? esc_attr($location["lat"]) : '' ?>"
                                data-lng="<?= ($location) ? esc_attr($location["lng"]) : '' ?>"
                                data-icon="<?= ($map_icon) ? $map_icon['url'] : '' ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-7 info">
                <div class="spacer-25"></div>
                <?php if (have_rows('contact_info')) : ?>
                    <div class="info-card">
                        <?php
                        while (have_rows('contact_info')) :
                            the_row();
                            $title = get_sub_field('title');
                            $google_url = get_sub_field('google_url');
                        ?>
                            <div class="wrapper rounded-8">
                                <h3 class="font-22 fw-700 mb-0"><?= $title ?></h3>
                                <div class="spacer-10"></div>
                                <?php if (have_rows('information')) : ?>
                                    <div class="information">
                                        <?php
                                        while (have_rows('information')) :
                                            the_row();
                                            $icon = get_sub_field('icon');
                                            $text = get_sub_field('text');
                                        ?>
                                            <div class="d-flex align-items-center gap-2 mt-3">
                                                <?php if ($icon) : ?>
                                                    <div class="icon">
                                                        <img width="23px" src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>">
                                                    </div>
                                                <?php endif;
                                                if ($text) : ?>
                                                    <div class="text mt-1 font-15">
                                                        <a href="<?= $text['url'] ?>" target="<?= $text['target'] ?>">
                                                            <?= $text['title'] ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="spacer-40 d-none d-md-block"></div>
                            <div class="spacer-20 d-md-none"></div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="spacer-40 d-none d-md-block"></div>
    <div class="spacer-20 d-md-none"></div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9_qsnnns_d8gSnDWKx45ag2PPE-HISoo&callback=Function.prototype"></script>
<script>
    // Map
    (function($) {

        /**
         * initMap
         *
         * Renders a Google Map onto the selected jQuery element
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   jQuery $el The jQuery element.
         * @return  object The map instance.
         */
        function initMap($el) {

            // Find marker elements within map.
            var $markers = $el.find('.marker');

            // Create gerenic map.
            var mapArgs = {
                zoom: $el.data('zoom') || 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControl: true,
                styles: [{
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    },
                    {
                        featureType: "water",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#c8d3d9"
                        }]
                    },
                    {
                        featureType: "water",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#c8d3d9"
                        }]
                    },
                    {
                        featureType: "landscape.natural",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#dededd"
                        }]
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#cbd6c3"
                        }]
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#ffffff"
                        }]
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#ffffff",
                            weight: 4
                        }]
                    },
                    {
                        featureType: "administrative",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#ffffff",
                            weight: 3
                        }]
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{
                            visibility: "off"
                        }]
                    }
                ]
            };
            var map = new google.maps.Map($el[0], mapArgs);

            // Add markers.
            map.markers = [];
            $markers.each(function() {
                initMarker($(this), map);
            });

            // Center map based on markers.
            centerMap(map);

            // Return map instance.
            return map;
        }

        /**
         * initMarker
         *
         * Creates a marker for the given jQuery element and map.
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   jQuery $el The jQuery element.
         * @param   object The map instance.
         * @return  object The marker instance.
         */
        function initMarker($marker, map) {

            // Get position from marker.
            var lat = $marker.data('lat');
            var lng = $marker.data('lng');
            var add = $marker.data('add');
            var icon = $marker.data('icon');

            console.log("icon", icon);

            var latLng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };

            // Create marker instance.
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: icon,
            });

            // Append to reference for later use.
            map.markers.push(marker);

            // If marker contains HTML, add it to an infoWindow.
            if ($marker.html()) {

                // Create info window.
                var infowindow = new google.maps.InfoWindow({
                    content: $marker.html()
                });

                // Show info window when marker is clicked.
                google.maps.event.addListener(marker, 'click', function() {
                    // infowindow.open( map, marker );
                    window.open(add, '_blank');
                });

            }
        }

        /**
         * centerMap
         *
         * Centers the map showing all markers in view.
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   object The map instance.
         * @return  void
         */
        function centerMap(map) {

            // Create map boundaries from all map markers.
            var bounds = new google.maps.LatLngBounds();
            map.markers.forEach(function(marker) {
                bounds.extend({
                    lat: marker.position.lat(),
                    lng: marker.position.lng()
                });
            });

            // Case: Single marker.
            if (map.markers.length == 1) {
                map.setCenter(bounds.getCenter());

                // Case: Multiple markers.
            } else {
                map.fitBounds(bounds);
            }
        }

        // Render maps on page load.
        $(document).ready(function() {
            $('.acf-map').each(function() {
                var map = initMap($(this));
            });
        });

    })(jQuery);
</script>