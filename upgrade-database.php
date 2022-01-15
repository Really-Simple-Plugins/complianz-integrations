<?php
/**
 * If you get errors like "row size to large" in the debug log, it might help to set the row_format to DYNAMIC
 */

add_action( 'plugins_loaded', 'cmplz_upgrade_cookiebanner_table', 10 );
function cmplz_upgrade_cookiebanner_table() {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'cmplz_cookiebanners';
	$sql        = "CREATE TABLE $table_name (
         `ID` int(11) NOT NULL AUTO_INCREMENT,
         `banner_version` int(11) NOT NULL,
         `default` int(11) NOT NULL,
         `archived` int(11) NOT NULL,
         `title` text NOT NULL,
        `position` text NOT NULL,
        `theme` text NOT NULL,
        `checkbox_style` text NOT NULL,
        `use_logo` text NOT NULL,
        `logo_attachment_id` text NOT NULL,
		`close_button` text NOT NULL,
        `revoke` text NOT NULL,
        `header` text NOT NULL,
        `dismiss` text NOT NULL,
        `save_preferences` text NOT NULL,
        `view_preferences` text NOT NULL,
        `category_functional` text NOT NULL,
        `category_all` text NOT NULL,
        `category_stats` text NOT NULL,
        `category_prefs` text NOT NULL,
        `accept` text NOT NULL,
        `message_optin` text NOT NULL,
        `use_categories` text NOT NULL,
        `disable_cookiebanner` int(11) NOT NULL,
        `banner_width` int(11) NOT NULL,
        `soft_cookiewall` int(11) NOT NULL,
        `dismiss_on_scroll` int(11) NOT NULL,
        `dismiss_on_timeout` int(11) NOT NULL,
        `dismiss_timeout` text NOT NULL,
        `accept_informational` text NOT NULL,
        `message_optout` text NOT NULL,
        `use_custom_cookie_css` text NOT NULL,
        `custom_css` text NOT NULL,
        `statistics` text NOT NULL,
        `functional_text` text NOT NULL,
        `statistics_text` text NOT NULL,
        `statistics_text_anonymous` text NOT NULL,
        `preferences_text` text NOT NULL,
        `marketing_text` text NOT NULL,
        `colorpalette_background` text NOT NULL,
        `colorpalette_text` text NOT NULL,
        `colorpalette_toggles` text NOT NULL,
        `colorpalette_border_radius` text NOT NULL,
        `border_width` text NOT NULL,
        `colorpalette_button_accept` text NOT NULL,
        `colorpalette_button_deny` text NOT NULL,
        `colorpalette_button_settings` text NOT NULL,
        `buttons_border_radius` text NOT NULL,
        `animation` text NOT NULL,
        `use_box_shadow` int(11) NOT NULL,
        `header_footer_shadow` int(11) NOT NULL,
        `hide_preview` int(11) NOT NULL,
          PRIMARY KEY  (ID)
        ) ROW_FORMAT=DYNAMIC
            $charset_collate;";
	dbDelta( $sql );
	update_option( 'cmplz_cbdb_version', cmplz_version );
}