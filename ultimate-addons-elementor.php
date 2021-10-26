<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

function cmplz_uafe_initDomContentLoaded() {
	if ( cmplz_uses_thirdparty('youtube') ) {
		?>
		<script>
			jQuery(document).ready(function ($) {
				$(document).on("cmplz_run_after_all_scripts", cmplz_uafe_fire_initOnReadyComponents);
				function cmplz_uafe_fire_initOnReadyComponents() {
					window.elementorFrontend.init();
				}
			})
		</script>
	<?php
	}
}
add_action( 'wp_footer', 'cmplz_uafe_initDomContentLoaded' );

add_filter( 'cmplz_known_script_tags', 'cmplz_uafe_script' );
function cmplz_uafe_script( $tags ) {

    $tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'uael-google-map.js',
			'maps.googleapis.com',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'uael-google-map-wrap',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'maps.googleapis.com' => 'uael-google-map.js'
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

function cmplz_uafe_detected_services( $services ) {
	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}

add_filter( 'cmplz_detected_services', 'cmplz_uafe_detected_services' );
