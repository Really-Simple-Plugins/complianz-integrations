<?php
/**
 * append the current category to the iframe
 * Compatibility: 6.0
 */
function cmplz_append_status_to_iframe() {
	ob_start();
	?>
	<script>
        document.addEventListener('cmplz_enable_category', function (consentData) {
            var category = consentData.detail.category;
            if (category==='marketing'){
                document.querySelectorAll('iframe').forEach(obj => {
                    if ( obj.classList.contains('cmplz-iframe') ) return;

                    var src = obj.getAttribute('data-src-cmplz');
                    src = src+'&cookie=marketing';
                    obj.setAttribute('src', src);
                }
            }
        });
	</script>
	<?php
    $script = ob_get_clean();
    $script = str_replace( array( '<script>', '</script>' ), '', $script );
    wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_append_status_to_iframe' );