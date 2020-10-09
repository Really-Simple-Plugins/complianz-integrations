<?php
/**
 * Google Maps Integration for AIT Directory Pro theme
 */
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

add_filter( 'cmplz_known_script_tags', 'cmplz_directory_pro_plugin_script' );
function cmplz_directory_pro_plugin_script( $tags ) {
	$tags[] = 'leaflet.js';
	$tags[] = 'leaflet.markercluster.js';
	$tags[] = 'leaflet-gesture-handling.min.js';
	$tags[] = 'showHeaderMap';
	$tags[] = 'openstreetmap';

	return $tags;
}

function cmplz_directory_pro_placeholder( $tags ) {
	$tags['openstreetmaps'][] = 'leaflet-map-container';
	return $tags;
}
add_filter( 'cmplz_placeholder_markers', 'cmplz_directory_pro_placeholder' );


/**
 * add dependency
 * $deps['wait-for-this-script'] = 'script-that-should-wait';
 */

add_filter( 'cmplz_dependencies', 'cmplz_custom_directory_pro_dependencies' );
function cmplz_custom_directory_pro_dependencies( $tags ) {
	$tags['leaflet.js'] = 'showHeaderMap';
	return $tags;
}

function cmplz_directory_pro_scripts() {
	?>
    <script>
        jQuery(document).ready(function ($) {
            $(document).on("cmplzRunAfterAllScripts", cmplz_directorypro_fire_domContentLoadedEvent);
            function cmplz_directorypro_fire_domContentLoadedEvent() {
                setTimeout(function(){
                    var evt = document.createEvent('Event');
                    evt.initEvent('load', false, false);
                    window.dispatchEvent(evt);
                }, 1500);
            }
        })

    </script>
	<?php

}
add_action( 'wp_footer', 'cmplz_directory_pro_scripts' );
