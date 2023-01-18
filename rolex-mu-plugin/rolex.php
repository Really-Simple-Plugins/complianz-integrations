<?php
/**
 * Put this file, and the corresponding 'rolex' folder in the root of the mu-plugins folder
 */
function cmplz_add_rlx_category($html){
	$pattern = '/<details class="cmplz-category cmplz-marketing.*?<\/details>/is';
	ob_start();
    require_once( __DIR__ . '/rolex/category.php');
	$social = ob_get_clean();
	if ( preg_match( $pattern, $html, $matches ) ) {
		$marketing = $matches[0];
		$html = str_replace($marketing, $social.$marketing, $html);
	}

	return $html;
}
add_filter('cmplz_banner_html', 'cmplz_add_rlx_category');

/**
 * Enqueue the script
 * @return void
 */
function cmplz_enqueue_rlx( ) {
	wp_enqueue_script( 'cmplz-adobe', '//assets.adobedtm.com/7e3b3fa0902e/7ba12da1470f/launch-5de25e657d80.min.js', [] );
	$script = plugin_dir_url(__FILE__). "rolex/script.js";
	wp_enqueue_script( 'cmplz-rolex', $script, ['cmplz-cookiebanner'], filemtime($script) );
}
add_action( 'wp_enqueue_scripts', 'cmplz_enqueue_rlx' );

function cmplz_block_adobe_script( $tags ) {
	$tags[] = array(
		'name' => 'rolex',
		'category' => 'marketing',
		'urls' => array(
			'assets.adobedtm.com',
		),
		'enable_placeholder' => '0',
	);
	return $tags;
}
add_filter( 'cmplz_known_script_tags', 'cmplz_block_adobe_script' );





