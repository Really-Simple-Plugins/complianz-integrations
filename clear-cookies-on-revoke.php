<?php
/**
 * Clear cookies on revoke.
 * v > 6.0
 */
function cmplz_clear_cookies_on_revoke() {
	?>
	<script>
        jQuery(document).ready(function ($) {
            document.addEventListener('cmplz_revoke', function (e) {
                cmplzClearAllCookies();
            });

            /**
             * Clear all cookies, except those with 'wp' in them.
             */
            var excludeString = 'wp';
            function cmplzClearAllCookies(){
                if (typeof document === 'undefined') {
                    return;
                }

                var secure = ";secure";
                var date = new Date();
                date.setTime(date.getTime() - (24 * 60 * 60 * 1000));
                var expires = ";expires=" + date.toGMTString();
                if (window.location.protocol !== "https:") secure = '';

                (function () {
                    var cookies = document.cookie.split("; ");
                    for (var c = 0; c < cookies.length; c++) {
                        var d = window.location.hostname.split(".");
                        //if we have more than one result in the array, we can skip the last one, as it will be the .com/.org extension
                        var skip_last = d.length > 1;
                        while (d.length > 0) {
                            var cookieName = cookies[c].split(";")[0].split("=")[0];
                            var p = location.pathname;
                            p = p.replace(/^\/|\/$/g, '').split('/');
                            var cookieBase = encodeURIComponent(cookieName) + '=;SameSite=Lax' + secure + expires +';domain=.' + d.join('.') + ';path=';
                            var cookieBaseDomain = encodeURIComponent(cookieName) + '=;SameSite=Lax' + secure + expires +';domain=;path=';
                            document.cookie = cookieBaseDomain + '/';
                            document.cookie = cookieBase+ '/';
                            while (p.length > 0) {
                                var path = p.join('/');
                                if ( path.length>0 ) {
                                    document.cookie = cookieBase + '/' + path;
                                    document.cookie = cookieBaseDomain + '/' + path;
                                }
                                p.pop();
                            };

                            d.shift();
                            //prevents setting cookies on .com/.org
                            if (skip_last && d.length==1) d.shift();
                        }
                    }
                })();
            }

        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_clear_cookies_on_revoke' );