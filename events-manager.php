<?php
add_filter( 'cmplz_known_script_tags', 'cmplz_eventsmanager_script' );
function cmplz_eventsmanager_script( $tags ) {
	$tags[] = 'events-manager.js';
	return $tags;
}

function cmplz_eventsmanager_placeholder( $tags ) {
	$tags['google-maps'][] = 'em-location-map-container';
	return $tags;
}

add_filter( 'cmplz_placeholder_markers', 'cmplz_eventsmanager_placeholder' );

function cmplz_eventsmanager_css() {
	?>
    <style>
        .cmplz-blocked-content-container .em-location-map {
            display: none;
        }
    </style>
	<?php
}

add_action( 'wp_footer', 'cmplz_eventsmanager_css' );
