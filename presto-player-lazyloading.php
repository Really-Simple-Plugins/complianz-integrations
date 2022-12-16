<?php

add_filter( 'cmplz_known_script_tags', 'cmplz_presto_lazy_load' );
function cmplz_presto_lazy_load( $tags ) {
	$vimeo_index = array_search( 'vimeo', array_column( $tags, 'name' ), true );
	if ( $vimeo_index!==false ) {
		$tags[ $vimeo_index ]['enable_placeholder']   = '1';
		$tags[ $vimeo_index ]['placeholder_class']    = 'presto-block-video';
	}


	$youtube_index = array_search( 'vimeo', array_column( $tags, 'name' ), true );
	if ( $youtube_index!==false ) {
		$tags[ $youtube_index ]['enable_placeholder'] = '1';
		$tags[ $youtube_index ]['placeholder_class']  = 'presto-block-video';
	}
}