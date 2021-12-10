<?php
/**
 * Change 'my text' to any text you want to display to unlock reCaptcha on Contact Form 7
 */

add_filter( 'cmplz_accept_cookies_contactform7', 'my_cf_text' );
function my_cf_text( $str ) {
	$str = "my text";

	return $str;
}
