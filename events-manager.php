<?php
add_filter( 'cmplz_known_script_tags', 'cmplz_eventsmanager_script' );
function cmplz_eventsmanager_script( $tags ) {
	$tags[] = array(
		'name' => 'google-maps',
		'category' => 'marketing',
		'placeholder' => 'google-maps',
		'urls' => array(
			'events-manager.js',
		),
		'enable_placeholder' => '1',
		'placeholder_class' => 'em-location-map-container',
	);
	return $tags;
}

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
