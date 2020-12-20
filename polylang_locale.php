<?php
/**
 * Apparently Polylang in some cases does not handle a "en_US" locale correctly. We change it to "en" en that case.
 *
 */
add_filter('cmplz_cookiebanner_settings', 'cmplz_language_cookiebanner_settings', 10, 1);
function cmplz_language_cookiebanner_settings($settings) {
	$settings['url'] = add_query_arg('lang',  substr(get_locale(), 0, 2), admin_url( 'admin-ajax.php' ) );
	return $settings;
}