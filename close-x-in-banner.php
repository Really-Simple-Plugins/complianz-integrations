<?php
/* Read our article on complianz.io/changing-dismiss-to-close-button/ for implementation */
function cmplz_reload_after_consent() {
	?>
	<style>
        #cc-window .cc-compliance .cc-btn.cc-dismiss {
            position: absolute;
            top: -15px;
            right: 15px;
            text-align: right;
            margin-right: 30px;
            background-color: initial !important;
            border: 0;
            text-decoration: none;
        }
/* Specifically for the Accept All + View Preferences Template */		
	#cc-window .cc-save {
	width:100%!important;
}
	</style>
	<?php
}
add_action( 'wp_footer', 'cmplz_reload_after_consent' );
