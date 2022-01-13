<?php

/**
 * This adjusts the classes and adds an event listener so clicking the blocked content shows the banner instead of accepting marketing
 */
function cmplz_show_banner_on_blocked_content_click() {
	?>
	<script>
        function addEvent(event, selector, callback, context) {
            document.addEventListener(event, e => {
                if ( e.target.closest(selector) ) {
                    callback(e);
                }
            });
        }
        document.addEventListener('cmplz_cookie_warning_loaded', function (e) {
            document.querySelectorAll('.cmplz-accept-marketing').forEach(obj => {
                obj.classList.remove( 'cmplz-accept-marketing' );
                obj.classList.add( 'cmplz-show-banner' );
            });
            addEvent('click', '.cmplz-show-banner', function(e){
                document.querySelectorAll('.cmplz-manage-consent').forEach(obj => {
                    obj.click();
                });
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_blocked_content_click' );