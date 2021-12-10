<?php
/**
 * Block the scripts.
 * initMap can also be something else. That's the problem with custom maps :)
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_extendedmapsforelementor_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'maps.googleapis.com/maps/api/js',
			'eb-google-map.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'eb-map',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.googleapis.com/maps/api/js' => 'eb-google-map.js',
		],
	);

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_extendedmapsforelementor_script' );

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
