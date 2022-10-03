<?php
/**
 * MU plugin to clear the current cookies table
 *
 * @return void
 */
function cmplz_my_clear_cookies() {
	global $wpdb;
	$wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}cmplz_cookies" );
}
add_action( 'plugins_loaded', 'cmplz_my_clear_cookies', 20, 1 );
