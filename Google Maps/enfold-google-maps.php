<?php
/**
 * Block the Maps API and the Enfold/AVIA Maps script. Make the Enfold script wait until the Maps API is loaded.
 * @param $tags
 *
 * @return array
 */
function cmplz_enfold_googlemaps_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'urls' => array(
			'maps.googleapis.com',
			'avia_google_maps_front',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'av_gmaps_sc_main_wrap',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.googleapis.com' => 'avia_google_maps_front',
		],
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_enfold_googlemaps_script' );

/**
 * Trigger the DomContentLoaded event
 * This is not always needed, but in a plugin initializes on document load or ready, the map won't show on consent because this event already ran.
 * This will re-trigger that.
 */

function cmplz_enfold_maps_initDomContentLoaded() {
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
add_action( 'wp_enqueue_scripts', 'cmplz_enfold_maps_initDomContentLoaded',PHP_INT_MAX );
