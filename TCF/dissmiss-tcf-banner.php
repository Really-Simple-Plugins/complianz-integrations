<?php

function cmplz_dismiss_tcf_banner() {
	ob_start(); ?>
	<script>
        if ( document.querySelector('.cmplz-document.cookie-statement') ){
            const wrapper = document.createElement('div');
            wrapper.innerHTML = '<a href="javascript:history.back()">Go Back</a>';
            wrapper.classList.add('cmplz-back-button');
            wrapper.style.position = 'fixed';
            wrapper.style.bottom = 0;
            wrapper.style.right = "30px";
            document.body.appendChild(wrapper);
        }

        setInterval(function(){
            if (cmplz_get_banner_status() ==='dismissed') {
                cmplz_set_banner_status('dismissed');
            }
        }, 500);

	</script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script);
}
add_action( 'wp_enqueue_scripts', 'cmplz_dismiss_tcf_banner', PHP_INT_MAX );