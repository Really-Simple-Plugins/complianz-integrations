<?php
/**
 * If jquery is missing, Complianz won't run on the front-end.
 * We use a high priority, to make sure there's no override
 */

function cmplz_custom_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'cmplz_custom_enqueue_jquery', PHP_INT_MAX - 100 );
