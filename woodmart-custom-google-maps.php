<?php
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );

function cmplz_woodmart_custom_googlemaps_script( $tags ) {
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
			'maplace.min.js' => 'googleMap.min.js',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_woodmart_custom_googlemaps_script' );
