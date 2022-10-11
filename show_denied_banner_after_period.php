<?php
function cmplz_set_denied_time_cookie() {
	ob_start(); ?>
    <script>
        let cmplz_cookie_name = 'denied_time';
        function get_denied_time(){
            let cookie_name = cmplz_cookie_name + "=";
            let cArr = document.cookie.split(';');
            let denied_time=false;
            for (let i = 0; i < cArr.length; i++) {
                let c = cArr[i].trim();
                if (c.indexOf(cookie_name) == 0)
                    denied_time = c.substring(cookie_name.length, c.length);
            }
            return denied_time;
        }

        function set_denied_cookie(){
            let daysValid = 365;

            let secure = ";secure";
            let date = new Date();
            // let ask_again_on = date.setTime(date.getTime()) + (24 * 60 * 60 * 1000);
            //60 seconds
            // let ask_again_on = date.setTime(date.getTime()) + (60 * 1000);

            date.setTime(date.getTime() + (daysValid * 24 * 60 * 60 * 1000));
            let expires = ";expires=" + date.toGMTString();
            if (window.location.protocol !== "https:") secure = '';
            document.cookie = cmplz_cookie_name + "=" + ask_again_on + ";SameSite=Lax" + secure + expires;
        }


        document.addEventListener("cmplz_cookie_warning_loaded", function() {
            let denied_time = get_denied_time();
            console.log(denied_time);
            if ( !denied_time && cmplz_get_banner_status() === 'dismissed' ) {
                set_denied_cookie();
            } else {
                console.log("found time "+denied_time);
                let date = new Date();
                let current_time = date.getTime();

                let expire_on = parseInt(denied_time);
                console.log("current time "+current_time);
                console.log("expire on "+expire_on);
                console.log(expire_on - current_time);
                if ( current_time > expire_on ){
                    console.log("expired");
                    cmplz_set_banner_status('show');
                    set_denied_cookie();
                } else {
                    console.log("not expired");
                }
            }

        });

    </script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_set_denied_time_cookie', PHP_INT_MAX );