<?php
function cmplz_redirect_on_deny() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplzStatusChange', function (e) {
                if (e.detail.category !== 'marketing') {
                    window.location.href = "https://wordpress.org/plugins/complianz-gdpr/";
                }
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_redirect_on_deny' );

