<?php
/**
* Block images if these are from a remote third party, which is tracking user data
*/

defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
* Block the image
*
* @param $tags
*
* @return array
*/

function cmplz_block_image_sources( $tags ) {
	$tags[] = 'part-of-image-src';

	return $tags;
}
add_filter( 'cmplz_image_tags', 'cmplz_block_image_sources' );


