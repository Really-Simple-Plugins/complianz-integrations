<?php
/**
 * Shortcode to use the Complianz email obfuscator
 * Usage: [cmplz_obfuscate email="john@doe.com"]
 * @param $atts
 * @param $content
 * @param $tag
 *
 * @return false|string
 */
function cmplz_obfuscate_shortcode(
	$atts = array(), $content = null, $tag = ''
) {
	$atts   = shortcode_atts( array(
		'email'   => '',
	), $atts, $tag );
	$email = sanitize_email($atts['email']);
	ob_start();
	$css = '<style>.cmplz-obfuscate {direction: rtl;unicode-bidi: bidi-override;}</style>';
	echo $css.COMPLIANZ::$document->obfuscate_email($email);
	return ob_get_clean();
}
add_shortcode( 'cmplz_obfuscate', 'cmplz_obfuscate_shortcode' );
