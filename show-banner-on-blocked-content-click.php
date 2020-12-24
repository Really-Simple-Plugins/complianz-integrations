<?php

/**
 * This adjusts the classes and adds an event listener so clicking the blocked content shows the banner instead of accepting marketing
 */
function cmplz_reload_after_consent() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplzCookieWarningLoaded', function (e) {
                $('.cmplz-accept-marketing').each(function(){
                    console.log($(this));
                    $(this).removeClass( 'cmplz-accept-marketing' ).addClass( 'cmplz-show-banner' );
                });
                $(document).on('click', '.cmplz-show-banner', function(){
                    $('.cc-revoke').click();
                });
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_reload_after_consent' );