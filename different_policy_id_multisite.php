<?php

/**
 * When the policy id changes, prevent if from updating the network policy ID, and save it as normal option
 * @param $value
 * @param $old_value
 * @param $option
 * @param $network_id
 *
 * @return void
 */
function cmplz_my_save_policy_id_as_default_option($value, $old_value, $option, $network_id) {
	if (empty($value)){
		$value = 1;
	}
	update_option('complianz_active_policy_id', $value);

	return $old_value;
}
add_filter('pre_update_site_option_complianz_active_policy_id', 'cmplz_my_save_policy_id_as_default_option', 10, 4 );

/**
 * When the site_option is retrieved, get the normal option instead
 * @param $value
 * @param $option
 * @param $network_id
 *
 * @return false|mixed|null
 */
function cmplz_my_get_default_option($value, $option, $network_id){
	return get_option('complianz_active_policy_id');
}
add_filter('site_option_complianz_active_policy_id', 'cmplz_my_get_default_option', 10, 3);
