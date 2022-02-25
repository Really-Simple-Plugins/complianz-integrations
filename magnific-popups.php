<?php
add_filter('cmplz_cookie_blocker_output', 'cmplz_magnific_popup');
function cmplz_magnific_popup($output){
	$pattern ="/<a href=\"(.*)\" class=\"mfp-iframe has_video\"/";
	if ( preg_match_all( $pattern, $output, $matches, PREG_PATTERN_ORDER ) ) {
		foreach ( $matches[0] as $key => $total_match ) {
			$href = $matches[2][ $key ];
			$new = $total_match;
			if ( cmplz_use_placeholder( $href ) ) {
				$placeholder = cmplz_placeholder('youtube', $href );
				$new = COMPLIANZ::$cookie_blocker->add_class( $new, 'a', "cmplz-placeholder-element" );
				$new = COMPLIANZ::$cookie_blocker->add_data( $new, 'a', 'placeholder-image', $placeholder );
			}
			$new = str_replace('"'.$href.'"', '"#" data-href-cmplz="'.$href.'" ', $new);
            $output = str_replace($total_match, $new, $output);
		}
	}

    return $output;
}

function cmplz_magnific_popup_script() {
	ob_start();
	?>
    <script>
        document.addEventListener('cmplz_enable_category', function (consentData) {
            var category = consentData.detail.category;
            var service = consentData.detail.service;
            if (category==='marketing' || service === 'youtube'){
                document.querySelectorAll('iframe').forEach(obj => {
                    var src = obj.getAttribute('data-href-cmplz');
                    obj.classList.add('cmplz-activated');
                    obj.setAttribute('href', src);
                    let blocked_content_container = obj.closest('.cmplz-blocked-content-container');
                    if (blocked_content_container) {
                        let cssIndex = blocked_content_container.getAttribute('data-placeholder_class_index');
                        blocked_content_container.classList.remove('cmplz-blocked-content-container');
                        blocked_content_container.classList.remove('cmplz-placeholder-' + cssIndex);
                    }
                }
            }
        });
    </script>
	<?php
	$script = ob_get_clean();
	$script = str_replace(array('<script>', '</script>'), '', $script);
	wp_add_inline_script( 'cmplz-cookiebanner', $script );
}
add_action( 'wp_enqueue_scripts', 'cmplz_magnific_popup_script',PHP_INT_MAX );
