<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );
/**
 * Block the script.
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_ctfw_googlemaps_script( $tags ) {
	$tags[] = 'maps.googleapis.com/maps/api/js';
	$tags[] = 'maps.googleapis.com/maps-api-v3/api/js/';
	$tags[] = 'maps.gstatic.com';
	$tags[] = 'maps.googleapis.com';

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_ctfw_googlemaps_script' );

/**
 * Conditionally add the dependency
 * $deps['wait-for-this-script'] = 'script-that-should-wait';
 */

function cmplz_ctfw_maps_dependencies( $tags ) {
	$tags['ctfw-maps-js'] = 'maps.googleapis.com/';
	return $tags;
}
add_filter( 'cmplz_dependencies', 'cmplz_ctfw_maps_dependencies' );

/**
 * Add a placeholder to a div with class "ctfw-google-map"
 * @param $tags
 *
 * @return mixed
 */
function cmplz_ctfw_maps_placeholder( $tags ) {
	$tags['google-maps'][] = "ctfw-google-map";
	return $tags;
}
add_filter( 'cmplz_placeholder_markers', 'cmplz_ctfw_maps_placeholder' );

/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */
function cmplz_ctfw_detected_services( $services ) {
	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}
add_filter( 'cmplz_detected_services', 'cmplz_ctfw_detected_services' );
