<?php
/**
 * Open links on cookie banner in new tab
 * Updated for 6.0
 */
function cmplz_open_in_new_tab() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener('cmplz_cookie_warning_loaded', function (e) {
                var links = document.getElementsByClassName('cmplz-link');
                var len = links.length;

                for(var i=0; i<len; i++) {
                    links[i].setAttribute('target', '_blank');
                }

        });
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_open_in_new_tab' );
