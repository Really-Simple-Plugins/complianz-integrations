<?php
/**
 * Block Google Maps embedded by the property hive plugin
 *
 */



/**
 * Block the script, and an inline script with string 'initMap'.
 * initMap can also be something else. That's the problem with custom     maps :)
 *
 * @param $tags
 *
 * @return array
 */
function cmplz_custom_googlemaps_script( $tags ) {
	$tags[] = 'maps.googleapis.com/maps/api/js';
	$tags[] = 'initialize_property_map';

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );

/**
 * Conditionally add the dependency
 * $deps['wait-for-this-script'] = 'script-that-should-wait';
 */

function cmplz_custom_maps_dependencies( $tags ) {
	$tags['initialize_property_map'] = 'maps.googleapis.com';
	return $tags;
}
add_filter( 'cmplz_dependencies', 'cmplz_custom_maps_dependencies' );


/**
 * Add a placeholder to a div with class "my-maps-class"
 * @param $tags
 *
 * @return mixed
 */
function cmplz_custom_maps_placeholder( $tags ) {
	$tags['google-maps'][] = "cmplz-maps-placeholder";
	return $tags;
}
add_filter( 'cmplz_placeholder_markers', 'cmplz_custom_maps_placeholder' );