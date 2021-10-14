<?php
/**
 * v: 6.0
 * reload after consent. Only necessary for incomplete integrations, or plugins which handle consent serverside
 */
function cmplz_reload_after_consent() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_status_change', function (e) {
                if (e.detail.category === 'marketing' && e.detail.value==='allow') {
                    location.reload();
                }
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'cmplz_reload_after_consent' );

