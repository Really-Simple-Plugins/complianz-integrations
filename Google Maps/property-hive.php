<?php
/**
 * Block Google Maps embedded by the property hive plugin
 * Add a placeholder to a div with class "cmplz-maps-placeholder"
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
			'maps.googleapis.com',
			'initialize_property_map',
		),
		'enable_placeholder' => '1',
		// Create the placeholder class by adding it to the Google Map DIV.
		'placeholder_class' => 'cmplz-maps-placeholder',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'initialize_property_map' => 'maps.googleapis.com',
		],
	);

	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );
