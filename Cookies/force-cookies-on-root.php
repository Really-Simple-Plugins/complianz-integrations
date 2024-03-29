<?php
/**
 * Force consent cookies on the root as shown below, or choose a subfolder
 * Add subfolder between '' on line 9 e.g. /subfolder/
 * @param string @path
 * @return string
*/
function my_cookie_path($path) {
    return '';
}
add_filter( 'cmplz_cookie_path', 'my_cookie_path');

/**
 * Force consent cookies on a specific domain.
 * @param string @domain
 * @return string
*/
function my_cookie_domain($domain) {
    return 'domain.com';
}
add_filter( 'cmplz_cookie_domain', 'my_cookie_domain');
