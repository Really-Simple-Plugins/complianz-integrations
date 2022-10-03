<?php
/**
 * There are a lot of custom implementations for Google Maps. These require a custom block script, as described below
 * Replace initMap with a variable from the inline script which runs the init, or the URL where this script resides.
 */
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Block the script, and an inline script with string 'initMap'.
 * initMap can also be something else. That's the problem with custom maps :)
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_custom_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'showHeaderMap',
			'mapContainer',
			'google.maps',
			'maps.googleapis.com/maps/api/js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'google-map-container,map-container',
	);

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );

function cmplz_maps_initDomContentLoaded() {
			?>
			<script>
					document.addEventListener("cmplz_run_after_all_scripts", cmplz_maps_fire_domContentLoadedEvent);
					function cmplz_maps_fire_domContentLoadedEvent() {
						dispatchEvent(new Event('load'));
					}
			</script>
			<style>.cmplz-placeholder-2, .cmplz-placeholder-1 {height: 300px;}</style>
			<?php

}
add_action( 'wp_footer', 'cmplz_maps_initDomContentLoaded' );
