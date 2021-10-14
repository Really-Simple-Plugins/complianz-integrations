<?php
/**
 * Open links on cookie banner in new window
 */
function cmplz_open_in_new_window() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_cookie_warning_loaded', function (e) {
                $('a.cmplz-link.cookie-statement').attr('target', '_blank');
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_open_in_new_window' );


