<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Show an EU banner for unknown regions
 * @param string $region
 * @param string $country_code
 *
 * @return string
 */
function my_cmplz_override_region($region, $country_code){
	//Show a 'eu' banner if region is not supported
	if (!$region) {
		$region = 'eu';
	}
	return $region;
}
add_filter("cmplz_region_for_country", "my_cmplz_override_region", 10, 2);

/**
 * Show a 'eu' banner if region is not supported
 * @param string $region
 * @param string $country_code
 *
 * @return string
 */
function my_cmplz_hide_banner_in_eu( $region, $country_code ) {

	if ( $region=== 'eu' ) {
		$region = 'other';
	}

	return $region;
}
add_filter( "cmplz_region_for_country", "my_cmplz_hide_banner_in_eu", 10, 2 );
