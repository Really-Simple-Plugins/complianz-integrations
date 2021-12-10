<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Filter post types for cookiewarning
 * It's too early to use global $post or url_to_postid(), so we do a simple text comparison
 * @param int $cookiewarning_required
 *
 * @return bool
 */
 function cmplz_my_filter_site_needs_cookiewarning( $cookiewarning_required
 ) {
 	$url = is_ssl() ? "https" : "http";
	$url .= "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 	//don't show cookie banner on page where the URL contains the parameter "cmplz_safe_mode"
 	if ( strpos($url, 'cmplz_safe_mode') !== FALSE ) {
 		$cookiewarning_required = false;
		//cookie blocker triggers directly on parameter
 }

 	return $cookiewarning_required;
 }
 add_filter( 'cmplz_site_needs_cookiewarning', 'cmplz_my_filter_site_needs_cookiewarning' );
