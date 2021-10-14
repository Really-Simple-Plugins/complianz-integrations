<?php
/**
 * Show the banner when a html element with class 'cmplz-show-banner' is clicked
 */
function cmplz_show_banner_on_click() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            $(document).on('click', '.cmplz-show-banner', function(){
                $('.cmplz-manage-consent').click();
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_click' );
