<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Block the script, and add placeholder to div which contains the my-maps-class class
 *
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
			'maps.googleapis.com/maps/api/js',
			'mapOptions',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'my-maps-class',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.googleapis.com' => 'mapOptions',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );
