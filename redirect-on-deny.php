<?php
/**
 * v: 6.0
 * A snippet to redirect a user to another page when the status i
 */

function cmplz_redirect_on_deny() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_status_change', function (e) {
                if (e.detail.category === 'marketing' && e.detail.value==='deny') {
                    window.location.href = "https://wordpress.org/plugins/complianz-gdpr/";
                }
                e.preventDefault();
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_redirect_on_deny' );

