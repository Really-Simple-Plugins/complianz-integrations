<?php

/**
* URL based on themdirectory and plugin
* themedir/complianz-gpdr/placeholder-$type.jpg
* themedir/complianz-gpdr-premium/placeholder-$type.jpg
* themedir/complianz-gpdr-premium-multisite/placeholder-$type.jpg
*/

defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

function cmplz_custom_google_maps_placeholder( $url ) {
	return 'my-custom-placeholder.png';
}

add_filter( 'cmplz_placeholder_google-maps', 'cmplz_custom_google_maps_placeholder', 20, 2 );
