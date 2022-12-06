<?php
function cmplz_deny_on_banner_close() {
	ob_start(); ?>
	<script>
        document.addEventListener('click', e => {
            if ( e.target.closest(".cmplz-close") ) {
                e.preventDefault();
                cmplz_deny_all()
            }
        });
	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_deny_on_banner_close', PHP_INT_MAX );