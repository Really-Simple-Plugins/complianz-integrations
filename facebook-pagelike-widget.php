<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );
add_filter( 'cmplz_known_script_tags', 'cmplz_fb_page_like_widget_script' );
function cmplz_fb_page_like_widget_script( $tags ) {
	$tags[] = 'fb.js';

	return $tags;
}


/**
 * Add some custom css for the placeholder
 */

add_action( 'wp_footer', 'cmplz_fb_pagelike_widget_css' );
function cmplz_fb_pagelike_widget_css() {
	?>
	<style>
		.fb_loader {
			display:none;
		}
	</style>
	<?php
}


function cmplz_fb_pagelike_widget_js() {
	?>
	<script>
		jQuery(document).ready(function ($) {
			$(document).on("cmplz_run_after_all_scripts", cmplz_fb_pagelike_widget_js);
			function cmplz_fb_pagelike_widget_js() {
				$(document).trigger("ready");
			}
		})
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_fb_pagelike_widget_js' );
