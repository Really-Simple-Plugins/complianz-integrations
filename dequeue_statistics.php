<?php
function cmplz_remove_statistics(){
	$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if ( strpos( $url, 'localhost' ) !== false ) {
		remove_action( 'cmplz_statistics_script', array( COMPLIANZ::$cookie_admin, 'get_statistics_script' ), 10 );
		remove_action( 'cmplz_tagmanager_script', array( COMPLIANZ::$cookie_admin, 'get_tagmanager_script' ), 10 );
		remove_action( 'cmplz_before_statistics_script', array( COMPLIANZ::$cookie_admin, 'add_gtag_js' ), 10 );
		remove_action( 'cmplz_before_statistics_script', array( COMPLIANZ::$cookie_admin, 'add_clicky_js' ), 10 );
	}
}
add_action('init', 'cmplz_remove_statistics');