<?php
/**
 * If used icw CF7, load CF7 only on CF7 pages
 * @return void
 */
function cmplz_cf7_load_contactform7_on_specific_page(){
	global $post;
	if ( $post ) {
		$content = $post->post_content;
		if ( !has_shortcode( $content, 'contact-form-7' ) ) {
			wp_dequeue_script( 'contact-form-7' ); // Dequeue JS Script file.
			wp_dequeue_style( 'contact-form-7' );  // Dequeue CSS file.
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cmplz_cf7_load_contactform7_on_specific_page' );