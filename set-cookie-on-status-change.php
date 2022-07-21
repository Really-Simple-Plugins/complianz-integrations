<?php
/**
 * v: 6.0
 * A snippet to redirect a user to another page when the status i
 */

function cmplz_set_rlx() {
	?>
	<script>
        //maybe a default value is required.
        // document.addEventListener("cmplz_before_cookiebanner", function() {

        // });
        document.addEventListener('cmplz_status_change', function (e) {
            let value = false;
            let secure = ";secure";
            let date = new Date();
            let name = 'rlx-consent';
            if (e.detail.category === 'marketing' && e.detail.value==='allow') {
                value = true;
            }
            date.setTime(date.getTime() + (complianz.cookie_expiry * 24 * 60 * 60 * 1000));
            let expires = ";expires=" + date.toGMTString();
            document.cookie = name + "=" + value + ";SameSite=Lax" + secure + expires + ";path="+cmplz_get_cookie_path();
            e.preventDefault();
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_set_rlx' );