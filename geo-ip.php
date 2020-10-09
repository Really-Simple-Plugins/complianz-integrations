<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * Get region from Complianz GEO IP
 * @return string
 */
function cmplz_custom_get_country()
{
	$region = 'unknown';

	//check if Complianz is active
    if (!class_exists('COMPLIANZ')) {
        error_log("COMPLIANZ not active");
        return $region;
    }

    if (COMPLIANZ()->geoip->geoip_enabled()) {
        $region = COMPLIANZ()->geoip->region();
        $country_code = COMPLIANZ()->geoip->get_country_code();
        error_log("Custom usage of GEO IP");
        error_log("country code ".$country_code);
        error_log("region ".$region);
        return $region;
    } else {
    	error_log("geo ip not enabled");
    	return $region;
    }

}