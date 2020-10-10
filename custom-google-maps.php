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
	$tags[] = 'maps.googleapis.com/maps/api/js';
	$tags[] = 'initMap';

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );


/**
 * Add a placeholder to a div with class "my-maps-class"
 * @param $tags
 *
 * @return mixed
 */
function cmplz_custom_maps_placeholder( $tags ) {
	$tags['google-maps'][] = "my-maps-class";
	return $tags;
}
add_filter( 'cmplz_placeholder_markers', 'cmplz_custom_maps_placeholder' );






