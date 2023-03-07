<?php
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );
/**
 * Draft for creating a Contact From 7 integration
 */
/**
 * Customize the error message on submission of the form before consent
 *
 * @param $message
 * @param $status
 *
 * @return string
 */
function cmplz_cf7_custom_errormessage( $message, $status ) {
	if ( $status === 'spam' ) {
		$message = apply_filters( 'cmplz_accept_cookies_contactform7', __( 'Please accept marketing cookies to enable this form', 'complianz-gdpr' ) );
	}

	return $message;
}

add_filter( 'wpcf7_display_message', 'cmplz_cf7_custom_errormessage', 20, 2 );


add_filter( 'cmplz_known_script_tags', 'cmplz_cf7_custom_script' );
function cmplz_cf7_custom_script( $tags ) {
	$service = WPCF7_RECAPTCHA::get_instance();
	if (cmplz_get_value('block_recaptcha_service') === 'yes'){
		if ( $service->is_active() ) {
			$tags[] = array(
				'name' => 'google-recaptcha',
				'category' => 'marketing',
				'placeholder' => 'google-recaptcha',
				'urls' => array(
					'recaptcha/api.js',
					'grecaptcha',
					'recaptcha.js',
					'recaptcha/api',
					'apis.google.com/js/platform.js',
					'modules/recaptcha/script.js',
				),
				'enable_placeholder' => '1',
				'placeholder_class' => 'recaptcha-invisible,g-recaptcha',
				'enable_dependency' => '1',
				'dependency' => [
					//'wait-for-this-script' => 'script-that-should-wait'
					'recaptcha/api.js' => 'modules/recaptcha/script.js',
				],
			);
		}
	}
	return $tags;
}

/**
 * Add some custom css for the placeholder
 */

add_action( 'cmplz_banner_css', 'cmplz_recaptcha_custom_css' );
function cmplz_recaptcha_custom_css() {
	?>
	.cmplz-blocked-content-container.recaptcha-invisible,
	.cmplz-blocked-content-container.g-recaptcha {
	max-width: initial !important;
	height: 80px !important;
	margin-bottom: 20px;
	}

	@media only screen and (max-width: 400px) {
	.cmplz-blocked-content-container.recaptcha-invisible,
	.cmplz-blocked-content-container.g-recaptcha {
	height: 100px !important
	}
	}

	.cmplz-blocked-content-container.recaptcha-invisible .cmplz-blocked-content-notice,
	.cmplz-blocked-content-container.g-recaptcha .cmplz-blocked-content-notice {
	max-width: initial;
	padding: 7px;
	}
	<?php
}