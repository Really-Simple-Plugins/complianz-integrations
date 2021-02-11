<?php
/**
 * add the dependency
 * $deps['wait-for-this-script'] = 'script-that-should-wait';
 */

function cmplz_extendedmapsforelementor_dependencies( $tags ) {
	$tags['maps.googleapis.com/maps/api/js'] = 'eb-google-map.js';
	return $tags;
}
add_filter( 'cmplz_dependencies', 'cmplz_extendedmapsforelementor_dependencies' );

/**
 * Block the scripts.
 * initMap can also be something else. That's the problem with custom maps :)
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_extendedmapsforelementor_script( $tags ) {
	$tags[] = 'maps.googleapis.com/maps/api/js';
	$tags[] = 'eb-google-map.js';

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_extendedmapsforelementor_script' );

/**
 * Add a placeholder to a div with class "my-maps-class"
 * @param $tags
 *
 * @return mixed
 */
function cmplz_extendedmapsforelementor_placeholder( $tags ) {
	$tags['google-maps'][] = "eb-map";
	return $tags;
}
add_filter( 'cmplz_placeholder_markers', 'cmplz_extendedmapsforelementor_placeholder' );

/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */
function cmplz_extendedmapsforelementor_detected_services( $services ) {

	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}

add_filter( 'cmplz_detected_services', 'cmplz_extendedmapsforelementor_detected_services' );
