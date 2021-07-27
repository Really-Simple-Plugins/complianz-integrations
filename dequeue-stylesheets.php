<?php defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/* For documents styles use 'cmplz-document'
*  For cookiebanner styles use 'cmplz-cookie'
*
*/

function cmplz_dequeue_unnecessary_styles() {
    wp_dequeue_style( 'cmplz-cookie' );
    wp_deregister_style( 'cmplz-cookie' );
}
add_action( 'wp_print_styles', 'cmplz_dequeue_unnecessary_styles', 100 );
