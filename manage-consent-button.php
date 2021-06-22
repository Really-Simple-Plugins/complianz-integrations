
<?php

defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/**
 * 1. Make sure you use the Font-Awesome 5 Library. A free plugin with the same name is available for download.
 * 2. Do NOT hide the current Manage Consent Tab under settings.
 * 3. Change CSS if so desired!
 */

function myCustomManageConsent() {
	?>
	<div id="manageconsent" class="cmplz-show-banner"><i class="cmplz-fas fas fa-cookie-bite"></i></div>
	<style> #manageconsent {
	font-family: "Font Awesome Free 5";
	position:fixed;
	cursor:pointer;
	width:60px;
	height:60px;
	bottom:40px;
	left:40px;
	font-size: 30px;
	background-color:#29b6f6;
	color:#fff;
	line-height:2;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
	}
	#manageconsent:hover {
	background-color:#333;
	color:#fff;
	.cc-revoke {display:none;}
	</style>
	<script>
        jQuery(document).ready(function ($) {
            $(document).on('click', '.cmplz-show-banner', function(){
                $('.cc-revoke').click();
                $('.cc-revoke').fadeOut();
            });
        });
	</script>

	<?php

}

add_action( 'wp_footer', 'myCustomManageConsent' );
