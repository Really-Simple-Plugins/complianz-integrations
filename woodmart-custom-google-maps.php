<?php
/**
 * There are a lot of custom implementations for Google Maps. These require a custom block script
 */
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );

/**
 * Block the script, and an inline script with string 'initMap'.
 * initMap can also be something else. That's the problem with custom maps :)
 * Add a placeholder to a div with class "my-maps-class"
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
			'maps.google.com',
			'maplace.min.js',
			'googleMap.min.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'google-map-container',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.google.com' => 'maplace.min.js',
			'maps.google.com' => 'googleMap.min.js',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );







