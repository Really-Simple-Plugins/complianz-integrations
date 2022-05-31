<?php

/* Integration with Flippercode WP Maps Pro/WP Google Map Gold plugin: https://www.wpmapspro.com/ */

defined( 'ABSPATH' ) or die( "you do not have access to this page!" );
if ( !defined('CMPLZ_GOOGLE_MAPS_INTEGRATION_ACTIVE') ) define('CMPLZ_GOOGLE_MAPS_INTEGRATION_ACTIVE', false);

add_filter( 'cmplz_known_script_tags', 'cmplz_wp_google_map_pro_script' );
function cmplz_wp_google_map_pro_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'maps.js',
			'infobox.js',
			'/maps/api/',
			'wpgmp_map',
			'var map',
		),
		'enable_placeholder' => 1,
		'placeholder_class' => 'wpgmp_map_container',
		'enable_dependency' => '1',
		'dependency' => [
			//'wait-for-this-script' => 'script-that-should-wait'
			'/maps/api/' => 'maps.js',
			'maps.js' => 'infobox.js',
			'infobox.js' => 'var map',
		],
	);

	return $tags;
}

function cmplz_wp_google_map_pro_reload_after_consent() {
	?>
	<script>
		document.addEventListener('cmplz_status_change', function (e) {
			if (e.detail.category === 'marketing' && e.detail.value==='allow') {
				location.reload();
			}
		});
		document.addEventListener('cmplz_status_change_service', function (e) {
			if ( e.detail.value ) {
				location.reload();
			}
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_wp_google_map_pro_reload_after_consent' );


/**
 * Add services to the list of detected items, so it will get set as default, and will be added to the notice about it
 *
 * @param $services
 *
 * @return array
 */

function cmplz_wp_google_map_pro_detected_services( $services ) {
	if ( ! in_array( 'google-maps', $services ) ) {
		$services[] = 'google-maps';
	}

	return $services;
}
add_filter( 'cmplz_detected_services', 'cmplz_wp_google_map_pro_detected_services' );