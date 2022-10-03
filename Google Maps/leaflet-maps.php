<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

add_filter( 'cmplz_known_script_tags', 'cmplz_leafletmaps_directory_script' );
function cmplz_leafletmaps_directory_script( $tags ) {
	$tags[] = array(
		'name' => 'openstreetmaps',
		'category' => 'marketing',
		'placeholder' => 'openstreetmaps',
		'urls' => array(
			'WPLeafletMapPlugin',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'leaflet-map',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'leaflet.js' => 'leaflet-gesture-handling-leafext.min.js',
		],
	);
	return $tags;
}

/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */

function cmplz_leafletmaps_directory_detected_services( $services ) {
	if ( ! in_array( 'openstreetmaps', $services ) ) {
		$services[] = 'openstreetmaps';
	}

	return $services;
}

add_filter( 'cmplz_detected_services', 'cmplz_leafletmaps_directory_detected_services' );