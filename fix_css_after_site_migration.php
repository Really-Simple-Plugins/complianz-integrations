<?php
/**
 * When a site moves to a new URL, the banner css should update.
 * this mu plugin handles this if you often push a website from staging to live
 */
if ( !function_exists('cmplz_detect_url_change') ) {
	function cmplz_detect_url_change() {
		$site_url = site_url();
		$previous_site_url = get_option('cmplz_current_site_url');
		if ( $site_url !== $previous_site_url ) {
			$banners = cmplz_get_cookiebanners();
			if ( $banners ) {
				foreach ( $banners as $banner_item ) {
					$banner = new CMPLZ_COOKIEBANNER( $banner_item->ID );
					$banner->save();
				}
			}
		}
		get_option('cmplz_current_site_url', $previous_site_url );
	}
	add_action('init', 'cmplz_detect_url_change');
}