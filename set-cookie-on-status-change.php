<?php
function cmplz_social_media_script() {
	ob_start();
	?>
    <script>
        function cmplz_set_rlx_cookie(value){
            let secure = ";secure";
            let date = new Date();
            let name = 'rlx-consent';
            date.setTime(date.getTime() + (complianz.cookie_expiry * 24 * 60 * 60 * 1000));
            let expires = ";expires=" + date.toGMTString();
            document.cookie = name + "=" + value + ";SameSite=Lax" + secure + expires;
        }
        document.addEventListener('click', e => {
            if ( e.target.closest('.cmplz-save-preferences') ) {
                let marketing_enabled = document.querySelector('input.cmplz-marketing').checked;
                if (marketing_enabled) {
                    cmplz_set_rlx_cookie(true);
                } else {
                    cmplz_set_rlx_cookie(false);
                }
            }
        });

        document.addEventListener("cmplz_before_cookiebanner", function(e) {
            if (cmplz_get_cookie('marketing') === 'allow'){
                cmplz_set_rlx_cookie(true);
            } else {
                cmplz_set_rlx_cookie(false);
            }
        });

        document.addEventListener("cmplz_revoke", function(e) {
            cmplz_set_rlx_cookie(false);
        });
    </script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_set_rlx',PHP_INT_MAX );