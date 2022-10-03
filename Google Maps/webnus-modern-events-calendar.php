<?php
/**
 * Integration with WebNus Modern Event Calendar
 * Blocks the Maps API, googlemaps.js, richmarker, and inline script with string 'function mec_init_gmap'
 * Adds dependencies to reload in the correct order
 * @param $tags
 *
 * @return array
 */
function cmplz_webnus_modern_events_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'placeholder' => 'google-maps',
		'category' => 'marketing',
		'urls' => array(
			'richmarker',
            'function mec_init_gmap',
			'maps.googleapis.com/maps/api/js',
            'googlemap.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'mec-googlemap-details',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
            'maps.googleapis.com/maps/api/js' => 'googlemap.js',
			'googlemap.js' => 'richmarker',
			'richmarker' => 'function mec_init_gmap',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_webnus_modern_events_googlemaps_script' );

/* Trigger domContentLoaded event, not always needed 
function cmplz_custom_maps_initDomContentLoaded() {
	ob_start();
	?>
	<script>
        document.addEventListener("cmplz_run_after_all_scripts", cmplz_fire_domContentLoadedEvent);
        function cmplz_fire_domContentLoadedEvent() {
            dispatchEvent(new Event('load'));
        }
	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_custom_maps_initDomContentLoaded',PHP_INT_MAX );
*/

/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */
function cmplz_webnus_detected_services( $services ) {
	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}
add_filter( 'cmplz_detected_services', 'cmplz_webnus_detected_services' );
