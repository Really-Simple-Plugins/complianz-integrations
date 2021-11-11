<?php
/**
 * Open links on cookie banner in new window
 */
function cmplz_open_in_new_window() {
    ?>
    <script>
        document.addEventListener('cmplz_cookie_warning_loaded', function (e) {
            document.querySelectorAll('a.cmplz-link.cookie-statement').forEach(obj => {
                obj.setAttribute('target', '_blank');
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_open_in_new_window' );


