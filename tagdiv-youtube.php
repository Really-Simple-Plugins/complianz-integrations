<?php
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );

add_filter( 'cmplz_known_script_tags', 'tagdiv_youtube_playlist' );
function tagdiv_youtube_playlist( $tags ) {
	$tags[] = array(
		'name' => 'youtube',
		'category' => 'marketing',
		'placeholder' => 'youtube',
		'placeholder_class' => 'td_block_video_playlist',
		'urls' => array(
			'//www.youtube.com/embed',
		),
	);

	return $tags;
}
