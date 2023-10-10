<?php
function cmplz_hide_banner_us() {
	ob_start(); ?>
    <script>
        document.addEventListener("cmplz_before_cookiebanner", function() {
            if (complianz.region === 'us') {
                cmplz_set_banner_status('dismissed');
            }
        });

    </script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_hide_banner_us', PHP_INT_MAX );