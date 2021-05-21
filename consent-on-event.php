<?php defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

add_action( 'wp_footer', 'cmplz_consent_on_event_settings', 100);
function cmplz_consent_on_event_settings() {
    // If you use the GEO IP Setting (Pro feature), you can select in which country this should be enabled.
    // When the setting is disabled or you are using the free version of Complianz this will affect all regions.
    $enable_for_regions 	= array ('au');

    $consent_on_scroll 		= true; // true or false
    $consent_on_timeout 	= true; // true or false
    $consent_timeout 		= 10;   // time in seconds

    // You are done setting up the settings. You don't need to edit the code below.

    $user_region = COMPLIANZ::$geoip->region();
    if (!in_array($user_region, $enable_for_regions)) {
        $consent_on_scroll 		= false;
        $consent_on_timeout 	= false;
    }

    if ($consent_on_scroll) { ?>
        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                $(window).on('scroll', cmplz_accept_on_scroll_event);
                function cmplz_accept_on_scroll_event() {
                    $(".cc-allow").trigger("click");
                    $(".cc-accept-all").trigger("click");
                    $(window).off('scroll', cmplz_accept_on_scroll_event);
                }
            });
        </script>
    <?php }

    if ($consent_on_timeout) { ?>
        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                setTimeout(function () {
                    $(".cc-allow").trigger("click");
                    $(".cc-accept-all").trigger("click");
                }, <?php echo($consent_timeout * 1000) ?> );
            });
        </script>
    <?php }
}
