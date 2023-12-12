<?php

function cmplz_create_headless_js_file() {

	$banner = new CMPLZ_COOKIEBANNER( apply_filters( 'cmplz_user_banner_id', cmplz_get_default_banner_id() ) );
	$cookiesettings = $banner->get_front_end_settings();
	$js = '';
//			if ( cmplz_tcf_active() ) {
//				//add tcf js with filter
//				$js .= apply_filters('cmplz_tcf_js', '' );
//			}
	if ( get_option('cmplz_post_scribe_required') ) {
		$js .= file_get_contents(cmplz_path . "assets/js/postscribe.min.js");
	}

	$js .= "var complianz = ".json_encode($cookiesettings).";";
	$js .= file_get_contents(cmplz_path . "cookiebanner/js/complianz.min.js");
	ob_start();
	COMPLIANZ::$banner_loader->inline_cookie_script();
	$stats = ob_get_clean();
	preg_match('/<script.*?>(.*?)<\/script>/is', $stats, $matches);
	$stats = $matches[1];
	$js .= $stats;
	$upload_dir = cmplz_upload_dir('js');
	$file = $upload_dir . 'complianz-headless.min.js';
	if ( file_exists($upload_dir) && is_writable($upload_dir) ){
		$handle = fopen($file, 'wb' );
		fwrite($handle, $js);
		fclose($handle);
	}

	//generate html file
	$upload_dir = cmplz_upload_dir('html');
	ob_start();
	COMPLIANZ::$banner_loader->cookiebanner_html();
	$html = ob_get_clean();
	$file = $upload_dir . 'banner.html';
	if ( file_exists($upload_dir) && is_writable($upload_dir) ){
		$handle = fopen($file, 'wb' );
		fwrite($handle, $html);
		fclose($handle);
	}
}