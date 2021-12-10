<?php
function cmplz_allow_cookies_on_root_field( $fields ) {

$fields['set_cookies_on_root'] = array(
    'source'  => 'settings',
    'step'    => 'general',
    'type'    => 'checkbox',
    'default' => false,
    'label'   => __( "Set cookiebanner cookies on the root domain", 'complianz-gdpr' ),
    'help'    => __( "This is useful if you have a multisite, or several sites as subdomains on a main site", 'complianz-gdpr' ),
    'table'   => true,
);

$fields['cookie_domain'] = array(
    'source'    => 'settings',
    'step'      => 'general',
    'type'      => 'text',
    'default'   => false,
    'label'     => __( "Domain to set the cookies on", 'complianz-gdpr' ),
    'help'      => __( "This should be your main, root domain.", 'complianz-gdpr' ),
    'table'     => true,
    'condition' => array( 'set_cookies_on_root' => true ),
);

return $fields;
}

add_filter( 'cmplz_fields_load_types', 'cmplz_allow_cookies_on_root_field', 10, 1 );
