<?php
/**
 * There are a lot of custom implementations for Google Maps. These require a custom block script, as described below
 * Replace initMap with a variable from the inline script which runs the init, or the URL where this script resides.
 */
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Block the script, and an inline script with string 'initMap'.
 * initMap can also be something else. That's the problem with custom maps :)
 * Add a placeholder to a div with class "my-maps-class"
 * @param $tags
 *
 * @return array
 */
function cmplz_custom_maps_marker_pro( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'mmpVars',
			'var mapsMarkerPro',
      'mapsmarkerpro.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'mmp-map',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'mapsmarkerpro.js' => 'var mapsMarkerPro',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_maps_marker_pro' );
