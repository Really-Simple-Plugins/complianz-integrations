<?php
function cmplz_set_denied_time_cookie() {
    ob_start(); ?>
    <script>
        let cmplz_cookie_name = 'denied_time';

        document.addEventListener("cmplz_banner_status", function(consentData) {
            var status = consentData.detail;
            if ( status == 'dismissed' ) {
                let daysValid = 365;
                let secure = ";secure";
                let date = new Date();
                date.setTime(date.getTime() + (daysValid * 24 * 60 * 60 * 1000));
                let expires = ";expires=" + date.toGMTString();
                let value = date.getTime();
                if (window.location.protocol !== "https:") secure = '';
                document.cookie = cmplz_cookie_name + "=" + value + ";SameSite=Lax" + secure + expires;
            }
        });

        document.addEventListener("cmplz_cookie_warning_loaded", function() {
            cmplz_cookie_name = cmplz_cookie_name + "=";
            let cArr = document.cookie.split(';');
            let denied_time;
            for (let i = 0; i < cArr.length; i++) {
                let c = cArr[i].trim();
                if (c.indexOf(cmplz_cookie_name) == 0)
                    denied_time = c.substring(cmplz_cookie_name.length, c.length);
            }
            let date = new Date();
            let current_time = date.getTime();
            let expire_on = denied_time + (7 * 24 * 60 * 60 * 1000);
            if ( current_time > expire_on ){
                cmplz_set_banner_status('show');
            }
        });

    </script>
    <?php
    $script = ob_get_clean();
    $script = str_replace(array('<script>', '</script>'), '', $script);
    wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_set_denied_time_cookie', PHP_INT_MAX );