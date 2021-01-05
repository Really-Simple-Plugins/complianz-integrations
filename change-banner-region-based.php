<?php
/**
 * Change the banner configuration based on the region.
 * @param array $data
 *
 * @return array
 */
function cmplz_change_banner_region_based( $data ) {
	if (COMPLIANZ::$geoip->geoip_enabled()) {
		$user_region      = COMPLIANZ::$geoip->region();
		if ( $user_region === 'us' ) {
			$data['position'] = 'bottom';
		}
	}
	return $data;
}
add_filter('cmplz_ajax_loaded_banner_data', 'cmplz_change_banner_region_based');
