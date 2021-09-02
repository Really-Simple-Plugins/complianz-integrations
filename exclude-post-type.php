<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Exclude post types from cookie scan
 *
 */

add_filter('cmplz_cookiescan_post_types', 'my_custom_posttypes');
function my_custom_posttypes($post_types){
	unset( $post_types['not_this_posttype'] );
	return $post_types;
}
