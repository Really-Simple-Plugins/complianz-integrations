<?php
/**
 * Whitelist a string for the cookie blocker
 * @param string $class
 * @param int $total_match
 * @param bool $found
 *
 * @return string
 */

function cmplz_whitelist_my_string( $class, $total_match, $found ) {
	if ( $found && false !== strpos( $total_match, 'YOUR-SCRIPTID' ) ) {
		$class = 'cmplz-native'; // add cmplz-script for Marketing and cmplz-stats for Statistics
	}
	return $class;
}
add_filter ( 'cmplz_script_class', 'cmplz_whitelist_my_string', 10 , 3 );

