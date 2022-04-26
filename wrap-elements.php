<?php
/**
 * Wrap an placeholder element in a <div> in case the an iFrame is set without wrapping HTML attributes
 * A common example is when YouTube videos will shift your lay-out when blocked prior to consent
 */

/**
 * @param string $html
 *
 * @return string
 */
function cmplz_add_div_iframe($html){
    return '<div>'.$html.'</div>';
}
add_filter( 'cmplz_iframe_html', 'cmplz_add_div_iframe' );


/**
 * jquery alternative
 * @return void
 */

function cmplz_add_div_iframe_jquery() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
           $( ".cmplz-placeholder-element" ).wrap( "<div class='cmplz-iframe'></div>" );
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_add_div_iframe_jquery' );
