<?php
class Mappress_Compliance {

	static function register() {
		//@fixed: compatibility with Complianz Premium as well
		if (Mappress::is_plugin_active('complianz') || defined('cmplz_premium') )
			self::complianz();
	}

	static function complianz() {
		if (!defined('CMPLZ_GOOGLE_MAPS_INTEGRATION_ACTIVE') )
			define('CMPLZ_GOOGLE_MAPS_INTEGRATION_ACTIVE', true);

		add_filter('cmplz_known_script_tags', array(__CLASS__, 'cmplz_script'));

		//@fixed issue with not existing function name cmplz_detected_services vs cmplz_services
		add_filter('cmplz_detected_services', array(__CLASS__, 'cmplz_services'));
		add_filter('cmplz_whitelisted_script_tags', array(__CLASS__, 'cmplz_whitelist'));
	}

	static function cmplz_script( $tags ) {
		if ( Mappress::$options->iframes ) {
			$tags[] = array(
				'name' => 'mappress',
				'placeholder' => 'google-maps',
				'urls' => array(
					'mappress=embed',
				),
				'category' => 'marketing',
				'iframe' => 1,
			);
			//@fixed: differentiate between google and leaflet engine.
		} elseif ( Mappress::$options->engine ==='google' ) {
			$tags[] = array(
				'name' => 'mappress',
				'category' => 'marketing',
				'urls' => array(
					'/build/index_mappress',
					'maps.googleapis.com',
				),
				'enable_placeholder' => 1,
				'placeholder' => 'google-maps',
				'placeholder_class' => 'mapp-wrapper',
			);
		} else {
			$tags[] = array(
				'name' => 'mappress',
				'category' => 'marketing',
				'urls' => array(
					'/build/index_mappress',
					'maps.googleapis.com',
				),
				'enable_placeholder' => 1,
				'placeholder' => 'google-maps',
				'placeholder_class' => 'mapp-wrapper',
				'enable_dependency' => 1,
				'dependency' => [
					'maps.googleapis.com' => 'index_mappress',
				],
			);
		}
		return $tags;
	}

	// Add services to the list of detected items, so it will get set as default, and will be added to the notice about it

	//@fixed issue with not existing function name cmplz_detected_services vs cmplz_services
	static function cmplz_services( $services ) {
		if ( ! in_array( 'google-maps', $services ) )
			$services[] = 'google-maps';
		return $services;
	}

	// Whitelist the l10n script
	static function cmplz_whitelist($tags){
		$tags[] = 'var mappl10n';
		return $tags;
	}
}
