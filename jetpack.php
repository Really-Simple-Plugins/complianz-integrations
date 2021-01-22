<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

add_filter( 'cmplz_known_script_tags', 'cmplz_jetpack_stats_script' );
function cmplz_jetpack_stats_script( $tags ) {
	$tags[] = 'pixel.wp.com';
	$tags[] = 'stats.wp.com';

	return $tags;
}

/**
 * Statistics for Jetpack
 *
 */


/**
 * Make sure it's set as not anonymous when tracking enabled
 * @param bool $stats_category_required
 */
function cmplz_jetpack_stats_set_statistics_required( $stats_category_required ){
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'stats' ) ) {
		$stats_category_required = true;
	}
	return $stats_category_required;
}
add_filter('cmplz_cookie_warning_required_stats', 'cmplz_jetpack_stats_set_statistics_required');


/**
 * Add markers to the statistics markers list
 * @param $markers
 *
 * @return array
 */
function cmplz_jetpack_stats_stats_markers( $markers ) {
	$markers['jetpack'][] = 'pixel.wp.com';
	$markers['jetpack'][] = "stats.wp.com";
	return $markers;
}
add_filter( 'cmplz_stats_markers', 'cmplz_jetpack_stats_stats_markers', 20, 1 );


