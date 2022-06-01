<?php

/**
 * Skip the url if a certain string is in it, by returning false for this URL during the scan
 * @param string $url
 *
 * @return false|string
 */
function my_cmplz_exlude_page($url){
	if (strpos($url, 'string-to-exclude') !== false ) {
		return false;
	}
	return $url;
}
add_filter("cmplz_next_page_url", "my_cmplz_exlude_page");
