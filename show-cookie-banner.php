<?php
function cmplz_show_banner_on_click() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            $(document).on('click', '.cmplz-show-banner', function(){
                $('.cc-revoke').click();
                $('.cc-revoke').fadeOut();
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_click' );
