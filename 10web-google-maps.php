<?php
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );

/* Integration with 10web.io Google Maps */

function cmplz_10web_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => '10web-google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'init_map',
			'maps.googleapis.com',
            'frontend_main.js',
            'gmwdInitMainMap',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'gmwd_container',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			//'gmwdInitMainMap' => 'init_map',
            //'frontend_main.js' => 'maps.googleapis.com',
            //'init_map' => 'frontend_main.js',
			'init_map' => 'gmwdInitMainMap',
            'maps.googleapis.com' => 'frontend_main.js',
            'frontend_main.js' => 'init_map',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_10web_googlemaps_script' );


/**
 * Trigger the DomContentLoaded event
 * This is not always needed, but in a plugin initializes on document load or ready, the map won't show on consent because this event already ran.
 * This will re-trigger that.
 *
 */

function cmplz_10web_maps_initDomContentLoaded() {
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
add_action( 'wp_enqueue_scripts', 'cmplz_10web_maps_initDomContentLoaded',PHP_INT_MAX );
