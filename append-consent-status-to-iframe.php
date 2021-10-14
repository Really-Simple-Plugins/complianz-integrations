<?php
/**
 * append the current category to the iframe
 * Compatibility: 6.0
 */
function cmplz_append_status_to_iframe() {
	ob_start();
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_enable_category', function (consentData) {
                var category = consentData.detail.category;
                if (category==='marketing'){
                    $('iframe').each(function (i, obj) {
                        if ( $(this).hasClass('cmplz-iframe') ) return;

                        var src = $(this).data('src-cmplz');
                        src = src+'&cookie=marketing';
                        $(this).attr('src', src);
                    }
                }
            });
        });
	</script>
	<?php
    $script = ob_get_clean();
    $script = str_replace( array( '<script>', '</script>' ), '', $script );
    wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_append_status_to_iframe' );