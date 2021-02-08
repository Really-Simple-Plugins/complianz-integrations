<?php
/**
 * Wrap an placeholder element in a <div> in case the an iFrame is set without wrapping HTML attributes
 * A common example is when YouTube videos will shift your lay-out when blocked prior to consent
 */

function cmplz_add_div_iframe() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
           $( ".cmplz-placeholder-element" ).wrap( "<div class='cmplz-iframe'></div>" );
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_add_div_iframe' );
