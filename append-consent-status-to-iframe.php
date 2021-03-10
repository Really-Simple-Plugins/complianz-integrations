<?php
function cmplz_redirect_on_deny() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplzEnableScriptsMarketing', function (e) {
                $('iframe').each(function (i, obj) {
                    if ( $(this).hasClass('cmplz-iframe') ) return;

                    var src = $(this).data('src-cmplz');
                    src = src+'&cookie=marketing';
                    $(this).attr('src', src);
                }
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_redirect_on_deny' );