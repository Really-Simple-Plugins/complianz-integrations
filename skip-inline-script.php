<?php
// Whitelisting podcast player inline script.
// Error fix for complianz. Refer: https://wordpress.org/support/topic/after-update-doesnt-work-anymore-2
// Fix created by Author of https://wordpress.org/support/plugin/podcast-player/
add_filter ( 'cmplz_script_class',
function( $class, $total_match, $found ) {
	if ( $found && false !== strpos( $total_match, 'YOUR-SCRIPTID' ) ) {
		$class = 'cmplz-native'; // add cmplz-script for Marketing and cmplz-stats for Statistics
		}
	return $class;
}, 10 , 3
);
