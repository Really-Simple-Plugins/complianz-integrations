<?php
/**
 * If used icw CF7, do not load CF7 on the page with paid membership pro recaptcha:
 * my-page-without-cf7
 * @return void
 */
$request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$is_admin = strpos( $request_uri, '/wp-admin/' );
if( false === $is_admin ){
	add_filter( 'option_active_plugins', function( $plugins ){
		global $request_uri;
		$is_contact_page = strpos( $request_uri, '/my-page-without-cf7/' );
		$myplugin = "contact-form-7/wp-contact-form-7.php";
		$k = array_search( $myplugin, $plugins );
		if( false !== $k && false === $is_contact_page ){
			unset( $plugins[$k] );
		}

		return $plugins;
	} );
}