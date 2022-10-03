<?php
function cmplz_my_ip_detection($ip){
	return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $ip;
}
add_filter('cmplz_client_ip', 'cmplz_my_ip_detection');