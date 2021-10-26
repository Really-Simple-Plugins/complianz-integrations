<?php
/**
 * Map Multi Marker integration file
 */


/**
 * add the dependency
 * $deps['wait-for-this-script'] = 'script-that-should-wait';
 */

function cmplz_my_multimarker_dependencies( $tags ) {
	$tags['maps.googleapis.com/maps/api/js'] = 'map-multi-marker/asset/js/';

	return $tags;
}
add_filter( 'cmplz_dependencies', 'cmplz_my_multimarker_dependencies' );

/**
 * Block the scripts.
 * initMap can also be something else. That's the problem with custom maps :)
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_my_multimarker_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'maps.googleapis.com/maps/api/js',
			'map-multi-marker/asset/js/',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'map-multi-marker',
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_my_multimarker_script' );

/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */
function cmplz_my_multimarker_detected_services( $services ) {

	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}

add_filter( 'cmplz_detected_services', 'cmplz_my_multimarker_detected_services' );


