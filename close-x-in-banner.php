<?php

function cmplz_reload_after_consent() {
	?>
	<style>
        #cc-window .cc-compliance .cc-btn.cc-dismiss {
            position: absolute;
            top: 5px;
            right: -18px;
            text-align: right;
            margin-right: 30px;
            background-color: initial !important;
            border: 0;
            text-decoration: none;
        }
        #cc-window .cc-compliance .cc-btn.cc-dismiss::before {
            content: "x";
        }
	</style>
	<?php
}
add_action( 'wp_footer', 'cmplz_reload_after_consent' );