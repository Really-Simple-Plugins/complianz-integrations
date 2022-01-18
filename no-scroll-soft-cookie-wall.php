<?php
/**
 * Listen to the loaded event. When the banner is loaded, add the noscroll class
 * As soon as the banner is dismissed, remove the class again.
 * @return void
 */
function cmplz_noscroll_js() {
    ob_start(); ?>
    <script>
        let cmplz_cookie_name = 'denied_time';

        document.addEventListener("cmplz_banner_status", function(consentData) {
            var status = consentData.detail;
            if ( status === 'dismissed' ) {
                document.querySelector('body').classList.remove('cmplz-noscroll');

            }
        });

        document.addEventListener("cmplz_cookie_warning_loaded", function() {
           document.querySelector('body').classList.add('cmplz-noscroll');
        });

    </script>
    <?php
    $script = ob_get_clean();
    $script = str_replace(array('<script>', '</script>'), '', $script);
    wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_noscroll_js', PHP_INT_MAX );

/**
 * Add css to the banner, to prevent scrolling on the body element
 * @return void
 */
function cmplz_noscroll_css() {
	?>
    .cmplz-noscroll {
        height:100%;
        overflow:hidden;
    }
	<?php
}
add_action( 'cmplz_banner_css', 'cmplz_noscroll_css' );