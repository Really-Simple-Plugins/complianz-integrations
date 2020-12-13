<?php
/**
 * reload after consent. Only necessary for incomplete integrations, or plugins which handle consent serverside
 */
function cmplz_reload_after_consent() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplzStatusChange', function (e) {
                if (e.detail.category === 'marketing') {
                    location.reload();
                }
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_reload_after_consent' );

