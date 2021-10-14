<?php

/**
 * This adjusts the classes and adds an event listener so clicking the blocked content shows the banner instead of accepting marketing
 */
function cmplz_show_banner_on_blocked_content_click() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_cookie_warning_loaded', function (e) {
                $('.cmplz-accept-marketing').each(function(){
                    $(this).removeClass( 'cmplz-accept-marketing' ).addClass( 'cmplz-show-banner' );
                });
                $(document).on('click', '.cmplz-show-banner', function(){
                    $('.cmplz-manage-consent').click();
                });
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_blocked_content_click' );