<?php
/**
 * Google Maps Integration for AIT Directory Pro theme
 */
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

add_filter( 'cmplz_known_script_tags', 'cmplz_directory_pro_plugin_script' );
function cmplz_directory_pro_plugin_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'showHeaderMap',
			'openstreetmap',
			'leaflet-gesture-handling.min.js',
			'leaflet.markercluster.js',
			'leaflet.js'
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'leaflet-map-container',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'leaflet.js' => 'showHeaderMap'
		],
	);
	return $tags;
}


function cmplz_directory_pro_scripts() {
	?>
    <script>
        jQuery(document).ready(function ($) {
            $(document).on("cmplz_run_after_all_scripts", cmplz_directorypro_fire_domContentLoadedEvent);
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
