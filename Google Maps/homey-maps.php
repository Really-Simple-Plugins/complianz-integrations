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
function cmplz_custom_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'maps.googleapis.com',
			'homey-maps',
			'infobox',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'map-section',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.googleapis.com' => 'infobox',
			'maps.googleapis.com' => 'homey-maps',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_custom_googlemaps_script' );

function cmplz_homey_maps_initDomContentLoaded() {
	ob_start();
	?>
	<script>
        document.addEventListener("cmplz_run_after_all_scripts", cmplz_fire_domContentLoadedEvent);
        function cmplz_fire_domContentLoadedEvent() {
            dispatchEvent(new Event('load'));
        }
	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_homey_maps_initDomContentLoaded',PHP_INT_MAX );

