<?php
// Add custom subdomains to the list of subdomains that are allowed for testing
// Not for use in the plugin, do a pull request if your staging environment is not listed.
function rsp_custom_subdomains( $subdomains ){
	$subdomains[] = 'staging.*';
	$subdomains[] = '*.dev.*';
	$subdomains[] = '*.test.*';
	$subdomains[] = '*.stg.*';
	$subdomains[] = 'stg.*';
	$subdomains[] = 'test.*';
	$subdomains[] = 'beta.*';
	$subdomains[] = 'acceptatie.*';
	$subdomains[] = '*preprod.*';
	$subdomains[] = 'localhost';
	$subdomains[] = '*.lndo.site';

	return $subdomains;
}
add_filter( 'edd_sl_url_subdomains', 'rsp_custom_subdomains' );
