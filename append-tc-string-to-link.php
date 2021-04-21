<?php
/**
 * Check if we're in the EU, and get the TC string from the localstorage.
 * Append to all links with class 'my-link'
 *
 */
function cmplz_append_tc_string_to_link() {
	ob_start();
	?>
	<script>
		//get tc string from localstorage.
        let tcString = window.localStorage.getItem('cmplz_tcf_consent' );
        let gdpr = 0;
        if (complianz.region === 'eu' ) {
            gdpr = 1;
        }
        console.log('&gdpr='+gdpr+'&gdpr_consent='+tcString);

        let hyperlinks = document.getElementsByClassName("my-link");
        for (var i = 0; i < hyperlinks.length; i++) {
            let hyperlink = hyperlinks.item(i);
            hyperlink.href = hyperlink.href + '&gdpr='+gdpr+'&gdpr_consent='+tcString;
        }

	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookie-config', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_append_tc_string_to_link', PHP_INT_MAX );
