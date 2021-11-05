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
	$url = is_ssl() ? "https" : "http" . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	//don't show cookie banner on page where the URL contains the word "shop"
	if ( strpos($url, 'shop') !== FALSE )
	// don't show on specific Post ID's - uncomment below	
	// if ($post->ID==1 || $post->ID==2 || $post->ID==3) 

	{
		$cookiewarning_required = false;

		//to disable the cookieblocker, uncomment the following
		//define('CMPLZ_DO_NOT_BLOCK', true);
	}

	return $cookiewarning_required;
}
add_filter( 'cmplz_site_needs_cookiewarning', 'cmplz_my_filter_site_needs_cookiewarning' );


