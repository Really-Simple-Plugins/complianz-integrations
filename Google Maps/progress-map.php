<?php
/**
 * Block Google Maps from Codespacing Progress Map plugin
 * @param $tags
 * @return array
 */
function cmplz_progressmap_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'maps.google.com',
			'progress_map',
			'gmap3.min.js',
			'var plugin_map_placeholder',
			'snazzy-info-window.min.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'codespacing_progress_map_area',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.google.com' => 'var plugin_map_placeholder',
			//'snazzy-info-window.min.js' => 'gmap3.min.js',
		],
	);

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_progressmap_googlemaps_script' );
