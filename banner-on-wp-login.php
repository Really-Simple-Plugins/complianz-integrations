<?php
function cmplz_load_wizard_shortcode(){
	add_action( 'login_enqueue_scripts', array(COMPLIANZ::$banner_loader, 'enqueue_assets') );
	add_action( 'login_head', array( COMPLIANZ::$banner_loader, 'cookiebanner_css' ) );
	add_action( 'login_footer', array( COMPLIANZ::$banner_loader, 'cookiebanner_html' ) );
}
add_action('plugins_loaded', 'cmplz_load_wizard_shortcode');